<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />
        <Banner />
        <!-- NAVBAR MODERNE DASHBOARD STYLÉE -->
        <nav class="dashboard-navbar fixed top-0 left-0 w-full z-50 flex items-center justify-between px-6 py-3">
            <!-- Bloc gauche : liens principaux -->
            <div class="flex items-center gap-6">
                <Link :href="route('home')" class="nav-link flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 12l7-7m-7 7l7 7" /></svg>
                    Accueil
                </Link>
                <Link :href="route('dashboard')" class="nav-link">Dashboard</Link>
                <Link :href="route('publier')" class="nav-link">Publier une annonce</Link>
            </div>
            <!-- Logo centré -->
            <div class="flex-1 flex justify-center">
                <Link :href="route('home')" class="logo-link flex items-center justify-center">
                    <img class="h-10 md:h-12 w-auto logo-img" src="/storage/slide/NoflayHub.png" alt="NoflayHub Logo" />
                                </Link>
                            </div>
            <!-- Menu utilisateur à droite -->
            <div class="flex items-center gap-4">
                <template v-if="$page.props.auth && $page.props.auth.user">
                    <div class="relative group">
                        <button class="flex items-center gap-2 focus:outline-none avatar-btn">
                            <img v-if="$page.props.auth.user.profile_photo_url" :src="$page.props.auth.user.profile_photo_url" class="h-9 w-9 rounded-full object-cover border-2 border-principal shadow avatar-img" alt="avatar" />
                            <span class="font-semibold text-gray-700">{{ $page.props.auth.user.name }}</span>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                                    </button>
                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2 opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition-all duration-200 z-50">
                            <Link :href="route('profile.show')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</Link>
                            <Link v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">API Tokens</Link>
                            <div class="border-t my-1"></div>
                                        <form @submit.prevent="logout">
                                <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Se déconnecter</button>
                            </form>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <Link :href="route('login')" class="px-5 py-2 bg-principal text-white rounded-lg font-semibold hover:bg-principal/90 transition-all duration-300 shadow-md">Se connecter</Link>
                </template>
                </div>
            </nav>
        <div class="pt-24 min-h-screen bg-gray-100">
                <slot />
        </div>
    </div>
</template>

<style scoped>
.dashboard-navbar {
    background: linear-gradient(120deg, rgba(255,255,255,0.85) 60%, #e0e7efcc 100%);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border-bottom: 2px solid var(--color-principal, #eb2d53);
    box-shadow: 0 8px 32px 0 rgba(99, 102, 241, 0.10), 0 1.5px 0 0 var(--color-principal, #eb2d53);
    transition: background 0.4s cubic-bezier(.4,0,.2,1);
}
.nav-link {
    position: relative;
    font-weight: 600;
    color: #444;
    padding: 0.5rem 0.75rem;
    border-radius: 0.5rem;
    transition: color 0.3s, background 0.3s;
    overflow: hidden;
}
.nav-link::after {
    content: '';
    position: absolute;
    left: 0; right: 0; bottom: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--color-principal, #eb2d53), #625bff);
    border-radius: 2px;
    transform: scaleX(0);
    transition: transform 0.3s cubic-bezier(.4,0,.2,1);
}
.nav-link:hover {
    color: var(--color-principal, #eb2d53);
    background: rgba(235,45,83,0.07);
}
.nav-link:hover::after {
    transform: scaleX(1);
}
.logo-link {
    transition: transform 0.3s cubic-bezier(.4,0,.2,1), box-shadow 0.3s;
}
.logo-link:hover .logo-img {
    transform: translateY(-4px) scale(1.07) rotate(-2deg);
    box-shadow: 0 8px 32px 0 #eb2d53cc;
}
.logo-img {
    transition: transform 0.3s, box-shadow 0.3s;
}
.avatar-btn .avatar-img {
    box-shadow: 0 0 0 0 #eb2d53, 0 2px 8px 0 #625bff33;
    transition: box-shadow 0.3s, border-color 0.3s;
}
.avatar-btn:hover .avatar-img {
    box-shadow: 0 0 0 4px #eb2d5355, 0 2px 16px 0 #625bff55;
    border-color: #625bff;
}
</style>
