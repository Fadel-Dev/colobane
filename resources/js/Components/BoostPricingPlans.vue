<template>
  <div class="w-full min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 py-12">
    <!-- Particules animées de fond -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
      <div
        v-for="i in 20"
        :key="i"
        class="absolute w-1 h-1 bg-purple-400 rounded-full opacity-50 animate-pulse"
        :style="{
          left: Math.random() * 100 + '%',
          top: Math.random() * 100 + '%',
          animationDelay: Math.random() * 2 + 's'
        }"
      />
    </div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
      <!-- Titre avec effets -->
      <div class="text-center mb-4">
        <div class="inline-block mb-4">
          <span class="text-6xl animate-bounce">🚀</span>
        </div>
      </div>
      <div class="text-center mb-16">
        <h1 class="text-5xl sm:text-6xl font-black bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 via-pink-500 to-purple-600 mb-4 animate-pulse">
          BOOSTERS PUISSANTS
        </h1>
        <p class="text-xl text-purple-200 max-w-2xl mx-auto leading-relaxed">
          Dominez les résultats de recherche et maximisez vos contacts avec nos plans de boost ultra-performants!
        </p>
        <div class="mt-4 flex justify-center gap-2 text-sm text-yellow-300">
          <span>⭐ Recommandé par 500+ utilisateurs</span>
          <span>•</span>
          <span>📈 +300% de visibilité garantie</span>
        </div>
      </div>

      <!-- Spinner de chargement -->
      <div v-if="loading" class="text-center py-20">
        <div class="inline-flex items-center justify-center">
          <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-yellow-400"></div>
        </div>
        <p class="text-purple-300 mt-4 text-lg">Chargement des plans d'élite...</p>
      </div>

      <!-- Grille de plans (gamifiée) -->
      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
        <!-- Plan Mini -->
        <div
          v-for="plan in plans"
          :key="plan.key"
          class="group relative"
          :class="plan.isBestValue ? 'lg:scale-110 lg:z-20' : ''"
        >
          <!-- Glow effect -->
          <div
            class="absolute inset-0 rounded-2xl blur-2xl transition-all duration-300 group-hover:blur-3xl"
            :class="plan.isBestValue
              ? 'bg-gradient-to-r from-yellow-500 to-pink-500 opacity-75'
              : 'bg-gradient-to-r from-purple-500 to-pink-500 opacity-50 group-hover:opacity-75'
            "
          />

          <!-- Carte principale -->
          <div
            class="relative bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl overflow-hidden border-2 transition-all duration-300 transform group-hover:scale-105"
            :class="plan.isBestValue
              ? 'border-yellow-400 shadow-2xl shadow-yellow-500/50'
              : 'border-purple-500/30 group-hover:border-pink-500/50'
            "
          >
            <!-- Badge level/rang -->
            <div class="absolute top-0 left-0 right-0 flex justify-between items-start p-4">
              <div
                class="px-4 py-2 rounded-br-xl font-black text-sm"
                :class="plan.isBestValue
                  ? 'bg-gradient-to-r from-yellow-400 to-pink-500 text-slate-900'
                  : 'bg-gradient-to-r from-purple-600 to-pink-600 text-white'
                "
              >
                {{ getLevelName(plan.key) }}
              </div>
              <div v-if="plan.isBestValue" class="animate-bounce text-3xl">
                ⭐
              </div>
            </div>

            <!-- Barre de progression (meilleure offre) -->
            <div v-if="plan.isBestValue" class="h-1 bg-gradient-to-r from-yellow-400 to-pink-500" />

            <!-- Contenu -->
            <div class="p-8 pt-16">
              <!-- Icône XXL -->
              <div class="text-center mb-6">
                <div class="text-7xl mb-4 animate-bounce" :style="{ animationDelay: `${plans.indexOf(plan) * 0.1}s` }">
                  {{ plan.icon }}
                </div>
              </div>

              <!-- Titre et description -->
              <div class="text-center mb-8">
                <h3 class="text-2xl font-black text-white mb-2">{{ plan.label }}</h3>
                <p class="text-purple-300 text-sm font-semibold">{{ plan.description }}</p>
              </div>

              <!-- Prix avec animation -->
              <div class="text-center mb-8">
                <div class="relative mb-2">
                  <p class="text-5xl font-black bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 to-pink-500">
                    {{ plan.price }}
                  </p>
                  <p class="text-xl text-yellow-400 font-bold">FCFA</p>
                </div>
                <p class="text-purple-300 text-sm">
                  <span class="font-bold text-green-400">{{ (plan.pricePerHour).toFixed(2) }}</span> F/heure
                </p>
              </div>

              <!-- Économies -->
              <div v-if="plan.savings > 0" class="mb-6 px-4 py-3 bg-gradient-to-r from-green-500/20 to-emerald-500/20 border border-green-500/50 rounded-lg text-center">
                <p class="text-green-300 font-bold text-sm">
                  💰 Économisez {{ plan.savings.toFixed(1) }}%
                </p>
              </div>

              <!-- Stats du plan -->
              <div class="space-y-3 mb-8 bg-slate-700/50 rounded-xl p-4">
                <div class="flex items-center justify-between">
                  <span class="text-purple-300 text-sm">⏱️ Durée totale</span>
                  <span class="font-bold text-white">{{ plan.durationHours }}h</span>
                </div>
                <div class="w-full bg-slate-600 rounded-full h-1.5">
                  <div
                    class="h-1.5 rounded-full bg-gradient-to-r from-yellow-400 to-pink-500"
                    :style="{ width: (plan.durationHours / 168 * 100) + '%' }"
                  />
                </div>
                <div class="flex items-center justify-between pt-2">
                  <span class="text-purple-300 text-sm">📅 Jours</span>
                  <span class="font-bold text-white">{{ plan.durationDays }} j</span>
                </div>
              </div>

              <!-- Bouton d'action -->
              <button
                @click="selectPlan(plan)"
                class="w-full py-4 px-6 font-black text-lg rounded-xl transition-all duration-300 overflow-hidden group/btn relative"
                :class="plan.isBestValue
                  ? 'bg-gradient-to-r from-yellow-400 to-pink-500 text-slate-900 hover:shadow-2xl hover:shadow-yellow-500/50 hover:scale-105'
                  : 'bg-gradient-to-r from-purple-600 to-pink-600 text-white hover:shadow-lg hover:shadow-pink-500/50'
                "
              >
                <span class="relative z-10 flex items-center justify-center gap-2">
                  🎯 ACTIVER MAINTENANT
                  <span v-if="plan.isBestValue" class="animate-pulse">⚡</span>
                </span>
              </button>

              <!-- Badges de features -->
              <div class="mt-6 space-y-2">
                <div class="text-xs text-green-400 font-bold">✅ Sans engagement</div>
                <div class="text-xs text-green-400 font-bold">✅ Résultats garantis</div>
                <div class="text-xs text-green-400 font-bold">✅ Support 24/7</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Section des avantages gamifiée -->
      <div class="mb-16">
        <h2 class="text-3xl font-black text-center text-white mb-12">
          <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-pink-500">
            POURQUOI CHOISIR NOS BOOSTS?
          </span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div v-for="(benefit, idx) in benefits" :key="idx" class="group relative">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl blur-xl opacity-40 group-hover:opacity-60 transition-all" />
            <div class="relative bg-slate-800/80 backdrop-blur border border-purple-500/30 rounded-2xl p-8 hover:border-pink-500/50 transition-all">
              <div class="text-5xl mb-4">{{ benefit.icon }}</div>
              <h3 class="font-black text-xl text-white mb-3">{{ benefit.title }}</h3>
              <p class="text-purple-300 text-sm leading-relaxed">{{ benefit.desc }}</p>
              <div class="mt-4 text-xs text-green-400 font-bold">
                ✨ {{ benefit.stat }}
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Tableau de comparaison gamifié -->
      <div class="mb-16">
        <h2 class="text-3xl font-black text-center text-white mb-8">
          <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-pink-500">
            COMPARAISON DÉTAILLÉE
          </span>
        </h2>

        <div class="overflow-x-auto">
          <div class="inline-block min-w-full bg-slate-800/50 backdrop-blur border border-purple-500/30 rounded-2xl overflow-hidden">
            <table class="w-full">
              <thead>
                <tr class="bg-gradient-to-r from-purple-600 to-pink-600">
                  <th class="px-6 py-4 text-left font-black text-white">PLAN</th>
                  <th class="px-6 py-4 text-center font-black text-white">💰 PRIX</th>
                  <th class="px-6 py-4 text-center font-black text-white">⏱️ DURÉE</th>
                  <th class="px-6 py-4 text-center font-black text-white">💹 PRIX/H</th>
                  <th class="px-6 py-4 text-center font-black text-white">🎁 ÉCONOMIES</th>
                  <th class="px-6 py-4 text-center font-black text-white">⭐ SCORE</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-purple-500/20">
                <tr v-for="plan in plans" :key="plan.key" class="hover:bg-purple-500/10 transition-all">
                  <td class="px-6 py-4 font-bold">
                    <span class="text-2xl mr-2">{{ plan.icon }}</span>
                    <span class="text-white">{{ plan.label }}</span>
                  </td>
                  <td class="px-6 py-4 text-center">
                    <span class="font-black text-lg bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-pink-500">
                      {{ plan.formattedPrice }}
                    </span>
                  </td>
                  <td class="px-6 py-4 text-center text-purple-300">
                    <span class="font-bold">{{ plan.durationHours }}h</span>
                  </td>
                  <td class="px-6 py-4 text-center text-green-400 font-bold">
                    {{ (plan.pricePerHour).toFixed(2) }}F
                  </td>
                  <td class="px-6 py-4 text-center">
                    <span v-if="plan.savings > 0" class="font-bold text-green-400">
                      -{{ plan.savings.toFixed(1) }}% 🎁
                    </span>
                    <span v-else class="text-gray-500">-</span>
                  </td>
                  <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center gap-1">
                      <span v-for="i in getScore(plan.key)" :key="i" class="text-yellow-400">⭐</span>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Section CTA finale -->
      <div class="text-center py-12">
        <div class="inline-block">
          <h3 class="text-2xl font-black text-white mb-4">
            ✨ PRÊT À TRANSFORMER VOTRE VISIBILITÉ?
          </h3>
          <p class="text-purple-300 mb-6">
            Rejoignez les 500+ utilisateurs qui ont augmenté leurs contacts de 300%!
          </p>
          <div class="flex justify-center gap-4">
            <button class="px-8 py-3 bg-gradient-to-r from-yellow-400 to-pink-500 text-slate-900 font-black rounded-xl hover:shadow-2xl hover:shadow-yellow-500/50 transition-all">
              VOIR LES TESTIMONIALS 🎬
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const plans = ref([])
const loading = ref(true)
const error = ref(null)

