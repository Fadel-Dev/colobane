<script setup>
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import SeoHead from '../Components/SeoHead.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Footer from '../Components/Footer.vue';
import { Inertia } from '@inertiajs/inertia';
import Navbar from '../Components/Navbar.vue';
import Toast from '../Components/Toast.vue';
import { ref, computed, onMounted } from 'vue';

const page = usePage();

const props = defineProps({
  maison: Object,
  user: Object,
  nameSeler: Object,
  mailSeler: Object,
  phoneSeler: Object,
  suggestions: Object,
  nPiece: Object,
  urlActuelle: Object,
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
  isFavorite: Boolean,
});

// Reactive data
const currentIndex = ref(0);
const afficherPopup = ref(false);
const showFullDescription = ref(false);
const imageLoaded = ref(false);
const isScrolled = ref(false);
const isFavorite = ref(props.isFavorite || false);
const showToast = ref(false);
const toastMessage = ref('');
const toastType = ref('success');
const showLightbox = ref(false);
const lightboxIndex = ref(0);

// Computed images array - Inclut toutes les images (image1, image2, image3 + images JSON)
const images = computed(() => {
  const imgArray = [];
  
  // Ajouter les images individuelles si elles existent
  if (props.maison.image1 && props.maison.image1 !== '') imgArray.push(props.maison.image1);
  if (props.maison.image2 && props.maison.image2 !== '') imgArray.push(props.maison.image2);
  if (props.maison.image3 && props.maison.image3 !== '') imgArray.push(props.maison.image3);
  
  // Ajouter toutes les images du champ JSON si elles existent
  let jsonImages = [];
  if (props.maison.images) {
    // Si c'est déjà un tableau, l'utiliser directement
    if (Array.isArray(props.maison.images)) {
      jsonImages = props.maison.images;
    } 
    // Si c'est une chaîne JSON, la parser
    else if (typeof props.maison.images === 'string') {
      try {
        jsonImages = JSON.parse(props.maison.images);
      } catch (e) {
        console.error('Erreur parsing JSON images:', e);
        jsonImages = [];
      }
    }
  }
  
  // Ajouter les images JSON sans doublons
  if (Array.isArray(jsonImages)) {
    jsonImages.forEach(img => {
      if (img && img !== '' && !imgArray.includes(img)) {
        imgArray.push(img);
      }
    });
  }
  
  // Si aucune image, retourner un tableau vide (sera géré par le template)
  return imgArray.length > 0 ? imgArray : [];
});

const currentImage = computed(() => {
  return images.value[currentIndex.value] || images.value[0];
});

// Vérifier si l'utilisateur connecté est le propriétaire de l'annonce
const isOwner = computed(() => {
  // Accéder à l'utilisateur via usePage() (Inertia)
  const authUser = page.props.auth?.user || null;
  if (!authUser || !props.maison.user_id) {
    return false;
  }
  return authUser.id === props.maison.user_id;
});

// Methods
const previousImage = () => {
  if (currentIndex.value > 0) {
    currentIndex.value--;
  } else {
    currentIndex.value = images.value.length - 1;
  }
};

const nextImage = () => {
  if (currentIndex.value < images.value.length - 1) {
    currentIndex.value++;
  } else {
    currentIndex.value = 0;
  }
};

const goToImage = (index) => {
  currentIndex.value = index;
};

const openLightbox = (index) => {
  lightboxIndex.value = index;
  showLightbox.value = true;
  document.body.style.overflow = 'hidden';
};

const closeLightbox = () => {
  showLightbox.value = false;
  document.body.style.overflow = 'auto';
};

const nextLightboxImage = () => {
  if (lightboxIndex.value < images.value.length - 1) {
    lightboxIndex.value++;
  } else {
    lightboxIndex.value = 0;
  }
};

const previousLightboxImage = () => {
  if (lightboxIndex.value > 0) {
    lightboxIndex.value--;
  } else {
    lightboxIndex.value = images.value.length - 1;
  }
};

const afficherNumero = () => {
  afficherPopup.value = true;
  document.body.style.overflow = 'hidden';
};

const fermerPopup = () => {
  afficherPopup.value = false;
  document.body.style.overflow = 'auto';
};

const ouvrirWhatsApp = () => {
  const numeroContact = `${props.phoneSeler}`;
  const messageText = `Bonjour, je suis intéressé par votre bien immobilier: ${props.maison.nom}. ${props.urlActuelle}`;
  const lienWhatsApp = `https://wa.me/${numeroContact}?text=${encodeURIComponent(messageText)}`;
  window.open(lienWhatsApp, "_blank");
};

