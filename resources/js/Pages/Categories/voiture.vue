<script setup>
const props = defineProps({
    voitures: Object,
    voituresBoost: Object,
    immobilliersBoost: Object,
    maisons: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    chambres: Object,
    chambresBoost: Object,
});
</script>

<template>
    <div class="swiper">
        <!-- Section des voitures boostées -->
        <div class="swiper-wrapper grid grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-6">
            <div v-for="voitureBoost in voituresBoost.data" :key="voitureBoost.id"
                 @click="navigateToDetailVehi(voitureBoost.id)" class="swiper-slide w-full p-1">
                <div class="card relative">
                    <!-- Image -->
                    <div class="aspect-square overflow-hidden">
                        <img :src="'/storage/' + voitureBoost.image1"
                             :alt="voitureBoost.imageAlt || 'Photo de la voiture'"
                             class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" />
                    </div>

                    <!-- Affaire Label -->
                    <div
                        class="absolute top-0 m-2 rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3">
                        {{ voitureBoost.affaire }}
                    </div>

                    <!-- Content Section -->
                    <div class="my-2 mx-2 text-center flex-col items-start justify-between">
                        <span class="block text-xl font-semibold text-secondaire">
                            {{ voitureBoost.nom.substring(0, 20) }}
                        </span>

                        <div>
                            <span class="block text-sm font-semibold text-troisieme truncate">
                                {{ voitureBoost.prix }} XOF
                            </span>
                        </div>

                        <h3 class="text-sm text-secondaire w-full border-b-[1px] border-gray-200">
                            {{ voitureBoost.region }}, Sénégal
                        </h3>
                    </div>

                    <!-- Contact Button -->
                    <div class="pb-3">
                        <button
                            class="bg-principal w-[80%] group mx-auto flex h-8 items-center justify-center rounded-md text-white uppercase transition-colors hover:text-secondaire">
                            <div class="text-xs font-bold">
                                Contacter
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section "Déposer une annonce" -->
        <div
            class="bg-transparent border border-principal my-5 rounded-[20px] w-[90%] mx-[5%] h-[10vh] flex items-center justify-center">
            <div class="text-center">
                <div class="txt flex items-center mx-auto">
                    <span class="text-secondaire text-lg md:text-3xl">C'est le moment de vendre</span>

                    <div class="flex items-center border-2 border-principal rounded-[10px] p-1 mx-2">
                        <i class="fas fa-plus text-principal px-1"></i>
                        <a :href="route('publier')" class="text-secondaire text-sm md:text-lg ml-1 md:ml-2">
                            Déposer une annonce
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section des marques populaires -->

        <!-- Section des dernières annonces -->
        <section class="py-1 text-secondaire sm:py-16 lg:py-1" id="transparent">
            <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-md text-center">
                    <h2 class="font-serif text-2xl font-bold sm:text-2xl">Dernières Annonces au Sénégal</h2>
                </div>
                <div class="region-filter mb-8">
                    <label for="marque" class="block text-sm font-medium text-principal mb-2">Filtrer par marque</label>
                    <select v-model="selectedMarque" id="marque"
                            class="w-full p-2 border border-principal rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-secondaire focus:border-secondaire transition-all duration-300">
                        <option v-for="marque in marquesPopulaires" :key="marque" :value="marque"
                                class="text-principal">
                            {{ marque }}
                        </option>
                    </select>
                </div>

                <!-- Grille des voitures filtrées -->
                <div v-if="filteredVoitures.length > 0"
                     class="mt-10 grid grid-cols-2 gap-6 sm:grid-cols-4 sm:gap-4 lg:mt-16">
                    <article v-for="voiture in filteredVoitures" :key="voiture.id"
                             @click="navigateToDetailVehi(voiture.id)"
                             class="relative flex flex-col overflow-hidden rounded-lg border hover:shadow-lg transition-shadow duration-300">
                        <div class="card">
                            <!-- Image -->
                            <div class="aspect-square overflow-hidden">
                                <img :src="'/storage/' + voiture.image1"
                                     :alt="voiture.imageAlt || 'Photo de la voiture'"
                                     class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" />
                            </div>

                            <!-- Label (Affaire) -->
                            <div
                                class="absolute top-0 m-2 rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3">
                                {{ voiture.affaire }}
                            </div>

                            <!-- Content -->
                            <div class="flex flex-col justify-between w-10/12 mx-auto my-2">
                                <p class="text-lg font-semibold text-principal truncate">
                                    {{ voiture.nom.substring(0, 20) }}
                                </p>

                                <div class="text-sm text-gray-600">
                                    <span>{{ voiture.marque }} {{ voiture.model }} - {{ voiture.boiteVitesse }}</span>
                                </div>

                                <h3 class="text-sm text-principal border-b-[1px] border-gray-400">
                                    {{ voiture.region }}, Sénégal
                                </h3>

                                <div class="flex justify-between mt-2">
                                    <div>
                                        <span class="text-secondaire text-lg font-semibold">
                                            {{ voiture.prix }} F <span class="text-principal">CFA</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Booster status -->
                            <div v-if="voiture.status == 'accepter'"
                                 class="bg-principal flex h-8 items-center justify-center rounded-md text-white font-semibold">
                                <span>Connecter</span>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Message si aucune voiture n'est trouvée -->
                <div v-else class="mt-10 text-center">
                    <p class="text-secondaire text-lg font-semibold">Aucune voiture trouvée pour la marque <span
                        class="text-principal"> "{{
                            selectedMarque }}"
                        </span> n'a pas été publié .</p>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {

            selectedRegion: 'tous', // Par défaut, "tous"
            selectedMarque: 'tous', // Nouvelle propriété pour la marque sélectionnée
            marquesPopulaires: [ // Liste des marques populaires
                "tous",
                "volvo",
                "renault",
                "peugeot",
                "citroen",
                "mitsubishi",
                "bmw",
                "audi",
                "nissan",
                "mercedes-benz",
                "volkswagen",
                "toyota",
                "ford",
                "Jeep",
                "Fiat",
            ],
        };
    },
    props: {
        voituresBoost: {
            type: Object,
            required: true,
        },
        voitures: {
            type: Object,
            required: true,
        },
    },
    computed: {
        filteredVoitures() {
            if (this.selectedMarque === 'tous') {
                return this.voitures.data; // Retourne toutes les voitures si "tous" est sélectionné
            }
            return this.voitures.data.filter(voiture => voiture.marque === this.selectedMarque);
        },
    },
    methods: {
        navigateToDetailVehi(id) {
            this.$inertia.visit(`/detailVehi/${id}`);
        },
    },
};
</script>
