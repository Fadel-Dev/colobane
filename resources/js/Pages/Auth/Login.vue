<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Navbar from '@/Components/Navbar.vue'

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head>
        <title>Se connecter - Noflay</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </Head>

    <header>
        <Navbar />
    </header>

    <main class="min-h-[90vh] flex items-center justify-center bg-gradient-to-br from-blue-50 to-gray-100 p-4 md:p-8">
        <div class="w-full max-w-6xl bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Image Section -->
                <div class="hidden md:block md:w-1/2 relative bg-blue-600 min-h-[500px]">
                    <div class="absolute inset-0 bg-[url('https://cdn.pixabay.com/photo/2022/04/18/04/31/house-7139392_1280.png')] bg-cover bg-center opacity-90"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/70 to-blue-600/50"></div>
                    <div class="relative h-full flex items-center justify-center p-8">
                        <div class="text-center text-white">
                            <h2 class="text-3xl lg:text-4xl font-bold mb-6 leading-tight">
                                Noflay simplifie votre quotidien
                            </h2>
                            <p class="text-lg opacity-90">
                                Une plateforme innovante pour gérer vos projets en toute simplicité
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="w-full md:w-1/2 p-6 sm:p-8 lg:p-10">
                    <div class="max-w-md mx-auto">
                        <div class="text-center mb-8">
                            <AuthenticationCardLogo class="mx-auto h-16 w-auto" />
                            <h1 class="mt-4 text-2xl font-bold text-gray-900">Connectez-vous à votre compte</h1>
                            <p class="mt-2 text-sm text-gray-600">
                                Ou <Link :href="route('register')" class="font-medium text-principal hover:text-troisieme">créez un compte</Link>
                            </p>
                        </div>

                        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                            {{ status }}
                        </div>

                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <InputLabel for="email" value="Email" class="sr-only" />
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-200"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Adresse email"
                                />
                                <InputError class="mt-1 text-sm text-red-600" :message="form.errors.email" />
                            </div>

                            <div>
                                <InputLabel for="password" value="Mot de passe" class="sr-only" />
                                <TextInput
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-200"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Mot de passe"
                                />
                                <InputError class="mt-1 text-sm text-red-600" :message="form.errors.password" />
                            </div>

                            <div class="flex items-center justify-between">
                                <label class="flex items-center">
                                    <Checkbox v-model:checked="form.remember" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                                    <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                                </label>

                                <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-principal hover:text-troisieme hover:underline">
                                    Mot de passe oublié ?
                                </Link>
                            </div>

                            <div>
                                <PrimaryButton
                                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-red-400 to-red-500 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200"
                                    :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                                    :disabled="form.processing"
                                >
                                    <span v-if="form.processing" class="flex items-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Connexion en cours...
                                    </span>
                                    <span v-else>
                                        Se connecter
                                    </span>
                                </PrimaryButton>
                            </div>
                        </form>

                        <div class="mt-6">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">
                                        Nouveau sur Noflayhub ?
                                    </span>
                                </div>
                            </div>

                            <div class="mt-4 text-center hover:text-principal">
                                <Link :href="route('register')" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-200 transition-all duration-200">
                                    Créer un compte
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
@media (max-width: 767px) {
    .min-h-[90vh] {
    min-height: calc(100vh - 80px);
}
}
</style>
