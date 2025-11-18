<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Footer from '../Components/Footer.vue';
import Navbar from '../Components/Navbar.vue';
import { ref, computed } from 'vue';

const props = defineProps({
    notifications: Object,
});

const formatDate = (date) => {
    if (!date) return '';
    const d = new Date(date);
    const now = new Date();
    const diff = now - d;
    const minutes = Math.floor(diff / 60000);
    const hours = Math.floor(minutes / 60);
    const days = Math.floor(hours / 24);

    if (minutes < 1) return 'À l\'instant';
    if (minutes < 60) return `Il y a ${minutes} min`;
    if (hours < 24) return `Il y a ${hours}h`;
    if (days < 7) return `Il y a ${days}j`;
    return d.toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' });
};

const markAsRead = (id) => {
    router.post(`/notifications/${id}/read`, {}, {
        preserveScroll: true,
    });
};

const markAllAsRead = () => {
    router.post('/notifications/read-all', {}, {
        preserveScroll: true,
    });
};

const deleteNotification = (id) => {
    router.delete(`/notifications/${id}`, {
        preserveScroll: true,
    });
};

const navigateToDetail = (immobilierId) => {
    if (immobilierId) {
        router.visit(`/detail/${immobilierId}`);
    }
};

const unreadCount = computed(() => {
    return props.notifications?.data?.filter(n => !n.read).length || 0;
});
</script>

<template>
    <AppLayout title="Notifications">
        <Head title="Notifications" />
        <Navbar />

        <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50 py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8 flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2 flex items-center">
                            <i class="bi bi-bell-fill text-principal mr-3"></i>
                            Notifications
                        </h1>
                        <p class="text-gray-600">
                            Restez informé de toutes vos activités
                        </p>
                    </div>
                    <button
                        v-if="unreadCount > 0"
                        @click="markAllAsRead"
                        class="px-4 py-2 bg-principal text-white rounded-xl font-semibold hover:bg-principal-dark transition-colors duration-300"
                    >
                        <i class="bi bi-check-all mr-2"></i>
                        Tout marquer comme lu
                    </button>
                </div>

                <!-- Liste des notifications -->
                <div v-if="notifications.data && notifications.data.length > 0" class="space-y-4">
                    <div
                        v-for="notification in notifications.data"
                        :key="notification.id"
                        :class="[
                            'bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border-l-4',
                            notification.read ? 'border-gray-200' : 'border-principal'
                        ]"
                    >
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <div :class="[
                                        'w-10 h-10 rounded-full flex items-center justify-center',
                                        notification.type === 'favori' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600'
                                    ]">
                                        <i :class="notification.type === 'favori' ? 'bi bi-heart-fill' : 'bi bi-bell-fill'"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-gray-900">{{ notification.title }}</h3>
                                        <p class="text-gray-600 text-sm mt-1">{{ notification.message }}</p>
                                        <p class="text-gray-400 text-xs mt-2">{{ formatDate(notification.created_at) }}</p>
                                    </div>
                                </div>
                                
                                <!-- Lien vers le bien si disponible -->
                                <button
                                    v-if="notification.immobilier_id"
                                    @click="navigateToDetail(notification.immobilier_id)"
                                    class="mt-3 text-principal hover:text-principal-dark font-semibold text-sm flex items-center group"
                                >
                                    <i class="bi bi-arrow-right mr-2 group-hover:translate-x-1 transition-transform"></i>
                                    Voir le bien
                                </button>
                            </div>
                            
                            <div class="flex items-center gap-2 ml-4">
                                <button
                                    v-if="!notification.read"
                                    @click="markAsRead(notification.id)"
                                    class="p-2 text-gray-400 hover:text-principal transition-colors"
                                    aria-label="Marquer comme lu"
                                >
                                    <i class="bi bi-check-circle text-xl"></i>
                                </button>
                                <button
                                    @click="deleteNotification(notification.id)"
                                    class="p-2 text-gray-400 hover:text-red-500 transition-colors"
                                    aria-label="Supprimer"
                                >
                                    <i class="bi bi-trash text-xl"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- État vide -->
                <div v-else class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="bi bi-bell-slash text-6xl text-gray-300 mb-4"></i>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">
                            Aucune notification
                        </h2>
                        <p class="text-gray-600 mb-6">
                            Vous n'avez pas encore de notifications
                        </p>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="notifications.data && notifications.data.length > 0 && notifications.links" class="mt-8 flex justify-center">
                    <div class="flex space-x-2">
                        <Link
                            v-for="(link, index) in notifications.links"
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

