<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    immobiliers: Array,
    immobilliersBoosted: Array,
    immobilliersBoosting: Array,
    immobiliersArretes: Array,
    users: Object
});

const activeTab = ref('overview');
const isLoading = ref(false);
const showModal = ref(false);
const selectedProperty = ref(null);
const currentDuration = ref('N/A');
let durationInterval = null;

// Approuver une demande
const approveBoost = async (id) => {
    if (!confirm('Approuver cette demande de boost?')) return;
    
    isLoading.value = true;
    try {
        const response = await fetch(`/boost-request/${id}/approve`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
            body: JSON.stringify({})
        });
        
        if (response.ok) {
            alert('✓ Boost approuvé!');
            Inertia.reload();
        } else {
            const error = await response.json();
            alert('✗ Erreur: ' + (error.error || error.message || 'Erreur inconnue'));
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('✗ Erreur: ' + error.message);
    } finally {
        isLoading.value = false;
    }
};

// Refuser une demande
const rejectBoost = async (id) => {
    if (!confirm('Refuser cette demande de boost?')) return;
    
    isLoading.value = true;
    try {
        const response = await fetch(`/boost-request/${id}/reject`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
            body: JSON.stringify({})
        });
        
        if (response.ok) {
            alert('✓ Demande refusée');
            Inertia.reload();
        } else {
            const error = await response.json();
            alert('✗ Erreur: ' + (error.error || error.message || 'Erreur inconnue'));
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('✗ Erreur: ' + error.message);
    } finally {
        isLoading.value = false;
    }
};

// Arrêter un boost
const stopBoost = async (id) => {
    if (!confirm('Arrêter ce boost?')) return;
    
    isLoading.value = true;
    try {
        const response = await fetch(`/boost-request/${id}/stop`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
            body: JSON.stringify({})
        });
        
        if (response.ok) {
            alert('✓ Boost arrêté');
            Inertia.reload();
        } else {
            const error = await response.json();
            alert('✗ Erreur: ' + (error.error || error.message || 'Erreur inconnue'));
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('✗ Erreur: ' + error.message);
    } finally {
        isLoading.value = false;
    }
};

// Relancer un boost
const restartBoost = async (id) => {
    if (!confirm('Relancer le boost pour 30 jours?')) return;
    
    isLoading.value = true;
    try {
        const response = await fetch(`/boost-request/${id}/restart`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
            body: JSON.stringify({})
        });
        
        if (response.ok) {
            alert('✓ Boost relancé pour 30 jours!');
            Inertia.reload();
        } else {
            const error = await response.json();
            alert('✗ Erreur: ' + (error.error || error.message || 'Erreur inconnue'));
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('✗ Erreur: ' + error.message);
    } finally {
        isLoading.value = false;
    }
};

// Format price
const formatPrice = (price) => {
    if (!price) return '0 XOF';
    const numPrice = typeof price === 'string' ? parseFloat(price.replace(/\s/g, '')) : price;
    if (numPrice >= 1000000) {
        return (numPrice / 1000000).toFixed(1) + 'M';
    } else if (numPrice >= 1000) {
        return (numPrice / 1000).toFixed(0) + 'K';
    }
    return numPrice.toLocaleString('fr-FR');
};

// Ouvrir la modal avec les détails
const openPropertyModal = (property) => {
    selectedProperty.value = property;
    showModal.value = true;
    
    // Mettre à jour la durée restante immédiatement
    updateDuration();
    
    // Arrêter l'ancien intervalle s'il existe
    if (durationInterval) {
        clearInterval(durationInterval);
    }
    
    // Mettre à jour la durée restante chaque seconde
    durationInterval = setInterval(() => {
        updateDuration();
    }, 1000);
};

// Fermer la modal
const closeModal = () => {
    showModal.value = false;
    selectedProperty.value = null;
    
    // Arrêter la mise à jour de la durée
    if (durationInterval) {
        clearInterval(durationInterval);
        durationInterval = null;
    }
};

