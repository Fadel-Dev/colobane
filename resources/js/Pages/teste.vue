<template>

    <div>
  <div v-for="image in images" :key="image.id">
    <img :src="image.src" @click="afficherImageEnGrand(image)">
  </div>
</div>




    <footer class="bg-gray-200">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="#" class="text-xl font-bold text-gray-500 hover:text-gray-400">Brand</a>
            <p class="py-2 text-gray-500 sm:py-0">All rights reserved</p>
        </div>
        <div v-if="imageEnGrand" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75">
  <img :src="imageEnGrand.src" class="max-h-full max-w-full">
</div>
    </footer>

  </template>

  <script>
  export default {
    data() {
      return {
        images: [
          {
            id: 1,
            src: 'https://www.izo.net/media/cache/news_detail/35144-maison-contemporaine-haute-savoie.jpg',
          },
          {
            id: 2,
            src: 'https://www.maisons-pierre.com/wp-content/uploads/2020/08/Visuel5.jpg',
          },
          {
            id: 3,
            src: 'https://www.maisons-pierre.com/wp-content/uploads/2020/08/Visuel5.jpg',
          },
        ],
        imageEnGrand: null,
        // Ajoutez d'autres données nécessaires ici
      };

    },
    methods: {
  afficherImageEnGrand(image) {
    this.imageEnGrand = image;
  },
},
  };
  </script>

  <style scoped>
  /* Ajoutez vos styles personnalisés ici en utilisant Tailwind CSS */
  </style>
