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
    <div class="nav bg-white w-full  m-0 p-0 fixed top-0 left-0 z-10">
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
<div class="cccc">
    <div class="Home">
        <div class="flex border-b w-full  m-0 p-0 fixed top-11 left-0 z-10">
        <button
          class="w-full  py-2 bg-white text-gray-800 font-semibold"
          :class="{ 'border-b-2 border-blue-500': activeTab === 'immobilier' }"
          @click="activeTab = 'immobilier'"
        >
          Annonces immobilières
        </button>
        <button
          class="w-full px-4 py-2 bg-white text-gray-800 font-semibold"
          :class="{ 'border-b-2 border-blue-500': activeTab === 'vehicule' }"
          @click="activeTab = 'vehicule'"
        >
          Annonces de véhicules
        </button>
      </div>
      <div v-show="activeTab === 'immobilier'">
        <!-- Contenu pour les annonces immobilières -->

         <!-- <div class="mt-16 h-screen w-11/12 mx-auto">
        <div class="w-5/5 mx-auto  grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
          <div v-for="maison in maisons.data" :key="maison.id" @click="navigateToDetail(maison.id)" class="group relative bg-white shadow-[0px_0px_0_0_#00000024] rounded-lg">
            <div class="max-h-[13rem] aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md lg:aspect-none group-hover:opacity-75 lg:h-80"
         >
              <img :src=" '/storage/' + maison.image1" :alt="maison.imageAlt"
                class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
            </div>

            <div class="infos px-3 pb-7 pt-2 ">

              <div class="nomAffaire flex justify-between">
                <div class="nom text-gray-900 text-lg">
                <h3 class="text-md">
                    <span aria-hidden="true" class="absolute inset-0
                   " />
                    {{ maison.nom }}


                </h3>

                <p class="text-sm text-gray-700">
                  <a :href="maison.href">
                    <span aria-hidden="true" class="absolute inset-0" />
                    {{ maison.affaire }}
                  </a> <br>
                   <span class="text-sm font-medium text-gray-900">
                  {{ maison.prix }} Fcfa
                </span> <br>


                </p>

                <span class="text-sm text-gray-500">{{ maison.updated_at }}</span>



              </div>



              </div>

              </div>

            </div> <a href="/detail/2">Teste</a>
            <inertia-link :href="maisons.prev_page_url" v-if="maisons.prev_page_url">Page précédente</inertia-link>
            <inertia-link :href="maisons.next_page_url" v-if="maisons.next_page_url">Page suivante</inertia-link>




          </div>

        </div> -->

<div class="immo w-11/12 mx-auto">

     <div class="flex flex-wrap justify-center mt-20">
      <div v-for="maison  in maisons.data" :key="maison.id" @click="navigateToDetail(maison.id)"  class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-4">
        <div class="bg-white shadow-lg">
          <img :src=" '/storage/' + maison.image1" :alt="maison.imageAlt" class="w-full h-60 object-cover">
          <div class="p-4">
              <h3 class="text-gray-700 text-xl font-semibold">{{ maison.nom }}</h3>
            <p class="text-gray-500">{{ maison.affaire }}</p>

              <p class="text-gray-500"> Proposee par Fadel</p>
            <p class="text-gray-600 text-lg font-semibold">{{ maison.prix }}<span></span></p>
          </div>
        </div>
      </div>
    </div>
</div>

      </div>
      <div v-show="activeTab === 'vehicule'" >
        <div class="flex flex-wrap justify-center mt-20">
       <div v-for="voiture  in voitures.data" :key="voiture.id" @click="navigateToDetail(voiture.id)"  class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-4">
        <div class="bg-white rounded-lg shadow-lg">
          <img :src=" '/storage/' + voiture.image1" :alt="voiture.imageAlt" class="w-full h-60 object-cover">
          <div class="p-4">
              <h3 class="text-gray-700 text-xl font-semibold">{{ voiture.nom }}</h3>
            <p class="text-gray-500">{{ voiture.affaire }}</p>

              <p class="text-gray-500"> Proposee par Fadel</p>
            <p class="text-gray-600 text-lg font-semibold">{{ voiture.prix }}<span></span></p>
          </div>
        </div>
      </div>

    </div>
      </div>
      </div>
</div>

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
