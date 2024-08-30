<template>
    <div class="bg-secondaire text-white py-6">
        <div class="w-full md:w-1/4 md:px-4 mb-4 md:mb-0">
            <button @click="toggleAllSections"
                class="flex items-center  p-2 w-full focus:outline-none text-left text-principal">
                <!-- <h2 class="text-xl font-semibold">Toggle All Sections</h2> -->
                <i :class="allExpanded ? 'bi bi-caret-up-fill' : 'bi bi-caret-down-fill'"></i>
                <span>{{ allExpanded ? 'Plier' : ' Deplier' }}</span>

            </button>
        </div>
        <div class="container mx-auto px-4 md:flex md:justify-between">
            <!-- <div class="w-full md:w-1/4 md:px-4 mb-4 md:mb-0">
        <button
          @click="toggleAllSections"
          class="flex items-center justify-between p-2 w-full focus:outline-none text-left bg-gray-800 rounded-lg mb-4"
        >
          <h2 class="text-xl font-semibold">Toggle All Sections</h2>
          <i :class="allExpanded ? 'bi bi-caret-up-fill' : 'bi bi-caret-down-fill'"></i>
        </button>
      </div> -->
            <div v-for="(section, index) in footerSections" :key="index" class="w-full md:w-1/4 md:px-4 mb-4 md:mb-0">
                <button @click="toggleSection(index)"
                    class="flex items-center justify-between p-2 w-full focus:outline-none text-left bg-gray-800 rounded-lg">
                    <h2 class="text-xl font-semibold">{{ section.title }}</h2>
                    <!-- <i :class="section.isExpanded ? 'bi bi-caret-up-fill' : 'bi bi-caret-down-fill'"></i> -->
                </button>
                <div v-if="section.isExpanded" class="p-4 bg-gray-700 rounded-lg">
                    <p class="text-gray-300 text-sm whitespace-pre-line">{{ section.content }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 p-4 text-center mt-6">
            <p class="text-gray-400 text-sm">&copy; 2023 Noflay - Tous droits réservés</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            allExpanded: false,
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
            this.allExpanded = !this.allExpanded;
            this.footerSections.forEach(section => {
                section.isExpanded = this.allExpanded;
            });
        },
        toggleAllSections() {
            this.allExpanded = !this.allExpanded;
            this.footerSections.forEach(section => {
                section.isExpanded = this.allExpanded;
            });
        },
    },
};
</script>

<style>
.bg-secondaire {
    background-color: #2D3748;
    /* Replace with your secondary color */
}
</style>
