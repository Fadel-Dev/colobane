import { onMounted, ref } from 'vue';

/**
 * Composable pour lazy loading des images
 * Utilise l'Intersection Observer API pour un chargement optimal
 */
export function useLazyLoad() {
  const imageElements = ref([]);

  const setupLazyLoading = () => {
    // Configuration Intersection Observer
    const imageObserverOptions = {
      root: null,
      rootMargin: '50px',
      threshold: 0.01
    };

    // Callback pour charger les images
    const imageLoadCallback = (entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          
          // Charger l'image
          if (img.dataset.src) {
            img.src = img.dataset.src;
            img.classList.add('loaded');
          }
          
          // Charger le srcset pour images responsives
          if (img.dataset.srcset) {
            img.srcset = img.dataset.srcset;
          }
          
          // Arrêter d'observer cet élément
          observer.unobserve(img);
        }
      });
    };

    // Créer l'observer
    const observer = new IntersectionObserver(
      imageLoadCallback,
      imageObserverOptions
    );

    // Observer toutes les images lazy-loadées
    const lazyImages = document.querySelectorAll('img[data-src]');
    lazyImages.forEach(img => {
      observer.observe(img);
      imageElements.value.push(img);
    });

    return observer;
  };

  onMounted(() => {
    // Vérifier la compatibilité IntersectionObserver
    if ('IntersectionObserver' in window) {
      setupLazyLoading();
    } else {
      // Fallback pour les anciens navigateurs
      document.querySelectorAll('img[data-src]').forEach(img => {
        img.src = img.dataset.src;
        if (img.dataset.srcset) {
          img.srcset = img.dataset.srcset;
        }
      });
    }
  });

  return {
    imageElements
  };
}

/**
 * Directive Vue pour lazy loading
 * Usage: v-lazy="imagePath"
 */
export const lazyLoadDirective = {
  mounted(el, binding) {
    if (el.tagName === 'IMG') {
      el.dataset.src = binding.value;
      el.src = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3 2"%3E%3C/svg%3E';
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.src = entry.target.dataset.src;
            entry.target.classList.add('lazy-loaded');
            observer.unobserve(entry.target);
          }
        });
      }, {
        root: null,
        rootMargin: '50px',
        threshold: 0.01
      });
      
      observer.observe(el);
    }
  }
};

/**
 * Service Worker pour caching des images
 */
export function registerServiceWorker() {
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js')
      .then(registration => {
        console.log('Service Worker registered:', registration);
      })
      .catch(error => {
        console.log('Service Worker registration failed:', error);
      });
  }
}

export default useLazyLoad;

