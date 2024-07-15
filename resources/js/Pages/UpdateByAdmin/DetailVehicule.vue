<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    usere: Object,
    nomPatient: Object,
    mailPatient: Object,
    phonePatient: Object,
    voitures: Object,
    immobiliers: Object,
});

const form = useForm({
    status: props.immobiliers.status,
    date_fin_booster: props.immobiliers.date_fin_booster,
    duration: props.immobiliers.duration,
});

function submit(id) {
    router.put('/rvVoiture/update/'+id, form);
}
</script>

<template>
    <!-- duration: props.immobiliers.duration, -->

    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 posting-tight text-center">
                Publication
            </h2>
        </template>

        <div class="w-11/12 my-7 m-auto rounded-2xl lg:w-2/5 border-2 shadow-lg border-slate-400">
            <!-- Content to develop further -->
        </div>

        <div class="p-6">
            <div class="w-full p-3 m-auto rounded-2xl border-2 shadow-lg border-slate-200 lg:w-2/5">
                <h2 class="my-5 text-center bg-principal text-white rounded-full py-3">Ecrivez votre annonce immobilière</h2>
                <div v-for="imm in immobiliers" :key="imm.id">
                    <h1>{{ imm.nom }}</h1>

                <form @submit.prevent="submit(imm.id)">
                    <!-- STATUS -->
                    <div class="mb-4">
                        <select
                            class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50"
                            id="status"
                            name="status"
                            v-model="form.status"
                            required
                        >
                            <option value="accepter">Accepter</option>
                            <option value="attente">En attente</option>
                        </select>
                    </div>

                    <!-- BOOSTED AT -->
                    <div class="mb-4">
                        <select
                            class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50"
                            id="duration"
                            placeholder="Saisir l'heure hh:mm"
                            name="duration"
                            v-model="form.duration"
                            required
                        >
                        <option value="1440">1 jour - 1440 minutes</option>
  <option value="2880">2 jours - 2880 minutes</option>
  <option value="4320">3 jours - 4320 minutes</option>
  <option value="5760">4 jours - 5760 minutes</option>
  <option value="7200">5 jours - 7200 minutes</option>
  <option value="8640">6 jours - 8640 minutes</option>
  <option value="10080">7 jours - 10080 minutes</option>

                        </select>
                    </div>

                    <!-- DATE FIN BOOSTER -->
                    <div class="mb-4">
                        <input
                            class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50"
                            id="date_fin_booster"
                            type="date"
                            name="date_fin_booster"
                            v-model="form.date_fin_booster"
                            placeholder="Saisir une date xx/yy/zzzz"
                            required
                        >
                    </div>

                    <button type="submit" class="bg-principal text-white px-5 py-1 rounded-2xl">Enregistrer</button>
                </form>


                </div>
            </div>
        </div>
    </app-layout>
</template>


