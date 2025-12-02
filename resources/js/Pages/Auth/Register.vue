<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import Navbar from '@/Components/Navbar.vue';
import SeoHead from '@/Components/SeoHead.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    name: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const showPassword = ref(false);
const showPasswordConfirmation = ref(false);
const isLoading = ref(false);

// Validation du mot de passe
const passwordStrength = computed(() => {
    const pwd = form.password;
    if (!pwd) return { score: 0, label: '', color: 'gray', checks: {} };
    
    let score = 0;
    const checks = {
        length: pwd.length >= 8,
        uppercase: /[A-Z]/.test(pwd),
        lowercase: /[a-z]/.test(pwd),
        numbers: /\d/.test(pwd),
        special: /[!@#$%^&*]/.test(pwd),
    };
    
    Object.values(checks).forEach(check => {
        if (check) score++;
    });
    
    const labels = ['Très faible', 'Faible', 'Moyen', 'Bon', 'Très bon'];
    const colors = ['red', 'orange', 'yellow', 'blue', 'green'];
    
    return {
        score,
        label: labels[score - 1] || '',
        color: colors[score - 1] || 'gray',
        checks
    };
});

const passwordsMatch = computed(() => {
    return form.password === form.password_confirmation || !form.password_confirmation;
});

// Vérifier si le mot de passe est "très bon"
const isPasswordStrong = computed(() => {
    return passwordStrength.value.score === 5;
});

const submit = () => {
    isLoading.value = true;
    form.post(route('register'), {
        preserveScroll: true,
        onFinish: () => {
            isLoading.value = false;
        },
        onError: (errors) => {
            isLoading.value = false;
            // Les erreurs sont automatiquement ajoutées à form.errors par Inertia
            // Scroll vers le haut pour voir les erreurs
            setTimeout(() => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }, 100);
        },
        onSuccess: () => {
            isLoading.value = false;
        }
    });
};

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

const togglePasswordConfirmationVisibility = () => {
    showPasswordConfirmation.value = !showPasswordConfirmation.value;
};
</script>

