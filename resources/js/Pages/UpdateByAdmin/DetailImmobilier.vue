<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    immobilier: Object,
    nameSeler: String,
    mailSeler: String,
    phoneSeler: String,
    urlActuelle: String,
    currentDateTime: String,
    newDateTime: String,
});

const form = useForm({
    status: props.immobilier.status,
    date_fin_booster: props.immobilier.date_fin_booster,
    // duration: props.immobilier.duration,
});

function submit(id) {
    router.put('/rv/update/' + id, form);
}
</script>

<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                Détails de l'immobilier
            </h2>
        </template>

        <div class="w-11/12 my-7 m-auto rounded-2xl lg:w-2/5 border-2 shadow-lg border-slate-400">
            <div class="p-6">
                <h3 class="text-lg font-bold">{{ immobilier.nom }}</h3>
                <p><strong>Type:</strong> {{ immobilier.type }}</p>
                <p><strong>Prix:</strong> {{ immobilier.prix }}</p>
                <p><strong>Description:</strong> {{ immobilier.description }}</p>
                <p><strong>Nom du vendeur:</strong> {{ nameSeler }}</p>
                <p><strong>Email du vendeur:</strong> {{ mailSeler }}</p>
                <p><strong>Téléphone du vendeur:</strong> {{ phoneSeler }}</p>
                <p>Nouvelle Date et Heure après Durée: {{ newDateTime }}</p>

            </div>
        </div>

        <div class="p-6">
            <div class="w-full p-3 m-auto rounded-2xl border-2 shadow-lg border-slate-200 lg:w-2/5">
                <h2 class="my-5 text-center bg-principal text-white rounded-full py-3">Modifier l'annonce immobilière
                </h2>

                <form @submit.prevent="submit(immobilier.id)">
                    <!-- STATUS -->
                    <div class="mb-4">
                        <select
                            class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50"
                            id="status" name="status" v-model="form.status" required>
                            <option value="accepter">Accepter</option>
                            <option value="attente">En attente</option>
                            <option value="null">Terminer</option>
                        </select>
                    </div>

                    <!-- BOOSTED AT -->
                    <!-- <div class="mb-4">
                        <select
                            class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50"
                            id="duration" placeholder="Saisir l'heure hh:mm" name="duration" v-model="form.duration"
                            required>

                            <option value="720">12h</option>
                            <option value="1440">1 jour </option>
                            <option value="2880">2 jours </option>
                            <option value="4320">3 jours </option>
                            <option value="10080">7 jours</option>
                        </select>
                    </div> -->

                    <!-- DATE FIN BOOSTER -->
                    <div class="mb-4">
                        <input
                            class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none focus:border-white focus:ring focus:ring-white focus:ring-opacity-50"
                            id="date_fin_booster" type="datetime-local" name="date_fin_booster"
                            v-model="form.date_fin_booster" placeholder="Saisir une date xx/yy/zzzz" required>
                    </div>

                    <button type="submit" class="bg-principal text-white px-5 py-1 rounded-2xl">Enregistrer</button>
                </form>
            </div>
        </div>
    </app-layout>
</template>
