<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, computed } from 'vue';
import { router, Link, usePage } from '@inertiajs/vue3';
import Toast from '@/Components/Toast.vue';

const props = defineProps({
    immobiliers: Array, // Pending boost requests
    immobilliersBoosted: Array,
    immobilliersBoosting: Array,
    immobiliersArretes: Array,
    allUsers: Array,
    allImmobiliers: Object, // Paginated
    allVoitures: Object, // Paginated
    blogPostsCount: Number,
});

const activeTab = ref('overview');
const isLoading = ref(false);
const showModal = ref(false);
const selectedProperty = ref(null);

const searchQuery = ref('');
const propertySearch = ref('');
const vehicleSearch = ref('');

const showToast = ref(false);
const toastMessage = ref('');

// Filtered Users
const filteredUsers = computed(() => {
    if (!props.allUsers) return [];
    if (!searchQuery.value) return props.allUsers;
    const search = searchQuery.value.toLowerCase();
    return props.allUsers.filter(u => 
        u.name?.toLowerCase().includes(search) || 
        u.email?.toLowerCase().includes(search) || 
        u.phone?.includes(search)
    );
});

// Filtered Properties
const filteredImmobiliers = computed(() => {
    if (!props.allImmobiliers?.data) return [];
    if (!propertySearch.value) return props.allImmobiliers.data;
    const search = propertySearch.value.toLowerCase();
    return props.allImmobiliers.data.filter(i => 
        i.nom?.toLowerCase().includes(search) || 
        i.region?.toLowerCase().includes(search) ||
        i.type?.toLowerCase().includes(search)
    );
});

// Filtered Vehicles
const filteredVoitures = computed(() => {
    if (!props.allVoitures?.data) return [];
    if (!vehicleSearch.value) return props.allVoitures.data;
    const search = vehicleSearch.value.toLowerCase();
    return props.allVoitures.data.filter(v => 
        v.nom?.toLowerCase().includes(search) || 
        v.marque?.toLowerCase().includes(search) ||
        v.model?.toLowerCase().includes(search)
    );
});

// Admin Actions
const deleteUser = (id) => {
    if (confirm('Supprimer définitivement cet utilisateur et TOUTES ses annonces ?')) {
        router.delete(`/admin/users/${id}`, {
            onSuccess: () => {
                toastMessage.value = "Utilisateur supprimé";
                showToast.value = true;
            }
        });
    }
};

const deleteProperty = (id) => {
    if (confirm('Supprimer cette annonce immobilière ?')) {
        router.delete(`/admin/immobilier/${id}`, {
            onSuccess: () => {
                toastMessage.value = "Annonce supprimée";
                showToast.value = true;
            }
        });
    }
};

const deleteVehicle = (id) => {
    if (confirm('Supprimer cette annonce véhicule ?')) {
        router.delete(`/admin/voiture/${id}`, {
            onSuccess: () => {
                toastMessage.value = "Annonce supprimée";
                showToast.value = true;
            }
        });
    }
};

const approveBoost = async (id) => {
    if (!confirm('Approuver cette demande de boost?')) return;
    router.post(`/boost-request/${id}/approve`, {}, {
        onSuccess: () => {
            toastMessage.value = "Boost approuvé !";
            showToast.value = true;
        }
    });
};

const stopBoost = async (id) => {
    if (!confirm('Arrêter ce boost?')) return;
    router.post(`/boost-request/${id}/stop`, {}, {
        onSuccess: () => {
            toastMessage.value = "Boost arrêté";
            showToast.value = true;
        }
    });
};

// Helpers
const formatPrice = (price) => {
    if (!price) return '0 F';
    const num = typeof price === 'string' ? parseFloat(price.replace(/\s/g, '')) : price;
    return new Intl.NumberFormat('fr-FR').format(num) + ' F';
};

const formatDate = (date) => {
    if (!date) return 'N/A';
    return new Date(date).toLocaleDateString('fr-FR', { 
        year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit'
    });
};

const stats = computed(() => [
    { title: 'Utilisateurs', value: props.allUsers?.length || 0, icon: '👥', color: 'from-blue-500 to-indigo-600' },
    { title: 'Immobiliers', value: props.allImmobiliers?.total || 0, icon: '🏠', color: 'from-emerald-500 to-teal-600' },
    { title: 'Véhicules', value: props.allVoitures?.total || 0, icon: '🚗', color: 'from-purple-500 to-pink-600' },
    { title: 'Boosts Actifs', value: props.immobilliersBoosting?.length || 0, icon: '⚡', color: 'from-amber-500 to-orange-600' },
]);
</script>

