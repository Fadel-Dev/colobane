<template>
    <!-- <AppLayout title="Acceuil"> -->

    <Head title="Accueil" />

    <Navbar class="relative" />
    <div id="principal">



        <div class=" lg:w-8/12 mx-auto mx-0 px-0 ">
            <!-- Navigation -->


            <!-- Banner -->






            <!-- Slide -->

            <SlidePub />


            <!-- slide nav -->

            <div class="mt-0">

                <div class="swiper  w-full lg:w-4/4  lg:mt-[10px] " id="cat">
                    <div class="swiper-wrapper pt-10 ">
                        <div v-for="item in items" :key="item.id"
                            class="swiper-slide w-1/4 sm:w-1/4 md:w-1/6 lg:w-6/6 xl:w-1/6  flex  flex-col ">

                            <div id="{{ item.id }}" class="text-center" @click="activeTab = item.name">
                                <i :class="`fas fa-${item.icon} text-3xl text-principal`"></i>
                            </div>

                            <div class="text-center">
                                <span class="  font-semibold text-secondaire">{{ item.name }}</span>

                            </div>

                        </div>
                    </div>
                </div>



                <!-- bouton vendre -->


                <div class="lg:max-w-[80vw] max-w-[970vw] mx-auto mt-8">
                    <!-- Immobilier Tab -->
                    <div v-if="activeTab === 'immobilier'" class="">
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
                                        <div class="absolute top-0 m-2 rounded-full ">
                                            <p
                                                class="rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3">
                                                {{ immobillierBoost.affaire }}</p>
                                        </div>

                                        <div class="my-2 mx-auto flex w-10/12 flex-col items-start justify-between">
                                            <p class="mr-3 text-sm font-semibold text-principal align-center">{{
                                                immobillierBoost.prix }} <span class="text-secondaire mr-3">Fcfa</span>
                                            </p>

                                            <div class="mb-2 flex">

                                                <p class="mr-3 text-secondaire  text-sm font-semibold truncate">{{
                                                    immobillierBoost.nom.substring(0, 20) }}</p>
                                            </div>
                                            <h3
                                                class="text-sm text-principal pt-[-8%] w-full border-b-[1px] border-gray-200 ">
                                                {{
                                                    immobillierBoost.region }} ,Senegal </h3>

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

                            <div
                                class="bg-transparent border border-principal my-5 rounded-[20px] w-[90%] mx-[5%] h-[10vh] flex items-center justify-center">
                                <div class="text-center">
                                    <div class="txt flex items-center mx-auto">
                                        <span class="text-secondaire text-lg md:text-3xl">C'est le moment de
                                            vendre</span>

                                        <div
                                            class="flex items-center border-2 border-principal rounded-[10px] p-1 mx-2">
                                            <i class="fas fa-plus text-principal px-1"></i>
                                            <a :href="route('publier')"
                                                class="text-secondaire text-sm md:text-lg ml-1 md:ml-2">
                                                Déposer une annonce
                                            </a>
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
                                    <!-- <div class="region-filter flex flex-col">
                                        <label for="marque">Trieeee</label>
                                        <select v-model="selectedRegion" id="region">
                                            <option v-for="region in regions" :key="region" :value="region">
                                                {{ region }}
                                            </option>
                                        </select>
                                    </div> -->
                                    <!-- Grid For Vehicules -->

                                    <div class="mt-10 grid grid-cols-2 gap-6 sm:grid-cols-4 sm:gap-4 lg:mt-16">
                                        <article v-for="maison in maisons.data" :key="maison.id"
                                            @click="navigateToDetail(maison.id)"
                                            class="relative flex flex-col overflow-hidden rounded-lg border justify-center items-center">
                                            <!-- Centering Flex -->
                                            <div class="card w-full"> <!-- Ensure full width -->
                                                <div
                                                    class="aspect-square overflow-hidden flex justify-center items-center">
                                                    <!-- Center the image -->
                                                    <img :src="'/storage/' + maison.image1" :alt="maison.imageAlt"
                                                        class="h-full w-full object-cover transition-all duration-300 group-hover:scale-125">
                                                </div>
                                                <div class="absolute top-0 m-2 rounded-full">
                                                    <p
                                                        class="rounded-full bg-principal p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3">
                                                        {{ maison.affaire }}
                                                    </p>
                                                </div>

                                                <div
                                                    class="my-2 mx-auto flex w-10/12 flex-col items-center justify-between">
                                                    <!-- Centered flex -->
                                                    <p class="text-center text-sm font-semibold text-principal">{{
                                                        maison.prix }}{{
                                                            maison.type }} <span class="text-secondaire mr-3">Fcfa</span>
                                                    </p>

                                                    <div class="mb-2 flex justify-center"> <!-- Center the name -->
                                                        <p class="text-secondaire text-sm font-semibold truncate">{{
                                                            maison.nom.substring(0, 20) }}</p>
                                                    </div>

                                                    <h3
                                                        class="text-sm text-principal w-full border-b-[1px] border-gray-200 text-center">
                                                        <!-- Centered text -->
                                                        {{ maison.region }}, Senegal
                                                    </h3>
                                                </div>

                                                <div v-if="maison.status == 'accepter'"
                                                    class="bg-principal group mx-auto mt-[-5%] flex h-8 w-full items-center justify-center rounded-md text-white">
                                                    <div class="w-full flex justify-center">
                                                        <!-- Center the button -->
                                                        <div
                                                            class="bg-principal text-xs uppercase transition group-hover:text-secondaire">
                                                            Contacter
                                                        </div>
                                                    </div>
                                                </div>

                                                <div v-else
                                                    class="group mx-auto mt-[-10%] flex h-8 w-full items-center justify-center overflow-hidden rounded-md text-white">
                                                </div>
                                            </div>
                                        </article>
                                    </div>

                                </div>
                            </section>
                        </div>

                    </div>


                    <!-- Vehicule Tab -->
                    <div id="VoitureSection" v-else-if="activeTab == 'Vehicule'" class="bg-transparent">

                        <Voiture :voitures="voitures" :voituresBoost="voituresBoost" :marques="marques" />

                    </div>
                    <!-- Chambre -->
                    <div id="maisons" v-else-if="activeTab == 'Chambre'" class="bg-transparent">
                        <Chambre :chambres="chambres" :chambresBoost="chambresBoost" />
                    </div>


                    <!-- Villa -->
                    <div v-else-if="activeTab == 'Villa'" class="bg-transparent">
                        <Villa :villas="villas" :villasBoost="villasBoost" />

                    </div>

                    <!-- Immeubles -->
                    <div v-else-if="activeTab == 'Immeuble'" class="bg-transparent">
                        <!-- <h1>mes Immeubless</h1> -->
                        <Immeuble :immeubles="immeubles" :immeublesBoost="immeublesBoost" />
                    </div>

                    <!-- Terrain -->
                    <div v-else-if="activeTab == 'Terrain'" class="bg-transparent">
                        <!-- <h1>mes Terrain</h1> -->
                        <Terrain :terrains="terrains" :terrainsBoost="terrainsBoost" />
                    </div>

                    <!-- Verger -->
                    <div v-else-if="activeTab == 'Verger'" class="bg-transparent">
                        <!-- <h1>mes Vergers</h1> -->
                        <Verger :vergers="vergers" :vergersBoost="vergersBoost" />
                    </div>
                </div>
            </div>
            <div>
            </div>


            <!-- <footer /> -->

            <!-- Footer -->

        </div>
        <div class="mt-20">
            <Footer />
        </div>
    </div>



    <!-- </AppLayout> -->

