<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['close', 'save']);

const preferences = ref({
    necessary: true, // Toujours activé (obligatoire)
    analytics: false,
    marketing: false,
    preferences: false
});

const savePreferences = () => {
    localStorage.setItem('cookie_consent', 'custom');
    localStorage.setItem('cookie_preferences', JSON.stringify(preferences.value));
    localStorage.setItem('cookie_consent_date', new Date().toISOString());
    
    // Initialiser uniquement les cookies acceptés
    if (preferences.value.analytics) {
        // Initialiser Google Analytics, etc.
    }
    if (preferences.value.marketing) {
        // Initialiser les cookies marketing
    }
    if (preferences.value.preferences) {
        // Initialiser les cookies de préférences
    }
    
    emit('save', preferences.value);
    emit('close');
    
    window.dispatchEvent(new CustomEvent('cookies-customized', { detail: preferences.value }));
};

onMounted(() => {
    // Charger les préférences existantes si disponibles
    const saved = localStorage.getItem('cookie_preferences');
    if (saved) {
        try {
            preferences.value = { ...preferences.value, ...JSON.parse(saved) };
        } catch (e) {
            console.error('Erreur lors du chargement des préférences:', e);
        }
    }
});
</script>

<template>
    <Transition
        enter-active-class="transition ease-out duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div 
            v-if="show"
            class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
            @click.self="$emit('close')"
        >
            <!-- Overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <!-- Modal -->
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative bg-white rounded-2xl shadow-xl max-w-2xl w-full p-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h2 id="modal-title" class="text-2xl font-bold text-gray-900">
                            Préférences de cookies
                        </h2>
                        <button
                            @click="$emit('close')"
                            class="text-gray-400 hover:text-gray-600 transition-colors"
                            aria-label="Fermer"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-600 mb-6">
                        Gérez vos préférences de cookies. Vous pouvez activer ou désactiver chaque type de cookie ci-dessous.
                        <Link href="/cookies" class="text-teal-600 hover:text-teal-700 underline">
                            En savoir plus sur notre utilisation des cookies
                        </Link>
                    </p>

                    <!-- Préférences -->
                    <div class="space-y-4 mb-6">
                        <!-- Cookies nécessaires -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <h3 class="font-semibold text-gray-900">Cookies nécessaires</h3>
                                    <p class="text-sm text-gray-600">Ces cookies sont essentiels au fonctionnement du site.</p>
                                </div>
                                <div class="flex-shrink-0 ml-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                                        Toujours actif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Cookies analytiques -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">Cookies analytiques</h3>
                                    <p class="text-sm text-gray-600">Nous aident à comprendre comment les visiteurs utilisent notre site.</p>
                                </div>
                                <div class="flex-shrink-0 ml-4">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input 
                                            type="checkbox" 
                                            v-model="preferences.analytics"
                                            class="sr-only peer"
                                        >
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-600"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Cookies marketing -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">Cookies marketing</h3>
                                    <p class="text-sm text-gray-600">Utilisés pour vous montrer des publicités pertinentes.</p>
                                </div>
                                <div class="flex-shrink-0 ml-4">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input 
                                            type="checkbox" 
                                            v-model="preferences.marketing"
                                            class="sr-only peer"
                                        >
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-600"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Cookies de préférences -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">Cookies de préférences</h3>
                                    <p class="text-sm text-gray-600">Mémorisent vos choix (langue, région, etc.).</p>
                                </div>
                                <div class="flex-shrink-0 ml-4">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input 
                                            type="checkbox" 
                                            v-model="preferences.preferences"
                                            class="sr-only peer"
                                        >
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-600"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3">
                        <button
                            @click="$emit('close')"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                        >
                            Annuler
                        </button>
                        <button
                            @click="savePreferences"
                            class="px-6 py-2 text-sm font-semibold text-white bg-teal-600 rounded-lg hover:bg-teal-700 transition-colors shadow-sm"
                        >
                            Enregistrer les préférences
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
/* Styles pour les toggles */
</style>

