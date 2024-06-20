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
       suggestions:Object,
       nPiece:Object,
       urlActuelle:Object,


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
 <div >
    <div class="nav bg-white w-full m-0 p-0">
        <nav
        class="
          px-9
          py-2
          mx-auto
          md:flex md:justify-between md:items-center
          shadow-xl
          relative
          bg-black
          text-white
        "
      >
        <div class="flex items-center justify-between ">
          <Link
            :href="route('home')"
            class="
            w-full
              text-3xl
        8   text-
              font-bold
              md:text-2xl
            text-principal

            "
            >Noflay
          </Link>



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


        <div class="auth flex">

<div class="mx-2 bg-principal rounded-xl">
    <i class="bi bi-node-plus pl-1"></i>
<Link :href="route('publier')"  class=" px-2 py-0 text-white hover:text-gray-900  dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"> Publier une annonce</Link>


</div>         <i class="bi bi-person-circle mx-1"></i>
<Link :href="route('login')"
            class="font-semibold  text-gray-300 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
          Se connecter</Link>

          <Link v-if="canRegister" :href="route('register')"
            class="ml-4 font-semibold  text-gray-300 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
          S inscrire</Link>

        </div>
    </div>
</div>
</div>
</div>

      </nav>
    </div>
    <!-- Home -->


    <main class="my-6 lg:pl-[10%] flex justify-center">
    <div class="container mx-auto">
        <div class="md:flex md:items-center">
            <!-- Image Container -->
            <div class="rounded-sm sm:w-[40rem] sm:h-[22rem] sm:flex items-center sm:justify-center sm:bg-gray-200 relative my-0 sm:mx-0 bg-gray-300">
                <!-- Left Arrow -->
                <i class="p-2 bg-transparent text-3xl rounded text-white bi bi-chevron-left absolute top-1/2 left-11" @click="previousImage"></i>
                <!-- Main Image -->
                <img class="w-full h-full" :src="'/storage/'+currentImage">
                <!-- Right Arrow -->
                <i class="p-2 text-4xl text-white rounded bi bi-chevron-right absolute top-1/2 right-11" @click="nextImage"></i>
            </div>

            <!-- Details Container -->
            <div class="max-w-lg sm:mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2 mx-auto w-11/12 rounded-2xl md:bg-secondaire p-8 mx-0">
                <!-- Header Section -->
                <div class="head flex">
                    <img class="mb-3 w-[4rem] h-[4rem] rounded-full shadow-2xl  bottom-1/3 right-0" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">
                    <span class="text-gray-400 mt-3 px-3">Proposé par <span class="text-gray-300 uppercase">{{ nameSeler }}</span></span>
                </div>
                <hr class="my-3">

                <!-- Property Details Based on Type -->
                <div v-if="maison.type=='villa' || maison.type=='appartement' || maison.type=='chambre'">
                    <span class="text-gray-500 mt-3">Lieu : <span class="text-gray-700 uppercase">{{ maison.region }}</span></span><br>
                    <span class="text-gray-500 mt-3">Piece : <span class="text-gray-700 uppercase">{{ maison.npiece }}</span></span><br>
                    <span class="text-gray-500 mt-3">Type : <span class="text-gray-700 uppercase">{{ maison.type }}</span></span><br>
                </div>
                <div v-else-if="maison.type=='verger' || maison.type=='ferme' || maison.type=='terrain'">
                    <span class="text-gray-500 mt-3">Lieu : <span class="text-gray-700">{{ maison.region }}</span></span><br>
                    <span class="text-gray-500 mt-3">Surface : <span class="text-gray-700">{{ maison.surface }}</span></span><br>
                    <span class="text-gray-500 mt-3">Type : <span class="text-gray-700">{{ maison.type }}</span></span><br>
                </div>

                <!-- Contact Buttons -->
                <div class="flex flex-col hidden md:flex">
                    <button class="w-full h-12 bg-principal text-white font-medium rounded-md mb-2" @click="ouvrirWhatsApp">
                        Contacter
                    </button>
                    <div>
                        <button class="w-full h-12 border-2 border-principal hover:bg-principal hover:border-1 hover:border-white text-white font-medium rounded-md" @click="afficherNumero">
                            Voir le numéro
                        </button>
                        <div v-if="afficherPopup" class="w-2/4 mx-auto fixed inset-0 flex justify-center bg-gray-800 bg-opacity-75">
                            <div class="bg-white rounded-lg p-8">
                                <span class="text-3xl text-principal">NB</span><br>
                                <span class="text-3xl">Évitez les demandes de paiement anticipé : Soyez prudents face aux demandes de paiement anticipé avant d'avoir reçu le produit ou visité la propriété. Les vendeurs légitimes seront compréhensifs envers vos préoccupations</span><br>
                                <span class="text-3xl"><span class="text-principal">Numéro du Vendeur</span>: {{ phoneSeler }}</span>
                                <button @click="fermerPopup" class="absolute top-0 right-0 mt-2 mr-2 text-3xl text-principal hover:text-gray-800 focus:outline-none">X</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information Below Image -->
        <div class="px-4 mt-4 rounded-sm sm:w-[40rem] sm:h-[22rem] items-center sm:justify-center relative my-0 sm:mx-0">
            <span class="text-secondaire uppercase text-2xl">{{ maison.nom }}</span><br>
            <span class="text-gray-500 mt-3">Prix : <span class="text-principal uppercase">{{ maison.prix }}</span> Fcfa</span><br>
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
                <h2 class="text-2xl font-semibold mb-4 text-secondaire">Autres produits de la même marque</h2><br>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <!-- Display Suggestions -->
                    <div v-for="suggestion in suggestions" :key="suggestion.id" class="w-full h-full object-cover border rounded-lg p-1">
                        <img :src="'/storage/'+ suggestion.image1" alt="Produit" class="w-full h-auto mb-2 rounded-lg">
                        <span class="text-md font-semibold text-principal text-center">{{ suggestion.nom }}</span>
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
    <button class="flex items-center bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-black px-4 py-2" @click="afficherNumero" >
        <i class="bi bi-telephone text-3xl mr-2"></i>Telephone
  </button>

  <!-- Nb -->

  <div v-if="afficherPopup" class="w-11/12 mx-auto fixed inset-0 flex justify-center bg-gray-800 bg-opacity-75">
      <div class="bg-white rounded-lg p-8">
        <span class="text-3xl text-principal">
            NBx
        </span>
        <br>
        <span class="text-1xl text-black">Évitez les demandes de paiement anticipé : Soyez prudents face aux demandes de paiement anticipé avant d'avoir reçu le produit ou visité la propriété. Les vendeurs légitimes seront compréhensifs envers vos préoccupations</span>
        <br>
        <br>
        <hr>
        <span class="text-1xl text-black">Numero du Vendeur</span><span class="text-principal">:{{ phoneSeler }}</span>
        <button @click="fermerPopup" class="absolute top-0 right-0 mt-2 mr-2 text-1xl text-gray-600 hover:text-gray-800 focus:outline-none">
          X
        </button>
      </div>
    </div>

   </div>

  <div class="second">
    <button @click="ouvrirWhatsApp" class="flex items-center bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-black px-4 py-2">
    <i class="bi bi-whatsapp text-3xl mr-2"></i> WhatsApp
  </button>
  </div>



</div>


   <!-- FOOTER -->

   <div class="footer relative top-12 mt-40 ">
              <Footer/>
            </div>






    </template>

    <style lang="css">
    #photoContact {
        display: grid;
        grid-auto-columns: 55% 26%;
        /* height: 75vh; */
    }


    #home{
        height: 100vh;
    }

    </style>


    <script>


    export default {
        components: { Footer },

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
