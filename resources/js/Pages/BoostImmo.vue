<script setup>
import { router, useForm } from "@inertiajs/vue3"
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
    boost: props.maison.boost,
    duration: props.maison.duration,

})
function submit(id) {
    router.put('/immobilierBoost/' + id, form)
}

const props = defineProps({
    maison: Object,
    nameSeler: Object,
})


</script>

<template>
    <app-layout>
        <template header>
            <h2 class="font-semibold text-xl text-gray-800 posting-tight text-center">
                Publication
            </h2>
        </template>

        <div class="w-11/12 my-7 m-auto rounded-2xl  lg:w-2/5 border-2 shadow-lg border-slate-400">
            <!-- a develoopper -->
        </div>

        <div class="p-6">
            <div class="w-full p-3 m-auto rounded-2xl border-2 shadow-lg border-slate-200  lg:w-2/5 ">
                <h2 class="my-5 text-center bg-principal text-white rounded-full py-3">Ecrivez votre annonce
                    immobilliere </h2>

                <form @submit.prevent="submit(maison.id)">
                    <!-- NOM -->

                    <!-- REGION -->
                    <div class="mb-4">
                        <select
                            class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none focus:border-gray-500 focus:ring-gray-500"
                            name="boost" id="boost" v-model="form.boost" required>
                            <option value=1>Booster l article</option>
                            <option value=0>ne pas bosster</option>
                        </select>

                        <select name="duration" id="duration" required v-model="form.duration" class="w-full bg-white border-none p-4 rounded-[20px] mt-4 shadow-[0_10px_10px_-5px_#101634] border-2 border-transparent placeholder-gray-500 focus:outline-none
         focus:border-white focus:ring focus:ring-white focus:ring-opacity-50
        ">
                            <option value="120">2 heures</option>
                            <option value="2880">48 heures</option>
                            <option value="4320">72 heures</option>
                            <option value="10080">1 semaine</option>
                        </select>
                    </div>



                    <button type="submit" class="bg-principal text-white px-5 py-1 rounded-2xl">save</button>

                </form>
            </div>
        </div>
        <!-- VERGER -->


    </app-layout>

</template>


<style>
.images {
    display: grid;
    grid-template-columns: 32% 32% 32%;
    grid-gap: 3%;
}
</style>


<script>
export default {
    data() {
        return {
            images: [
                { id: 1, src: "image1.jpg", alt: "Image 1", titre: "Villa" },
                { id: 2, src: "image2.jpg", alt: "Image 2", titre: "Appartement" },
                { id: 3, src: "image3.jpg", alt: "Image 3", titre: "Immeuble" },
                { id: 4, src: "image4.jpg", alt: "Image 4", titre: "Chambre" },
                { id: 5, src: "image5.jpg", alt: "Image 5", titre: "Ferme" },
                { id: 6, src: "image5.jpg", alt: "Image 5", titre: "Verger" }

            ],
            selectedImage: null
        }
    }
}
</script>
