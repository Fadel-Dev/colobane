<script setup>
import { router, useForm } from "@inertiajs/vue3"
import { ref, computed } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import BoostPricingPlans from '@/Components/BoostPricingPlans.vue'

const props = defineProps({
    maison: Object,
    nameSeler: Object,
})

const selectedPlan = ref(null)
const isSubmitting = ref(false)
const showPlans = ref(true)

const form = useForm({
    boost: props.maison.boost || 1,
    duration: props.maison.duration || 2880,
    plan: null,
})

const planDurations = {
    'mini': 120,
    'standard': 2880,
    'premium': 4320,
    'platinum': 10080,
}

const planPrices = {
    'mini': 500,
    'standard': 2000,
    'premium': 2500,
    'platinum': 4000,
}

const planLabels = {
    'mini': '2 Heures',
    'standard': '48 Heures',
    'premium': '72 Heures',
    'platinum': '1 Semaine',
}

const selectedPlanInfo = computed(() => {
    if (!selectedPlan.value) return null
    return {
        label: planLabels[selectedPlan.value],
        price: planPrices[selectedPlan.value],
        duration: planDurations[selectedPlan.value],
    }
})

const selectPlan = (planKey) => {
    selectedPlan.value = planKey
    form.duration = planDurations[planKey]
    form.plan = planKey
}

function submit(id) {
    if (!selectedPlan.value) {
        alert('⚠️ Veuillez sélectionner un plan de boost!')
        return
    }
    
    isSubmitting.value = true
    router.put('/immobilierBoost/' + id, form, {
        onSuccess: () => {
            isSubmitting.value = false
            alert('✅ Boost activé avec succès!')
        },
        onError: () => {
            isSubmitting.value = false
            alert('❌ Erreur lors de l\'activation du boost')
        }
    })
}


</script>

