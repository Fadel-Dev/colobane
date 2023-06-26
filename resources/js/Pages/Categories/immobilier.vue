<script setup>
import { useForm } from "@inertiajs/vue3"
import AppLayout from '@/Layouts/AppLayout.vue';


  const lead = useForm({
            nom: null,
            description: null,
            prix: null,
            region: null,
            image1: null,
            image2: null,
            image3: null,
            type: null,
            npiece: null,
            affaire: null,
})

function handleSubmit() {
  lead.post('/immobilier/save')
}
// verger
const verger = useForm({
            nom: null,
            description: null,
            prix: null,
            region: null,
            image1: null,
            image2: null,
            image3: null,
            // type: null,
            surface: null,
            affaire: null,
})

function handleSubmit2() {
  verger.post('/immobilier2/save')
}

// verger
const ferme = useForm({
            nom: null,
            description: null,
            prix: null,
            region: null,
            image1: null,
            image2: null,
            image3: null,
            // type: null,
            surface: null,
            affaire: null,
})

function handleSubmit3() {
  ferme.post('/immobilier3/save')
}
   </script>

<template>
  <app-layout>
    <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                Publication
            </h2>
        </template>

    <div class="w-11/12 my-7 m-auto rounded-2xl  lg:w-2/5 border-2 shadow-lg border-slate-400">
    <h2 class="text-2xl font-bold mb-4">Sélectionnez une image</h2>
    <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4">
      <div v-for="image in images" :key="image.id">
        <label>
          <input type="radio" :value="image.titre" v-model="lead.type">
          <h3>{{ image.titre }}</h3>
          <img :src="image.src" :alt="image.alt" class="w-full rounded-lg shadow-lg">
        </label>
      </div>
    </div>
  </div>

 <div v-if="lead.type =='Villa' || lead.type =='Appartement'|| lead.type =='Immeuble'|| lead.type =='chambre' " class="p-6">
  <div class="w-full p-3 m-auto rounded-2xl border-2 shadow-lg border-slate-200  lg:w-2/5 ">
  <h2 class="my-5 text-center bg-amber-300 rounded-full py-3">Ecrivez votre annonce immobilliere </h2>

      <form @submit.prevent="handleSubmit">
<!-- NOM -->

      <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2"
          for="nom">
              Titre
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
             id="nom"
             name="nom"
             type="text"
             placeholder="Entrez le titre de votre annonce "
             v-model="lead.nom"
             required>
      </div>

<!-- PRIX -->
           <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="price">
              Prix
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
             id="prix"
             type="text"
             placeholder="Entrez le prix"
             name="prix"
             v-model="lead.prix"
             required>
      </div>
<!-- DESCRIPTION -->
      <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="description">
              Description
          </label>
          <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
             id="description" rows="5"
             name="description"
             v-model="lead.description"
             placeholder="Entrez la description"
             required></textarea>
      </div>
<!-- <PIECE>-->

  <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2"
          for="npiece">
              nombre de piece
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
             id="npiece"
             name="npiece"
             type="text"
             placeholder="Entrez le nombre de piece"
             v-model="lead.npiece"
             required>
      </div>

<!-- AFFAIRE -->
<label class="block text-gray-700 font-bold mb-2" for="fuel">
         Location ou vente
       </label>
       <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="affaire"
            name="affaire"
            v-model="lead.affaire">
         <option value="vente">vente</option>
         <option value="location">location</option>
       </select>

<!-- IMAGES -->

 <div class="images">
  <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2"
                for="image"
                >
                 Image 1
             </label>
             <input type="file" @input="lead.image1 = $event.target.files[0]" />
             <progress v-if="lead.progress" :value="lead.progress.percentage" max="100">
      {{ lead.progress.percentage }}%
    </progress>
         </div>

          <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2"
                for="image"
                >
                 Image 2
             </label>
             <input type="file" @input="lead.image2 = $event.target.files[0]" />
             <progress v-if="lead.progress" :value="lead.progress.percentage" max="100">
      {{ lead.progress.percentage }}%
    </progress>
         </div>

         <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2"
                for="image"
                >
                 Image 3
             </label>
             <input type="file" @input="lead.image3 = $event.target.files[0]" />
             <progress v-if="lead.progress" :value="lead.progress.percentage" max="100">
      {{ lead.progress.percentage }}%
    </progress>
         </div>
 </div>
