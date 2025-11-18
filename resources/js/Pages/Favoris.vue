<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Footer from '../Components/Footer.vue';
import Navbar from '../Components/Navbar.vue';
import { ref, computed } from 'vue';

const props = defineProps({
    favoris: Object,
});

// Fonction helper pour obtenir l'URL complète d'une image
const getImageUrl = (imagePath) => {
    if (!imagePath || imagePath === 'null' || imagePath === '') {
        return 'https://via.placeholder.com/800x600?text=Image+non+disponible';
    }
    
    if (imagePath.startsWith('http://') || imagePath.startsWith('https://')) {
        return imagePath;
    }
    
    if (imagePath.startsWith('storage/') || imagePath.startsWith('/storage/')) {
        return imagePath.startsWith('/') ? imagePath : '/' + imagePath;
    }
    
    return '/storage/' + imagePath;
};

// Fonction pour obtenir la première image disponible
const getFirstAvailableImage = (immobilier) => {
    if (immobilier.image1 && immobilier.image1 !== '') return getImageUrl(immobilier.image1);
    if (immobilier.image2 && immobilier.image2 !== '') return getImageUrl(immobilier.image2);
    if (immobilier.image3 && immobilier.image3 !== '') return getImageUrl(immobilier.image3);
    
    // Vérifier le champ JSON images
    if (immobilier.images) {
        let jsonImages = [];
        if (Array.isArray(immobilier.images)) {
            jsonImages = immobilier.images;
        } else if (typeof immobilier.images === 'string') {
            try {
                jsonImages = JSON.parse(immobilier.images);
            } catch (e) {
                jsonImages = [];
            }
        }
        if (jsonImages.length > 0 && jsonImages[0]) {
            return getImageUrl(jsonImages[0]);
        }
    }
    
    return 'https://via.placeholder.com/800x600?text=Image+non+disponible';
};

const formatPrice = (price) => {
    if (!price) return '0';
    const numPrice = typeof price === 'string' ? parseFloat(price.replace(/\s/g, '')) : price;
    return numPrice.toLocaleString('fr-FR', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
};

const navigateToDetail = (id) => {
    router.visit(`/detail/${id}`);
};

const removeFavorite = (id) => {
    router.delete(`/favoris/remove/${id}`, {
        preserveScroll: true,
        onSuccess: () => {
            // Le composant sera mis à jour automatiquement par Inertia
        }
    });
};
</script>

<template>
    <AppLayout title="Mes Favoris">
        <Head title="Mes Favoris" />
        <Navbar />

        <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2 flex items-center">
                        <i class="bi bi-heart-fill text-principal mr-3"></i>
                        Mes Favoris
                    </h1>
                    <p class="text-gray-600">
                        Retrouvez tous vos biens immobiliers favoris
                    </p>
                </div>

                <!-- Liste des favoris -->
                <div v-if="favoris.data && favoris.data.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <div
                        v-for="favori in favoris.data"
                        :key="favori.id"
                        class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden group"
                    >
                        <!-- Image -->
                        <div class="relative aspect-square overflow-hidden bg-gray-200 cursor-pointer" @click="navigateToDetail(favori.immobilier.id)">
                            <img
                                :src="getFirstAvailableImage(favori.immobilier)"
                                :alt="favori.immobilier.nom"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            />
                            <!-- Badge Favori -->
                            <div class="absolute top-4 right-4 z-10">
                                <button
                                    @click.stop="removeFavorite(favori.immobilier.id)"
                                    class="bg-white rounded-full p-2 shadow-lg hover:bg-red-50 transition-colors"
                                    aria-label="Retirer des favoris"
                                >
                                    <i class="bi bi-heart-fill text-red-500 text-xl"></i>
                                </button>
                            </div>
                            <!-- Badge Type -->
                            <div class="absolute top-4 left-4 z-10">
                                <span class="bg-principal text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ favori.immobilier.type }}
                                </span>
                            </div>
                        </div>

                        <!-- Contenu -->
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 cursor-pointer" @click="navigateToDetail(favori.immobilier.id)">
                                {{ favori.immobilier.nom }}
                            </h3>
                            
                            <div class="flex items-center text-sm text-gray-600 mb-3">
                                <i class="bi bi-geo-alt-fill text-principal mr-2"></i>
                                <span>{{ favori.immobilier.region }}, Sénégal</span>
                            </div>

                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-2xl font-bold text-principal">
                                        {{ formatPrice(favori.immobilier.prix) }}
                                    </p>
                                    <p class="text-xs text-gray-500">FCFA</p>
                                </div>
                                <div v-if="favori.immobilier.npiece" class="text-right">
                                    <p class="text-sm font-semibold text-gray-700">
                                        {{ favori.immobilier.npiece }} pièces
                                    </p>
                                </div>
                            </div>

                            <button
                                @click="navigateToDetail(favori.immobilier.id)"
                                class="w-full bg-principal text-white py-2 px-4 rounded-xl font-semibold hover:bg-principal-dark transition-colors duration-300"
                            >
                                Voir les détails
                            </button>
                        </div>
                    </div>
                </div>

                <!-- État vide -->
                <div v-else class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="bi bi-heart text-6xl text-gray-300 mb-4"></i>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">
                            Aucun favori pour le moment
                        </h2>
                        <p class="text-gray-600 mb-6">
                            Commencez à ajouter des biens à vos favoris en cliquant sur l'icône cœur
                        </p>
                        <Link
                            href="/"
                            class="inline-flex items-center px-6 py-3 bg-principal text-white rounded-xl font-semibold hover:bg-principal-dark transition-colors duration-300"
                        >
                            <i class="bi bi-house-door mr-2"></i>
                            Parcourir les annonces
                        </Link>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="favoris.data && favoris.data.length > 0 && favoris.links" class="mt-8 flex justify-center">
                    <div class="flex space-x-2">
                        <Link
                            v-for="(link, index) in favoris.links"
                            :key="index"
                            :href="link.url || '#'"
                            :class="[
                                'px-4 py-2 rounded-lg font-semibold transition-colors',
                                link.active
                                    ? 'bg-principal text-white'
                                    : 'bg-white text-gray-700 hover:bg-gray-100',
                                !link.url ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'
                            ]"
                            v-html="link.label"
                        ></Link>
                    </div>
                </div>
            </div>
        </div>

        <Footer />
    </AppLayout>
</template>

