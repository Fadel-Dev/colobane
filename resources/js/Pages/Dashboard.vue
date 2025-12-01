<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
import SeoHead from '@/Components/SeoHead.vue';

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
const isLoading = ref(false);

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

// Computed pour les pourcentages
const venduPercentage = computed(() => {
    if (!props.total || props.total === 0) return 0;
    return Math.round((props.totalVendu / props.total) * 100);
});

const enVentePercentage = computed(() => {
    if (!props.total || props.total === 0) return 0;
    return Math.round((props.totalRestant / props.total) * 100);
});

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

const getImageUrl = (image) => {
    if (!image) return '/storage/default-placeholder.png';
    if (image.startsWith('http')) return image;
    return `/storage/${image}`;
};

onMounted(() => {
    // Animation d'entrée
    isLoading.value = true;
    setTimeout(() => {
        isLoading.value = false;
    }, 500);
});
</script>

<template>
    <AppLayout title="Dashboard">
        <SeoHead 
            title="Tableau de bord - NoflayHub"
            description="Gérez vos annonces immobilières, suivez vos statistiques et boostez vos publications sur NoflayHub."
        />

        <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50">
            <!-- Header Section Premium -->
            <div class="relative bg-gradient-to-r from-principal via-principal/95 to-secondaire overflow-hidden">
                <!-- Pattern décoratif -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
                </div>
                
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-1">
                                        Bonjour, {{ $page.props.auth.user.name }} 👋
                                    </h1>
                                    <p class="text-white/90 text-sm md:text-base">Bienvenue sur votre tableau de bord</p>
                                </div>
                            </div>
                        </div>
                        <Link
                            href="/publier"
                            class="group flex items-center space-x-3 bg-white text-principal px-6 py-3.5 rounded-xl font-semibold shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 transform"
                        >
                            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Nouvelle annonce</span>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Tab Navigation Premium -->
                <div class="mb-8">
                    <div class="inline-flex bg-white p-1.5 rounded-2xl shadow-lg border border-gray-200">
                        <button
                            @click="activeTab = 'dashboard'"
                            :class="[
                                'px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center space-x-2',
                                activeTab === 'dashboard'
                                    ? 'bg-gradient-to-r from-principal to-principal/90 text-white shadow-lg scale-105'
                                    : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span>Tableau de bord</span>
                        </button>
                        <button
                            @click="activeTab = 'immobiliers'"
                            :class="[
                                'px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center space-x-2',
                                activeTab === 'immobiliers'
                                    ? 'bg-gradient-to-r from-principal to-principal/90 text-white shadow-lg scale-105'
                                    : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'
                            ]"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span>Mes annonces</span>
                            <span class="ml-2 px-2 py-0.5 bg-principal/20 text-principal rounded-full text-xs font-bold">
                                {{ totalImmobilier || 0 }}
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Dashboard Tab -->
                <Transition
                    enter-active-class="transition ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0"
                    leave-to-class="opacity-0 translate-y-4"
                >
                    <div v-show="activeTab === 'dashboard'" class="space-y-8">
                        <!-- Statistics Cards Premium -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Total Articles Card -->
                            <div class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full -mr-16 -mt-16 blur-2xl group-hover:bg-blue-500/20 transition-colors"></div>
                                <div class="relative">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-full">Total</span>
                                    </div>
                                    <h3 class="text-4xl font-bold text-gray-900 mb-1">{{ total || 0 }}</h3>
                                    <p class="text-sm text-gray-600 font-medium">Articles publiés</p>
                                </div>
                            </div>

                            <!-- Vendu Card -->
                            <div class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/10 rounded-full -mr-16 -mt-16 blur-2xl group-hover:bg-green-500/20 transition-colors"></div>
                                <div class="relative">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-bold text-green-600 bg-green-50 px-3 py-1.5 rounded-full">Vendu</span>
                                    </div>
                                    <h3 class="text-4xl font-bold text-gray-900 mb-1">{{ totalImmobilierVendu || 0 }}</h3>
                                    <p class="text-sm text-gray-600 font-medium">Articles vendus</p>
                                </div>
                            </div>

                            <!-- En cours Card -->
                            <div class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-500/10 rounded-full -mr-16 -mt-16 blur-2xl group-hover:bg-yellow-500/20 transition-colors"></div>
                                <div class="relative">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-bold text-yellow-600 bg-yellow-50 px-3 py-1.5 rounded-full">En cours</span>
                                    </div>
                                    <h3 class="text-4xl font-bold text-gray-900 mb-1">{{ totalRestant || 0 }}</h3>
                                    <p class="text-sm text-gray-600 font-medium">En vente</p>
                                </div>
                            </div>

                            <!-- Chiffre d'affaire Card -->
                            <div class="group relative bg-gradient-to-br from-principal to-principal/90 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-principal/20 overflow-hidden">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-white/20 rounded-full -mr-16 -mt-16 blur-2xl"></div>
                                <div class="relative">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-bold text-white/90 bg-white/20 px-3 py-1.5 rounded-full">CA</span>
                                    </div>
                                    <h3 class="text-4xl font-bold text-white mb-1">
                                        {{ formatPrice(totalVenduSomme || 0) }}
                                    </h3>
                                    <p class="text-sm text-white/90 font-medium">FCFA générés</p>
                                </div>
                            </div>
                        </div>

                        <!-- Main Stats Cards -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Immobilier Stats Card Premium -->
                            <div 
                                @click="activeTab = 'immobiliers'"
                                class="group relative bg-white rounded-2xl p-8 border-2 border-principal/20 shadow-xl hover:shadow-2xl transition-all duration-500 cursor-pointer overflow-hidden"
                            >
                                <div class="absolute inset-0 bg-gradient-to-br from-principal/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="relative">
                                    <div class="flex items-center justify-between mb-6">
                                        <div>
                                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Publications Immobilières</h3>
                                            <p class="text-gray-600">Gérez vos biens immobiliers</p>
                                        </div>
                                        <div class="w-20 h-20 bg-gradient-to-br from-principal to-principal/90 rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-principal/10 to-principal/5 rounded-xl border border-principal/20">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-principal/20 rounded-lg flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-principal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                    </svg>
                                                </div>
                                                <span class="text-gray-700 font-semibold">Total</span>
                                            </div>
                                            <span class="text-3xl font-bold text-gray-900">{{ totalImmobilier || 0 }}</span>
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="p-4 bg-green-50 rounded-xl border border-green-200">
                                                <p class="text-xs text-green-700 font-semibold mb-1">Chiffre d'affaire</p>
                                                <p class="text-xl font-bold text-green-600">{{ formatPrice(sommeHabitatVendu || 0) }} <span class="text-sm">FCFA</span></p>
                                            </div>
                                            <div class="p-4 bg-blue-50 rounded-xl border border-blue-200">
                                                <p class="text-xs text-blue-700 font-semibold mb-1">Vendu</p>
                                                <p class="text-xl font-bold text-blue-600">{{ totalImmobilierVendu || 0 }}</p>
                                            </div>
                                        </div>
                                        <div class="p-4 bg-yellow-50 rounded-xl border border-yellow-200">
                                            <p class="text-xs text-yellow-700 font-semibold mb-1">Restant</p>
                                            <p class="text-xl font-bold text-yellow-600">{{ restantImmobilier || 0 }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-6 pt-6 border-t border-principal/20">
                                        <span class="text-principal font-bold flex items-center group-hover:translate-x-2 transition-transform duration-300">
                                            Voir les articles
                                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Overview Card Premium -->
                            <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-xl">
                                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <svg class="w-6 h-6 text-principal mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    Vue d'ensemble
                                </h3>
                                <div class="space-y-6">
                                    <div>
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-sm font-semibold text-gray-700">Total Articles</span>
                                            <span class="text-xl font-bold text-gray-900">{{ total || 0 }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-3 rounded-full transition-all duration-1000" style="width: 100%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-sm font-semibold text-gray-700">Vendus</span>
                                            <span class="text-xl font-bold text-green-600">{{ totalVendu || 0 }} ({{ venduPercentage }}%)</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                            <div 
                                                class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full transition-all duration-1000"
                                                :style="`width: ${venduPercentage}%`"
                                            ></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-sm font-semibold text-gray-700">En vente</span>
                                            <span class="text-xl font-bold text-yellow-600">{{ totalRestant || 0 }} ({{ enVentePercentage }}%)</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                            <div 
                                                class="bg-gradient-to-r from-yellow-500 to-yellow-600 h-3 rounded-full transition-all duration-1000"
                                                :style="`width: ${enVentePercentage}%`"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8 pt-6 border-t border-gray-200">
                                    <div class="text-center p-6 bg-gradient-to-br from-principal/10 to-principal/5 rounded-xl border border-principal/20">
                                        <p class="text-4xl font-bold bg-gradient-to-r from-principal to-principal/80 bg-clip-text text-transparent">
                                            {{ formatPrice(totalVenduSomme || 0) }} <span class="text-2xl">FCFA</span>
                                        </p>
                                        <p class="text-sm text-gray-600 mt-2 font-semibold">Chiffre d'affaire total</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </Transition>

                <!-- Immobiliers Tab -->
                <Transition
                    enter-active-class="transition ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0"
                    leave-to-class="opacity-0 translate-y-4"
                >
                    <div v-show="activeTab === 'immobiliers'" class="space-y-6">
                        <!-- Header -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div>
                                <h2 class="text-3xl font-bold text-gray-900">Mes annonces</h2>
                                <p class="text-gray-600 mt-1">{{ totalImmobilier || 0 }} annonce{{ (totalImmobilier || 0) > 1 ? 's' : '' }}</p>
                            </div>
                            <Link
                                href="/publier"
                                class="group flex items-center space-x-2 bg-gradient-to-r from-principal to-principal/90 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all hover:scale-105"
                            >
                                <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span>Nouvelle annonce</span>
                            </Link>
                        </div>

                        <!-- Properties Grid Premium -->
                        <div v-if="habitats && habitats.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <div
                                v-for="habitat in habitats"
                                :key="habitat.id"
                                class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-200 transform hover:-translate-y-2"
                            >
                                <!-- Image -->
                                <div class="relative aspect-video overflow-hidden bg-gray-100">
                                    <img 
                                        :src="getImageUrl(habitat.image1)" 
                                        :alt="habitat.nom"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                        @click="navigateToDetail(habitat.id)"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    
                                    <!-- Status Badge -->
                                    <div class="absolute top-3 left-3">
                                        <span 
                                            :class="[
                                                'px-3 py-1.5 rounded-full text-xs font-bold shadow-lg backdrop-blur-sm',
                                                habitat.status === 'accepter' 
                                                    ? 'bg-green-500/90 text-white' 
                                                    : habitat.status === 'pending' 
                                                        ? 'bg-yellow-500/90 text-white' 
                                                        : 'bg-gray-500/90 text-white'
                                            ]"
                                        >
                                            {{ habitat.status === 'accepter' ? 'Disponible' : habitat.status === 'pending' ? 'En attente' : habitat.status }}
                                        </span>
                                    </div>

                                    <!-- Boost Badge -->
                                    <div v-if="habitat.booster" class="absolute top-3 right-3">
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-400 to-yellow-500 text-white shadow-lg backdrop-blur-sm">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                            </svg>
                                            Boost
                                        </span>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-5">
                                    <h3 
                                        @click="navigateToDetail(habitat.id)"
                                        class="font-bold text-gray-900 mb-2 line-clamp-1 cursor-pointer hover:text-principal transition-colors text-lg"
                                    >
                                        {{ habitat.nom }}
                                    </h3>
                                    <p class="text-principal font-bold text-xl mb-3">
                                        {{ formatPrice(habitat.prix) }} <span class="text-sm text-gray-600 font-normal">FCFA</span>
                                    </p>
                                    <div class="flex items-center text-sm text-gray-600 mb-4">
                                        <svg class="w-4 h-4 text-principal mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ habitat.region }}
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-200">
                                        <button
                                            @click="navigateUpdateImmobilier(habitat.id)"
                                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2.5 rounded-lg text-sm font-semibold transition-all hover:scale-105 flex items-center justify-center space-x-1 shadow-md"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span class="hidden sm:inline">Modifier</span>
                                        </button>
                                        <button
                                            @click="navigateUpdateVenduImmobilier(habitat.id)"
                                            class="flex-1 bg-green-500 hover:bg-green-600 text-white px-3 py-2.5 rounded-lg text-sm font-semibold transition-all hover:scale-105 flex items-center justify-center space-x-1 shadow-md"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="hidden sm:inline">Vendu</span>
                                        </button>
                                        <button
                                            @click="navigateToBoostImmobillier(habitat.id)"
                                            :class="[
                                                'flex-1 px-3 py-2.5 rounded-lg text-sm font-semibold transition-all hover:scale-105 flex items-center justify-center space-x-1 shadow-md',
                                                habitat.status === 'accepter'
                                                    ? 'bg-yellow-500 hover:bg-yellow-600 text-white'
                                                    : 'bg-gray-500 hover:bg-gray-600 text-white'
                                            ]"
                                        >
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="hidden sm:inline">{{ habitat.status === 'accepter' ? 'Boost' : 'Booster' }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Empty State Premium -->
                        <div v-else class="text-center py-20">
                            <div class="w-32 h-32 bg-gradient-to-br from-principal/10 to-principal/5 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-16 h-16 text-principal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Aucune annonce</h3>
                            <p class="text-gray-600 mb-8 text-lg">Commencez par créer votre première annonce</p>
                            <Link
                                href="/publier"
                                class="inline-flex items-center space-x-3 bg-gradient-to-r from-principal to-principal/90 text-white px-8 py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all hover:scale-105"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span>Créer une annonce</span>
                            </Link>
                        </div>
                    </div>
                </Transition>
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

/* Animations personnalisées */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.group:hover .group-hover\:scale-110 {
    animation: fadeInUp 0.3s ease-out;
}
</style>
