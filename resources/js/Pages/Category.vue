<template>
    <SeoHead 
        :title="`${getCategoryName()} à louer au Sénégal - NoflayHub`"
        :description="`Trouvez ${getCategoryName().toLowerCase()} à louer au Sénégal. ${total ? formatNumber(total) + ' annonces' : 'Des centaines d\'annonces'} disponibles dans toutes les régions. Prix, surface, nombre de pièces : filtrez selon vos besoins.`"
        :keywords="`${getCategoryName().toLowerCase()} à louer Sénégal, location ${getCategoryName().toLowerCase()}, ${getCategoryName().toLowerCase()} Dakar, ${getCategoryName().toLowerCase()} Thiès, immobilier Sénégal`"
        :canonical-url="canonicalUrl"
        :og-type="'website'"
        :structured-data="structuredData"
    />

    <Navbar class="relative" />
    
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
        <!-- Hero Section de la catégorie -->
        <section class="bg-gradient-to-br from-principal via-principal/90 to-secondaire text-white py-12 sm:py-16">
            <div class="max-w-[95rem] mx-auto px-3 sm:px-6 lg:px-12">
                <div class="text-center">
                    <h1 class="text-2xl sm:text-4xl md:text-5xl font-bold mb-2 sm:mb-4">
                        {{ getCategoryName() }}
                    </h1>
                    <p class="text-sm sm:text-lg md:text-xl text-white/90">
                        {{ formatNumber(total) }} {{ total > 1 ? 'biens disponibles' : 'bien disponible' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Contenu principal avec sidebar -->
        <div class="max-w-[95rem] mx-auto px-3 sm:px-6 lg:px-12 py-6 sm:py-12">
            <div class="flex flex-col lg:flex-row gap-4 sm:gap-6 lg:gap-10">
                <!-- Sidebar avec filtres -->
                <aside class="lg:w-1/4 w-full">
                    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 lg:p-8 sticky top-16 sm:top-20 lg:top-24">
                        <div class="flex items-center justify-between mb-4 sm:mb-6">
                            <h3 class="text-base sm:text-lg lg:text-xl font-bold text-secondaire">Filtres</h3>
                            <button 
                                @click="resetFilters"
                                class="text-xs sm:text-sm text-principal hover:text-principal/80 font-semibold">
                                Réinitialiser
                            </button>
                        </div>
                        
                        <form @submit.prevent="applyFilters" class="space-y-4 sm:space-y-5 lg:space-y-6">
                            <!-- Filtre Prix -->
                            <div>
                                <label class="block text-xs sm:text-sm font-semibold text-secondaire mb-2 sm:mb-3">
                                    <i class="fas fa-money-bill-wave mr-2 text-principal"></i>
                                    Prix (FCFA)
                                </label>
                                <div class="grid grid-cols-2 gap-2 sm:gap-3">
                                    <div>
                                        <input 
                                            type="number" 
                                            v-model.number="filters.min_price"
                                            :placeholder="formatNumber(priceRange?.min_price || 0)"
                                            class="w-full px-2 sm:px-3 lg:px-4 py-1.5 sm:py-2 border border-gray-300 rounded-lg text-xs sm:text-sm focus:ring-2 focus:ring-principal focus:border-transparent"
                                            min="0">
                                        <span class="text-xs text-gray-500 mt-1 block">Min</span>
                                    </div>
                                    <div>
                                        <input 
                                            type="number" 
                                            v-model.number="filters.max_price"
                                            :placeholder="formatNumber(priceRange?.max_price || 0)"
                                            class="w-full px-2 sm:px-3 lg:px-4 py-1.5 sm:py-2 border border-gray-300 rounded-lg text-xs sm:text-sm focus:ring-2 focus:ring-principal focus:border-transparent"
                                            min="0">
                                        <span class="text-xs text-gray-500 mt-1 block">Max</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Filtre Surface -->
                            <div>
                                <label class="block text-sm font-semibold text-secondaire mb-3">
                                    <i class="fas fa-ruler-combined mr-2 text-principal"></i>
                                    Surface (m²)
                                </label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <input 
                                            type="number" 
                                            v-model.number="filters.min_surface"
                                            :placeholder="surfaceRange?.min_surface || 0"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-principal focus:border-transparent"
                                            min="0">
                                        <span class="text-xs text-gray-500 mt-1 block">Min</span>
                                    </div>
                                    <div>
                                        <input 
                                            type="number" 
                                            v-model.number="filters.max_surface"
                                            :placeholder="surfaceRange?.max_surface || 0"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-principal focus:border-transparent"
                                            min="0">
                                        <span class="text-xs text-gray-500 mt-1 block">Max</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Filtre Nombre de pièces -->
                            <div>
                                <label class="block text-sm font-semibold text-secondaire mb-3">
                                    <i class="fas fa-bed mr-2 text-principal"></i>
                                    Nombre de pièces
                                </label>
                                <select 
                                    v-model="filters.npiece"
                                    class="w-full px-2 sm:px-3 lg:px-4 py-1.5 sm:py-2 text-xs sm:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-principal focus:border-transparent">
                                    <option value="">Tous</option>
                                    <option value="1">1 pièce</option>
                                    <option value="2">2 pièces</option>
                                    <option value="3">3 pièces</option>
                                    <option value="4">4 pièces</option>
                                    <option value="5">5+ pièces</option>
                                </select>
                            </div>
                            
                            <!-- Filtre Région -->
                            <div>
                                <label class="block text-sm font-semibold text-secondaire mb-3">
                                    <i class="fas fa-map-marker-alt mr-2 text-principal"></i>
                                    Région
                                </label>
                                <select 
                                    v-model="filters.region"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-principal focus:border-transparent">
                                    <option value="">Toutes les régions</option>
                                    <option v-for="region in regions" :key="region" :value="region">
                                        {{ region }}
                                    </option>
                                </select>
                            </div>
                            
                            <!-- Filtre Type d'affaire -->
                            <div>
                                <label class="block text-sm font-semibold text-secondaire mb-3">
                                    <i class="fas fa-tag mr-2 text-principal"></i>
                                    Type d'affaire
                                </label>
                                <select 
                                    v-model="filters.affaire"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-principal focus:border-transparent">
                                    <option value="">Tous</option>
                                    <option value="vente">Vente</option>
                                    <option value="location">Location</option>
                                </select>
                            </div>
                            
                            <!-- Tri -->
                            <div>
                                <label class="block text-sm font-semibold text-secondaire mb-3">
                                    <i class="fas fa-sort mr-2 text-principal"></i>
                                    Trier par
                                </label>
                                <select 
                                    v-model="filters.sort"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-principal focus:border-transparent">
                                    <option value="newest">Plus récent</option>
                                    <option value="price_asc">Prix croissant</option>
                                    <option value="price_desc">Prix décroissant</option>
                                    <option value="surface_asc">Surface croissante</option>
                                    <option value="surface_desc">Surface décroissante</option>
                                </select>
                            </div>
                            
                            <!-- Bouton Appliquer -->
                            <button 
                                type="submit"
                                class="w-full bg-principal hover:bg-principal/90 text-white py-2 sm:py-3 px-3 sm:px-4 text-sm sm:text-base rounded-lg font-semibold transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-principal focus:ring-offset-2 shadow-md hover:shadow-lg">
                                <i class="fas fa-filter mr-1 sm:mr-2"></i>
                                <span class="hidden sm:inline">Appliquer les filtres</span>
                                <span class="sm:hidden">Filtrer</span>
                            </button>
                        </form>
                    </div>
                </aside>
                
                <!-- Contenu principal -->
                <div class="lg:w-3/4 w-full">
            <!-- Section Boostée (affichée uniquement si pas de filtre boosted) -->
            <div v-if="getBoostedItems()?.length > 0 && !isBoostedOnly" class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-secondaire flex items-center">
                        <span class="w-4 h-4 bg-principal rounded-full mr-2" aria-hidden="true"></span>
                        Annonces en vedette
                        <span class="ml-3 text-sm font-normal text-principal flex items-center">
                            <i class="fas fa-bolt mr-1" aria-hidden="true"></i> Boostées
                        </span>
                    </h2>
                    <a 
                        :href="getBoostedLink()"
                        class="text-principal hover:text-principal/80 font-semibold flex items-center gap-2 transition-all duration-300 hover:gap-3 group">
                        <span>Voir tout</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Carousel Swiper pour les annonces boostées -->
                <div class="relative">
                    <div class="swiper boosted-swiper" id="boosted-swiper">
                        <div class="swiper-wrapper">
                            <div 
                                v-for="item in getBoostedItems()" 
                                :key="item.id"
                                class="swiper-slide">
                                <article 
                                    @click="navigateToDetail(item.id)"
                                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 h-full flex flex-col cursor-pointer focus-within:ring-2 focus-within:ring-principal focus-within:ring-offset-2 group border border-gray-100"
                                    @keydown.enter="navigateToDetail(item.id)"
                                    tabindex="0"
                                    role="article"
                                    :aria-label="`${item.nom} - ${item.prix} FCFA`">
                        
                        <div class="relative bg-gray-200 overflow-hidden h-80">
                            <span class="absolute top-4 right-4 z-10 inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold bg-gradient-to-r from-yellow-400 to-yellow-500 text-white shadow-lg">
                                <i class="fas fa-bolt mr-1" aria-hidden="true"></i> Boost
                            </span>
                            
                            <img :src="getFirstAvailableImage(item)"
                                :alt="`Image de ${item.nom || 'bien immobilier'}`"
                                :title="item.nom"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                                loading="lazy"
                                decoding="async"
                                @error="handleImageError($event)">
                            
                            <div class="absolute top-4 left-4">
                                <button 
                                    @click.stop="toggleFavorite(item.id)"
                                    :class="[
                                        'bg-white rounded-full p-2.5 shadow-md hover:shadow-lg transition-all duration-300',
                                        isFavorite(item.id)
                                            ? 'text-red-500'
                                            : 'text-gray-400 hover:text-red-400'
                                    ]"
                                    :aria-label="isFavorite(item.id) ? 'Retirer des favoris' : 'Ajouter aux favoris'">
                                    <i :class="isFavorite(item.id) ? 'fas fa-heart' : 'far fa-heart'" class="text-base"></i>
                                </button>
                            </div>
                        </div>

                        <div class="p-3 sm:p-4 lg:p-6 flex-grow flex flex-col">
                            <div class="flex-grow">
                                <div class="text-sm sm:text-base lg:text-lg font-semibold text-secondaire mb-2 sm:mb-3">
                                    <span v-if="item.npiece">{{ item.npiece }} chambre{{ item.npiece > 1 ? 's' : '' }}</span>
                                    <span class="lowercase">{{ item.type || 'appartement' }}</span>
                                    <span v-if="item.surface"> de {{ item.surface }}m²</span>
                                </div>
                                
                                <div class="text-xs sm:text-sm lg:text-base text-gray-600 mb-2 sm:mb-4 line-clamp-1">
                                    {{ item.region || 'Sénégal' }}
                                </div>
                            </div>
                            
                            <div class="border-t-2 border-gray-200 pt-2 sm:pt-4 mt-auto flex items-center justify-between">
                                <div>
                                    <span class="text-lg sm:text-xl lg:text-2xl font-bold text-principal">
                                        {{ formatPrice(item.prix) }}
                                    </span>
                                    <span class="text-xs sm:text-sm lg:text-base text-gray-500 ml-1 sm:ml-2">FCFA</span>
                                </div>
                                <button 
                                    @click.stop="toggleFavorite(item.id)"
                                    :class="[
                                        'transition-colors duration-300',
                                        isFavorite(item.id)
                                            ? 'text-red-500'
                                            : 'text-gray-400 hover:text-red-400'
                                    ]"
                                    :aria-label="isFavorite(item.id) ? 'Retirer des favoris' : 'Ajouter aux favoris'">
                                    <i :class="isFavorite(item.id) ? 'fas fa-heart' : 'far fa-heart'" class="text-base sm:text-lg lg:text-xl"></i>
                                </button>
                            </div>
                                </div>
                            </article>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation buttons -->
                    <div class="swiper-button-next boosted-next"></div>
                    <div class="swiper-button-prev boosted-prev"></div>
                    
                    <!-- Pagination dots -->
                    <div class="swiper-pagination boosted-pagination"></div>
                </div>
            </div>

            <!-- Section Toutes les annonces -->
            <div>
                <h2 class="text-lg sm:text-2xl font-bold text-secondaire mb-3 sm:mb-6 flex items-center">
                    <span class="w-3 h-3 sm:w-4 sm:h-4 bg-secondaire rounded-full mr-2" aria-hidden="true"></span>
                    <span v-if="isBoostedOnly">Annonces en vedette</span>
                    <span v-else>Toutes les annonces</span>
                </h2>

                <div v-if="(isBoostedOnly ? items?.data : items?.data)?.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-3 sm:gap-4 lg:gap-6 xl:gap-8">
                    <article 
                        v-for="item in items.data" 
                        :key="item.id"
                        @click="navigateToDetail(item.id)"
                        class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 h-full flex flex-col cursor-pointer focus-within:ring-2 focus-within:ring-principal focus-within:ring-offset-2 group border border-gray-100"
                        @keydown.enter="navigateToDetail(item.id)"
                        tabindex="0"
                        role="article"
                        :aria-label="`${item.nom} - ${item.prix} FCFA`">
                        
                        <div class="relative bg-gray-200 overflow-hidden h-48 sm:h-64 lg:h-80">
                            <span v-if="isNew(item.created_at)" 
                                class="absolute top-2 sm:top-4 right-2 sm:right-4 z-10 bg-principal text-white px-2 sm:px-3 py-1 sm:py-1.5 rounded-full text-xs sm:text-sm font-bold">
                                Nouveau !
                            </span>
                            
                            <img :src="getFirstAvailableImage(item)"
                                :alt="`Image de ${item.nom || 'bien immobilier'}`"
                                :title="item.nom"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                                loading="lazy"
                                decoding="async"
                                @error="handleImageError($event)">
                            
                            <div class="absolute top-4 left-4">
                                <button 
                                    @click.stop="toggleFavorite(item.id)"
                                    :class="[
                                        'bg-white rounded-full p-2.5 shadow-md hover:shadow-lg transition-all duration-300',
                                        isFavorite(item.id)
                                            ? 'text-red-500'
                                            : 'text-gray-400 hover:text-red-400'
                                    ]"
                                    :aria-label="isFavorite(item.id) ? 'Retirer des favoris' : 'Ajouter aux favoris'">
                                    <i :class="isFavorite(item.id) ? 'fas fa-heart' : 'far fa-heart'" class="text-base"></i>
                                </button>
                            </div>
                        </div>

                        <div class="p-3 sm:p-4 lg:p-6 flex-grow flex flex-col">
                            <div class="flex-grow">
                                <div class="text-sm sm:text-base lg:text-lg font-semibold text-secondaire mb-2 sm:mb-3">
                                    <span v-if="item.npiece">{{ item.npiece }} chambre{{ item.npiece > 1 ? 's' : '' }}</span>
                                    <span class="lowercase">{{ item.type || 'appartement' }}</span>
                                    <span v-if="item.surface"> de {{ item.surface }}m²</span>
                                </div>
                                
                                <div class="text-xs sm:text-sm lg:text-base text-gray-600 mb-2 sm:mb-4 line-clamp-1">
                                    {{ item.region || 'Sénégal' }}
                                </div>
                            </div>
                            
                            <div class="border-t-2 border-gray-200 pt-2 sm:pt-4 mt-auto flex items-center justify-between">
                                <div>
                                    <span class="text-lg sm:text-xl lg:text-2xl font-bold text-principal">
                                        {{ formatPrice(item.prix) }}
                                    </span>
                                    <span class="text-xs sm:text-sm lg:text-base text-gray-500 ml-1 sm:ml-2">FCFA</span>
                                </div>
                                <button 
                                    @click.stop="toggleFavorite(item.id)"
                                    :class="[
                                        'transition-colors duration-300',
                                        isFavorite(item.id)
                                            ? 'text-red-500'
                                            : 'text-gray-400 hover:text-red-400'
                                    ]"
                                    :aria-label="isFavorite(item.id) ? 'Retirer des favoris' : 'Ajouter aux favoris'">
                                    <i :class="isFavorite(item.id) ? 'fas fa-heart' : 'far fa-heart'" class="text-base sm:text-lg lg:text-xl"></i>
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
                
                <div v-else class="text-center py-12 text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-4" aria-hidden="true"></i>
                    <p>Aucune annonce disponible pour cette catégorie.</p>
                </div>
                
                <!-- Pagination pour les annonces normales -->
                <div v-if="!isBoostedOnly && items?.links && items.links.length > 3" class="mt-12 flex justify-center">
                    <nav class="flex items-center space-x-2" aria-label="Pagination">
                        <Link
                            v-for="(link, index) in items.links"
                            :key="index"
                            :href="link.url || '#'"
                            :class="[
                                'px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300',
                                link.active
                                    ? 'bg-principal text-white shadow-lg scale-105'
                                    : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300',
                                !link.url 
                                    ? 'opacity-50 cursor-not-allowed pointer-events-none' 
                                    : 'cursor-pointer hover:shadow-md'
                            ]"
                            v-html="link.label"
                            :preserve-state="true"
                            :preserve-scroll="true"
                        ></Link>
                    </nav>
                </div>
                
                <!-- Pagination pour les annonces boostées (quand on affiche uniquement les boostées) -->
                <div v-if="isBoostedOnly && items?.links && items.links.length > 3" class="mt-12 flex justify-center">
                    <nav class="flex items-center space-x-2" aria-label="Pagination">
                        <Link
                            v-for="(link, index) in items.links"
                            :key="index"
                            :href="link.url || '#'"
                            :class="[
                                'px-4 py-2 rounded-lg font-semibold text-sm transition-all duration-300',
                                link.active
                                    ? 'bg-principal text-white shadow-lg scale-105'
                                    : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300',
                                !link.url 
                                    ? 'opacity-50 cursor-not-allowed pointer-events-none' 
                                    : 'cursor-pointer hover:shadow-md'
                            ]"
                            v-html="link.label"
                            :preserve-state="true"
                            :preserve-scroll="true"
                        ></Link>
                    </nav>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>

    <Footer />
    
    <!-- Toast Notification -->
    <Toast 
        :show="showToast" 
        :message="toastMessage" 
        :type="toastType"
        @close="closeToast"
    />
