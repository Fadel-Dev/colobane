<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';

const hoveredCard = ref(null);
</script>

<template>
  <AppLayout title="Publier une annonce">
    <Head title="Publier une annonce" />

    <div class="min-h-screen bg-gradient-to-b from-gray-50 via-white to-gray-50">
      <!-- Hero Section Premium -->
      <div class="bg-gradient-to-br from-principal via-principal/90 to-secondaire text-white py-16 sm:py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center mb-12">
            <div class="inline-block mb-4 px-4 py-2 bg-white/20 rounded-full backdrop-blur-md border border-white/30">
              <span class="text-sm font-semibold">🚀 Vendez ou louez plus vite</span>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
              Publiez votre bien en <span class="text-yellow-300">2 minutes</span>
            </h1>
            <p class="text-lg sm:text-xl text-white/90 max-w-3xl mx-auto">
              Rejoignez des milliers d'annonceurs qui vendent ou louent leurs biens sur NoflayHub. Gratuit, simple et efficace.
            </p>
          </div>

          <!-- Stats -->
          <div class="grid grid-cols-3 gap-4 sm:gap-8 text-center">
            <div class="bg-white/10 rounded-lg p-4 backdrop-blur-sm border border-white/20">
              <div class="text-2xl sm:text-3xl font-bold">50K+</div>
              <p class="text-sm text-white/80">Annonces actives</p>
            </div>
            <div class="bg-white/10 rounded-lg p-4 backdrop-blur-sm border border-white/20">
              <div class="text-2xl sm:text-3xl font-bold">100K+</div>
              <p class="text-sm text-white/80">Visiteurs/mois</p>
            </div>
            <div class="bg-white/10 rounded-lg p-4 backdrop-blur-sm border border-white/20">
              <div class="text-2xl sm:text-3xl font-bold">⭐ 4.8</div>
              <p class="text-sm text-white/80">Rating utilisateurs</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <!-- Pricing & Benefits Banner -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border-2 border-blue-200 p-8 sm:p-10 mb-12">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div>
              <div class="flex items-center mb-4">
                <span class="text-3xl mr-3">🎁</span>
                <h3 class="text-2xl font-bold text-gray-900">Plan Gratuit</h3>
              </div>
              <ul class="space-y-3">
                <li class="flex items-center text-gray-700">
                  <i class="bi bi-check-circle text-green-500 mr-3 text-xl"></i>
                  <span><strong>10 annonces/mois</strong> gratuitement</span>
                </li>
                <li class="flex items-center text-gray-700">
                  <i class="bi bi-check-circle text-green-500 mr-3 text-xl"></i>
                  <span>Mise en avant <strong>immédiate</strong></span>
                </li>
                <li class="flex items-center text-gray-700">
                  <i class="bi bi-check-circle text-green-500 mr-3 text-xl"></i>
                  <span><strong>Visibilité maximale</strong> garantie</span>
                </li>
              </ul>
            </div>
            <div>
              <div class="flex items-center mb-4">
                <span class="text-3xl mr-3">⚡</span>
                <h3 class="text-2xl font-bold text-gray-900">Plan Premium</h3>
              </div>
              <ul class="space-y-3">
                <li class="flex items-center text-gray-700">
                  <i class="bi bi-check-circle text-green-500 mr-3 text-xl"></i>
                  <span><strong>Publications illimitées</strong></span>
                </li>
                <li class="flex items-center text-gray-700">
                  <i class="bi bi-check-circle text-green-500 mr-3 text-xl"></i>
                  <span><strong>Boost automatique</strong> de vos annonces</span>
                </li>
                <li class="flex items-center text-gray-700">
                  <i class="bi bi-check-circle text-green-500 mr-3 text-xl"></i>
                  <span>Accès <strong>prioritaire</strong> au support</span>
                </li>
              </ul>
            </div>
          </div>
          <div class="mt-8 text-center">
            <Link
              href="/infos"
              class="inline-block px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-lg hover:shadow-lg transition-all"
            >
              Voir les forfaits →
            </Link>
          </div>
        </div>

        <!-- Publication Options Grid -->
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4 text-center">
          Publiez votre bien immobilier
        </h2>
        <p class="text-center text-gray-600 mb-12 text-lg">
          Maison, Appartement, Villa, Terrain, Studio, Chambre, Immeuble, Verger, Ferme
        </p>

        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mb-8 max-w-2xl mx-auto">
          <!-- Immobilier Card -->
          <Link
            href="/publication/immobilier/"
            class="group relative overflow-hidden rounded-2xl transition-all duration-300"
            @mouseenter="hoveredCard = 'immobilier'"
            @mouseleave="hoveredCard = null"
          >
            <div class="absolute inset-0 bg-gradient-to-br from-principal to-secondaire opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative bg-white border-2 border-gray-200 group-hover:border-principal rounded-2xl p-8 h-full flex flex-col">
              <!-- Icon with animation -->
              <div class="w-24 h-24 bg-gradient-to-br from-principal/10 to-secondaire/10 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                <i class="bi bi-house-door text-principal text-5xl group-hover:text-white"></i>
              </div>
              
              <!-- Content -->
              <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-white transition-colors">
                Immobilier
              </h3>
              <p class="text-gray-600 mb-6 flex-grow group-hover:text-white/90 transition-colors">
                Maison, Appartement, Villa, Terrain, Studio, Chambre, Immeuble, Verger, Ferme
              </p>
              
              <!-- Features -->
              <div class="space-y-2 mb-6">
                <div class="flex items-center text-sm text-gray-600 group-hover:text-white/90 transition-colors">
                  <i class="bi bi-lightning-fill text-yellow-500 mr-2"></i>
                  <span>Publication en 2 minutes</span>
                </div>
                <div class="flex items-center text-sm text-gray-600 group-hover:text-white/90 transition-colors">
                  <i class="bi bi-images text-blue-500 mr-2"></i>
                  <span>Jusqu'à 15 photos</span>
                </div>
                <div class="flex items-center text-sm text-gray-600 group-hover:text-white/90 transition-colors">
                  <i class="bi bi-graph-up text-green-500 mr-2"></i>
                  <span>Statistiques en temps réel</span>
                </div>
              </div>

              <!-- CTA -->
              <div class="inline-flex items-center text-principal font-bold group-hover:text-white transition-colors">
                Commencer
                <i class="bi bi-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
              </div>
            </div>
          </Link>
        </div>

        <!-- Why Choose Us -->
        <div class="bg-white rounded-2xl border-2 border-gray-200 p-8 sm:p-12 mt-16">
          <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
            Pourquoi choisir NoflayHub ?
          </h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center">
              <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-check-circle-fill text-green-600 text-2xl"></i>
              </div>
              <h3 class="font-bold text-gray-900 mb-2">Gratuit</h3>
              <p class="text-sm text-gray-600">10 annonces gratuites chaque mois</p>
            </div>
            <div class="text-center">
              <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-lightning-fill text-blue-600 text-2xl"></i>
              </div>
              <h3 class="font-bold text-gray-900 mb-2">Rapide</h3>
              <p class="text-sm text-gray-600">Publication en moins de 2 minutes</p>
            </div>
            <div class="text-center">
              <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-eye-fill text-purple-600 text-2xl"></i>
              </div>
              <h3 class="font-bold text-gray-900 mb-2">Visible</h3>
              <p class="text-sm text-gray-600">Vu par 100k+ visiteurs mensuels</p>
            </div>
            <div class="text-center">
              <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-shield-check text-orange-600 text-2xl"></i>
              </div>
              <h3 class="font-bold text-gray-900 mb-2">Sécurisé</h3>
              <p class="text-sm text-gray-600">Plateforme 100% sécurisée et vérifiée</p>
            </div>
          </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-16 text-center">
          <div class="inline-block bg-gradient-to-r from-yellow-400 to-orange-400 rounded-2xl p-1 mb-8">
            <div class="bg-white rounded-xl px-8 py-6">
              <p class="text-gray-600 mb-2 text-sm font-semibold">⏱️ OFFRE LIMITÉE</p>
              <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">
                Publiez maintenant et <span class="text-orange-600">vendez 2x plus vite</span>
              </h3>
              <p class="text-gray-600 mb-6">Rejoignez NoflayHub et multipliez vos chances de succès</p>
              <Link
                href="/publication/immobilier/"
                class="inline-block px-10 py-4 bg-gradient-to-r from-principal to-secondaire text-white font-bold rounded-lg hover:shadow-xl transition-all transform hover:scale-105"
              >
                Publier une annonce gratuitement 🚀
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
/* Smooth transitions */
* {
  transition: all 0.3s ease;
}
</style>
