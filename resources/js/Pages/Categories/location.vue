<script setup>
import { useForm } from "@inertiajs/vue3"
  const lead = useForm({
            nom: null,
            description: null,
            prix: null,
            region: null,
            image: null,
            type: null,
            categorie: null,
})

function handleSubmit() {
  lead.post('/location/save')
}
   </script>
<template>
 <div class="p-6">
    <form @submit.prevent="handleSubmit">       
      <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" 
          for="nom">
              Nom
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
             id="nom"
             name="nom"
             type="text"
             placeholder="Entrez le nom"
             v-model="lead.nom"
             required>
      </div>


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

      <div class="mb-4">
      <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none"
      name="type"
      id="type"
      v-model="lead.type"
      required >
      <option value="appartement">Appartement</option>
  <option value="maison">Maison</option>
  <option value="terrain">Terrain</option>
  <option value="local_commercial">Local commercial</option>
</select>
  </div>

      
      <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" 
             for="image"
             >
              Image
          </label>
          <input type="file" @input="lead.image = $event.target.files[0]" />
          <progress v-if="lead.progress" :value="lead.progress.percentage" max="100">
   {{ lead.progress.percentage }}%
 </progress>
      </div>

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

         <button type="submit">save</button>
  
    </form>
  </div>
 
  
</template>