</template>

<style scoped>
#principal {
    margin: 0;
    padding: 0;
    min-height: 105vh;
    /* background: url('https://cdn.pixabay.com/photo/2023/06/11/01/24/flowers-8055013_1280.jpg'); */
    background-size: cover;
}

#card,
#cat,
#transparent {
    background-color: #ffffff30;
    backdrop-filter: blur(16px) saturate(180%);
}


.pub {
    /*  background: url('https://images.unsplash.com/photo-1496181133206-80ce9b88a853?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80'); */
}


.nav {
    z-index: 50;
}

/* === removing default button style ===*/
.button {
    margin: 0;
    height: auto;
    background: transparent;
    padding: 0;
    border: none;
    cursor: pointer;
}

/* button styling */
.button {
    --border-right: 6px;
    --text-stroke-color: rgba(255, 255, 255, 0.6);
    --animation-color:
        rgb(235 45 83 / var(--tw-text-opacity));

    --fs-size: 1.5em;
    /* letter-spacing: 3px; */
    text-decoration: none;
    font-size: var(--fs-size);
    font-family: "Arial";
    position: relative;
    /* text-transform: uppercase; */
    color: transparent;
    -webkit-text-stroke: 1px var(--text-stroke-color);
}

/* this is the text, when you hover on button */
.hover-text {
    position: absolute;
    box-sizing: border-box;
    content: attr(data-text);
    color: var(--animation-color);
    width: 0%;
    inset: 0;
    border-right: var(--border-right) solid var(--animation-color);
    overflow: hidden;
    transition: 0.5s;
    -webkit-text-stroke: 1px var(--animation-color);
}

