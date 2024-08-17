<template>

    <Head title="Accueil" />
    <div>
        <!-- Navigation -->


        <!-- Banner -->
        <nav class="nav bg-gray-800 w-full fixed top-0 left-0 z-10">
            <div class="px-4 py-2 mx-auto md:flex md:justify-between md:items-center shadow-xl bg-gray-900 text-white">
                <a href="/" class="text-xl font-bold md:text-2xl text-principal">Noflay</a>

                <!-- Mobile menu button -->
                <div @click="showMenu = !showMenu" class="flex md:hidden">
                    <button type="button"
                        class="text-gray-400 hover:text-gray-200 focus:outline-none absolute right-2 top-5">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Search bar -->
                <div class="mx-auto mt-2 w-full max-w-screen-md  leading-6">
                    <form
                        class="relative flex w-full max-w-2xl items-center justify-between rounded-md border shadow-lg">
                        <svg class="absolute left-2 block h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="search" name="search"
                            class="h-8 sm:h-10 w-full rounded-md py-2 px-4 sm:px-6 outline-none focus:ring-2"
                            placeholder="Rechercher..." />
                        <button type="submit"
                            class="absolute right-0 mr-1 inline-flex h-8 sm:h-10 items-center justify-center rounded-lg bg-gray-900 px-4 sm:px-6 font-medium text-white focus:ring-4 hover:bg-gray-700">Search</button>
                    </form>
                </div>

                <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
                <div :class="showMenu ? 'block' : 'hidden'"
                    class="md:flex md:space-x-10 md:items-center md:space-y-0 mt-4">
                    <nav aria-labelledby="header-navigation"
                        class="flex flex-col items-center justify-between w-full sm:flex-row sm:items-start">
                        <ul class="mt-4 flex flex-col sm:flex-row">
                            <template v-if="$page.props.auth.user">
                                <li><a :href="route('publier')" class="btn-primary">Publier une annonce</a></li>
                                <li><a :href="route('dashboard')"
                                        class="btn-secondary md:ml-4 mt-2 md:mt-0">Dashboard</a></li>
                            </template>
                            <template v-else>
                                <li><a :href="route('publier')" class="btn-primary mb-2 sm:mb-0 sm:mr-4">Publier une
                                        annonce</a></li>
                                <li><a :href="route('login')" class="btn-secondary"> <button class="sign">
                                            se connecter
                                            <div class="arrow-wrapper">
                                                <div class="arrow"></div>

                                            </div>
                                        </button></a></li>


                                <!-- <li>
                                    <button class="sign">
                                        Sign up
                                        <div class="arrow-wrapper">
                                            <div class="arrow"></div>

                                        </div>
                                    </button>


                                </li> -->



                            </template>
                        </ul>
                    </nav>
                </div>
            </div>
        </nav>



        <!-- Tabs and Content -->
        <div class="mt-20">
            <div class="flex w-full border-b border-t-[1px] border-gray-200">
                <button @click="activeTab = 'immobilier'"
                    :class="{ 'border-b-2 border-principal': activeTab === 'immobilier' }"
                    class="w-1/2 py-2 bg-white text-gray-800 font-semibold">Annonces immobilières</button>
                <button @click="activeTab = 'vehicule'"
                    :class="{ 'border-b-2 border-principal': activeTab === 'vehicule' }"
                    class="w-1/2 py-2 bg-white text-gray-800 font-semibold">Annonces de véhicules</button>
            </div>


            <div class="lg:max-w-[80vw] max-w-[970vw] mx-auto mt-8">
                <!-- Immobilier Tab -->
                <div v-if="activeTab === 'immobilier'" class="bg-gray-100">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div v-for="immobillierBoost in immobilliersBoost.data" :key="immobillierBoost.id"
                                @click="navigateToDetail(immobillierBoost.id)"
                                class="swiper-slide w-full sm:w-1/4 md:w-1/4 lg:w-1/6 xl:w-1/6 p-1">
                                <!-- Immobilier Card -->
                                <div class="card">
                                    <div class="aspect-square overflow-hidden">
                                        <img :src="'/storage/' + immobillierBoost.image1"
                                            :alt="immobillierBoost.imageAlt"
                                            class="h-full w-full object-cover transition-all duration-300 group-hover:scale-125">
                                    </div>
                                    <div class="absolute top-0 m-2 rounded-full bg-white">
                                        <p
                                            class="rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3">
                                            {{ immobillierBoost.affaire }}</p>
                                    </div>

                                    <div class="my-2 mx-auto flex w-10/12 flex-col items-start justify-between">
                                        <p class="mr-3 text-sm font-semibold text-principal align-center">{{
                                            immobillierBoost.prix }} <span class="text-secondaire mr-3">Fcfa</span></p>

                                        <div class="mb-2 flex">

                                            <p class="mr-3 text-secondaire  text-sm font-semibold truncate">{{
                                                immobillierBoost.nom.substring(0, 20) }}</p>
                                        </div>
                                        <h3
                                            class="text-sm text-principal pt-[-8%] w-full border-b-[1px] border-gray-300 ">
                                            {{
                                                immobillierBoost.region }} ,Senegal</h3>

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
                        <section class="bg-white py-1 text-gray-700 sm:py-16 lg:py-1">
                            <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
                                <div class="mx-auto max-w-md text-center">
                                    <h2 class="font-serif text-2xl font-bold sm:text-2xl">Dernières Annonces au Sénégal
                                    </h2>
                                </div>
                                <div class="region-filter flex flex-col">
                                    <label for="region">Trie</label>
                                    <select v-model="selectedRegion" id="region">
                                        <option v-for="region in regions" :key="region" :value="region">
                                            {{ region }}
                                        </option>
                                    </select>
                                </div>
                                <!-- Grid For Vehicules -->
                                <div class="mt-10 grid grid-cols-2 gap-6 sm:grid-cols-4 sm:gap-4 lg:mt-16">

                                    <article v-for="maison in maisons.data " :key="maison.id"
                                        @click="navigateToDetail(maison.id)"
                                        class="relative flex flex-col overflow-hidden rounded-lg border">
                                        <div class="card">
                                            <div class="aspect-square overflow-hidden">
                                                <img :src="'/storage/' + maison.image1" :alt="maison.imageAlt"
                                                    class="h-full w-full object-cover transition-all duration-300 group-hover:scale-125">
                                            </div>
                                            <div class="absolute top-0 m-2 rounded-full bg-white">
                                                <p
                                                    class="rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3">
                                                    {{ maison.affaire }} </p>
                                            </div>

                                            <div class="my-2 mx-auto flex w-10/12 flex-col items-start justify-between">
                                                <p class="mr-3 text-sm font-semibold text-principal align-center">{{
                                                    maison.prix }} <span class="text-secondaire mr-3">Fcfa</span></p>

                                                <div class="mb-2 flex">

                                                    <p class="mr-3 text-secondaire  text-sm font-semibold truncate">{{
                                                        maison.nom.substring(0, 20) }}</p>
                                                </div>
                                                <h3
                                                    class="text-sm text-principal pt-[-8%] w-full border-b-[1px] border-gray-300 ">
                                                    {{ maison.region }} ,Senegal</h3>

                                                .

                                            </div>
                                            <div v-if="maison.booster == 1"
                                                class="bg-principal group mx-auto mt-[-5%] flex h-8 w-full items-stretch overflow-hidden hover:text-secondaire rounded-md text-white">
                                                <!-- Contenu lorsque maison.booster == 1 -->
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

                </div>

                <!-- Vehicule Tab -->
                <div v-else-if="activeTab === 'vehicule'" class="bg-gray-100">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div v-for="voitureBoost in voituresBoost.data" :key="voitureBoost.id"
                                @click="navigateToDetailVehi(voitureBoost.id)"
                                class="swiper-slide w-full sm:w-1/4 md:w-1/4 lg:w-1/6 xl:w-1/6 p-1">
                                <!-- Immobilier Card -->
                                <div class="card">
                                    <div class="aspect-square overflow-hidden">
                                        <img :src="'/storage/' + voitureBoost.image1" :alt="voitureBoost.imageAlt"
                                            class="h-full w-full object-cover transition-all duration-300 group-hover:scale-125">
                                    </div>
                                    <div class="absolute top-0 m-2 rounded-full bg-white">
                                        <p
                                            class="rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3">
                                            {{ voitureBoost.affaire }}</p>
                                    </div>

                                    <div class="my-2 mx-auto flex w-10/12 flex-col items-start justify-between">
                                        <p class="mr-3 text-sm font-semibold text-principal align-center"><span
                                                class="text-secondaire mr-3">Fcfa</span>{{ voitureBoost.prix }}</p>

                                        <div class="mb-2 flex">

                                            <p class="mr-3 text-secondaire  text-sm font-semibold truncate">{{
                                                voitureBoost.nom.substring(0, 20) }}</p>
                                        </div>
                                        <h3
                                            class="text-sm text-principal pt-[-8%] w-full border-b-[1px] border-gray-300 ">
                                            {{
                                                voitureBoost.region }} ,Senegal</h3>

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
                        <section class="bg-white py-1 text-gray-700 sm:py-16 lg:py-1">
                            <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
                                <div class="mx-auto max-w-md text-center">
                                    <h2 class="font-serif text-2xl font-bold sm:text-2xl">Dernières Annonces au Sénégal
                                    </h2>
                                </div>
                                <div class="region-filter flex flex-col">
                                    <label for="region">Trie</label>
                                    <select v-model="selectedRegion" id="region">
                                        <option v-for="region in regions" :key="region" :value="region">
                                            {{ region }}
                                        </option>
                                    </select>
                                </div>z

                                <!-- Grid For Vehicules -->
                                <div class="mt-10 grid grid-cols-2 gap-6 sm:grid-cols-4 sm:gap-4 lg:mt-16">

                                    <article v-for="voiture in voitures.data " :key="voiture.id"
                                        @click="navigateToDetailVehi(voiture.id)"
                                        class="relative flex flex-col overflow-hidden rounded-lg border">
                                        <div class="card" v-if="voiture.region === selectedRegion">
                                            <div class="aspect-square overflow-hidden">
                                                <img :src="'/storage/' + voiture.image1" :alt="voiture.imageAlt"
                                                    class="h-full w-full object-cover transition-all duration-300 group-hover:scale-125">
                                            </div>
                                            <div class="absolute top-0 m-2 rounded-full bg-white">
                                                <p
                                                    class="rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3">
                                                    {{ voiture.affaire }} </p>
                                            </div>

                                            <div class="my-2 mx-auto flex w-10/12 flex-col items-start justify-between">
                                                <p class="mr-3 text-sm font-semibold text-principal align-center">{{
                                                    voiture.prix }}vvvvvvvvvvvvvvvv <span
                                                        class="text-secondaire mr-3">Fcfa</span></p>

                                                <div class="mb-2 flex">

                                                    <p class="mr-3 text-secondaire  text-sm font-semibold truncate">{{
                                                        voiture.nom.substring(0, 20) }}</p>
                                                </div>
                                                <h3
                                                    class="text-sm text-principal pt-[-8%] w-full border-b-[1px] border-gray-300 ">
                                                    {{ voiture.region }} ,Senegal</h3>

                                                .

                                            </div>
                                            <div v-if="voiture.booster == 1"
                                                class=" bg-principal group mx-auto mt-[-10%] flex h-8 w-full items-stretch overflow-hidden hover:text-secondaire rounded-md text-white">
                                                <!-- <div
                        class="flex w-full items-center justify-center bg-principal text-xs uppercase transition  group-hover:text-secondaire">
                        contacter</div> -->

                                                <div v-if="voiture.booster == 1" class="imgPro w-full flex space-x-40">
                                                    <div
                                                        class="flex w-full items-center justify-center bg-principal text-xs uppercase transition  group-hover:text-secondaire">
                                                        contacter </div>







                                                </div>


                                            </div>
                                            <div v-else
                                                class=" group mx-auto mt-[-10%] flex h-8 w-full items-stretch overflow-hidden hover:text-secondaire rounded-md text-white">
                                                <div
                                                    class=" border-t-[2px] border-gray-500 text-bolder flex w-full items-center justify-center text-secondaire text-xs uppercase transition  group-hover:text-secondaire">
                                                    contacter </div>

                                                <!-- <div v-if=" maison.booster ==1" class="imgPro ">
                          <span class="text-secondaire pr-5">Pro</span>
                        </div> -->


                                            </div>


                                        </div>
                                        <!--  -->
                                    </article>












                                </div>
                            </div>
                        </section>
                    </div>

                </div>
            </div>
        </div>


        <!-- Footer -->
        <div class="mt-20">
            <Footer />
        </div>
    </div>
