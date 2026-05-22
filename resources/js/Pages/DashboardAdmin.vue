<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, computed, watch, onMounted } from 'vue';
import { router, Link, usePage } from '@inertiajs/vue3';
import Toast from '@/Components/Toast.vue';

const props = defineProps({
    immobiliers: Array, // Pending boost requests
    voituresPending: Array,
    immobilliersBoosted: Array,
    immobilliersBoosting: Array,
    voituresBoosting: Array,
    immobiliersArretes: Array,
    allUsers: Object, // Paginated
    allImmobiliers: Object, // Paginated
    allVoitures: Object, // Paginated
    allAlerts: Array,
    blogPostsCount: Number,
    userStats: Object,
    businessStats: Object,
    filters: Object,
});

const page = usePage();
const route = (name, params) => {
    let url = page.props.ziggy?.urls?.[name] || '#';
    if (params) {
        if (typeof params === 'object') {
            for (const key in params) {
                url = url.replace(`{${key}}`, params[key]);
            }
        } else {
            url = url.replace(/\{.*\}/, params);
        }
    }
    return url;
};

const activeTab = ref('overview');
const isLoading = ref(false);

// User CRUD State
const showUserModal = ref(false);
const editingUser = ref(null);
const userForm = ref({
    name: '',
    email: '',
    phone: '',
    role: 'user',
    password: '',
});

const userSearch = ref(props.filters?.user_search || '');
const roleFilter = ref(props.filters?.role || 'all');
const propertySearch = ref('');
const vehicleSearch = ref('');

const showToast = ref(false);
const toastMessage = ref('');

// Filtered Users (Local filter for the current page of results)
const filteredUsers = computed(() => {
    const data = props.allUsers?.data || [];
    if (!userSearch.value) return data;
    const search = userSearch.value.toLowerCase();
    return data.filter(u => 
        u.name?.toLowerCase().includes(search) || 
        u.email?.toLowerCase().includes(search) || 
        u.phone?.includes(search)
    );
});

// Filtered Properties
const filteredImmobiliers = computed(() => {
    const data = props.allImmobiliers?.data || [];
    if (!propertySearch.value) return data;
    const search = propertySearch.value.toLowerCase();
    return data.filter(i => 
        i.nom?.toLowerCase().includes(search) || 
        i.region?.toLowerCase().includes(search) ||
        i.type?.toLowerCase().includes(search)
    );
});

// Filtered Vehicles
const filteredVoitures = computed(() => {
    const data = props.allVoitures?.data || [];
    if (!vehicleSearch.value) return data;
    const search = vehicleSearch.value.toLowerCase();
    return data.filter(v => 
        v.nom?.toLowerCase().includes(search) || 
        v.marque?.toLowerCase().includes(search) ||
        v.model?.toLowerCase().includes(search)
    );
});

// Pending items for the overview and boosts tab
const allPendingBoosts = computed(() => {
    const immo = (props.immobiliers || []).map(item => ({ ...item, product_type: 'immobilier' }));
    const vehi = (props.voituresPending || []).map(item => ({ ...item, product_type: 'voiture' }));
    return [...immo, ...vehi].sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at));
});

// Sync user search with URL
watch([userSearch, roleFilter], ([newSearch, newRole]) => {
    if (activeTab.value === 'users') {
        router.get(route('admin.dashboard'), {
            user_search: newSearch,
            role: newRole,
            tab: 'users'
        }, {
            preserveState: true,
            preserveScroll: true,
            replace: true
        });
    }
});

// Admin Actions
const openUserModal = (user = null) => {
    if (user) {
        editingUser.value = user;
        userForm.value = {
            name: user.name,
            email: user.email,
            phone: user.phone,
            role: user.role,
            password: '',
        };
    } else {
        editingUser.value = null;
        userForm.value = { name: '', email: '', phone: '', role: 'user', password: '' };
    }
    showUserModal.value = true;
};

