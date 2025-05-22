<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps, reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    immobiliers: Array,
    voitures: Array,
    voituresBoosted: Array,
    immobilliersBoosted: Array,
    users: Object,
    statistics: Object,
    latestActivities: Array
});

const data = reactive({
    activeTab: 'dashboard',
    showMenu: false,
    popupVisible: false,
});

const showPopup = () => {
    data.popupVisible = true;
};

const confirmAction = () => {
    data.popupVisible = false;
    // Add logic to perform action
};

const cancelAction = () => {
    data.popupVisible = false;
};

// Example navigate methods
const navigateUpdateVenduVehicule = (id) => {
    Inertia.visit(`/update/navigateUpdateVenduVehicule/${id}`);
};

const navigateUpdateVenduImmobilier = (id) => {
    Inertia.visit(`/update/navigateUpdateVenduImmobilier/${id}`);
};
</script>

<style>
.custom-grid {
    display: grid;
    grid-template-rows: 20% 80%;
}

.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
}
</style>

<template>
    <AppLayout title="Dashboard Admin">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard Administrateur
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Statistiques générales -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Utilisateurs</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ statistics.totalUsers }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Immobiliers</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ statistics.totalImmobiliers }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Voitures</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ statistics.totalVoitures }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-700">Total Boostés</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ statistics.totalBoosted }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- État des boosts -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Boosts en cours</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Immobiliers</span>
                                <span class="text-lg font-semibold text-blue-600">{{ statistics.activeBoosts.immobiliers }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Voitures</span>
                                <span class="text-lg font-semibold text-blue-600">{{ statistics.activeBoosts.voitures }}</span>
                            </div>
                            <div class="border-t pt-2 mt-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-800 font-medium">Total</span>
                                    <span class="text-xl font-bold text-blue-700">{{ statistics.activeBoosts.total }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Boosts en attente</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Immobiliers</span>
                                <span class="text-lg font-semibold text-yellow-600">{{ statistics.pendingBoosts.immobiliers }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Voitures</span>
                                <span class="text-lg font-semibold text-yellow-600">{{ statistics.pendingBoosts.voitures }}</span>
                            </div>
                            <div class="border-t pt-2 mt-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-800 font-medium">Total</span>
                                    <span class="text-xl font-bold text-yellow-700">{{ statistics.pendingBoosts.total }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Boosts terminés</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Immobiliers</span>
                                <span class="text-lg font-semibold text-green-600">{{ statistics.completedBoosts.immobiliers }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Voitures</span>
                                <span class="text-lg font-semibold text-green-600">{{ statistics.completedBoosts.voitures }}</span>
                            </div>
                            <div class="border-t pt-2 mt-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-800 font-medium">Total</span>
                                    <span class="text-xl font-bold text-green-700">{{ statistics.completedBoosts.total }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dernières activités -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Dernières activités</h3>
                    <div class="space-y-4">
                        <div v-for="activity in latestActivities" :key="activity.date" class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <div :class="{
                                    'bg-blue-100 text-blue-500': activity.type === 'immobilier',
                                    'bg-purple-100 text-purple-500': activity.type === 'voiture'
                                }" class="p-2 rounded-full">
                                    <svg v-if="activity.type === 'immobilier'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">{{ activity.action }}</p>
                                <p class="text-sm text-gray-500">{{ formatDate(activity.date) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { Head } from '@inertiajs/vue3'

export default {
    data() {
        return {
            sections: [
                { id: 1, titre: "Mes rendez-vous" },
            ],
        }
    },

    methods: {
        navigateToDetail(id) {
            this.$inertia.visit(`/statusImmobilier/${id}`);
        },

        navigateToDetailVoiture(id) {
            this.$inertia.visit(`/statusVehicule/${id}`);
        },

        formatDate(date) {
            return new Date(date).toLocaleDateString('fr-FR', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            })
        }
    },
}
</script>
