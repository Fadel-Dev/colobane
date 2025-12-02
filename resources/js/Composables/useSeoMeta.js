import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

/**
 * Composable pour gérer les meta tags SEO dans les pages Vue
 */
export function useSeoMeta() {
  const page = usePage();

  /**
   * Mettre à jour les meta tags dynamiquement
   */
  const setMetaTags = (options = {}) => {
    const {
      title,
      description,
      keywords,
      image,
      type = 'website',
      url
    } = options;

    // Titre
    if (title) {
      document.title = title;
      updateMetaTag('og:title', title);
      updateMetaTag('twitter:title', title);
    }

    // Description
    if (description) {
      updateMetaTag('description', description);
      updateMetaTag('og:description', description);
      updateMetaTag('twitter:description', description);
    }

    // Mots-clés
    if (keywords) {
      updateMetaTag('keywords', keywords);
    }

    // Image
    if (image) {
      updateMetaTag('og:image', image);
      updateMetaTag('twitter:image', image);
    }

    // Type
    if (type) {
      updateMetaTag('og:type', type);
    }

    // URL
    if (url) {
      updateMetaTag('og:url', url);
      updateMetaTag('twitter:url', url);
    }
  };

  /**
   * Mettre à jour une balise meta spécifique
   */
  const updateMetaTag = (name, content) => {
    let meta = document.querySelector(`meta[name="${name}"], meta[property="${name}"]`);
    
    if (!meta) {
      meta = document.createElement('meta');
      
      if (name.startsWith('og:') || name.startsWith('twitter:')) {
        meta.setAttribute('property', name);
      } else {
        meta.setAttribute('name', name);
      }
      
      document.head.appendChild(meta);
    }
    
    meta.setAttribute('content', content);
  };

  /**
   * Générer un breadcrumb pour les moteurs de recherche
   */
  const generateBreadcrumb = (breadcrumbs) => {
    const schema = {
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      'itemListElement': breadcrumbs.map((item, index) => ({
        '@type': 'ListItem',
        'position': index + 1,
        'name': item.name,
        'item': window.location.origin + item.url
      }))
    };

    const script = document.createElement('script');
    script.type = 'application/ld+json';
    script.textContent = JSON.stringify(schema);
    document.head.appendChild(script);
  };

  /**
   * Générer des données structurées
   */
  const addStructuredData = (schema) => {
    const script = document.createElement('script');
    script.type = 'application/ld+json';
    script.textContent = JSON.stringify(schema);
    document.head.appendChild(script);
  };

  /**
   * Obtenir le SEO configuré depuis le serveur
   */
  const seoData = computed(() => {
    return page.props.seo || {};
  });

  /**
   * Appliquer automatiquement les meta tags depuis seoData
   */
  const applySeoData = () => {
    if (seoData.value) {
      setMetaTags({
        title: seoData.value.title,
        description: seoData.value.description,
        keywords: seoData.value.keywords,
        image: seoData.value.image,
        type: seoData.value.type,
        url: seoData.value.url
      });
    }
  };

  return {
    setMetaTags,
    updateMetaTag,
    generateBreadcrumb,
    addStructuredData,
    applySeoData,
    seoData
  };
}

