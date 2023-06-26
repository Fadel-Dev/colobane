<script setup>

import { Head, Link, router  } from '@inertiajs/vue3';
import Footer from '../Components/Footer.vue';
import { Inertia } from '@inertiajs/inertia';



   import Navbar from '../Components/Navbar.vue'

const props = defineProps({
voiture: Object,
        user:Object,
        nameSeler:Object,
        mailSeler:Object,
        phoneSeler:Object,

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
      <nav
        class="
          px-9
          py-2
          mx-auto
          md:flex md:justify-between md:items-center
        "
      >
        <div class="flex items-center justify-between ">
          <router-link
            to="/"
            class="
            w-full
              text-xl
              font-bold
              text-gray-800
              md:text-2xl
              hover:text-blue-400
            "
            >Logo
          </router-link>

          <!-- Mobile menu button -->
          <div @click="showMenu = !showMenu" class="flex md:hidden">
            <button
              type="button"
              class="
                text-gray-800
                hover:text-gray-400
                focus:outline-none focus:text-gray-400
              "
            >
              <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                <path
                  fill-rule="evenodd"
                  d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
                ></path>
              </svg>
            </button>
          </div>
        </div>

  <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
  <div
          :class="showMenu ? 'flex' : 'hidden'"
          class="
            flex-col
            mt-8
            space-y-4
            md:flex
            md:space-y-0
            md:flex-row
            md:items-center
            md:space-x-10
            md:mt-0
          "
        >
        <div class="auth">
   <div v-if="canLogin" >
      <Link v-if="$page.props.auth.user" :href="route('dashboard')"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
      Dashboard</Link>

      <div v-else>


        <div class="auth">
          <Link :href="route('login')"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
          Log in</Link>

          <Link v-if="canRegister" :href="route('register')"
            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
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
                <div class=" sm:w-[30rem] sm:h-[22rem] sm:flex items-center sm:justify-center sm:bg-gray-200 relative my-0 sm:mx-0 bg-gray-300" >
                    <!-- img main -->

                    <i
                    class="p-2 bg-transparent text-3xl rounded text-white bi bi-chevron-left absolute top-1/2 left-11"
                    @click="previousImage"
                    >

                </i>

                <img  class="max-w-full max-h-full" :src="'/storage/'+currentImage"  >



<i class="p-2 text-4xl text-white rounded bi bi-chevron-right absolute top-1/2 right-11" @click="nextImage">
  </i>


    </div>

                <div class=" max-w-lg sm:mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2 mx-auto w-11/12 ">

                    <h3 class="text-gray-600 uppercase text-lg sm:text-3xl">{{ voiture.nom }}</h3>
                    <span class="text-gray-500 mt-3">Propose par <span class="text-gray-700 uppercase">{{nameSeler  }} {{  }} </span> </span> <br>
                    <span class="text-gray-500 mt-3">Prix : <span class="text-gray-700 uppercase">{{voiture.prix  }} </span> Fcfa</span> <br>
                    <!-- <span class="text-gray-500 mt-3">Compteur : <span class="text-gray-700 uppercase">{{voiture.kilometrage  }}? 'N/A'</span> Km</span> -->

<div v-if="voiture.affaire=='vente'">
  <span class="text-gray-500 mt-3">Marque : <span class="text-gray-700 uppercase">{{voiture.marque  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Model : <span class="text-gray-700 uppercase">{{voiture.model  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Kilimetrage : <span class="text-gray-700 uppercase">{{voiture.kilometrage  }} </span> Km</span> <br>
  <span class="text-gray-500 mt-3">Boite V : <span class="text-gray-700 uppercase">{{voiture.boiteVitesse  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Carburant : <span class="text-gray-700 uppercase">{{voiture.carburant  }} </span> </span> <br>
</div>

<div v-else>
  <span class="text-gray-500 mt-3">Marque : <span class="text-gray-700 uppercase">{{voiture.marque  }} </span> </span> <br>
  <!-- <span class="text-gray-500 mt-3">Model : <span class="text-gray-700 uppercase">{{voiture.model  }} </span> </span> <br> -->
  <!-- <span class="text-gray-500 mt-3">Kilimetrage : <span class="text-gray-700 uppercase">{{voiture.kilometrage  }} </span> Km</span> <br> -->
  <span class="text-gray-500 mt-3">Boite V : <span class="text-gray-700 uppercase">{{voiture.boiteVitesse  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Carburant : <span class="text-gray-700 uppercase">{{voiture.carburant  }} </span> </span> <br>
</div>

                    <hr class="my-3">
                    <p  class="text-gray-600 mt-3">
                        {{ voiture.description }}
                    </p>
                    <div class="mt-2">
                        <!-- <p  class="text-gray-600 mt-3">
                            <span>coolman</span>

                        </p>   -->
                    </div>
                    <div class="mt-3">
                        <!-- <div class="flex items-center mt-1 relative">
			<img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">
            <span class="absolute top-2 left-20 ml-6 text-gray-700 uppercase">{{ nameSeler }}</span>


                        </div> -->
                    </div>
                    <div class="flex items-center mt-6">
                        <button class="px-8 mx-1 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Contacter</button>
                        <button class="px-8 mx-1 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Voir le num</button>

                    </div>
                </div>
            </div>
            <div class="mt-16">
                <h3 class="text-gray-600 text-2xl font-medium">Produits Similaire</h3>
                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('https://images.unsplash.com/photo-1563170351-be82bc888aa4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=376&q=80')">
                            <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </button>
                        </div>
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">Chanel</h3>
                            <span class="text-gray-500 mt-2">$12</span>
                        </div>
                    </div>
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('https://images.unsplash.com/photo-1544441893-675973e31985?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1500&q=80')">
                            <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </button>
                        </div>
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">Man Mix</h3>
                            <span class="text-gray-500 mt-2">$12</span>
                        </div>
                    </div>
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('https://images.unsplash.com/photo-1532667449560-72a95c8d381b?ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80')">
                            <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </button>
                        </div>
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">Classic watch</h3>
                            <span class="text-gray-500 mt-2">$12</span>
                        </div>
                    </div>
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('https://images.unsplash.com/photo-1590664863685-a99ef05e9f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=345&q=80')">
                            <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </button>
                        </div>
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">woman mix</h3>
                            <span class="text-gray-500 mt-2">$12</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
  </div>

   <!-- FOOTER -->

   <div class="#">
              <Footer/>
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

      components : {
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