const benefits = [
  {
    icon: '🚀',
    title: 'Plus de Visibilité',
    desc: 'Votre annonce apparaît en première position des résultats de recherche',
    stat: '+300% de clics garantis'
  },
  {
    icon: '⚡',
    title: 'Résultats Ultra-Rapides',
    desc: 'Augmentez vos contacts dès la première heure de votre boost',
    stat: 'Premiers contacts en 30min'
  },
  {
    icon: '💎',
    title: 'Flexibilité Maximale',
    desc: 'Choisissez votre durée et payez une seule fois, c\'est tout!',
    stat: 'Sans engagement ni frais cachés'
  }
]

onMounted(async () => {
  try {
    const response = await fetch('/api/boost-pricing/plans')
    const data = await response.json()
    
    if (data.success) {
      plans.value = data.plans.sort((a, b) => a.price - b.price)
    } else {
      error.value = 'Impossible de charger les plans'
    }
  } catch (err) {
    console.error('Erreur:', err)
    error.value = 'Erreur lors du chargement des plans'
  } finally {
    loading.value = false
  }
})

const selectPlan = (plan) => {
  console.log('Plan sélectionné:', plan)
  // Émettre vers le parent ou rediriger vers paiement
  const event = new CustomEvent('planSelected', { detail: plan })
  window.dispatchEvent(event)
  
  // Optionnel: Animation de feedback
  alert(`🎉 Vous avez sélectionné: ${plan.label}\n💰 Prix: ${plan.formattedPrice}`)
}

const getLevelName = (key) => {
  const levels = {
    'mini': '🥉 BRONZE',
    'standard': '🥈 ARGENT',
    'premium': '🥇 OR',
    'platinum': '👑 PLATINE'
  }
  return levels[key] || 'BASIC'
}

const getScore = (key) => {
  const scores = {
    'mini': 2,
    'standard': 3,
    'premium': 4,
    'platinum': 5
  }
  return scores[key] || 1
}
</script>

<style scoped>
/* Animations personnalisées */
@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
}

@keyframes pulse-glow {
  0%, 100% {
    opacity: 0.5;
  }
  50% {
    opacity: 1;
  }
}

@keyframes shimmer {
  0% {
    background-position: -1000px 0;
  }
  100% {
    background-position: 1000px 0;
  }
}

.animate-float {
  animation: float 3s ease-in-out infinite;
}

.animate-pulse-glow {
  animation: pulse-glow 2s ease-in-out infinite;
}

/* Smooth transitions */
button {
  position: relative;
}

button::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at var(--x, 0) var(--y, 0), rgba(255, 255, 255, 0.3), transparent 80%);
  opacity: 0;
  transition: opacity 0.3s;
}

button:hover::before {
  opacity: 1;
}
</style>

