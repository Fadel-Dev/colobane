<script setup>
import { ref } from 'vue';
const showMenu = ref(false);

const props = defineProps({
    maisons: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})
</script>

<template>
    <nav class="fixed top-0 left-0 w-full z-50 bg-white border-b border-gray-200 border-bottom-1" 
         role="navigation" 
         aria-label="Navigation principale">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a :href="route('home')" 
                       class="flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-principal focus:ring-offset-2 rounded"
                       aria-label="Retour à l'accueil">
                        <img class="h-12 w-auto" 
                             :src="'/storage/slide/NoflayHub.png'" 
                             alt="NoflayHub Logo"
                             loading="eager"
                             decoding="async">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8" role="menubar">
                    <a :href="route('home')"
                       class="nav-link group relative text-gray-700 hover:text-principal transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-principal focus:ring-offset-2 rounded px-2"
                       role="menuitem"
                       aria-current="page">
                        Accueil
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-principal group-hover:w-full transition-all duration-300" aria-hidden="true"></span>
                    </a>

                    <a href="https://sn.noflayhub.com/#Blog" 
                       target="_blank"
                       rel="noopener noreferrer"
                       class="nav-link group relative text-gray-700 hover:text-principal transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-principal focus:ring-offset-2 rounded px-2"
                       role="menuitem"
                       aria-label="Blog (ouvre dans un nouvel onglet)">
                        Blog
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-principal group-hover:w-full transition-all duration-300" aria-hidden="true"></span>
                    </a>

                    <template v-if="$page.props.auth.user">
                        <a :href="route('favoris')"
                           class="nav-link group relative text-gray-700 hover:text-principal transition-colors duration-300 flex items-center">
                            <i class="bi bi-heart mr-1"></i>
                            Favoris
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-principal group-hover:w-full transition-all duration-300"></span>
                        </a>
                        <a :href="route('notifications')"
                           class="nav-link group relative text-gray-700 hover:text-principal transition-colors duration-300 flex items-center">
                            <i class="bi bi-bell mr-1"></i>
                            Notifications
                            <span v-if="$page.props.unreadNotificationsCount > 0"
                                  class="ml-1 bg-red-500 text-white text-xs rounded-full px-2 py-0.5 font-bold">
                                {{ $page.props.unreadNotificationsCount }}
                            </span>
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-principal group-hover:w-full transition-all duration-300"></span>
                        </a>
                        <a href="https://sn.noflayhub.com/#Services" target="_blank"
                           class="nav-link group relative text-gray-700 hover:text-principal transition-colors duration-300">
                            Services
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-principal group-hover:w-full transition-all duration-300"></span>
                        </a>

                        <a href="https://wa.me/221 775266864?text=Exprimez%20vos%20besoins%20:%20trouvez%20votre%20futur%20logement,%20terrain%20ou%20véhicule%20en%20quelques%20clics."
                           target="_blank"
                           class="nav-link group relative text-gray-700 hover:text-principal transition-colors duration-300">
                            Contact
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-principal group-hover:w-full transition-all duration-300"></span>
                        </a>

                        <SwitchBtn />

                        <a :href="route('dashboard')"
                           class="px-6 py-2.5 bg-principal text-white rounded-lg hover:bg-principal/90 transition-all duration-300 transform hover:scale-105">
                            Dashboard
                        </a>
                    </template>

                    <template v-else>
                        <a href="https://sn.noflayhub.com/#Services" target="_blank"
                           class="nav-link group relative text-gray-700 hover:text-principal transition-colors duration-300">
                            Services
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-principal group-hover:w-full transition-all duration-300"></span>
                        </a>

                        <a :href="route('home')"
                           class="nav-link group relative text-gray-700 hover:text-principal transition-colors duration-300">
                            Contact
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-principal group-hover:w-full transition-all duration-300"></span>
                        </a>

                        <SwitchBtn />

                        <a :href="route('login')"
                           class="px-6 py-2.5 bg-principal text-white rounded-lg hover:bg-principal/90 transition-all duration-300 transform hover:scale-105">
                            Se connecter
                        </a>
                    </template>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="showMenu = !showMenu"
                            :aria-expanded="showMenu"
                            :aria-label="showMenu ? 'Fermer le menu' : 'Ouvrir le menu'"
                            class="text-gray-700 hover:text-principal focus:outline-none focus:ring-2 focus:ring-principal focus:ring-offset-2 rounded transition-colors duration-300">
                        <svg v-if="!showMenu" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg v-else class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div v-show="showMenu"
             class="md:hidden absolute top-20 left-0 w-full bg-white border-b border-gray-200"
             role="menu"
             :aria-label="showMenu ? 'Menu de navigation mobile' : ''">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <template v-if="$page.props.auth.user">
                    <a :href="route('home')"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-principal hover:bg-gray-50 transition-all duration-300">
                        Accueil
                    </a>
                    <a href="https://sn.noflayhub.com/#Blog" target="_blank"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-principal hover:bg-gray-50 transition-all duration-300">
                        Blog
                    </a>
                    <a href="https://sn.noflayhub.com/#Services" target="_blank"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-principal hover:bg-gray-50 transition-all duration-300">
                        Services
                    </a>
                    <a href="https://wa.me/221 775266864?text=Exprimez%20vos%20besoins%20:%20trouvez%20votre%20futur%20logement,%20terrain%20ou%20véhicule%20en%20quelques%20clics."
                       target="_blank"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-principal hover:bg-gray-50 transition-all duration-300">
                        Contact
                    </a>
                    <div class="px-3 py-2">
                        <SwitchBtn />
                    </div>
                    <a :href="route('dashboard')"
                       class="block px-3 py-2 rounded-md text-base font-medium text-white bg-principal hover:bg-principal/90 transition-all duration-300">
                        Dashboard
                    </a>
                </template>

                <template v-else>
                    <a :href="route('home')"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-principal hover:bg-gray-50 transition-all duration-300">
                        Accueil
                    </a>
                    <a href="https://sn.noflayhub.com/#Services" target="_blank"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-principal hover:bg-gray-50 transition-all duration-300">
                        Services
                    </a>
                    <a :href="route('home')"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-principal hover:bg-gray-50 transition-all duration-300">
                        Contact
                    </a>
                    <div class="px-3 py-2">
                        <SwitchBtn />
                    </div>
                    <a :href="route('login')"
                       class="block px-3 py-2 rounded-md text-base font-medium text-white bg-principal hover:bg-principal/90 transition-all duration-300">
                        Se connecter
                    </a>
                </template>
            </div>
        </div>
    </nav>
</template>

<style scoped>
.nav-link {
    @apply text-base font-medium;
}

/* Animation pour le menu mobile */
.md\:hidden {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Effet de glassmorphisme */
.backdrop-blur-lg {
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
}

/* Effet de hover sur les boutons */
.hover\:scale-105:hover {
    transform: scale(1.05);
}

/* Transition fluide pour tous les éléments */
* {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}
</style>