<template>
    <app-layout>
        <div class="min-h-screen bg-gradient-to-br from-slate-950 via-purple-950 to-slate-950">
            <!-- Header premium -->
            <div class="bg-gradient-to-r from-purple-900 to-pink-900 py-12 px-4 border-b-4 border-yellow-400/50">
                <div class="max-w-6xl mx-auto">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-5xl">🚀</span>
                        <div>
                            <h1 class="text-4xl font-black text-white mb-2">
                                BOOSTER VOTRE ANNONCE
                            </h1>
                            <p class="text-yellow-300 font-bold">
                                Augmentez votre visibilité jusqu'à +300% et recevez plus de contacts!
                            </p>
                        </div>
                    </div>

                    <!-- Info annonce -->
                    <div class="bg-white/10 backdrop-blur rounded-xl p-4 border border-white/20">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-yellow-300 text-sm font-bold">📦 ANNONCE</p>
                                <p class="text-white font-bold text-lg">{{ maison.nom }}</p>
                            </div>
                            <div>
                                <p class="text-yellow-300 text-sm font-bold">📍 TYPE</p>
                                <p class="text-white font-bold text-lg">{{ maison.type }}</p>
                            </div>
                            <div>
                                <p class="text-yellow-300 text-sm font-bold">💰 PRIX</p>
                                <p class="text-white font-bold text-lg">{{ maison.prix.toLocaleString() }} FCFA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="max-w-7xl mx-auto px-4 py-12">
                <!-- Grille principale -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Colonne gauche: Plans de boost -->
                    <div class="lg:col-span-2">
                        <h2 class="text-3xl font-black mb-8">
                            <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-pink-500">
                                CHOISISSEZ VOTRE PLAN
                            </span>
                        </h2>

                        <!-- Grille de plans (réduite) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                            <!-- Plan Mini -->
                            <div
                                @click="selectPlan('mini')"
                                class="group cursor-pointer relative"
                                :class="selectedPlan === 'mini' ? 'lg:scale-105' : ''"
                            >
                                <div
                                    class="absolute inset-0 rounded-2xl blur-2xl transition-all duration-300"
                                    :class="selectedPlan === 'mini'
                                        ? 'bg-gradient-to-r from-purple-500 to-pink-500 opacity-75'
                                        : 'bg-gradient-to-r from-purple-500 to-pink-500 opacity-30 group-hover:opacity-50'
                                    "
                                />
                                <div
                                    class="relative bg-slate-800/80 rounded-2xl overflow-hidden border-2 transition-all duration-300 p-6 group-hover:scale-105"
                                    :class="selectedPlan === 'mini'
                                        ? 'border-yellow-400 shadow-2xl shadow-yellow-500/50 ring-2 ring-yellow-400'
                                        : 'border-purple-500/30 group-hover:border-pink-500/50'
                                    "
                                >
                                    <div class="text-center">
                                        <p class="text-4xl mb-2">⚡</p>
                                        <p class="text-purple-300 text-xs font-bold mb-1">🥉 BRONZE</p>
                                        <h3 class="text-xl font-black text-white mb-2">2 Heures</h3>
                                        <p class="text-3xl font-black bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 to-pink-500 mb-3">500F</p>
                                        <button
                                            type="button"
                                            class="w-full py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-lg hover:shadow-lg transition-all"
                                            :class="selectedPlan === 'mini' ? 'ring-2 ring-yellow-400' : ''"
                                        >
                                            {{ selectedPlan === 'mini' ? '✅ SÉLECTIONNÉ' : 'CHOISIR' }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Plan Standard -->
                            <div
                                @click="selectPlan('standard')"
                                class="group cursor-pointer relative"
                                :class="selectedPlan === 'standard' ? 'lg:scale-105' : ''"
                            >
                                <div
                                    class="absolute inset-0 rounded-2xl blur-2xl transition-all duration-300"
                                    :class="selectedPlan === 'standard'
                                        ? 'bg-gradient-to-r from-yellow-500 to-pink-500 opacity-75'
                                        : 'bg-gradient-to-r from-purple-500 to-pink-500 opacity-30 group-hover:opacity-50'
                                    "
                                />
                                <div
                                    class="relative bg-slate-800/80 rounded-2xl overflow-hidden border-2 transition-all duration-300 p-6 group-hover:scale-105"
                                    :class="selectedPlan === 'standard'
                                        ? 'border-yellow-400 shadow-2xl shadow-yellow-500/50 ring-2 ring-yellow-400'
                                        : 'border-purple-500/30 group-hover:border-pink-500/50'
                                    "
                                >
                                    <div class="text-center">
                                        <p class="text-4xl mb-2">🔥</p>
                                        <p class="text-purple-300 text-xs font-bold mb-1">🥈 ARGENT</p>
                                        <h3 class="text-xl font-black text-white mb-2">48 Heures</h3>
                                        <p class="text-3xl font-black bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 to-pink-500 mb-3">2 000F</p>
                                        <button
                                            type="button"
                                            class="w-full py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-lg hover:shadow-lg transition-all"
                                            :class="selectedPlan === 'standard' ? 'ring-2 ring-yellow-400' : ''"
                                        >
                                            {{ selectedPlan === 'standard' ? '✅ SÉLECTIONNÉ' : 'CHOISIR' }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Plan Premium -->
                            <div
                                @click="selectPlan('premium')"
                                class="group cursor-pointer relative"
                                :class="selectedPlan === 'premium' ? 'lg:scale-105' : ''"
                            >
                                <div
                                    class="absolute inset-0 rounded-2xl blur-2xl transition-all duration-300"
                                    :class="selectedPlan === 'premium'
                                        ? 'bg-gradient-to-r from-yellow-500 to-pink-500 opacity-75'
                                        : 'bg-gradient-to-r from-purple-500 to-pink-500 opacity-30 group-hover:opacity-50'
                                    "
                                />
                                <div
                                    class="relative bg-slate-800/80 rounded-2xl overflow-hidden border-2 transition-all duration-300 p-6 group-hover:scale-105"
                                    :class="selectedPlan === 'premium'
                                        ? 'border-yellow-400 shadow-2xl shadow-yellow-500/50 ring-2 ring-yellow-400'
                                        : 'border-purple-500/30 group-hover:border-pink-500/50'
                                    "
                                >
                                    <div class="text-center">
                                        <p class="text-4xl mb-2">💎</p>
                                        <p class="text-purple-300 text-xs font-bold mb-1">🥇 OR</p>
                                        <h3 class="text-xl font-black text-white mb-2">72 Heures</h3>
                                        <p class="text-3xl font-black bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 to-pink-500 mb-3">2 500F</p>
                                        <button
                                            type="button"
                                            class="w-full py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-lg hover:shadow-lg transition-all"
                                            :class="selectedPlan === 'premium' ? 'ring-2 ring-yellow-400' : ''"
                                        >
                                            {{ selectedPlan === 'premium' ? '✅ SÉLECTIONNÉ' : 'CHOISIR' }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Plan Platinum -->
                            <div
                                @click="selectPlan('platinum')"
                                class="group cursor-pointer relative lg:scale-110 lg:z-20"
                            >
                                <div
                                    class="absolute inset-0 rounded-2xl blur-2xl transition-all duration-300"
                                    :class="selectedPlan === 'platinum'
                                        ? 'bg-gradient-to-r from-yellow-500 to-pink-500 opacity-75'
                                        : 'bg-gradient-to-r from-yellow-500 to-pink-500 opacity-60'
                                    "
                                />
                                <div
                                    class="relative bg-slate-800/80 rounded-2xl overflow-hidden border-2 transition-all duration-300 p-6 group-hover:scale-105 h-full flex flex-col"
                                    :class="selectedPlan === 'platinum'
                                        ? 'border-yellow-400 shadow-2xl shadow-yellow-500/50 ring-2 ring-yellow-400'
                                        : 'border-yellow-400 shadow-2xl shadow-yellow-500/50'
                                    "
                                >
                                    <div class="absolute top-3 right-3 animate-bounce text-3xl">⭐</div>
                                    <div class="text-center">
                                        <p class="text-4xl mb-2">👑</p>
                                        <p class="text-yellow-300 text-xs font-bold mb-1">👑 PLATINE</p>
                                        <h3 class="text-xl font-black text-white mb-2">1 Semaine</h3>
                                        <p class="text-3xl font-black bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 to-pink-500 mb-3">4 000F</p>
                                        <div class="mb-4 px-3 py-2 bg-green-500/20 border border-green-500/50 rounded-lg">
                                            <p class="text-green-300 font-bold text-xs">⭐ MEILLEURE OFFRE</p>
                                        </div>
                                        <button
                                            type="button"
                                            class="w-full py-3 bg-gradient-to-r from-yellow-400 to-pink-500 text-slate-900 font-black rounded-lg hover:shadow-lg hover:shadow-yellow-500/50 transition-all"
                                            :class="selectedPlan === 'platinum' ? 'ring-2 ring-yellow-400 shadow-2xl' : ''"
                                        >
                                            {{ selectedPlan === 'platinum' ? '✅ SÉLECTIONNÉ' : '🚀 CHOISIR' }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Colonne droite: Résumé et confirmation -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-24">
                            <!-- Résumé du boost -->
                            <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border-2 border-purple-500/50 p-8">
                                <h3 class="text-2xl font-black text-white mb-6 flex items-center gap-2">
                                    <span class="text-2xl">📋</span> RÉSUMÉ
                                </h3>

                                <!-- Annonce -->
                                <div class="mb-6 pb-6 border-b border-purple-500/30">
                                    <p class="text-purple-300 text-sm font-bold mb-2">ANNONCE</p>
                                    <p class="text-white font-bold">{{ maison.nom }}</p>
                                    <p class="text-purple-400 text-sm">{{ maison.type }}</p>
                                </div>

                                <!-- Plan sélectionné -->
                                <div class="mb-6 pb-6 border-b border-purple-500/30">
                                    <p class="text-purple-300 text-sm font-bold mb-2">PLAN SÉLECTIONNÉ</p>
                                    <div v-if="selectedPlanInfo" class="space-y-2">
                                        <p class="text-white font-black text-lg">{{ selectedPlanInfo.label }}</p>
                                        <p class="text-green-400 font-bold text-2xl">{{ selectedPlanInfo.price }} FCFA</p>
                                        <div class="flex items-center gap-2 text-sm text-purple-300">
                                            <span>⏱️</span>
                                            <span>{{ selectedPlanInfo.duration / 60 }} minutes de boost</span>
                                        </div>
                                    </div>
                                    <div v-else class="text-purple-400 italic">
                                        Sélectionnez un plan...
                                    </div>
                                </div>

                                <!-- Garanties -->
                                <div class="mb-6 space-y-2">
                                    <div class="flex items-center gap-2 text-sm text-green-400">
                                        <span>✅</span>
                                        <span>Activation immédiate</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-green-400">
                                        <span>✅</span>
                                        <span>+300% de visibilité</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-green-400">
                                        <span>✅</span>
                                        <span>Sans engagement</span>
                                    </div>
                                </div>

                                <!-- Bouton final -->
                                <form @submit.prevent="submit(maison.id)" class="space-y-3">
                                    <button
                                        type="submit"
                                        :disabled="!selectedPlan || isSubmitting"
                                        class="w-full py-4 font-black text-lg rounded-xl transition-all duration-300"
                                        :class="selectedPlan && !isSubmitting
                                            ? 'bg-gradient-to-r from-yellow-400 to-pink-500 text-slate-900 hover:shadow-2xl hover:shadow-yellow-500/50'
                                            : 'bg-gray-600 text-gray-400 cursor-not-allowed'
                                        "
                                    >
                                        {{ isSubmitting ? '⏳ Activation en cours...' : '🚀 ACTIVER LE BOOST' }}
                                    </button>
                                    <p class="text-center text-xs text-purple-300">
                                        En cliquant sur "Activer", vous acceptez nos conditions d'utilisation
                                    </p>
                                </form>

                                <!-- Besoin d'aide -->
                                <div class="mt-8 pt-6 border-t border-purple-500/30">
                                    <p class="text-purple-300 font-bold text-sm mb-3">❓ BESOIN D'AIDE?</p>
                                    <div class="space-y-2 text-xs text-purple-400">
                                        <p>📞 Support 24/7 disponible</p>
                                        <p>💬 Chat en direct</p>
                                        <p>📧 Email: support@noflayhub.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section FAQ bonus -->
                <div class="mt-16 bg-slate-800/50 rounded-2xl border border-purple-500/30 p-8">
                    <h3 class="text-2xl font-black text-white mb-8 flex items-center gap-2">
                        <span>❓</span>
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-pink-500">
                            QUESTIONS FRÉQUENTES
                        </span>
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <p class="font-bold text-white mb-2">🕐 Quand débute le boost?</p>
                            <p class="text-purple-300 text-sm">Immédiatement après votre paiement. Votre annonce remonte en haut des résultats en quelques minutes!</p>
                        </div>
                        <div>
                            <p class="font-bold text-white mb-2">📊 Quel impact?</p>
                            <p class="text-purple-300 text-sm">En moyenne +300% de clics, +250% de contacts. Les résultats varient selon l'offre et la région.</p>
                        </div>
                        <div>
                            <p class="font-bold text-white mb-2">💰 Peut-on annuler?</p>
                            <p class="text-purple-300 text-sm">Oui! Vous pouvez arrêter le boost à tout moment depuis votre tableau de bord.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>


<style scoped>
/* Animations supplémentaires */
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-5px);
    }
}

button:disabled {
    cursor: not-allowed;
}
</style>
