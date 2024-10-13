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
    maison: Object,
    chambres: Object,
    chambresBoost: Object,
});


</script>

<template>
    <div class="swiper">
        <div class="swiper-wrapper">
            <div v-for="chambreBoost in chambresBoost.data" :key="chambreBoost.id"
                @click="navigateToDetail(chambreBoost.id)"
                class="swiper-slide w-full sm:w-1/4 md:w-1/4 lg:w-1/6 xl:w-1/6 p-1">
                <!-- Immobilier Card -->
                <div class="card">
                    <div class="aspect-square overflow-hidden">
                        <img :src="'/storage/' + chambreBoost.image1" :alt="chambreBoost.imageAlt"
                            class="h-full w-full object-cover transition-all duration-300 group-hover:scale-125">
                    </div>
                    <div class="absolute top-0 m-2 rounded-full ">
                        <p
                            class="rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3">
                            {{ chambreBoost.affaire }}</p>
                    </div>

                    <div class="my-2 mx-auto flex w-10/12 flex-col items-start justify-between">
                        <p class="mr-3 text-sm font-semibold text-principal align-center">{{
                            chambreBoost.prix }} <span class="text-secondaire mr-3">Fcfa</span>
                        </p>

                        <div class="mb-2 flex">

                            <p class="mr-3 text-secondaire  text-sm font-semibold truncate">{{
                                chambreBoost.nom.substring(0, 20) }}</p>
                        </div>
                        <h3 class="text-sm text-principal pt-[-8%] w-full border-b-[1px] border-gray-200 ">
                            {{
                                chambreBoost.region }} ,Senegal</h3>

                        .

                    </div>
                    <button
                        class="  bg-principal group mx-auto mt-[-10%] flex h-8 w-full items-stretch overflow-hidden hover:text-secondaire rounded-md text-white">
                        <div
                            class="flex w-full items-center justify-center bg-principal text-xs uppercase transition  group-hover:text-secondaire">
                            contacter</div>

                    </button>


                </div>
            </div>
        </div>
        <!-- Bouton add -->






        <section class=" py-1 text-secondaire sm:py-16 lg:py-1" id="transparent">
            <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-md text-center">
                    <h2 class="font-serif text-2xl font-bold sm:text-2xl">Dernières Annonces au
                        Sénégal
                    </h2>
                </div>
                <!-- <div class="region-filter flex flex-col">
                    <label for="region">Trie</label>
                    <select v-model="selectedRegion" id="region">
                        <option v-for="region in regions" :key="region" :value="region">
                            {{ region }}
                        </option>
                    </select>
                </div> -->
                <!-- Grid For Vehicules -->
                <div class="mt-10 grid grid-cols-2 gap-6 sm:grid-cols-4 sm:gap-4 lg:mt-16">

                    <article v-for="chambre in chambres " :key="chambre.id" @click="navigateToDetail(chambre.id)"
                        class="relative flex flex-col overflow-hidden rounded-lg border">
                        <div class="card">
                            <div class="aspect-square overflow-hidden">
                                <img :src="'/storage/' + chambre.image1" :alt="chambre.imageAlt"
                                    class="h-full w-full object-cover transition-all duration-300 group-hover:scale-125">
                            </div>
                            <div class="absolute top-0 m-2 rounded-full ">
                                <!-- <p
                                    class="rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3">
                                    {{ chambre.affaire }} </p> -->
                            </div>

                            <div class="my-2 mx-auto flex w-10/12 flex-col items-start justify-between">
                                <p class="mr-3 text-sm font-semibold text-principal align-center">{{
                                    chambre.prix }} <span class="text-secondaire mr-3">Fcfa</span>
                                </p>

                                <div class="mb-2 flex">

                                    <p class="mr-3 text-secondaire  text-sm font-semibold truncate">
                                        {{
                                            chambre.nom.substring(0, 20) }}</p>
                                </div>
                                <h3 class="text-sm text-principal pt-[-8%] w-full border-b-[1px] border-gray-200 ">
                                    {{ chambre.region }} ,Senegal</h3>

                                .

                            </div>
                            <div v-if="chambre.booster == 1"
                                class="bg-principal group mx-auto mt-[-5%] flex h-8 w-full items-stretch overflow-hidden hover:text-secondaire rounded-md text-white">
                                <!-- Contenu lorsque chambre.booster == 1 -->
                                <div class="imgPro w-full flex  mx-2">


                                    <div
                                        class="flex w-full items-center justify-center bg-principal text-xs uppercase transition  group-hover:text-secondaire">
                                        contacter </div>




                                </div>
                            </div>



                            <div v-else
                                class=" group mx-auto mt-[-10%] flex h-8 w-full items-stretch overflow-hidden hover:text-secondaire rounded-md text-white">



                            </div>


                        </div>
                        <!--  -->
                    </article>












                </div>
            </div>
        </section>
    </div>


</template>






<script>
export default {
    props: {
        chambresBoost: {
            type: Object,
            required: true,
        },
        chambres: {
            type: Object,
            required: true,
        },
    },
    methods: {
        navigateToDetail(id) {
            this.$inertia.visit(`/detail/${id}`);
        },
    },
}
</script>
