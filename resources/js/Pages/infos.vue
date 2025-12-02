<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const selectedPlan = ref('standard');
const activeFaq = ref(null);
</script>

<template>
  <AppLayout title="Plans & Tarification">
    <Head title="Plans & Tarification - NoflayHub" />

    <div class="min-h-screen bg-gradient-to-b from-gray-50 via-white to-gray-50">
      <!-- Hero Section -->
      <div class="bg-gradient-to-br from-principal via-principal/90 to-secondaire text-white py-16 sm:py-24">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <div class="inline-block mb-6 px-4 py-2 bg-white/20 rounded-full backdrop-blur-md border border-white/30">
            <span class="text-sm font-semibold">💰 Tarification Transparente</span>
          </div>
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
            Des plans pour <span class="text-yellow-300">tous les vendeurs</span>
          </h1>
          <p class="text-lg text-white/90 max-w-3xl mx-auto">
            Commencez gratuitement, upgradez quand vous êtes prêt. Pas de frais cachés, annulation à tout moment.
          </p>
        </div>
      </div>

      <!-- Main Content -->
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
        <!-- Plans Grid -->
        <h2 class="text-3xl sm:text-4xl font-bold text-center mb-4 text-gray-900">
          Choisissez votre plan
        </h2>
        <p class="text-center text-gray-600 mb-12 text-lg">
          Sélectionnez le forfait qui correspond le mieux à vos besoins
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
          <!-- Starter Plan -->
          <div 
            class="relative group"
            @mouseenter="selectedPlan = 'starter'"
            @mouseleave="selectedPlan = 'starter'"
          >
            <div class="absolute -inset-1 bg-gradient-to-r from-gray-100 to-gray-200 rounded-2xl blur-xl opacity-75 group-hover:opacity-100 transition duration-300"></div>
            <div class="relative bg-white rounded-2xl border-2 border-gray-200 p-8 h-full flex flex-col hover:border-principal transition-all duration-300">
              <div class="mb-6">
                <div class="inline-block px-4 py-2 bg-gray-100 rounded-full text-gray-700 font-semibold text-sm mb-4">
                  🎁 Gratuit
                </div>
                <h3 class="text-2xl font-bold text-gray-900">Starter</h3>
                <p class="text-gray-600 text-sm mt-1">Parfait pour débuter</p>
              </div>

              <div class="mb-6">
                <div class="text-4xl font-bold text-gray-900">0 <span class="text-lg text-gray-600">FCFA</span></div>
                <p class="text-gray-600 text-sm mt-1">Pour toujours gratuit</p>
              </div>

              <Link
                href="/publication/immobilier/"
                class="w-full py-3 px-4 bg-gray-100 text-gray-900 font-bold rounded-lg hover:bg-gray-200 transition-all duration-300 text-center mb-6"
              >
                Commencer gratuitement
              </Link>

              <ul class="space-y-3 flex-grow">
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-green-500 mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700"><strong>10 annonces</strong> par mois</span>
                </li>
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-green-500 mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700"><strong>15 photos</strong> par annonce</span>
                </li>
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-green-500 mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700">Visibilité <strong>standard</strong></span>
                </li>
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-green-500 mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700">Support <strong>par email</strong></span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Professional Plan - Highlighted -->
          <div 
            class="relative group md:scale-105 md:-translate-y-4"
            @mouseenter="selectedPlan = 'professional'"
            @mouseleave="selectedPlan = 'professional'"
          >
            <div class="absolute -inset-1 bg-gradient-to-r from-principal to-secondaire rounded-2xl blur-xl opacity-75 group-hover:opacity-100 transition duration-300"></div>
            <div class="relative bg-white rounded-2xl border-2 border-principal p-8 h-full flex flex-col">
              <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                <div class="bg-gradient-to-r from-principal to-secondaire text-white px-6 py-2 rounded-full font-bold text-sm">
                  ⭐ PLUS POPULAIRE
                </div>
              </div>
              
              <div class="mb-6 mt-6">
                <div class="inline-block px-4 py-2 bg-gradient-to-r from-principal/10 to-secondaire/10 rounded-full text-principal font-semibold text-sm mb-4">
                  ⚡ Pro
                </div>
                <h3 class="text-2xl font-bold text-gray-900">Professional</h3>
                <p class="text-gray-600 text-sm mt-1">Pour les vendeurs sérieux</p>
              </div>

              <div class="mb-6">
                <div class="text-4xl font-bold text-principal">9,999 <span class="text-lg text-gray-600">FCFA</span></div>
                <p class="text-gray-600 text-sm mt-1">/mois, flexible</p>
              </div>

              <Link
                href="/publication/immobilier/"
                class="w-full py-3 px-4 bg-gradient-to-r from-principal to-secondaire text-white font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center mb-6"
              >
                Choisir ce plan
              </Link>

              <ul class="space-y-3 flex-grow">
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-principal mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700"><strong>50 annonces</strong> par mois</span>
                </li>
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-principal mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700"><strong>25 photos</strong> par annonce</span>
                </li>
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-principal mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700">Visibilité <strong>haute priorité</strong></span>
                </li>
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-principal mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700"><strong>2 boost</strong> gratuits/mois</span>
                </li>
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-principal mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700">Support <strong>prioritaire</strong></span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Premium Plan -->
          <div 
            class="relative group"
            @mouseenter="selectedPlan = 'premium'"
            @mouseleave="selectedPlan = 'premium'"
          >
            <div class="absolute -inset-1 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-2xl blur-xl opacity-75 group-hover:opacity-100 transition duration-300"></div>
            <div class="relative bg-white rounded-2xl border-2 border-yellow-300 p-8 h-full flex flex-col hover:border-orange-300 transition-all duration-300">
              <div class="mb-6">
                <div class="inline-block px-4 py-2 bg-yellow-100 rounded-full text-yellow-700 font-semibold text-sm mb-4">
                  👑 Premium
                </div>
                <h3 class="text-2xl font-bold text-gray-900">Premium</h3>
                <p class="text-gray-600 text-sm mt-1">Pour les pro du secteur</p>
              </div>

              <div class="mb-6">
                <div class="text-4xl font-bold text-orange-600">24,999 <span class="text-lg text-gray-600">FCFA</span></div>
                <p class="text-gray-600 text-sm mt-1">/mois, avec tous les avantages</p>
              </div>

              <Link
                href="/publication/immobilier/"
                class="w-full py-3 px-4 bg-gradient-to-r from-yellow-400 to-orange-400 text-white font-bold rounded-lg hover:shadow-lg transition-all duration-300 text-center mb-6"
              >
                Accéder au premium
              </Link>

              <ul class="space-y-3 flex-grow">
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-orange-500 mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700"><strong>Annonces illimitées</strong></span>
                </li>
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-orange-500 mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700"><strong>50 photos</strong> par annonce</span>
                </li>
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-orange-500 mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700">Visibilité <strong>maximale</strong></span>
                </li>
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-orange-500 mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700"><strong>10 boost</strong> gratuits/mois</span>
                </li>
                <li class="flex items-start">
                  <i class="bi bi-check-circle-fill text-orange-500 mr-3 mt-0.5 flex-shrink-0"></i>
                  <span class="text-gray-700"><strong>Support 24/7</strong> dédié</span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Comparison Table -->
        <div class="bg-white rounded-2xl border-2 border-gray-200 overflow-hidden mb-16">
          <div class="px-8 py-6 bg-gray-50 border-b border-gray-200">
            <h3 class="text-2xl font-bold text-gray-900">Comparaison détaillée</h3>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead>
                <tr class="border-b border-gray-200">
                  <th class="text-left px-8 py-4 font-bold text-gray-900">Fonctionnalités</th>
                  <th class="text-center px-6 py-4 font-bold text-gray-900">Starter</th>
                  <th class="text-center px-6 py-4 font-bold text-principal">Professional</th>
                  <th class="text-center px-6 py-4 font-bold text-orange-600">Premium</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                  <td class="px-8 py-4 text-gray-700">Annonces/mois</td>
                  <td class="text-center px-6 py-4"><strong>10</strong></td>
                  <td class="text-center px-6 py-4"><strong class="text-principal">50</strong></td>
                  <td class="text-center px-6 py-4"><strong class="text-orange-600">Illimitées</strong></td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                  <td class="px-8 py-4 text-gray-700">Photos/annonce</td>
                  <td class="text-center px-6 py-4"><strong>15</strong></td>
                  <td class="text-center px-6 py-4"><strong class="text-principal">25</strong></td>
                  <td class="text-center px-6 py-4"><strong class="text-orange-600">50</strong></td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                  <td class="px-8 py-4 text-gray-700">Boost gratuits/mois</td>
                  <td class="text-center px-6 py-4">-</td>
                  <td class="text-center px-6 py-4"><i class="bi bi-check-circle-fill text-principal"></i></td>
                  <td class="text-center px-6 py-4"><strong class="text-orange-600">10</strong></td>
                </tr>
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                  <td class="px-8 py-4 text-gray-700">Support</td>
                  <td class="text-center px-6 py-4">Email</td>
                  <td class="text-center px-6 py-4">Prioritaire</td>
                  <td class="text-center px-6 py-4"><strong class="text-orange-600">24/7</strong></td>
                </tr>
                <tr class="hover:bg-gray-50">
                  <td class="px-8 py-4 text-gray-700">Prix</td>
                  <td class="text-center px-6 py-4"><strong>Gratuit</strong></td>
                  <td class="text-center px-6 py-4"><strong class="text-principal">9,999 FCFA</strong></td>
                  <td class="text-center px-6 py-4"><strong class="text-orange-600">24,999 FCFA</strong></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- FAQ Section -->
        <div class="mb-16">
          <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">
            Questions fréquentes
          </h2>
          
          <div class="space-y-4 max-w-3xl mx-auto">
            <!-- FAQ Item 1 -->
            <div class="bg-white rounded-lg border border-gray-200 hover:border-principal transition-all">
              <button
                @click="activeFaq = activeFaq === 1 ? null : 1"
                class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors"
              >
                <span class="font-bold text-gray-900 text-left">Comment ouvrir une boutique sur notre application ?</span>
                <i :class="['bi', activeFaq === 1 ? 'bi-chevron-up' : 'bi-chevron-down', 'text-principal']"></i>
              </button>
              <div v-if="activeFaq === 1" class="px-6 pb-4 border-t border-gray-200">
                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                  <li>Inscrivez-vous ou connectez-vous à votre compte.</li>
                  <li>Accédez à la section "Publier" dans votre menu.</li>
                  <li>Remplissez les informations de votre bien immobilier.</li>
                  <li>Ajoutez vos photos (jusqu'à 15 pour Starter).</li>
                  <li>Publiez et commencez à recevoir des demandes!</li>
                </ol>
              </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="bg-white rounded-lg border border-gray-200 hover:border-principal transition-all">
              <button
                @click="activeFaq = activeFaq === 2 ? null : 2"
                class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors"
              >
                <span class="font-bold text-gray-900 text-left">Comment booster un article ?</span>
                <i :class="['bi', activeFaq === 2 ? 'bi-chevron-up' : 'bi-chevron-down', 'text-principal']"></i>
              </button>
              <div v-if="activeFaq === 2" class="px-6 pb-4 border-t border-gray-200">
                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                  <li>Accédez à votre tableau de bord.</li>
                  <li>Sélectionnez l'annonce à booster.</li>
                  <li>Cliquez sur "Booster" et choisissez la durée.</li>
                  <li>Confirmez et effectuez le paiement.</li>
                  <li>Votre annonce sera mise en avant immédiatement!</li>
                </ol>
              </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="bg-white rounded-lg border border-gray-200 hover:border-principal transition-all">
              <button
                @click="activeFaq = activeFaq === 3 ? null : 3"
                class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors"
              >
                <span class="font-bold text-gray-900 text-left">Puis-je changer de plan à tout moment ?</span>
                <i :class="['bi', activeFaq === 3 ? 'bi-chevron-up' : 'bi-chevron-down', 'text-principal']"></i>
              </button>
              <div v-if="activeFaq === 3" class="px-6 pb-4 border-t border-gray-200">
                <p class="text-gray-700">Oui! Vous pouvez upgrader ou downgrader votre plan à tout moment. Les changements prendront effet immédiatement et nous ajusterons votre facturation de manière proportionnelle.</p>
              </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="bg-white rounded-lg border border-gray-200 hover:border-principal transition-all">
              <button
                @click="activeFaq = activeFaq === 4 ? null : 4"
                class="w-full px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors"
              >
                <span class="font-bold text-gray-900 text-left">Quels sont les délais de paiement ?</span>
                <i :class="['bi', activeFaq === 4 ? 'bi-chevron-up' : 'bi-chevron-down', 'text-principal']"></i>
              </button>
              <div v-if="activeFaq === 4" class="px-6 pb-4 border-t border-gray-200">
                <p class="text-gray-700">Les forfaits Professional et Premium sont facturés mensuellement. Vous pouvez annuler à tout moment et aucun frais supplémentaire ne vous sera facturé.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-principal to-secondaire rounded-2xl p-12 text-white text-center">
          <h2 class="text-3xl font-bold mb-4">Prêt à commencer ?</h2>
          <p class="text-lg mb-8 text-white/90">
            Rejoignez des milliers de vendeurs satisfaits sur NoflayHub
          </p>
          <Link
            href="/publication/immobilier/"
            class="inline-block px-10 py-4 bg-white text-principal font-bold rounded-lg hover:shadow-xl transition-all transform hover:scale-105"
          >
            Publier votre première annonce 🚀
          </Link>
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

/* Table styling */
table {
  width: 100%;
}

thead tr {
  background-color: #f9fafb;
}
</style>