const submitUser = () => {
    const routeName = editingUser.value ? 'admin.users.update' : 'admin.users.store';
    const routeParams = editingUser.value ? { id: editingUser.value.id } : {};
    const method = editingUser.value ? 'put' : 'post';

    router[method](route(routeName, routeParams), userForm.value, {
        onSuccess: () => {
            showUserModal.value = false;
            toastMessage.value = editingUser.value ? "Utilisateur mis à jour" : "Utilisateur créé";
            showToast.value = true;
        },
    });
};

const deleteUser = (id) => {
    if (confirm('Action irréversible : Supprimer cet utilisateur ?')) {
        router.delete(`/admin/users/${id}`, {
            onSuccess: () => { toastMessage.value = "Utilisateur supprimé"; showToast.value = true; }
        });
    }
};

const approveBoost = async (id, type = 'immobilier') => {
    if (!confirm('Valider ce boost ?')) return;
    router.post(`/boost-request/${id}/approve`, { type }, {
        onSuccess: () => { toastMessage.value = "Boost activé !"; showToast.value = true; }
    });
};

const stopBoost = async (id, type = 'immobilier') => {
    if (!confirm('Arrêter ce boost ?')) return;
    router.post(`/boost-request/${id}/stop`, { type }, {
        onSuccess: () => { toastMessage.value = "Boost arrêté"; showToast.value = true; }
    });
};

const deleteProperty = (id) => {
    if (confirm('Supprimer cette annonce ?')) {
        router.delete(`/admin/immobilier/${id}`, {
            onSuccess: () => { toastMessage.value = "Annonce supprimée"; showToast.value = true; }
        });
    }
};

const deleteVehicle = (id) => {
    if (confirm('Supprimer ce véhicule ?')) {
        router.delete(`/admin/voiture/${id}`, {
            onSuccess: () => { toastMessage.value = "Annonce supprimée"; showToast.value = true; }
        });
    }
};

const sortBy = (field) => {
    const currentOrder = props.filters?.order || 'desc';
    const newOrder = props.filters?.sort_by === field && currentOrder === 'desc' ? 'asc' : 'desc';
    
    router.get(route('admin.dashboard'), {
        ...props.filters,
        sort_by: field,
        order: newOrder,
        tab: 'users'
    }, { preserveState: true });
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
        day: '2-digit', month: 'short', year: 'numeric'
    });
};

const mainStats = computed(() => [
    { 
        title: 'Chiffre d\'Affaires', 
        value: formatPrice(props.businessStats?.totalRevenue || 0), 
        trend: '+12.5%', 
        trendUp: true,
        icon: 'fas fa-wallet',
        color: 'text-emerald-600',
        bgColor: 'bg-emerald-50'
    },
    { 
        title: 'Utilisateurs Totaux', 
        value: props.allUsers?.total || 0, 
        trend: `+${props.userStats?.last_24h || 0} aujourd'hui`, 
        trendUp: true,
        icon: 'fas fa-users',
        color: 'text-blue-600',
        bgColor: 'bg-blue-50'
    },
    { 
        title: 'Catalogue Global', 
        value: (props.allImmobiliers?.total || 0) + (props.allVoitures?.total || 0), 
        trend: 'Actifs', 
        trendUp: true,
        icon: 'fas fa-boxes',
        color: 'text-purple-600',
        bgColor: 'bg-purple-50'
    },
    { 
        title: 'Boosts Actifs', 
        value: (props.immobilliersBoosting?.length || 0) + (props.voituresBoosting?.length || 0), 
        trend: 'Conversion', 
        trendUp: true,
        icon: 'fas fa-bolt',
        color: 'text-amber-600',
        bgColor: 'bg-amber-50'
    },
]);

// Initial tab from URL
onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('tab')) {
        activeTab.value = urlParams.get('tab');
    }
});
</script>

