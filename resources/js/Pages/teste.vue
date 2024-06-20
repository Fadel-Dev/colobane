<template>
    <Head title="Accueil" />
    <div>
      <!-- Navigation -->
      <nav class="nav bg-gray-800 w-full fixed top-0 left-0 z-10">
        <div class="px-4 py-2 mx-auto md:flex md:justify-between md:items-center shadow-xl bg-gray-900 text-white">
          <Link :href="route('home')" class="text-xl font-bold md:text-2xl text-principal">
            Noflay
          </Link>
          <!-- Mobile menu button -->
          <div @click="showMenu = !showMenu" class="flex md:hidden">
            <button type="button" class="text-gray-400 hover:text-gray-200 focus:outline-none">
              <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                <path d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
              </svg>
            </button>
          </div>
          <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
          <div :class="showMenu ? 'flex' : 'hidden'" class="flex-col md:flex md:space-x-10 md:items-center md:space-y-0 space-y-4 mt-4">
            <div v-if="canLogin" class="flex flex-col md:flex-row">
              <Link v-if="$page.props.auth.user" :href="route('publier')" class="btn-primary">Publier une annonce</Link>
              <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="btn-secondary md:ml-4 mt-2 md:mt-0">Dashboard</Link>
            </div>
            <div v-else>
              <Link :href="route('publier')" class="btn-primary">Publier une annonce</Link>
              <Link :href="route('login')" class="btn-secondary md:ml-4 mt-2 md:mt-0">Se connecter</Link>
            </div>
          </div>
        </div>
      </nav>

      <!-- Tabs and Content -->
      <div class="mt-20">
        <div class="flex w-full border-b border-t-[1px] border-gray-200">
          <button @click="activeTab = 'immobilier'" :class="{'border-b-2 border-principal': activeTab === 'immobilier'}" class="w-1/2 py-2 bg-white text-gray-800 font-semibold">Annonces immobilières</button>
          <button @click="activeTab = 'vehicule'" :class="{'border-b-2 border-principal': activeTab === 'vehicule'}" class="w-1/2 py-2 bg-white text-gray-800 font-semibold">Annonces de véhicules</button>
        </div>

        <div class="max-w-[70vw] mx-auto mt-8">
          <!-- Immobilier Tab -->
          <div v-if="activeTab === 'immobilier'" class="bg-gray-100">
            <div class="swiper">
              <div class="swiper-wrapper">
                <div v-for="immobillierBoost in immobilliersBoost.data" :key="immobillierBoost.id" @click="navigateToDetail(immobillierBoost.id)" class="swiper-slide w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-2">
                  <!-- Immobilier Card -->
                  <div class="card">
                    <img :src="'/storage/' + immobillierBoost.image1" :alt="immobillierBoost.imageAlt" class="object-cover w-full h-60 rounded-xl shadow-lg">
                    <div class="p-4">
                      <h3 class="text-lg font-semibold text-white">{{ immobillierBoost.nom }}</h3>
                      <p class="text-gray-300">{{ immobillierBoost.affaire }}</p>
                      <p class="text-principal text-lg">{{ immobillierBoost.prix }} Fcfa</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <!-- Vehicule Tab -->
          <div v-else-if="activeTab === 'vehicule'" class="bg-gray-100">
            <div class="swiper">
              <div class="swiper-wrapper">
                <div v-for="voitureBoost in voituresBoost.data" :key="voitureBoost.id" @click="navigateToDetailVehi(voitureBoost.id)" class="swiper-slide w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-2">
                  <!-- Vehicule Card -->
                  <div class="card">
                    <img :src="'/storage/' + voitureBoost.image1" :alt="voitureBoost.imageAlt" class="object-cover w-full h-60 rounded-xl shadow-lg">
                    <div class="p-4">
                      <h3 class="text-lg font-semibold text-white">{{ voitureBoost.nom }}</h3>
                      <p class="text-gray-300">{{ voitureBoost.affaire }}</p>
                      <p class="text-principal text-lg">{{ voitureBoost.prix }} Fcfa</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="mt-20">
        <Footer />
      </div>
    </div>
  </template>

  <style scoped>
  .nav {
    z-index: 50;
  }
  .card {
    background-color: #ffffff;
    border-radius: 1rem;
    box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
  }
  .swiper {
    margin-top: 10%;
  }
  @media (max-width: 640px) {
    .swiper-slide {
      width: calc(100% / 3);
    }
  }
  @media (max-width: 768px) {
    .nav {
      padding: 0.5rem;
    }
    .card {
      margin-bottom: 1rem;
    }
  }
  </style>

  <script setup>
  import { defineProps } from 'vue';
  import { Head, Link } from '@inertiajs/vue3';
  import { Inertia } from '@inertiajs/inertia';

  const props = defineProps({
    voitures: Object,
    voituresBoost: Object,
    immobilliersBoost: Object,
    maisons: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  });
  </script>

  <script>
  import { InertiaProgress } from '@inertiajs/progress';

  export default {
    data() {
      return {
        activeTab: 'immobilier',
        showMenu: false,
      };
    },
    methods: {
      navigateToDetail(id) {
        this.$inertia.visit(`/detail/${id}`);
      },
      navigateToDetailVehi(id) {
        this.$inertia.visit(`/detailVehi/${id}`);
      },
    },
    mounted() {
      // Initialize Swiper
      new Swiper('.swiper', {
        slidesPerView: 'auto',
        spaceBetween: 20,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
      });

      // Initialize progress bar
      InertiaProgress.init({
        delay: 200,
        color: '#eb2d53',
        includeCSS: true,
        showSpinner: true,
      });
    },
  };
  </script>
