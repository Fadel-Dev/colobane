<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import ChatBot from '@/Components/ChatBot.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);
const showMobileMenu = ref(false);

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

// Navigation menu items
const menuItems = [
    {
        icon: 'dashboard',
        label: 'Tableau de bord',
        href: 'dashboard',
        active: (page) => page.current('dashboard'),
    },
    {
        icon: 'home',
        label: 'Mes annonces',
        href: 'dashboard',
        active: (page) => page.current('dashboard'),
    },
    {
        icon: 'plus',
        label: 'Nouvelle annonce',
        href: 'publier',
        active: (page) => page.current('publier'),
        isPrimary: true,
    },
    {
        icon: 'heart',
        label: 'Favoris',
        href: 'home',
        active: (page) => false,
    },
    {
        icon: 'bell',
        label: 'Notifications',
        href: 'home',
        active: (page) => false,
    },
];
</script>

<template>
    <div>

        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-50">
            <!-- Navigation Bar Premium -->
            <nav class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <!-- Logo -->
                        <Link :href="route('home')" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                            <div class="w-10 h-10 bg-gradient-to-br from-principal to-secondaire rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-principal hidden sm:inline">NoflayHub</span>
                        </Link>

                        <!-- Menu Desktop -->
                        <div class="hidden lg:flex items-center space-x-1">
                            <Link
                                :href="route('dashboard')"
                                class="flex items-center space-x-2 px-4 py-2.5 rounded-lg text-gray-700 hover:bg-gray-100 transition-all font-medium text-sm"
                            >
                                <svg class="w-5 h-5 text-principal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <span>Tableau de bord</span>
                            </Link>
                            <Link
                                :href="route('home')"
                                class="flex items-center space-x-2 px-4 py-2.5 rounded-lg text-gray-700 hover:bg-gray-100 transition-all font-medium text-sm"
                            >
                                <svg class="w-5 h-5 text-principal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span>Accueil</span>
                            </Link>
                        </div>

                        <!-- Right Actions -->
                        <div class="flex items-center space-x-4">
                            <!-- Bouton Nouvelle annonce (Desktop) -->
                            <Link
                                :href="route('publier')"
                                class="hidden md:flex items-center space-x-2 bg-gradient-to-r from-principal to-principal/90 text-white px-5 py-2.5 rounded-lg font-semibold hover:shadow-lg transition-all hover:scale-105 transform"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span>Nouvelle annonce</span>
                            </Link>

                            <!-- User Menu -->
                            <div class="relative">
                                <Dropdown align="right" width="56">
                                    <template #trigger>
                                        <button class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition-all focus:outline-none focus:ring-2 focus:ring-principal/50">
                                            <img v-if="$page.props.jetstream.managesProfilePhotos"
                                                class="h-8 w-8 rounded-full object-cover border-2 border-principal/20"
                                                :src="$page.props.auth.user.profile_photo_url"
                                                :alt="$page.props.auth.user.name">
                                            <div v-else class="h-8 w-8 bg-gradient-to-br from-principal to-secondaire rounded-full flex items-center justify-center text-white text-xs font-bold">
                                                {{ $page.props.auth.user.name.charAt(0).toUpperCase() }}
                                            </div>
                                            <svg class="w-4 h-4 text-gray-600 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </template>

                                    <template #content>
                                        <div class="px-4 py-3 border-b border-gray-200">
                                            <p class="text-sm font-semibold text-gray-900">{{ $page.props.auth.user.name }}</p>
                                            <p class="text-xs text-gray-500">{{ $page.props.auth.user.email }}</p>
                                        </div>

                                        <DropdownLink :href="route('profile.show')" class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span>Paramètres</span>
                                        </DropdownLink>

                                        <div class="border-t border-gray-200 my-1" />

                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button" class="flex items-center space-x-2 text-red-600 hover:bg-red-50">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                <span>Se déconnecter</span>
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>

                            <!-- Mobile Menu Button -->
                            <button
                                @click="showMobileMenu = !showMobileMenu"
                                class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-all focus:outline-none focus:ring-2 focus:ring-principal/50"
                            >
                                <svg v-if="!showMobileMenu" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                <svg v-else class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div v-if="showMobileMenu" class="lg:hidden border-t border-gray-200 bg-white">
                    <div class="px-4 py-3 space-y-2">
                        <Link
                            :href="route('dashboard')"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-all font-medium"
                        >
                            <svg class="w-5 h-5 text-principal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span>Tableau de bord</span>
                        </Link>
                        <Link
                            :href="route('home')"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-all font-medium"
                        >
                            <svg class="w-5 h-5 text-principal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span>Accueil</span>
                        </Link>
                        <Link
                            :href="route('publier')"
                            class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-gradient-to-r from-principal to-principal/90 text-white font-medium hover:shadow-lg transition-all"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Nouvelle annonce</span>
                        </Link>
                    </div>
                </div>
            </nav>

            <!-- Spacer for fixed navbar -->
            <div class="h-16"></div>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>

        <!-- ChatBot Widget -->
        <ChatBot />
    </div>
</template>