const formatPrice = (price) => {
  if (!price) return '0';
  const numPrice = typeof price === 'string' ? parseFloat(price.replace(/\s/g, '')) : price;
  return numPrice.toLocaleString('fr-FR', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
};

  const navigateToDetail = (id) => {
    router.visit(`/detail/${id}`);
  };

  const toggleFavorite = () => {
    if (!page.props.auth?.user) {
      router.visit('/login');
      return;
    }

    router.post(`/favoris/toggle/${props.maison.id}`, {}, {
      preserveScroll: true,
      onSuccess: (page) => {
        // Mettre à jour l'état local
        const wasFavorite = isFavorite.value;
        isFavorite.value = !isFavorite.value;
        
        // Afficher le toast
        if (isFavorite.value) {
          toastMessage.value = 'Bien ajouté aux favoris avec succès!';
          toastType.value = 'success';
        } else {
          toastMessage.value = 'Bien retiré des favoris';
          toastType.value = 'info';
        }
        showToast.value = true;
      },
      onError: () => {
        toastMessage.value = 'Erreur lors de l\'opération';
        toastType.value = 'error';
        showToast.value = true;
      }
    });
  };

  const closeToast = () => {
    showToast.value = false;
  };

// Format date
const formatDate = (date) => {
  if (!date) return '';
  const d = new Date(date);
  return d.toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' });
};

// Fonction helper pour obtenir l'URL complète d'une image
const getImageUrl = (imagePath) => {
  if (!imagePath || imagePath === 'null' || imagePath === '') {
    return 'https://via.placeholder.com/800x600?text=Image+non+disponible';
  }
  
  // Si c'est une URL externe (http:// ou https://), retourner tel quel
  if (imagePath.startsWith('http://') || imagePath.startsWith('https://')) {
    return imagePath;
  }
  
  // Si c'est un chemin local, ajouter /storage/
  if (imagePath.startsWith('storage/') || imagePath.startsWith('/storage/')) {
    return imagePath.startsWith('/') ? imagePath : '/' + imagePath;
  }
  
  // Sinon, ajouter /storage/ devant (format: topics/filename.jpg)
  return '/storage/' + imagePath;
};

// Handle scroll for header effect
onMounted(() => {
  const handleScroll = () => {
    isScrolled.value = window.scrollY > 50;
  };
  window.addEventListener('scroll', handleScroll);
  return () => window.removeEventListener('scroll', handleScroll);
});

// SEO computed properties
const canonicalUrl = computed(() => {
  return window.location.origin + window.location.pathname;
});

const ogImage = computed(() => {
  if (images.value.length > 0 && images.value[0]) {
    const img = images.value[0];
    if (img.startsWith('http')) return img;
    if (img.startsWith('/')) return window.location.origin + img;
    return window.location.origin + '/storage/' + img;
  }
  return window.location.origin + '/logo.png';
});

const structuredData = computed(() => {
  const firstImage = images.value.length > 0 ? ogImage.value : null;
  
  return {
    '@context': 'https://schema.org',
    '@type': 'Product',
    'name': props.maison.nom || 'Bien immobilier',
    'description': props.maison.description || `${props.maison.type || 'Bien'} à louer à ${props.maison.region || 'Sénégal'}`,
    'image': firstImage ? [firstImage] : [window.location.origin + '/logo.png'],
    'offers': {
      '@type': 'Offer',
      'price': props.maison.prix || '0',
      'priceCurrency': 'XOF',
      'availability': 'https://schema.org/InStock',
      'url': canonicalUrl.value
    },
    'address': {
      '@type': 'PostalAddress',
      'addressLocality': props.maison.region || 'Sénégal',
      'addressCountry': 'SN'
    },
    ...(props.maison.surface ? {
      'floorSize': {
        '@type': 'QuantitativeValue',
        'value': props.maison.surface,
        'unitCode': 'MTK'
      }
    } : {}),
    ...(props.maison.npiece ? {
      'numberOfRooms': props.maison.npiece
    } : {})
  };
});
</script>

<template>
  <SeoHead 
    :title="`${maison.nom || 'Bien immobilier'} à ${maison.region || 'Sénégal'} - ${formatPrice(maison.prix)} FCFA`"
    :description="`${maison.nom || 'Bien immobilier'} à louer à ${maison.region || 'Sénégal'}. ${maison.npiece ? maison.npiece + ' chambre(s)' : ''} ${maison.type || ''} ${maison.surface ? 'de ' + maison.surface + 'm²' : ''}. Prix : ${formatPrice(maison.prix)} FCFA. ${maison.description ? maison.description.substring(0, 150) + '...' : ''}`"
    :keywords="`${maison.type || 'immobilier'} à louer ${maison.region || 'Sénégal'}, location ${maison.region || 'Sénégal'}, ${maison.npiece ? maison.npiece + ' chambres' : ''} ${maison.region || ''}`"
    :canonical-url="canonicalUrl"
    :og-type="'product'"
    :og-image="ogImage"
    :structured-data="structuredData"
  />

  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white border-b border-gray-200">
      <Navbar />
    </header>

    <!-- Main Content -->
    <main class="max-w-[95rem] mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <!-- Enhanced Breadcrumb -->
      <nav class="mb-6 flex items-center space-x-2 text-sm">
        <Link href="/" class="text-gray-600 hover:text-principal transition-colors duration-200 flex items-center group">
          <i class="bi bi-house-door mr-1 group-hover:translate-x-0.5 transition-transform"></i>
          Accueil
        </Link>
        <i class="bi bi-chevron-right text-gray-400 text-xs"></i>
        <span class="text-gray-500">Détails de l'annonce</span>
      </nav>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
        <!-- Left Column: Images and Details -->
        <div class="lg:col-span-2 space-y-4 sm:space-y-6">
          <!-- Image Gallery -->
          <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-md group">
            <!-- Main Image -->
            <div class="relative bg-gray-100 aspect-[4/3] overflow-hidden cursor-pointer" @click="openLightbox(currentIndex)">
              <img 
                v-if="images.length > 0"
                :src="getImageUrl(currentImage)" 
                :alt="maison.nom"
                @load="imageLoaded = true"
                @error="imageLoaded = true"
                :class="[
                  'w-full h-full object-cover transition-all duration-700',
                  imageLoaded ? 'opacity-100 scale-100' : 'opacity-0 scale-105',
                  'group-hover:scale-110'
                ]"
              >
              <div v-else class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                <div class="text-center">
                  <i class="bi bi-image text-6xl text-gray-400 mb-4"></i>
                  <p class="text-gray-500 font-medium">Aucune image disponible</p>
                </div>
              </div>
              
              <!-- Gradient overlay on hover -->
              <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
              
              <!-- Enhanced Navigation Arrows -->
              <button 
                v-if="images.length > 1"
                @click.stop="previousImage"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/95 backdrop-blur-md hover:bg-white text-gray-800 p-4 rounded-full shadow-2xl transition-all duration-300 hover:scale-110 hover:shadow-2xl opacity-0 group-hover:opacity-100 border-2 border-gray-100 z-10"
                aria-label="Image précédente"
              >
                <i class="bi bi-chevron-left text-2xl font-bold"></i>
              </button>
              <button 
                v-if="images.length > 1"
                @click.stop="nextImage"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/95 backdrop-blur-md hover:bg-white text-gray-800 p-4 rounded-full shadow-2xl transition-all duration-300 hover:scale-110 hover:shadow-2xl opacity-0 group-hover:opacity-100 border-2 border-gray-100 z-10"
                aria-label="Image suivante"
              >
                <i class="bi bi-chevron-right text-2xl font-bold"></i>
              </button>
              
              <!-- Click to expand hint -->
              <div v-if="images.length > 0" class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/70 backdrop-blur-sm text-white px-4 py-2 rounded-full text-xs font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                <i class="bi bi-arrows-angle-expand mr-2"></i>
                Cliquez pour agrandir
              </div>

              <!-- Enhanced Image Counter -->
              <div v-if="images.length > 1" class="absolute top-4 right-4 bg-gradient-to-r from-black/90 to-black/70 backdrop-blur-md text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-2xl border border-white/20">
                <i class="bi bi-images mr-2 text-yellow-400"></i>
                <span class="text-yellow-400">{{ currentIndex + 1 }}</span>
                <span class="mx-1">/</span>
                <span>{{ images.length }}</span>
              </div>

              <!-- Boost Badge with animation -->
              <div v-if="maison.booster" class="absolute top-4 left-4 animate-pulse">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-400 text-white shadow-2xl ring-2 ring-yellow-300/50">
                  <i class="bi bi-lightning-fill mr-1.5 animate-pulse"></i>
                  Boosté
                </span>
              </div>
            </div>

            <!-- Enhanced Thumbnails - Affiche toutes les images -->
            <div v-if="images.length > 1" class="p-6 border-t border-gray-200 bg-gradient-to-br from-gray-50 via-white to-gray-50">
              <div class="mb-4 flex items-center justify-between">
                <p class="text-sm font-bold text-gray-800 flex items-center">
                  <i class="bi bi-images mr-2 text-principal text-lg"></i>
                  {{ images.length }} photo{{ images.length > 1 ? 's' : '' }} disponible{{ images.length > 1 ? 's' : '' }}
                </p>
                <button 
                  @click="openLightbox(currentIndex)"
                  class="text-xs text-principal hover:text-principal-dark font-semibold flex items-center group transition-colors"
                >
                  <i class="bi bi-arrows-angle-expand mr-1 group-hover:scale-110 transition-transform"></i>
                  Voir toutes
                </button>
              </div>
              <div class="flex space-x-3 overflow-x-auto scrollbar-hide pb-2">
                <button
                  v-for="(image, index) in images"
                  :key="index"
                  @click="goToImage(index)"
                  :class="[
                    'relative flex-shrink-0 w-28 h-28 rounded-2xl border-3 overflow-hidden transition-all duration-300 transform cursor-pointer',
                    currentIndex === index 
                      ? 'border-principal ring-4 ring-principal/30 scale-110 shadow-2xl z-10' 
                      : 'border-gray-300 hover:border-principal/60 hover:scale-105 shadow-lg hover:shadow-xl'
                  ]"
                >
                  <img 
                    :src="getImageUrl(image)" 
                    :alt="`Image ${index + 1}`"
                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
                    @error="(e) => e.target.style.display = 'none'"
                  >
                  <div v-if="currentIndex === index" class="absolute inset-0 bg-gradient-to-t from-principal/20 to-transparent"></div>
                  <div v-if="currentIndex === index" class="absolute top-2 right-2 bg-principal text-white rounded-full w-7 h-7 flex items-center justify-center text-xs font-bold shadow-lg">
                    {{ index + 1 }}
                  </div>
                </button>
              </div>
            </div>
            <div v-else-if="images.length === 0" class="p-4 border-t border-gray-200 bg-gray-50 text-center">
              <p class="text-gray-500 text-sm">Aucune image disponible</p>
            </div>
          </div>

          <!-- Title and Price Section -->
          <div class="bg-white rounded-lg border border-gray-200 p-4 sm:p-6 lg:p-8 shadow-md relative overflow-hidden">
            <!-- Decorative gradient -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-principal/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <!-- Mobile: Titre et boutons empilés -->
            <div class="flex flex-col gap-4 mb-6">
              <!-- Titre -->
              <div class="flex items-start justify-between gap-3">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 leading-tight flex-1">{{ maison.nom }}</h1>
                <div class="flex items-center gap-2 flex-shrink-0">
                  <!-- Bouton Favori -->
                  <button
                    @click="toggleFavorite"
                    :class="[
                      'inline-flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl font-semibold shadow-md transition-all duration-300 hover:scale-105',
                      isFavorite
                        ? 'bg-red-500 text-white hover:bg-red-600'
                        : 'bg-white text-gray-600 border border-gray-300 sm:border-2 hover:border-red-300 hover:bg-red-50'
                    ]"
                    :aria-label="isFavorite ? 'Retirer des favoris' : 'Ajouter aux favoris'"
                  >
                    <i :class="isFavorite ? 'bi bi-heart-fill' : 'bi bi-heart'" class="text-lg sm:text-xl"></i>
                  </button>
                  <!-- Bouton Modifier (si propriétaire) -->
                  <Link 
                    v-if="isOwner"
                    :href="`/update/immobilier/${maison.id}`"
                    class="hidden sm:inline-flex items-center px-4 sm:px-5 py-2 sm:py-2.5 bg-gradient-to-r from-principal to-principal-dark hover:from-principal-dark hover:to-principal text-white rounded-lg sm:rounded-xl font-semibold shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105 group text-sm sm:text-base"
                  >
                    <i class="bi bi-pencil-square mr-1 sm:mr-2 group-hover:rotate-12 transition-transform"></i>
                    <span class="hidden sm:inline">Modifier</span>
                  </Link>
                </div>
              </div>

              <!-- Info secondaire -->
              <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 text-xs sm:text-sm text-gray-600">
                <span class="flex items-center">
                  <i class="bi bi-geo-alt-fill mr-1.5 text-principal"></i>
                  <span class="font-medium">{{ maison.lieu || maison.region }}, Sénégal</span>
                </span>
                <span v-if="maison.created_at" class="flex items-center">
                  <i class="bi bi-calendar3 mr-1.5 text-gray-400"></i>
                  Publié {{ formatDate(maison.created_at) }}
                </span>
              </div>

              <!-- Prix - Réorganisé -->
              <div class="bg-gradient-to-br from-principal via-principal/90 to-principal-dark rounded-lg sm:rounded-xl p-3 sm:p-6 border border-principal/30 shadow-md relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent"></div>
                <div class="relative z-10">
                  <p class="text-3xl sm:text-4xl lg:text-5xl font-black text-white drop-shadow-lg">
                    {{ formatPrice(maison.prix) }}
                  </p>
                  <p class="text-xs sm:text-sm text-white/80 font-bold mt-1.5 sm:mt-2">
                    <span class="bg-white/20 px-2.5 sm:px-4 py-1 sm:py-2 rounded-full inline-block">FCFA</span>
                  </p>
                </div>
              </div>
            </div>

            <!-- Quick Info Badges - Compact sur mobile -->
            <div class="flex flex-wrap gap-2 sm:gap-3 pt-4 sm:pt-6 border-t border-gray-200">
              <span v-if="maison.type" class="inline-flex items-center px-2.5 sm:px-4 py-1.5 sm:py-2.5 rounded-lg sm:rounded-xl text-xs sm:text-sm font-semibold bg-blue-50 text-blue-700 border border-blue-200 sm:border-2 shadow-sm hover:shadow-md transition-all">
                <i class="bi bi-house-door-fill mr-1 sm:mr-2 text-sm sm:text-base"></i>
                <span class="hidden sm:inline">{{ maison.type }}</span>
                <span class="sm:hidden">{{ maison.type }}</span>
              </span>
              <span v-if="maison.npiece" class="inline-flex items-center px-2.5 sm:px-4 py-1.5 sm:py-2.5 rounded-lg sm:rounded-xl text-xs sm:text-sm font-semibold bg-green-50 text-green-700 border border-green-200 sm:border-2 shadow-sm hover:shadow-md transition-all">
                <i class="bi bi-door-open-fill mr-1 sm:mr-2 text-sm sm:text-base"></i>
                {{ maison.npiece }}P
              </span>
              <span v-if="maison.surface" class="inline-flex items-center px-2.5 sm:px-4 py-1.5 sm:py-2.5 rounded-lg sm:rounded-xl text-xs sm:text-sm font-semibold bg-purple-50 text-purple-700 border border-purple-200 sm:border-2 shadow-sm hover:shadow-md transition-all">
                <i class="bi bi-rulers mr-1 sm:mr-2 text-sm sm:text-base"></i>
                {{ maison.surface }}m²
              </span>
              <span v-if="maison.affaire" class="inline-flex items-center px-2.5 sm:px-4 py-1.5 sm:py-2.5 rounded-lg sm:rounded-xl text-xs sm:text-sm font-semibold bg-orange-50 text-orange-700 border border-orange-200 sm:border-2 shadow-sm hover:shadow-md transition-all">
                <i class="bi bi-tag-fill mr-1 sm:mr-2 text-sm sm:text-base"></i>
                <span class="hidden sm:inline">{{ maison.affaire }}</span>
                <span class="sm:hidden">{{ maison.affaire }}</span>
              </span>
              <span v-if="maison.categorie" class="inline-flex items-center px-2.5 sm:px-4 py-1.5 sm:py-2.5 rounded-lg sm:rounded-xl text-xs sm:text-sm font-semibold bg-pink-50 text-pink-700 border border-pink-200 sm:border-2 shadow-sm hover:shadow-md transition-all">
                <i class="bi bi-briefcase-fill mr-1 sm:mr-2 text-sm sm:text-base"></i>
                <span class="hidden sm:inline">{{ maison.categorie }}</span>
                <span class="sm:hidden">{{ maison.categorie }}</span>
              </span>
            </div>
          </div>

          <!-- Description Section -->
          <div class="bg-white rounded-lg border border-gray-200 p-4 sm:p-6 lg:p-8 shadow-md relative overflow-hidden">
            <div class="relative z-10">
              <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-4 sm:mb-6 flex items-center">
                <i class="bi bi-file-text text-principal mr-2 sm:mr-3"></i>
                Description
              </h2>
              <div 
                :class="[
                  'text-gray-700 leading-relaxed whitespace-pre-line text-sm sm:text-base lg:text-lg',
                  !showFullDescription && maison.description?.length > 300 ? 'line-clamp-4 sm:line-clamp-5' : ''
                ]"
              >
                {{ maison.description || 'Aucune description disponible.' }}
              </div>
              <button 
                v-if="maison.description?.length > 300"
                @click="showFullDescription = !showFullDescription"
                class="mt-3 sm:mt-4 text-principal hover:text-principal-dark font-semibold text-xs sm:text-sm flex items-center group transition-colors"
              >
                <span>{{ showFullDescription ? '- Voir moins' : '+ Voir plus' }}</span>
                <i :class="[
                  'bi ml-1.5 sm:ml-2 text-xs sm:text-sm transition-transform duration-300',
                  showFullDescription ? 'bi-chevron-up' : 'bi-chevron-down',
                  'group-hover:translate-y-0.5'
                ]"></i>
              </button>
            </div>
          </div>

          <!-- Characteristics Section -->
          <div class="bg-white rounded-lg border border-gray-200 p-4 sm:p-6 lg:p-8 shadow-md relative overflow-hidden">
            <!-- Decorative gradient -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-principal/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="relative z-10">
              <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
                <div class="w-1.5 h-10 bg-gradient-to-b from-principal to-principal-dark rounded-full mr-4"></div>
                Caractéristiques
              </h2>
              <dl class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-2 gap-3 sm:gap-4">
              <div v-if="maison.type" class="flex flex-col py-3 sm:py-4 px-3 sm:px-4 border border-gray-200 sm:border-2 rounded-lg sm:rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-700 font-semibold text-xs sm:text-sm flex items-center mb-1">
                  <i class="bi bi-house-door text-principal mr-2 text-sm sm:text-lg"></i>
                  Type
                </dt>
                <dd class="text-gray-900 font-bold text-sm sm:text-base capitalize">{{ maison.type }}</dd>
              </div>
              <div v-if="maison.npiece" class="flex flex-col py-3 sm:py-4 px-3 sm:px-4 border border-gray-200 sm:border-2 rounded-lg sm:rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-700 font-semibold text-xs sm:text-sm flex items-center mb-1">
                  <i class="bi bi-door-open text-principal mr-2 text-sm sm:text-lg"></i>
                  Pièces
                </dt>
                <dd class="text-gray-900 font-bold text-sm sm:text-base">{{ maison.npiece }}</dd>
              </div>
              <div v-if="maison.surface" class="flex flex-col py-3 sm:py-4 px-3 sm:px-4 border border-gray-200 sm:border-2 rounded-lg sm:rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-700 font-semibold text-xs sm:text-sm flex items-center mb-1">
                  <i class="bi bi-rulers text-principal mr-2 text-sm sm:text-lg"></i>
                  Surface
                </dt>
                <dd class="text-gray-900 font-bold text-sm sm:text-base">{{ maison.surface }}m²</dd>
              </div>
              <div v-if="maison.region" class="flex flex-col py-3 sm:py-4 px-3 sm:px-4 border border-gray-200 sm:border-2 rounded-lg sm:rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-700 font-semibold text-xs sm:text-sm flex items-center mb-1">
                  <i class="bi bi-geo-alt text-principal mr-2 text-sm sm:text-lg"></i>
                  Région
                </dt>
                <dd class="text-gray-900 font-bold text-sm sm:text-base">{{ maison.region }}</dd>
              </div>
              <div v-if="maison.lieu" class="flex flex-col py-3 sm:py-4 px-3 sm:px-4 border border-gray-200 sm:border-2 rounded-lg sm:rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-700 font-semibold text-xs sm:text-sm flex items-center mb-1">
                  <i class="bi bi-pin-map text-principal mr-2 text-sm sm:text-lg"></i>
                  Lieu Précis
                </dt>
                <dd class="text-gray-900 font-bold text-sm sm:text-base">{{ maison.lieu }}</dd>
              </div>
              <div v-if="maison.affaire" class="flex flex-col py-3 sm:py-4 px-3 sm:px-4 border border-gray-200 sm:border-2 rounded-lg sm:rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-700 font-semibold text-xs sm:text-sm flex items-center mb-1">
                  <i class="bi bi-tag text-principal mr-2 text-sm sm:text-lg"></i>
                  État
                </dt>
                <dd class="text-gray-900 font-bold text-sm sm:text-base">{{ maison.affaire }}</dd>
              </div>
              <div v-if="maison.categorie" class="flex flex-col py-3 sm:py-4 px-3 sm:px-4 border border-gray-200 sm:border-2 rounded-lg sm:rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-700 font-semibold text-xs sm:text-sm flex items-center mb-1">
                  <i class="bi bi-briefcase text-principal mr-2 text-sm sm:text-lg"></i>
                  Catégorie
                </dt>
                <dd class="text-gray-900 font-bold text-sm sm:text-base">{{ maison.categorie }}</dd>
              </div>
              <div v-if="maison.status" class="flex flex-col py-3 sm:py-4 px-3 sm:px-4 border border-gray-200 sm:border-2 rounded-lg sm:rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-700 font-semibold text-xs sm:text-sm flex items-center mb-1">
                  <i class="bi bi-info-circle text-principal mr-2 text-sm sm:text-lg"></i>
                  Statut
                </dt>
                <dd class="font-bold text-sm sm:text-base">
                  <span :class="{
                    'text-green-600': maison.status === 'accepter',
                    'text-yellow-600': maison.status === 'pending',
                    'text-red-600': maison.status === 'Vendu'
                  }">
                    {{ maison.status === 'accepter' ? 'Dispo' : maison.status }}
                  </span>
                </dd>
              </div>
              </dl>
            </div>
          </div>
        </div>

        <!-- Right Column: Contact Card -->
        <div class="lg:col-span-1">
          <div class="sticky top-24 space-y-3 sm:space-y-4">
            <!-- Contact Card -->
            <div class="bg-white rounded-lg sm:rounded-xl border border-gray-200 sm:border-2 p-4 sm:p-6 shadow-md relative overflow-hidden">
              <div class="relative z-10">
                <!-- Titre + Vendeur Info Compacts -->
                <div class="mb-4 sm:mb-6 pb-4 sm:pb-6 border-b border-gray-200 sm:border-2">
                  <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-3 sm:mb-4 flex items-center">
                    <i class="bi bi-chat-dots text-principal mr-2 sm:mr-3 text-base sm:text-lg"></i>
                    Contacter
                  </h3>
                  
                  <!-- Seller Info -->
                  <div class="flex items-center space-x-3 sm:space-x-4">
                    <div class="relative flex-shrink-0">
                      <div class="w-12 sm:w-16 h-12 sm:h-16 bg-gradient-to-br from-principal/20 to-principal/10 rounded-full flex items-center justify-center ring-2 sm:ring-4 ring-principal/10">
                        <i class="bi bi-person-fill text-principal text-lg sm:text-2xl"></i>
                      </div>
                      <div class="absolute -bottom-1 -right-1 w-4 h-4 sm:w-6 sm:h-6 bg-green-500 rounded-full border-2 sm:border-3 border-white"></div>
                    </div>
                    <div>
                      <p class="font-bold text-gray-900 text-sm sm:text-base lg:text-lg">{{ nameSeler }}</p>
                      <p class="text-xs sm:text-sm text-gray-500">Vendeur vérifié</p>
                    </div>
                  </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-2 sm:space-y-3">
                  <!-- Bouton Favori -->
                  <button 
                    @click="toggleFavorite"
                    :class="[
                      'w-full py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.01] flex items-center justify-center space-x-2',
                      isFavorite
                        ? 'bg-red-500 text-white hover:bg-red-600'
                        : 'bg-white border border-red-300 sm:border-2 text-red-500 hover:bg-red-50'
                    ]"
                  >
                    <i :class="isFavorite ? 'bi bi-heart-fill' : 'bi bi-heart'" class="text-base sm:text-lg"></i>
                    <span class="hidden sm:inline">{{ isFavorite ? 'Favoris' : 'Ajouter favoris' }}</span>
                    <span class="sm:hidden">{{ isFavorite ? '✓' : '♡' }}</span>
                  </button>
                  
                  <button 
                    @click="ouvrirWhatsApp"
                    class="w-full bg-gradient-to-r from-principal via-principal-dark to-principal text-white py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.01] flex items-center justify-center space-x-1.5 sm:space-x-2 group relative overflow-hidden"
                  >
                    <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></span>
                    <i class="bi bi-whatsapp text-base sm:text-lg relative z-10"></i>
                    <span class="relative z-10">WhatsApp</span>
                  </button>
                  
                  <button 
                    @click="afficherNumero"
                    class="w-full border border-principal sm:border-2 text-principal hover:bg-principal hover:text-white py-2.5 sm:py-3 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm transition-all duration-300 hover:scale-[1.01] flex items-center justify-center space-x-1.5 sm:space-x-2 shadow-sm hover:shadow-md"
                  >
                    <i class="bi bi-telephone text-base sm:text-lg"></i>
                    <span>Voir n°</span>
                  </button>
                </div>

                <!-- Email if available -->
                <div v-if="mailSeler" class="mt-4 sm:mt-5 pt-4 sm:pt-5 border-t border-gray-200 sm:border-2">
                  <p class="text-xs sm:text-sm text-gray-600 mb-2 font-semibold">Email</p>
                  <a :href="`mailto:${mailSeler}`" class="text-principal hover:text-principal-dark font-semibold text-xs sm:text-sm break-all flex items-center group">
                    <i class="bi bi-envelope mr-1.5 sm:mr-2 text-sm sm:text-base group-hover:scale-110 transition-transform"></i>
                    {{ mailSeler }}
                  </a>
                </div>
              </div>
            </div>

            <!-- Safety Notice -->
            <div class="bg-yellow-50 border border-yellow-200 sm:border-2 rounded-lg sm:rounded-xl p-3 sm:p-4 shadow-sm">
              <div class="flex items-start space-x-2 sm:space-x-3">
                <div class="w-8 sm:w-10 h-8 sm:h-10 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0 shadow-sm">
                  <i class="bi bi-shield-exclamation text-yellow-900 text-sm sm:text-base"></i>
                </div>
                <div>
                  <p class="text-xs sm:text-sm font-bold text-yellow-900 mb-1">Sécurité</p>
                  <p class="text-xs text-yellow-800 leading-relaxed">
                    Évitez les paiements anticipés. Visitez avant engagement.
                  </p>
                </div>
              </div>
            </div>

            <!-- Report Button -->
            <button class="w-full text-xs sm:text-sm text-gray-500 hover:text-gray-700 text-center py-2.5 sm:py-3 rounded-lg sm:rounded-xl hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center space-x-2">
              <i class="bi bi-flag text-sm sm:text-base"></i>
              <span>Signaler</span>
            </button>
          </div>
        </div>
      </div>

      <!-- Similar Properties Section -->
      <section v-if="suggestions && suggestions.length > 0" class="mt-8 sm:mt-12 lg:mt-16">
        <div class="bg-white rounded-lg sm:rounded-xl border border-gray-200 sm:border-2 p-4 sm:p-6 lg:p-8 shadow-md">
          <h2 class="text-lg sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-4 sm:mb-6 lg:mb-8 flex items-center">
            <i class="bi bi-collection text-principal mr-2 sm:mr-3 text-base sm:text-lg"></i>
            Annonces similaires
          </h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 lg:gap-6">
            <div
              v-for="suggestion in suggestions"
              :key="suggestion.id"
              @click="navigateToDetail(suggestion.id)"
              class="group cursor-pointer bg-white border border-gray-200 sm:border-2 rounded-lg sm:rounded-xl overflow-hidden hover:border-principal hover:shadow-lg transition-all duration-300 hover:-translate-y-1"
            >
              <div class="relative aspect-video bg-gray-100 overflow-hidden">
                <img 
                  :src="'/storage/' + suggestion.image1" 
                  :alt="suggestion.nom"
                  class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div v-if="suggestion.booster" class="absolute top-2 sm:top-3 right-2 sm:right-3">
                  <span class="inline-flex items-center px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-full text-xs font-bold bg-yellow-400 text-white shadow-md">
                    <i class="bi bi-lightning-fill mr-0.5 sm:mr-1 text-xs"></i>
                    <span class="hidden sm:inline">Boost</span>
                  </span>
                </div>
              </div>
              <div class="p-3 sm:p-4">
                <h3 class="font-bold text-xs sm:text-sm text-gray-900 mb-1.5 sm:mb-2 line-clamp-2 min-h-[2rem] sm:min-h-[2.5rem] group-hover:text-principal transition-colors">{{ suggestion.nom }}</h3>
                <p class="text-principal font-bold text-sm sm:text-base mb-1.5 sm:mb-2">
                  {{ formatPrice(suggestion.prix) }} <span class="text-xs text-gray-600 font-normal">FCFA</span>
                </p>
                <p class="text-xs text-gray-600 flex items-center">
                  <i class="bi bi-geo-alt text-principal mr-1"></i>
                  {{ suggestion.region }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Enhanced Mobile Fixed Bottom Bar -->
    <div class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t-2 border-gray-200 p-4 z-50 lg:hidden shadow-2xl">
      <div class="flex space-x-3 max-w-7xl mx-auto">
        <button
          @click="afficherNumero"
          class="flex-1 bg-white border-2 border-principal text-principal py-3 rounded-xl font-bold text-sm flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl transition-all hover:scale-105"
        >
          <i class="bi bi-telephone text-lg"></i>
          <span>Appeler</span>
        </button>
        <button
          @click="ouvrirWhatsApp"
          class="flex-1 bg-gradient-to-r from-principal to-principal-dark text-white py-3 rounded-xl font-bold text-sm flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl transition-all hover:scale-105"
        >
          <i class="bi bi-whatsapp text-lg"></i>
          <span>WhatsApp</span>
        </button>
      </div>
    </div>

    <!-- Enhanced Lightbox -->
    <Transition name="lightbox">
      <div
        v-if="showLightbox"
        class="fixed inset-0 bg-black/95 backdrop-blur-md z-[100] flex items-center justify-center p-4"
        @click.self="closeLightbox"
      >
        <button
          @click="closeLightbox"
          class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors p-3 bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-sm z-10"
          aria-label="Fermer"
        >
          <i class="bi bi-x-lg text-2xl"></i>
        </button>
        
        <button
          v-if="images.length > 1"
          @click.stop="previousLightboxImage"
          class="absolute left-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 transition-colors p-4 bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-sm z-10"
          aria-label="Image précédente"
        >
          <i class="bi bi-chevron-left text-3xl font-bold"></i>
        </button>
        
        <button
          v-if="images.length > 1"
          @click.stop="nextLightboxImage"
          class="absolute right-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 transition-colors p-4 bg-white/10 hover:bg-white/20 rounded-full backdrop-blur-sm z-10"
          aria-label="Image suivante"
        >
          <i class="bi bi-chevron-right text-3xl font-bold"></i>
        </button>
        
        <div class="max-w-7xl w-full h-full flex items-center justify-center">
          <img
            v-if="images.length > 0"
            :src="getImageUrl(images[lightboxIndex])"
            :alt="`Image ${lightboxIndex + 1}`"
            class="max-w-full max-h-full object-contain rounded-lg shadow-2xl"
          />
        </div>
        
        <div v-if="images.length > 1" class="absolute bottom-8 left-1/2 -translate-x-1/2 bg-black/80 backdrop-blur-md text-white px-6 py-3 rounded-full text-sm font-bold shadow-2xl border border-white/20">
          <i class="bi bi-images mr-2 text-yellow-400"></i>
          <span class="text-yellow-400">{{ lightboxIndex + 1 }}</span>
          <span class="mx-2">/</span>
          <span>{{ images.length }}</span>
        </div>
      </div>
    </Transition>

    <!-- Enhanced Phone Number Popup -->
    <Transition name="popup">
      <div
        v-if="afficherPopup"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        @click.self="fermerPopup"
      >
        <div class="bg-white rounded-2xl p-6 max-w-sm w-full shadow-2xl transform transition-all">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900">Numéro de téléphone</h3>
            <button
              @click="fermerPopup"
              class="text-gray-400 hover:text-gray-600 transition-colors p-1 hover:bg-gray-100 rounded-full"
            >
              <i class="bi bi-x-lg text-xl"></i>
            </button>
          </div>
          <div class="bg-gradient-to-br from-yellow-50 to-orange-50 border-2 border-yellow-200 rounded-xl p-4 mb-4">
            <div class="flex items-start space-x-2">
              <i class="bi bi-exclamation-triangle text-yellow-600 text-lg mt-0.5"></i>
              <p class="text-xs text-yellow-800 leading-relaxed">
                Évitez les paiements anticipés. Visitez le bien avant tout engagement financier.
              </p>
            </div>
          </div>
          <div class="text-center py-6">
            <a
              :href="`tel:${phoneSeler}`"
              class="text-3xl font-bold bg-gradient-to-r from-principal to-principal-dark bg-clip-text text-transparent hover:scale-105 transition-transform inline-block"
            >
              {{ phoneSeler }}
            </a>
          </div>
          <div class="flex space-x-3">
            <a
              :href="`tel:${phoneSeler}`"
              class="flex-1 bg-gradient-to-r from-principal to-principal-dark text-white py-3 rounded-xl font-bold text-center hover:shadow-xl transition-all hover:scale-105"
            >
              <i class="bi bi-telephone mr-2"></i>Appeler
            </a>
            <button
              @click="ouvrirWhatsApp"
              class="flex-1 bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-xl font-bold hover:shadow-xl transition-all hover:scale-105"
            >
              <i class="bi bi-whatsapp mr-2"></i>WhatsApp
            </button>
          </div>
        </div>
      </div>
    </Transition>

    <!-- Footer -->
    <div class="mt-16 pb-24 lg:pb-12">
      <Footer />
    </div>
    
    <!-- Toast Notification -->
    <Toast 
      :show="showToast" 
      :message="toastMessage" 
      :type="toastType"
      @close="closeToast"
    />
  </div>
</template>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-6 {
  display: -webkit-box;
  -webkit-line-clamp: 6;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

.scrollbar-hide::-webkit-scrollbar {
  display: none;
}

/* Popup transition */
.popup-enter-active,
.popup-leave-active {
  transition: all 0.3s ease;
}

.popup-enter-from,
.popup-leave-to {
  opacity: 0;
  transform: scale(0.9);
}

.popup-enter-to,
.popup-leave-from {
  opacity: 1;
  transform: scale(1);
}

/* Lightbox transition */
.lightbox-enter-active,
.lightbox-leave-active {
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.lightbox-enter-from,
.lightbox-leave-to {
  opacity: 0;
}

.lightbox-enter-to,
.lightbox-leave-from {
  opacity: 1;
}

/* Smooth animations */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fadeIn 0.5s ease-out;
}
</style>
