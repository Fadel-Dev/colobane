<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    maison: Object,
    habitats: Object,
    results: Object,
    total: Object,
    totalImmobilier: Object,
    totalImmobilierVendu: Object,
    resultsVendu: Object,
    totalVendu: Object,
    totalImmobilierActuel: Object,
    resultsActuel: Object,
    totalActuel: Object,
    totalVenduSomme: Object,
    sommeHabitatVendu: Object,
    restantImmobilier: Object,
    totalArticles: Object,
    totalRestant: Object,
});

const activeTab = ref('dashboard');

// Format price
const formatPrice = (price) => {
    if (!price) return '0';
    const numPrice = typeof price === 'string' ? parseFloat(price.replace(/\s/g, '')) : price;
    if (numPrice >= 1000000) {
        return (numPrice / 1000000).toFixed(1) + 'M';
    } else if (numPrice >= 1000) {
        return (numPrice / 1000).toFixed(0) + 'K';
    }
    return numPrice.toLocaleString('fr-FR');
};

// Methods
const navigateUpdateImmobilier = (id) => {
    router.visit(`/update/immobilier/${id}`);
};

const navigateToBoostImmobillier = (id) => {
    router.visit(`/boost/immo/${id}`);
};

const navigateUpdateVenduImmobilier = (id) => {
    router.visit(`/update/navigateUpdateVenduImmobilier/${id}`);
};

const navigateToDetail = (id) => {
    router.visit(`/detail/${id}`);
};
</script>

