<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
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

const isPasswordStrong = computed(() => {
    return passwordStrength.value.score === 2;
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
    <Head title="Réinitialiser le mot de passe" />

    <main class="min-h-screen bg-[#f8fafc] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <!-- Logo/Branding -->
            <div class="text-center mb-10">
                <Link href="/" class="inline-block">
                    <span class="text-3xl font-bold tracking-tight text-secondaire">Noflay<span class="text-principal">Hub</span></span>
                </Link>
            </div>

            <div class="bg-white rounded-[2rem] shadow-xl p-8 sm:p-10 border border-gray-100">
                <div class="mb-8 text-center">
                    <h1 class="text-2xl font-extrabold text-secondaire mb-2">
                        Réinitialiser le mot de passe
                    </h1>
                    <p class="text-gray-500 text-sm">
                        Choisissez un nouveau mot de passe pour votre compte.
                    </p>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Email (lecture seule) -->
                    <div>
                        <label class="block text-sm font-bold text-secondaire mb-2">Adresse email</label>
                        <input
                            v-model="form.email"
                            type="email"
                            disabled
                            class="w-full px-5 py-3.5 bg-gray-100 border border-gray-200 rounded-2xl text-gray-500 cursor-not-allowed"
                        />
                    </div>

                    <!-- Nouveau mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-secondaire mb-2">Nouveau mot de passe</label>
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
                        <InputError :message="form.errors.password" class="mt-2" />
                    </div>

                    <!-- Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-secondaire mb-2">Confirmer le mot de passe</label>
                        <div class="relative">
                            <input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                :type="showPasswordConfirm ? 'text' : 'password'"
                                required
                                placeholder="••••••••"
                                class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-principal/10 focus:border-principal transition-all duration-200"
                            />
                            <button type="button" @click="showPasswordConfirm = !showPasswordConfirm" class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-secondaire">
                                <svg v-if="!showPasswordConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.906 5.236m-11.274 0L3 21" /></svg>
                            </button>
                        </div>
                        <InputError :message="form.errors.password_confirmation" class="mt-2" />
                        <p v-if="form.password_confirmation && !passwordsMatch" class="mt-2 text-xs text-red-600 font-medium">
                            Les mots de passe ne correspondent pas
                        </p>
                    </div>

                    <button
                        type="submit"
                        :disabled="form.processing || !isPasswordStrong || !passwordsMatch"
                        class="w-full py-4 bg-principal hover:bg-principal/90 disabled:bg-gray-300 text-white font-extrabold rounded-2xl shadow-lg shadow-principal/20 transform active:scale-95 transition-all duration-200"
                    >
                        <span v-if="!form.processing">Mettre à jour le mot de passe</span>
                        <span v-else class="flex items-center justify-center">
                            <svg class="animate-spin h-5 w-5 mr-3 text-white" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Traitement...
                        </span>
                    </button>
                </form>
                
                <div class="mt-8 text-center">
                    <Link :href="route('login')" class="text-sm font-bold text-principal hover:underline">
                        Retour à la connexion
                    </Link>
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
</style>
