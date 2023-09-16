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
  <div class="sm:h-[90vh]">
    <div class="nav bg-gray-800 w-full  m-0 p-0 fixed top-0 left-0 z-10">
      <nav
        class="
          px-9
          py-2
          mx-auto
          md:flex md:justify-between md:items-center
          shadow-xl
          relative
          bg-gray-900
          text-white
        "
      >
        <div class="flex items-center justify-between ">
          <Link
            :href="route('home')"
            class="
            w-full
              text-xl
              text-
              font-bold
              md:text-2xl
            text-principal
            font-sans

            "
            >Noflay
          </Link>



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
   <div v-if="canLogin" class="flex">

    <div v-if="$page.props.auth.user" :href="route('publier')" class="mx-2 bg-principal rounded-xl px-2">

<i class="bi bi-node-plus pl-1"></i>
<Link v-if="$page.props.auth.user" :href="route('publier')"
class="font-semibold text-white hover:text-white dark:text-white  dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm ">
Publier une annonce</Link>

</div>






    <div v-if="$page.props.auth.user" :href="route('publier')">
  <Link v-if="$page.props.auth.user" :href="route('dashboard')"
        class="font-semibold text-gray-400 hover:text-white dark:text-gray-400 dark:hover:text-principal focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
      Dashboard</Link>


    </div>







      <div v-else>


        <div class="auth flex">

<div class="mx-2 bg-principal rounded-xl">
    <i class="bi bi-node-plus pl-1"></i>
<Link :href="route('publier')"  class=" px-2 py-0 text-white hover:text-gray-900  dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"> Publier une annonce</Link>


</div>         <i class="bi bi-person-circle mx-1"></i>
<Link :href="route('login')"
            class="font-semibold text-gray-300 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm ">
          Se connecter</Link>

          <Link v-if="canRegister" :href="route('register')"
            class="ml-4 font-semibold text-gray-300 hover:text-white dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm">
          S inscrire</Link>

        </div>
    </div>
</div>
</div>
</div>

      </nav>

    </div>
    <hr>
    <!-- Home -->
<div class="cccc">
    <div class="Home ">

        <div class="flex border-b w-full border-t-[1px] border-gray-200 m-0 p-0 fixed top-11 left-0 z-10">
        <button
          class="w-full  py-2 bg-white text-gray-800 font-semibold"
          :class="{ 'border-b-2 border-principal': activeTab === 'immobilier' }"
          @click="activeTab = 'immobilier'"
        >
          Annonces immobilières
        </button>
        <button
          class="w-full px-4 py-2 bg-white text-gray-800 font-semibold"
          :class="{ 'border-b-2 border-principal': activeTab === 'vehicule' }"
          @click="activeTab = 'vehicule'"
        >
          Annonces de véhicules
        </button>
      </div>
      <div v-show="activeTab === 'immobilier'" class="bg-gray-100">


<div class="immo lg:w-9/12  mx-auto text-gray-800">

     <div class="flex flex-wrap justify-center mt-20">
      <div v-for="maison  in maisons.data" :key="maison.id" @click="navigateToDetail(maison.id)"  class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-2">
        <div class="bg-secondaire rounded-2xl shadow-2xl relative mt-4">
          <img :src=" '/storage/' + maison.image1" :alt="maison.imageAlt" class="w-full h-full object-fill rounded-2xl shadow-lg">

          <div class="p-4">
              <h3 class="text-lg font-semibold text-white">{{ maison.nom }}</h3>
            <p class="text-gray-300">{{ maison.affaire }}</p>

            <p class="text-gray-400"> Proposee par <span class="text-gray-600">Fadel</span> </p>
            <p class="text-principal text-lg">{{ maison.prix }}<span class="text-principal text-opacity-60"> Fcfa</span></p>

          </div>
        </div>
      </div>
    </div>
</div>

      </div>
      <div v-show="activeTab === 'vehicule'" class="bg-gray-100">

        <div class="immo lg:w-8/12 mx-auto text-gray-800  ">
  <div class="flex flex-wrap justify-center mt-20 text-gray-800">
    <div v-for="voiture in voitures.data" :key="voiture.id" @click="navigateToDetailVehi(voiture.id)" class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-2">
      <div class="bg-secondaire rounded-2xl shadow-2xl relative mt-4">
<div class="w-full h-full">
<img :src="'/storage/' + voiture.image1" :alt="voiture.imageAlt"  class="w-full h-full object-fill rounded-2xl shadow-lg">

</div>
        <img class="mb-3 w-[4rem] h-[4rem] rounded-full shadow-2xl absolute bottom-1/3 right-0" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Bonnie image">

        <div class="p-4">
          <h3 class="text-lg font-semibold text-white">{{ voiture.nom }}</h3>
          <p class="text-gray-300">{{ voiture.affaire }}</p>

          <p class="text-gray-400"> Proposée par <span class="text-gray-600">Fadel</span> </p>
          <p class="text-principal text-lg">{{ voiture.prix }}<span class="text-principal text-opacity-60"> Fcfa</span></p>
        </div>
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

nav{
  /* background: red;
  box-shadow: 12px 12px 2px 1px rgba(0, 0, 255, .2); */
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
 { delay: 200,

color: '#eb2d53',

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

  props: {
    usersList: Object,
  },
  methods: {
    navigateToDetail(id) {
      this.$inertia.visit(`/detail/${id}`);
    },
    navigateToDetailVehi(id) {
      this.$inertia.visit(`/detailVehi/${id}`);
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
