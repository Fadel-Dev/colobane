<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Footer from '../Components/Footer.vue';
import { Inertia } from '@inertiajs/inertia';

</script>
<template>
  <AppLayout title="publier">
    <!-- NAVBAR SPÉCIFIQUE PUBLISHER -->
    <nav class="fixed top-0 left-0 w-full z-50 flex items-center justify-between px-6 py-3 bg-white/60 backdrop-blur-lg border-b border-white/30 shadow-md">
      <a :href="route('home')" class="text-principal font-bold text-base md:text-lg flex items-center gap-2 hover:underline">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
        Accueil
      </a>
      <a :href="route('home')" class="flex items-center justify-center">
        <img class="h-10 md:h-12 w-auto" src="/storage/slide/NoflayHub.png" alt="NoflayHub Logo" />
      </a>
      <template v-if="$page.props.auth && $page.props.auth.user">
        <a :href="route('dashboard')" class="px-5 py-2 bg-principal text-white rounded-lg font-semibold hover:bg-principal/90 transition-all duration-300 shadow-md">Mon espace</a>
      </template>
      <template v-else>
        <a :href="route('login')" class="px-5 py-2 bg-principal text-white rounded-lg font-semibold hover:bg-principal/90 transition-all duration-300 shadow-md">Se connecter</a>
      </template>
    </nav>
    <div class="relative pt-20"> <!-- pt-20 pour laisser la place au navbar -->
      <!-- BACKGROUND SVG ILLUSTRATIONS -->
      <div class="pointer-events-none select-none fixed inset-0 z-0 flex justify-center items-end opacity-20 md:opacity-30" aria-hidden="true">
        <div class="flex flex-row flex-wrap gap-8 w-full max-w-5xl mx-auto pb-8 justify-center">
          <img src="https://undraw.co/api/illustrations/undraw_home_buying_re_1q6a.svg" alt="Achat Immobilier" class="w-32 md:w-44 lg:w-56 h-auto" />
          <img src="https://undraw.co/api/illustrations/undraw_city_driver_re_0x5e.svg" alt="Vente Voiture" class="w-32 md:w-44 lg:w-56 h-auto" />
          <img src="https://undraw.co/api/illustrations/undraw_mobile_payments_re_7udl.svg" alt="Facilité Mobile" class="w-32 md:w-44 lg:w-56 h-auto" />
          <img src="https://undraw.co/api/illustrations/undraw_add_to_cart_re_wrdo.svg" alt="Marketplace" class="w-32 md:w-44 lg:w-56 h-auto" />
          </div>
              </div>
      <!-- MAIN CONTENT -->
      <main class="antialiased min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 relative z-10">
        <div class="relative block md:flex items-stretch gap-8 w-full max-w-6xl justify-center mx-auto">
          <!-- Offres Section (Gauche) -->
          <div class="w-full md:w-1/2 relative z-1 pb-10 rounded-3xl shadow-xl overflow-hidden bg-white/60 backdrop-blur-lg border border-white/30 flex flex-col justify-between mx-auto">
            <div class="text-lg font-extrabold text-principal uppercase p-8 text-center border-b border-gray-200 tracking-widest bg-gradient-to-r from-principal/80 to-secondaire/80 text-white shadow-md">
              <a :href="route('home')" class="text-2xl md:text-3xl font-black font-sans tracking-wider hover:underline">
                Noflay
              </a>
            </div>
            <!-- Offres -->
            <div class="flex flex-col md:flex-row items-center justify-center bg-transparent py-8 gap-8">
              <div class="flex-1 text-center">
                <div class="inline-flex items-center gap-2 text-2xl font-bold text-principal">
                  <span>0 Fcfa</span>
                  <span class="text-lg font-normal text-gray-700">/ 10 articles/mois</span>
                </div>
                <div class="mt-2 text-sm text-gray-600">Publier 5 Immobiliers</div>
                <div class="text-sm text-gray-600">Publier 5 Voitures</div>
              </div>
              <div class="flex-1 text-center">
                <div class="inline-flex items-center gap-2 text-xl font-bold text-principal">
                  <span>Ouvrir votre boutique</span>
                  <span class="text-lg text-principal hover:text-red-800 transition">
                    <a href="/infos">En savoir plus</a>
                </span>
                </div>
                <div class="mt-2 text-sm text-gray-600">Publication illimitée</div>
                <div class="text-sm text-gray-600">Booster vos articles</div>
              </div>
            </div>
            <!-- Avantages -->
            <ul class="flex flex-col gap-4 justify-center items-center py-6">
              <li class="flex items-center gap-3">
                <div class="bg-principal/90 rounded-full p-3 shadow-lg">
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M11 3.05V2a1 1 0 0 1 2 0v1.05A10 10 0 0 1 22 13c0 1.33-2 1.33-2 0a2 2 0 1 0-4 0c0 1.33-2 1.33-2 0a2 2 0 1 0-4 0c0 1.33-2 1.33-2 0a2 2 0 1 0-4 0c0 1.33-2 1.33-2 0a10 10 0 0 1 9-9.95z"/><path d="M11 14a1 1 0 0 1 2 0v5a3 3 0 0 1-6 0 1 1 0 0 1 2 0 1 1 0 0 0 2 0v-5z"/></svg>
                </div>
                <span class="text-gray-800 text-lg font-semibold">Publiez gratuitement jusqu'à 10 articles/mois</span>
              </li>
              <li class="flex items-center gap-3">
                <div class="bg-principal/90 rounded-full p-3 shadow-lg">
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M5 8h14a1 1 0 0 1 1 .92l1 12A1 1 0 0 1 20 22H4a1 1 0 0 1-1-1.08l1-12A1 1 0 0 1 5 8z"/><path d="M9 10a1 1 0 0 1-2 0V7a5 5 0 1 1 10 0v3a1 1 0 0 1-2 0V7a3 3 0 0 0-6 0v3z"/></svg>
                </div>
                <span class="text-gray-800 text-lg font-semibold">Créez une boutique avec publications illimitées</span>
              </li>
              <li class="flex items-center gap-3">
                <div class="bg-principal/90 rounded-full p-3 shadow-lg">
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M14 13h6.78a1 1 0 0 1 .97 1.22A10 10 0 1 1 9.78 2.25a1 1 0 0 1 1.22.97V10a3 3 0 0 0 3 3z"/><path d="M20.78 11H14a1 1 0 0 1-1-1V3.22a1 1 0 0 1 1.22-.97c3.74.85 6.68 3.79 7.53 7.53a1 1 0 0 1-.97 1.22z"/></svg>
                </div>
                <span class="text-gray-800 text-lg font-semibold">Booster vos annonces</span>
              </li>
            </ul>
          </div>
          <!-- Choix publication (Droite) -->
          <div class="w-full md:w-1/2 relative z-0 flex flex-col justify-center items-center px-2 md:px-0 py-10 bg-white/60 backdrop-blur-lg border border-white/30 rounded-3xl shadow-xl mx-auto">
            <div class="w-full flex flex-col md:flex-row gap-8 justify-center items-center">
              <!-- Carte Véhicule -->
              <div class="group card w-full max-w-xs text-principal text-center p-6 rounded-2xl bg-gradient-to-br from-principal/10 to-white/80 shadow-xl border border-principal/20 hover:scale-105 hover:shadow-2xl transition-all duration-300 cursor-pointer">
                <span class="text-2xl w-full p-2 rounded-md font-bold block mb-4">
                  <a href="/publication/voiture/" class="hover:underline">Véhicules</a>
                </span>
                <a href="/publication/voiture/">
                  <img
                  src="https://img.freepik.com/free-photo/stylish-black-woman-car-salon_1157-21402.jpg?w=740&t=st=1701121371~exp=1701121971~hmac=c7423bc1f745be6fc710777ac02ac0a32d7bb860117b5dfdc0fd7e29846c9e00"
                    alt="Véhicule" class="rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-500" />
              </a>
            </div>
              <!-- Carte Immobilier -->
              <div class="group card w-full max-w-xs text-principal text-center p-6 rounded-2xl bg-gradient-to-br from-secondaire/10 to-white/80 shadow-xl border border-secondaire/20 hover:scale-105 hover:shadow-2xl transition-all duration-300 cursor-pointer">
                <span class="text-2xl w-full p-2 rounded-md font-bold block mb-4">
                  <a href="/publication/immobilier/" class="hover:underline">Immobilier</a>
                </span>
                <a href="/publication/immobilier/">
                  <img
                  src="https://img.freepik.com/free-photo/closeup-shot-person-thinking-buying-selling-house_181624-24928.jpg?w=740&t=st=1701121196~exp=1701121796~hmac=55a2bcd198307e4a2bb9bb46cb896c4f64910a6eb0382d605252279fa191b5eb"
                    alt="Immobilier" class="rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-500" />
              </a>
              </div>
            </div>
          </div>
        </div>
      </main>
      </div>
  </AppLayout>
</template>

<style scoped>
main {
  background: linear-gradient(135deg, #f6f8fc 0%, #f1f4f9 100%);
}
.card {
  transition: box-shadow 0.3s, transform 0.3s;
}
.card:hover {
  box-shadow: 0 20px 40px -10px #eb2d53cc, 0 4px 8px -2px #625bff33;
  transform: scale(1.05);
}
.bg-white\/60 {
  background: rgba(255,255,255,0.6);
}
.backdrop-blur-lg {
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
}
</style>