<!-- REGION -->
  <div class="mb-4">
      <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none"
      name="region"
      id="region"
      v-model="lead.region"
      required >
      <option value="Dakar">Dakar</option>
<option value="Diourbel">Diourbel</option>
<option value="Fatick">Fatick</option>
<option value="Kaffrine">Kaffrine</option>
<option value="Kaolack">Kaolack</option>
<option value="Kédougou">Kédougou</option>
<option value="Kolda">Kolda</option>
<option value="Louga">Louga</option>
<option value="Matam">Matam</option>
<option value="Saint-Louis">Saint-Louis</option>
<option value="Sédhiou">Sédhiou</option>
<option value="Tambacounda">Tambacounda</option>
<option value="Thiès">Thiès</option>
<option value="Ziguinchor">Ziguinchor</option>
</select>
  </div>

         <button type="submit" class="bg-yellow-500 px-5 py-1 rounded-2xl">save</button>

    </form>
    </div>
  </div>
<!-- VERGER -->
  <div v-else-if="lead.type==='Verger'">
    <div class="w-11/12 px-2 m-auto rounded-2xl border-2 shadow-lg border-slate-200  lg:w-2/5 ">
  <h2 class="my-5 text-center bg-amber-300 rounded-full py-3">Ecrivez votre annonce de Verger</h2>

    <form @submit.prevent="handleSubmit2">
<!-- NOM -->

      <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2"
          for="nom">
              Titre
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
             id="nom"
             name="nom"
             type="text"
             placeholder="Entrez le titre de votre annonce "
             v-model="verger.nom"
             required>
      </div>

<!-- PRIX -->
           <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="price">
              Prix
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
             id="prix"
             type="text"
             placeholder="Entrez le prix"
             name="prix"
             v-model="verger.prix"
             required>
      </div>
<!-- DESCRIPTION -->
      <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="description">
              Description
          </label>
          <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
             id="description" rows="5"
             name="description"
             v-model="verger.description"
             placeholder="Entrez la description"
             required></textarea>
      </div>
<!-- <PIECE>-->

  <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2"
          for="npiece">
              Surface
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
             id="surface"
             name="surface"
             type="text"
             placeholder="Entrez la surface"
             v-model="verger.surface"
             required>
      </div>

<!-- AFFAIRE -->
<label class="block text-gray-700 font-bold mb-2" for="fuel">
         Location ou vente
       </label>
       <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="affaire"
            name="affaire"
            v-model="verger.affaire">
         <option value="vente">vente</option>
         <option value="location">location</option>
       </select>

<!-- IMAGES -->

 <div class="images">
  <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2"
                for="image"
                >
                 Image 1
             </label>
             <input type="file" @input="verger.image1 = $event.target.files[0]" />
             <progress v-if="verger.progress" :value="verger.progress.percentage" max="100">
      {{ verger.progress.percentage }}%
    </progress>
         </div>

          <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2"
                for="image"
                >
                 Image 2
             </label>
             <input type="file" @input="verger.image2 = $event.target.files[0]" />
             <progress v-if="verger.progress" :value="verger.progress.percentage" max="100">
      {{ verger.progress.percentage }}%
    </progress>
         </div>

         <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2"
                for="image"
                >
                 Image 3
             </label>
             <input type="file" @input="verger.image3 = $event.target.files[0]" />
             <progress v-if="verger.progress" :value="verger.progress.percentage" max="100">
      {{ verger.progress.percentage }}%
    </progress>
         </div>
 </div>
<!-- REGION -->
  <div class="mb-4">
      <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none"
      name="region"
      id="region"
      v-model="verger.region"
      required >
      <option value="Dakar">Dakar</option>
