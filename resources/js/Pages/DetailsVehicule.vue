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
    urlActuelle:Object,


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

        <main class=" my-6 lg:pl-[10%] flex justify-center">
            <div class="container mx-auto ">
                <div class="md:flex md:items-center">
                    <div
                        class=" rounded-sm sm:w-[40rem] sm:h-[22rem] sm:flex items-center sm:justify-center sm:bg-gray-200 relative my-0 sm:mx-0 bg-gray-300">

                        <!-- img main -->

                        <i class="p-2 bg-gray-400 text-3xl rounded text-gray-900 bi bi-chevron-left absolute top-1/2 left-11"
                            @click="previousImage">

                        </i>

                        <div class="w-full h-full border">

                            <img class="w-full h-full " :src="'/storage/' + currentImage">

                        </div>

                        <i class="p-2 text-4xl bg-gray-400 text-gray-900 rounded bi bi-chevron-right absolute top-1/2 right-11"
                            @click="nextImage">
                        </i>


                    </div>


                    <div
                        class=" max-w-lg sm:mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2 mx-auto w-11/12 rounded-2xl md:bg-secondaire p-8 mx-0">
                        <div class="head flex">
                            <img class="mb-3 w-[4rem] h-[4rem] rounded-full shadow-2xl  bottom-1/3 right-0"
                                src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">

                            <span class="text-gray-400 mt-3 px-3">Propose par <span
                                    class="text-gray-300 uppercase">{{ nameSeler }} {{ }} </span> </span> <br>


                        </div>
                        <hr class="my-3">



                        <div class="mt-2">

                        </div>
                        <div class="mt-3">

                        </div>

                        <div class="flex flex-col   hidden md:flex">
  <button class="w-full h-12 bg-principal text-white font-medium rounded-md mb-2" @click="ouvrirWhatsApp"
    >
      Contacter
    </button>

    <div>
        <button class="w-full h-12 border-2 border-principal hover:bg-principal hover:border-1 hover:border-white text-white font-medium rounded-md" @click="afficherNumero" >
    Voir le numero
  </button>
        <div v-if="afficherPopup" class="w-2/4 mx-auto fixed inset-0 flex justify-center bg-gray-800 bg-opacity-75">
      <div class="bg-white rounded-lg p-8">
        <span class="text-3xl text-principal">
            NB
        </span>
        <br>
        <span class="text-3xl font-mediu8">Évitez les demandes de paiement anticipé : Soyez prudents face aux demandes de paiement anticipé avant d'avoir reçu le produit ou visité la propriété. Les vendeurs légitimes seront compréhensifs envers vos préoccupations</span>
        <br>
        <span class="text-3xl font-mediu8"><span class="text-principal">Numero du Vendeur</span> :{{ phoneSeler }}</span>
        <button @click="fermerPopup" class="absolute top-0 right-0 mt-2 mr-2 text-1xl text-gray-600 hover:text-gray-800 focus:outline-none">
          X
        </button>
      </div>
    </div>
    </div>


