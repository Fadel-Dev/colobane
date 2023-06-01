<script setup>
import { Head, Link, router  } from '@inertiajs/vue3';
import Footer from '../Components/Footer.vue';
import { Inertia } from '@inertiajs/inertia';





const props = defineProps({

  voitures:Object,
  maisons:Object,
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});
</script>

<template>
  <Head title="Acceuil" />
  <div>
    <div class="bg-white w-full m-0 p-0">
      <nav
        class="
          px-9
          py-2
          mx-auto
          md:flex md:justify-between md:items-center
        "
      >
        <div class="flex items-center justify-between ">
          <router-link
            to="/"
            class="
            w-full
              text-xl
              font-bold
              text-gray-800
              md:text-2xl
              hover:text-blue-400
            "
            >Logo
          </router-link>

          <!-- <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <form>
              <div class="flexz">
                <input type="text" class="border-2 border-gray-300 bg-white h-10 px-5 pr-10 rounded-full text-sm focus:outline-none" placeholder="Recherche...">
                <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full ml-2">Rechercher</button>
              </div>
            </form>
          </div>
        </div> -->

          <!-- Mobile menu button -->
          <div @click="showMenu = !showMenu" class="flex md:hidden">
            <button
              type="button"
              class="
                text-gray-800
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
  <div
          :class="showMenu ? 'flex' : 'hidden'"
          class="
            flex-col
            mt-8
            space-y-4
            md:flex
            md:space-y-0
            md:flex-row
            md:items-center
            md:space-x-10
            md:mt-0
          "
        >
        <div class="auth">
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
  </div>
        </div>

      </nav>
    </div>
    <!-- Home -->

  </div>

   <!-- FOOTER -->

   <div class="#">
              <Footer/>
            </div>
</template>
<style>
.bg-dots-darker {
  background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
  .dark\:bg-dots-lighter {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
  }
}
</style>
<script>
import {InertiaProgress} from '@inertiajs/progress';
import {Head} from '@inertiajs/vue3'

InertiaProgress.init(
 { delay: 250,

color: '#29d',

includeCSS: true,

showSpinner: true,}
    )

export default {
    data() {
      return {
        activeTab: 'immobilier',
        showMenu: false,
      }
    },
  //   components: {
  //   Pagination
  // },
  props: {
    usersList: Object,
  },
  methods: {
    navigateToDetail(id) {
      this.$inertia.visit(`/detail/${id}`);
    }
  },
  setup(){

    const destroy =(id) => {
        if(confirm("Are you sure") )
        {
            Inertia.delete(route('maisons.destroy',id))
        }
}
return destroy()

  }



  }
  </script>
