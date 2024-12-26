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
        <title>S inscrire</title>
    </Head>
    <header>
        <Navbar />
    </header>

    <div class="main max-h-1/4">
        <div class="min-w-screen min-h-screen bg-secondaire flex items-center justify-center px-5 py-5">
            <div class="bg-gray-100 text-gray-500 rounded-3xl shadow-xl w-full  overflow-hidden"
                style="max-width:1000px">
                <div class="md:flex w-full  h-screen" id="main">
                    <div class="hidden md:block w-1/2  bg-indigo-500 h-full" id="pic">


                    </div>
                    <div class="w-full  md:w-1/2 py-5 px-5 md:px-10">
                        <AuthenticationCard>
                            <!-- <template #logo >
        <AuthenticationCardLogo  />
    </template> -->
                            <Link :href="'/'">
                            <!-- <span>  </span> -->
                            <router-link to="/publier" class="text-2xl text-principal"></router-link>
                            <img class="w-2/4 mx-auto lg:mx-auto  mx-auto lg:mx-0  p-1"
                                :src="'/storage/slide/NoflayHub.png'" alt="Image logo">

                            </Link>
                            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                                {{ status }}
                            </div>

                            <form @submit.prevent="submit">
                                <div>
                                    <!-- <input for="name" value="Nom" /> -->
                                    <input id="name" v-model="form.name" type="text" class="w-full  bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " required autofocus placeholder="Votre Nom" autocomplete="name" />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>
                                <!-- Phone -->
                                <div class="lg:grid grid-cols-7 gap-2">

                                    <div class="col-span-3 ">
                                        <!-- <InputLabel for="phone" value="Telephone" /> -->
                                        <input id="phone" v-model="form.phone" type="number" class="w-full   bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " placeholder="Votre Telephone" required autofocus autocomplete="phone" />
                                        <InputError class="mt-2" :message="form.errors.phone" />
                                    </div>

                                    <div class="col-span-4">
                                        <!-- <InputLabel for="email" value="Email" /> -->
                                        <input id="email" v-model="form.email" type="email" class="w-full  bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " required placeholder="Votre Mail" autocomplete="username" />
                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div>

                                </div>

                                <div class="mt-4">
                                    <!-- <InputLabel for="password" value="Mots de Passe" /> -->
                                    <input id="password" v-model="form.password" type="password" class="w-full  bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " required placeholder="Votre Mots de passe" autocomplete="new-password" />
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>

                                <div class="mt-4">
                                    <!-- <InputLabel for="password_confirmation" value="Confirmation de Mots de passe" /> -->
                                    <input id="password_confirmation" v-model="form.password_confirmation"
                                        type="password" class="w-full  bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        " required placeholder="Entrez a Nouveau" autocomplete="new-password" />
                                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                </div>

                                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                                    <InputLabel for="terms">
                                        <div class="flex items-center">
                                            <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                                            <div class="ml-2">
                                                I agree to the <a target="_blank" :href="route('terms.show')"
                                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Terms
                                                    of Service</a> and <a target="_blank" :href="route('policy.show')"
                                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Privacy
                                                    Policy</a>
                                            </div>
                                        </div>
                                        <InputError class="mt-2" :message="form.errors.terms" />
                                    </InputLabel>
                                </div>

                                <div class="text-center">



                                    <div class="w-full ">

                                        <PrimaryButton class=" login-button justify-center block w-full  font-bold bg-gradient-to-r from-[#eb2d53] to-[#101634] text-white py-4 mt-5 rounded-[50px] shadow-[0_20px_10px_-15px_rgba(133,189,215,0.878)] border-none transition-transform duration-200 ease-in-out transform hover:scale-105 active:scale-95

    text-center bg-principal hover:bg-secondaire" :class="{ 'opacity-25': form.processing }"
                                            :disabled="form.processing">
                                            S inscrire
                                        </PrimaryButton>
                                    </div>
                                    <div class="mt-2">
                                        <Link :href="route('login')"
                                            class=" text-sm text-gray-600  hover:text-principal rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Deja un Compte ? <span class="text-principal hover:underline"> Se
                                            connecter</span>
                                        </Link>
                                    </div>



                                </div>
                            </form>
                        </AuthenticationCard>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
#pic {
    background: url('https://cdn.pixabay.com/photo/2018/03/21/22/31/pin-up-3248548_1280.png');
    background-size: cover;
}
</style>

<script>
import { Head } from '@inertiajs/vue3';

export default {
    components: {
        Head
    }

}

</script>
