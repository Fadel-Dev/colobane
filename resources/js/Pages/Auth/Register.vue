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
        numbers: /\d/.test(pwd),
    };
    
    if (checks.length) score++;
    if (checks.numbers) score++;
    
    const labels = ['Faible', 'Sécurisé'];
    const colors = ['orange', 'green'];
    
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

// Vérifier si le mot de passe est "bon"
const isPasswordStrong = computed(() => {
    return passwordStrength.value.score === 2;
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

// Gestion du champ téléphone - Uniquement des chiffres
const handlePhoneInput = (event) => {
    form.phone = form.phone.replace(/[^0-9]/g, '');
};

// Accepter uniquement les chiffres lors de la frappe
const onlyNumbers = (event) => {
    const char = String.fromCharCode(event.which);
    if (!/[0-9]/.test(char)) {
        event.preventDefault();
    }
};

// Gérer le paste
const handlePhonePaste = (event) => {
    event.preventDefault();
    const pastedText = (event.clipboardData || window.clipboardData).getData('text');
    const numbersOnly = pastedText.replace(/[^0-9]/g, '');
    form.phone = numbersOnly.slice(0, 15);
};
</script>

<template>
    <SeoHead 
        title="Créer un compte - NoflayHub"
        description="Créez votre compte NoflayHub gratuitement et accédez à toutes les fonctionnalités : publier des annonces, sauvegarder vos favoris et bien plus encore."
        keywords="inscription NoflayHub, créer un compte, s'inscrire, compte utilisateur, inscription gratuite"
    />

    <Navbar />

    <main class="min-h-screen bg-[#f8fafc] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-6xl">
            <div class="bg-white rounded-[2rem] shadow-xl overflow-hidden border border-gray-100">
                <div class="flex flex-col lg:flex-row min-h-[700px]">
                    <!-- Section gauche - Branding (Caché sur mobile) -->
                    <div class="hidden lg:flex lg:w-5/12 relative bg-secondaire overflow-hidden">
                        <!-- Cercles décoratifs -->
                        <div class="absolute -top-20 -left-20 w-64 h-64 bg-principal/20 rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-principal/10 rounded-full blur-3xl"></div>
                        
                        <!-- Contenu -->
                        <div class="relative z-10 flex flex-col justify-between p-12 text-white w-full">
                            <div>
                                <Link href="/" class="inline-block mb-12">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center">
                                            <span class="text-principal font-bold text-2xl">N</span>
                                        </div>
                                        <span class="text-2xl font-bold tracking-tight">Noflay<span class="text-principal">Hub</span></span>
                                    </div>
                                </Link>

                                <h2 class="text-4xl font-extrabold mb-6 leading-tight">
                                    Prêt à donner une seconde vie à vos objets ?
                                </h2>
                                <p class="text-lg text-gray-300 leading-relaxed mb-10">
                                    Rejoignez la plus grande communauté de vente et d'achat au Sénégal. Simple, rapide et sécurisé.
                                </p>

                                <!-- Features -->
                                <div class="space-y-8">
                                    <div class="flex items-center space-x-4 group">
                                        <div class="flex-shrink-0 w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center group-hover:bg-principal transition-colors duration-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-lg">Annonces gratuites</h3>
                                            <p class="text-gray-400 text-sm">Publiez sans limite et sans frais</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-4 group">
                                        <div class="flex-shrink-0 w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center group-hover:bg-principal transition-colors duration-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-lg">Visibilité maximale</h3>
                                            <p class="text-gray-400 text-sm">Touchez des milliers d'acheteurs potentiels</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-12 border-t border-white/10">
                                <p class="text-sm text-gray-400">© 2024 NoflayHub. Tous droits réservés.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section droite - Formulaire -->
                    <div class="w-full lg:w-7/12 p-6 sm:p-12 lg:p-16 flex flex-col justify-center">
                        <div class="max-w-md mx-auto w-full">
                            <!-- Mobile Header -->
                            <div class="lg:hidden text-center mb-8">
                                <span class="text-2xl font-bold tracking-tight text-secondaire">Noflay<span class="text-principal">Hub</span></span>
                            </div>

                            <div class="mb-10 text-center lg:text-left">
                                <h1 class="text-3xl font-extrabold text-secondaire mb-3">
                                    Créer votre compte
                                </h1>
                                <p class="text-gray-500">
                                    C'est rapide et ça restera toujours gratuit.
                                </p>
                            </div>

                            <!-- Formulaire -->
                            <form @submit.prevent="submit" class="space-y-5">
                                <div class="grid grid-cols-1 gap-5">
                                    <!-- Nom -->
                                    <div>
                                        <label for="name" class="block text-sm font-bold text-secondaire mb-2">Nom complet</label>
                                        <input
                                            id="name"
                                            v-model="form.name"
                                            type="text"
                                            required
                                            placeholder="Ex: Moussa Diop"
                                            class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-principal/10 focus:border-principal transition-all duration-200"
                                            :class="{ 'border-red-500 bg-red-50': form.errors.name }"
                                        />
                                        <p v-if="form.errors.name" class="mt-1.5 text-xs text-red-600 font-medium">{{ form.errors.name }}</p>
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-sm font-bold text-secondaire mb-2">Adresse email</label>
                                        <input
                                            id="email"
                                            v-model="form.email"
                                            type="email"
                                            required
                                            placeholder="moussa@exemple.com"
                                            class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-principal/10 focus:border-principal transition-all duration-200"
                                            :class="{ 'border-red-500 bg-red-50': form.errors.email }"
                                        />
                                        <p v-if="form.errors.email" class="mt-1.5 text-xs text-red-600 font-medium">{{ form.errors.email }}</p>
                                    </div>

                                    <!-- Téléphone -->
                                    <div>
                                        <label for="phone" class="block text-sm font-bold text-secondaire mb-2">Téléphone</label>
                                        <div class="relative">
                                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 font-medium">+221</span>
                                            <input
                                                id="phone"
                                                v-model="form.phone"
                                                type="text"
                                                inputmode="numeric"
                                                required
                                                placeholder="77 000 00 00"
                                                class="w-full pl-16 pr-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-principal/10 focus:border-principal transition-all duration-200"
                                                :class="{ 'border-red-500 bg-red-50': form.errors.phone }"
                                                @input="handlePhoneInput"
                                                @keypress="onlyNumbers"
                                                @paste="handlePhonePaste"
                                            />
                                        </div>
                                        <p v-if="form.errors.phone" class="mt-1.5 text-xs text-red-600 font-medium">{{ form.errors.phone }}</p>
                                    </div>

                                    <!-- Mot de passe -->
                                    <div>
                                        <label for="password" class="block text-sm font-bold text-secondaire mb-2">Mot de passe</label>
                                        <div class="relative">
                                            <input
                                                id="password"
                                                v-model="form.password"
                                                :type="showPassword ? 'text' : 'password'"
                                                required
                                                placeholder="••••••••"
                                                class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-principal/10 focus:border-principal transition-all duration-200"
                                                :class="{ 'border-red-500 bg-red-50': form.errors.password }"
                                            />
                                            <button type="button" @click="showPassword = !showPassword" class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-secondaire">
                                                <svg v-if="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.906 5.236m-11.274 0L3 21" /></svg>
                                            </button>
                                        </div>

                                        <!-- Password Strength Indicator -->
                                        <div v-if="form.password" class="mt-3 p-4 bg-gray-50 rounded-2xl border border-gray-100 space-y-3">
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs font-bold text-secondaire uppercase tracking-wider">Sécurité</span>
                                                <span :class="`text-xs font-bold px-2 py-0.5 rounded-full ${passwordStrength.color === 'green' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700'}`">
                                                    {{ passwordStrength.label }}
                                                </span>
                                            </div>
                                            <div class="h-1.5 w-full bg-gray-200 rounded-full overflow-hidden">
                                                <div :class="`h-full transition-all duration-500 ${passwordStrength.color === 'green' ? 'bg-green-500 w-full' : 'bg-orange-500 w-1/2'}`"></div>
                                            </div>
                                            <div class="flex space-x-4">
                                                <div class="flex items-center space-x-1.5">
                                                    <div :class="`w-4 h-4 rounded-full flex items-center justify-center ${passwordStrength.checks.length ? 'bg-green-500' : 'bg-gray-200'}`">
                                                        <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                                    </div>
                                                    <span class="text-[10px] font-bold text-gray-500 uppercase">8+ carac.</span>
                                                </div>
                                                <div class="flex items-center space-x-1.5">
                                                    <div :class="`w-4 h-4 rounded-full flex items-center justify-center ${passwordStrength.checks.numbers ? 'bg-green-500' : 'bg-gray-200'}`">
                                                        <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                                    </div>
                                                    <span class="text-[10px] font-bold text-gray-500 uppercase">1 chiffre</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Conditions -->
                                    <div class="pt-2">
                                        <label class="flex items-start cursor-pointer group">
                                            <input v-model="form.terms" type="checkbox" required class="mt-1 w-5 h-5 text-principal border-gray-300 rounded-lg focus:ring-principal cursor-pointer" />
                                            <span class="ml-3 text-sm text-gray-500 leading-snug">
                                                J'accepte les <Link href="#" class="text-principal font-bold hover:underline">conditions d'utilisation</Link> et la <Link href="#" class="text-principal font-bold hover:underline">politique de confidentialité</Link>.
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <button
                                    type="submit"
                                    :disabled="form.processing || !form.terms || !isPasswordStrong"
                                    class="w-full py-4 bg-principal hover:bg-principal/90 disabled:bg-gray-300 text-white font-extrabold rounded-2xl shadow-lg shadow-principal/20 transform active:scale-95 transition-all duration-200 mt-4"
                                >
                                    <span v-if="!form.processing">Créer mon compte</span>
                                    <span v-else class="flex items-center justify-center">
                                        <svg class="animate-spin h-5 w-5 mr-3 text-white" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        Création en cours...
                                    </span>
                                </button>
                            </form>

                            <div class="mt-10 text-center">
                                <p class="text-gray-500 mb-4">Déjà inscrit ?</p>
                                <Link :href="route('login')" class="inline-block w-full py-3.5 border-2 border-secondaire text-secondaire font-bold rounded-2xl hover:bg-secondaire hover:text-white transition-all duration-200">
                                    Se connecter
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
@import url('https://fonts.googleapis.com/css2?family=Alkatra:wght@400;500;600;700&display=swap');

main {
    font-family: 'Alkatra', cursive;
}

input::placeholder {
    color: #94a3b8;
    font-weight: 400;
}
</style>