<template>
    <AppLayout title="Gestion Plateforme">
        <div class="min-h-screen bg-slate-50 pt-20">
            <!-- Top Bar -->
            <div class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-sm">
                <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h1 class="text-2xl font-black text-slate-900 flex items-center gap-3">
                                <span class="p-2 bg-slate-900 text-white rounded-xl text-xs">ADMIN</span>
                                Gestion de la Plateforme
                            </h1>
                        </div>
                        <div class="flex items-center gap-3">
                            <Link :href="route('admin.blog.index')" class="px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 rounded-xl font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-blue-100">
                                📰 Gérer le Blog
                            </Link>
                            <button @click="router.reload()" class="p-2.5 text-slate-400 hover:text-principal bg-slate-100 rounded-xl transition-all">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div v-for="stat in stats" :key="stat.title" class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div :class="`w-14 h-14 rounded-2xl bg-gradient-to-br ${stat.color} flex items-center justify-center text-2xl shadow-lg text-white group-hover:scale-110 transition-transform`">
                                {{ stat.icon }}
                            </div>
                            <span class="text-3xl font-black text-slate-900">{{ stat.value }}</span>
                        </div>
                        <p class="text-slate-500 font-bold text-xs uppercase tracking-widest">{{ stat.title }}</p>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Sidebar Navigation -->
                    <aside class="lg:w-72 flex-shrink-0">
                        <div class="bg-white p-4 rounded-[2rem] border border-slate-100 shadow-sm sticky top-40">
                            <nav class="space-y-2">
                                <button v-for="tab in [
                                    {id: 'overview', name: 'Tableau de bord', icon: 'fas fa-th-large'},
                                    {id: 'boosts', name: 'Demandes de Boost', icon: 'fas fa-bolt', count: immobiliers.length},
                                    {id: 'users', name: 'Utilisateurs', icon: 'fas fa-users'},
                                    {id: 'properties', name: 'Catalogue Immo', icon: 'fas fa-home'},
                                    {id: 'vehicles', name: 'Catalogue Auto', icon: 'fas fa-car'},
                                ]" :key="tab.id"
                                @click="activeTab = tab.id"
                                :class="activeTab === tab.id ? 'bg-principal text-white shadow-xl shadow-principal/20' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900'"
                                class="w-full flex items-center justify-between px-5 py-4 rounded-2xl font-bold text-sm transition-all text-left group">
                                    <div class="flex items-center gap-4">
                                        <i :class="tab.icon" class="w-5 text-center"></i>
                                        {{ tab.name }}
                                    </div>
                                    <span v-if="tab.count" class="bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full">{{ tab.count }}</span>
                                </button>
                            </nav>
                        </div>
                    </aside>

                    <!-- Tabs Content -->
                    <div class="flex-1 min-w-0">
                        <!-- TAB: Overview -->
                        <div v-if="activeTab === 'overview'" class="space-y-8 animate-fadeIn">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Notifications / Recent activity -->
                                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                                    <div class="flex items-center justify-between mb-8">
                                        <h3 class="text-xl font-black text-slate-900">À traiter en priorité</h3>
                                        <span class="text-[10px] font-black text-orange-500 bg-orange-50 px-2 py-1 rounded-lg uppercase">Action requise</span>
                                    </div>
                                    <div v-if="immobiliers.length > 0" class="space-y-4">
                                        <div v-for="immo in immobiliers.slice(0, 5)" :key="immo.id" class="flex items-center gap-4 p-5 bg-slate-50 rounded-3xl border border-slate-100 hover:border-principal/30 transition-colors">
                                            <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center text-slate-900 font-black shadow-sm">#{{ immo.id }}</div>
                                            <div class="flex-1">
                                                <p class="font-black text-slate-900">{{ immo.nom }}</p>
                                                <p class="text-xs text-slate-500 font-bold uppercase">{{ immo.type }} • {{ immo.user?.name }}</p>
                                            </div>
                                            <button @click="activeTab = 'boosts'" class="w-10 h-10 bg-principal/10 text-principal rounded-xl flex items-center justify-center hover:bg-principal hover:text-white transition-all">
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div v-else class="text-center py-16">
                                        <div class="w-20 h-20 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6">
                                            <i class="fas fa-check text-3xl"></i>
                                        </div>
                                        <p class="font-black text-slate-900 text-lg">Tout est à jour !</p>
                                        <p class="text-slate-500 mt-2">Aucune demande de boost en attente de validation.</p>
                                    </div>
                                </div>

                                <!-- Quick Links -->
                                <div class="bg-slate-900 p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden text-white">
                                    <div class="absolute top-0 right-0 w-64 h-64 bg-principal/20 rounded-full blur-3xl -mr-32 -mt-32"></div>
                                    <h3 class="text-xl font-black mb-8 relative z-10">Raccourcis rapides</h3>
                                    <div class="grid grid-cols-2 gap-4 relative z-10">
                                        <Link :href="route('admin.blog.create')" class="p-6 bg-white/10 hover:bg-white/20 rounded-3xl transition-all flex flex-col gap-4 group">
                                            <i class="fas fa-pen-nib text-2xl text-principal group-hover:scale-110 transition-transform"></i>
                                            <span class="font-bold text-sm">Écrire un article</span>
                                        </Link>
                                        <button @click="activeTab = 'users'" class="p-6 bg-white/10 hover:bg-white/20 rounded-3xl transition-all flex flex-col gap-4 group text-left">
                                            <i class="fas fa-user-plus text-2xl text-emerald-400 group-hover:scale-110 transition-transform"></i>
                                            <span class="font-bold text-sm">Voir utilisateurs</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB: Boosts -->
                        <div v-if="activeTab === 'boosts'" class="space-y-6 animate-fadeIn">
                            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                                <div class="p-8 border-b border-slate-50 bg-slate-50/30">
                                    <h3 class="text-xl font-black text-slate-900">Validation des Boosts</h3>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left">
                                        <thead>
                                            <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                                                <th class="px-8 py-5">Annonce</th>
                                                <th class="px-8 py-5">Vendeur</th>
                                                <th class="px-8 py-5">Montant</th>
                                                <th class="px-8 py-5 text-right">Décision</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-50">
                                            <tr v-for="immo in immobiliers" :key="immo.id" class="hover:bg-slate-50/50 transition-colors">
                                                <td class="px-8 py-6">
                                                    <p class="font-black text-slate-900">{{ immo.nom }}</p>
                                                    <p class="text-xs text-slate-500 font-bold uppercase">{{ immo.type }} • {{ immo.region }}</p>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <p class="font-bold text-slate-700">{{ immo.user?.name }}</p>
                                                    <p class="text-xs text-slate-400 font-mono">{{ immo.user?.phone }}</p>
                                                </td>
                                                <td class="px-8 py-6 font-black text-principal">{{ formatPrice(immo.prix) }}</td>
                                                <td class="px-8 py-6 text-right">
                                                    <div class="flex justify-end gap-2">
                                                        <button @click="approveBoost(immo.id)" class="px-5 py-2.5 bg-emerald-500 text-white rounded-xl font-black text-[10px] hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-100 uppercase tracking-wider">Valider</button>
                                                        <button class="px-5 py-2.5 bg-slate-100 text-slate-400 rounded-xl font-black text-[10px] hover:bg-red-50 hover:text-red-500 transition-all uppercase tracking-wider">Rejeter</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- TAB: Users -->
                        <div v-if="activeTab === 'users'" class="space-y-6 animate-fadeIn">
                            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                                <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-slate-50/30">
                                    <h3 class="text-xl font-black text-slate-900">Annuaire Utilisateurs</h3>
                                    <div class="relative w-full md:w-80">
                                        <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                        <input v-model="searchQuery" type="text" placeholder="Nom, email, tel..." class="w-full pl-12 pr-5 py-3 bg-white border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-principal/10 focus:border-principal transition-all">
                                    </div>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left">
                                        <thead>
                                            <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                                                <th class="px-8 py-5">Identité</th>
                                                <th class="px-8 py-5">Contact</th>
                                                <th class="px-8 py-5">Rôle</th>
                                                <th class="px-8 py-5 text-right">Modération</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-50">
                                            <tr v-for="user in filteredUsers" :key="user.id" class="hover:bg-slate-50/50 transition-colors">
                                                <td class="px-8 py-6">
                                                    <div class="flex items-center gap-4">
                                                        <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center font-black text-slate-400 text-xl">{{ user.name?.charAt(0) }}</div>
                                                        <div>
                                                            <p class="font-black text-slate-900">{{ user.name }}</p>
                                                            <p class="text-xs text-slate-400">{{ user.email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-8 py-6 text-sm font-black text-slate-600 font-mono">{{ user.phone || 'N/A' }}</td>
                                                <td class="px-8 py-6">
                                                    <span :class="user.role === 'admin' ? 'bg-slate-900 text-white' : 'bg-principal/10 text-principal'" class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.1em]">
                                                        {{ user.role }}
                                                    </span>
                                                </td>
                                                <td class="px-8 py-6 text-right">
                                                    <button @click="deleteUser(user.id)" class="w-10 h-10 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all" v-if="user.role !== 'admin'">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- TAB: Properties -->
                        <div v-if="activeTab === 'properties'" class="space-y-6 animate-fadeIn">
                            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                                <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-slate-50/30">
                                    <h3 class="text-xl font-black text-slate-900">Annonces Immobilières</h3>
                                    <div class="relative w-full md:w-80">
                                        <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                        <input v-model="propertySearch" type="text" placeholder="Rechercher un bien..." class="w-full pl-12 pr-5 py-3 bg-white border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-principal/10 focus:border-principal transition-all">
                                    </div>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left">
                                        <thead>
                                            <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                                                <th class="px-8 py-5">Bien</th>
                                                <th class="px-8 py-5">Vendeur</th>
                                                <th class="px-8 py-5">Statut</th>
                                                <th class="px-8 py-5 text-right">Modération</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-50">
                                            <tr v-for="immo in filteredImmobiliers" :key="immo.id">
                                                <td class="px-8 py-6">
                                                    <p class="font-black text-slate-900">{{ immo.nom }}</p>
                                                    <p class="text-xs text-slate-500 font-bold uppercase">{{ immo.type }} • {{ immo.region }}</p>
                                                </td>
                                                <td class="px-8 py-6 text-sm font-bold text-slate-600">{{ immo.user?.name }}</td>
                                                <td class="px-8 py-6">
                                                    <span :class="{
                                                        'bg-emerald-100 text-emerald-700': immo.status === 'accepter',
                                                        'bg-orange-100 text-orange-700': immo.status === 'pending',
                                                        'bg-slate-100 text-slate-500': !immo.status
                                                    }" class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider">
                                                        {{ immo.status || 'En attente' }}
                                                    </span>
                                                </td>
                                                <td class="px-8 py-6 text-right">
                                                    <div class="flex justify-end gap-2">
                                                        <a :href="`/statusImmobilier/${immo.id}`" class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white transition-all flex items-center justify-center">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button @click="deleteProperty(immo.id)" class="w-10 h-10 bg-red-50 text-red-300 hover:bg-red-500 hover:text-white rounded-xl transition-all">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- TAB: Vehicles -->
                        <div v-if="activeTab === 'vehicles'" class="space-y-6 animate-fadeIn">
                            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                                <div class="p-8 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-slate-50/30">
                                    <h3 class="text-xl font-black text-slate-900">Catalogue Automobiles</h3>
                                    <div class="relative w-full md:w-80">
                                        <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                        <input v-model="vehicleSearch" type="text" placeholder="Rechercher un véhicule..." class="w-full pl-12 pr-5 py-3 bg-white border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-principal/10 focus:border-principal transition-all">
                                    </div>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left">
                                        <thead>
                                            <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                                                <th class="px-8 py-5">Modèle / Marque</th>
                                                <th class="px-8 py-5">Propriétaire</th>
                                                <th class="px-8 py-5">Prix de vente</th>
                                                <th class="px-8 py-5 text-right">Modération</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-50">
                                            <tr v-for="car in filteredVoitures" :key="car.id">
                                                <td class="px-8 py-6">
                                                    <p class="font-black text-slate-900">{{ car.nom }}</p>
                                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">{{ car.marque }} {{ car.model }}</p>
                                                </td>
                                                <td class="px-8 py-6 text-sm font-bold text-slate-600">{{ car.user?.name }}</td>
                                                <td class="px-8 py-6 font-black text-principal">{{ formatPrice(car.prix) }}</td>
                                                <td class="px-8 py-6 text-right">
                                                    <div class="flex justify-end gap-2">
                                                        <a :href="`/statusVehicule/${car.id}`" class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl hover:bg-blue-500 hover:text-white transition-all flex items-center justify-center">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button @click="deleteVehicle(car.id)" class="w-10 h-10 bg-red-50 text-red-300 hover:bg-red-500 hover:text-white rounded-xl transition-all">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Toast System -->
            <Toast :show="showToast" :message="toastMessage" @close="showToast = false" />
        </div>
    </AppLayout>
</template>

<style scoped>
.animate-fadeIn { animation: fadeIn 0.4s ease-out; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

/* Custom table styling */
th { user-select: none; }
tr:last-child { border-bottom: none; }
</style>
