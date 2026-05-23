<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    results: Object,
});

const navigateToBoost = (id) => {
    router.visit(`/boost/immo/${id}`);
};

const formatPrice = (price) => {
    if (!price) return '0';
    return parseFloat(price).toLocaleString('fr-FR');
};
</script>

<template>
    <div class="mx-auto bg-gray-200 max-w-2xl px-4 py-16 sm:px-6 sm:py-4 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900"> {{ $page.props.auth.user.name }} Vos Publications </h2>

        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
            <div v-for="result in results" :key="result.id" class="group relative bg-white rounded-xl overflow-hidden shadow-md">
                <div class="min-h-80 aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80 relative">
                    <img :src="'/storage/' + result.image1" :alt="result.nom"
                        class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
                    
                    <!-- Badge Vendu Overly -->
                    <div v-if="result.status === 'Vendu' || result.vendu == 1" class="absolute inset-0 flex items-center justify-center bg-black/40 z-10">
                        <span class="bg-red-600 text-white px-4 py-2 rounded-full font-black uppercase tracking-widest shadow-xl transform rotate-12 border-2 border-white">
                            VENDU
                        </span>
                    </div>
                </div>
                
                <div class="p-4">
                    <div class="flex justify-between items-start mb-4">
                        <h4 class="text-md font-bold text-gray-900 line-clamp-1">
                            {{ result.nom }}
                        </h4>
                        <div class="text-right">
                            <span class="text-lg font-black text-principal block">
                                {{ formatPrice(result.prix) }}
                            </span>
                            <span class="text-[10px] font-bold text-gray-500 uppercase">FCFA</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="text-gray-500 flex flex-col">
                            <span class="text-[10px] font-bold uppercase">Statut</span>
                            <p class="text-xs font-semibold" :class="(result.status === 'Vendu' || result.vendu == 1) ? 'text-red-600' : 'text-green-600'">
                                {{ (result.status === 'Vendu' || result.vendu == 1) ? 'Vendu' : (result.status === 'accepter' ? 'En vente' : 'En attente') }}
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <!-- Case Boosted -->
                            <div v-if="result.booster == 1 && result.status === 'accepter'"
                                class="bg-amber-100 text-amber-700 px-4 py-2 rounded-lg text-xs font-black flex items-center gap-1 border border-amber-200">
                                <i class="fas fa-bolt animate-pulse"></i>
                                Boost Actif
                            </div>
                            <!-- Case Pending Boost -->
                            <div v-else-if="result.booster == 1 && result.status === 'pending'"
                                class="bg-blue-50 text-blue-600 px-4 py-2 rounded-lg text-xs font-black flex items-center gap-1 border border-blue-100">
                                <i class="fas fa-clock"></i>
                                En attente
                            </div>
                            <!-- Case Can Boost -->
                            <button
                                v-else-if="result.vendu != 1 && result.status !== 'Vendu'"
                                @click="navigateToBoost(result.id)"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-xs font-bold transition-all shadow-md active:scale-95 flex items-center gap-1">
                                <i class="bi bi-rocket-takeoff-fill"></i>
                                Booster
                            </button>
                            <!-- Case Sold -->
                            <div
                                v-else
                                class="bg-gray-100 text-gray-500 px-4 py-2 rounded-lg text-xs font-bold flex items-center gap-1 border border-gray-200">
                                <i class="bi bi-check-circle-fill text-red-600"></i>
                                Terminé
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
