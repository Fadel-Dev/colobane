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
              text-xl
              text-
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

                    <h3 class="text-gray-600 uppercase text-lg sm:text-3xl">{{ maison.nom }}</h3>
                    <span class="text-gray-500 mt-3">Propose par <span class="text-gray-700 uppercase">{{nameSeler  }} {{  }} </span> </span> <br>
                    <span class="text-gray-500 mt-3">Prix : <span class="text-gray-700 uppercase">{{maison.prix  }} </span> Fcfa</span>
                    <hr class="my-3">
                    <p  class="text-gray-600 mt-3">
                        {{ maison.description }}
                    </p>

                    <!-- <div class="mt-3">
                        <div class="flex items-center mt-1 relative">
			<img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">
            <span class="absolute top-2 left-20 ml-6 text-gray-700 uppercase">{{ nameSeler }}</span>

                        </div>
                    </div> -->
<!-- FOR VILLA -->
<div v-if="maison.type=='villa'">
  <span class="text-gray-500 mt-3">Lieu : <span class="text-gray-700 uppercase">{{maison.region  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Piece : <span class="text-gray-700 uppercase">{{maison.npiece  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Type : <span class="text-gray-700 uppercase">{{maison.type  }} </span> </span> <br>
</div>
<!-- FOR APARTEMENT -->
<div v-else-if="maison.type=='appartement'">
  <span class="text-gray-500 mt-3">Lieu : <span class="text-gray-700 uppercase">{{maison.region  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Piece : <span class="text-gray-700 uppercase">{{maison.npiece  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Type : <span class="text-gray-700 uppercase">{{maison.type  }} </span> </span> <br>
</div>
<!-- FOR CHAMBRE -->
<div v-else-if="maison.type=='chambre'">
  <span class="text-gray-500 mt-3">Lieu : <span class="text-gray-700 uppercase">{{maison.region  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Piece : <span class="text-gray-700 uppercase">{{maison.npiece  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Type : <span class="text-gray-700 uppercase">{{maison.type  }} </span> </span> <br>
</div>
<!-- FOR FERME -->

<div v-else-if="maison.type=='verger'">
  <span class="text-gray-500 mt-3">Lieu : <span class="text-gray-700 ">{{maison.region  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Surface : <span class="text-gray-700 ">{{maison.surface  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Type : <span class="text-gray-700 ">{{maison.type  }} </span> </span> <br>
</div>
<!-- FOR FERME -->

<div v-else-if="maison.type=='ferme'">
  <span class="text-gray-500 mt-3">Lieu : <span class="text-gray-700 ">{{maison.region  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Surface : <span class="text-gray-700 ">{{maison.surface  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Type : <span class="text-gray-700 ">{{maison.type  }} </span> </span> <br>
</div>

<!-- FOR TERRAIN -->

<div v-else-if="maison.type=='terrain'">
  <span class="text-gray-500 mt-3">Lieu : <span class="text-gray-700 ">{{maison.region  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Surface : <span class="text-gray-700 ">{{maison.surface  }} </span> </span> <br>
  <span class="text-gray-500 mt-3">Type : <span class="text-gray-700 ">{{maison.type  }} </span> </span> <br>
</div>





                    <div class="flex items-center mt-6">
                        <div>
    <button
      class="px-8 mx-1 py-2 bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-black"
      @click="ouvrirWhatsApp"
    >
     contacter
    </button>
  </div>
                        <div>
    <button @click="afficherNumero" class="px-8 mx-1 py-2 bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-black">
      Voir le numéro
    </button>

    <div v-if="afficherPopup" class="w-2/4   mx-auto fixed inset-0 flex  justify-center bg-gray-800 bg-opacity-75">
      <div class="bg-white rounded-lg p-8">
        <span class="text-3xl text-principal">
            NB
        </span> <br>
        <span class="text-xl font-medium">Évitez les demandes de paiement anticipé : Soyez prudents face aux demandes de paiement anticipé avant d'avoir reçu le produit ou visité la propriété. Les vendeurs légitimes seront compréhensifs envers vos préoccupations</span>
    <br>    <span class="text-xl font-medium"><span class="text-principal">Numero du Vendeur</span> :{{ phoneSeler }}</span>
        <button @click="fermerPopup" class="absolute top-0 right-0 mt-2 mr-2 text-4xl text-principal hover:text-gray-800 focus:outline-none">
          X
        </button>
      </div>
    </div>
  </div>




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
        <img :src="'/storage/'+ suggestion.image1" alt="Produit" class="w-full mb-2 rounded-lg">
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
    //   nnnum
    afficherPopup: false,
          numero: "123456789" // Remplacez cela par votre numéro réel
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
      const numeroContact = +221769275309; // Remplacez par le vrai numéro de contact

      // Générer le lien WhatsApp
      const lienWhatsApp = `https://api.whatsapp.com/send?phone=${this.numeroContact}`;

      // Ouvrir le lien dans une nouvelle fenêtre/onglet
      window.open(lienWhatsApp, "_blank");
    },
    // envoie
  }
};

    </script>



