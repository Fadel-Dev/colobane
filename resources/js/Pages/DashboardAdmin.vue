<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router  } from '@inertiajs/vue3';
import Footer from '../Components/Footer.vue';
import { Inertia } from '@inertiajs/inertia';



const  props = defineProps({
car:Object,
    maison:Object,
        vehicules:Object,
        habitats:Object,
     results:Object,
     total:Object,
     totalImmobilier:Object,
     totalVehicule:Object,
    //  ARTICLE VENDUS
    totalImmobilierVendu:Object,
    totalVehiculeVendu:Object,
    resultsVendu:Object,
    totalVendu:Object,
    // ARTICLE Actuel

    totalImmobilierActuel:Object,
    totalVehiculeActuel:Object,
    resultsActuel:Object,
    totalActuel:Object,

    //total articles vendus price

    totalVenduSomme:Object,
    sommeHabitatVendu:Object,
    sommeVehiculeVendu:Object,


// LES CALCULES

restantImmobilier:Object,
restantVoiture:Object,
totalArticles:Object,
totalRestant:Object,

users:Object


    });
    
</script>

<style>
  .custom-grid {
    display: grid;
    grid-template-rows: 20% 80%; /* First column 10%, second column 90% */
  }
  .popup {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.popup-content {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
}
</style>

<template>
    <AppLayout title="Dashboard">
        <template>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div>
            <div class=" left-0  px-5 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">


            <div v-for="use in users">
                    <span>{{use.id}}</span>

            </div>


            </div>
</div>
        <div class="custom-grid">


 <!--sidenav -->


   <!-- CORPS -->

  
<!-- VOITURES -->
<div v-show="activeTab === 'voitures'" class="bg-gray-100 ">

<!-- all articles -->
<div class="flex flex-wrap justify-center mt-20 text-gray-800">
<div v-for="vehicule in vehicules" :key="vehicule.id" class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-2">
<div class="bg-secondaire rounded-2xl shadow-2xl relative mt-4">
<div class="w-full h-full">

<img :src="'/storage/' + vehicule.image1" :alt="vehicule.imageAlt"  class="w-full h-full object-fill rounded-2xl shadow-lg">

</div>
<img class="mb-3 w-[4rem] h-[4rem] rounded-full shadow-2xl absolute bottom-1/3 right-0" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">

<div class="p-4">
  <h3 class="text-lg font-semibold text-white">{{ vehicule.nom }}</h3>
  <p class="text-gray-300">{{ vehicule.affaire }}</p>

  <p class="text-gray-400"> Proposée par {{ total }} <span class="text-gray-600">Fadel</span> </p>
  <p class="text-principal text-lg">{{ vehicule.prix }}<span class="text-principal text-opacity-60"> Fcfa</span></p>
  <!-- new -->
  <div class="flex items-center space-x-4 justify-between">
                  <div class="flex flex-row space-x-1">
                    <div
                      class=" bg-green-500 shadow-md shadow- shadow-green-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                      <span    @click="navigateUpdateVenduVehicule(vehicule.id)">Vendu </span>
                    </div>

                    <div
                      class=" bg-red-500 shadow-md shadow- shadow-red-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                      <span    @click="navigateUpdateVehicule(vehicule.id)">modifier Vehicule {{ vehicule.id }}</span>
                    </div>
                  
                  </div>
                </div>
</div>
<div class="bg-green-400 rounded-sm shadow-lg shadow-green-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl flex space-x-2 flex-row">
        <span @click=" navigateToBoostVehicule(vehicule.id)" >Booster</span>
     </div>
</div>
</div>
</div>

</div>

<!-- IMMOBILLIERS -->
    <div v-show="activeTab === 'immobiliers'" class="bg-gray-100">




        <div class="immo lg:w-9/12  mx-auto text-gray-800">

<div class="flex flex-wrap justify-center mt-20">
 <div v-for="habitat  in habitats" :key="habitat.id"   class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-2">
   <div class="bg-secondaire text-center rounded-2xl shadow-2xl relative mt-4">
     <img :src=" '/storage/' + habitat.image1" :alt="habitat.imageAlt" class="w-full h-full object-fill rounded-2xl shadow-lg">

     <div class="p-4">
         <h3 class="text-lg font-semibold text-white">{{ habitat.nom }}</h3>
       <p class="text-gray-300">{{ habitat.affaire }}</p>

       <p class="text-gray-400"> Proposee par  <span class="text-gray-600">Fadel</span> </p>
       <p class="text-principal text-lg">{{ habitat.prix }}<span class="text-principal text-opacity-60"> Fcfa</span></p>
       <div class="flex items-center space-x-4 justify-between">
                  <div class="flex flex-row space-x-1">
                    <div
                      class=" bg-green-500 shadow-md shadow- shadow-green-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                      <span    @click="navigateUpdateVenduImmobilier(habitat.id)">Vendu </span>
                    </div>
                    <div
                      class=" bg-red-500 shadow-md shadow- shadow-red-600 text-white cursor-pointer px-3 py-1 text-center justify-center items-center rounded-xl flex space-x-2 flex-row">
                      <span    @click="navigateUpdateImmobilier(habitat.id)">modifier </span>
                    </div>
                    <!-- <div
                      class="text-2 bg-green-500 shadow-lg shadow- shadow-green-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl flex space-x-2 flex-row">
                      <span    @click="navigateToBoost(habitat.id)">ooster {{habitat.id}}</span>
                    </div> -->
                  </div>
                </div>
     </div>
     <!-- <div class="bg-green-400 rounded-sm shadow-lg shadow-green-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl flex space-x-2 flex-row">
        <span>Booster</span>
     </div> -->
   </div>
 </div>
</div>
</div>

      </div>
  </div>


  <!-- </div> -->
<!-- </div> -->


    </AppLayout>



</template>
<script>
import {InertiaProgress} from '@inertiajs/progress';
import {Head} from '@inertiajs/vue3'

export default {

    data () {
        return {
          activeTab: 'dashboard',
        showMenu: false,
        popupVisible: false

        }
    },
    methods: {
        showPopup() {
      this.popupVisible = true;
    },
    confirmAction() {
      // Logique à exécuter lorsque "oui" est cliqué
      this.popupVisible = false;
      // Ajoutez ici le code pour effectuer l'action
    },
    cancelAction() {
      // Logique à exécuter lorsque "non" est cliqué
      this.popupVisible = false;
    },
        navigateUpdateImmobilier(id)
        {
            this.$inertia.visit(`/update/immobilier/${id}`);
        },

        navigateUpdateVehicule(id)
        {
            this.$inertia.visit(`/update/vehicule/${id}`);
        },
        navigateToBoostImmobillier(id)
        {
            this.$inertia.visit(`/boost/immo/${id}`);
        },
        navigateToBoostVehicule(id)
        {
            this.$inertia.visit(`/boost/vehi/${id}`);
        },
        navigateUpdateVenduImmobilier(id)
        {
            this.$inertia.visit(`/update/navigateUpdateVenduImmobilier/${id}`);
        },
        navigateUpdateVenduVehicule(id)
        {
            this.$inertia.visit(`/update/navigateUpdateVenduVehicule/${id}`);
        },
    }
}

    </script>


