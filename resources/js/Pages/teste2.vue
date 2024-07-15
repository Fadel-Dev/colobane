<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3';

const props = defineProps({

    voitures: Object,

});


// const form = useForm({
//     status: props.voitures.status,
//     date_fin_booster: props.voitures.date_fin_booster,
//     duration: props.voitures.duration,
// });

// function submit(id) {
//     router.put('/rvVoiture/update/'+id, form);
// }
</script>

<template>
    <!-- duration: props.voitures.duration, -->

    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 posting-tight text-center">
                Publication
            </h2>
        </template>

        <div class="w-11/12 my-7 m-auto rounded-2xl lg:w-2/5 border-2 shadow-lg border-slate-400">
            <!-- Content to develop further -->
        </div>

         <div v-for="voit in voitures.data" :key="voit.id">
                    <span class="my-5 text-center bg-principal text-white rounded-full py-3">xxxxxxxxxxxxx{{ voit.affaire }}</span>


                </div>
    </app-layout>
</template>


