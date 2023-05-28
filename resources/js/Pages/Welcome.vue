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

    <div>
        <div class="flex border-b w-full mt-1  ">
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

        <div class="mt-16">
        <div class="w-4/5 mx-auto  grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
          <div v-for="maison in maisons.data" :key="maison.id" @click="navigateToDetail(maison.id)" class="group relative bg-white shadow-[0px_20px_20px_10px_#00000024] rounded-lg">
            <div
              class="  bg-gray-200">
              <img :src=" '/storage/' + maison.image1" :alt="maison.imageAlt"
                class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
            </div>
<!-- <a href="https://www.leboncoin.fr">teest</a>      -->

             <!-- infos  -->
            <div class="infos px-3 pb-7 pt-2 ">
                <div class="prix text-center">
                <p class="text-sm font-medium text-gray-900">{{ maison.prix }}</p>
              </div>
              <div class="nomAffaire flex justify-between">
                <div class="nom">
                <h3 class="text-sm text-gray-700">
                    <span aria-hidden="true" class="absolute inset-0" />
                    {{ maison.nom }}


                </h3>
              </div>


               <!-- AFFAIRE  -->
              <div class="affaire">
                <h3 class="text-sm text-gray-700">
                  <a :href="maison.href">
                    <span aria-hidden="true" class="absolute inset-0" />
                    {{ maison.affaire }}
                  </a>
                </h3>
              </div>
              </div>
              <div class="region flex justify-between">
                <div class="re">
                  <p class="mt-1 text-sm text-gray-500">{{ maison.region }}</p>
                </div>
                <div class="date">
                  <p class="mt-1 text-sm text-gray-500">{{ maison.updated_at }}</p>

                </div>
              </div>
              <button @click="destroy(maison.id)" type="button" class="bg-red-100 text-center">
            delete
           </button>
              </div>

            </div> <a href="/detail/2">Teste</a>
            <inertia-link :href="maisons.prev_page_url" v-if="maisons.prev_page_url">Page précédente</inertia-link>
            <inertia-link :href="maisons.next_page_url" v-if="maisons.next_page_url">Page suivante</inertia-link>

           <!-- <pagination class="mt-6" :links="maisons.links" /> -->


          </div>

        </div>
      </div>
      <div v-show="activeTab === 'vehicule'" >
        <div class="mt-16">
        <div class="w-4/5 mx-auto  grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
          <div v-for="voiture in voitures.data" :key="voiture.id" class="group relative bg-white shadow-[0px_20px_20px_10px_#00000024] rounded-lg">
            <div
              class="  bg-gray-200">
              <img :src=" '/storage/' + voiture.image1" :alt="voiture.imageAlt"
                class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
            </div>
             <!-- infos  -->
            <div class="infos px-3 pb-7 pt-2 ">
                <div class="prix text-center">
                <p class="text-sm font-medium text-gray-900">{{ voiture.prix }}</p>
              </div>
              <div class="nomAffaire flex justify-between">
                <div class="nom">
                <h3 class="text-sm text-gray-700">
                  <a :href="voiture.href">
                    <span aria-hidden="true" class="absolute inset-0" />
                    {{ voiture.nom }}
                  </a>
                </h3>
              </div>
               <!-- AFFAIRE  -->
              <div class="affaire">
                <h3 class="text-sm text-gray-700">
                  <a :href="voiture.href">
                    <span aria-hidden="true" class="absolute inset-0" />
                    {{ voiture.affaire }}
                  </a>
                </h3>
              </div>
              </div>
              <div class="region flex justify-between">
                <div class="re">
                  <p class="mt-1 text-sm text-gray-500">{{ voiture.region }}</p>
                </div>
                <div class="date">
                  <p class="mt-1 text-sm text-gray-500">{{ voiture.updated_at }}</p>

                </div>
              </div>
              </div>
              <inertia-link :href="voitures.prev_page_url" v-if="voitures.prev_page_url">Page précédente</inertia-link>
               <inertia-link :href="voitures.next_page_url" v-if="voitures.next_page_url">Page suivante</inertia-link>
<button @click="">click me {{ first }} </button>
               <!-- <pagination class="mt-6" :links="voitures.links" /> -->
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