<template>
    <AppLayout title="Dashboard">
        <Head title="Dashboard" />

        <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50">
            <!-- Header Section -->
            <div class="bg-white border-b border-gray-200 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">
                                Bonjour, {{ $page.props.auth.user.name }} 👋
                            </h1>
                            <p class="text-gray-600 mt-1">Gérez vos annonces immobilières</p>
                        </div>
                        <Link
                            href="/publier"
                            class="hidden md:flex items-center space-x-2 bg-gradient-to-r from-principal to-principal-dark text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all hover:scale-105"
                        >
                            <i class="bi bi-plus-circle text-xl"></i>
                            <span>Nouvelle annonce</span>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Tab Navigation -->
                <div class="mb-8">
                    <div class="flex space-x-1 bg-gray-100 p-1 rounded-xl inline-flex">
                        <button
                            @click="activeTab = 'dashboard'"
                            :class="[
                                'px-6 py-3 rounded-lg font-semibold transition-all duration-300',
                                activeTab === 'dashboard'
                                    ? 'bg-white text-principal shadow-md'
                                    : 'text-gray-600 hover:text-gray-900'
                            ]"
                        >
                            <i class="bi bi-speedometer2 mr-2"></i>
                            Tableau de bord
                        </button>
                        <button
                            @click="activeTab = 'immobiliers'"
                            :class="[
                                'px-6 py-3 rounded-lg font-semibold transition-all duration-300',
                                activeTab === 'immobiliers'
                                    ? 'bg-white text-principal shadow-md'
                                    : 'text-gray-600 hover:text-gray-900'
                            ]"
                        >
                            <i class="bi bi-house-door mr-2"></i>
                            Mes annonces ({{ totalImmobilier || 0 }})
                        </button>
                    </div>
                </div>

                <!-- Dashboard Tab -->
                <div v-show="activeTab === 'dashboard'" class="space-y-6">
                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Total Articles Card -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <i class="bi bi-house-door text-white text-2xl"></i>
                                </div>
                                <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Total</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ total || 0 }}</h3>
                            <p class="text-sm text-gray-600">Articles publiés</p>
                        </div>

                        <!-- Vendu Card -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <i class="bi bi-check-circle text-white text-2xl"></i>
                                </div>
                                <span class="text-xs font-semibold text-green-600 bg-green-100 px-3 py-1 rounded-full">Vendu</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ totalImmobilierVendu || 0 }}</h3>
                            <p class="text-sm text-gray-600">Articles vendus</p>
                        </div>

                        <!-- En cours Card -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <i class="bi bi-clock-history text-white text-2xl"></i>
                                </div>
                                <span class="text-xs font-semibold text-yellow-600 bg-yellow-100 px-3 py-1 rounded-full">En cours</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ totalRestant || 0 }}</h3>
                            <p class="text-sm text-gray-600">En vente</p>
                        </div>

                        <!-- Chiffre d'affaire Card -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-principal to-principal-dark rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <i class="bi bi-currency-exchange text-white text-2xl"></i>
                                </div>
                                <span class="text-xs font-semibold text-principal bg-principal/10 px-3 py-1 rounded-full">CA</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900 mb-1">
                                {{ formatPrice(totalVenduSomme || 0) }}
                            </h3>
                            <p class="text-sm text-gray-600">FCFA générés</p>
                        </div>
                    </div>

                    <!-- Main Stats Cards -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Immobilier Stats Card -->
                        <div 
                            @click="activeTab = 'immobiliers'"
                            class="bg-gradient-to-br from-principal/10 via-principal/5 to-white rounded-2xl p-8 border-2 border-principal/20 shadow-xl hover:shadow-2xl transition-all duration-300 cursor-pointer group"
                        >
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Publications Immobilières</h3>
                                    <p class="text-gray-600">Gérez vos biens immobiliers</p>
                                </div>
                                <div class="w-20 h-20 bg-gradient-to-br from-principal to-principal-dark rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <i class="bi bi-house-door text-white text-4xl"></i>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-white/60 backdrop-blur-sm rounded-xl">
                                    <div class="flex items-center space-x-3">
                                        <i class="bi bi-house text-principal text-xl"></i>
                                        <span class="text-gray-700 font-medium">Total</span>
                                    </div>
                                    <span class="text-2xl font-bold text-gray-900">{{ totalImmobilier || 0 }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="p-4 bg-white/60 backdrop-blur-sm rounded-xl">
                                        <p class="text-xs text-gray-600 mb-1">Chiffre d'affaire</p>
                                        <p class="text-lg font-bold text-green-600">{{ formatPrice(sommeHabitatVendu || 0) }} FCFA</p>
                                    </div>
                                    <div class="p-4 bg-white/60 backdrop-blur-sm rounded-xl">
                                        <p class="text-xs text-gray-600 mb-1">Vendu</p>
                                        <p class="text-lg font-bold text-gray-900">{{ totalImmobilierVendu || 0 }}</p>
                                    </div>
                                </div>
                                <div class="p-4 bg-white/60 backdrop-blur-sm rounded-xl">
                                    <p class="text-xs text-gray-600 mb-1">Restant</p>
                                    <p class="text-lg font-bold text-gray-900">{{ restantImmobilier || 0 }}</p>
                                </div>
                            </div>
                            <div class="mt-6 pt-6 border-t border-principal/20">
                                <span class="text-principal font-semibold flex items-center group-hover:translate-x-2 transition-transform">
                                    Voir les articles
                                    <i class="bi bi-arrow-right ml-2"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Overview Card -->
                        <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-xl">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Vue d'ensemble</h3>
                            <div class="space-y-6">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-600">Total Articles</span>
                                        <span class="text-lg font-bold text-gray-900">{{ total || 0 }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-600">Vendus</span>
                                        <span class="text-lg font-bold text-green-600">{{ totalVendu || 0 }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div 
                                            class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full transition-all duration-500"
                                            :style="`width: ${total && total > 0 ? (totalVendu / total * 100) : 0}%`"
                                        ></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-600">En vente</span>
                                        <span class="text-lg font-bold text-yellow-600">{{ totalRestant || 0 }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div 
                                            class="bg-gradient-to-r from-yellow-500 to-yellow-600 h-2 rounded-full transition-all duration-500"
                                            :style="`width: ${total && total > 0 ? (totalRestant / total * 100) : 0}%`"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <div class="text-center">
                                    <p class="text-3xl font-bold bg-gradient-to-r from-principal to-principal-dark bg-clip-text text-transparent">
                                        {{ formatPrice(totalVenduSomme || 0) }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1">Chiffre d'affaire total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Immobiliers Tab -->
                <div v-show="activeTab === 'immobiliers'" class="space-y-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Mes annonces</h2>
                            <p class="text-gray-600 mt-1">{{ totalImmobilier || 0 }} annonce{{ (totalImmobilier || 0) > 1 ? 's' : '' }}</p>
                        </div>
                        <Link
                            href="/publier"
                            class="flex items-center space-x-2 bg-gradient-to-r from-principal to-principal-dark text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all hover:scale-105"
                        >
                            <i class="bi bi-plus-circle text-xl"></i>
                            <span>Nouvelle annonce</span>
                        </Link>
                    </div>

                    <!-- Properties Grid -->
                    <div v-if="habitats && habitats.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <div
                            v-for="habitat in habitats"
                            :key="habitat.id"
                            class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200 group"
                        >
                            <!-- Image -->
                            <div class="relative aspect-video overflow-hidden bg-gray-100">
                                <img 
                                    :src="'/storage/' + habitat.image1" 
                                    :alt="habitat.nom"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                    @click="navigateToDetail(habitat.id)"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <!-- Status Badge -->
                                <div class="absolute top-3 left-3">
                                    <span 
                                        :class="[
                                            'px-3 py-1 rounded-full text-xs font-bold',
                                            habitat.status === 'accepter' 
                                                ? 'bg-green-500 text-white' 
                                                : habitat.status === 'pending' 
                                                    ? 'bg-yellow-500 text-white' 
                                                    : 'bg-gray-500 text-white'
                                        ]"
                                    >
                                        {{ habitat.status === 'accepter' ? 'Disponible' : habitat.status === 'pending' ? 'En attente' : habitat.status }}
                                    </span>
                                </div>

                                <!-- Boost Badge -->
                                <div v-if="habitat.booster" class="absolute top-3 right-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-400 to-yellow-500 text-white shadow-lg">
                                        <i class="bi bi-lightning-fill mr-1"></i>
                                        Boost
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5">
                                <h3 
                                    @click="navigateToDetail(habitat.id)"
                                    class="font-bold text-gray-900 mb-2 line-clamp-1 cursor-pointer hover:text-principal transition-colors"
                                >
                                    {{ habitat.nom }}
                                </h3>
                                <p class="text-principal font-bold text-lg mb-3">
                                    {{ formatPrice(habitat.prix) }} <span class="text-sm text-gray-600 font-normal">FCFA</span>
                                </p>
                                <div class="flex items-center text-sm text-gray-600 mb-4">
                                    <i class="bi bi-geo-alt text-principal mr-1"></i>
                                    {{ habitat.region }}
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-200">
                                    <button
                                        @click="navigateUpdateImmobilier(habitat.id)"
                                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-semibold transition-all hover:scale-105 flex items-center justify-center space-x-1"
                                    >
                                        <i class="bi bi-pencil"></i>
                                        <span class="hidden sm:inline">Modifier</span>
                                    </button>
                                    <button
                                        @click="navigateUpdateVenduImmobilier(habitat.id)"
                                        class="flex-1 bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-sm font-semibold transition-all hover:scale-105 flex items-center justify-center space-x-1"
                                    >
                                        <i class="bi bi-check-circle"></i>
                                        <span class="hidden sm:inline">Vendu</span>
                                    </button>
                                    <button
                                        @click="navigateToBoostImmobillier(habitat.id)"
                                        :class="[
                                            'flex-1 px-3 py-2 rounded-lg text-sm font-semibold transition-all hover:scale-105 flex items-center justify-center space-x-1',
                                            habitat.status === 'accepter'
                                                ? 'bg-yellow-500 hover:bg-yellow-600 text-white'
                                                : 'bg-gray-500 hover:bg-gray-600 text-white'
                                        ]"
                                    >
                                        <i class="bi bi-lightning-fill"></i>
                                        <span class="hidden sm:inline">{{ habitat.status === 'accepter' ? 'Boost' : 'Booster' }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div v-else class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="bi bi-house-door text-gray-400 text-5xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Aucune annonce</h3>
                        <p class="text-gray-600 mb-6">Commencez par créer votre première annonce</p>
                        <Link
                            href="/publier"
                            class="inline-flex items-center space-x-2 bg-gradient-to-r from-principal to-principal-dark text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all hover:scale-105"
                        >
                            <i class="bi bi-plus-circle text-xl"></i>
                            <span>Créer une annonce</span>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
