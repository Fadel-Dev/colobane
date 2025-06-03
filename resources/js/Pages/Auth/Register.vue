<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Navbar from '@/Components/Navbar.vue';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head>
        <title>S'inscrire - Noflay</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </Head>

    <header>
        <Navbar />
    </header>

    <main class="min-h-[90vh] flex items-center justify-center bg-gradient-to-br from-blue-50 to-gray-100 p-4 md:p-8">
        <div class="w-full max-w-6xl bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Image Section -->
                <div class="hidden md:block md:w-1/2 relative bg-red-600 min-h-[600px]">
                    <div class="absolute inset-0 bg-[url('https://cdn.pixabay.com/photo/2022/04/18/04/31/house-7139392_1280.png')] bg-cover bg-center opacity-90"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-red-900/70 to-red-600/50"></div>
                    <div class="relative h-full flex items-center justify-center p-8">
                        <div class="text-center text-white">
                            <h2 class="text-3xl lg:text-4xl font-bold mb-6 leading-tight">
                                Rejoignez la communauté Noflay
                            </h2>
                            <p class="text-lg opacity-90">
                                Créez votre compte en quelques secondes et découvrez toutes nos fonctionnalités
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="w-full md:w-1/2 p-6 sm:p-8 lg:p-10">
                    <div class="max-w-md mx-auto">
                        <div class="text-center mb-8">
                            <img class="w-48 mx-auto" src="/storage/slide/NoflayHub.png" alt="Logo Noflay">
                            <h1 class="mt-4 text-2xl font-bold text-gray-900">Créez votre compte</h1>
                            <p class="mt-2 text-sm text-gray-600">
                                Déjà membre ? <Link :href="route('login')" class="font-medium text-red-400 hover:text-troisieme">Connectez-vous</Link>
                            </p>
                        </div>

                        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                            {{ status }}
                        </div>

                        <form @submit.prevent="submit" class="space-y-4">
                            <div>
                                <InputLabel for="name" value="Nom complet" class="sr-only" />
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-200"
                                    required
                                    autofocus
                                    autocomplete="name"
                                    placeholder="Nom complet"
                                />
                                <InputError class="mt-1 text-sm text-red-600" :message="form.errors.name" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <InputLabel for="phone" value="Téléphone" class="sr-only" />
                                    <TextInput
                                        id="phone"
                                        v-model="form.phone"
                                        type="tel"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-200"
                                        required
                                        autocomplete="tel"
                                        placeholder="Téléphone"
                                    />
                                    <InputError class="mt-1 text-sm text-red-600" :message="form.errors.phone" />
                                </div>

                                <div>
                                    <InputLabel for="email" value="Email" class="sr-only" />
                                    <TextInput
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-200"
                                        required
                                        autocomplete="email"
                                        placeholder="Email"
                                    />
                                    <InputError class="mt-1 text-sm text-red-600" :message="form.errors.email" />
                                </div>
                            </div>

                            <div>
                                <InputLabel for="password" value="Mot de passe" class="sr-only" />
                                <TextInput
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-200"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Mot de passe"
                                />
                                <InputError class="mt-1 text-sm text-red-600" :message="form.errors.password" />
                            </div>

                            <div>
                                <InputLabel for="password_confirmation" value="Confirmation" class="sr-only" />
                                <TextInput
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-blue-500 transition-all duration-200"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Confirmez le mot de passe"
                                />
                                <InputError class="mt-1 text-sm text-red-600" :message="form.errors.password_confirmation" />
                            </div>

                            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                                <label class="flex items-start">
                                    <Checkbox
                                        id="terms"
                                        v-model:checked="form.terms"
                                        name="terms"
                                        class="h-4 w-4 text-red-400 focus:ring-blue-500 border-gray-300 rounded mt-1"
                                        required
                                    />
                                    <span class="ml-2 text-sm text-gray-600">
                                        J'accepte les <a :href="route('terms.show')" target="_blank" class="text-red-400 hover:text-red-500 hover:underline">Conditions d'utilisation</a> et la <a :href="route('policy.show')" target="_blank" class="text-red-400 hover:text-blue-500 hover:underline">Politique de confidentialité</a>
                                    </span>
                                </label>
                                <InputError class="mt-1 text-sm text-red-600" :message="form.errors.terms" />
                            </div>

                            <div class="pt-2">
                                <PrimaryButton
                                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-principal focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondaire transition-all duration-200"
                                    :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                                    :disabled="form.processing"
                                >
                                    <span v-if="form.processing" class="flex items-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Création en cours...
                                    </span>
                                    <span v-else>
                                        S'inscrire
                                    </span>
                                </PrimaryButton>
                            </div>
                        </form>
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
