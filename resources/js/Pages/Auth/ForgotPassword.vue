<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submitted = ref(false);
const isLoading = ref(false);

const submit = async () => {
    isLoading.value = true;
    form.post(route('password.email'), {
        onSuccess: () => {
            submitted.value = true;
            form.reset();
        },
        onFinish: () => {
            isLoading.value = false;
        }
    });
};
</script>

<template>
    <Head title="Réinitialiser le mot de passe" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <!-- En-tête -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Mot de passe oublié ?</h2>
            <p class="text-sm text-gray-600">
                Pas de problème. Entrez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.
            </p>
        </div>

        <!-- Message de succès -->
        <transition name="fade">
            <div v-if="submitted" class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            ✅ Vérifiez votre e-mail !
                        </p>
                        <p class="mt-1 text-sm text-green-700">
                            Nous avons envoyé un lien de réinitialisation à l'adresse fournie. Le lien expire dans 60 minutes.
                        </p>
                    </div>
                </div>
            </div>
        </transition>

        <!-- Message de statut existant -->
        <div v-if="status && !submitted" class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-700">
            {{ status }}
        </div>

        <!-- Formulaire -->
        <form v-if="!submitted" @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Adresse e-mail" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    placeholder="vous@exemple.com"
                    required
                    autofocus
                    autocomplete="email"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <Link href="/login" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                    Retour à la connexion
                </Link>
                <PrimaryButton 
                    :class="{ 'opacity-50 cursor-not-allowed': isLoading }" 
                    :disabled="isLoading"
                >
                    <span v-if="!isLoading">Envoyer le lien</span>
                    <span v-else class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Envoi en cours...
                    </span>
                </PrimaryButton>
            </div>
        </form>

        <!-- Alternative après envoi -->
        <div v-else class="mt-6 p-4 bg-gray-50 rounded-lg">
            <p class="text-sm text-gray-600 mb-4">
                Vous n'avez pas reçu le lien ? Vérifiez votre dossier de spam ou :
            </p>
            <button 
                @click="submitted = false"
                class="w-full text-center py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-sm"
            >
                Essayer une autre adresse e-mail
            </button>
        </div>
    </AuthenticationCard>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>
