<script>
import Action from "../BoutCode/Action.vue";
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';

export default {
    components: {
        Action
    },
    props: {
        chambres: {
            type: Object,
            required: true
        },
        chambresBoost: {
            type: Object,
            required: true
        },
    },
    setup(props) {
        const selectedRegion = ref('Toutes les régions');
        
        // Liste des régions disponibles (à adapter selon tes besoins)
        const regions = computed(() => {
            const allRegions = props.chambres.data.map(chambre => chambre.region);
            return ['Toutes les régions', ...new Set(allRegions)].filter(Boolean);
        });
        
        // Filtrage des chambres par région
        const filteredChambres = computed(() => {
            if (selectedRegion.value === 'Toutes les régions') {
                return props.chambres.data;
            }
            return props.chambres.data.filter(chambre => chambre.region === selectedRegion.value);
        });
        
        // Navigation vers les détails
        const navigateToDetail = (id) => {
            router.visit(`/detail/${id}`);
        };
        
        // Navigation entre les pages
        const goToPage = (url) => {
            if (url) {
                router.visit(url, { preserveScroll: true });
            }
        };
        
        return {
            selectedRegion,
            regions,
            filteredChambres,
            navigateToDetail,
            goToPage
        };
    }
};
</script>

<template>
    <div class="swiper">
        <!-- Boostées -->
        <div class="swiper-wrapper grid grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-6 mb-8">
            <div v-for="chambreBoost in chambresBoost.data" :key="chambreBoost.id"
                @click="navigateToDetail(chambreBoost.id)" class="swiper-slide w-full p-1 cursor-pointer">
                <div class="card group relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 h-full flex flex-col">
                    <!-- Badge Boost -->
                    <div class="absolute top-4 right-4 z-10">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-400 to-yellow-500 text-white shadow-md">
                            <i class="fas fa-bolt mr-1"></i> Boost
                        </span>
                    </div>
                    <div class="aspect-square overflow-hidden relative">
                        <img :src="'/storage/' + chambreBoost.image1" :alt="chambreBoost.imageAlt || 'Photo de la chambre'"
                            class="h-full w-full object-cover transition-all duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-4 space-y-2 flex-grow">
                        <p class="text-lg font-bold text-principal">
                            {{ chambreBoost.prix }} <span class="text-sm text-secondaire">Fcfa</span>
                        </p>
                        <p class="text-secondaire font-medium truncate">
                            {{ chambreBoost.nom.substring(0, 20) }}
                        </p>
                        <div class="flex items-center text-sm text-principal border-t border-gray-100 pt-2 mt-2">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ chambreBoost.region }}, Senegal
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-principal to-principal-dark text-white py-3 px-4 transform transition-all duration-300 hover:opacity-90 group-hover:translate-y-0 flex items-center justify-center space-x-2">
                        <i class="fas fa-phone-alt"></i>
                        <span>Contacter</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Section annonces -->
        <Action/>

        <section class="py-8" id="transparent">
            <div class="mx-auto max-w-screen-xl px-4">
                <div class="mx-auto max-w-md text-center mb-12 relative">
                    <h2 class="text-3xl font-bold text-secondaire inline-flex items-center">
                        <i class="fas fa-bed mr-3 text-principal"></i>
                        Chambres au Sénégal
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-principal to-secondaire mx-auto mt-4 rounded-full"></div>
                </div>
                
                <!-- Filtre par région -->
                <div class="region-filter mb-6 flex justify-end">
                    <label for="region" class="mr-2 font-semibold text-secondaire">Filtrer par région :</label>
                    <select v-model="selectedRegion" id="region" class="border rounded px-2 py-1">
                        <option v-for="region in regions" :key="region" :value="region">
                            {{ region }}
                        </option>
                    </select>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <article v-for="chambre in filteredChambres" :key="chambre.id" @click="navigateToDetail(chambre.id)"
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 h-full flex flex-col cursor-pointer">
                        <div class="relative">
                            <img :src="'/storage/' + chambre.image1" :alt="chambre.imageAlt || 'Image de la chambre'"
                                class="w-full h-64 object-cover" loading="lazy">
                            <div class="absolute top-4 left-4">
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ chambre.affaire }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex-grow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold mb-1 text-principal">
                                        {{ chambre.nom.substring(0, 20) }}{{ chambre.nom.length > 20 ? '...' : '' }}
                                    </h3>
                                    <p class="text-gray-600 mb-2">
                                        <i class="fas fa-map-marker-alt text-[#eb2d53] mr-2"></i>
                                        {{ chambre.region }}, Sénégal
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-4 border-b-2 border-gray-300">
                                <div>
                                    <span class="text-gray-500 text-sm">Prix:</span>
                                    <span class="text-lg font-bold text-[#eb2d53]">
                                        {{ chambre.prix }} FCFA
                                    </span>
                                </div>
                                <button class="text-[#eb2d53] hover:text-indigo-800" aria-label="Ajouter aux favoris">
                                    <i class="far fa-heart text-xl"></i>
                                </button>
                            </div>
                            <div v-if="chambre.status == 'accepter'" class="mt-6 ">
                                <a href="#" class="block text-center bg-[#eb2d53] hover:bg-[#d12648] text-white py-2 rounded-lg transition duration-300">
                                    <span class="flex items-center justify-center space-x-2">
                                        <i class="fas fa-phone-alt"></i>
                                        <span>Contacter</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
                
                <!-- Pagination -->
                <div v-if="chambres.links && chambres.links.length > 1" class="flex justify-center mt-8 space-x-2">
                    <button 
                        v-for="link in chambres.links" 
                        :key="link.label"
                        :disabled="!link.url"
                        @click.prevent="goToPage(link.url)"
                        v-html="link.label"
                        class="px-3 py-1 rounded border text-principal hover:bg-principal hover:text-white transition disabled:opacity-50 disabled:cursor-not-allowed"
                        :class="{'bg-principal text-white': link.active}">
                    </button>
                </div>
            </div>
        </section>
    </div>
</template>
