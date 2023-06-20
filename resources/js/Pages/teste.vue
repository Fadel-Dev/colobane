<template>
    <div class="flex flex-wrap justify-center">
      <div v-for="(carte, index) in cartes" :key="index" class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-4">
        <div class="bg-white rounded-lg shadow-lg">
          <img :src="carte.image" alt="Image de la carte" class="w-full h-48 object-cover rounded-t-lg">
          <div class="p-4">
            <h3 class="text-xl font-semibold">{{ carte.prix }}</h3>
            <p class="text-gray-500">{{ carte.localite }}</p>
            <p class="text-gray-500">{{ carte.utilisateur }}</p>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        cartes: [
          {
            image: 'https://www.izo.net/media/cache/news_detail/35144-maison-contemporaine-haute-savoie.jpg',
            prix: '1000€',
            localite: 'Paris, France',
            utilisateur: 'John Doe'
          },
          {
            image: 'https://www.izo.net/media/cache/picture_content_block_boxed/2022/01/2595-architecture-contemporaine.jpg',
            prix: '1500€',
            localite: 'Londres, Royaume-Uni',
            utilisateur: 'Jane Smith'
          }
          ,
          {
            image: 'https://www.izo.net/media/cache/picture_content_block_boxed/2022/01/2595-architecture-contemporaine.jpg',
            prix: '1500€',
            localite: 'Londres, Royaume-Uni',
            utilisateur: 'Jane Smith'
          },
          {
            image: 'https://www.izo.net/media/cache/picture_content_block_boxed/2022/01/2595-architecture-contemporaine.jpg',
            prix: '1500€',
            localite: 'Londres, Royaume-Uni',
            utilisateur: 'Jane Smith'
          },
          {
            image: 'https://www.izo.net/media/cache/picture_content_block_boxed/2022/01/2595-architecture-contemporaine.jpg',
            prix: '1500€',
            localite: 'Londres, Royaume-Uni',
            utilisateur: 'Jane Smith'
          },
          {
            image: 'https://www.izo.net/media/cache/picture_content_block_boxed/2022/01/2595-architecture-contemporaine.jpg',
            prix: '1500€',
            localite: 'Londres, Royaume-Uni',
            utilisateur: 'Jane Smith'
          },
          // Ajoutez les autres cartes ici...
        ]
      };
    }
  };
  </script>

  <style>
  /* Styles personnalisés si nécessaire */
  </style>


