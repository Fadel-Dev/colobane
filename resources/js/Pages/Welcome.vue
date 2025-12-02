<template>
    <SeoHead 
        :title="'NoflayHub - Location immobilière au Sénégal | Trouvez votre logement idéal'"
        :description="`Trouvez votre logement idéal au Sénégal. ${totalAnnonces ? formatNumber(totalAnnonces) + ' annonces' : 'Des milliers d\'annonces'} de villas, appartements, chambres, studios et terrains à louer dans toutes les régions du Sénégal.`"
        :keywords="'location Sénégal, immobilier Sénégal, villa à louer Dakar, appartement à louer, chambre à louer, studio à louer, terrain à louer, location immobilière Sénégal'"
        :og-type="'website'"
        :og-image="ogImage"
        :structured-data="structuredData"
    />

    <Navbar class="relative" />
    
    <!-- Hero Section avec image de fond - OPTIMISÉ MOBILE -->
    <section class="relative min-h-[50vh] sm:min-h-[60vh] lg:min-h-[70vh] flex items-center justify-center bg-gradient-to-br from-principal via-principal/90 to-secondaire overflow-hidden">
        <!-- Image de fond avec overlay -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
             style="background-image: url('https://images.unsplash.com/photo-1513694203232-719a280e022f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');">
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/40 to-black/60"></div>
        </div>

        <!-- Contenu du Hero -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-8 sm:py-12 lg:py-20">
            <!-- Compteur d'annonces dans une boîte semi-transparente -->
            <div class="text-center mb-6 sm:mb-8">
                <div class="inline-block bg-white/90 backdrop-blur-md rounded-xl sm:rounded-2xl px-4 sm:px-8 py-4 sm:py-6 shadow-xl sm:shadow-2xl">
                    <h1 class="text-xl sm:text-4xl lg:text-6xl font-bold text-secondaire mb-1 sm:mb-2 leading-tight">
                        {{ formatNumber(totalAnnonces || 0) }} biens
                    </h1>
                    <p class="text-sm sm:text-lg lg:text-xl text-gray-600">Trouvez votre logement idéal</p>
                </div>
            </div>

            <!-- Barre de recherche principale - RESPONSIVE -->
            <div class="max-w-4xl mx-auto">
                <form @submit.prevent="handleSearch" class="relative">
                    <div class="bg-white/95 backdrop-blur-md rounded-lg sm:rounded-2xl shadow-xl sm:shadow-2xl p-1.5 sm:p-2 flex flex-col sm:flex-row gap-1.5 sm:gap-2">
                        <div class="flex-1 relative">
                            <i class="fas fa-search absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-base sm:text-xl z-10"></i>
                            <input 
                                type="text" 
                                v-model="searchQuery"
                                @input="handleSearchInput"
                                @focus="showSuggestions = true"
                                @blur="hideSuggestions"
                                @keydown.arrow-down.prevent="navigateSuggestions('down')"
                                @keydown.arrow-up.prevent="navigateSuggestions('up')"
                                @keydown.enter.prevent="selectedSuggestionIndex >= 0 ? selectSuggestion(selectedSuggestionIndex) : handleSearch()"
                                placeholder="Rechercher..."
                                class="w-full pl-10 sm:pl-14 pr-3 sm:pr-4 py-3 sm:py-5 text-gray-900 rounded-lg sm:rounded-xl focus:outline-none focus:ring-2 focus:ring-principal text-sm sm:text-base"
                                aria-label="Rechercher un bien"
                                autocomplete="off"
                            />
                            <p class="hidden sm:block text-xs text-gray-500 mt-1 ml-4">Ville, zone ou quartier</p>
                            
                            <!-- Suggestions dropdown -->
                            <div 
                                v-if="showSuggestions && searchSuggestions.length > 0"
                                class="absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 max-h-96 overflow-y-auto"
                            >
                                <div 
                                    v-for="(suggestion, index) in searchSuggestions" 
                                    :key="index"
                                    @click="selectSuggestion(index)"
                                    @mouseenter="selectedSuggestionIndex = index"
                                    :class="[
                                        'px-4 py-3 cursor-pointer transition-colors flex items-center gap-3',
                                        selectedSuggestionIndex === index ? 'bg-principal/10' : 'hover:bg-gray-50'
                                    ]"
                                >
                                    <i :class="[
                                        'fas',
                                        suggestion.icon === 'map-marker-alt' ? 'fa-map-marker-alt' :
                                        suggestion.icon === 'home' ? 'fa-home' :
                                        'fa-building',
                                        'text-principal'
                                    ]"></i>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-900">{{ suggestion.label }}</div>
                                        <div class="text-xs text-gray-500 capitalize">{{ suggestion.type }}</div>
                                    </div>
                                    <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                                </div>
                            </div>
                        </div>
                        <button 
                            type="submit"
                            class="w-full sm:w-auto bg-principal hover:bg-principal/90 text-white px-4 sm:px-12 py-3 sm:py-5 rounded-lg sm:rounded-xl font-semibold transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-principal text-sm sm:text-base shadow-lg hover:shadow-xl transform hover:scale-105">
                            Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Section Catégories - RESPONSIVE -->
    <section class="py-6 sm:py-10 lg:py-12 bg-white">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <h2 class="text-lg sm:text-2xl lg:text-3xl font-bold text-secondaire mb-4 sm:mb-8 text-center">
                Quel type de location?
            </h2>
            <div class="flex flex-wrap justify-center gap-2 sm:gap-4">
                <button 
                    v-for="item in categoryItems" 
                    :key="item.id"
                    @click="navigateToCategory(item.slug)"
                    :class="[
                        'px-3 sm:px-6 py-2.5 sm:py-4 rounded-lg sm:rounded-xl transition-all duration-300 font-semibold text-secondaire border-2 flex items-center gap-2 min-w-fit sm:min-w-[160px] justify-center text-xs sm:text-sm',
                        'bg-white border-gray-200 hover:border-principal hover:shadow-md hover:bg-principal hover:text-white'
                    ]">
                    <i :class="`fas fa-${item.icon} text-base sm:text-xl`"></i>
                    <span class="hidden sm:inline">{{ item.name }}</span>
                    <span class="sm:hidden">{{ item.name.substring(0, 8) }}</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Section Villes Populaires - RESPONSIVE -->
    <section class="py-6 sm:py-10 lg:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <h2 class="text-lg sm:text-2xl lg:text-3xl font-bold text-secondaire mb-4 sm:mb-8">
                Villes populaires
            </h2>
            
            <!-- Carousel Swiper pour les villes -->
            <div class="relative">
                <div class="swiper villes-swiper" id="villes-swiper">
                    <div class="swiper-wrapper">
                        <div 
                            v-for="ville in villesPopulairesAvecCount" 
                            :key="ville.nom"
                            class="swiper-slide">
                            <button 
                                @click="filterByCity(ville.nom)"
                                :class="[
                                    'bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 text-left group border-2 transform hover:-translate-y-1 w-full h-full flex flex-col',
                                    selectedCity === ville.nom 
                                        ? 'border-principal shadow-lg scale-105' 
                                        : 'border-transparent hover:border-principal'
                                ]">
                                <!-- Image de la ville - RESPONSIVE -->
                                <div class="relative h-32 sm:h-40 lg:h-48 w-full overflow-hidden bg-gradient-to-br from-gray-200 to-gray-300">
                                    <img 
                                        :src="ville.image" 
                                        :alt="`Image de ${ville.nom}`"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                        @error="handleCityImageError($event)"
                                        loading="lazy"
                                    />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                                    <div class="absolute bottom-4 left-4 right-4 text-white">
                                        <div class="font-bold text-xl mb-1 drop-shadow-lg">
                                            {{ ville.nom }}
                                        </div>
                                        <div class="text-sm text-white/90 drop-shadow-md">
                                            {{ formatNumber(ville.count) }} {{ ville.count > 1 ? 'biens' : 'bien' }}
                                        </div>
                                    </div>
                                </div>
                            </button>
                            </div>
                        </div>

                    <!-- Navigation buttons -->
                    <div class="swiper-button-next villes-next"></div>
                    <div class="swiper-button-prev villes-prev"></div>
                    
                    <!-- Pagination -->
                    <div class="swiper-pagination villes-pagination"></div>
                    </div>
                </div>

            <!-- Bouton pour réinitialiser le filtre -->
            <div v-if="selectedCity" class="mt-6 text-center">
                <button 
                    @click="clearCityFilter"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-principal text-white rounded-xl hover:bg-principal/90 transition-all duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-times"></i>
                    <span>Effacer le filtre ({{ selectedCity }})</span>
                </button>
                    </div>
                </div>
    </section>

    <!-- Contenu réactif selon la catégorie sélectionnée - RESPONSIVE -->
    <section class="py-6 sm:py-10 lg:py-12 bg-gray-50" v-if="getCurrentData()?.length > 0 || getBoostedData()?.length > 0">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <!-- Section Boostée -->
            <div v-if="getBoostedData()?.length > 0" class="mb-6 sm:mb-10">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-3">
                    <h3 class="text-base sm:text-lg lg:text-xl font-bold text-secondaire flex items-center">
                        <span class="w-3 h-3 sm:w-4 sm:h-4 bg-principal rounded-full mr-2" aria-hidden="true"></span>
                        Annonces en vedette
                        <span class="ml-2 sm:ml-3 text-xs sm:text-sm font-normal text-principal flex items-center">
                            <i class="fas fa-bolt mr-1" aria-hidden="true"></i> Boostées
                        </span>
                    </h3>
                    <a 
                        :href="getBoostedLink()"
                        class="text-principal hover:text-principal/80 font-semibold flex items-center gap-2 transition-all duration-300 hover:gap-3 group text-sm">
                        <span>Voir tout</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
                    <article 
                        v-for="item in getBoostedData().slice(0, 8)" 
                        :key="item.id"
                        @click="navigateToDetail(item.id)"
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 h-full flex flex-col cursor-pointer focus-within:ring-2 focus-within:ring-principal focus-within:ring-offset-2 group"
                        @keydown.enter="navigateToDetail(item.id)"
                        tabindex="0"
                        role="article"
                        :aria-label="`${item.nom} - ${item.prix} FCFA`">
                        
                        <!-- Image responsive -->
                        <div class="relative bg-gray-200 overflow-hidden h-32 sm:h-40 lg:h-64">
                            <span class="absolute top-2 sm:top-4 left-2 sm:left-4 z-10 inline-flex items-center px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-400 to-yellow-500 text-white shadow-md">
                                <i class="fas fa-bolt mr-0.5 sm:mr-1" aria-hidden="true"></i> <span class="hidden sm:inline">Boost</span>
                            </span>
                            
                            <img :src="getFirstAvailableImage(item)"
                                :alt="`Image de ${item.nom || 'bien immobilier'}`"
                                :title="item.nom"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                                loading="lazy"
                                decoding="async"
                                @error="handleImageError($event)">
                            
                            <div class="absolute top-4 right-4">
                                                <button
                                    @click.stop="toggleFavorite(item.id)"
                                                    :class="[
                                                        'bg-white rounded-full p-2 shadow-md hover:shadow-lg transition-all duration-300',
                                        isFavorite(item.id)
                                                            ? 'text-red-500'
                                                            : 'text-gray-400 hover:text-red-400'
                                                    ]"
                                    :aria-label="isFavorite(item.id) ? 'Retirer des favoris' : 'Ajouter aux favoris'">
                                    <i :class="isFavorite(item.id) ? 'fas fa-heart' : 'far fa-heart'" class="text-sm"></i>
                                                </button>
                            </div>
                                            </div>

                        <div class="p-5 flex-grow flex flex-col">
                            <div class="flex-grow">
                                <h3 class="text-lg font-bold mb-2 text-secondaire line-clamp-2">
                                    {{ item.nom }}
                                </h3>
                                <div class="flex items-center text-sm text-gray-600 mb-3">
                                    <i class="fas fa-map-marker-alt text-principal mr-2" aria-hidden="true"></i>
                                    <span>{{ item.region }}, Sénégal</span>
                                </div>
                                <div class="flex items-center gap-2 mb-3 text-sm text-gray-500">
                                    <span v-if="item.surface">{{ item.surface }}m²</span>
                                    <span v-if="item.npiece">{{ item.npiece }} pièce{{ item.npiece > 1 ? 's' : '' }}</span>
                                    <span>{{ item.type }}</span>
                                                </div>
                                            </div>

                            <div class="border-t border-gray-200 pt-3 mt-auto">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-principal">
                                            {{ formatPrice(item.prix) }}
                                        </span>
                                        <span class="text-sm text-gray-500 ml-1">FCFA</span>
                                                </div>
                                            </div>
                            </div>
                        </div>
                    </article>
                                                </div>
                                            </div>
        </div>
    </section>

    <!-- Section Créer une alerte -->
    <section class="py-16 bg-gradient-to-br from-principal/10 via-principal/5 to-secondaire/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                    <div class="flex-1 text-left">
                        <h2 class="text-3xl md:text-4xl font-bold text-secondaire mb-4">
                            Créer une alerte gratuite
                        </h2>
                        <p class="text-lg md:text-xl text-gray-700 leading-relaxed max-w-3xl">
                            Laissez-nous trouver votre prochain logement. Créez un Agent de recherche gratuit et recevez des alertes e-mail instantanées pour les nouvelles annonces correspondant à vos critères afin d'être toujours parmi les premiers informés.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                                            <button
                            v-if="!$page.props.auth?.user"
                            @click="$inertia.visit('/register')"
                            class="bg-principal hover:bg-principal/90 text-white px-12 py-5 rounded-xl font-semibold transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-principal focus:ring-offset-2 shadow-lg hover:shadow-xl transform hover:scale-105 text-lg inline-flex items-center gap-2 whitespace-nowrap">
                            <i class="fas fa-bell"></i>
                            <span>Créer une alerte</span>
                        </button>
                        <button 
                            v-else
                            @click="showAlertForm = true"
                            class="bg-principal hover:bg-principal/90 text-white px-12 py-5 rounded-xl font-semibold transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-principal focus:ring-offset-2 shadow-lg hover:shadow-xl transform hover:scale-105 text-lg inline-flex items-center gap-2 whitespace-nowrap">
                            <i class="fas fa-bell"></i>
                            <span>Créer une alerte</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
    </section>

    <!-- Section Locations récemment ajoutées -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 flex items-center justify-between">
                                                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-secondaire mb-3">
                        Locations récemment ajoutées
                                    </h2>
                    <p class="text-gray-600 text-lg">Découvrez les dernières annonces disponibles</p>
                                    </div>
                <Link href="/p/immobilier" class="text-principal hover:text-principal/80 font-semibold hidden md:flex items-center gap-2 transition-all duration-300 hover:gap-3 group">
                    <span>Voir toutes les annonces</span>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </Link>
                                </div>

            <div v-if="maisons?.data?.length > 0" class="relative">
                <div class="swiper recent-annonces-swiper" id="recent-annonces-swiper">
                    <div class="swiper-wrapper">
                        <div 
                            v-for="maison in maisons.data.slice(0, 12)" 
                            :key="maison.id"
                            class="swiper-slide">
                            <article 
                                        @click="navigateToDetail(maison.id)"
                                class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 h-full flex flex-col cursor-pointer focus-within:ring-2 focus-within:ring-principal focus-within:ring-offset-2 group"
                                @keydown.enter="navigateToDetail(maison.id)"
                                tabindex="0"
                                role="article"
                                :aria-label="`${maison.nom} - ${maison.prix} FCFA`">
                                
                                <div class="relative bg-gray-200 overflow-hidden h-64 group/image-container">
                                    <!-- Badge Nouveau -->
                                    <span v-if="isNew(maison.created_at)" 
                                        class="absolute top-4 right-4 z-20 bg-principal text-white px-3 py-1 rounded-full text-xs font-bold">
                                        Nouveau !
                                                    </span>
                                    
                                    <!-- Carousel d'images pour chaque propriété -->
                                    <div class="relative w-full h-full property-image-carousel" :data-property-id="maison.id">
                                        <div class="swiper property-images-swiper" :id="`property-images-${maison.id}`">
                                            <div class="swiper-wrapper">
                                                <div v-if="maison.image1 && maison.image1 !== '' && maison.image1 !== 'null'" class="swiper-slide">
                                                    <img :src="getImageUrl(maison.image1)"
                                                        :alt="`Image 1 de ${maison.nom || 'bien immobilier'}`"
                                                        class="w-full h-full object-cover" 
                                                        loading="lazy"
                                                        decoding="async"
                                                        @error="handleImageError($event)">
                                                </div>
                                                <div v-if="maison.image2 && maison.image2 !== '' && maison.image2 !== 'null'" class="swiper-slide">
                                                    <img :src="getImageUrl(maison.image2)"
                                                        :alt="`Image 2 de ${maison.nom || 'bien immobilier'}`"
                                                        class="w-full h-full object-cover" 
                                                        loading="lazy"
                                                        decoding="async"
                                                        @error="handleImageError($event)">
                                                </div>
                                                <div v-if="maison.image3 && maison.image3 !== '' && maison.image3 !== 'null'" class="swiper-slide">
                                                    <img :src="getImageUrl(maison.image3)"
                                                        :alt="`Image 3 de ${maison.nom || 'bien immobilier'}`"
                                                        class="w-full h-full object-cover" 
                                                        loading="lazy"
                                                        decoding="async"
                                                        @error="handleImageError($event)">
                                                </div>
                                                <!-- Image par défaut si aucune image -->
                                                <div v-if="!hasAnyImage(maison)" class="swiper-slide">
                                            <img :src="getFirstAvailableImage(maison)"
                                                        :alt="`Image de ${maison.nom || 'bien immobilier'}`"
                                                        class="w-full h-full object-cover" 
                                                loading="lazy"
                                                        decoding="async"
                                                        @error="handleImageError($event)">
                                            </div>
                                        </div>

                                            <!-- Navigation pour les images (flèches blanches) -->
                                            <div v-if="hasMultipleImages(maison)" :class="`swiper-button-next property-image-next-${maison.id}`"></div>
                                            <div v-if="hasMultipleImages(maison)" :class="`swiper-button-prev property-image-prev-${maison.id}`"></div>
                                                </div>
                                            </div>

                                    <!-- Bouton favoris -->
                                    <div class="absolute top-4 left-4 z-20">
                                                <button 
                                                    @click.stop="toggleFavorite(maison.id)"
                                                    :class="[
                                                'bg-white rounded-full p-2 shadow-md hover:shadow-lg transition-all duration-300',
                                                        isFavorite(maison.id)
                                                    ? 'text-red-500'
                                                    : 'text-gray-400 hover:text-red-400'
                                                    ]"
                                            :aria-label="isFavorite(maison.id) ? 'Retirer des favoris' : 'Ajouter aux favoris'">
                                            <i :class="isFavorite(maison.id) ? 'fas fa-heart' : 'far fa-heart'" class="text-sm"></i>
                                                </button>
                                    </div>
                                            </div>

                                <div class="p-5 flex-grow flex flex-col">
                                    <div class="flex-grow">
                                        <!-- Format comme dans l'image : "1 chambre appartement de XXm²" -->
                                        <div class="text-base font-semibold text-secondaire mb-2">
                                            <span v-if="maison.npiece">{{ maison.npiece }} chambre{{ maison.npiece > 1 ? 's' : '' }}</span>
                                            <span class="lowercase">{{ maison.type || 'appartement' }}</span>
                                            <span v-if="maison.surface"> de {{ maison.surface }}m²</span>
                                            </div>
                                        
                                        <!-- Localisation complète -->
                                        <div class="text-sm text-gray-600 mb-3 line-clamp-1">
                                            {{ maison.region || 'Sénégal' }}{{ maison.ville ? ', ' + maison.ville : '' }}
                                        </div>
                    </div>

                                    <div class="border-t border-gray-200 pt-3 mt-auto flex items-center justify-between">
                                                <div>
                                            <span class="text-xl font-bold text-principal">
                                                {{ formatPrice(maison.prix) }}
                                                    </span>
                                            <span class="text-sm text-gray-500 ml-1">FCFA</span>
                                                </div>
                                                <button 
                                                    @click.stop="toggleFavorite(maison.id)"
                                                    :class="[
                                                        'transition-colors duration-300',
                                                        isFavorite(maison.id)
                                                    ? 'text-red-500'
                                                    : 'text-gray-400 hover:text-red-400'
                                                    ]"
                                            :aria-label="isFavorite(maison.id) ? 'Retirer des favoris' : 'Ajouter aux favoris'">
                                            <i :class="isFavorite(maison.id) ? 'fas fa-heart' : 'far fa-heart'" class="text-lg"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                    </div>

                    <!-- Navigation buttons -->
                    <div class="swiper-button-next recent-next"></div>
                    <div class="swiper-button-prev recent-prev"></div>
                    
                    <!-- Pagination -->
                    <div class="swiper-pagination recent-pagination"></div>
                    </div>
                    </div>
            
            <div v-else class="text-center py-12 text-gray-500">
                <i class="fas fa-inbox text-4xl mb-4" aria-hidden="true"></i>
                <p>Aucune annonce disponible pour le moment.</p>
                    </div>
                    </div>
    </section>

    <!-- Section Pourquoi attendre -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-secondaire mb-4">
                    Pourquoi attendre ? Commencez votre recherche de logement maintenant !
                </h2>
                <p class="text-lg md:text-xl text-gray-700 max-w-3xl mx-auto leading-relaxed">
                    Colobane rassemble tout le marché de la location en une seule recherche. Ne ratez plus jamais le logement à louer de vos rêves.
                </p>
                <button 
                    @click="handleSearch"
                    class="mt-8 bg-principal hover:bg-principal/90 text-white px-10 py-4 rounded-xl font-semibold transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-principal focus:ring-offset-2 shadow-lg hover:shadow-xl transform hover:scale-105 text-lg inline-flex items-center gap-2">
                    <i class="fas fa-search"></i>
                    <span>Rechercher</span>
                </button>
                    </div>

            <!-- Villes principales -->
            <div class="mb-16">
                <h3 class="text-2xl md:text-3xl font-bold text-secondaire mb-8">
                    Trouvez des logements dans les principales villes du Sénégal
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <div v-for="ville in villesPrincipales" :key="ville.nom" class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                        <h4 class="font-bold text-lg text-secondaire mb-4">{{ ville.nom }}</h4>
                        <ul class="space-y-2">
                            <li v-for="type in ville.types" :key="type.slug">
                                <a 
                                    :href="`/categorie/${type.slug}?region=${ville.nom.toLowerCase()}`"
                                    class="text-gray-700 hover:text-principal transition-colors duration-200 flex items-center group">
                                    <i :class="`fas fa-${type.icon} mr-2 text-sm text-gray-400 group-hover:text-principal`"></i>
                                    <span>{{ type.label }} à {{ ville.nom }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>

            <!-- Toutes les régions -->
            <div>
                <h3 class="text-2xl md:text-3xl font-bold text-secondaire mb-8">
                    Tous les lieux avec des locations
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    <a 
                        v-for="region in regionsSenegal" 
                        :key="region.nom"
                        :href="`/p/immobilier?region=${region.nom.toLowerCase()}`"
                        class="bg-white border border-gray-200 rounded-lg p-4 hover:border-principal hover:shadow-md transition-all duration-200 flex items-center justify-between group">
                        <span class="text-gray-700 group-hover:text-principal font-medium">{{ region.nom }}</span>
                        <span class="text-gray-500 text-sm group-hover:text-principal">({{ region.count || 0 }})</span>
                    </a>
            </div>
        </div>
    </div>
    </section>

    <Footer />
    
    <!-- Toast Notification -->
    <Toast 
        :show="showToast" 
        :message="toastMessage" 
        :type="toastType"
        @close="closeToast"
    />
    
    <!-- Bannière de consentement aux cookies -->
    <CookieBanner />
    
    <!-- Chatbot -->
    <ChatBot />
</template>

<style scoped>
#principal {
    min-height: 100vh;
}

