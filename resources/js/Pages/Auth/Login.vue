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
        <title>Se connecter</title>
    </Head>

    <header>
        <Navbar />
    </header>

    <div class="">
        <div class="min-w-screen  flex  justify-center px-5 py-2 my-0">
            <div class="bg-gray-100 h-full my-auto  text-gray-500 rounded-3xl shadow-xl w-full overflow-hidden"
                style="max-width:1000px">
                <div class="md:flex w-full h-screen" id="main">
                    <div class="hidden md:block w-1/2  bg-red-300 h-full" id="pic">

                        <h2 class=" text-center text-3xl mt-10 w-3/5 text-principal mx-auto">
                            Noflay est une plateforme de ...
                        </h2>
                    </div>
                    <div class="w-full md:w-1/2 py-10 px-5 md:px-10">

                        <!-- FOR THE FORM -->


                        <div
                            class="container mx-auto   max-w-sm bg-gradient-to-b from-white to-[#F4F7FB] rounded-[40px] p-6 border-4 border-white shadow-[0_30px_30px_-20px_rgba(133,189,215,0.878)]">
                            <div class="heading text-center font-black text-[30px] text-[#1089D3]">
                                <AuthenticationCardLogo />
                            </div>








                            <form @submit.prevent="submit" class="">
                                <!-- <InputLabel for="email" value="Mail" /> -->
                                <input id="email" v-model="form.email" type="email" class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " required autofocus autocomplete="username" placeholder="Votre adresse email" />
                                <InputError class="mt-2 text-sm text-red-500" :message="form.errors.email" />
                                <!-- </div> -->

                                <!-- Password Input -->
                                <!-- <div class="bg-gray-100 rounded-lg p-4 mb-4"> -->
                                <!-- <InputLabel for="password" value="Mots de passe" /> -->
                                <input id="password" v-model="form.password" type="password" required class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " autocomplete="current-password" placeholder="Votre mot de passe" />
                                <InputError class="mt-2 text-sm text-red-500" :message="form.errors.password" />
                                <!-- </div> -->

                                <!-- Remember Me and Forgot Password Links -->
                                <div class="flex items-center justify-between mt-4">
                                    <label class="flex items-center cursor-pointer">
                                        <Checkbox v-model:checked="form.remember" name="remember"
                                            class="text-principal focus:ring-principal" />
                                        <span class="ml-2 text-sm text-gray-600 hover:text-principal">Se
                                            souvenir de
                                            moi</span>
                                    </label>

                                    <Link v-if="canResetPassword" :href="route('password.request')"
                                        class="text-sm text-gray-600">
                                    Mot de passe oublié ?
                                    </Link>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex items-center justify-center">
                                    <PrimaryButton class="


    login-button justify-center block w-full font-bold bg-gradient-to-r from-[#eb2d53] to-[#101634] text-white py-4 mt-5 rounded-[50px] shadow-[0_20px_10px_-15px_rgba(133,189,215,0.878)] border-none transition-transform duration-200 ease-in-out transform hover:scale-105 active:scale-95

    text-center bg-principal hover:bg-secondaire" :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                        {{ form.processing ? 'Connexion en cours...' : 'Se connecter' }}
                                    </PrimaryButton>
                                </div>

                                <div class="social-account-container mt-6">
                                    <span class="title block text-center text-xs text-gray-500">Ou S inscrire
                                    </span>
                                    <div class="social-accounts flex justify-center gap-4 mt-1">
                                        <!-- <button class="social-button bg-gradient-to-r from-black to-gray-500 border-4 border-white p-1.5 rounded-full w-10 h-10 flex items-center justify-center shadow-[0_12px_10px_-8px_rgba(133,189,215,0.878)] transition-transform duration-200 ease-in-out transform hover:scale-120 active:scale-90">
        <svg class="svg w-6 h-6 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
          <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path>
        </svg>
      </button> -->
                                        <!-- <div class="w-full bg-red-300 hover:border-2   hover:bg-principal   p-2 text-center rounded-lg my-9 text-white"> -->

                                        <Link class="text-red-500 hover:text-principal" :href="route('register')">Cree
                                        Un Compte</Link>

                                        <!-- </div> -->
                                    </div>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { Head } from '@inertiajs/vue3';

export default {
    components: {
        Head
    }

}

</script>

<style>
#main {
    max-height: 75vh;
    margin: 0;
    align-content: center;
    align-items: center;
}

#pic {
    background: url('https://cdn.pixabay.com/photo/2018/03/21/22/31/pin-up-3248548_1280.png');
    background-size: cover;
}
</style>