<template>
    <SeoHead 
        title="Créer un compte - NoflayHub"
        description="Créez votre compte NoflayHub gratuitement et accédez à toutes les fonctionnalités : publier des annonces, sauvegarder vos favoris et bien plus encore."
        keywords="inscription NoflayHub, créer un compte, s'inscrire, compte utilisateur, inscription gratuite"
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                </div>
                                <h2 class="text-4xl font-bold mb-4 leading-tight">
                                    Rejoignez NoflayHub
                                </h2>
                                <p class="text-xl text-white/90 leading-relaxed mb-8">
                                    Créez votre compte gratuitement et commencez à publier vos annonces dès aujourd'hui
                                </p>
                            </div>

                            <!-- Features -->
                            <div class="space-y-6">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg mb-1">Publiez gratuitement</h3>
                                        <p class="text-white/90 text-sm">Mettez en ligne vos annonces sans frais</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg mb-1">Gérez vos annonces</h3>
                                        <p class="text-white/90 text-sm">Modifiez, supprimez ou boostez vos publications</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg mb-1">Sécurisé et fiable</h3>
                                        <p class="text-white/90 text-sm">Vos données sont protégées et sécurisées</p>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                </div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-3">
                                    Créer un compte
                                </h1>
                                <p class="text-gray-600">
                                    Remplissez le formulaire ci-dessous pour commencer
                                </p>
                            </div>

                            <!-- Message de statut -->
                            <div v-if="status" class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-xl shadow-sm">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-sm font-medium text-green-800">{{ status }}</p>
                                </div>
                            </div>

                            <!-- Message d'erreur global -->
                            <div v-if="Object.keys(form.errors).length > 0" class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl shadow-sm">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="flex-1">
                                        <h3 class="text-sm font-semibold text-red-800 mb-2">Veuillez corriger les erreurs suivantes :</h3>
                                        <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                            <li v-for="(error, field) in form.errors" :key="field">
                                                <strong class="capitalize">{{ field.replace('_', ' ') }} :</strong> {{ error }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Formulaire -->
                            <form @submit.prevent="submit" class="space-y-6">
                                <!-- Nom -->
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nom complet
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <input
                                            id="name"
                                            v-model="form.name"
                                            type="text"
                                            required
                                            autofocus
                                            autocomplete="name"
                                            placeholder="Votre nom complet"
                                            class="block w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-principal transition-all duration-200 text-gray-900 placeholder-gray-400"
                                            :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': form.errors.name }"
                                        />
                                    </div>
                                    <p v-if="form.errors.name" class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ form.errors.name }}
                                    </p>
                                </div>

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
                                            autocomplete="email"
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

                                <!-- Téléphone -->
                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Numéro de téléphone
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                        </div>
                                        <input
                                            id="phone"
                                            v-model="form.phone"
                                            type="tel"
                                            required
                                            autocomplete="tel"
                                            placeholder="+221 XX XXX XX XX"
                                            class="block w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-principal transition-all duration-200 text-gray-900 placeholder-gray-400"
                                            :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': form.errors.phone }"
                                        />
                                    </div>
                                    <p v-if="form.errors.phone" class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ form.errors.phone }}
                                    </p>
                                </div>

                                <!-- Mot de passe -->
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Mot de passe (très bon requis)
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
                                            autocomplete="new-password"
                                            placeholder="••••••••"
                                            class="block w-full pl-12 pr-12 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-principal transition-all duration-200 text-gray-900 placeholder-gray-400"
                                            :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': form.errors.password || (form.password && !isPasswordStrong) }"
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
                                    
                                    <!-- Exigences du mot de passe - Affichage en temps réel -->
                                    <div v-if="form.password" class="mt-3 p-4 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-lg transition-all duration-300">
                                        <!-- En-tête avec force -->
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-blue-900 text-xs font-bold uppercase tracking-wide">📋 Exigences du mot de passe</span>
                                            <span :class="`font-bold text-xs px-2.5 py-1 rounded-full ${{ 
                                                'bg-red-100 text-red-700': passwordStrength.score === 1,
                                                'bg-orange-100 text-orange-700': passwordStrength.score === 2,
                                                'bg-yellow-100 text-yellow-700': passwordStrength.score === 3,
                                                'bg-blue-100 text-blue-700': passwordStrength.score === 4,
                                                'bg-green-100 text-green-700': passwordStrength.score === 5,
                                            }}`">
                                                {{ passwordStrength.label }}
                                            </span>
                                        </div>
                                        
                                        <!-- Barre de progression animée -->
                                        <div class="mb-3">
                                            <div class="w-full bg-gray-300 rounded-full h-2.5 overflow-hidden shadow-sm">
                                                <div 
                                                    :class="[
                                                        'h-2.5 rounded-full transition-all duration-300 ease-out shadow-md',
                                                        {
                                                            'w-1/5 bg-red-500': passwordStrength.score === 1,
                                                            'w-2/5 bg-orange-500': passwordStrength.score === 2,
                                                            'w-3/5 bg-yellow-500': passwordStrength.score === 3,
                                                            'w-4/5 bg-blue-500': passwordStrength.score === 4,
                                                            'w-full bg-green-500': passwordStrength.score === 5,
                                                        }
                                                    ]"
                                                ></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Checklist interactive des critères -->
                                        <div class="space-y-2">
                                            <div class="flex items-center transition-colors duration-200" :class="passwordStrength.checks.length ? 'text-green-700' : 'text-gray-500'">
                                                <span class="mr-2 font-bold" :class="passwordStrength.checks.length ? 'text-green-600' : 'text-gray-400'">{{ passwordStrength.checks.length ? '✓' : '◯' }}</span>
                                                <span class="text-sm font-medium">Au moins 8 caractères</span>
                                            </div>
                                            <div class="flex items-center transition-colors duration-200" :class="passwordStrength.checks.uppercase ? 'text-green-700' : 'text-gray-500'">
                                                <span class="mr-2 font-bold" :class="passwordStrength.checks.uppercase ? 'text-green-600' : 'text-gray-400'">{{ passwordStrength.checks.uppercase ? '✓' : '◯' }}</span>
                                                <span class="text-sm font-medium">Une lettre majuscule (A-Z)</span>
                                            </div>
                                            <div class="flex items-center transition-colors duration-200" :class="passwordStrength.checks.lowercase ? 'text-green-700' : 'text-gray-500'">
                                                <span class="mr-2 font-bold" :class="passwordStrength.checks.lowercase ? 'text-green-600' : 'text-gray-400'">{{ passwordStrength.checks.lowercase ? '✓' : '◯' }}</span>
                                                <span class="text-sm font-medium">Une lettre minuscule (a-z)</span>
                                            </div>
                                            <div class="flex items-center transition-colors duration-200" :class="passwordStrength.checks.numbers ? 'text-green-700' : 'text-gray-500'">
                                                <span class="mr-2 font-bold" :class="passwordStrength.checks.numbers ? 'text-green-600' : 'text-gray-400'">{{ passwordStrength.checks.numbers ? '✓' : '◯' }}</span>
                                                <span class="text-sm font-medium">Un chiffre (0-9)</span>
                                            </div>
                                            <div class="flex items-center transition-colors duration-200" :class="passwordStrength.checks.special ? 'text-green-700' : 'text-gray-500'">
                                                <span class="mr-2 font-bold" :class="passwordStrength.checks.special ? 'text-green-600' : 'text-gray-400'">{{ passwordStrength.checks.special ? '✓' : '◯' }}</span>
                                                <span class="text-sm font-medium">Un caractère spécial (!@#$%^&*)</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <p v-if="form.errors.password" class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ form.errors.password }}
                                    </p>
                                    <p v-else-if="form.password && !isPasswordStrong" class="mt-2 text-sm text-orange-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        Le mot de passe doit être "Très bon" - tous les critères doivent être satisfaits
                                    </p>
                                </div>

                                <!-- Confirmation mot de passe -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Confirmer le mot de passe
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <input
                                            id="password_confirmation"
                                            v-model="form.password_confirmation"
                                            :type="showPasswordConfirmation ? 'text' : 'password'"
                                            required
                                            autocomplete="new-password"
                                            placeholder="••••••••"
                                            class="block w-full pl-12 pr-12 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-principal transition-all duration-200 text-gray-900 placeholder-gray-400"
                                            :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': form.errors.password_confirmation }"
                                        />
                                        <button
                                            type="button"
                                            @click="togglePasswordConfirmationVisibility"
                                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                                        >
                                            <svg v-if="showPasswordConfirmation" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.906 5.236m-11.274 0L3 21" />
                                            </svg>
                                            <svg v-else class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p v-if="form.errors.password_confirmation" class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ form.errors.password_confirmation }}
                                    </p>
                                </div>

                                <!-- Conditions d'utilisation -->
                                <div>
                                    <label class="flex items-start cursor-pointer group">
                                        <input
                                            v-model="form.terms"
                                            type="checkbox"
                                            required
                                            class="mt-1 w-4 h-4 text-principal border-gray-300 rounded focus:ring-principal focus:ring-2 cursor-pointer"
                                            :class="{ 'border-red-500': form.errors.terms }"
                                        />
                                        <span class="ml-3 text-sm text-gray-600 group-hover:text-gray-900 transition-colors">
                                            J'accepte les 
                                            <Link :href="route('terms')" target="_blank" class="text-principal hover:text-principal/80 underline font-medium">
                                                conditions d'utilisation
                                            </Link>
                                            et la 
                                            <Link :href="route('privacy')" target="_blank" class="text-principal hover:text-principal/80 underline font-medium">
                                                politique de confidentialité
                                            </Link>
                                        </span>
                                    </label>
                                    <p v-if="form.errors.terms" class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ form.errors.terms }}
                                    </p>
                                </div>

                                <!-- Bouton de soumission -->
                                <button
                                    type="submit"
                                    :disabled="form.processing || isLoading || !form.terms || !isPasswordStrong || !passwordsMatch"
                                    class="w-full flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-principal to-principal/90 hover:from-principal/90 hover:to-principal text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                                >
                                    <svg v-if="form.processing || isLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>{{ form.processing || isLoading ? 'Création du compte...' : 'Créer mon compte' }}</span>
                                </button>
                            </form>

                            <!-- Divider -->
                            <div class="mt-8">
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-4 bg-white text-gray-500">Déjà un compte ?</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Lien de connexion -->
                            <div class="mt-6 text-center">
                                <Link
                                    :href="route('login')"
                                    class="inline-flex items-center justify-center w-full px-6 py-3 border-2 border-principal text-principal font-semibold rounded-xl hover:bg-principal/10 transition-all duration-200"
                                >
                                    Se connecter
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

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
        max-height: 0;
    }
    to {
        opacity: 1;
        transform: translateY(0);
        max-height: 500px;
    }
}

/* Animation pour l'affichage des exigences */
.password-requirements {
    animation: slideDown 0.4s ease-out;
}

main {
    animation: fadeIn 0.5s ease-out;
}

/* Transitions fluides pour les changements de couleur */
.transition-colors {
    transition: color 0.2s ease;
}
</style>