</template>

<style scoped>
.nav {
    z-index: 50;
}


.card {
    background-color: #ffffff;
    border-radius: 1rem;
    box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
}

.fixed-size {
    width: 300px;
    /* Width of the images */
    height: 200px;
    /* Height of the images */
    object-fit: cover;
    /* Ensures the images cover the space without distorting */
}

.swiper {
    margin-top: 10%;
}

@media (max-width: 640px) {
    .swiper-slide {
        width: calc(100% / 3);
    }
}

@media (max-width: 768px) {
    .nav {
        padding: 0.5rem;
    }

    .card {
        margin-bottom: 1rem;
    }
}



/* button sign */

.sign {

    border: 0.3px dotted white;






    --primary-color: #625bff;
    --secondary-color: #fff;
    --hover-color: #eb2d53;
    --arrow-width: 10px;
    --arrow-stroke: 2px;
    box-sizing: border-box;
    /* border: 0; */
    border-radius: 20px;
    color: var(--secondary-color);
    padding: 2px 1.8em;
    /* background: var(--primary-color); */
    display: flex;
    transition: 0.2s background;
    align-items: center;
    gap: 0.6em;
    font-weight: bold;
}

.sign .arrow-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
}

.sign .arrow {
    margin-top: 1px;
    width: var(--arrow-width);
    background: var(--primary-color);
    height: var(--arrow-stroke);
    position: relative;
    transition: 0.2s;
}

