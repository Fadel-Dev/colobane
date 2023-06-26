<template>
    <div class="flex items-center justify-center w-1/3">
      <div class="flex space-x-4  w-1/3">
        <div class="flex items-center space-x-2">
          <button @click="scrollLeft" class="p-2 rounded-md bg-gray-200">
            <i class="bi bi-chevron-left"></i>
          </button>
          <div class="flex space-x-2 overflow-hidden">
            <div v-for="item in items" :key="item" class="flex items-center justify-center w-32 h-12 rounded-md bg-gray-200">
              <i class="bi bi-{{ item.icon }}"></i>
              <span>{{ item.label }}</span>
            </div>
          </div>
          <button @click="scrollRight" class="p-2 rounded-md bg-gray-200">
            <i class="bi bi-chevron-right"></i>
          </button>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        items: [
          { label: "Verger", icon: "tree" },
          { label: "Ferme", icon: "house" },
          { label: "Terrain", icon: "map" },
          { label: "Chambre", icon: "bed" },
          { label: "Appartement", icon: "building" },
          { label: "Villa", icon: "house-fill" },
          { label: "Immeuble", icon: "building-fill" },
        ],
        scrollPosition: 0,
      };
    },
    methods: {
      scrollLeft() {
        if (this.scrollPosition > 0) {
          this.scrollPosition -= 1;
        }
      },
      scrollRight() {
        if (this.scrollPosition < this.items.length - 1) {
          this.scrollPosition += 1;
        }
      },
    },
  };
  </script>

  <style>
  /* Ajoutez les classes Tailwind CSS appropriées selon vos besoins */
  </style>
