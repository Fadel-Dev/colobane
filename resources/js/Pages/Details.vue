<script setup>

import { Head, Link, router  } from '@inertiajs/vue3';
import Footer from '../Components/Footer.vue';
import { Inertia } from '@inertiajs/inertia';

   import Navbar from '../Components/Navbar.vue'

const props = defineProps({
maison: Object,
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
  <title>Detail {{ maison.nom }} </title>
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

    <div class="main w-11/12 mx-auto">
        <div class="flex  md:flex-row">
  <div class="w-3/4 max-w-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <div class="flex flex-col ">
      <div class="w-full p-1">
        <i
      class="p-2 bg-blue-500 -white rounded text-white bi bi-chevron-left absolute"
      @click="previousImage"
    >

    </i>
    <img :src="'/storage/'+currentImage" class="w-full h-full object-cover " />
<div class=" align-center justify-end item-center min-w-full">
<i class="p-2 bg-blue-500 text-white rounded bi bi-chevron-right" @click="nextImage">
  </i>
</div>

    </div>
      <div class="w-2/12 flex mx-auto ">
        <img :src=" '/storage/' + maison.image2" :alt="maison.imageAlt"
                class="h-1/6 p-1 w-1/12 object-cover object-center lg:h-2/4 lg:w-full" />
                <img :src=" '/storage/' + maison.image2" :alt="maison.imageAlt"
                class="h-1/6 p-1 w-1/12 object-cover object-center lg:h-2/4 lg:w-full" />
                <img :src=" '/storage/' + maison.image2" :alt="maison.imageAlt"
                class="h-1/6 p-1 w-1/12 object-cover object-center lg:h-2/4 lg:w-full" />

            </div>

    </div>
  </div>
  <!-- <div v-for="">

  </div> -->

  <div class="w-full md:w-1/2 px-10">
                    <!-- <div class="mb-10">
                        <h1 class="font-bold uppercase text-3xl mb-5">{{ maison.nom }} {{nameSeler}}</h1>
                        <p class="text-lg">{{ maison.description }} <a href="#" class="opacity-50 text-gray-900 hover:opacity-100 inline-block text-xs leading-none border-b border-gray-900">MORE <i class="mdi mdi-arrow-right"></i></a></p>
                    </div>
                    <div>
                        <div class="inline-block align-bottom mr-5">
                            <span class="text-2xl leading-none align-baseline">prix</span>
                            <span class="font-bold text-5xl leading-none align-baseline">{{ maison.prix }}</span>
                            <span class="text-2xl leading-none align-baseline"> Fcfa</span>
                        </div>
                        <div class="flex flex-col ">
                            <button class="bg-yellow-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 rounded-full px-2 py-2 font-semibold m-1 w-2/4"><i class="mdi mdi-cart -ml-2 mr-2"></i> Me contacter sur whatshapp</button>
                            <button class="bg-yellow-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 rounded-full px-2 py-2 font-semibold w-2/4"><i class="mdi mdi-cart -ml-2 mr-2"></i>Afficher mon numero</button>
                        </div>
                    </div> -->
                    <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
		<div class="flex justify-end px-4 pt-4">
			<!-- <button id="dropdownButton" data-dropdown-toggle="dropdown" class="hidden sm:inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
</button> -->

		</div>
		<div class="flex flex-col items-center pb-10">
			<img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">
			<h3 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ nameSeler }}</h3>
			<span class="text-sm text-gray-500 dark:text-gray-400">vendeur</span>
			<div class="flex mt-4 space-x-3 lg:mt-6">
				<a href="#"
					class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Contacter
                </a>

                <!-- phone seller -->
                <button @click="toggleUserNumber">{{ showUserNumber ? ' Afficher' : 'Cacher' }}</button>
                <div v-if="showUserNumber">
                    <a href="#"
					class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">voir le numero
                </a>
                </div>

                <div v-else>
                    <a href="#"
					class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ phoneSeler }}
                </a>
                </div>

			</div>
		</div>
	</div>
                </div>
</div>
    </div>
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
    //     maison: Object
    //   }
    // }
    export default {
        components: { Footer },
    //     props: {
    //     maison: Object,
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

       this.maison.image1,
       this.maison.image2,
       this.maison.image3,



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



