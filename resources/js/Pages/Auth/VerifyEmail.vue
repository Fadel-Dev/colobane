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

    <div class="bg-gray-50 min-h-screen">
        <Navbar />

        <main class="flex flex-col items-center justify-center pt-20 sm:pt-24 pb-12 px-4">
            <AuthenticationCard>
                <template #logo>
                    <AuthenticationCardLogo />
                </template>

                <div class="mb-4 text-sm text-gray-600 text-center">
                    Merci de vous être inscrit ! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en utilisant le code à 6 chiffres que nous venons de vous envoyer ? 
                </div>
                <!-- l email de l utilisateur -->
                 <div class="mb-4 text-sm text-gray-600 text-center">
                    Merci de Verifier votre adresse e-mail :<br> <span class="text-lg text-red-500 text-center">{{ props.email }}</span>
                </div>

                

                <div v-if="verificationStatus === 'verification-code-sent'" class="flex items-center gap-3 mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>Un nouveau code de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de l'inscription.</span>
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="code" value="Code de Vérification" class="sr-only" />
                        <TextInput
                            id="code"
                            v-model="form.code"
                            type="text"
                            class="mt-1 block w-full text-center text-lg tracking-widest"
                            required
                            autofocus
                            maxlength="6"
                            placeholder="------"
                        />
                        <InputError class="mt-2" :message="form.errors.code" />
                    </div>

                    <div class="mt-6">
                        <PrimaryButton 
                            class="w-full justify-center"
                            :class="{ 'opacity-25': form.processing || isSubmitting }" 
                            :disabled="form.processing || isSubmitting"
                        >
                            Vérifier le Compte
                        </PrimaryButton>
                    </div>
                </form>

                <div class="mt-6 flex items-center justify-center">
                    <button
                        type="button"
                        @click="resendVerification"
                        :disabled="countdown > 0"
                        class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span v-if="countdown > 0">
                            Renvoyer le code ({{ countdown }}s)
                        </span>
                        <span v-else>
                            Renvoyer le code de vérification
                        </span>
                    </button>
                </div>
            </AuthenticationCard>
        </main>
    </div>
</template>
