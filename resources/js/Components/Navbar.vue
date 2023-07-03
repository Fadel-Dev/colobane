<script setup>
const props = defineProps({

  voitures:Object,
  maisons:Object,
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
})

</script>

<template>
    <div class="bg-gray-100 ">
      <nav
        class="
          container
          px-6
          py-2
          mx-auto
          md:flex md:justify-between md:items-center
        "
      >
        <div class="flex items-center justify-between">

          <!-- Mobile menu button -->
          <div @click="toggleNav" class="flex md:hidden">
            <button
              type="button"
              class="
                text-gray-500
                hover:text-gray-400
                focus:outline-none focus:text-gray-400
              "
            >
              <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                <path
                  fill-rule="evenodd"
                  d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
                ></path>
              </svg>
            </button>
          </div>
        </div>

        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <!-- Social section -->
        <ul
          :class="showMenu ? 'flex' : 'hidden'"
          class="
            flex-col
            mt-2
            space-y-2
            md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 md:mt-0
          "
        >
        <!-- <li class="md:hidden z-90 fixed top-4 right-6">
                    <a href="javascript:void(0)" class="text-right text-white text-4xl"
                        onclick="toggleMenu()">&times;</a>
                </li> -->


                <li>
                    <a class="text-violet-900  hover:opacity-100 duration-300" href="#home"><i class="fa fa-home"></i>
                        Acceuil</a>
                </li>
                <li>
                    <a class="text-violet-900   hover:opacity-100 duration-300" href="#presentation"><i
                            class="fa fa-person"></i> Presentation</a>
                </li>
                <li>
                    <a class="text-violet-900   hover:opacity-100 duration-300" href="#service"><i class="fa fa-refresh"
                            aria-hidden="true"></i> Service</a>
                </li>
                <!--
                <li>
                    <a class="text-violet-900 hover:opacity-100 duration-300" href="#galery"><i
                            class='far fa-file-image'></i> Galerie</a>
                </li> -->
                <li>
                    <a class="text-violet-900   hover:opacity-100 duration-300" href="#contact"><i
                            class="fa fa-envelope" aria-hidden="true"></i> Contact</a>
                </li>
    </ul>
    <!-- Sectio of the website -->
    <router-link
            to="/"
            class="
              text-xl
              font-bold
              text-gray-100
              md:text-2xl
              hover:text-indigo-400



            "
            id="humb"
            ><img class="w-9 mr-2 mt-2"  src="assets/images/logo7.png" alt="">
          </router-link>
    <ul
          :class="showMenu ? 'flex' : 'hidden'"
          class="
            flex-col
            mt-8
            space-y-4
            md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 md:mt-0
          "
        >
        <!-- <li class="md:hidden z-90 fixed top-4 right-6">
                    <a href="javascript:void(0)" class="text-right text-white text-4xl"
                        onclick="toggleMenu()">&times;</a>
                </li> -->
                <div v-if="canLogin" >
      <Link v-if="$page.props.auth.user" :href="route('dashboard')"
        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
      Dashboard</Link>

      <div v-else>


        <div class="auth">
          <Link :href="route('login')"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
          Log in</Link>

          <Link v-if="canRegister" :href="route('register')"
            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
          Register</Link>

        </div>
      </div>
    </div>
    </ul>
      </nav>

    </div>
  </template>

<style>
@media only screen and (max-width: 767px) {
#humb {

position: absolute;
right: 0;
top:0;
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