// Formater la date
const formatDate = (date) => {
    if (!date) return 'N/A';
    const d = new Date(date);
    return d.toLocaleDateString('fr-FR', { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

// Calculer la durée restante
const getDuration = (endDate) => {
    if (!endDate) return 'N/A';
    const now = new Date();
    const end = new Date(endDate);
    const diff = end - now;
    
    // Si la durée est négative, le boost est expiré
    if (diff < 0) {
        return 'Expiré';
    }
    
    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    
    if (days > 0) {
        return `${days}j ${hours}h ${minutes}min restants`;
    } else if (hours > 0) {
        return `${hours}h ${minutes}min restantes`;
    } else if (minutes > 0) {
        return `${minutes}min restantes`;
    } else {
        return 'Bientôt terminé';
    }
};

// Calculer la date de fin (pour l'aperçu de l'approbation)
const calculateEndDate = (days) => {
    const date = new Date();
    date.setDate(date.getDate() + parseInt(days));
    return date.toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

// Mettre à jour la durée restante en temps réel
const updateDuration = () => {
    if (!selectedProperty.value?.date_fin_booster) {
        currentDuration.value = 'N/A';
        return;
    }
    currentDuration.value = getDuration(selectedProperty.value.date_fin_booster);
};

// Stats
const stats = computed(() => [
    {
        title: 'Demandes en Attente',
        value: props.immobiliers?.length || 0,
        icon: '📝',
        color: 'from-orange-500 to-orange-600',
        bgColor: 'bg-orange-50',
        textColor: 'text-orange-600'
    },
    {
        title: 'En Cours',
        value: props.immobilliersBoosting?.length || 0,
        icon: '⚡',
        color: 'from-yellow-500 to-yellow-600',
        bgColor: 'bg-yellow-50',
        textColor: 'text-yellow-600'
    },
    {
        title: 'Arrêtés',
        value: props.immobiliersArretes?.length || 0,
        icon: '⏹',
        color: 'from-red-500 to-red-600',
        bgColor: 'bg-red-50',
        textColor: 'text-red-600'
    },
    {
        title: 'Complétés',
        value: props.immobilliersBoosted?.length || 0,
        icon: '✓',
        color: 'from-green-500 to-green-600',
        bgColor: 'bg-green-50',
        textColor: 'text-green-600'
    }
]);
</script>

<template>
    <AppLayout title="Admin Dashboard">
        <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-50 pt-20">
            <!-- Header Section -->
            <div class="border-b border-slate-200 bg-white/80 backdrop-blur-sm sticky top-0 z-40">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-600 bg-clip-text text-transparent mb-1">
                                🔐 Tableau de Bord Admin
                            </h1>
                            <p class="text-slate-500 text-sm">Gestion des demandes de boost et modération</p>
                        </div>
                        <div class="flex gap-3">
                            <button class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-all font-medium">
                                📊 Export
                            </button>
                            <button @click="Inertia.reload()" class="px-4 py-2 bg-gradient-to-r from-principal to-secondaire text-white rounded-lg hover:shadow-lg transition-all font-semibold">
                                🔄 Rafraîchir
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div v-for="(stat, idx) in stats" :key="idx"
                        class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 hover:shadow-lg transition-all duration-300">
                        
                        <!-- Background gradient on hover -->
                        <div :class="`absolute inset-0 bg-gradient-to-br ${stat.color} opacity-0 group-hover:opacity-5 transition-opacity`"></div>
                        
                        <div class="relative">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <p class="text-slate-500 text-sm font-medium">{{ stat.title }}</p>
                                    <p class="text-4xl font-bold text-slate-900 mt-1">{{ stat.value }}</p>
                                </div>
                                <div :class="`w-14 h-14 rounded-xl bg-gradient-to-br ${stat.color} flex items-center justify-center text-2xl shadow-lg`">
                                    {{ stat.icon }}
                                </div>
                            </div>
                            <div class="pt-4 border-t border-slate-100">
                                <p class="text-xs text-slate-400">Total actif</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <div class="flex gap-2 mb-6 border-b border-slate-200 bg-white rounded-t-2xl p-1">
                    <button @click="activeTab = 'overview'"
                        :class="activeTab === 'overview' 
                            ? 'bg-gradient-to-r from-principal to-secondaire text-white' 
                            : 'text-slate-600 hover:bg-slate-100'"
                        class="flex-1 sm:flex-none px-6 py-3 rounded-lg transition-all font-semibold flex items-center justify-center gap-2">
                        📊 Aperçu
                    </button>
                    <button @click="activeTab = 'pending'"
                        :class="activeTab === 'pending' 
                            ? 'bg-gradient-to-r from-principal to-secondaire text-white' 
                            : 'text-slate-600 hover:bg-slate-100'"
                        class="flex-1 sm:flex-none px-6 py-3 rounded-lg transition-all font-semibold flex items-center justify-center gap-2">
                        📝 Demandes ({{ immobiliers?.length || 0 }})
                    </button>
                    <button @click="activeTab = 'boosting'"
                        :class="activeTab === 'boosting' 
                            ? 'bg-gradient-to-r from-principal to-secondaire text-white' 
                            : 'text-slate-600 hover:bg-slate-100'"
                        class="flex-1 sm:flex-none px-6 py-3 rounded-lg transition-all font-semibold flex items-center justify-center gap-2">
                        ⚡ En Cours ({{ immobilliersBoosting?.length || 0 }})
                    </button>
                    <button @click="activeTab = 'stopped'"
                        :class="activeTab === 'stopped' 
                            ? 'bg-gradient-to-r from-principal to-secondaire text-white' 
                            : 'text-slate-600 hover:bg-slate-100'"
                        class="flex-1 sm:flex-none px-6 py-3 rounded-lg transition-all font-semibold flex items-center justify-center gap-2">
                        ⏹ Arrêtés ({{ immobiliersArretes?.length || 0 }})
                    </button>
                    <button @click="activeTab = 'history'"
                        :class="activeTab === 'history' 
                            ? 'bg-gradient-to-r from-principal to-secondaire text-white' 
                            : 'text-slate-600 hover:bg-slate-100'"
                        class="flex-1 sm:flex-none px-6 py-3 rounded-lg transition-all font-semibold flex items-center justify-center gap-2">
                        ✓ Historique
                    </button>
                </div>

                <!-- Content Tabs -->

                <!-- Overview Tab -->
                <div v-if="activeTab === 'overview'" class="space-y-6 animate-fadeIn">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Quick Stats -->
                        <div class="rounded-2xl border border-slate-200 bg-white p-6">
                            <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                                <span class="text-2xl">📈</span> Résumé Rapide
                            </h2>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center p-4 bg-gradient-to-r from-orange-50 to-orange-100/50 rounded-lg border border-orange-200">
                                    <span class="text-slate-700 font-medium">Demandes en attente:</span>
                                    <span class="text-2xl font-bold text-orange-600">{{ immobiliers?.length || 0 }}</span>
                                </div>
                                <div class="flex justify-between items-center p-4 bg-gradient-to-r from-yellow-50 to-yellow-100/50 rounded-lg border border-yellow-200">
                                    <span class="text-slate-700 font-medium">Boosts actifs:</span>
                                    <span class="text-2xl font-bold text-yellow-600">{{ immobilliersBoosting?.length || 0 }}</span>
                                </div>
                                <div class="flex justify-between items-center p-4 bg-gradient-to-r from-green-50 to-green-100/50 rounded-lg border border-green-200">
                                    <span class="text-slate-700 font-medium">Boosts complétés:</span>
                                    <span class="text-2xl font-bold text-green-600">{{ immobilliersBoosted?.length || 0 }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- System Status -->
                        <div class="rounded-2xl border border-slate-200 bg-white p-6">
                            <h2 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                                <span class="text-2xl">🏥</span> Statut Système
                            </h2>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg border border-slate-200">
                                    <div class="flex items-center gap-3">
                                        <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                                        <span class="text-slate-700 font-medium">API</span>
                                    </div>
                                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">✓ Actif</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg border border-slate-200">
                                    <div class="flex items-center gap-3">
                                        <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                                        <span class="text-slate-700 font-medium">Base de Données</span>
                                    </div>
                                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">✓ Connectée</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg border border-slate-200">
                                    <div class="flex items-center gap-3">
                                        <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                                        <span class="text-slate-700 font-medium">Cache</span>
                                    </div>
                                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">✓ Actif</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Tab -->
                <div v-if="activeTab === 'pending'" class="rounded-2xl border border-slate-200 bg-white overflow-hidden animate-fadeIn">
                    <div class="p-6 border-b border-slate-200">
                        <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <span class="text-2xl">📝</span> Demandes de Boost en Attente
                        </h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Propriété</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Utilisateur</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Prix</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                <tr v-if="!immobiliers || immobiliers.length === 0" class="hover:bg-slate-50">
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                        ✓ Aucune demande en attente
                                    </td>
                                </tr>
                                <tr v-for="immo in (immobiliers || [])" :key="immo.id" class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-slate-900 font-mono font-semibold">#{{ immo.id }}</td>
                                    <td class="px-6 py-4">
                                        <p class="text-slate-900 font-semibold text-sm">{{ immo.nom }}</p>
                                        <p class="text-slate-500 text-xs mt-1">{{ immo.region || 'N/A' }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ immo.user?.name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="text-principal font-bold text-sm">{{ formatPrice(immo.prix) }} XOF</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex gap-2">
                                            <button @click="approveBoost(immo.id)" :disabled="isLoading"
                                                class="px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all text-xs font-semibold disabled:opacity-50">
                                                ✓ Approuver
                                            </button>
                                            <button @click="rejectBoost(immo.id)" :disabled="isLoading"
                                                class="px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all text-xs font-semibold disabled:opacity-50">
                                                ✗ Refuser
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Boosting Tab -->
                <div v-if="activeTab === 'boosting'" class="rounded-2xl border border-slate-200 bg-white overflow-hidden animate-fadeIn">
                    <div class="p-6 border-b border-slate-200">
                        <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <span class="text-2xl">⚡</span> Boosts Actuellement Actifs
                        </h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Propriété</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Utilisateur</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Prix</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                <tr v-if="!immobilliersBoosting || immobilliersBoosting.length === 0" class="hover:bg-slate-50">
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                        Aucun boost actif
                                    </td>
                                </tr>
                                <tr v-for="immo in (immobilliersBoosting || [])" :key="immo.id" class="hover:bg-slate-50 transition-colors cursor-pointer group">
                                    <td class="px-6 py-4 text-sm text-slate-900 font-mono font-semibold">#{{ immo.id }}</td>
                                    <td class="px-6 py-4" @click="openPropertyModal(immo)">
                                        <p class="text-slate-900 font-semibold text-sm group-hover:text-principal transition-colors">{{ immo.nom }}</p>
                                        <p class="text-slate-500 text-xs mt-1">{{ immo.region || 'N/A' }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ immo.user?.name }}</td>
                                    <td class="px-6 py-4" @click="openPropertyModal(immo)">
                                        <span class="text-principal font-bold text-sm group-hover:underline cursor-pointer">{{ formatPrice(immo.prix) }} XOF</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <button @click="stopBoost(immo.id)" :disabled="isLoading"
                                            class="px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all text-xs font-semibold disabled:opacity-50">
                                            ⏹ Arrêter
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Stopped Tab -->
                <div v-if="activeTab === 'stopped'" class="rounded-2xl border border-slate-200 bg-white overflow-hidden animate-fadeIn">
                    <div class="p-6 border-b border-slate-200">
                        <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <span class="text-2xl">⏹</span> Boosts Arrêtés Manuellement
                        </h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Propriété</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Utilisateur</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Prix</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Arrêté le</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                <tr v-if="!immobiliersArretes || immobiliersArretes.length === 0" class="hover:bg-slate-50">
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                        Aucun boost arrêté
                                    </td>
                                </tr>
                                <tr v-for="immo in (immobiliersArretes || [])" :key="immo.id" class="hover:bg-slate-50 transition-colors cursor-pointer group" @click="openPropertyModal(immo)">
                                    <td class="px-6 py-4 text-sm text-slate-900 font-mono font-semibold">#{{ immo.id }}</td>
                                    <td class="px-6 py-4">
                                        <p class="text-slate-900 font-semibold text-sm group-hover:text-principal transition-colors">{{ immo.nom }}</p>
                                        <p class="text-slate-500 text-xs mt-1">{{ immo.region || 'N/A' }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ immo.user?.name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="text-principal font-bold text-sm">{{ formatPrice(immo.prix) }} XOF</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ formatDate(immo.date_fin_booster) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- History Tab -->
                <div v-if="activeTab === 'history'" class="rounded-2xl border border-slate-200 bg-white overflow-hidden animate-fadeIn">
                    <div class="p-6 border-b border-slate-200">
                        <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <span class="text-2xl">✓</span> Historique des Boosts
                        </h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Propriété</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Utilisateur</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Prix</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                <tr v-if="!immobilliersBoosted || immobilliersBoosted.length === 0" class="hover:bg-slate-50">
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                        Aucun historique
                                    </td>
                                </tr>
                                <tr v-for="immo in (immobilliersBoosted || [])" :key="immo.id" class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-slate-900 font-mono font-semibold">#{{ immo.id }}</td>
                                    <td class="px-6 py-4">
                                        <p class="text-slate-900 font-semibold text-sm">{{ immo.nom }}</p>
                                        <p class="text-slate-500 text-xs mt-1">{{ immo.region || 'N/A' }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ immo.user?.name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="text-principal font-bold text-sm">{{ formatPrice(immo.prix) }} XOF</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">
                                            ✓ Complété
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- Modal Détails Propriété -->
            <div v-if="showModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-fadeIn">
                    <!-- Header Modal -->
                    <div class="sticky top-0 bg-gradient-to-r from-principal to-secondaire text-white p-6 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-3xl">📋</span>
                            <div>
                                <h2 class="text-2xl font-bold">{{ selectedProperty?.nom }}</h2>
                                <p class="text-white/80 text-sm">ID: #{{ selectedProperty?.id }}</p>
                            </div>
                        </div>
                        <button @click="closeModal" class="p-2 hover:bg-white/20 rounded-lg transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Content Modal -->
                    <div class="p-6 space-y-6">
                        <!-- Prix Section -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 border-2 border-green-200 rounded-xl p-6">
                            <p class="text-green-600 text-sm font-semibold mb-2">💰 Prix</p>
                            <p class="text-4xl font-bold text-green-700">{{ formatPrice(selectedProperty?.prix) }} XOF</p>
                        </div>

                        <!-- Information Propriété -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                <p class="text-slate-500 text-xs font-semibold uppercase mb-1">📍 Région</p>
                                <p class="text-slate-900 font-semibold">{{ selectedProperty?.region || 'N/A' }}</p>
                            </div>
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                <p class="text-slate-500 text-xs font-semibold uppercase mb-1">🏷️ Type</p>
                                <p class="text-slate-900 font-semibold">{{ selectedProperty?.type || 'N/A' }}</p>
                            </div>
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                <p class="text-slate-500 text-xs font-semibold uppercase mb-1">👤 Vendeur</p>
                                <p class="text-slate-900 font-semibold">{{ selectedProperty?.user?.name }}</p>
                                <p class="text-slate-500 text-xs mt-1">{{ selectedProperty?.user?.email }}</p>
                            </div>
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                <p class="text-slate-500 text-xs font-semibold uppercase mb-1">📞 Téléphone</p>
                                <p class="text-slate-900 font-semibold">{{ selectedProperty?.user?.phone || 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Boost Timeline -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-xl p-6">
                            <p class="text-blue-600 font-semibold mb-4 flex items-center gap-2">
                                <span class="text-2xl">⚡</span> Informations de Boost
                            </p>
                            <div class="space-y-3">
                                <!-- Début du boost -->
                                <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-blue-100">
                                    <span class="text-slate-700 font-medium">🎯 Début du boost</span>
                                    <span class="text-slate-900 font-semibold">{{ formatDate(selectedProperty?.updated_at) }}</span>
                                </div>

                                <!-- Fin du boost -->
                                <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-blue-100">
                                    <span class="text-slate-700 font-medium">🏁 Fin du boost</span>
                                    <span class="text-slate-900 font-semibold">{{ formatDate(selectedProperty?.date_fin_booster) }}</span>
                                </div>

                                <!-- Durée demandée -->
                                <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-blue-100">
                                    <span class="text-slate-700 font-medium">📅 Durée demandée</span>
                                    <span class="text-slate-900 font-semibold">{{ selectedProperty?.boost_duration || 30 }} jours</span>
                                </div>

                                <!-- Durée restante -->
                                <div class="flex items-center justify-between p-3 bg-gradient-to-r from-yellow-100 to-yellow-50 rounded-lg border-2 border-yellow-300">
                                    <span class="text-slate-700 font-bold">⏱️ Durée restante</span>
                                    <span class="text-yellow-700 font-bold text-lg">{{ currentDuration }}</span>
                                </div>

                                <!-- Statut -->
                                <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-blue-100">
                                    <span class="text-slate-700 font-medium">📊 Statut</span>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">✓ Actif</span>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div v-if="selectedProperty?.description" class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                            <p class="text-slate-600 text-xs font-semibold uppercase mb-2">📝 Description</p>
                            <p class="text-slate-700 line-clamp-4">{{ selectedProperty?.description }}</p>
                        </div>

                        <!-- Aperçu Approbation -->
                        <div v-if="selectedProperty?.status === 'pending'" class="bg-blue-50 border-2 border-blue-200 rounded-xl p-6">
                            <p class="text-blue-600 font-semibold mb-3 flex items-center gap-2">
                                <span class="text-2xl">ℹ️</span> Aperçu de l'approbation
                            </p>
                            <div class="space-y-2 text-sm">
                                <p class="text-slate-700">En approuvant cette demande:</p>
                                <div class="bg-white rounded-lg p-3 border border-blue-100">
                                    <p class="font-semibold text-slate-900">Durée: <span class="text-blue-600">{{ selectedProperty?.boost_duration || 30 }} jours</span></p>
                                    <p class="text-slate-600 text-xs mt-1">Fin prévue: {{ calculateEndDate(selectedProperty?.boost_duration || 30) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3 pt-4 border-t border-slate-200">
                            <!-- Bouton Approuver (Pour les demandes en attente) -->
                            <button v-if="selectedProperty?.status === 'pending'" 
                                @click="approveBoost(selectedProperty?.id)" 
                                :disabled="isLoading"
                                class="flex-1 px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:shadow-lg transition-all font-semibold disabled:opacity-50 flex items-center justify-center gap-2">
                                <span>✓</span> Approuver
                            </button>

                            <!-- Bouton Arrêter (Pour les boosts en cours) -->
                            <button v-else-if="selectedProperty?.status === 'accepter' && selectedProperty?.booster === 1" 
                                @click="stopBoost(selectedProperty?.id)" 
                                :disabled="isLoading"
                                class="flex-1 px-4 py-3 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all font-semibold disabled:opacity-50 flex items-center justify-center gap-2">
                                <span>⏹</span> Arrêter le boost
                            </button>

                            <!-- Bouton Booster à nouveau (Pour les boosts arrêtés) -->
                            <button v-else-if="selectedProperty?.booster === 0 && selectedProperty?.status === 'null' && selectedProperty?.onceBooster === 1" 
                                @click="restartBoost(selectedProperty?.id)" 
                                :disabled="isLoading"
                                class="flex-1 px-4 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:shadow-lg transition-all font-semibold disabled:opacity-50 flex items-center justify-center gap-2">
                                <span>🚀</span> Booster à nouveau
                            </button>

                            <button @click="closeModal"
                                class="flex-1 px-4 py-3 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition-all font-semibold flex items-center justify-center gap-2">
                                <span>❌</span> Fermer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
