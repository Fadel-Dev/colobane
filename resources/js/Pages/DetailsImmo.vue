<script setup>

import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Footer from '../Components/Footer.vue';
import { Inertia } from '@inertiajs/inertia';

import Navbar from '../Components/Navbar.vue'

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
});
</script>

<template>
    <!-- <AppLayout title="{{ maison.nom }}"> -->

    <Head>
        <title>Detail {{ maison.nom }} </title>
    </Head>


    <div>



        <header>
            <Navbar />
        </header>


        <!-- Home -->


        <main class="my-6 lg:pl-[10%] flex justify-center">
            <div class="container mx-auto">
                <div class="md:flex md:items-center">
                    <!-- Image Container -->
                    <div
                        class="rounded-sm sm:w-[40rem] sm:h-[22rem] sm:flex items-center sm:justify-center sm:bg-gray-200 relative my-0 sm:mx-0 bg-gray-300 overflow-hidden">
                        <!-- Left Arrow -->
                        <i class="p-2 bg-transparent text-3xl rounded text-white bi bi-chevron-left absolute top-1/2 left-11 cursor-pointer"
                            @click="previousImage"></i>

                        <!-- Main Image -->
                        <img :src="'/storage/' + currentImage"
                            class="w-auto h-full object-cover transition-all duration-300 ease-in-out"
                            alt="Carrousel image">

                        <!-- Right Arrow -->
                        <i class="p-2 text-4xl text-white rounded bi bi-chevron-right absolute top-1/2 right-11 cursor-pointer"
                            @click="nextImage"></i>
                    </div>


                    <!-- Details Container -->
                    <div
                        class="hidden md:block max-w-lg sm:mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2 mx-auto w-11/12 rounded-2xl md:bg-secondaire p-8 mx-0">

                        <!-- Header Section -->
                        <div class="head flex">
                            <img class="mb-3 w-[4rem] h-[4rem] rounded-full shadow-2xl  bottom-1/3 right-0"
                                src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">
                            <span class="text-gray-400 mt-3 px-3">Proposé par <span class="text-gray-300 uppercase">{{
                                nameSeler
                                    }}</span></span>
                        </div>
                        <hr class="my-3">

                        <!-- Property Details Based on Type -->
                        <div v-if="maison.type == 'villa' || maison.type == 'appartement' || maison.type == 'chambre'">
                            <span class="text-gray-500 mt-3">Lieu : <span class="text-gray-700 uppercase">{{
                                maison.region
                                    }}</span></span><br>
                            <span class="text-gray-500 mt-3">Piece : <span class="text-gray-700 uppercase">{{
                                maison.npiece
                                    }}</span></span><br>
                            <span class="text-gray-500 mt-3">Type : <span class="text-gray-700 uppercase">{{ maison.type
                                    }}</span></span><br>
                        </div>
                        <div v-else-if="maison.type == 'verger' || maison.type == 'ferme' || maison.type == 'terrain'">
                            <span class="text-gray-500 mt-3">Lieu : <span class="text-gray-700">{{ maison.region
                                    }}</span></span><br>
                            <span class="text-gray-500 mt-3">Surface : <span class="text-gray-700">{{ maison.surface
                                    }}</span></span><br>
                            <span class="text-gray-500 mt-3">Type : <span class="text-gray-700">{{ maison.type
                                    }}</span></span><br>
                        </div>

                        <!-- Contact Buttons -->
                        <div class="flex flex-col hidden md:flex">
                            <button class="w-full h-12 bg-principal text-white font-medium rounded-md mb-2"
                                @click="ouvrirWhatsApp">
                                Contacter
                            </button>
                            <div>
                                <button
                                    class="w-full h-12 border-2 border-principal hover:bg-principal hover:border-1 hover:border-white text-white font-medium rounded-md"
                                    @click="afficherNumero">
                                    Voir le numéro
                                </button>
                                <div v-if="afficherPopup"
                                    class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-75 z-50">
                                    <div class="bg-white rounded-lg p-8 w-2/4 relative">
                                        <!-- Titre -->
                                        <span class="text-3xl text-principal">NB</span><br>

                                        <!-- Contenu -->
                                        <span class="text-3xl">Évitez les demandes de paiement anticipé : Soyez prudents
                                            face aux demandes
                                            de paiement anticipé avant d'avoir reçu le produit ou visité la propriété.
                                            Les vendeurs
                                            légitimes seront compréhensifs envers vos préoccupations.</span><br>

                                        <!-- Numéro du vendeur -->
                                        <span class="text-3xl"><span class="text-principal">Numéro du Vendeur</span>: {{
                                            phoneSeler }}</span>

                                        <!-- Bouton de fermeture -->
                                        <button @click="fermerPopup"
                                            class="absolute top-0 right-0 mt-2 mr-2 text-3xl text-principal hover:text-gray-800 focus:outline-none">X</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>





































































                <!-- Additional Information Below Image -->
                <div
                    class="px-4 mt-4 rounded-sm sm:w-[40rem] sm:h-[22rem] items-center sm:justify-center relative my-0 sm:mx-0">
                    <span class="text-secondaire uppercase text-2xl">{{ maison.nom }}</span><br>
                    <span class="text-gray-500 mt-3">Prix : <span class="text-principal uppercase">{{ maison.prix
                            }}</span>
                        Fcfa</span><br>
                    <hr>
                    <div class="flex items-center mt-4">
                        <div class="w-full grid grid-cols-2">
                            <!-- Property Details Icons -->
                            <div class="flex items-center mr-4">
                                <i class="bi bi-bag-fill text-3xl text-gray-800 mr-2"></i>
                                <span class="text-1xl text-gray-600">{{ maison.affaire }}</span>
                            </div>
                            <div class="flex items-center mr-4">
                                <i class="bi bi-border-width text-3xl text-gray-800 mr-2"></i>
                                <span class="text-1xl text-gray-600">{{ maison.type }}</span>
                            </div>
                            <div class="flex items-center mr-4">
                                <i class="bi bi-geo-alt-fill text-3xl text-gray-800 mr-2"></i>
                                <span class="text-1xl text-gray-600">{{ maison.region }}</span>
                            </div>
                            <div class="flex items-center mr-4">
                                <i class="bi bi-grid-3x3-gap-fill text-3xl text-gray-800 mr-2"></i>
                                <span class="text-1xl text-gray-600">{{ maison.npiece }} pieces</span>
                            </div>
                            <div class="flex items-center mr-4">
                                <i class="bi bi-card-text text-3xl text-gray-800 mr-2"></i>
                                <span class="text-1xl text-gray-600">{{ maison.surface }} M2</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="text-gray-600 mt-3">{{ maison.description }}</p><br>

                    <!-- Other Products from the Same Brand -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-4 text-secondaire">Articles immobiliers similaires</h2><br>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <!-- Display Suggestions -->
                            <div v-for="suggestion in suggestions" :key="suggestion.id"
                                class="w-full h-full object-cover border rounded-lg p-1">
                                <img :src="'/storage/' + suggestion.image1" alt="Produit"
                                    class="w-full h-auto mb-2 rounded-lg">
                                <span class="text-md font-semibold text-principal text-center">{{ suggestion.nom
                                    }}</span>
                                <!-- <p class="text-gray-700">{{ suggestion.description }}</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>

    <div class="fixed bottom-0 w-full bg-transparent text-white p-4 flex mx-auto justify-around md:hidden">
        <div class="first">
            <button
                class="flex items-center bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-black px-4 py-2"
                @click="afficherNumero">
                <i class="bi bi-telephone text-2xl mr-2"></i>Telephone
            </button>

            <!-- Nb -->

            <div v-if="afficherPopup"
                class="fixed inset-0 flex justify-center mt-[30%] items-center bg-gray-800 bg-opacity-75 z-50">
                <div class="bg-white rounded-lg p-8 w-5/6 max-w-lg relative">
                    <!-- Bouton de fermeture -->
                    <button @click="fermerPopup"
                        class="absolute top-2 right-2 text-3xl text-principal hover:text-gray-800 focus:outline-none">
                        &times;
                    </button>

                    <!-- Titre du popup -->
                    <span class="text-3xl text-principal font-semibold">
                        NB
                    </span>
                    <br>

                    <!-- Contenu du popup -->
                    <span class="w-full text-secondaire">
                        Évitez les demandes de paiement anticipé : Soyez prudents face aux demandes
                        de paiement anticipé avant d'avoir reçu le produit ou visité la propriété.
                        Les vendeurs légitimes seront compréhensifs envers vos préoccupations.
                    </span>
                    <br>

                    <!-- Numéro du vendeur -->
                    <span class="text-1xl">
                        <span class="text-principal">Numéro du Vendeur</span>: {{ phoneSeler }}
                    </span>
                </div>
            </div>



        </div>

        <div class="second">
            <button @click="ouvrirWhatsApp" class="flex items-center bg-principal text-white text-sm font-medium rounded hover:bg-gray-900
                focus:outline-none focus:bg-black px-4 py-2">
                <i class="bi bi-whatsapp text-2xl text-green-100  mr-2"></i> WhatsApp
            </button>
        </div>
    </div>


    <!-- FOOTER -->

    <div class="footer relative top-12 mt-40 ">
        <Footer />
    </div>


    <!-- </AppLayout> -->




