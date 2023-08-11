<template>
    <div class="bg-gray-900 text-white">

      <div class="container mx-auto px-4 md:flex md:justify-between">
        <div v-for="(section, index) in footerSections" :key="index" class="md:w-1/4 md:px-4">
          <button @click="toggleSection(index)" class="flex items-center justify-between p-2 focus:outline-none">
            <h2 class="text-xl font-semibold">{{ section.title }}</h2>
            <i :class="section.isExpanded ? 'bi bi-caret-up-fill' : 'bi bi-caret-down-fill'"></i>
          </button>
          <div v-if="section.isExpanded" class="p-4">
            <p class="text-gray-400 text-sm">{{ section.content }}</p>
          </div>
        </div>
      </div>

      <div class="bg-gray-800 p-2 text-center">
        <p class="text-gray-400 text-sm">&copy; 2023 en prod - Tous droits réservés</p>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        footerSections: [
          {
            title: "À propos de nous",
            content: "Nous sommes une plateforme dédiée à la vente et à la location de voitures ainsi qu'à la vente et à la location immobilière.",
            isExpanded: false,
          },
          {
            title: "Navigations",
            content: "Accueil\nVéhicules à vendre\nVéhicules à louer\nPropriétés à vendre\nPropriétés à louer",
            isExpanded: false,
          },
          {
            title: "Contactez-nous",
            content: "Email : en prod\nTéléphone : +en prod\nAdresse : Keur Mbaye Fall, Pikine Dakar",
            isExpanded: false,
          },
          {
            title: "Suivez-nous",
            content: "Liens vers les réseaux sociaux",
            isExpanded: false,
          },
        ],
      };
    },
    methods: {
      toggleSection(index) {
        this.footerSections.forEach((section, i) => {
          if (i === index) {
            section.isExpanded = !section.isExpanded;
          } else {
            section.isExpanded = false;
          }
        });
      },
    },
  };
  </script>
