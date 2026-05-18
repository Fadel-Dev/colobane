<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Footer from '../Components/Footer.vue';
import Navbar from '../Components/Navbar.vue';
import SeoHead from '../Components/SeoHead.vue';
import { ref, computed } from 'vue';

const props = defineProps({
    voiture: Object,
    user: Object,
    nameSeler: String,
    mailSeler: String,
    phoneSeler: String,
    suggestions: Array,
    urlActuelle: String,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const encodeUrlActuelle = computed(() => encodeURIComponent(props.urlActuelle));

// State
const currentIndex = ref(0);
const afficherPopup = ref(false);

const images = computed(() => [
    props.voiture.image1,
    props.voiture.image2,
    props.voiture.image3,
].filter(img => img && img !== ''));

const currentImage = computed(() => images.value[currentIndex.value] || images.value[0]);

// Methods
const previousImage = () => {
    if (currentIndex.value > 0) {
        currentIndex.value--;
    }
};

const nextImage = () => {
    if (currentIndex.value < images.value.length - 1) {
        currentIndex.value++;
    }
};

const afficherNumero = () => {
    afficherPopup.value = true;
};

const fermerPopup = () => {
    afficherPopup.value = false;
};

const ouvrirWhatsApp = () => {
    const numeroContact = `${props.phoneSeler}`;
    const messageText = `Bonjour, je suis intéressé par votre annonce : ${props.voiture.nom}. ${props.urlActuelle}`;
    const lienWhatsApp = `https://wa.me/${numeroContact}?text=${encodeURIComponent(messageText)}`;
    window.open(lienWhatsApp, "_blank");
};

const formatPrice = (price) => {
    if (!price) return '0';
    return parseFloat(price).toLocaleString('fr-FR');
};

const ogImage = computed(() => {
    if (images.value.length > 0) {
        return window.location.origin + '/storage/' + images.value[0];
    }
    return window.location.origin + '/storage/slide/NoflayHub1.svg';
});

const structuredData = computed(() => {
    return {
        '@context': 'https://schema.org',
        '@type': 'Product',
        'name': props.voiture.nom,
        'description': props.voiture.description || `${props.voiture.marque} ${props.voiture.model} à ${props.voiture.affaire} au Sénégal`,
        'image': [ogImage.value],
        'offers': {
            '@type': 'Offer',
            'price': props.voiture.prix || '0',
            'priceCurrency': 'XOF',
            'availability': 'https://schema.org/InStock',
            'url': props.urlActuelle
        },
        'brand': {
            '@type': 'Brand',
            'name': props.voiture.marque
        }
    };
});
</script>

<template>
    <SeoHead 
        :title="`${voiture.nom} - ${voiture.marque} ${voiture.model} au Sénégal | NoflayHub`"
        :description="`Découvrez cette ${voiture.marque} ${voiture.model} à ${voiture.prix} FCFA sur NoflayHub. ${voiture.description ? voiture.description.substring(0, 150) : ''}...`"
        :keywords="`${voiture.marque} ${voiture.model}, voiture occasion Sénégal, location voiture Dakar, ${voiture.nom}, noflayhub`"
        :og-type="'product'"
        :og-image="ogImage"
        :structured-data="structuredData"
    />

    <header>
        <Navbar />
    </header>

    <main class="my-6 lg:pl-[10%] flex justify-center">
        <div class="container mx-auto">
            <div class="md:flex md:items-center">
                <div class="rounded-sm sm:w-[40rem] sm:h-[22rem] sm:flex items-center sm:justify-center sm:bg-gray-200 relative my-0 sm:mx-0 bg-gray-300">
                    <!-- img main -->
                    <i v-if="images.length > 1" class="p-2 bg-gray-400 text-3xl rounded text-gray-900 bi bi-chevron-left absolute top-1/2 left-11 cursor-pointer z-10"
                        @click="previousImage">
                    </i>

                    <div class="w-full h-full flex items-center justify-center border">
                        <img class="flex max-w-full max-h-full items-center justify-center object-contain"
                            :src="'/storage/' + currentImage" :alt="voiture.nom">
                    </div>

                    <i v-if="images.length > 1" class="p-2 text-4xl bg-gray-400 text-gray-900 rounded bi bi-chevron-right absolute top-1/2 right-11 cursor-pointer z-10"
                        @click="nextImage">
                    </i>
                </div>

                <!-- share the current post to facebook -->
                <div class="md:flex md:items-center ml-4">
                    <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + encodeUrlActuelle"
                        target="_blank"
                        class="text-white bg-principal hover:bg-secondaire focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 mb-2">
                        <i class="bi bi-facebook text-2xl mr-2"></i>
                        Partager
                    </a>
                </div>

                <div class="max-w-lg sm:mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2 mx-auto w-11/12 rounded-2xl md:bg-secondaire p-8">
                    <div class="head flex items-center">
                        <img class="mb-3 w-[4rem] h-[4rem] rounded-full shadow-2xl mr-4"
                            src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Vendeur">
                        <span class="text-gray-400">Proposé par <span class="text-gray-300 font-bold uppercase">{{ nameSeler }}</span></span>
                    </div>
                    <hr class="my-3 border-gray-600">

                    <div class="flex flex-col hidden md:flex">
                        <button class="w-full h-12 bg-principal text-white font-medium rounded-md mb-2 hover:bg-principal/90 transition-colors"
                            @click="ouvrirWhatsApp">
                            Contacter par WhatsApp
                        </button>

                        <div>
                            <button
                                class="w-full h-12 border-2 border-principal hover:bg-principal hover:text-white text-white font-medium rounded-md transition-all"
                                @click="afficherNumero">
                                Voir le numéro
                            </button>
                            <div v-if="afficherPopup"
                                class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-800 bg-opacity-75 p-4">
                                <div class="bg-white rounded-lg p-8 max-w-md relative">
                                    <span class="text-2xl font-bold text-principal mb-4 block">
                                        Conseil de sécurité
                                    </span>
                                    <p class="text-gray-700 mb-6">
                                        Soyez prudents face aux demandes de paiement anticipé avant d'avoir reçu le produit ou visité la propriété. Les vendeurs légitimes seront compréhensifs envers vos préoccupations.
                                    </p>
                                    <div class="bg-gray-100 p-4 rounded-lg text-center">
                                        <span class="text-gray-500 block mb-1">Numéro du vendeur :</span>
                                        <span class="text-2xl font-bold text-secondaire">{{ phoneSeler }}</span>
                                    </div>
                                    <button @click="fermerPopup"
                                        class="absolute top-2 right-2 text-2xl text-gray-400 hover:text-principal">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vehicle Details Section -->
            <div class="mt-8 px-4">
                <h1 class="text-secondaire uppercase text-3xl font-bold mb-2">{{ voiture.nom }}</h1>
                <div class="flex items-baseline gap-2 mb-4">
                    <span class="text-gray-500 text-lg">Prix :</span>
                    <span class="text-principal text-3xl font-bold">{{ formatPrice(voiture.prix) }} FCFA</span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <!-- Technical Specs -->
                    <div class="flex items-center gap-3">
                        <i class="bi bi-tag text-2xl text-principal"></i>
                        <div>
                            <span class="text-gray-500 block text-xs uppercase font-bold">Marque</span>
                            <span class="font-semibold text-gray-800">{{ voiture.marque }}</span>
                        </div>
                    </div>
                    
                    <div v-if="voiture.model" class="flex items-center gap-3">
                        <i class="bi bi-info-circle text-2xl text-principal"></i>
                        <div>
                            <span class="text-gray-500 block text-xs uppercase font-bold">Modèle</span>
                            <span class="font-semibold text-gray-800">{{ voiture.model }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <i class="bi bi-gear text-2xl text-principal"></i>
                        <div>
                            <span class="text-gray-500 block text-xs uppercase font-bold">Transmission</span>
                            <span class="font-semibold text-gray-800">{{ voiture.boiteVitesse }}</span>
                        </div>
                    </div>

                    <div v-if="voiture.kilometrage" class="flex items-center gap-3">
                        <i class="bi bi-speedometer2 text-2xl text-principal"></i>
                        <div>
                            <span class="text-gray-500 block text-xs uppercase font-bold">Kilométrage</span>
                            <span class="font-semibold text-gray-800">{{ voiture.kilometrage }} Km</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <i class="bi bi-fuel-pump text-2xl text-principal"></i>
                        <div>
                            <span class="text-gray-500 block text-xs uppercase font-bold">Carburant</span>
                            <span class="font-semibold text-gray-800">{{ voiture.carburant }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <i class="bi bi-people text-2xl text-principal"></i>
                        <div>
                            <span class="text-gray-500 block text-xs uppercase font-bold">Places</span>
                            <span class="font-semibold text-gray-800">{{ voiture.place }}</span>
                        </div>
                    </div>

                    <div v-if="voiture.annee" class="flex items-center gap-3">
                        <i class="bi bi-calendar-event text-2xl text-principal"></i>
                        <div>
                            <span class="text-gray-500 block text-xs uppercase font-bold">Année</span>
                            <span class="font-semibold text-gray-800">{{ voiture.annee }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <i class="bi bi-shield-check text-2xl text-principal"></i>
                        <div>
                            <span class="text-gray-500 block text-xs uppercase font-bold">État</span>
                            <span class="font-semibold text-gray-800">{{ voiture.etat }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <i class="bi bi-hand-thumbs-up text-2xl text-principal"></i>
                        <div>
                            <span class="text-gray-500 block text-xs uppercase font-bold">Type d'affaire</span>
                            <span class="font-semibold text-gray-800 capitalize">{{ voiture.affaire }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-xl font-bold text-secondaire mb-3">Description</h3>
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ voiture.description }}</p>
                    </div>
                </div>
            </div>

            <!-- Suggestions -->
            <div class="mt-12 px-4 pb-12">
                <h2 class="text-2xl font-bold mb-6 text-secondaire flex items-center gap-2">
                    <i class="bi bi-grid-3x3-gap-fill text-principal"></i>
                    Annonces similaires
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <div v-for="suggestion in suggestions" :key="suggestion.id" 
                        class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all border border-gray-100 cursor-pointer"
                        @click="router.visit('/detailVehi/' + suggestion.id)">
                        <div class="aspect-video overflow-hidden">
                            <img :src="'/storage/' + suggestion.image1" :alt="suggestion.nom" 
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 truncate mb-1">{{ suggestion.nom }}</h3>
                            <p class="text-principal font-bold">{{ formatPrice(suggestion.prix) }} FCFA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <Footer />
</template>

<style scoped>
.container {
    max-width: 1280px;
}
</style>
