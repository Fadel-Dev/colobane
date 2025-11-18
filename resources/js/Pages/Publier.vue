<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
  <AppLayout title="Publier une annonce">
    <Head title="Publier une annonce" />

    <div class="min-h-screen bg-gray-50">
      <!-- Simple Header -->
      <div class="bg-white border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <h1 class="text-3xl font-bold text-gray-900 text-center mb-2">
            Publier une annonce
          </h1>
          <p class="text-gray-600 text-center">
            Choisissez le type de bien que vous souhaitez publier
          </p>
        </div>
      </div>

      <!-- Main Content -->
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Pricing Info -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8 text-center">
          <div class="flex flex-wrap justify-center gap-6">
            <div>
              <p class="text-sm text-gray-600">Plan gratuit</p>
              <p class="text-xl font-bold text-gray-900">10 articles/mois</p>
            </div>
            <div class="w-px bg-gray-200"></div>
            <div>
              <p class="text-sm text-gray-600">Boutique</p>
              <p class="text-xl font-bold text-gray-900">Publications illimitées</p>
            </div>
          </div>
          <Link
            href="/infos"
            class="inline-block mt-4 text-principal hover:text-principal-dark font-medium text-sm"
          >
            En savoir plus →
          </Link>
        </div>

        <!-- Publication Card -->
        <div class="bg-white rounded-xl border-2 border-gray-200 hover:border-principal transition-colors overflow-hidden">
          <Link
            href="/publication/immobilier/"
            class="block p-8 md:p-12"
          >
            <div class="flex flex-col md:flex-row items-center gap-6">
              <div class="w-20 h-20 bg-principal rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="bi bi-house-door text-white text-4xl"></i>
              </div>
              <div class="flex-1 text-center md:text-left">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                  Publier un bien immobilier
                </h2>
                <p class="text-gray-600 mb-4">
                  Maison, Appartement, Villa, Terrain, Studio, Chambre, Immeuble, Locaux commerciaux, Verger
                </p>
                <span class="inline-flex items-center text-principal font-semibold">
                  Commencer
                  <i class="bi bi-arrow-right ml-2"></i>
                </span>
              </div>
            </div>
          </Link>
        </div>

        <!-- Simple Features -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
          <div class="p-4">
            <i class="bi bi-check-circle text-green-500 text-2xl mb-2"></i>
            <p class="text-sm text-gray-600">Gratuit jusqu'à 10 articles</p>
          </div>
          <div class="p-4">
            <i class="bi bi-lightning text-principal text-2xl mb-2"></i>
            <p class="text-sm text-gray-600">Boost disponible</p>
          </div>
          <div class="p-4">
            <i class="bi bi-shield-check text-blue-500 text-2xl mb-2"></i>
            <p class="text-sm text-gray-600">Sécurisé et fiable</p>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
