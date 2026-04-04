<script setup>
import { ref } from 'vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Navbar from '@/Components/Navbar.vue'; // <-- Importation du menu

const props = defineProps({
    status: String,
    email: String
});

const form = useForm({
    code: '',
    email: props.email || ''
});

const countdown = ref(0);
const isSubmitting = ref(false);
// Utiliser une ref pour le statut pour le mettre à jour dynamiquement
const verificationStatus = ref(props.status || '');

const submit = () => {
    isSubmitting.value = true;
    form.post(route('verification.verify.code'), {
        onFinish: () => {
            isSubmitting.value = false;
        },
    });
};

const resendVerification = () => {
    if (countdown.value > 0) return;

    countdown.value = 60; // 60 secondes
    const timer = setInterval(() => {
        if (countdown.value > 0) {
            countdown.value--;
        } else {
            clearInterval(timer);
        }
    }, 1000);

    const emailToUse = props.email || usePage().props.auth.user.email;
    
    router.post(route('verification.send'), {
        email: emailToUse
    }, {
        preserveState: true,
        onSuccess: () => {
            verificationStatus.value = 'verification-code-sent';
        },
        onError: (errors) => {
            console.error('Erreur lors du renvoi du code:', errors);
            form.setError('code', 'Une erreur est survenue lors du renvoi du code. Veuillez réessayer.');
        }
    });
};
</script>

<template>
    <Head title="Vérification d'Email" />

    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
        <Navbar />

        <main class="flex flex-col items-center justify-center pt-24 pb-12 px-4">
            
            <div class="w-full max-w-md">
                
                <!-- Card -->
                <div class="bg-white/80 backdrop-blur-xl shadow-2xl rounded-2xl p-8 border border-gray-100 transition-all duration-500 hover:shadow-indigo-100">
                    
                    <!-- Logo -->
                    <div class="flex justify-center mb-6">
                        <AuthenticationCardLogo />
                    </div>

                    <!-- Title -->
                    <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">
                        Vérification Email
                    </h2>

                    <p class="text-sm text-gray-500 text-center mb-6">
                        Entrez le code à 6 chiffres envoyé à :
                    </p>

                    <!-- Email highlight -->
                    <div class="text-center mb-6">
                        <span class="inline-block px-4 py-2 rounded-full bg-indigo-50 text-indigo-600 font-semibold text-sm shadow-sm">
                            {{ props.email }}
                        </span>
                    </div>

                    <!-- Success message -->
                    <div 
                        v-if="verificationStatus === 'verification-code-sent'"
                        class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-600 text-sm flex items-center gap-3 animate-fadeIn"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Nouveau code envoyé avec succès.
                    </div>

                    <!-- Form -->
                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <div>
                            <TextInput
                                id="code"
                                v-model="form.code"
                                type="text"
                                required
                                autofocus
                                maxlength="6"
                                placeholder="------"
                                class="w-full text-center text-2xl tracking-[0.6em] font-semibold 
                                       rounded-xl border-gray-300 focus:border-indigo-500 
                                       focus:ring-indigo-500 transition-all duration-300"
                            />
                            <InputError class="mt-2 text-center" :message="form.errors.code" />
                        </div>

                        <!-- Button -->
                        <button
                            type="submit"
                            :disabled="form.processing || isSubmitting"
                            class="w-full py-3 rounded-xl font-semibold text-white 
                                   bg-gradient-to-r from-indigo-600 to-purple-600
                                   hover:from-indigo-700 hover:to-purple-700
                                   shadow-lg hover:shadow-indigo-200
                                   transition-all duration-300
                                   disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            Vérifier mon compte
                        </button>
                    </form>

                    <!-- Resend -->
                    <div class="mt-6 text-center">
                        <button
                            type="button"
                            @click="resendVerification"
                            :disabled="countdown > 0"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition disabled:opacity-50"
                        >
                            <span v-if="countdown > 0">
                                Renvoyer dans {{ countdown }}s
                            </span>
                            <span v-else>
                                Renvoyer le code
                            </span>
                        </button>
                    </div>

                </div>

                <!-- Footer text -->
                <p class="text-center text-xs text-gray-400 mt-6">
                    Sécurisation de votre compte en cours 🔐
                </p>

            </div>
        </main>
    </div>
</template>
