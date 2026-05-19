<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Toast from '@/Components/Toast.vue';
import { Head, Link, useForm, router, usePage } from '@inertiajs/vue3';
import { ref, watch, onMounted } from 'vue';

const props = defineProps({
    alerts: Array,
});

const page = usePage();
const showToast = ref(false);
const toastMessage = ref('');
const toastType = ref('success');

// Surveiller les messages flash
watch(() => page.props.flash?.message, (message) => {
    if (message) {
        toastMessage.value = message;
        toastType.value = 'success';
        showToast.value = true;
    }
}, { immediate: true });

const deleteAlert = (id) => {
    if (confirm('Voulez-vous vraiment supprimer cette alerte ?')) {
        router.delete(route('alertes.destroy', id), {
            preserveScroll: true,
        });
    }
};

const toggleAlert = (id) => {
    router.patch(route('alertes.toggle', id), {}, {
        preserveScroll: true,
    });
};

const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-FR').format(price);
};
</script>

<template>
    <AppLayout title="Mes Alertes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mes Alertes Immobilières
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div v-if="alerts.length === 0" class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-bell-slash text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Aucune alerte configurée</h3>
                        <p class="mt-1 text-gray-500">Configurez des alertes depuis les pages de catégories pour être notifié des nouveaux biens.</p>
                        <div class="mt-6">
                            <Link href="/" class="inline-flex items-center px-4 py-2 bg-principal border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-principal/90 focus:bg-principal/90 active:bg-principal/90 focus:outline-none focus:ring-2 focus:ring-principal focus:ring-offset-2 transition ease-in-out duration-150">
                                Parcourir les annonces
                            </Link>
                        </div>
                    </div>

                    <div v-else class="space-y-4">
                        <div v-for="alert in alerts" :key="alert.id" 
                            class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 border rounded-xl hover:border-principal/30 transition-colors"
                            :class="{'opacity-60 bg-gray-50': !alert.is_active}">
                            
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="px-2 py-0.5 bg-principal/10 text-principal rounded text-xs font-bold uppercase">
                                        {{ alert.type || 'Tous types' }}
                                    </span>
                                    <span v-if="alert.region" class="text-gray-600 text-sm font-medium">
                                        <i class="fas fa-map-marker-alt mr-1"></i>{{ alert.region }}
                                    </span>
                                </div>
                                <div class="text-gray-900 font-bold">
                                    <template v-if="alert.min_price && alert.max_price">
                                        Entre {{ formatPrice(alert.min_price) }} et {{ formatPrice(alert.max_price) }} FCFA
                                    </template>
                                    <template v-else-if="alert.min_price">
                                        À partir de {{ formatPrice(alert.min_price) }} FCFA
                                    </template>
                                    <template v-else-if="alert.max_price">
                                        Jusqu'à {{ formatPrice(alert.max_price) }} FCFA
                                    </template>
                                    <template v-else>
                                        Tous les prix
                                    </template>
                                </div>
                                <div class="text-xs text-gray-400 mt-1">
                                    Créée le {{ new Date(alert.created_at).toLocaleDateString('fr-FR') }}
                                </div>
                            </div>

                            <div class="flex items-center gap-3 mt-4 sm:mt-0 w-full sm:w-auto justify-end">
                                <button @click="toggleAlert(alert.id)" 
                                    class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors"
                                    :class="alert.is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-200 text-gray-600 hover:bg-gray-300'">
                                    {{ alert.is_active ? 'Active' : 'Inactive' }}
                                </button>
                                <button @click="deleteAlert(alert.id)" 
                                    class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors"
                                    title="Supprimer l'alerte">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Notification -->
        <Toast 
            :show="showToast" 
            :message="toastMessage" 
            :type="toastType"
            @close="showToast = false"
        />
    </AppLayout>
</template>
