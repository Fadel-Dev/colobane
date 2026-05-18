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

    <main class="min-h-screen bg-[#f8fafc] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-6xl">
            <div class="bg-white rounded-[2rem] shadow-xl overflow-hidden border border-gray-100">
                <div class="flex flex-col lg:flex-row min-h-[600px]">
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
                                    Heureux de vous revoir !
                                </h2>
                                <p class="text-lg text-gray-300 leading-relaxed mb-10">
                                    Connectez-vous pour gérer vos annonces, vos messages et vos favoris sur la plateforme n°1 au Sénégal.
                                </p>

                                <!-- Features -->
                                <div class="space-y-8">
                                    <div class="flex items-center space-x-4 group">
                                        <div class="flex-shrink-0 w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center group-hover:bg-principal transition-colors duration-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-lg">Alertes temps réel</h3>
                                            <p class="text-gray-400 text-sm">Soyez informé dès qu'une offre vous intéresse</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-4 group">
                                        <div class="flex-shrink-0 w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center group-hover:bg-principal transition-colors duration-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-lg">Messagerie intégrée</h3>
                                            <p class="text-gray-400 text-sm">Discutez directement avec les acheteurs et vendeurs</p>
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
                                    Bienvenue !
                                </h1>
                                <p class="text-gray-500">
                                    Veuillez entrer vos identifiants pour vous connecter.
                                </p>
                            </div>

                            <!-- Message de statut -->
                            <div v-if="status" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl">
                                <p class="text-sm font-medium text-green-800">{{ status }}</p>
                            </div>

                            <!-- Formulaire -->
                            <form @submit.prevent="submit" class="space-y-6">
                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-bold text-secondaire mb-2">Adresse email</label>
                                    <input
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        required
                                        autofocus
                                        placeholder="Ex: moussa@exemple.com"
                                        class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-principal/10 focus:border-principal transition-all duration-200"
                                        :class="{ 'border-red-500 bg-red-50': form.errors.email }"
                                    />
                                    <p v-if="form.errors.email" class="mt-1.5 text-xs text-red-600 font-medium">{{ form.errors.email }}</p>
                                </div>

                                <!-- Mot de passe -->
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label for="password" class="text-sm font-bold text-secondaire">Mot de passe</label>
                                        <Link v-if="canResetPassword" :href="route('password.request')" class="text-xs font-bold text-principal hover:underline">
                                            Oublié ?
                                        </Link>
                                    </div>
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
                                    <p v-if="form.errors.password" class="mt-1.5 text-xs text-red-600 font-medium">{{ form.errors.password }}</p>
                                </div>

                                <!-- Remember Me -->
                                <div class="flex items-center">
                                    <label class="flex items-center cursor-pointer group">
                                        <input v-model="form.remember" type="checkbox" class="w-5 h-5 text-principal border-gray-300 rounded-lg focus:ring-principal cursor-pointer" />
                                        <span class="ml-3 text-sm text-gray-500 font-medium group-hover:text-secondaire transition-colors">Se souvenir de moi</span>
                                    </label>
                                </div>

                                <button
                                    type="submit"
                                    :disabled="form.processing || isLoading"
                                    class="w-full py-4 bg-principal hover:bg-principal/90 disabled:bg-gray-300 text-white font-extrabold rounded-2xl shadow-lg shadow-principal/20 transform active:scale-95 transition-all duration-200 mt-4"
                                >
                                    <span v-if="!form.processing && !isLoading">Se connecter</span>
                                    <span v-else class="flex items-center justify-center">
                                        <svg class="animate-spin h-5 w-5 mr-3 text-white" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        Connexion...
                                    </span>
                                </button>
                            </form>

                            <div class="mt-10 text-center">
                                <p class="text-gray-500 mb-4">Pas encore de compte ?</p>
                                <Link :href="route('register')" class="inline-block w-full py-3.5 border-2 border-secondaire text-secondaire font-bold rounded-2xl hover:bg-secondaire hover:text-white transition-all duration-200">
                                    Créer un compte gratuitement
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