</template>

<script setup>
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    category: String,
    type: String,
    items: Object,
    itemsBoost: Object,
    total: Number,
    filters: Object,
    priceRange: Object,
    surfaceRange: Object,
    regions: Array,
});
</script>

<script>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/vue3';
import Footer from '../Components/Footer.vue';
import Navbar from '../Components/Navbar.vue';
import Toast from '../Components/Toast.vue';

export default {
    components: {
        Toast,
        Footer,
        Navbar,
    },
    data() {
        return {
            favorites: new Set(),
            showToast: false,
            toastMessage: '',
            toastType: 'success',
        };
    },
    computed: {
        filters() {
            return {
                min_price: this.$props.filters?.min_price || null,
                max_price: this.$props.filters?.max_price || null,
                min_surface: this.$props.filters?.min_surface || null,
                max_surface: this.$props.filters?.max_surface || null,
                npiece: this.$props.filters?.npiece || '',
                region: this.$props.filters?.region || '',
                affaire: this.$props.filters?.affaire || '',
                sort: this.$props.filters?.sort || 'newest',
            };
        },
        isBoostedOnly() {
            return this.$props.filters?.boosted === 'true' || this.$props.filters?.boosted === true;
        },
    },
    mounted() {
        if (this.$page.props.auth?.user) {
            this.loadFavorites();
        }
        
        // Initialiser Swiper pour les annonces boostées
        this.$nextTick(() => {
            this.initializeBoostedSwiper();
        });
    },
    methods: {
        navigateToDetail(id) {
            this.$inertia.visit(`/detail/${id}`);
        },
        getCategoryName() {
            const names = {
                'villa': 'Villa',
                'appartements': 'Appartements',
                'appartement': 'Appartements',
                'chambre': 'Chambres',
                'chambres': 'Chambres',
                'studio': 'Studios',
                'studios': 'Studios',
                'immeuble': 'Immeubles',
                'immeubles': 'Immeubles',
                'terrain': 'Terrains',
                'terrains': 'Terrains',
                'immobilier': 'Immobilier',
            };
            return names[this.category?.toLowerCase()] || 'Immobilier';
        },
        get canonicalUrl() {
            return window.location.origin + window.location.pathname + (window.location.search || '');
        },
        get structuredData() {
            const items = this.items?.data || [];
            const itemList = items.slice(0, 10).map((item, index) => ({
                '@type': 'ListItem',
                'position': index + 1,
                'item': {
                    '@type': 'Product',
                    'name': item.nom || `${this.getCategoryName()} à ${item.region || 'Sénégal'}`,
                    'description': `${item.npiece ? item.npiece + ' chambre(s)' : ''} ${item.type || ''} ${item.surface ? 'de ' + item.surface + 'm²' : ''} à ${item.region || 'Sénégal'}`,
                    'offers': {
                        '@type': 'Offer',
                        'price': item.prix || '0',
                        'priceCurrency': 'XOF'
                    }
                }
            }));

            return {
                '@context': 'https://schema.org',
                '@type': 'ItemList',
                'name': `${this.getCategoryName()} à louer au Sénégal`,
                'description': `Liste de ${this.getCategoryName().toLowerCase()} à louer au Sénégal`,
                'numberOfItems': this.total || items.length,
                'itemListElement': itemList
            };
        },
        formatNumber(num) {
            return new Intl.NumberFormat('fr-FR').format(num);
        },
        formatPrice(price) {
            if (!price) return '0';
            return new Intl.NumberFormat('fr-FR').format(price);
        },
        isNew(createdAt) {
            if (!createdAt) return false;
            const created = new Date(createdAt);
            const now = new Date();
            const diffDays = (now - created) / (1000 * 60 * 60 * 24);
            return diffDays <= 7;
        },
        async toggleFavorite(id) {
            if (!this.$page.props.auth?.user) {
                this.$inertia.visit('/login');
                return;
            }

            try {
                const response = await fetch(`/favoris/toggle/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                });

                const data = await response.json();
                
                if (data.status === 'added') {
                    this.favorites.add(id);
                    this.toastMessage = 'Bien ajouté aux favoris avec succès!';
                    this.toastType = 'success';
                    this.showToast = true;
                } else if (data.status === 'removed') {
                    this.favorites.delete(id);
                    this.toastMessage = 'Bien retiré des favoris';
                    this.toastType = 'info';
                    this.showToast = true;
                }
            } catch (error) {
                console.error('Erreur lors de l\'ajout aux favoris:', error);
                this.toastMessage = 'Erreur lors de l\'opération';
                this.toastType = 'error';
                this.showToast = true;
            }
        },
        closeToast() {
            this.showToast = false;
        },
        isFavorite(id) {
            return this.favorites.has(id);
        },
        async loadFavorites() {
            if (!this.$page.props.auth?.user) return;

            try {
                const response = await fetch('/favoris/all', {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                });
                
                if (response.ok) {
                    const data = await response.json();
                    if (data.favoris && Array.isArray(data.favoris)) {
                        data.favoris.forEach(id => {
                            this.favorites.add(id);
                        });
                    }
                }
            } catch (error) {
                console.error('Erreur lors du chargement des favoris:', error);
            }
        },
        getImageUrl(imagePath) {
            if (!imagePath || imagePath === 'null' || imagePath === '') {
                return 'https://via.placeholder.com/500x300?text=Image+non+disponible';
            }
            
            if (imagePath.startsWith('http://') || imagePath.startsWith('https://')) {
                return imagePath;
            }
            
            if (imagePath.startsWith('storage/') || imagePath.startsWith('/storage/')) {
                return imagePath.startsWith('/') ? imagePath : '/' + imagePath;
            }
            
            return '/storage/' + imagePath;
        },
        getFirstAvailableImage(article) {
            if (article.image1 && article.image1 !== '' && article.image1 !== 'null') {
                return this.getImageUrl(article.image1);
            }
            if (article.image2 && article.image2 !== '' && article.image2 !== 'null') {
                return this.getImageUrl(article.image2);
            }
            if (article.image3 && article.image3 !== '' && article.image3 !== 'null') {
                return this.getImageUrl(article.image3);
            }
            return 'https://via.placeholder.com/500x300?text=Image+non+disponible';
        },
        handleImageError(event) {
            if (event.target && !event.target.dataset.errorHandled) {
                event.target.dataset.errorHandled = 'true';
                event.target.src = 'https://via.placeholder.com/500x300?text=Image+non+disponible';
                event.target.onerror = null;
            }
        },
        applyFilters() {
            // Construire l'URL avec les filtres
            const params = new URLSearchParams();
            
            Object.keys(this.filters).forEach(key => {
                if (this.filters[key] !== null && this.filters[key] !== '') {
                    params.append(key, this.filters[key]);
                }
            });
            
            const queryString = params.toString();
            const url = `/categorie/${this.category}${queryString ? '?' + queryString : ''}`;
            
            this.$inertia.visit(url, {
                preserveState: true,
                preserveScroll: true,
            });
        },
        resetFilters() {
            this.filters = {
                min_price: null,
                max_price: null,
                min_surface: null,
                max_surface: null,
                npiece: '',
                region: '',
                affaire: '',
                sort: 'newest',
            };
            this.$inertia.visit(`/categorie/${this.category}`, {
                preserveState: false,
                preserveScroll: false,
            });
        },
        initializeBoostedSwiper() {
            if (this.getBoostedItems()?.length > 0 && !this.isBoostedOnly) {
                // Utiliser Swiper global depuis CDN
                if (typeof Swiper !== 'undefined') {
                    new Swiper('#boosted-swiper', {
                        slidesPerView: 1,
                        spaceBetween: 20,
                        breakpoints: {
                            640: {
                                slidesPerView: 2,
                                spaceBetween: 24,
                            },
                            1024: {
                                slidesPerView: 2,
                                spaceBetween: 32,
                            },
                            1280: {
                                slidesPerView: 3,
                                spaceBetween: 32,
                            },
                        },
                        navigation: {
                            nextEl: '.boosted-next',
                            prevEl: '.boosted-prev',
                        },
                        pagination: {
                            el: '.boosted-pagination',
                            clickable: true,
                            dynamicBullets: true,
                        },
                        autoplay: {
                            delay: 5000,
                            disableOnInteraction: false,
                        },
                        loop: false,
                    });
                }
            }
        },
        getBoostedLink() {
            return `/categorie/${this.category}?boosted=true`;
        },
        getBoostedItems() {
            // Si itemsBoost est un objet paginé, utiliser itemsBoost.data
            // Sinon, c'est un tableau direct
            if (this.itemsBoost && Array.isArray(this.itemsBoost)) {
                return this.itemsBoost;
            } else if (this.itemsBoost?.data) {
                return this.itemsBoost.data;
            }
            return [];
        },
    },
};
</script>

<style scoped>
/* Styles pour le carousel Swiper des annonces boostées */
.boosted-next,
.boosted-prev {
    color: white;
    background-color: rgba(0, 0, 0, 0.6);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: bold;
    transition: all 0.3s ease;
    z-index: 10;
}

.boosted-next:hover,
.boosted-prev:hover {
    background-color: rgba(0, 0, 0, 0.9);
    transform: scale(1.1);
}

.boosted-next::after,
.boosted-prev::after {
    font-size: 18px;
    font-weight: bold;
}

.boosted-next {
    right: -20px;
}

.boosted-prev {
    left: -20px;
}

.boosted-pagination {
    position: relative;
    margin-top: 24px;
    text-align: center;
}

.boosted-pagination :deep(.swiper-pagination-bullet) {
    width: 12px;
    height: 12px;
    background: #d1d5db;
    opacity: 1;
    transition: all 0.3s ease;
}

.boosted-pagination :deep(.swiper-pagination-bullet-active) {
    background: var(--principal, #eb2d53);
    width: 32px;
    border-radius: 6px;
}

@media (max-width: 768px) {
    .boosted-next {
        right: 10px;
    }
    .boosted-prev {
        left: 10px;
    }
}
</style>

