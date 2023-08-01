<script setup>
const props = defineProps({

    voitures: Object,
    maisons: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})

</script>

<template>
    <div class="bg-gray-100 ">
        <nav class="
          px-9
          py-2
          mx-auto
          md:flex md:justify-between md:items-center
          shadow-xl
          relative
          bg-black
          text-white
        ">
            <div class="flex items-center justify-between ">
                <router-link to="/" class="
            w-full
              text-xl
              text-
              font-bold
              md:text-2xl
              hover:text-red-600

            ">Noflay
                </router-link>



                <!-- Mobile menu button -->
                <div @click="showMenu = !showMenu" class="flex md:hidden">
                    <button type="button" class="
                text-gray-800
                hover:text-gray-400
                focus:outline-none focus:text-gray-400
              ">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd"
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div :class="showMenu ? 'flex' : 'hidden'" class="
            flex-col
            mt-8
            space-y-4
            md:flex
            md:space-y-0
            md:flex-row
            md:items-center
            md:space-x-10
            md:mt-0
          ">
                <div class="auth">
                    <div v-if="canLogin">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        Dashboard</Link>

                        <div v-else>


                            <div class="auth flex">
                                <div class="text-2xl">
                                    <i class="bi bi-node-plus"></i>
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="28" height="26" fill="currentColor" class="bi bi-node-plus" viewBox="0 0 16 16">
  <path d="M11 13a5 5 0 1 0-4.975-5.5H4A1.5 1.5 0 0 0 2.5 6h-1A1.5 1.5 0 0 0 0 7.5v1A1.5 1.5 0 0 0 1.5 10h1A1.5 1.5 0 0 0 4 8.5h2.025A5 5 0 0 0 11 13zm.5-7.5v2h2a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0v-2h-2a.5.5 0 0 1 0-1h2v-2a.5.5 0 0 1 1 0z"/>
</svg> -->
                                </div>
                                <div class="mx-2">
                                    <Link :href="route('publier')"
                                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                    Publier une annonce</Link>


                                </div> <i class="bi bi-person-circle mx-1"></i>
                                <Link :href="route('login')"
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                Log in</Link>

                                <Link v-if="canRegister" :href="route('register')"
                                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                Register</Link>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </nav>

    </div>
</template>

<style>
@media only screen and (max-width: 767px) {
    #humb {

        position: absolute;
        right: 0;
        top: 0;
    }
}
</style>
<script>
import { ref } from 'vue';
export default {
    setup() {
        let showMenu = ref(false);
        const toggleNav = () => (showMenu.value = !showMenu.value);
        return { showMenu, toggleNav };
    },
};
</script>