<option value="Diourbel">Diourbel</option>
<option value="Fatick">Fatick</option>
<option value="Kaffrine">Kaffrine</option>
<option value="Kaolack">Kaolack</option>
<option value="Kédougou">Kédougou</option>
<option value="Kolda">Kolda</option>
<option value="Louga">Louga</option>
<option value="Matam">Matam</option>
<option value="Saint-Louis">Saint-Louis</option>
<option value="Sédhiou">Sédhiou</option>
<option value="Tambacounda">Tambacounda</option>
<option value="Thiès">Thiès</option>
<option value="Ziguinchor">Ziguinchor</option>
</select>
  </div>

         <button type="submit" class="bg-yellow-500 px-5 py-1 rounded-2xl">save</button>

    </form>
   </div>
  </div>

  <!-- FERME -->
  <div v-else-if="lead.type==='Ferme'">
    <div class="w-11/12 px-2  m-auto rounded-2xl border-2 shadow-lg border-slate-200  lg:w-2/5 ">
  <h2 class="my-5 text-center bg-amber-300 rounded-full py-3">Ecrivez votre annonce de Ferme</h2>

      <form @submit.prevent="handleSubmit3">
<!-- NOM -->

      <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2"
          for="nom">
              Nom
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
             id="nom"
             name="nom"
             type="text"
             placeholder="Entrez le titre de votre annonce"
             v-model="ferme.nom"
             required>
      </div>

<!-- PRIX -->
           <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="price">
              Prix
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
             id="prix"
             type="text"
             placeholder="Entrez le prix"
             name="prix"
             v-model="ferme.prix"
             required>
      </div>
<!-- DESCRIPTION -->
      <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" for="description">
              Description
          </label>
          <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
             id="description" rows="5"
             name="description"
             v-model="ferme.description"
             placeholder="Entrez la description"
             required></textarea>
      </div>
<!-- <PIECE>-->

  <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2"
          for="npiece">
              Surface
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
             id="surface"
             name="surface"
             type="text"
             placeholder="Entrez la surface"
             v-model="ferme.surface"
             required>
      </div>

<!-- AFFAIRE -->
<label class="block text-gray-700 font-bold mb-2" for="fuel">
         Location ou vente
       </label>
       <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="affaire"
            name="affaire"
            v-model="ferme.affaire">
         <option value="vente">vente</option>
         <option value="location">location</option>
       </select>

<!-- IMAGES -->
       <div class="images">
        <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2"
                for="image"
                >
                 Image 1
             </label>
             <input type="file" @input="ferme.image1 = $event.target.files[0]" />
             <progress v-if="ferme.progress" :value="ferme.progress.percentage" max="100">
      {{ ferme.progress.percentage }}%
    </progress>
         </div>

          <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2"
                for="image"
                >
                 Image 2
             </label>
             <input type="file" @input="ferme.image2 = $event.target.files[0]" />
             <progress v-if="ferme.progress" :value="ferme.progress.percentage" max="100">
      {{ ferme.progress.percentage }}%
    </progress>
         </div>

         <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2"
                for="image"
                >
                 Image 3
             </label>
             <input type="file" @input="ferme.image3 = $event.target.files[0]" />
             <progress v-if="ferme.progress" :value="ferme.progress.percentage" max="100">
      {{ ferme.progress.percentage }}%
    </progress>
         </div>
       </div>

<!-- REGION -->
  <div class="mb-4">
      <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none"
      name="region"
      id="region"
      v-model="ferme.region"
      required >
      <option value="Dakar">Dakar</option>
<option value="Diourbel">Diourbel</option>
<option value="Fatick">Fatick</option>
<option value="Kaffrine">Kaffrine</option>
<option value="Kaolack">Kaolack</option>
<option value="Kédougou">Kédougou</option>
<option value="Kolda">Kolda</option>
<option value="Louga">Louga</option>
<option value="Matam">Matam</option>
<option value="Saint-Louis">Saint-Louis</option>
<option value="Sédhiou">Sédhiou</option>
<option value="Tambacounda">Tambacounda</option>
<option value="Thiès">Thiès</option>
<option value="Ziguinchor">Ziguinchor</option>
</select>
  </div>

         <button type="submit" class="bg-yellow-500 px-5 py-1 rounded-2xl">save</button>

    </form>
    </div>
  </div>

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

