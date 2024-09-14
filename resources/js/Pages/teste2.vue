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
        <div class="swiper-wrapper">
            <div v-for="voitureBoost in voituresBoost.data" :key="voitureBoost.id"
                @click="navigateToDetailVehi(voitureBoost.id)"
                class="swiper-slide w-full sm:w-2/4 md:w-1/4 lg:w-1/6 xl:w-1/6 p-1  ">
                <!-- Immobilier Card -->
                <div class="card" id="card">
                    <div class="aspect-square overflow-hidden">
                        <img :src="'/storage/' + voitureBoost.image1" :alt="voitureBoost.imageAlt"
                            class="h-full w-full object-cover transition-all duration-300 group-hover:scale-125">
                    </div>
                    <div class="absolute top-0 m-2 rounded-full ">
                        <p
                            class="rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3">
                            {{ voitureBoost.affaire }}</p>
                    </div>

                    <div class="my-2 mx- text-center flex-col items-start justify-between">
                        <span class="mr-3 text-xl font-semibold text-secondaire align-center">{{
                            voitureBoost.nom.substring(0, 20) }}</span>

                        <div>

                            <span class=" text-troisieme  text-sm font-semibold truncate">
                                {{
                                    voitureBoost.prix
                                }} Xof


                            </span>
                        </div>
                        <h3 class="text-sm text-secondaire  w-full border-b-[1px] border-gray-200 ">
                            {{
                                voitureBoost.region }} ,Senegal</h3>

                        .

                    </div>
                    <div class="pb-3">
                        <button
                            class="  bg-principal w-[80%]  group mx-auto mt-[-15%] flex h-8  items-stretch overflow-hidden hover:text-secondaire rounded-md text-white">
                            <div
                                class="flex w-full items-center justify-center bg-principal text-xs uppercase transition  group-hover:text-secondaire">
                                contacter</div>

                        </button>

                    </div>


                </div>
            </div>
        </div>

        <div
            class=" bg-transparent border border-principal  my-5 rounded-[20px] w-full h-[10vh] flex items-center justify-center">
            <div class="text-center">
                <div class="txt flex items-center">
                    <span class="text-secondaire text-3xl">C'est le moment de vendre</span>
                    <div class="flex   items-center border-2 border-principal rounded-[10px] p-1 mx-2">
                        <i class="fas fa-plus text-principal px-1  "></i>
                        <span class="text-secondaire text-lg ml-2">Déposer une annonce</span>
                    </div>
                </div>
            </div>
        </div>


        <section class=" py-1 text-secondaire sm:py-16 lg:py-1" id="transparent">
            <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-md text-center">
                    <h2 class="font-serif text-2xl font-bold sm:text-2xl">Dernières Annonces au
                        Sénégal
                    </h2>
                </div>
                <div class="region-filter ">
                    <label for="region">Trie</label>
                    <select v-model="selectedRegion" id="region">
                        <option v-for="region in regions" :key="region" :value="region">
                            {{ region }}
                        </option>
                    </select>
                </div>

                <!-- Grid For Vehicules -->
                <div class="mt-10 lg:mt-16  rounded-lg">
                    <article v-for="voiture in voitures.data" :key="voiture.id"
                        @click="navigateToDetailVehi(voiture.id)"
                        class="relative flex flex-col overflow-hidden rounded-lg border">
                        <div class="card flex items-start space-x-4 mb-4" v-if="voiture.region == selectedRegion">
                            <!-- Image -->
                            <div class="w-1/6 aspect-square overflow-hidden">
                                <img :src="'/storage/' + voiture.image1" :alt="voiture.imageAlt"
                                    class="h-full w-full object-cover transition-all duration-300 group-hover:scale-125">
                            </div>

                            <!-- Content -->
                            <div class="flex flex-col justify-between w-3/4  ">

                                <div class="my-2">
                                    <p class="text-lg font-semibold text-principal">{{
                                        voiture.nom.substring(0,
                                            20)
                                    }} </p>



                                    <div class="relative">
                                        <div class=" rounded-full  ">
                                            <span class=" mr-2 rounded-md  bg-principal px-1 ">
                                                {{ voiture.affaire }}
                                            </span>
                                            <span> {{ voiture.marque }} {{ voiture.model }} {{
                                                voiture.boiteVitesse }} </span>
                                        </div>
                                    </div>

                                    <h3 class="text-sm text-principal border-b-[1px] border-gray-400 ">
                                        {{
                                            voiture.region }} ,Senegal</h3>

                                    <div class="flex justify-between mt-2">
                                        <div>
                                            <span class="text-secondaire text-lg my-3 font-semibold truncate">
                                                {{
                                                    voiture.prix }} F<span class="text-principal ">
                                                    cfa</span>
                                            </span>
                                        </div>

                                        <div>
                                            <span class="mx-3 mt-5 bg-black px-1 w-full rounded-full ">
                                                <i class="text-white bi bi-telephone"></i></span>
                                            <span class="bg-green-300  px-1 w-full rounded-lg ">
                                                <i class="bi bi-whatsapp"></i></span>
                                        </div>






                                    </div>

                                </div>

                                <!-- Contact Button -->
                                <!-- <div :class="{ 'bg-principal text-white hover:text-secondaire': voiture.booster == 2, 'border-t-[2px] border-secondaire text-secondaire text-xs uppercase hover:text-secondaire': voiture.booster != 1 }"
                                                        class="bg-principal  flex h-8  items-center justify-center rounded-md">
                                                        contactersssssssssssssssssss
                                                    </div> -->

                                <div class="details">

                                </div>

                                <div v-if="voiture.status == 'accepter'"
                                    class="bg-principal  flex h-8  items-center justify-center rounded-md">
                                    <span>connecter</span>
                                </div>



                            </div>

                        </div>
                    </article>
                </div>



            </div>
        </section>
    </div>

</template>

<script>
export default {
    data() {
        return {
            activeTab: 'immobilier',
            showMenu: false,
            regions: [
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
                "autres"
            ],
            selectedRegion: 'tous' // Par défaut, "tous"
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
    methods: {
        navigateToDetailVehi(id) {
            this.$inertia.visit(`/detailVehi/${id}`);
        },
    },
}
</script>
