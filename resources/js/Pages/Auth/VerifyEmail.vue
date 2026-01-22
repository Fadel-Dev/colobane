<script setup>
import { ref, computed } from 'vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { router } from '@inertiajs/vue3';

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
const verificationStatus = ref(props.status || '');

const submit = () => {
    isSubmitting.value = true;
    form.post(route('verification.verify'), {
        onFinish: () => {
            isSubmitting.value = false;
        },
    });
};

const resendVerification = () => {
    countdown.value = 60; // 60 secondes avant de pouvoir renvoyer
    
    // Envoyer la requête avec l'email
    const emailToUse = props.email || usePage().props.auth.user.email;
    
    router.post(route('verification.send'), {
        email: emailToUse
    }, {
        onSuccess: () => {
            // Mettre à jour le statut pour afficher le message de succès
            verificationStatus.value = 'verification-code-sent';
        },
        onError: (errors) => {
            console.error('Erreur lors de l\'envoi du code:', errors);
            // Afficher un message d'erreur à l'utilisateur
            form.setError('code', 'Une erreur est survenue lors de l\'envoi du code. Veuillez réessayer.');
        }
    });
};

// Gestion du compte à rebours
const timer = setInterval(() => {
    if (countdown.value > 0) {
        countdown.value--;
    } else {
        clearInterval(timer);
    }
}, 1000);
</script>

<template>
    <Head title="Vérification d'email" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Un code de vérification à 6 chiffres a été envoyé à votre adresse email. 
            Veuillez le saisir ci-dessous pour vérifier votre compte.
        </div>

        <div v-if="verificationStatus === 'verification-code-sent'" class="mb-4 font-medium text-sm text-green-600">
            Un nouveau code de vérification a été envoyé à votre adresse email.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4">
                <InputLabel for="code" value="Code de vérification" />
                <TextInput
                    id="code"
                    v-model="form.code"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    maxlength="6"
                    placeholder="Entrez le code à 6 chiffres"
                />
                <InputError class="mt-2" :message="form.errors.code" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing || isSubmitting">
                    Vérifier le code
                </PrimaryButton>

                <button
                    type="button"
                    @click="resendVerification"
                    :disabled="countdown > 0"
                    class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    :class="{ 'opacity-50 cursor-not-allowed': countdown > 0 }"
                >
                    <span v-if="countdown > 0">
                        Renvoyer le code ({{ countdown }}s)
                    </span>
                    <span v-else>
                        Renvoyer le code
                    </span>
                </button>
            </div>
        </form>
    </AuthenticationCard>
</template>