/* hover */
.button:hover .hover-text {
    width: 100%;
    filter: drop-shadow(0 0 23px var(--animation-color))
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

#swiper {
    margin-top: 10%;
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

import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue';

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
    villas: Object,
    villasBoost: Object,
    immeubles: Object,
    immeublesBoost: Object,
    terrains: Object,
    terrainsBoost: Object,
    vergers: Object,
    vergersBoost: Object,
});

let items = [
    {
        "id": 1,
        "icon": "home", // FontAwesome icon name
        "name": "Villa"
    },
    {
        "id": 2,
        "icon": "car", // FontAwesome icon name for Vehicule
        "name": "Vehicule"
    },
    {
        "id": 3,
        "icon": "building", // FontAwesome icon name
        "name": "Terrain"
    },
    {
        "id": 4,
        "icon": "bed", // FontAwesome icon name for Chambre
        "name": "Chambre"
    },
    {
        "id": 5,
        "icon": "building", // FontAwesome icon name for Immeuble
        "name": "Immeuble"
    },
    {
        "id": 6,
        "icon": "apple-alt", // FontAwesome icon name for Verger
        "name": "Verger"
    },
    {
        "id": 7,
        "icon": "city", // FontAwesome icon name
        "name": "Appartement"

    },
    {
        "id": 8,
        "icon": "home", // FontAwesome icon name for Immobilier
        "name": "Immobilier"
    },


];


</script>

<script>
import { InertiaProgress } from '@inertiajs/progress';
import SwitchBtn from './BoutCode/SwitchBtn.vue';
import SlidePub from './BoutCode/SlidePub.vue';
import Voiture from './ForWelcome/Voiture.vue';
import Chambre from './ForWelcome/Chambre.vue';
import Immobilier from './Categories/immobilier.vue';
import Villa from './ForWelcome/Villa.vue';
import Immeuble from './ForWelcome/Immeuble.vue';
import Terrain from './ForWelcome/Terrain.vue';
import Verger from './ForWelcome/Verger.vue';
import Footer from '../Components/Footer.vue';
import Navbar from '../Components/Navbar.vue';


export default {
    data() {
        return {
            activeTab: 'Vehicule',
            showMenu: false,
            marques: [
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
                "Toyota",
                "ford",
                "Jeep",
                "autres"
            ],
            selectedMarque: 'dakar'


        };
    },
    methods: {
        navigateToDetail(id) {
            this.$inertia.visit(`/detail/${id}`);
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
