<script setup>
import Action from "../BoutCode/Action.vue";

const props = defineProps({
    immobiliers: Object,
    immobiliersBoost: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <div class="swiper">
        <!-- Biens immobiliers boostés -->
        <div v-if="immobiliersBoost && immobiliersBoost.data && immobiliersBoost.data.length > 0" class="swiper-wrapper grid grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-6 mb-8">
            <div v-for="immobilierBoost in immobiliersBoost.data" :key="immobilierBoost.id"
                @click="navigateToDetailImmo(immobilierBoost.id)" class="swiper-slide w-full p-1 cursor-pointer">
                <div class="card group relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 h-full flex flex-col">
                    <!-- Badge Boost -->
                    <div class="absolute top-4 right-4 z-10">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-400 to-yellow-500 text-white shadow-md">
                            <i class="fas fa-bolt mr-1"></i> Boost
                        </span>
                    </div>
                    <div class="aspect-square overflow-hidden relative">
                        <img :src="'/storage/' + immobilierBoost.image1" :alt="immobilierBoost.titre || 'Photo du bien immobilier'"
                            class="h-full w-full object-cover transition-all duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-4 space-y-2 flex-grow">
                        <p class="text-lg font-bold text-principal">
                            {{ immobilierBoost.prix }} <span class="text-sm text-secondaire">Fcfa</span>
                        </p>
                        <p class="text-secondaire font-medium truncate">
                            {{ immobilierBoost.titre ? immobilierBoost.titre.substring(0, 20) : '' }}
                        </p>
                        <div class="flex items-center text-sm text-principal border-t border-gray-100 pt-2 mt-2">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ immobilierBoost.region }}, Sénégal
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-principal to-principal-dark text-white py-3 px-4 transform transition-all duration-300 hover:opacity-90 group-hover:translate-y-0 flex items-center justify-center space-x-2">
                        <i class="fas fa-phone-alt"></i>
                        <span>Contacter</span>
                    </button>
                </div>
            </div>
        </div>

        <Action/>

        <!-- Section annonces immobilières -->
        <section class="py-8" id="transparent">
            <div class="mx-auto max-w-screen-xl px-4">
                <div class="mx-auto max-w-md text-center mb-12 relative">
                    <h2 class="text-3xl font-bold text-secondaire inline-flex items-center">
                        <i class="fas fa-home mr-3 text-principal"></i>
                        Derniers Biens Immobiliers au Sénégal
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-principal to-secondaire mx-auto mt-4 rounded-full"></div>
                </div>
                
                <div class="region-filter mb-6 flex justify-end">
                    <label for="region" class="mr-2 font-semibold text-secondaire">Filtrer par région :</label>
                    <select v-model="selectedRegion" id="region" class="border rounded px-2 py-1">
                        <option value="">Toutes les régions</option>
                        <option v-for="region in regions" :key="region" :value="region">
                            {{ region }}
                        </option>
                    </select>
                </div>

                <div v-if="immobiliers && immobiliers.data && immobiliers.data.length > 0" class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <article v-for="immobilier in filteredImmobiliers" :key="immobilier.id"
                        @click="navigateToDetailImmo(immobilier.id)"
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 h-full flex flex-col cursor-pointer">
                        <div class="relative">
                            <img v-if="immobilier.image1" :src="'/storage/' + immobilier.image1" 
                                :alt="immobilier.titre || 'Image du bien immobilier'"
                                class="w-full h-64 object-cover" loading="lazy">
                            <div class="absolute top-4 left-4">
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ immobilier.type_offre }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex-grow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold mb-1 text-principal">
                                        {{ immobilier.titre ? immobilier.titre.substring(0, 30) : '' }}{{ immobilier.titre && immobilier.titre.length > 30 ? '...' : '' }}
                                    </h3>
                                    <p class="text-gray-600 mb-2">
                                        <i class="fas fa-map-marker-alt text-[#eb2d53] mr-2"></i>
                                        {{ immobilier.region }}, Sénégal
                                    </p>
                                </div>
                                <span class="text-lg font-bold text-principal">
                                    {{ immobilier.prix }} FCFA
                                </span>
                            </div>
                            <div class="border-t border-gray-100 pt-3 mt-3 grid grid-cols-2 gap-2 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <i class="fas fa-vector-square mr-2 text-principal"></i>
                                    {{ immobilier.superficie }} m²
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-bed mr-2 text-principal"></i>
                                    {{ immobilier.nbr_chambre }} chambres
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-bath mr-2 text-principal"></i>
                                    {{ immobilier.nbr_salle_bain }} sdb
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-car mr-2 text-principal"></i>
                                    {{ immobilier.nbr_garage || 0 }} parking
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div v-else class="text-center py-10">
                    <p class="text-gray-500">Aucun bien immobilier disponible pour le moment.</p>
                </div>

                <!-- Pagination -->
                <div v-if="immobiliers && immobiliers.links && immobiliers.links.length > 3" class="mt-8 flex justify-center">
                    <div class="flex flex-wrap -mb-1">
                        <template v-for="(link, key) in immobiliers.links" :key="key">
                            <div v-if="link.url === null" 
                                 class="mr-1 mb-1 px-4 py-2 text-sm text-gray-400 border rounded"
                                 v-html="link.label">
                            </div>
                            <button v-else
                                @click="goToPage(link.url)"
                                :class="{'bg-principal text-white': link.active, 'bg-white text-principal': !link.active}"
                                class="mr-1 mb-1 px-4 py-2 text-sm border rounded hover:bg-principal hover:text-white transition-colors"
                                v-html="link.label">
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            selectedRegion: '',
            regions: [
                'Dakar', 'Thiès', 'Saint-Louis', 'Ziguinchor', 'Diourbel', 
                'Tambacounda', 'Kaolack', 'Fatick', 'Kolda', 'Matam', 'Kaffrine',
                'Kédougou', 'Sédhiou', 'Kolda', 'Kédougou', 'Kolda', 'Sédhiou'
            ]
        };
    },
    computed: {
        filteredImmobiliers() {
            if (!this.immobiliers || !this.immobiliers.data) return [];
            
            return this.immobiliers.data.filter(immobilier => {
                if (!this.selectedRegion) return true;
                return immobilier.region === this.selectedRegion;
            });
        }
    },
    methods: {
        navigateToDetailImmo(id) {
            this.$inertia.get(route('immobilier.detail', id));
        },
        goToPage(url) {
            if (url) {
                this.$inertia.visit(url);
            }
        }
    }
}
</script>

<style scoped>
.aspect-square {
    aspect-ratio: 1/1;
}

.swiper-slide {
    height: auto;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}
</style>