/* Animation pour les cartes */
.card {
    @apply bg-white rounded-2xl overflow-hidden shadow-lg transition-all duration-300;
    will-change: transform, box-shadow;
}

.card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Smooth scroll */
html {
    scroll-behavior: smooth;
}

/* Amélioration de l'accessibilité - focus visible */
*:focus-visible {
    outline: 2px solid #eb2d53;
    outline-offset: 2px;
}

/* Optimisation des performances */
* {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* Respecter les préférences d'accessibilité */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Styles pour le carousel des villes */
.villes-swiper {
    padding-bottom: 50px;
    padding-left: 50px;
    padding-right: 50px;
}

.villes-swiper .swiper-button-next,
.villes-swiper .swiper-button-prev {
    color: #eb2d53;
    background: white;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
    margin-top: 0;
    top: 50%;
    transform: translateY(-50%);
}

.villes-swiper .swiper-button-next:hover,
.villes-swiper .swiper-button-prev:hover {
    background: #eb2d53;
    color: white;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 4px 16px rgba(235, 45, 83, 0.3);
}

.villes-swiper .swiper-button-next::after,
.villes-swiper .swiper-button-prev::after {
    font-size: 18px;
    font-weight: bold;
}

.villes-swiper .swiper-button-next {
    right: 0;
}

.villes-swiper .swiper-button-prev {
    left: 0;
}

.villes-swiper .swiper-pagination {
    bottom: 0;
}

.villes-swiper .swiper-pagination-bullet {
    background: #eb2d53;
    opacity: 0.4;
    width: 10px;
    height: 10px;
    transition: all 0.3s ease;
}

.villes-swiper .swiper-pagination-bullet-active {
    opacity: 1;
    background: #eb2d53;
    width: 24px;
    border-radius: 5px;
}

.villes-swiper .swiper-slide {
    height: auto;
}

/* Responsive pour le carousel */
@media (max-width: 640px) {
    .villes-swiper {
        padding-left: 40px;
        padding-right: 40px;
    }
    
    .villes-swiper .swiper-button-next,
    .villes-swiper .swiper-button-prev {
        width: 36px;
        height: 36px;
    }
    
    .villes-swiper .swiper-button-next::after,
    .villes-swiper .swiper-button-prev::after {
        font-size: 14px;
    }
}

/* Styles pour le carousel des annonces récentes */
.recent-annonces-swiper {
    padding-bottom: 50px;
    padding-left: 50px;
    padding-right: 50px;
}

.recent-annonces-swiper .swiper-button-next,
.recent-annonces-swiper .swiper-button-prev {
    color: #eb2d53;
    background: white;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
    margin-top: 0;
    top: 50%;
    transform: translateY(-50%);
}

.recent-annonces-swiper .swiper-button-next:hover,
.recent-annonces-swiper .swiper-button-prev:hover {
    background: #eb2d53;
    color: white;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 4px 16px rgba(235, 45, 83, 0.3);
}

.recent-annonces-swiper .swiper-button-next::after,
.recent-annonces-swiper .swiper-button-prev::after {
    font-size: 18px;
    font-weight: bold;
}

.recent-annonces-swiper .swiper-button-next {
    right: 0;
}

.recent-annonces-swiper .swiper-button-prev {
    left: 0;
}

.recent-annonces-swiper .swiper-pagination {
    bottom: 0;
}

.recent-annonces-swiper .swiper-pagination-bullet {
    background: #eb2d53;
    opacity: 0.4;
    width: 10px;
    height: 10px;
    transition: all 0.3s ease;
}

.recent-annonces-swiper .swiper-pagination-bullet-active {
    opacity: 1;
    background: #eb2d53;
    width: 24px;
    border-radius: 5px;
}

.recent-annonces-swiper .swiper-slide {
    height: auto;
}

@media (max-width: 640px) {
    .recent-annonces-swiper {
        padding-left: 40px;
        padding-right: 40px;
    }
    
    .recent-annonces-swiper .swiper-button-next,
    .recent-annonces-swiper .swiper-button-prev {
        width: 36px;
        height: 36px;
    }
    
    .recent-annonces-swiper .swiper-button-next::after,
    .recent-annonces-swiper .swiper-button-prev::after {
        font-size: 14px;
    }
}

/* Styles pour les carousels d'images des propriétés */
.property-images-swiper {
    width: 100%;
    height: 100%;
}

.property-images-swiper .swiper-slide {
    width: 100%;
    height: 100%;
}

.property-images-swiper .swiper-button-next,
.property-images-swiper .swiper-button-prev {
    color: white;
    background: rgba(0, 0, 0, 0.5);
    width: 32px;
    height: 32px;
    border-radius: 50%;
    transition: all 0.3s ease;
    opacity: 0;
}

.property-images-swiper:hover .swiper-button-next,
.property-images-swiper:hover .swiper-button-prev {
    opacity: 1;
}

.property-images-swiper .swiper-button-next:hover,
.property-images-swiper .swiper-button-prev:hover {
    background: rgba(0, 0, 0, 0.7);
    transform: scale(1.1);
}

.property-images-swiper .swiper-button-next::after,
.property-images-swiper .swiper-button-prev::after {
    font-size: 14px;
    font-weight: bold;
}

.property-images-swiper .swiper-button-next {
    right: 8px;
}

.property-images-swiper .swiper-button-prev {
    left: 8px;
}

/* Afficher les flèches au hover du conteneur */
.group\/image-container:hover [class*="property-image-next"],
.group\/image-container:hover [class*="property-image-prev"] {
    opacity: 1;
}
</style>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import SeoHead from '../Components/SeoHead.vue';

import { computed } from 'vue';

const props = defineProps({
    totalAnnonces: Number,
    immobilliersBoost: Object,
    maisons: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    chambres: Object,
    chambresBoost: Object,
    villas: Object,
    villasBoost: Object,
    immeubles: Object,
    immeublesBoost: Object,
    terrains: Object,
    terrainsBoost: Object,
    vergers: Object,
    vergersBoost: Object,
    appartements: Object,
    appartementsBoost: Object,
    studios: Object,
    studiosBoost: Object,
});
</script>

<script>
import { Inertia } from '@inertiajs/inertia';
import Footer from '../Components/Footer.vue';
import Navbar from '../Components/Navbar.vue';
import Toast from '../Components/Toast.vue';
import CookieBanner from '../Components/CookieBanner.vue';
import ChatBot from '../Components/ChatBot.vue';

export default {
    components: {
        Toast,
        Footer,
        Navbar,
        CookieBanner,
        ChatBot,
    },
    data() {
        return {
            activeTab: 'Immobilier', // Par défaut, afficher tous les biens
            favorites: new Set(),
            showToast: false,
            toastMessage: '',
            toastType: 'success',
            searchQuery: '',
            showAlertForm: false,
            searchSuggestions: [],
            showSuggestions: false,
            selectedSuggestionIndex: -1,
            searchTimeout: null,
            categoryItems: [
                { id: 1, icon: 'home', name: 'Villa', type: 'Villa', slug: 'villa' },
                { id: 2, icon: 'building', name: 'Appartements', type: 'appartement', slug: 'appartements' },
                { id: 3, icon: 'bed', name: 'Chambre', type: 'Chambre', slug: 'chambre' },
                { id: 4, icon: 'home', name: 'Studio', type: 'studio', slug: 'studio' },
                { id: 5, icon: 'building', name: 'Immeuble', type: 'Immeuble', slug: 'immeuble' },
                { id: 6, icon: 'map-marked', name: 'Terrain', type: 'Terrain', slug: 'terrain' },
                { id: 7, icon: 'key', name: 'Immobilier', type: 'all', slug: 'immobilier' },
            ],
            villesPopulaires: [
                { nom: 'Dakar', image: 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800&h=600&fit=crop' },
                { nom: 'Thiès', image: 'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=800&h=600&fit=crop' },
                { nom: 'Saint-Louis', image: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop' },
                { nom: 'Kaolack', image: 'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=800&h=600&fit=crop' },
                { nom: 'Ziguinchor', image: 'https://images.unsplash.com/photo-1514565131-fce0801e5785?w=800&h=600&fit=crop' },
                { nom: 'Rufisque', image: 'https://images.unsplash.com/photo-1514565131-fce0801e5785?w=800&h=600&fit=crop' },
                { nom: 'Louga', image: 'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=800&h=600&fit=crop' },
                { nom: 'Tambacounda', image: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop' },
                { nom: 'Kolda', image: 'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=800&h=600&fit=crop' },
                { nom: 'Mbour', image: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop' },
            ],
            selectedCity: null,
            villesPrincipales: [
                {
                    nom: 'Dakar',
                    types: [
                        { label: 'Villas à Dakar', slug: 'villa', icon: 'home' },
                        { label: 'Appartements à Dakar', slug: 'appartements', icon: 'building' },
                        { label: 'Chambres à Dakar', slug: 'chambre', icon: 'bed' },
                        { label: 'Studios à Dakar', slug: 'studio', icon: 'home' },
                        { label: 'Immeubles à Dakar', slug: 'immeuble', icon: 'building' },
                    ]
                },
                {
                    nom: 'Thiès',
                    types: [
                        { label: 'Villas à Thiès', slug: 'villa', icon: 'home' },
                        { label: 'Appartements à Thiès', slug: 'appartements', icon: 'building' },
                        { label: 'Chambres à Thiès', slug: 'chambre', icon: 'bed' },
                        { label: 'Studios à Thiès', slug: 'studio', icon: 'home' },
                    ]
                },
                {
                    nom: 'Saint-Louis',
                    types: [
                        { label: 'Villas à Saint-Louis', slug: 'villa', icon: 'home' },
                        { label: 'Appartements à Saint-Louis', slug: 'appartements', icon: 'building' },
                        { label: 'Chambres à Saint-Louis', slug: 'chambre', icon: 'bed' },
                        { label: 'Studios à Saint-Louis', slug: 'studio', icon: 'home' },
                    ]
                },
                {
                    nom: 'Kaolack',
                    types: [
                        { label: 'Villas à Kaolack', slug: 'villa', icon: 'home' },
                        { label: 'Appartements à Kaolack', slug: 'appartements', icon: 'building' },
                        { label: 'Chambres à Kaolack', slug: 'chambre', icon: 'bed' },
                        { label: 'Studios à Kaolack', slug: 'studio', icon: 'home' },
                    ]
                },
                {
                    nom: 'Ziguinchor',
                    types: [
                        { label: 'Villas à Ziguinchor', slug: 'villa', icon: 'home' },
                        { label: 'Appartements à Ziguinchor', slug: 'appartements', icon: 'building' },
                        { label: 'Chambres à Ziguinchor', slug: 'chambre', icon: 'bed' },
                        { label: 'Studios à Ziguinchor', slug: 'studio', icon: 'home' },
                    ]
                },
                {
                    nom: 'Rufisque',
                    types: [
                        { label: 'Villas à Rufisque', slug: 'villa', icon: 'home' },
                        { label: 'Appartements à Rufisque', slug: 'appartements', icon: 'building' },
                        { label: 'Chambres à Rufisque', slug: 'chambre', icon: 'bed' },
                        { label: 'Studios à Rufisque', slug: 'studio', icon: 'home' },
                    ]
                },
                {
                    nom: 'Louga',
                    types: [
                        { label: 'Villas à Louga', slug: 'villa', icon: 'home' },
                        { label: 'Appartements à Louga', slug: 'appartements', icon: 'building' },
                        { label: 'Chambres à Louga', slug: 'chambre', icon: 'bed' },
                        { label: 'Studios à Louga', slug: 'studio', icon: 'home' },
                    ]
                },
                {
                    nom: 'Tambacounda',
                    types: [
                        { label: 'Villas à Tambacounda', slug: 'villa', icon: 'home' },
                        { label: 'Appartements à Tambacounda', slug: 'appartements', icon: 'building' },
                        { label: 'Chambres à Tambacounda', slug: 'chambre', icon: 'bed' },
                    ]
                },
            ],
            regionsSenegal: [
                { nom: 'Dakar', count: 0 },
                { nom: 'Thiès', count: 0 },
                { nom: 'Diourbel', count: 0 },
                { nom: 'Fatick', count: 0 },
                { nom: 'Kaolack', count: 0 },
                { nom: 'Kolda', count: 0 },
                { nom: 'Louga', count: 0 },
                { nom: 'Matam', count: 0 },
                { nom: 'Saint-Louis', count: 0 },
                { nom: 'Sédhiou', count: 0 },
                { nom: 'Tambacounda', count: 0 },
                { nom: 'Ziguinchor', count: 0 },
                { nom: 'Kaffrine', count: 0 },
                { nom: 'Kédougou', count: 0 },
            ],
        };
    },
    computed: {
        villesPopulairesAvecCount() {
            // Calculer le nombre de biens par ville
            return this.villesPopulaires.map(ville => {
                const count = this.getCountByCity(ville.nom);
                return { ...ville, count };
            }).sort((a, b) => b.count - a.count); // Trier par nombre décroissant
        },
    },
    mounted() {
        if (this.$page.props.auth?.user) {
            this.loadFavorites();
        }
        
        // Calculer les compteurs pour les régions
        this.calculateRegionCounts();
        
        // Initialiser Swiper pour les villes et les annonces récentes
        this.$nextTick(() => {
            this.initializeVillesSwiper();
            this.initializeRecentAnnoncesSwiper();
        });
    },
    methods: {
        navigateToDetail(id) {
            this.$inertia.visit(`/detail/${id}`);
        },
        navigateToCategory(slug) {
            this.$inertia.visit(`/categorie/${slug}`);
        },
        handleSearch() {
            if (this.searchQuery.trim()) {
                this.showSuggestions = false;
                this.$inertia.visit(`/p/immobilier?search=${encodeURIComponent(this.searchQuery)}`);
            }
        },
        async handleSearchInput() {
            // Réinitialiser l'index de sélection
            this.selectedSuggestionIndex = -1;
            
            // Annuler le timeout précédent
            if (this.searchTimeout) {
                clearTimeout(this.searchTimeout);
            }
            
            // Si la requête est trop courte, ne pas chercher
            if (this.searchQuery.length < 2) {
                this.searchSuggestions = [];
                this.showSuggestions = false;
                return;
            }
            
            // Attendre 300ms avant de faire la requête (debounce)
            this.searchTimeout = setTimeout(async () => {
                try {
                    const response = await fetch(`/api/search/suggestions?q=${encodeURIComponent(this.searchQuery)}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    
                    if (response.ok) {
                        const data = await response.json();
                        this.searchSuggestions = data.suggestions || [];
                        this.showSuggestions = this.searchSuggestions.length > 0;
                    }
                } catch (error) {
                    console.error('Erreur lors de la recherche de suggestions:', error);
                    this.searchSuggestions = [];
                }
            }, 300);
        },
        selectSuggestion(index) {
            if (index >= 0 && index < this.searchSuggestions.length) {
                const suggestion = this.searchSuggestions[index];
                this.showSuggestions = false;
                if (suggestion.url) {
                    this.$inertia.visit(suggestion.url);
                } else {
                    this.searchQuery = suggestion.value;
                    this.handleSearch();
                }
            } else if (this.selectedSuggestionIndex >= 0 && this.selectedSuggestionIndex < this.searchSuggestions.length) {
                // Si index n'est pas fourni, utiliser selectedSuggestionIndex
                const suggestion = this.searchSuggestions[this.selectedSuggestionIndex];
                this.showSuggestions = false;
                if (suggestion.url) {
                    this.$inertia.visit(suggestion.url);
                } else {
                    this.searchQuery = suggestion.value;
                    this.handleSearch();
                }
            }
        },
        navigateSuggestions(direction) {
            if (this.searchSuggestions.length === 0) return;
            
            if (direction === 'down') {
                this.selectedSuggestionIndex = (this.selectedSuggestionIndex + 1) % this.searchSuggestions.length;
            } else if (direction === 'up') {
                this.selectedSuggestionIndex = this.selectedSuggestionIndex <= 0 
                    ? this.searchSuggestions.length - 1 
                    : this.selectedSuggestionIndex - 1;
            }
        },
        hideSuggestions() {
            // Délai pour permettre le clic sur une suggestion
            setTimeout(() => {
                this.showSuggestions = false;
            }, 200);
        },
        searchByCity(city) {
            this.searchQuery = city;
            this.handleSearch();
        },
        filterByCity(city) {
            // Filtrer les annonces par ville
            this.selectedCity = this.selectedCity === city ? null : city;
            // Scroll vers la section des annonces
            this.$nextTick(() => {
                const section = document.querySelector('.bg-gray-50');
                if (section) {
                    section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        },
        clearCityFilter() {
            this.selectedCity = null;
        },
        calculateRegionCounts() {
            // Calculer le nombre de biens par région
            const allData = [
                ...(this.maisons?.data || []),
                ...(this.villas || []),
                ...(this.appartements?.data || []),
                ...(this.chambres?.data || []),
                ...(this.studios?.data || []),
                ...(this.immeubles?.data || []),
                ...(this.terrains?.data || []),
            ];
            
            this.regionsSenegal = this.regionsSenegal.map(region => {
                const count = allData.filter(item => 
                    item.region && item.region.toLowerCase().includes(region.nom.toLowerCase())
                ).length;
                return { ...region, count };
            });
        },
        getCountByCity(cityName) {
            // Compter tous les biens pour une ville donnée
            let count = 0;
            
            // Normaliser le nom de la ville pour la comparaison (insensible à la casse)
            const normalizedCity = cityName.toLowerCase();
            
            // Compter dans toutes les sources de données
            const allData = [
                ...(this.maisons?.data || []),
                ...(this.chambres?.data || []),
                ...(this.appartements?.data || []),
                ...(this.studios?.data || []),
                ...(this.immeubles?.data || []),
                ...(this.terrains?.data || []),
                ...(this.vergers?.data || []),
                ...(Array.isArray(this.villas) ? this.villas : []),
            ];
            
            allData.forEach(item => {
                if (item.region && item.region.toLowerCase().includes(normalizedCity)) {
                    count++;
                }
            });
            
            return count;
        },
        formatNumber(num) {
            return new Intl.NumberFormat('fr-FR').format(num);
        },
        get ogImage() {
            return window.location.origin + '/logo.png';
        },
        get structuredData() {
            return {
                '@context': 'https://schema.org',
                '@type': 'WebSite',
                'name': 'NoflayHub',
                'description': 'Plateforme de location immobilière au Sénégal',
                'url': window.location.origin,
                'potentialAction': {
                    '@type': 'SearchAction',
                    'target': {
                        '@type': 'EntryPoint',
                        'urlTemplate': window.location.origin + '/p/immobilier?search={search_term_string}'
                    },
                    'query-input': 'required name=search_term_string'
                },
                'publisher': {
                    '@type': 'Organization',
                    'name': 'NoflayHub',
                    'logo': {
                        '@type': 'ImageObject',
                        'url': window.location.origin + '/logo.png'
                    }
                }
            };
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
        handleCityImageError(event) {
            if (event.target && !event.target.dataset.errorHandled) {
                event.target.dataset.errorHandled = 'true';
                event.target.src = 'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=800&h=600&fit=crop';
                event.target.onerror = null;
            }
        },
        getCurrentData() {
            // Retourner les données selon la catégorie sélectionnée
            const category = this.categoryItems.find(item => item.name === this.activeTab);
            let data = [];
            
            if (!category || category.type === 'all') {
                data = this.maisons?.data || [];
            } else {
                switch(category.type) {
                    case 'Villa':
                        data = Array.isArray(this.villas) ? this.villas : (this.villas?.data || []);
                        break;
                    case 'appartement':
                        data = this.appartements?.data || [];
                        break;
                    case 'Chambre':
                        data = this.chambres?.data || [];
                        break;
                    case 'studio':
                        data = this.studios?.data || [];
                        break;
                    case 'Immeuble':
                        data = this.immeubles?.data || [];
                        break;
                    case 'Terrain':
                        data = this.terrains?.data || [];
                        break;
                    case 'Verger':
                        data = this.vergers?.data || [];
                        break;
                    default:
                        data = this.maisons?.data || [];
                }
            }
            
            // Filtrer par ville si une ville est sélectionnée
            if (this.selectedCity) {
                const normalizedCity = this.selectedCity.toLowerCase();
                data = data.filter(item => {
                    return item.region && item.region.toLowerCase().includes(normalizedCity);
                });
            }
            
            return data;
        },
        getBoostedData() {
            // Retourner les données boostées selon la catégorie sélectionnée
            const category = this.categoryItems.find(item => item.name === this.activeTab);
            let data = [];
            
            if (!category || category.type === 'all') {
                data = this.immobilliersBoost?.data || [];
            } else {
                switch(category.type) {
                    case 'Villa':
                        data = Array.isArray(this.villasBoost) ? this.villasBoost : (this.villasBoost?.data || []);
                        break;
                    case 'appartement':
                        data = this.appartementsBoost?.data || [];
                        break;
                    case 'Chambre':
                        data = this.chambresBoost?.data || [];
                        break;
                    case 'studio':
                        data = this.studiosBoost?.data || [];
                        break;
                    case 'Immeuble':
                        data = this.immeublesBoost?.data || [];
                        break;
                    case 'Terrain':
                        data = this.terrainsBoost?.data || [];
                        break;
                    case 'Verger':
                        data = this.vergersBoost?.data || [];
                        break;
                    default:
                        data = this.immobilliersBoost?.data || [];
                }
            }
            
            // Filtrer par ville si une ville est sélectionnée
            if (this.selectedCity) {
                const normalizedCity = this.selectedCity.toLowerCase();
                data = data.filter(item => {
                    return item.region && item.region.toLowerCase().includes(normalizedCity);
                });
            }
            
            return data;
        },
        getCategoryLabel() {
            const category = this.categoryItems.find(item => item.name === this.activeTab);
            return category ? `- ${category.name}` : '';
        },
        getBoostedLink() {
            const category = this.categoryItems.find(item => item.name === this.activeTab);
            if (category && category.slug) {
                return `/categorie/${category.slug}?boosted=true`;
            }
            return '/p/immobilier?boosted=true';
        },
        hasMultipleImages(article) {
            let count = 0;
            if (article.image1 && article.image1 !== '' && article.image1 !== 'null') count++;
            if (article.image2 && article.image2 !== '' && article.image2 !== 'null') count++;
            if (article.image3 && article.image3 !== '' && article.image3 !== 'null') count++;
            return count > 1;
        },
        hasAnyImage(article) {
            return (article.image1 && article.image1 !== '' && article.image1 !== 'null') ||
                   (article.image2 && article.image2 !== '' && article.image2 !== 'null') ||
                   (article.image3 && article.image3 !== '' && article.image3 !== 'null');
        },
        initializeVillesSwiper() {
            // Initialiser Swiper pour les villes populaires
            if (typeof Swiper !== 'undefined') {
                new Swiper('#villes-swiper', {
                    slidesPerView: 1,
            spaceBetween: 20,
                    loop: false,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    navigation: {
                        nextEl: '.villes-next',
                        prevEl: '.villes-prev',
                    },
            pagination: {
                        el: '.villes-pagination',
                clickable: true,
                        dynamicBullets: true,
                    },
                    breakpoints: {
                        480: {
                            slidesPerView: 2,
                            spaceBetween: 15,
                        },
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 20,
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 20,
                        },
                        1280: {
                            slidesPerView: 5,
                            spaceBetween: 20,
                        },
            },
        });
            }
        },
        initializeRecentAnnoncesSwiper() {
            // Initialiser Swiper pour les annonces récentes
            if (typeof Swiper !== 'undefined') {
                new Swiper('#recent-annonces-swiper', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    loop: false,
            autoplay: {
                        delay: 5000,
                disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    navigation: {
                        nextEl: '.recent-next',
                        prevEl: '.recent-prev',
                    },
                    pagination: {
                        el: '.recent-pagination',
                        clickable: true,
                        dynamicBullets: true,
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 20,
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 20,
                        },
            },
        });

                // Initialiser les carousels d'images pour chaque propriété
                this.$nextTick(() => {
                    this.initializePropertyImageCarousels();
                });
            }
        },
        initializePropertyImageCarousels() {
            // Initialiser un Swiper pour chaque propriété qui a plusieurs images
            if (typeof Swiper !== 'undefined') {
                this.$nextTick(() => {
                    this.maisons?.data?.forEach(maison => {
                        if (this.hasMultipleImages(maison)) {
                            const swiperId = `#property-images-${maison.id}`;
                            const swiperElement = document.querySelector(swiperId);
                            if (swiperElement && !swiperElement.swiper) {
                                new Swiper(swiperId, {
                                    slidesPerView: 1,
                                    spaceBetween: 0,
                                    loop: true,
                                    navigation: {
                                        nextEl: `.property-image-next-${maison.id}`,
                                        prevEl: `.property-image-prev-${maison.id}`,
                                    },
                                    allowTouchMove: true,
                                });
                            }
                        }
                    });
                });
            }
        },
    },
};
</script>
