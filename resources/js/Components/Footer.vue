<template>
    <div class="fixed bottom-0 w-full bg-gray-900 text-white">

      <button @click="toggleFooter" class="flex   focus:outline-none my-0 py-0">
        <i v-if="isFooterExpanded" class="bi bi-caret-down-fill"></i>
        <i v-else class="bi bi-caret-up-fill"></i>
      </button>
      <div class="container mx-auto px-4">
   <div class="grid grid-cols-1 md:grid-cols-4 gap-2 text-principal">
      <div class="w-full md:w-4/4 mb-4 md:mb-0  ">
        <h2 class="text-xl  font-semibold mb-4 hover:text-white">À propos de nous</h2>
      </div>
      <div class="w-full md:w-4/4 mb-4 md:mb-0">
        <h2 class="text-xl  font-semibold mb-4 hover:text-white">Navigations</h2>

      </div>
      <div class="w-full md:w-4/4 mb-4 md:mb-0">
        <h2 class="text-xl font-semibold mb-4 hover:text-white">Contactez-nous</h2>

      </div>
      <div class="w-full md:w-4/4 mb-4 md:mb-0">
        <h2 class="text-xl  font-semibold mb-4 hover:text-white">Suivez-nous</h2>
        <!-- <ul class="list-none flex">
          <li class="mr-4"><a href="#" class="text-gray-400 text-sm hover:text-white"><i class="fab fa-facebook-f"></i></a></li>
          <li class="mr-4"><a href="#" class="text-gray-400 text-sm hover:text-white"><i class="fab fa-twitter"></i></a></li>
          <li class="mr-4"><a href="#" class="text-gray-400 text-sm hover:text-white"><i class="fab fa-instagram"></i></a></li>
          <li class="mr-4"><a href="#" class="text-gray-400 text-sm hover:text-white"><i class="fab fa-linkedin-in"></i></a></li>
        </ul> -->
    </div>
</div>
      </div>

      <div v-if="isFooterExpanded">

        <div class="container mx-auto py-1 px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      <div class="w-full md:w-4/4 mb-4 md:mb-0">
        <p class="text-gray-400 text-sm">Nous sommes une plateforme dédiée à la vente et à la location de voitures ainsi qu'à la vente et à la location immobilière.</p>
      </div>
      <div class="w-full md:w-4/4 mb-4 md:mb-0 ">
        <ul class="list-none ">
          <li><a href="#" class="text-gray-400 text-sm hover:text-white">Accueil</a></li>
          <li><a href="#" class="text-gray-400 text-sm hover:text-white">Véhicules à vendre</a></li>
          <li><a href="#" class="text-gray-400 text-sm hover:text-white">Véhicules à louer</a></li>
          <li><a href="#" class="text-gray-400 text-sm hover:text-white">Propriétés à vendre</a></li>
          <li><a href="#" class="text-gray-400 text-sm hover:text-white">Propriétés à louer</a></li>
        </ul>
      </div>
      <div class="w-full md:w-4/4 mb-4 md:mb-0">
        <ul class="list-none">
          <li><a href="#" class="text-gray-400 text-sm hover:text-white">Email : en prod</a></li>
          <li><a href="#" class="text-gray-400 text-sm hover:text-white">Téléphone : +en prod</a></li>
          <li><a href="#" class="text-gray-400 text-sm hover:text-white">Adresse : Keur Mbaye Fall, Pikine Dakar</a></li>
        </ul>
      </div>
      <div class="w-full md:w-4/4 mb-4 md:mb-0">
        <ul class="list-none flex">
          <li class="mr-4"><a href="#" class="text-gray-400 text-sm hover:text-white"><i class="fab fa-facebook-f"></i></a></li>
          <li class="mr-4"><a href="#" class="text-gray-400 text-sm hover:text-white"><i class="fab fa-twitter"></i></a></li>
          <li class="mr-4"><a href="#" class="text-gray-400 text-sm hover:text-white"><i class="fab fa-instagram"></i></a></li>
          <li class="mr-4"><a href="#" class="text-gray-400 text-sm hover:text-white"><i class="fab fa-linkedin-in"></i></a></li>
        </ul>
    </div>
</div>
</div>
<div class="w-full bg-gray-800 m-0 p-0">
    <p class="text-center text-gray-400 text-sm m-0">&copy; 2023 en prod - Tous droits réservés</p>
</div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        isFooterExpanded: false,
      };
    },
    methods: {
      toggleFooter() {
        this.isFooterExpanded = !this.isFooterExpanded;
      },
    },
  };
  </script>

