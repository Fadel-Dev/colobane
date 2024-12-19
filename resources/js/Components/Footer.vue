<template>


    <footer class="bg-gradient-to-r from-principal via-secondaire via-principal to-secondaire text-white">
        <div class="max-w-screen-xl px-4 py-10 mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- Logo and Description -->
                <div class="text-center lg:text-left">
                    <img width="100" class="m-0 p-0 mx-auto lg:mx-0 bg-gray-100 p-1"
                        :src="'/storage/slide/NoflayHub.png'" alt="Image logo">
                    <p class="mt-4 text-lg text-white max-w-xs mx-auto lg:mx-0">
                        Découvrez notre plateforme pour l'achat et la vente de biens immobiliers et de véhicules.
                        Simplifiez vos transactions avec nous.
                    </p>
                    <div class="flex mt-6 justify-center lg:justify-start space-x-4">
                        <!-- Social Icons -->
                        <a href="#" target="_blank" rel="noreferrer" class="hover:text-[#0A74DA]">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"> ... </svg>
                        </a>
                        <a href="#" target="_blank" rel="noreferrer" class="hover:text-[#0A74DA]">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"> ... </svg>
                        </a>
                        <a href="#" target="_blank" rel="noreferrer" class="hover:text-[#0A74DA]">
                            <span class="sr-only">Twitter</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"> ... </svg>
                        </a>
                        <a href="#" target="_blank" rel="noreferrer" class="hover:text-[#0A74DA]">
                            <span class="sr-only">GitHub</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"> ... </svg>
                        </a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="lg:col-span-2 grid gap-8 sm:grid-cols-2 lg:grid-cols-4 text-center lg:text-left">
                    <div>
                        <p class="font-semibold text-lg text-principal">Entreprise</p>
                        <ul class="mt-4 space-y-2 text-sm">
                            <li><a href="#" class="hover:text-gray-800">À propos de nous</a></li>
                            <li><a href="#" class="hover:text-gray-800">Carrières</a></li>
                            <li><a href="#" class="hover:text-gray-800">Presse</a></li>
                        </ul>
                    </div>

                    <div>
                        <p class="font-semibold text-lg  text-principal">Support</p>
                        <ul class="mt-4 space-y-2 text-sm">
                            <li><a href="#" class="hover:text-gray-800">Centre d'aide</a></li>
                            <li><a href="#" class="hover:text-gray-800">Sécurité</a></li>
                            <li><a href="#" class="hover:text-gray-800">Guide de la communauté</a></li>
                        </ul>
                    </div>

                    <div>
                        <p class="font-semibold text-lg  text-principal">Légal</p>
                        <ul class="mt-4 space-y-2 text-sm">
                            <li><a href="#" class="hover:text-gray-800">Conditions d'utilisation</a></li>
                            <li><a href="#" class="hover:text-gray-800">Politique de confidentialité</a></li>
                            <li><a href="#" class="hover:text-gray-800">Politique de cookies</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-sm bg-principal text-center">
                &copy; 2024 NoflayHub - Tous droits réservés.
            </div>
        </div>
    </footer>



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
