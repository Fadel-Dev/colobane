<script setup>
import { Head, Link, router  } from '@inertiajs/vue3';
import Footer from '../Components/Footer.vue';
import { Inertia } from '@inertiajs/inertia';

</script>
<template>
      <!--  <div class="max-w-6xl mx-auto my-12 ">
     <Link
            :href="route('home')"
            class="
            w-full
              text-xl
              text-
              font-bold
              md:text-2xl
            text-principal
            font-sans
            flex


            "
            >Retour a l acceuil
          </Link>
    </div> -->


    <main class="antialiased max-w-6xl mx-auto my-12  px-0 bg-gray-700">

    <div class="relative block md:flex items-center">
      <div class="w-full md:w-1/2 relative z-1 pb-14 rounded shadow-lg overflow-hidden bg-gray-200">
        <div class="text-lg font-medium text-principal uppercase p-8 text-center border-b border-gray-200 tracking-wide bg-gray-900">
            <Link
            :href="route('home')"
            class="
            w-full
              text-xl
              text-
              font-bold
              md:text-2xl
            text-principal
            font-sans

            "
            >Noflay
          </Link>
        </div>
        <!-- 2e -->
        <div class="block sm:flex md:block lg:flex items-center justify-center bg-gray-200">
          <div class="mt-8 sm:m-8 md:m-0 md:mt-8 lg:m-8 text-center">
            <div class="inline-flex items-center">
              <span class="text-3xl font-medium">0fcfa</span>
              <!-- <span class="text-xl text-gray-600 ml-2">-</span> -->
              <span class="text-xl ml-2">10 articles/mois</span>
            </div>
            <span class="block text-sm text-gray-600 mt-2">Publier 5 Immobilliers</span>
            <span class="block text-sm text-gray-600 mt-2">Publier 5 Voitures</span>
          </div>
          <div class="mt-4 mb-8 sm:m-8 md:m-0 md:mt-4 md:mb-8 lg:m-8 text-center">
            <div class="inline-flex items-center">
              <span class="text-3xl font-medium">Apartir</span>
              <!-- <span class="text-xl text-gray-600 ml-2">-</span> -->
              <span class="text-xl ml-2">2.000fcfa</span>
            </div>
            <span class="block text-sm text-gray-600 mt-2">Publication en illimite</span>
            <span class="block text-sm text-gray-600 mt-2">Booster vos articles</span>
          </div>
        </div>
        <!-- 3e -->
        <div class="flex justify-center mt-3 bg-gray-200">
          <ul>
            <li class="flex items-center">
              <div class="bg-principal rounded-full p-2 fill-current text-principal">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" ><path class="primary" d="M11 3.05V2a1 1 0 0 1 2 0v1.05A10 10 0 0 1 22 13c0 1.33-2 1.33-2 0a2 2 0 1 0-4 0c0 1.33-2 1.33-2 0a2 2 0 1 0-4 0c0 1.33-2 1.33-2 0a2 2 0 1 0-4 0c0 1.33-2 1.33-2 0a10 10 0 0 1 9-9.95z"/><path class="secondary" d="M11 14a1 1 0 0 1 2 0v5a3 3 0 0 1-6 0 1 1 0 0 1 2 0 1 1 0 0 0 2 0v-5z"/></svg>
              </div>
              <span class="text-gray-700 text-lg ml-3">Publize Gratuitement Jusqu a 10 articles/Mois</span>
            </li>
            <li class="flex items-center mt-3">
              <div class="bg-principal rounded-full p-2 fill-current text-principal">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="primary" d="M5 8h14a1 1 0 0 1 1 .92l1 12A1 1 0 0 1 20 22H4a1 1 0 0 1-1-1.08l1-12A1 1 0 0 1 5 8z"/><path class="secondary" d="M9 10a1 1 0 0 1-2 0V7a5 5 0 1 1 10 0v3a1 1 0 0 1-2 0V7a3 3 0 0 0-6 0v3z"/></svg>
              </div>
              <span class="text-gray-700 text-lg ml-3">Creez une Boutique avec Publications Illimitee</span>
            </li>
            <li class="flex items-center mt-3">
              <div class="bg-principal rounded-full p-2 fill-current text-principal">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="primary" d="M14 13h6.78a1 1 0 0 1 .97 1.22A10 10 0 1 1 9.78 2.25a1 1 0 0 1 1.22.97V10a3 3 0 0 0 3 3z"/><path class="secondary" d="M20.78 11H14a1 1 0 0 1-1-1V3.22a1 1 0 0 1 1.22-.97c3.74.85 6.68 3.79 7.53 7.53a1 1 0 0 1-.97 1.22z"/></svg>
              </div>
              <span class="text-gray-700 text-lg ml-3">Booster Vos Annonces</span>
            </li>
          </ul>
        </div>
        <!-- <a class="block flex items-center justify-center bg-gray-200 hover:bg-gray-300 p-8 text-md font-semibold text-gray-800 uppercase mt-16" href="#">
          <span>Create account</span>
          <span class="font-medium text-gray-700 ml-2">➔</span>
        </a> -->
      </div>
     <!-- deuxieme section -->
     <div class="w-full md:w-1/2 relative z-0 px-8 md:px-0 md:py-16  bg-gray-200">
        <div class="w-4/6 mx-auto flex h-">
            <!-- <h2 class="text-2xl  font-bold mb-4 text-center">Sélectionnez une image</h2> -->

         <div class="card w-full text-principal text-center p-5 shadow-lg" id="vehicule">
             <span class="text-2xl w-full p-2 rounded-md   font-bold"><a href="/publication/voiture/">Vehicules</a></span>

             <a href="/publication/voiture/">             <img src="https://img.freepik.com/free-photo/stylish-black-woman-car-salon_1157-21402.jpg?w=740&t=st=1701121371~exp=1701121971~hmac=c7423bc1f745be6fc710777ac02ac0a32d7bb860117b5dfdc0fd7e29846c9e00" :alt="image" class=" rounded-lg shadow-lg" alt="">
</a>

        </div>

           <div class="card w-full p-5 shadow-lg text-principal text-center" id="immobilier">
             <h2 class="text-2xl font-bold"><a href="/publication/immobilier/">Immobillier</a></h2>
             <a href="/publication/immobilier/">             <img src="https://img.freepik.com/free-photo/closeup-shot-person-thinking-buying-selling-house_181624-24928.jpg?w=740&t=st=1701121196~exp=1701121796~hmac=55a2bcd198307e4a2bb9bb46cb896c4f64910a6eb0382d605252279fa191b5eb" :alt="image" class=" rounded-lg shadow-lg" alt="">
</a>

        </div>

         </div>
      </div>
    </div>
    </main>  <!--  -->
</template>

<script>
export default {

}
</script>
