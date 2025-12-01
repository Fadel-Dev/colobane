<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Navbar from '@/Components/Navbar.vue';
import SeoHead from '@/Components/SeoHead.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const showPassword = ref(false);
const isLoading = ref(false);

const submit = () => {
    isLoading.value = true;
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => {
            form.reset('password');
            isLoading.value = false;
        },
        onError: () => {
            isLoading.value = false;
        }
    });
};

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};
</script>

<template>
    <SeoHead 
        title="Connexion - NoflayHub"
        description="Connectez-vous à votre compte NoflayHub pour accéder à toutes les fonctionnalités : publier des annonces, gérer vos favoris et bien plus encore."
        keywords="connexion NoflayHub, se connecter, login, compte utilisateur"
    />

    <Navbar />

    <main class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-6xl">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <div class="flex flex-col lg:flex-row">
                    <!-- Section gauche - Image et branding -->
                    <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-principal via-principal/90 to-secondaire">
                        <!-- Pattern décoratif -->
                        <div class="absolute inset-0 opacity-10">
                            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
                            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
                        </div>
                        
                        <!-- Image de fond -->
                        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-20" 
                             style="background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');">
                        </div>
                        
                        <!-- Contenu -->
                        <div class="relative z-10 flex flex-col justify-center p-12 text-white">
                            <div class="mb-8">
                                <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-6">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                    </svg>
                                </div>
                                <h2 class="text-4xl font-bold mb-4 leading-tight">
                                    Bienvenue sur NoflayHub
                                </h2>
                                <p class="text-xl text-white/90 leading-relaxed mb-8">
                                    La plateforme de référence pour la location et la vente immobilière au Sénégal
                                </p>
                            </div>

                            <!-- Features -->
                            <div class="space-y-6">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg mb-1">Recherche avancée</h3>
                                        <p class="text-white/90 text-sm">Trouvez rapidement le bien qui correspond à vos critères</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg mb-1">Favoris personnalisés</h3>
                                        <p class="text-white/90 text-sm">Sauvegardez vos biens préférés pour les consulter plus tard</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg mb-1">Publiez facilement</h3>
                                        <p class="text-white/90 text-sm">Mettez en ligne vos annonces en quelques clics</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section droite - Formulaire -->
                    <div class="w-full lg:w-1/2 p-8 sm:p-12 lg:p-16">
                        <div class="max-w-md mx-auto">
                            <!-- Header -->
                            <div class="text-center mb-10">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-principal/10 rounded-2xl mb-6">
                                    <svg class="w-12 h-12 text-principal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-3">
                                    Connexion
                                </h1>
                                <p class="text-gray-600">
                                    Connectez-vous pour accéder à votre compte
                                </p>
                            </div>

                            <!-- Message de statut -->
                            <div v-if="status" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                                <p class="text-sm font-medium text-green-800">{{ status }}</p>
                            </div>

                            <!-- Formulaire -->
                            <form @submit.prevent="submit" class="space-y-6">
                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Adresse email
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                            </svg>
                                        </div>
                                        <input
                                            id="email"
                                            v-model="form.email"
                                            type="email"
                                            required
                                            autofocus
                                            autocomplete="username"
                                            placeholder="votre@email.com"
                                            class="block w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-principal transition-all duration-200 text-gray-900 placeholder-gray-400"
                                            :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': form.errors.email }"
                                        />
                                    </div>
                                    <p v-if="form.errors.email" class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ form.errors.email }}
                                    </p>
                                </div>

                                <!-- Mot de passe -->
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Mot de passe
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                        <input
                                            id="password"
                                            v-model="form.password"
                                            :type="showPassword ? 'text' : 'password'"
                                            required
                                            autocomplete="current-password"
                                            placeholder="••••••••"
                                            class="block w-full pl-12 pr-12 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-principal transition-all duration-200 text-gray-900 placeholder-gray-400"
                                            :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': form.errors.password }"
                                        />
                                        <button
                                            type="button"
                                            @click="togglePasswordVisibility"
                                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                                        >
                                            <svg v-if="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.906 5.236m-11.274 0L3 21" />
                                            </svg>
                                            <svg v-else class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p v-if="form.errors.password" class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ form.errors.password }}
                                    </p>
                                </div>

                                <!-- Options -->
                                <div class="flex items-center justify-between">
                                    <label class="flex items-center cursor-pointer group">
                                        <input
                                            v-model="form.remember"
                                            type="checkbox"
                                            class="w-4 h-4 text-principal border-gray-300 rounded focus:ring-principal focus:ring-2 cursor-pointer"
                                        />
                                        <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-900 transition-colors">
                                            Se souvenir de moi
                                        </span>
                                    </label>

                                    <Link
                                        v-if="canResetPassword"
                                        :href="route('password.request')"
                                        class="text-sm font-medium text-principal hover:text-principal/80 transition-colors"
                                    >
                                        Mot de passe oublié ?
                                    </Link>
                                </div>

                                <!-- Bouton de soumission -->
                                <button
                                    type="submit"
                                    :disabled="form.processing || isLoading"
                                    class="w-full flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-principal to-principal/90 hover:from-principal/90 hover:to-principal text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                                >
                                    <svg v-if="form.processing || isLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>{{ form.processing || isLoading ? 'Connexion en cours...' : 'Se connecter' }}</span>
                                </button>
                            </form>

                            <!-- Divider -->
                            <div class="mt-8">
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-4 bg-white text-gray-500">Pas encore de compte ?</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Lien d'inscription -->
                            <div class="mt-6 text-center">
                                <Link
                                    :href="route('register')"
                                    class="inline-flex items-center justify-center w-full px-6 py-3 border-2 border-principal text-principal font-semibold rounded-xl hover:bg-principal/10 transition-all duration-200"
                                >
                                    Créer un compte
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<style scoped>
/* Animations personnalisées */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

main {
    animation: fadeIn 0.5s ease-out;
}
</style>
