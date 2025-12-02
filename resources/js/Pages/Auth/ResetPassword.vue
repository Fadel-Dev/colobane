<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, computed } from 'vue';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const isLoading = ref(false);
const showPassword = ref(false);
const showPasswordConfirm = ref(false);

// Validation du mot de passe
const passwordStrength = computed(() => {
    const pwd = form.password;
    if (!pwd) return { score: 0, label: '', color: 'gray' };
    
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

const submit = async () => {
    if (!passwordsMatch.value) {
        return;
    }
    
    isLoading.value = true;
    form.post(route('password.update'), {
        onFinish: () => {
            isLoading.value = false;
            if (!form.hasErrors) {
                form.reset('password', 'password_confirmation');
            }
        },
    });
};
</script>

<template>
    <Head title="Réinitialiser votre mot de passe" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <!-- En-tête -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Réinitialiser votre mot de passe</h2>
            <p class="text-sm text-gray-600">
                Entrez un nouveau mot de passe fort pour sécuriser votre compte.
            </p>
        </div>

        <form @submit.prevent="submit">
            <!-- Email (en lecture seule) -->
            <div>
                <InputLabel for="email" value="Adresse e-mail" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full bg-gray-100 cursor-not-allowed"
                    disabled
                    autocomplete="email"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Nouveau mot de passe -->
            <div class="mt-6">
                <div class="flex items-center justify-between">
                    <InputLabel for="password" value="Nouveau mot de passe" />
                    <button 
                        type="button"
                        @click="showPassword = !showPassword"
                        class="text-xs text-blue-600 hover:text-blue-800 font-medium"
                    >
                        {{ showPassword ? 'Masquer' : 'Afficher' }}
                    </button>
                </div>
                
                <div class="relative mt-1">
                    <TextInput
                        id="password"
                        v-model="form.password"
                        :type="showPassword ? 'text' : 'password'"
                        class="block w-full"
                        placeholder="Minimum 8 caractères"
                        required
                        autocomplete="new-password"
                    />
                    <!-- Icône force -->
                    <div v-if="form.password" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <svg 
                            v-if="passwordStrength.score >= 4"
                            class="w-5 h-5 text-green-500"
                            fill="currentColor" 
                            viewBox="0 0 20 20"
                        >
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <svg 
                            v-else
                            class="w-5 h-5 text-orange-500"
                            fill="currentColor" 
                            viewBox="0 0 20 20"
                        >
                            <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 0012 19c-3.314 0-6-1.343-6-3s2.686-3 6-3c.996 0 1.926.164 2.755.430a1 1 0 00.502-1.94c-1.034-.447-2.16-.72-3.257-.72-4.418 0-8 2.239-8 5s3.582 5 8 5c.163 0 .326-.012.488-.04a1 1 0 00-.488-1.94z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                
                <!-- Force du mot de passe -->
                <div v-if="form.password" class="mt-2">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-gray-600">Force :</span>
                        <span :class="`font-semibold text-${passwordStrength.color}-600`">
                            {{ passwordStrength.label }}
                        </span>
                    </div>
                    <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                        <div 
                            :class="[
                                'h-2 rounded-full transition-all',
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
                    
                    <!-- Checklist de force -->
                    <div class="mt-3 space-y-1 text-xs">
                        <div :class="passwordStrength.checks.length ? 'text-green-600' : 'text-gray-500'">
                            ✓ Au moins 8 caractères
                        </div>
                        <div :class="passwordStrength.checks.uppercase ? 'text-green-600' : 'text-gray-500'">
                            ✓ Une lettre majuscule (A-Z)
                        </div>
                        <div :class="passwordStrength.checks.lowercase ? 'text-green-600' : 'text-gray-500'">
                            ✓ Une lettre minuscule (a-z)
                        </div>
                        <div :class="passwordStrength.checks.numbers ? 'text-green-600' : 'text-gray-500'">
                            ✓ Un chiffre (0-9)
                        </div>
                        <div :class="passwordStrength.checks.special ? 'text-green-600' : 'text-gray-500'">
                            ✓ Un caractère spécial (!@#$%^&*)
                        </div>
                    </div>
                </div>
                
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Confirmation du mot de passe -->
            <div class="mt-6">
                <div class="flex items-center justify-between">
                    <InputLabel for="password_confirmation" value="Confirmer le mot de passe" />
                    <button 
                        type="button"
                        @click="showPasswordConfirm = !showPasswordConfirm"
                        class="text-xs text-blue-600 hover:text-blue-800 font-medium"
                    >
                        {{ showPasswordConfirm ? 'Masquer' : 'Afficher' }}
                    </button>
                </div>
                
                <div class="relative mt-1">
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        :type="showPasswordConfirm ? 'text' : 'password'"
                        class="block w-full"
                        placeholder="Répétez votre nouveau mot de passe"
                        required
                        autocomplete="new-password"
                    />
                    <!-- Icône correspondance -->
                    <div v-if="form.password_confirmation" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <svg 
                            v-if="passwordsMatch"
                            class="w-5 h-5 text-green-500"
                            fill="currentColor" 
                            viewBox="0 0 20 20"
                        >
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <svg 
                            v-else
                            class="w-5 h-5 text-red-500"
                            fill="currentColor" 
                            viewBox="0 0 20 20"
                        >
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                
                <transition name="fade">
                    <p v-if="form.password_confirmation && !passwordsMatch" class="mt-2 text-xs text-red-600 font-medium">
                        ⚠️ Les mots de passe ne correspondent pas
                    </p>
                    <p v-else-if="form.password_confirmation && passwordsMatch" class="mt-2 text-xs text-green-600 font-medium">
                        ✓ Les mots de passe correspondent
                    </p>
                </transition>
                
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <!-- Bouton soumettre -->
            <div class="flex items-center justify-end mt-8">
                <PrimaryButton 
                    :disabled="isLoading || !passwordsMatch || form.password.length < 8"
                    :class="{ 'opacity-50 cursor-not-allowed': isLoading || !passwordsMatch || form.password.length < 8 }"
                >
                    <span v-if="!isLoading">Réinitialiser le mot de passe</span>
                    <span v-else class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Traitement...
                    </span>
                </PrimaryButton>
            </div>
        </form>
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
