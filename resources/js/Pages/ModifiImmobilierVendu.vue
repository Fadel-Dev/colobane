<script setup>
import { router, useForm } from "@inertiajs/vue3"
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    maison: Object,
    nameSeler: Object,
})

const form = useForm({
    vendu: props.maison.vendu,
})

function submit(id) {
    router.put('/immobilierVendu/' + id, form)
}
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                Publication
            </h2>
        </template>

        <div class="w-11/12 my-7 m-auto rounded-2xl lg:w-2/5 border-2 shadow-lg border-slate-400">
            <!-- a developer -->
        </div>

        <div class="p-6">
            <div class="w-full p-3 m-auto rounded-2xl border-2 shadow-lg border-slate-200 lg:w-2/5">
                <h2 class="my-5 text-center bg-principal text-white rounded-full py-3">
                    Statut de votre annonce immobilière
                </h2>

                <form @submit.prevent="submit(maison.id)">
                    <div class="mb-6">
                        <label for="vendu" class="block text-sm font-medium text-gray-700 mb-2">L'article est-il vendu ?</label>
                        <select 
                            class="w-full border border-gray-300 rounded-full text-gray-600 h-12 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none focus:border-gray-500 focus:ring-gray-500 transition-all"
                            name="vendu" 
                            id="vendu" 
                            v-model="form.vendu" 
                            required
                        >
                            <option :value="1">Oui, déjà vendu</option>
                            <option :value="0">Non, pas encore</option>
                        </select>
                    </div>

                    <div class="flex justify-center mt-8">
                        <button 
                            type="submit" 
                            class="bg-principal hover:bg-principal/90 text-white px-10 py-3 rounded-full font-bold shadow-lg hover:shadow-xl transition-all transform hover:scale-105"
                            :disabled="form.processing"
                        >
                            {{ form.processing ? 'Enregistrement...' : 'Enregistrer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.images {
    display: grid;
    grid-template-columns: 32% 32% 32%;
    grid-gap: 3%;
}
</style>
