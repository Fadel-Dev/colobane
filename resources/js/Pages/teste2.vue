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

          <!-- <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <form>
              <div class="flexz">
                <input type="text" class="border-2 border-gray-300 bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none" placeholder="Recherche...">
                <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full ml-2">Rechercher</button>
              </div>
            </form>
          </div>
        </div> -->

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
    </div>
    <!-- Home -->

    <footer class="bg-gray-800 text-white">
    <div class="container mx-auto py-8 px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- À propos de nous -->
        <div>
          <h3 class="text-lg font-bold mb-4">À propos de nous</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eu velit velit.</p>
        </div>

        <!-- Contactez-nous -->
        <div>
          <h3 class="text-lg font-bold mb-4">Contactez-nous</h3>
          <ul class="space-y-2">
            <li>Adresse: 123 Rue de l'Exemple, Ville, Pays</li>
            <li>Téléphone: +123 456 789</li>
            <li>Email: info@example.com</li>
          </ul>
        </div>

        <!-- Navigation -->
        <div>
          <h3 class="text-lg font-bold mb-4">Navigation</h3>
          <ul class="space-y-2">
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Ventes de voitures</a></li>
            <li><a href="#">Locations de voitures</a></li>
            <li><a href="#">Ventes immobilières</a></li>
            <li><a href="#">Locations immobilières</a></li>
          </ul>
        </div>

        <!-- Suivez-nous -->
        <div>
          <h3 class="text-lg font-bold mb-4">Suivez-nous</h3>
          <div class="flex space-x-4">
            <a href="#" class="text-white hover:text-gray-500">
              <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                <path d="M12 0a12 12 0 100 24 12 12 0 000-24zm3.6 9.83l-4.57 1.63c-.1.04-.21.05-.32.02l-1.83-.47c-.32-.08-.65.04-.9.3l-2.33 2.34c-.16.16-.24.37-.23.59v1.64c0 .36.29.65.65.65h.01l1.53-.01c.38 0 .7.31.7.7v.03l.01 1.67c0 .38.29.68.66.68h1.67c.39 0 .7-.32.7-.7v-.03v-1.67c0-.17.14-.3.3-.3l1.53-.01c.37 0 .66-.29.66-.65v-1.64c.01-.23-.08-.43-.24-.59l-2.32-2.33c-.25-.25-.59-.38-.91-.3l-1.82.47c-.11.03-.22.02-.32-.02l-4.57-1.63c-.46-.16-.97.09-1.14.56L3.06 11.5c-.17.47.1.99.56 1.16l4.56 1.63c.1.04.21.05.32.02l1.82-.47c.32-.08.65.04.91.3l2.33 2.34c.16.16.24.37.23.59v1.64c0 .38-.29.68-.65.68h-.01l-1.53.01c-.38 0-.69.29-.69.65v.03v1.67c0 .38-.29.68-.66.68H9.5c-.39 0-.7-.32-.7-.7v-.03l-.01-1.67c0-.17-.14-.3-.3-.3l-1.52.01c-.38 0-.68-.3-.68-.68v-1.64c-.01-.23.08-.43.24-.59l2.33-2.34c.25-.25.58-.38.9-.3l1.83.47c.11.03.22.02.32-.02l4.56-1.63c.46-.17.73-.69.56-1.16l-1.62-4.56c-.17-.47-.68-.73-1.14-.56z"/>
              </svg>
            </a>
            <a href="#" class="text-white hover:text-gray-500">
              <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                <path d="M22.64 4.66c-.8.35-1.66.59-2.55.7.92-.55 1.63-1.42 1.96-2.46-.86.51-1.81.88-2.83 1.08-.81-.86-1.96-1.4-3.24-1.4-2.45 0-4.43 1.98-4.43 4.42 0 .35.04.7.11 1.04-3.67-.18-6.92-1.95-9.1-4.63-.38.65-.59 1.41-.59 2.23 0 1.53.78 2.88 1.96 3.67-.72-.02-1.4-.22-1.99-.55v.05c0 2.14 1.51 3.93 3.51 4.34-.37.1-.76.16-1.17.16-.28 0-.55-.03-.82-.08.56 1.75 2.19 3.02 4.12 3.06-1.51 1.18-3.42 1.88-5.5 1.88-.35 0-.69-.02-1.03-.07 1.96 1.26 4.28 2 6.78 2 8.13 0 12.58-6.74 12.58-12.59 0-.19 0-.38-.01-.57.86-.63 1.61-1.43 2.2-2.34z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </footer>
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



