<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const page = usePage();
const route = (name) => {
    return page.props.ziggy?.urls?.[name] || '#';
};

const showMenu = ref(false);
const showUserMenu = ref(false);
const showSearchSuggestions = ref(false);
const searchQuery = ref('');
const searchSuggestions = ref([]);
const selectedSuggestionIndex = ref(-1);
const searchTimeout = ref(null);

const props = defineProps({
    maisons: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

// Méthodes de recherche (similaires à Welcome.vue)
const handleSearchInput = async () => {
    selectedSuggestionIndex.value = -1;
    
    if (searchTimeout.value) {
        clearTimeout(searchTimeout.value);
    }
    
    if (searchQuery.value.length < 2) {
        searchSuggestions.value = [];
        showSearchSuggestions.value = false;
        return;
    }
    
    searchTimeout.value = setTimeout(async () => {
        try {
            const response = await fetch(`/api/search/suggestions?q=${encodeURIComponent(searchQuery.value)}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (response.ok) {
                const data = await response.json();
                searchSuggestions.value = data.suggestions || [];
                showSearchSuggestions.value = searchSuggestions.value.length > 0;
            }
        } catch (error) {
            console.error('Erreur lors de la recherche de suggestions:', error);
            searchSuggestions.value = [];
        }
    }, 300);
};

const handleSearch = () => {
    if (searchQuery.value.trim()) {
        showSearchSuggestions.value = false;
        router.visit(`/p/immobilier?search=${encodeURIComponent(searchQuery.value)}`);
    }
};

const selectSuggestion = (index) => {
    if (index >= 0 && index < searchSuggestions.value.length) {
        const suggestion = searchSuggestions.value[index];
        showSearchSuggestions.value = false;
        if (suggestion.url) {
            router.visit(suggestion.url);
        } else {
            searchQuery.value = suggestion.value;
            handleSearch();
        }
    }
};

const navigateSuggestions = (direction) => {
    if (searchSuggestions.value.length === 0) return;
    
    if (direction === 'down') {
        selectedSuggestionIndex.value = (selectedSuggestionIndex.value + 1) % searchSuggestions.value.length;
    } else if (direction === 'up') {
        selectedSuggestionIndex.value = selectedSuggestionIndex.value <= 0 
            ? searchSuggestions.value.length - 1 
            : selectedSuggestionIndex.value - 1;
    }
};

const hideSuggestions = () => {
    setTimeout(() => {
        showSearchSuggestions.value = false;
    }, 200);
};

// Fermer le menu utilisateur en cliquant à l'extérieur
const handleClickOutside = (event) => {
    const userMenuButton = event.target.closest('button[aria-label="Menu utilisateur"]');
    const userMenuDropdown = event.target.closest('.absolute.right-0');
    
    if (showUserMenu.value && !userMenuButton && !userMenuDropdown) {
        showUserMenu.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
    <nav class="fixed top-0 left-0 w-full z-50 bg-white border-b border-gray-200" 
         role="navigation" 
         aria-label="Navigation principale">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center h-16 relative">
                <!-- Logo (positionné à gauche) -->
                <div class="absolute left-0 flex items-center">
                    <a :href="route('home')" 
                       class="flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-principal focus:ring-offset-2 rounded"
                       aria-label="Retour à l'accueil">
                        <!-- Logo circulaire rouge avec maison -->
                        <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                        </div>
                        <!-- Texte du logo en teal foncé -->
                        <span class="text-xl font-normal text-teal-800 lowercase">noflayhub</span>
                    </a>
                </div>

                <!-- Barre de recherche (centrée absolument) -->
                <div class="absolute left-1/2 transform -translate-x-1/2 w-full max-w-2xl px-4 relative">
                    <form @submit.prevent="handleSearch" class="relative">
                        <div class="relative">
                            <!-- Icône de recherche -->
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" 
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" 
                                      stroke-linejoin="round" 
                                      stroke-width="2" 
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            
                            <!-- Input de recherche -->
                            <input 
                                type="text" 
                                v-model="searchQuery"
                                @input="handleSearchInput"
                                @focus="showSearchSuggestions = true"
                                @blur="hideSuggestions"
                                @keydown.arrow-down.prevent="navigateSuggestions('down')"
                                @keydown.arrow-up.prevent="navigateSuggestions('up')"
                                @keydown.enter.prevent="selectedSuggestionIndex >= 0 ? selectSuggestion(selectedSuggestionIndex) : handleSearch()"
                                placeholder="Rechercher une localisation, une ville..."
                                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm text-gray-700 placeholder-gray-400"
                                aria-label="Rechercher une localisation"
                                autocomplete="off"
                            />
                            
                            <!-- Suggestions dropdown -->
                            <div 
                                v-if="showSearchSuggestions && searchSuggestions.length > 0"
                                class="absolute top-full left-0 right-0 mt-1 bg-white rounded-lg shadow-xl border border-gray-200 z-50 max-h-96 overflow-y-auto"
                            >
                                <div 
                                    v-for="(suggestion, index) in searchSuggestions" 
                                    :key="index"
                                    @click="selectSuggestion(index)"
                                    @mouseenter="selectedSuggestionIndex = index"
                                    :class="[
                                        'px-4 py-3 cursor-pointer transition-colors flex items-center gap-3',
                                        selectedSuggestionIndex === index ? 'bg-teal-50' : 'hover:bg-gray-50'
                                    ]"
                                >
                                    <i :class="[
                                        'fas text-teal-600',
                                        suggestion.icon === 'map-marker-alt' ? 'fa-map-marker-alt' :
                                        suggestion.icon === 'home' ? 'fa-home' :
                                        'fa-building'
                                    ]"></i>
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900">{{ suggestion.label }}</div>
                                        <div class="text-xs text-gray-500 capitalize">{{ suggestion.type }}</div>
                                    </div>
                                    <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Actions à droite (positionnées à droite) -->
                <div class="absolute right-0 flex items-center space-x-4">
                    <!-- Lien "Nouvelle alerte de bien" -->
                    <a href="#" 
                       class="hidden md:block text-sm font-medium text-teal-800 hover:text-teal-900 transition-colors">
                        Nouvelle alerte de bien
                    </a>

                    <!-- Sélecteur de langue (Globe) -->
                    <button class="text-teal-800 hover:text-teal-900 transition-colors focus:outline-none focus:ring-2 focus:ring-teal-500 rounded p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                        </svg>
                    </button>

                    <!-- Menu utilisateur -->
                    <div class="relative">
                        <button 
                            @click="showUserMenu = !showUserMenu"
                            class="flex items-center space-x-2 px-3 py-2 rounded-full border-2 border-teal-800 hover:bg-teal-50 transition-colors focus:outline-none focus:ring-2 focus:ring-teal-500"
                            aria-label="Menu utilisateur"
                        >
                            <!-- Icône menu hamburger -->
                            <svg class="w-5 h-5 text-teal-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            
                            <!-- Icône profil -->
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center border-2 border-white">
                                <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>

                        <!-- Menu déroulant utilisateur -->
                        <div 
                            v-if="showUserMenu"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 py-1 z-50"
                        >
                            <template v-if="$page.props.auth?.user">
                                <a href="/dashboard" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Dashboard
                                </a>
                                <a href="/favoris" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Mes favoris
                                    <span v-if="$page.props.favoritesCount > 0" class="ml-2 text-xs bg-red-500 text-white rounded-full px-2 py-0.5">
                                        {{ $page.props.favoritesCount }}
                                    </span>
                                </a>
                                <a href="/notifications" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Notifications
                                    <span v-if="$page.props.unreadNotificationsCount > 0" class="ml-2 text-xs bg-red-500 text-white rounded-full px-2 py-0.5">
                                        {{ $page.props.unreadNotificationsCount }}
                                    </span>
                                </a>
                                <hr class="my-1">
                                <form method="POST" action="/logout">
                                    <input type="hidden" name="_token" :value="$page.props.csrf_token">
                                    <button type="submit" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Se déconnecter
                                    </button>
                                </form>
                            </template>
                            <template v-else>
                                <a href="/login" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Se connecter
                                </a>
                                <a href="/register" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    S'inscrire
                                </a>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped>
/* Styles pour la navigation */
</style>