<template>
    <AppLayout title="Console Pro">
        <div class="min-h-screen bg-[#F1F5F9] font-sans text-slate-900 pt-16 lg:pt-0">
            <!-- Sidebar Desktop -->
            <aside class="fixed left-0 top-0 bottom-0 w-72 bg-[#0F172A] text-slate-400 z-40 hidden lg:flex flex-col shadow-2xl">
                <div class="p-8 flex-1 overflow-y-auto scrollbar-hide">
                    <div class="flex items-center gap-3 mb-10">
                        <div class="w-10 h-10 bg-principal rounded-xl flex items-center justify-center text-white shadow-lg shadow-principal/20">
                            <span class="font-black">NH</span>
                        </div>
                        <span class="text-xl font-black text-white tracking-tight">Noflay<span class="text-principal">Hub</span></span>
                    </div>

                    <nav class="space-y-1">
                        <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4 px-4">Menu Principal</div>
                        <button v-for="tab in [
                            {id: 'overview', name: 'Dashboard', icon: 'fas fa-th-large'},
                            {id: 'boosts', name: 'Boosts & Pubs', icon: 'fas fa-bolt', count: allPendingBoosts.length},
                            {id: 'users', name: 'Utilisateurs', icon: 'fas fa-users'},
                            {id: 'properties', name: 'Immobiliers', icon: 'fas fa-home'},
                            {id: 'vehicles', name: 'Automobiles', icon: 'fas fa-car'},
                        ]" :key="tab.id"
                        @click="activeTab = tab.id"
                        :class="activeTab === tab.id ? 'bg-white/10 text-white shadow-sm ring-1 ring-white/20' : 'hover:text-white hover:bg-white/5'"
                        class="w-full flex items-center justify-between px-4 py-3.5 rounded-xl font-bold text-sm transition-all group">
                            <div class="flex items-center gap-4">
                                <i :class="tab.icon" class="w-5 text-center opacity-70 group-hover:opacity-100 group-hover:scale-110 transition-all"></i>
                                {{ tab.name }}
                            </div>
                            <span v-if="tab.count" class="bg-principal text-white text-[10px] px-2 py-0.5 rounded-full shadow-lg shadow-principal/20">{{ tab.count }}</span>
                        </button>
                    </nav>

                    <div class="mt-12">
                        <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4 px-4">Extensions</div>
                        <Link :href="route('admin.blog.index')" class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl font-bold text-sm hover:text-white hover:bg-white/5 transition-all group">
                            <i class="fas fa-newspaper w-5 text-center opacity-70 group-hover:opacity-100"></i>
                            Blog Officiel
                        </Link>
                    </div>
                </div>

                <div class="p-8">
                    <div class="bg-white/5 rounded-2xl p-4 border border-white/10 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-principal flex items-center justify-center text-white font-black">A</div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-black text-white truncate">Administrateur</p>
                            <p class="text-[10px] text-slate-500 truncate">Session active</p>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="lg:ml-72 min-h-screen pb-20">
                <!-- Top Navbar -->
                <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-30 px-8 py-4">
                    <div class="max-w-[1400px] mx-auto flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-1">{{ activeTab }}</h2>
                            <h1 class="text-2xl font-black text-slate-900 tracking-tight">
                                {{ activeTab === 'overview' ? 'Vue d\'ensemble' : activeTab.charAt(0).toUpperCase() + activeTab.slice(1) }}
                            </h1>
                        </div>
                        <div class="flex items-center gap-4">
                            <button @click="router.reload()" class="w-10 h-10 flex items-center justify-center bg-slate-50 text-slate-400 rounded-xl hover:text-principal hover:bg-white hover:shadow-md transition-all">
                                <i class="fas fa-sync"></i>
                            </button>
                            <div class="h-8 w-px bg-slate-200"></div>
                            <Link :href="route('home')" class="px-6 py-2.5 bg-slate-900 text-white rounded-xl font-black text-sm shadow-xl shadow-slate-200 hover:scale-105 active:scale-95 transition-all">
                                Aller sur le site
                            </Link>
                        </div>
                    </div>
                </header>

                <div class="px-8 py-8 max-w-[1400px] mx-auto">
                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
                        <div v-for="stat in mainStats" :key="stat.title" class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-200/60 hover:shadow-xl hover:-translate-y-1 transition-all duration-500 group">
                            <div class="flex items-start justify-between mb-6">
                                <div :class="`w-14 h-14 rounded-2xl ${stat.bgColor} ${stat.color} flex items-center justify-center text-xl shadow-inner group-hover:scale-110 transition-transform`">
                                    <i :class="stat.icon"></i>
                                </div>
                                <span :class="stat.trendUp ? 'text-emerald-500 bg-emerald-50' : 'text-rose-500 bg-red-50'" class="px-3 py-1 rounded-full text-[10px] font-black">
                                    {{ stat.trend }}
                                </span>
                            </div>
                            <h3 class="text-4xl font-black text-slate-900 mb-2 tracking-tighter">{{ stat.value }}</h3>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">{{ stat.title }}</p>
                        </div>
                    </div>

                    <!-- TAB: Overview -->
                    <div v-if="activeTab === 'overview'" class="space-y-8 animate-fadeIn">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <!-- User Growth Widget -->
                            <div class="lg:col-span-2 bg-white p-8 rounded-[3rem] shadow-sm border border-slate-200/60">
                                <div class="flex items-center justify-between mb-10">
                                    <div>
                                        <h3 class="text-xl font-black text-slate-900 tracking-tight">Croissance de la Communauté</h3>
                                        <p class="text-sm text-slate-400 font-bold">Nouveaux inscrits par période</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <div class="w-3 h-3 bg-principal rounded-full animate-pulse"></div>
                                        <span class="text-[10px] font-black text-principal uppercase tracking-widest">En temps réel</span>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                                    <div v-for="period in [
                                        {l: 'Dernières 24h', v: userStats.last_24h, c: 'from-blue-500 to-indigo-600'},
                                        {l: 'Dernières 48h', v: userStats.last_48h, c: 'from-cyan-500 to-teal-600'},
                                        {l: '7 Jours', v: userStats.last_week, c: 'from-purple-500 to-pink-600'},
                                        {l: '30 Jours', v: userStats.last_month, c: 'from-orange-500 to-red-600'},
                                    ]" :key="period.l" class="relative group cursor-default">
                                        <div :class="`h-24 rounded-3xl bg-gradient-to-br ${period.c} p-5 flex flex-col justify-end text-white shadow-lg overflow-hidden`">
                                            <div class="absolute -top-4 -right-4 w-16 h-16 bg-white/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                                            <p class="text-2xl font-black relative z-10">{{ period.v }}</p>
                                            <p class="text-[9px] font-black uppercase tracking-widest opacity-80 relative z-10">{{ period.l }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-12 pt-10 border-t border-slate-100">
                                    <div class="flex items-center justify-between mb-6">
                                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest">Top Régions Actives</h4>
                                        <Link href="/p/immobilier" class="text-xs font-black text-principal hover:underline">Voir la carte</Link>
                                    </div>
                                    <div class="space-y-4">
                                        <div v-for="reg in businessStats.topRegions" :key="reg.region" class="space-y-2">
                                            <div class="flex justify-between text-xs font-bold">
                                                <span class="text-slate-600">{{ reg.region }}</span>
                                                <span class="text-slate-900">{{ reg.count }} annonces</span>
                                            </div>
                                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                                <div :style="`width: ${Math.min(100, (reg.count / businessStats.topRegions[0].count) * 100)}%`" class="h-full bg-principal rounded-full shadow-sm"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Urgent Tasks Widget -->
                            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-200/60 flex flex-col">
                                <div class="flex items-center justify-between mb-10">
                                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Tâches Urgentes</h3>
                                    <span v-if="allPendingBoosts.length > 0" class="w-3 h-3 bg-red-500 rounded-full animate-ping"></span>
                                </div>

                                <div v-if="allPendingBoosts.length > 0" class="space-y-4 flex-1">
                                    <div v-for="item in allPendingBoosts.slice(0, 4)" :key="item.id + item.product_type" class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 hover:bg-white hover:shadow-xl hover:border-principal/20 transition-all duration-300 group">
                                        <div class="flex items-center gap-4 mb-4">
                                            <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-principal font-black shadow-sm group-hover:bg-principal group-hover:text-white transition-colors">
                                                #{{ item.id }}
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="font-black text-slate-900 truncate">{{ item.nom }}</p>
                                                <p class="text-[10px] text-slate-400 font-bold uppercase">{{ item.product_type }}</p>
                                            </div>
                                        </div>
                                        <button @click="activeTab = 'boosts'" class="w-full py-2.5 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-principal transition-all">Valider la demande</button>
                                    </div>
                                    <div v-if="allPendingBoosts.length > 4" class="text-center pt-4">
                                        <button @click="activeTab = 'boosts'" class="text-xs font-black text-slate-400 hover:text-principal transition-colors">Et {{ allPendingBoosts.length - 4 }} autres demandes...</button>
                                    </div>
                                </div>
                                <div v-else class="flex-1 flex flex-col items-center justify-center text-center py-10 opacity-40 grayscale">
                                    <i class="fas fa-coffee text-5xl mb-6"></i>
                                    <p class="font-black text-lg">C'est calme !</p>
                                    <p class="text-sm font-bold">Toutes les tâches sont traitées.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB: Boosts -->
                    <div v-if="activeTab === 'boosts'" class="animate-fadeIn">
                        <div class="bg-white rounded-[3rem] shadow-xl border border-slate-200/60 overflow-hidden">
                            <div class="p-10 border-b border-slate-100 flex items-center justify-between">
                                <div>
                                    <h3 class="text-2xl font-black text-slate-900">Demandes de Boost</h3>
                                    <p class="text-slate-400 font-bold text-sm">Gestion des mises en avant payantes</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="px-4 py-2 bg-slate-50 text-slate-500 rounded-xl text-xs font-black uppercase tracking-widest border border-slate-100">
                                        {{ allPendingBoosts.length }} EN ATTENTE
                                    </span>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="bg-slate-50/50 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                            <th class="px-10 py-6">Informations du Bien</th>
                                            <th class="px-10 py-6">Propriétaire</th>
                                            <th class="px-10 py-6">Valeur</th>
                                            <th class="px-10 py-6 text-right">Actions Pro</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        <tr v-for="item in allPendingBoosts" :key="item.id + item.product_type" class="hover:bg-slate-50/30 transition-colors group">
                                            <td class="px-10 py-8">
                                                <div class="flex items-center gap-5">
                                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 overflow-hidden shadow-inner">
                                                        <img v-if="item.image1" :src="'/storage/' + item.image1" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                        <div v-else class="w-full h-full flex items-center justify-center text-slate-300"><i class="fas fa-image"></i></div>
                                                    </div>
                                                    <div>
                                                        <p class="font-black text-slate-900 text-lg group-hover:text-principal transition-colors">{{ item.nom }}</p>
                                                        <div class="flex gap-2 mt-1">
                                                            <span class="text-[9px] font-black bg-slate-900 text-white px-2 py-0.5 rounded uppercase">{{ item.product_type }}</span>
                                                            <span class="text-[9px] font-black text-slate-400 uppercase">{{ item.region || item.marque }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-10 py-8">
                                                <p class="font-black text-slate-700">{{ item.user?.name }}</p>
                                                <p class="text-xs font-bold text-slate-400 font-mono tracking-tighter">{{ item.user?.phone }}</p>
                                            </td>
                                            <td class="px-10 py-8">
                                                <span class="text-xl font-black text-principal">{{ formatPrice(item.prix) }}</span>
                                            </td>
                                            <td class="px-10 py-8 text-right">
                                                <div class="flex justify-end gap-3">
                                                    <button @click="approveBoost(item.id, item.product_type)" class="px-6 py-3 bg-emerald-500 text-white rounded-2xl font-black text-[11px] hover:bg-emerald-600 hover:shadow-xl hover:shadow-emerald-100 hover:-translate-y-0.5 active:translate-y-0 transition-all uppercase tracking-widest">ACTIVER BOOST</button>
                                                    <button class="w-12 h-12 bg-slate-50 text-slate-300 rounded-2xl flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition-all shadow-inner"><i class="fas fa-trash-can"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr v-if="allPendingBoosts.length === 0">
                                            <td colspan="4" class="px-10 py-24 text-center">
                                                <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                                                    <i class="fas fa-box-open text-slate-200 text-3xl"></i>
                                                </div>
                                                <p class="font-black text-slate-900 text-xl">Rien à signaler</p>
                                                <p class="text-slate-400 font-bold">Toutes les demandes ont été traitées.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- TAB: Users -->
                    <div v-if="activeTab === 'users'" class="animate-fadeIn space-y-8">
                        <!-- Advanced Controls -->
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-200/60 flex flex-col xl:flex-row gap-6 items-center">
                            <div class="relative flex-1 w-full">
                                <i class="fas fa-magnifying-glass absolute left-6 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                <input v-model="userSearch" type="text" placeholder="Rechercher par nom, email ou matricule..." 
                                    class="w-full pl-14 pr-6 py-4 bg-slate-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-principal/10 transition-all placeholder:text-slate-300">
                            </div>
                            <div class="flex w-full xl:w-auto gap-4">
                                <select v-model="roleFilter" class="flex-1 xl:w-56 px-6 py-4 bg-slate-50 border-none rounded-2xl text-sm font-black text-slate-600 focus:ring-4 focus:ring-principal/10 appearance-none">
                                    <option value="all">TOUS LES RÔLES</option>
                                    <option value="admin">ADMINISTRATEURS</option>
                                    <option value="user">UTILISATEURS</option>
                                </select>
                                <button @click="openUserModal()" class="px-8 py-4 bg-principal text-white rounded-2xl font-black text-sm shadow-2xl shadow-principal/30 hover:scale-105 active:scale-95 transition-all flex items-center gap-3 whitespace-nowrap">
                                    <i class="fas fa-plus"></i>
                                    NOUVEL UTILISATEUR
                                </button>
                            </div>
                        </div>

                        <div class="bg-white rounded-[3rem] shadow-xl border border-slate-200/60 overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="bg-slate-50/50 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                                            <th @click="sortBy('name')" class="px-10 py-6 cursor-pointer hover:text-principal">Profil Utilisateur</th>
                                            <th class="px-10 py-6">Privilèges</th>
                                            <th @click="sortBy('created_at')" class="px-10 py-6 cursor-pointer hover:text-principal">Date d'Indexation</th>
                                            <th class="px-10 py-6 text-right">Contrôle</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        <tr v-for="user in filteredUsers" :key="user.id" class="hover:bg-slate-50/30 transition-colors group">
                                            <td class="px-10 py-8">
                                                <div class="flex items-center gap-5">
                                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center text-white text-xl font-black shadow-lg group-hover:scale-110 transition-transform">
                                                        {{ user.name?.charAt(0) }}
                                                    </div>
                                                    <div>
                                                        <p class="font-black text-slate-900 text-lg tracking-tight">{{ user.name }}</p>
                                                        <p class="text-xs font-bold text-slate-400">{{ user.email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-10 py-8">
                                                <span :class="user.role === 'admin' ? 'bg-slate-900 text-white border-slate-900' : 'bg-white text-slate-500 border-slate-200'" 
                                                    class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border-2 shadow-sm">
                                                    {{ user.role }}
                                                </span>
                                            </td>
                                            <td class="px-10 py-8">
                                                <div class="flex items-center gap-2 text-slate-500 font-bold text-xs">
                                                    <i class="far fa-calendar opacity-50"></i>
                                                    {{ formatDate(user.created_at) }}
                                                </div>
                                            </td>
                                            <td class="px-10 py-8 text-right">
                                                <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <button @click="openUserModal(user)" class="w-12 h-12 bg-white text-blue-500 rounded-2xl flex items-center justify-center border border-slate-200 hover:border-blue-500 hover:bg-blue-50 hover:shadow-xl hover:shadow-blue-100 transition-all"><i class="fas fa-pen"></i></button>
                                                    <button @click="deleteUser(user.id)" class="w-12 h-12 bg-white text-rose-500 rounded-2xl flex items-center justify-center border border-slate-200 hover:border-rose-500 hover:bg-rose-50 hover:shadow-xl hover:shadow-rose-100 transition-all" v-if="user.role !== 'admin'"><i class="fas fa-trash-can"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pro Pagination -->
                        <div v-if="allUsers.links.length > 3" class="flex justify-center items-center gap-2 py-4">
                            <Link v-for="link in allUsers.links" :key="link.label"
                                :href="link.url || '#'"
                                :class="[
                                    'h-12 flex items-center justify-center rounded-2xl font-black text-xs transition-all shadow-sm',
                                    link.active ? 'bg-principal text-white px-6 shadow-xl shadow-principal/20 scale-110 z-10' : 'bg-white text-slate-400 px-4 hover:bg-slate-50 hover:text-slate-900 border border-slate-200'
                                ]"
                                v-html="link.label" />
                        </div>
                    </div>

                    <!-- TAB: Properties -->
                    <div v-if="activeTab === 'properties'" class="animate-fadeIn space-y-6">
                        <div class="bg-white rounded-[3rem] shadow-xl border border-slate-200/60 overflow-hidden">
                            <div class="p-10 border-b border-slate-100 flex items-center justify-between">
                                <h3 class="text-2xl font-black text-slate-900">Parc Immobilier</h3>
                                <div class="relative w-80">
                                    <i class="fas fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                    <input v-model="propertySearch" type="text" placeholder="Rechercher une annonce..." class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-[1.5rem] text-sm font-bold">
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="bg-slate-50/50 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                                            <th class="px-10 py-6">Désignation</th>
                                            <th class="px-10 py-6">Vendeur</th>
                                            <th class="px-10 py-6">Prix</th>
                                            <th class="px-10 py-6">Indexation</th>
                                            <th class="px-10 py-6 text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        <tr v-for="immo in filteredImmobiliers" :key="immo.id" class="hover:bg-slate-50/30 transition-colors group">
                                            <td class="px-10 py-8">
                                                <div class="flex items-center gap-5">
                                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 overflow-hidden shadow-inner flex-shrink-0">
                                                        <img v-if="immo.image1" :src="'/storage/' + immo.image1" class="w-full h-full object-cover">
                                                    </div>
                                                    <div>
                                                        <p class="font-black text-slate-900 text-lg">{{ immo.nom }}</p>
                                                        <div class="flex gap-2">
                                                            <span :class="immo.status === 'accepter' ? 'bg-emerald-500' : 'bg-orange-400'" class="w-2 h-2 rounded-full mt-1.5"></span>
                                                            <p class="text-[10px] text-slate-400 font-black uppercase tracking-wider">{{ immo.type }} • {{ immo.region }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-10 py-8 font-bold text-slate-600">{{ immo.user?.name }}</td>
                                            <td class="px-10 py-8 font-black text-slate-900">{{ formatPrice(immo.prix) }}</td>
                                            <td class="px-10 py-8">
                                                <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-[10px] font-black uppercase tracking-widest">{{ immo.status || 'Draft' }}</span>
                                            </td>
                                            <td class="px-10 py-8 text-right">
                                                <div class="flex justify-end gap-2">
                                                    <a :href="`/statusImmobilier/${immo.id}`" class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-blue-500 hover:bg-blue-50 hover:border-blue-200 transition-all"><i class="fas fa-edit"></i></a>
                                                    <button @click="deleteProperty(immo.id)" class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-rose-500 hover:bg-rose-50 hover:border-rose-200 transition-all"><i class="fas fa-trash-can"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- TAB: Vehicles -->
                    <div v-if="activeTab === 'vehicles'" class="animate-fadeIn space-y-6">
                        <div class="bg-white rounded-[3rem] shadow-xl border border-slate-200/60 overflow-hidden">
                            <div class="p-10 border-b border-slate-100 flex items-center justify-between">
                                <h3 class="text-2xl font-black text-slate-900">Inventaire Automobiles</h3>
                                <div class="relative w-80">
                                    <i class="fas fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                    <input v-model="vehicleSearch" type="text" placeholder="Chercher un modèle..." class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-[1.5rem] text-sm font-bold">
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="bg-slate-50/50 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                                            <th class="px-10 py-6">Marque & Modèle</th>
                                            <th class="px-10 py-6">Propriétaire</th>
                                            <th class="px-10 py-6">Prix de Vente</th>
                                            <th class="px-10 py-6 text-right">Contrôle</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        <tr v-for="car in filteredVoitures" :key="car.id" class="hover:bg-slate-50/30 transition-colors group">
                                            <td class="px-10 py-8">
                                                <div class="flex items-center gap-5">
                                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 overflow-hidden shadow-inner flex-shrink-0">
                                                        <img v-if="car.image1" :src="'/storage/' + car.image1" class="w-full h-full object-cover">
                                                    </div>
                                                    <div>
                                                        <p class="font-black text-slate-900 text-lg">{{ car.nom }}</p>
                                                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.1em]">{{ car.marque }} {{ car.model }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-10 py-8 font-bold text-slate-600">{{ car.user?.name }}</td>
                                            <td class="px-10 py-8 font-black text-slate-900">{{ formatPrice(car.prix) }}</td>
                                            <td class="px-10 py-8 text-right">
                                                <div class="flex justify-end gap-2">
                                                    <a :href="`/statusVehicule/${car.id}`" class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-blue-500 hover:bg-blue-50 transition-all"><i class="fas fa-pen"></i></a>
                                                    <button @click="deleteVehicle(car.id)" class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-rose-500 hover:bg-rose-50 transition-all"><i class="fas fa-trash-can"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- User Modal Pro -->
            <div v-if="showUserModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-md z-[100] flex items-center justify-center p-6">
                <div class="bg-white rounded-[3.5rem] shadow-2xl max-w-lg w-full overflow-hidden animate-fadeIn border border-white/20">
                    <div class="p-10 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <div>
                            <h3 class="text-2xl font-black text-slate-900 tracking-tight">{{ editingUser ? 'Mise à jour Profil' : 'Nouvelle Identité' }}</h3>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Configuration des accès</p>
                        </div>
                        <button @click="showUserModal = false" class="w-12 h-12 flex items-center justify-center rounded-2xl hover:bg-slate-200 transition-all text-slate-400">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <form @submit.prevent="submitUser" class="p-10 space-y-8">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 px-2">Identité Complète</label>
                                <input v-model="userForm.name" type="text" required class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-principal focus:ring-0 transition-all font-black text-slate-900 shadow-inner">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 px-2">Adresse Email</label>
                                <input v-model="userForm.email" type="email" required class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-principal focus:ring-0 transition-all font-black text-slate-900 shadow-inner">
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 px-2">Téléphone</label>
                                    <input v-model="userForm.phone" type="text" required class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-principal focus:ring-0 transition-all font-black text-slate-900 shadow-inner">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 px-2">Privilèges</label>
                                    <select v-model="userForm.role" class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-principal focus:ring-0 transition-all font-black text-slate-900 shadow-inner">
                                        <option value="user">UTILISATEUR</option>
                                        <option value="admin">ADMINISTRATEUR</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 px-2">Secret Key {{ editingUser ? '(Optional)' : '' }}</label>
                                <input v-model="userForm.password" type="password" :required="!editingUser" class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-principal focus:ring-0 transition-all font-black text-slate-900 shadow-inner" placeholder="••••••••">
                            </div>
                        </div>
                        <button type="submit" class="w-full py-5 bg-slate-900 text-white rounded-[2rem] font-black shadow-2xl shadow-slate-200 hover:bg-principal hover:-translate-y-1 transition-all uppercase tracking-[0.2em] text-xs">
                            {{ editingUser ? 'Synchroniser les données' : 'Enregistrer le compte' }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Toast Pro -->
            <Toast :show="showToast" :message="toastMessage" @close="showToast = false" />
        </div>
    </AppLayout>
</template>

<style scoped>
.animate-fadeIn { animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
@keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

/* Hide scrollbar but keep functionality */
.scrollbar-hide::-webkit-scrollbar { display: none; }
.scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

/* Table transitions */
tbody tr { transition: all 0.2s ease; }
</style>