.sign .arrow::before {
    content: "";
    box-sizing: border-box;
    position: absolute;
    border: solid var(--secondary-color);
    border-width: 0 var(--arrow-stroke) var(--arrow-stroke) 0;
    display: inline-block;
    top: -3px;
    right: 3px;
    transition: 0.2s;
    padding: 3px;
    transform: rotate(-45deg);
}

.sign:hover {
    background-color: var(--hover-color);
}

.sign:hover .arrow {
    background: var(--secondary-color);
}

.sign:hover .arrow:before {
    right: 0;
}
</style>

<script setup>
import { defineProps } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    voitures: Object,
    voituresBoost: Object,
    immobilliersBoost: Object,
    maisons: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<script>
import { InertiaProgress } from '@inertiajs/progress';

export default {
    data() {
        return {
            activeTab: 'immobilier',
            showMenu: false,
            regions: [
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
            selectedRegion: 'dakar'

        };
    },
    methods: {
        navigateToDetail(id) {
            this.$inertia.visit(`/detail/${id}`);
        },
        navigateToDetailVehi(id) {
            this.$inertia.visit(`/detailVehi/${id}`);
        },
    },
    mounted() {
        // Initialize Swiper
        new Swiper('.swiper', {
            slidesPerView: 'auto',
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });

        // Initialize progress bar
        InertiaProgress.init({
            delay: 200,
            color: '#eb2d53',
            includeCSS: true,
            showSpinner: true,
        });
    },
};
</script>
