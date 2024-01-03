<script setup>

import { Head, Link, router } from '@inertiajs/vue3';
import Footer from '../Components/Footer.vue';
import { Inertia } from '@inertiajs/inertia';



import Navbar from '../Components/Navbar.vue'

const props = defineProps({
    voiture: Object,
    user: Object,
    nameSeler: Object,
    mailSeler: Object,
    phoneSeler: Object,
    suggestions: Object,


    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head>
        <title>Detail {{ voiture.nom }} </title>
    </Head>
    <div>
        <div class="nav bg-white w-full m-0 p-0">
            <nav class="
          px-9
          py-2
          mx-auto
          md:flex md:justify-between md:items-center
          shadow-xl
          relative
          bg-gray-900
          text-white
        ">
                <div class="flex items-center justify-between ">
                    <Link :href="route('home')" class="
            w-full
              text-xl
              text-
              font-bold
              md:text-2xl
            text-principal

            ">Noflay
                    </Link>



                    <!-- Mobile menu button -->
                    <div @click="showMenu = !showMenu" class="flex md:hidden">
                        <button type="button" class="
                text-gray-800
                hover:text-gray-400
                focus:outline-none focus:text-gray-400
              ">
                            <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                                <path fill-rule="evenodd"
                                    d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
                <div :class="showMenu ? 'flex' : 'hidden'" class="
            flex-col
            mt-8
            space-y-4
            md:flex
            md:space-y-0
            md:flex-row
            md:items-center
            md:space-x-10
            md:mt-0
          ">
                    <div class="auth">
                        <div v-if="canLogin">
                            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            Dashboard</Link>

                            <div v-else>


                                <div class="auth flex">

                                    <div class="mx-2 bg-principal rounded-xl">
                                        <i class="bi bi-node-plus pl-1"></i>
                                        <Link :href="route('publier')"
                                            class=" px-2 py-0 text-white hover:text-gray-900  dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                        Publier une annonce</Link>


                                    </div> <i class="bi bi-person-circle mx-1"></i>
                                    <Link :href="route('login')"
                                        class="font-semibold  text-gray-300 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                    Log in</Link>

                                    <Link v-if="canRegister" :href="route('register')"
                                        class="ml-4 font-semibold  text-gray-300 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                    Register</Link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </nav>
            <hr>
        </div>
        <!-- Home -->

        <main class="my-8">
            <div class="container mx-auto ">
                <div class="md:flex md:items-center">
                    <div
                        class=" sm:w-[30rem] sm:h-[22rem] sm:flex items-center sm:justify-center sm:bg-gray-200 relative my-0 sm:mx-0 bg-gray-300">
                        <!-- img main -->

                        <i class="p-2 bg-gray-400 text-3xl rounded text-gray-900 bi bi-chevron-left absolute top-1/2 left-11"
                            @click="previousImage">

                        </i>

                        <div class="w-full h-full border">

                        <img class="w-full h-[100%]" :src="'/storage/' + currentImage">

</div>

                        <i class="p-2 text-4xl bg-gray-400 text-gray-900 rounded bi bi-chevron-right absolute top-1/2 right-11"
                            @click="nextImage">
                        </i>


                    </div>

                    <div class=" max-w-lg sm:mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2 mx-auto w-11/12 ">

                        <h3 class="text-gray-600 uppercase text-lg sm:text-3xl">{{ voiture.nom }}</h3>
                        <span class="text-gray-500 mt-3">Propose par <span class="text-gray-700 uppercase">{{ nameSeler }} {{
}} </span> </span> <br>
                        <span class="text-gray-500 mt-3">Prix : <span class="text-gray-700 uppercase">{{ voiture.prix }}
                            </span> Fcfa</span> <br>
                        <!-- <span class="text-gray-500 mt-3">Compteur : <span class="text-gray-700 uppercase">{{voiture.kilometrage  }}? 'N/A'</span> Km</span> -->

                        <div v-if="voiture.affaire == 'vente'">
                            <span class="text-gray-500 mt-3">Marque : <span class="text-gray-700 uppercase">{{ voiture.marque
                            }} </span> </span> <br>
                            <span class="text-gray-500 mt-3">Model : <span class="text-gray-700 uppercase">{{ voiture.model
                            }} </span> </span> <br>
                            <span class="text-gray-500 mt-3">Kilimetrage : <span
                                    class="text-gray-700 uppercase">{{ voiture.kilometrage }} </span> Km</span> <br>
                            <span class="text-gray-500 mt-3">Boite V : <span
                                    class="text-gray-700 uppercase">{{ voiture.boiteVitesse }} </span> </span> <br>
                            <span class="text-gray-500 mt-3">Carburant : <span
                                    class="text-gray-700 uppercase">{{ voiture.carburant }} </span> </span> <br>
                        </div>

                        <div v-else>
                            <span class="text-gray-500 mt-3">Marque : <span class="text-gray-700 uppercase">{{ voiture.marque
                            }} </span> </span> <br>
                            <!-- <span class="text-gray-500 mt-3">Model : <span class="text-gray-700 uppercase">{{voiture.model  }} </span> </span> <br> -->
                            <!-- <span class="text-gray-500 mt-3">Kilimetrage : <span class="text-gray-700 uppercase">{{voiture.kilometrage  }} </span> Km</span> <br> -->
                            <span class="text-gray-500 mt-3">Boite V : <span
                                    class="text-gray-700 uppercase">{{ voiture.boiteVitesse }} </span> </span> <br>
                            <span class="text-gray-500 mt-3">Carburant : <span
                                    class="text-gray-700 uppercase">{{ voiture.carburant }} </span> </span> <br>
                        </div>

                        <hr class="my-3">
                        <p class="text-gray-600 mt-3">
                            {{ voiture.description }}
                        </p>
                        <div class="mt-2">

                        </div>
                        <div class="mt-3">

                        </div>
                        <div class="flex items-center mt-6">
                            <button
                                class="px-8 mx-1 py-2 bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-principal">Contacter</button>
                            <button
                                class="px-8 mx-1 py-2 bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-principal">Voir
                                le num</button>

                        </div>
                    </div>
                </div>
                <div class="mt-16">
                    <!--  -->
                    <div>
                        <h2 class="text-lg font-semibold mb-4">Autres produits de la même marque</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <!-- Afficher les suggestions -->
                            <div v-for="suggestion in suggestions" :key="suggestion.id" class="border rounded-lg p-4">
                                <img :src="'/storage/' + suggestion.image1" alt="Produit" class="w-full mb-2 rounded-lg">
                                <h3 class="text-lg font-semibold">{{ suggestion.nom }}</h3>
                                <!-- <p class="text-gray-700">{{ suggestion.description }}</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- FOOTER -->

    <div class="#">
        <Footer />
    </div>
</template>

<style lang="css">
#photoContact {
    display: grid;
    grid-auto-columns: 55% 26%;
    /* height: 75vh; */
}

/* @media only screen and (max-width: 800px) {
  #photoContact {
    width: 79vw;
    margin: auto;
    background-color: lightblue;
    display: block;
  }
} */
/* telephone */
/* @media only screen and (max-width: 428px) {
  #photoContact {
    width: 100vw;
    padding: 0;
    margin: 0;
    display: block;
  }
} */
</style>


<script>


// export default {
//  components: { Footer },
//   props: {
//     voiture: Object
//   }
// }
export default {
    components: { Footer },
    //     props: {
    //     voiture: Object,
    //     user:Object,
    //     nameSeler:Object,
    //     mailSeler:Object,
    //     phoneSeler:Object,
    //   },

    components: {
        Head
    },
    data() {
        return {
            images: [

                this.voiture.image1,
                this.voiture.image2,
                this.voiture.image3,



            ],
            currentIndex: 0,
            showUserNumber: false,

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
        toggleUserNumber() {
            this.showUserNumber = !this.showUserNumber;
        }
        // envoie
    }
};

</script>



