<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    show: Boolean,
    initialType: String,
    initialRegion: String,
    initialMinPrice: Number,
    initialMaxPrice: Number,
});

const emit = defineEmits(['close', 'success']);

const form = useForm({
    type: props.initialType || '',
    region: props.initialRegion || '',
    min_price: props.initialMinPrice || null,
    max_price: props.initialMaxPrice || null,
});

const submit = () => {
    form.post(route('alertes.store'), {
        onSuccess: () => {
            emit('success', 'Votre alerte a été configurée avec succès !');
            emit('close');
            form.reset();
        },
    });
};
</script>

<template>
    <div v-if="show" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div @click="emit('close')" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-principal/10 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-bell text-principal"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-bold text-secondaire" id="modal-title">
                                Créer une alerte
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 mb-6">
                                    Recevez une notification dès qu'un bien correspondant à vos critères est publié.
                                </p>

                                <form @submit.prevent="submit" class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Type de bien</label>
                                        <select v-model="form.type" class="w-full border-gray-300 rounded-xl focus:ring-principal focus:border-principal shadow-sm">
                                            <option value="">Tous les types</option>
                                            <option value="Villa">Villa</option>
                                            <option value="appartement">Appartement</option>
                                            <option value="Chambre">Chambre</option>
                                            <option value="studio">Studio</option>
                                            <option value="Terrain">Terrain</option>
                                            <option value="Verger">Verger</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Région</label>
                                        <select v-model="form.region" class="w-full border-gray-300 rounded-xl focus:ring-principal focus:border-principal shadow-sm">
                                            <option value="">Toutes les régions</option>
                                            <option value="Dakar">Dakar</option>
                                            <option value="Thiès">Thiès</option>
                                            <option value="Saint-Louis">Saint-Louis</option>
                                            <option value="Ziguinchor">Ziguinchor</option>
                                            <option value="Diourbel">Diourbel</option>
                                            <option value="Tambacounda">Tambacounda</option>
                                            <option value="Kaolack">Kaolack</option>
                                            <option value="Kolda">Kolda</option>
                                            <option value="Matam">Matam</option>
                                            <option value="Kédougou">Kédougou</option>
                                            <option value="Kaffrine">Kaffrine</option>
                                            <option value="Fatick">Fatick</option>
                                            <option value="Sédhiou">Sédhiou</option>
                                        </select>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Prix Min (FCFA)</label>
                                            <input type="number" v-model="form.min_price" class="w-full border-gray-300 rounded-xl focus:ring-principal focus:border-principal shadow-sm" placeholder="Ex: 50000">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700 mb-1">Prix Max (FCFA)</label>
                                            <input type="number" v-model="form.max_price" class="w-full border-gray-300 rounded-xl focus:ring-principal focus:border-principal shadow-sm" placeholder="Ex: 150000">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                    <button @click="submit" :disabled="form.processing" type="button" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-principal text-base font-bold text-white hover:bg-principal/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-principal sm:ml-3 sm:w-auto sm:text-sm">
                        {{ form.processing ? 'Création...' : 'Enregistrer l\'alerte' }}
                    </button>
                    <button @click="emit('close')" type="button" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-bold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-principal sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