</template>

<style lang="css">
#photoContact {
    display: grid;
    grid-auto-columns: 55% 26%;
    /* height: 75vh; */
}


#home {
    height: 100vh;
}
</style>


<script>


export default {
    components: { Footer },

    components: {
        Head
    },
    data() {
        return {
            images: [

                this.maison.image1,
                this.maison.image2,
                this.maison.image3,




            ],
            currentIndex: 0,
            showUserNumber: false,
            //   nnnum
            afficherPopup: false,
        };
    },
    computed: {
        currentImage() {
            return this.images[this.currentIndex];

        }
    },
    methods: {
        previousImage() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
            }
        },
        nextImage() {
            if (this.currentIndex < this.images.length - 1) {
                this.currentIndex++;
            }
        },
        afficherNumero() {
            this.afficherPopup = true;
        },
        fermerPopup() {
            this.afficherPopup = false;
        }, ouvrirWhatsApp() {
            const numeroContact = `${this.phoneSeler}`; // Remplacez par le numéro de téléphone que vous souhaitez utiliser
            const messageText = `Bonjour, je suis intéressé par vos produits.${this.urlActuelle}`; // Message texte par défaut

            const lienWhatsApp = `https://wa.me/${numeroContact}?text=${encodeURIComponent(messageText)}`;






            // Ouvrir le lien dans une nouvelle fenêtre/onglet
            window.open(lienWhatsApp, "_blank");
        },
        // envoie

    }
};

</script>
