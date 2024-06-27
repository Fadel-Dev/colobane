<script setup>
import { router, useForm } from "@inertiajs/vue3"
import AppLayout from '@/Layouts/AppLayout.vue';

  const form = useForm({
            nom:  props.car.nom,
            description: props.car.description,
            prix:  props.car.prix,
            // type: car.type,
})
function submit(id) {
  router.put('/vehicule/'+id, form)}

const props=defineProps({
    car:Object,
    nameSeler:Object,
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

 <div class="p-6" >
  <div  class="w-full p-3 m-auto rounded-2xl border-2 shadow-lg border-slate-200  lg:w-2/5 ">
  <h2 class="my-5 text-center bg-principal text-white rounded-full py-3">Ecrivez votre annonce immobilliere </h2>

      <form @submit.prevent="submit(car.id)" >
<!-- NOM -->

      <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2"
          for="nom">
              Titre
          </label>
          <input class="shadow appearance-none focus:border-gray-500 focus:ring-gray-500 border rounded w-full py-2 px-3 text-gray-700 posting-tight focus:outline-none focus:shadow-outline"
             id="nom"
             name="nom"
             type="text"
             placeholder="Entrez le titre de votre annonce "
             v-model="form.nom"
             required>
             <!-- <h1>{{ car.type }}</h1> -->

      </div>


<!-- PRIX -->
           <div class="mb-4" >
          <label class="block text-gray-700 font-bold mb-2" for="price">
              Prix
          </label>
          <input class="shadow appearance-none focus:border-gray-500 focus:ring-gray-500 border rounded w-full py-2 px-3 text-gray-700 posting-tight focus:outline-none focus:shadow-outline"
             id="prix"
             type="text"
             placeholder="Entrez le prix"
             name="prix"
             v-model="form.prix"
             required>
      </div>
<!-- DESCRIPTION -->
      <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="description">
              Description
          </label>
          <textarea class="shadow appearance-none focus:border-gray-500 focus:ring-gray-500 border rounded w-full py-2 px-3 text-gray-700 posting-tight focus:outline-none focus:shadow-outline"
             id="description" rows="5"
             name="description"
             v-model="form.description"
             placeholder="Entrez la description"
             required></textarea>
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
    display:grid;
    grid-template-columns: 32% 32% 32%;
    grid-gap:3% ;
  }
</style>


<script>
export default {
  data() {
    return {
      images: [
        { id: 1, src: "image1.jpg", alt: "Image 1" ,titre:"Villa" },
        { id: 2, src: "image2.jpg", alt: "Image 2" ,titre:"Appartement" },
        { id: 3, src: "image3.jpg", alt: "Image 3" ,titre:"Immeuble" },
        { id: 4, src: "image4.jpg", alt: "Image 4" ,titre:"Chambre" },
        { id: 5, src: "image5.jpg", alt: "Image 5" ,titre:"Ferme" },
        { id: 6, src: "image5.jpg", alt: "Image 5" ,titre:"Verger" }

      ],
      selectedImage: null
    }
  }}
</script>

