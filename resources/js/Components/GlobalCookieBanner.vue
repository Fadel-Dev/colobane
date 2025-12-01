<script setup>
import { ref, onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import CookiePreferences from './CookiePreferences.vue';

const page = usePage();
const showBanner = ref(false);
const cookieConsent = ref(null);
const showPreferences = ref(false);

onMounted(() => {
    // Vérifier si le consentement a déjà été donné
    const consent = localStorage.getItem('cookie_consent');
    
    if (!consent) {
        // Afficher la bannière après un court délai pour une meilleure UX
        setTimeout(() => {
            showBanner.value = true;
        }, 1000);
    } else {
        cookieConsent.value = consent;
        // Si les cookies sont acceptés, initialiser les scripts tiers
        if (consent === 'accepted') {
            initializeCookies();
        } else if (consent === 'custom') {
            // Charger les préférences personnalisées
            const prefs = localStorage.getItem('cookie_preferences');
            if (prefs) {
                try {
                    const preferences = JSON.parse(prefs);
                    initializeCustomCookies(preferences);
                } catch (e) {
                    console.error('Erreur lors du chargement des préférences:', e);
                }
            }
        }
    }
});

const acceptCookies = () => {
    localStorage.setItem('cookie_consent', 'accepted');
    localStorage.setItem('cookie_consent_date', new Date().toISOString());
    cookieConsent.value = 'accepted';
    showBanner.value = false;
    
    // Initialiser les cookies et scripts tiers
    initializeCookies();
    
    // Émettre un événement pour que d'autres composants puissent réagir
    window.dispatchEvent(new CustomEvent('cookies-accepted'));
};

const rejectCookies = () => {
    localStorage.setItem('cookie_consent', 'rejected');
    localStorage.setItem('cookie_consent_date', new Date().toISOString());
    cookieConsent.value = 'rejected';
    showBanner.value = false;
    
    // Émettre un événement pour que d'autres composants puissent réagir
    window.dispatchEvent(new CustomEvent('cookies-rejected'));
};

const customizeCookies = () => {
    showPreferences.value = true;
};

const closePreferences = () => {
    showPreferences.value = false;
};

const savePreferences = (prefs) => {
    // Les préférences sont déjà sauvegardées dans CookiePreferences
    showBanner.value = false;
    initializeCustomCookies(prefs);
};

const initializeCookies = () => {
    // Initialiser les cookies analytiques (Google Analytics, etc.)
    if (typeof gtag !== 'undefined') {
        // Google Analytics serait initialisé ici
        console.log('Cookies analytiques initialisés');
    }
    
    // Initialiser les cookies de marketing/publicité
    // Exemple : Facebook Pixel, etc.
    
    // Initialiser les cookies de préférences
    // Exemple : langue, thème, etc.
};

const initializeCustomCookies = (preferences) => {
    // Initialiser uniquement les cookies acceptés
    if (preferences.analytics) {
        // Initialiser Google Analytics, etc.
        console.log('Cookies analytiques initialisés');
    }
    if (preferences.marketing) {
        // Initialiser les cookies marketing
        console.log('Cookies marketing initialisés');
    }
    if (preferences.preferences) {
        // Initialiser les cookies de préférences
        console.log('Cookies de préférences initialisés');
    }
};
</script>

<template>
    <!-- Bannière de consentement aux cookies -->
    <Transition
        enter-active-class="transition ease-out duration-300"
        enter-from-class="opacity-0 translate-y-4"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 translate-y-4"
    >
        <div 
            v-if="showBanner"
            class="fixed bottom-0 left-0 right-0 z-[100] bg-white border-t border-gray-200 shadow-2xl"
            role="dialog"
            aria-labelledby="cookie-banner-title"
            aria-modal="true"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <!-- Contenu -->
                    <div class="flex-1">
                        <h3 id="cookie-banner-title" class="text-lg font-semibold text-gray-900 mb-2">
                            🍪 Nous utilisons des cookies
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Nous utilisons des cookies pour améliorer votre expérience, analyser le trafic du site et personnaliser le contenu. 
                            En continuant à utiliser notre site, vous acceptez notre utilisation des cookies. 
                            <Link href="/cookies" class="text-teal-600 hover:text-teal-700 underline font-medium">
                                En savoir plus
                            </Link>
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 flex-shrink-0">
                        <!-- Bouton Personnaliser -->
                        <button
                            @click="customizeCookies"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2"
                        >
                            Personnaliser
                        </button>

                        <!-- Bouton Refuser -->
                        <button
                            @click="rejectCookies"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2"
                        >
                            Refuser
                        </button>

                        <!-- Bouton Accepter -->
                        <button
                            @click="acceptCookies"
                            class="px-6 py-2 text-sm font-semibold text-white bg-teal-600 rounded-lg hover:bg-teal-700 transition-colors focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 shadow-sm"
                        >
                            Tout accepter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Transition>

    <!-- Modal de préférences de cookies -->
    <CookiePreferences 
        :show="showPreferences" 
        @close="closePreferences"
        @save="savePreferences"
    />
</template>

<style scoped>
/* Styles supplémentaires si nécessaire */
</style>

