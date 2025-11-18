<script setup>
import { Head, Link, router, usePage } from '@inertiajs/vue3';
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
</script>

<template>
  <Head>
    <title>{{ maison.nom }} - Détails</title>
  </Head>

  <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50">
    <!-- Enhanced Header with scroll effect -->
    <header 
      :class="[
        'sticky top-0 z-50 transition-all duration-300',
        isScrolled ? 'bg-white/95 backdrop-blur-md shadow-lg' : 'bg-white border-b border-gray-200'
      ]"
    >
      <Navbar />
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Enhanced Breadcrumb -->
      <nav class="mb-6 flex items-center space-x-2 text-sm">
        <Link href="/" class="text-gray-600 hover:text-principal transition-colors duration-200 flex items-center group">
          <i class="bi bi-house-door mr-1 group-hover:translate-x-0.5 transition-transform"></i>
          Accueil
        </Link>
        <i class="bi bi-chevron-right text-gray-400 text-xs"></i>
        <span class="text-gray-500">Détails de l'annonce</span>
      </nav>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
        <!-- Left Column: Images and Details -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Enhanced Image Gallery -->
          <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group">
            <!-- Main Image with enhanced effects -->
            <div class="relative bg-gradient-to-br from-gray-100 to-gray-200 aspect-[4/3] overflow-hidden">
              <img 
                v-if="images.length > 0"
                :src="getImageUrl(currentImage)" 
                :alt="maison.nom"
                @load="imageLoaded = true"
                @error="imageLoaded = true"
                :class="[
                  'w-full h-full object-cover transition-all duration-700',
                  imageLoaded ? 'opacity-100 scale-100' : 'opacity-0 scale-105',
                  'group-hover:scale-105'
                ]"
              >
              <div v-else class="w-full h-full flex items-center justify-center bg-gray-200">
                <p class="text-gray-500">Aucune image disponible</p>
              </div>
              
              <!-- Gradient overlay on hover -->
              <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
              
              <!-- Enhanced Navigation Arrows -->
              <button 
                v-if="images.length > 1"
                @click="previousImage"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/95 backdrop-blur-sm hover:bg-white text-gray-800 p-3 rounded-full shadow-xl transition-all duration-300 hover:scale-110 hover:shadow-2xl opacity-0 group-hover:opacity-100"
                aria-label="Image précédente"
              >
                <i class="bi bi-chevron-left text-xl"></i>
              </button>
              <button 
                v-if="images.length > 1"
                @click="nextImage"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/95 backdrop-blur-sm hover:bg-white text-gray-800 p-3 rounded-full shadow-xl transition-all duration-300 hover:scale-110 hover:shadow-2xl opacity-0 group-hover:opacity-100"
                aria-label="Image suivante"
              >
                <i class="bi bi-chevron-right text-xl"></i>
              </button>

              <!-- Enhanced Image Counter -->
              <div v-if="images.length > 1" class="absolute bottom-4 right-4 bg-black/80 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium shadow-xl">
                <i class="bi bi-images mr-2"></i>
                {{ currentIndex + 1 }} / {{ images.length }}
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
            <div v-if="images.length > 1" class="p-4 border-t border-gray-200 bg-gradient-to-r from-gray-50 to-white">
              <div class="mb-2 flex items-center justify-between">
                <p class="text-sm font-semibold text-gray-700">
                  <i class="bi bi-images mr-2 text-principal"></i>
                  {{ images.length }} photo{{ images.length > 1 ? 's' : '' }}
                </p>
              </div>
              <div class="flex space-x-3 overflow-x-auto scrollbar-hide pb-2">
                <button
                  v-for="(image, index) in images"
                  :key="index"
                  @click="goToImage(index)"
                  :class="[
                    'relative flex-shrink-0 w-24 h-24 rounded-xl border-2 overflow-hidden transition-all duration-300 transform',
                    currentIndex === index 
                      ? 'border-principal ring-4 ring-principal/20 scale-105 shadow-lg z-10' 
                      : 'border-gray-300 hover:border-principal/50 hover:scale-105 shadow-md hover:shadow-lg'
                  ]"
                >
                  <img 
                    :src="getImageUrl(image)" 
                    :alt="`Image ${index + 1}`"
                    class="w-full h-full object-cover"
                    @error="(e) => e.target.style.display = 'none'"
                  >
                  <div v-if="currentIndex === index" class="absolute inset-0 bg-principal/10"></div>
                  <div v-if="currentIndex === index" class="absolute top-1 right-1 bg-principal text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">
                    {{ index + 1 }}
                  </div>
                </button>
              </div>
            </div>
            <div v-else-if="images.length === 0" class="p-4 border-t border-gray-200 bg-gray-50 text-center">
              <p class="text-gray-500 text-sm">Aucune image disponible</p>
            </div>
          </div>

          <!-- Enhanced Title and Price Section -->
          <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-start justify-between mb-6">
              <div class="flex-1 pr-4">
                <div class="flex items-start justify-between mb-3 gap-4">
                  <h1 class="text-3xl font-bold text-gray-900 leading-tight flex-1">{{ maison.nom }}</h1>
                  <div class="flex items-center gap-3">
                    <!-- Bouton Favori -->
                    <button
                      @click="toggleFavorite"
                      :class="[
                        'flex-shrink-0 inline-flex items-center justify-center w-12 h-12 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105',
                        isFavorite
                          ? 'bg-red-500 text-white hover:bg-red-600'
                          : 'bg-white text-gray-600 border-2 border-gray-300 hover:border-red-300 hover:bg-red-50'
                      ]"
                      :aria-label="isFavorite ? 'Retirer des favoris' : 'Ajouter aux favoris'"
                    >
                      <i :class="isFavorite ? 'bi bi-heart-fill' : 'bi bi-heart'" class="text-xl"></i>
                    </button>
                    <!-- Bouton Modifier (si propriétaire) -->
                    <Link 
                      v-if="isOwner"
                      :href="`/update/immobilier/${maison.id}`"
                      class="flex-shrink-0 inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-principal to-principal-dark hover:from-principal-dark hover:to-principal text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 group"
                    >
                      <i class="bi bi-pencil-square mr-2 group-hover:rotate-12 transition-transform"></i>
                      Modifier l'annonce
                    </Link>
                  </div>
                </div>
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                  <span class="flex items-center group">
                    <i class="bi bi-geo-alt-fill mr-2 text-principal group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">{{ maison.region }}, Sénégal</span>
                  </span>
                  <span v-if="maison.created_at" class="flex items-center">
                    <i class="bi bi-calendar3 mr-2 text-gray-400"></i>
                    Publié le {{ formatDate(maison.created_at) }}
                  </span>
                </div>
              </div>
              <div class="text-right bg-gradient-to-br from-principal/10 to-principal/5 rounded-2xl p-4 border border-principal/20">
                <p class="text-4xl font-bold bg-gradient-to-r from-principal to-principal-dark bg-clip-text text-transparent">
                  {{ formatPrice(maison.prix) }}
                </p>
                <p class="text-sm text-gray-600 font-medium mt-1">FCFA</p>
              </div>
            </div>

            <!-- Enhanced Quick Info Badges -->
            <div class="flex flex-wrap gap-3 pt-6 border-t border-gray-200">
              <span v-if="maison.type" class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 border border-blue-200 shadow-sm hover:shadow-md transition-all hover:scale-105">
                <i class="bi bi-house-door-fill mr-2"></i>
                {{ maison.type }}
              </span>
              <span v-if="maison.npiece" class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium bg-gradient-to-r from-green-50 to-green-100 text-green-700 border border-green-200 shadow-sm hover:shadow-md transition-all hover:scale-105">
                <i class="bi bi-door-open-fill mr-2"></i>
                {{ maison.npiece }} pièce{{ maison.npiece > 1 ? 's' : '' }}
              </span>
              <span v-if="maison.surface" class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium bg-gradient-to-r from-purple-50 to-purple-100 text-purple-700 border border-purple-200 shadow-sm hover:shadow-md transition-all hover:scale-105">
                <i class="bi bi-rulers mr-2"></i>
                {{ maison.surface }} m²
              </span>
              <span v-if="maison.affaire" class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium bg-gradient-to-r from-orange-50 to-orange-100 text-orange-700 border border-orange-200 shadow-sm hover:shadow-md transition-all hover:scale-105">
                <i class="bi bi-tag-fill mr-2"></i>
                {{ maison.affaire }}
              </span>
              <span v-if="maison.categorie" class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium bg-gradient-to-r from-pink-50 to-pink-100 text-pink-700 border border-pink-200 shadow-sm hover:shadow-md transition-all hover:scale-105">
                <i class="bi bi-briefcase-fill mr-2"></i>
                {{ maison.categorie }}
              </span>
            </div>
          </div>

          <!-- Enhanced Description Section -->
          <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-lg hover:shadow-xl transition-all duration-300">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
              <div class="w-1 h-8 bg-gradient-to-b from-principal to-principal-dark rounded-full mr-3"></div>
              Description
            </h2>
            <div 
              :class="[
                'text-gray-700 leading-relaxed whitespace-pre-line text-base',
                !showFullDescription && maison.description?.length > 300 ? 'line-clamp-6' : ''
              ]"
            >
              {{ maison.description || 'Aucune description disponible.' }}
            </div>
            <button 
              v-if="maison.description?.length > 300"
              @click="showFullDescription = !showFullDescription"
              class="mt-4 text-principal hover:text-principal-dark font-semibold text-sm flex items-center group transition-colors"
            >
              <span>{{ showFullDescription ? 'Voir moins' : 'Voir plus' }}</span>
              <i :class="[
                'bi ml-2 transition-transform duration-300',
                showFullDescription ? 'bi-chevron-up' : 'bi-chevron-down',
                'group-hover:translate-y-0.5'
              ]"></i>
            </button>
          </div>

          <!-- Enhanced Characteristics Section -->
          <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-lg hover:shadow-xl transition-all duration-300">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
              <div class="w-1 h-8 bg-gradient-to-b from-principal to-principal-dark rounded-full mr-3"></div>
              Caractéristiques
            </h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div v-if="maison.type" class="flex justify-between items-center py-3 px-4 border border-gray-100 rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-600 font-medium flex items-center">
                  <i class="bi bi-house-door text-principal mr-2 group-hover:scale-110 transition-transform"></i>
                  Type
                </dt>
                <dd class="text-gray-900 font-bold capitalize">{{ maison.type }}</dd>
              </div>
              <div v-if="maison.npiece" class="flex justify-between items-center py-3 px-4 border border-gray-100 rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-600 font-medium flex items-center">
                  <i class="bi bi-door-open text-principal mr-2 group-hover:scale-110 transition-transform"></i>
                  Nombre de pièces
                </dt>
                <dd class="text-gray-900 font-bold">{{ maison.npiece }}</dd>
              </div>
              <div v-if="maison.surface" class="flex justify-between items-center py-3 px-4 border border-gray-100 rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-600 font-medium flex items-center">
                  <i class="bi bi-rulers text-principal mr-2 group-hover:scale-110 transition-transform"></i>
                  Surface
                </dt>
                <dd class="text-gray-900 font-bold">{{ maison.surface }} m²</dd>
              </div>
              <div v-if="maison.region" class="flex justify-between items-center py-3 px-4 border border-gray-100 rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-600 font-medium flex items-center">
                  <i class="bi bi-geo-alt text-principal mr-2 group-hover:scale-110 transition-transform"></i>
                  Localisation
                </dt>
                <dd class="text-gray-900 font-bold">{{ maison.region }}, Sénégal</dd>
              </div>
              <div v-if="maison.affaire" class="flex justify-between items-center py-3 px-4 border border-gray-100 rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-600 font-medium flex items-center">
                  <i class="bi bi-tag text-principal mr-2 group-hover:scale-110 transition-transform"></i>
                  État
                </dt>
                <dd class="text-gray-900 font-bold">{{ maison.affaire }}</dd>
              </div>
              <div v-if="maison.categorie" class="flex justify-between items-center py-3 px-4 border border-gray-100 rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-600 font-medium flex items-center">
                  <i class="bi bi-briefcase text-principal mr-2 group-hover:scale-110 transition-transform"></i>
                  Catégorie
                </dt>
                <dd class="text-gray-900 font-bold">{{ maison.categorie }}</dd>
              </div>
              <div v-if="maison.status" class="flex justify-between items-center py-3 px-4 border border-gray-100 rounded-xl hover:border-principal/30 hover:bg-principal/5 transition-all duration-200 group">
                <dt class="text-gray-600 font-medium flex items-center">
                  <i class="bi bi-info-circle text-principal mr-2 group-hover:scale-110 transition-transform"></i>
                  Statut
                </dt>
                <dd class="font-bold">
                  <span :class="{
                    'text-green-600': maison.status === 'accepter',
                    'text-yellow-600': maison.status === 'pending',
                    'text-red-600': maison.status === 'Vendu'
                  }">
                    {{ maison.status === 'accepter' ? 'Disponible' : maison.status }}
                  </span>
                </dd>
              </div>
            </dl>
          </div>
        </div>

        <!-- Right Column: Enhanced Contact Card -->
        <div class="lg:col-span-1">
          <div class="sticky top-24 space-y-4">
            <!-- Enhanced Contact Card -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-xl hover:shadow-2xl transition-all duration-300">
              <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <div class="w-1 h-6 bg-gradient-to-b from-principal to-principal-dark rounded-full mr-2"></div>
                Contacter le vendeur
              </h3>
              
              <!-- Enhanced Seller Info -->
              <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-gray-200">
                <div class="relative">
                  <div class="w-16 h-16 bg-gradient-to-br from-principal/20 to-principal/10 rounded-full flex items-center justify-center ring-4 ring-principal/10">
                    <i class="bi bi-person-fill text-principal text-2xl"></i>
                  </div>
                  <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white"></div>
                </div>
                <div>
                  <p class="font-bold text-gray-900 text-lg">{{ nameSeler }}</p>
                  <p class="text-sm text-gray-500">Vendeur vérifié</p>
                </div>
              </div>

              <!-- Enhanced Action Buttons -->
              <div class="space-y-3">
                <!-- Bouton Favori -->
                <button 
                  @click="toggleFavorite"
                  :class="[
                    'w-full py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02] flex items-center justify-center space-x-2',
                    isFavorite
                      ? 'bg-red-500 text-white hover:bg-red-600'
                      : 'bg-white border-2 border-red-300 text-red-500 hover:bg-red-50'
                  ]"
                >
                  <i :class="isFavorite ? 'bi bi-heart-fill' : 'bi bi-heart'" class="text-xl"></i>
                  <span>{{ isFavorite ? 'Retiré des favoris' : 'Ajouter aux favoris' }}</span>
                </button>
                
                <button 
                  @click="ouvrirWhatsApp"
                  class="w-full bg-gradient-to-r from-principal via-principal-dark to-principal text-white py-4 rounded-xl font-bold shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] flex items-center justify-center space-x-2 group relative overflow-hidden"
                >
                  <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></span>
                  <i class="bi bi-whatsapp text-xl relative z-10"></i>
                  <span class="relative z-10">Contacter par WhatsApp</span>
                </button>
                <button 
                  @click="afficherNumero"
                  class="w-full border-2 border-principal text-principal hover:bg-principal hover:text-white py-4 rounded-xl font-bold transition-all duration-300 hover:scale-[1.02] flex items-center justify-center space-x-2 shadow-md hover:shadow-lg"
                >
                  <i class="bi bi-telephone text-xl"></i>
                  <span>Voir le numéro</span>
                </button>
              </div>

              <!-- Enhanced Email if available -->
              <div v-if="mailSeler" class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-600 mb-2 font-medium">Email</p>
                <a :href="`mailto:${mailSeler}`" class="text-principal hover:text-principal-dark font-semibold text-sm break-all flex items-center group">
                  <i class="bi bi-envelope mr-2 group-hover:scale-110 transition-transform"></i>
                  {{ mailSeler }}
                </a>
              </div>
            </div>

            <!-- Enhanced Safety Notice -->
            <div class="bg-gradient-to-br from-yellow-50 via-yellow-50/50 to-orange-50 border-2 border-yellow-200 rounded-2xl p-5 shadow-lg">
              <div class="flex items-start space-x-3">
                <div class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
                  <i class="bi bi-shield-exclamation text-yellow-900 text-lg"></i>
                </div>
                <div>
                  <p class="text-sm font-bold text-yellow-900 mb-1">Conseil de sécurité</p>
                  <p class="text-xs text-yellow-800 leading-relaxed">
                    Évitez les paiements anticipés. Visitez le bien avant tout engagement financier.
                  </p>
                </div>
              </div>
            </div>

            <!-- Report Button -->
            <button class="w-full text-sm text-gray-500 hover:text-gray-700 text-center py-3 rounded-xl hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center space-x-2">
              <i class="bi bi-flag"></i>
              <span>Signaler cette annonce</span>
            </button>
          </div>
        </div>
      </div>

      <!-- Enhanced Similar Properties Section -->
      <section v-if="suggestions && suggestions.length > 0" class="mt-12">
        <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-xl">
          <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
            <div class="w-1 h-8 bg-gradient-to-b from-principal to-principal-dark rounded-full mr-3"></div>
            Annonces similaires
          </h2>
          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            <div
              v-for="suggestion in suggestions"
              :key="suggestion.id"
              @click="navigateToDetail(suggestion.id)"
              class="group cursor-pointer bg-white border-2 border-gray-200 rounded-2xl overflow-hidden hover:border-principal hover:shadow-2xl transition-all duration-300 hover:-translate-y-2"
            >
              <div class="relative aspect-video bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                <img 
                  :src="'/storage/' + suggestion.image1" 
                  :alt="suggestion.nom"
                  class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div v-if="suggestion.booster" class="absolute top-3 right-3">
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-400 to-yellow-500 text-white shadow-lg">
                    <i class="bi bi-lightning-fill mr-1"></i>
                    Boost
                  </span>
                </div>
              </div>
              <div class="p-4">
                <h3 class="font-bold text-sm text-gray-900 mb-2 line-clamp-2 min-h-[2.5rem] group-hover:text-principal transition-colors">{{ suggestion.nom }}</h3>
                <p class="text-principal font-bold text-lg mb-2">
                  {{ formatPrice(suggestion.prix) }} <span class="text-xs text-gray-600 font-normal">FCFA</span>
                </p>
                <p class="text-xs text-gray-600 flex items-center">
                  <i class="bi bi-geo-alt text-principal mr-1.5"></i>
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