</div>
                    </div>


                </div>

                <div v-if="voiture.affaire == 'vente'">
                    <span class="text-gray-500 mt-3">Marque : <span class="text-gray-700 uppercase">{{ voiture.marque
                    }} </span> </span> <br>
                    <span class="text-gray-500 mt-3">Model : <span class="text-gray-700 uppercase">{{ voiture.model
                    }} </span> </span> <br>
                    <span class="text-gray-500 mt-3">Kilimetrage : <span class="text-gray-700 uppercase">{{
                        voiture.kilometrage }} </span> Km</span> <br>
                    <span class="text-gray-500 mt-3">Boite V : <span class="text-gray-700 uppercase">{{ voiture.boiteVitesse
                    }} </span> </span> <br>
                    <span class="text-gray-500 mt-3">Carburant : <span class="text-gray-700 uppercase">{{ voiture.carburant
                    }} </span> </span> <br>
                </div>

                <div v-else>
                    <span class="text-secondaire uppercase text-2xl ">{{ voiture.nom }}</span> <br>
                    <span class="text-gray-500 mt-3">Prix : <span class="text-principal uppercase">{{ voiture.prix }} </span>
                        Fcfa</span> <br>
                    <hr>
                </div>



                <div
                    class="px-4 mt-4 rounded-sm sm:w-[40rem] sm:h-[22rem]  items-center sm:justify-center  relative my-0 sm:mx-0 ">



                    <div class="flex items-center ">

                        <div class="w-full grid grid-cols-3 ">
                            <!-- Marque -->
                            <div class="flex items-center mb-3">
                                <i class="bi bi-bag-check text-2xl mr-2"></i>
                                <div>
                                    <span class="font-semibold">Marque :</span>
                                    <span class="text-gray-600">{{ voiture.marque }}</span>
                                </div>
                            </div>

                            <!-- Mode -->
                            <div class="flex items-center mb-3">
                                <i class="bi bi-speedometer2 text-2xl mr-2"></i>
                                <div>
                                    <span class="font-semibold">Model :</span>
                                    <span class="text-gray-600">{{ voiture.model }}</span>
                                </div>
                            </div>

                            <!-- Boîte de vitesse -->
                            <div class="flex items-center mb-3">
                                <i class="bi bi-gear text-2xl mr-2"></i>
                                <div>
                                    <span class="font-semibold">Boîte de vitesse :</span>
                                    <span class="text-gray-600">{{ voiture.boiteVitesse }}</span>
                                </div>
                            </div>

                            <!-- Kilométrage -->
                            <div class="flex items-center mb-3">
                                <i class="bi bi-speedometer text-2xl mr-2"></i>
                                <div>
                                    <span class="font-semibold">Kilométrage :</span>
                                    <span class="text-gray-600"> {{ voiture.kilometrage }}</span>
                                </div>
                            </div>

                            <!-- Carburant -->
                            <div class="flex items-center mb-3">
                                <i class="bi bi-droplet text-2xl mr-2"></i>
                                <div>
                                    <span class="font-semibold">Carburant :</span>
                                    <span class="text-gray-600"> {{ voiture.carburant }}</span>
                                </div>
                            </div>

                            <!-- Place -->
                            <div class="flex items-center mb-3">
                                <i class="bi bi-person text-2xl mr-2"></i>
                                <div>
                                    <span class="font-semibold">Place :</span>
                                    <span class="text-gray-600"> {{ voiture.place }}</span>
                                </div>
                            </div>

                            <!-- Année -->
                            <div class="flex items-center mb-3">
                                <i class="bi bi-calendar text-2xl mr-2"></i>
                                <div>
                                    <span class="font-semibold">Année :</span>
                                    <span class="text-gray-600"> {{ voiture.annee }}</span>
                                </div>
                            </div>

                            <!-- État -->
                            <div class="flex items-center mb-3">
                                <i class="bi bi-check-circle text-2xl mr-2"></i>
                                <div>
                                    <span class="font-semibold">État :</span>
                                    <span class="text-gray-600"> {{ voiture.etat }}</span>
                                </div>
                            </div>

                            <!-- Vente -->
                            <div class="flex items-center mb-3">
                                <i class="bi bi-cash text-2xl mr-2"></i>
                                <div>
                                    <span class="font-semibold">Vente :</span>
                                    <span class="text-gray-600"> {{ voiture.affaire }}</span>
                                </div>
                            </div>
                        </div>




                    </div>
                    <hr>

                    <p  class="text-gray-600 mt-1">{{ voiture.description }} </p> <br>

                </div>





























                <div class="mt-1">
                    <!--  -->
                    <div>
                        <h2 class="text-2xl font-semibold mb-4 text-secondaire">Autres produits de la même marque</h2> <br>
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

    <div class="fixed bottom-0 w-full bg-transparent text-white p-4 flex mx-auto justify-around md:hidden">
   <div class="first">
    <button class="flex items-center bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-black px-4 py-2" @click="afficherNumero" >
        <i class="bi bi-telephone text-3xl mr-2"></i>Telephone
  </button>
   </div>

  <div class="second">
    <button @click="ouvrirWhatsApp" class="flex items-center bg-principal text-white text-sm font-medium rounded hover:bg-gray-900 focus:outline-none focus:bg-black px-4 py-2">
    <i class="bi bi-whatsapp text-3xl mr-2"></i> WhatsApp
  </button>
  </div>
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
            afficherPopup: false,
          numero: "123456789" // Remp
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



