<script setup>
import { useForm } from "@inertiajs/vue3"
import AppLayout from '@/Layouts/AppLayout.vue';


// LOCATION
  const lead = useForm({
            nom: null,
            marque: null,
            prix: null,
            boiteVitesse:null,
            description: null,
            carburant: null,
            place: null,
            region: null,
            image1: null,
            image2: null,
            image3: null,
})

function handleSubmitLocation() {
  lead.post('/voitureLocation/save')
}

// VENTE
const vente = useForm({
       nom: null,
               etat: null,
               marque: null,
               model: null,
               prix: null,
               description: null,
               carburant: null,
               annee: null,
               boiteVitesse: null,
               kilometrage: null,
               place: null,
               region: null,
               image1: null,
            image2: null,
            image3: null,
   })
   
   function handleSubmitVente() {
     vente.post('/voitureVente/save')
   }
   </script>
<template>
<AppLayout>

  <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                publcation voiture
            </h2>
        </template>
<div class="w-5/6 my-7 m-auto rounded-2xl  lg:w-2/5 border-2 shadow-lg border-slate-400   ">
    <h2 class="text-2xl  font-bold mb-4 text-center">Sélectionnez une image</h2>
    <div class=" " id="menu">
      <div v-for="image in images" :key="image.id" id="titre">
        <label>
          <input type="radio" :value="image.titre" v-model="lead.type" class="w-4/6 hidden mx-auto">
          <h3>{{ image.titre }}</h3>
          <img :src="image.src" :alt="image.alt" class=" rounded-lg shadow-lg">
        </label>
      </div>
    </div>
  </div>

<!-- LOCATION -->

<div v-if="lead.type=='location'">
  <div class="p-6  w-5/6 m-auto rounded-2xl border-2 shadow-lg border-slate-200  lg:w-2/5 ">
  <h2 class="my-5 text-center bg-amber-300 rounded-full py-3">Ecrivez votre annonce de location</h2>

    <form @submit.prevent="handleSubmitLocation">       
      <div class="titre">
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" 
          for="nom">
              Entrez le titre
          </label>
          <input class="shadow appearance-none border rounded  w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
             id="nom"
             name="nom"
             type="text"
             placeholder="Entrez le titre"
             v-model="lead.nom"
             required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" 
             for="marque">
                 Marque
             </label>
      <select class="shadow appearance-none border rounded  w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outlineshadow appearance-none border rounded  w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" for="marque"
      name="marque"
      id="marque"
      v-model="lead.marque"
      required >
  <option>Toyota</option>
  <option>Nissan</option>
  <option>Honda</option>
  <option>Hyundai</option>
  <option>Kia</option>
  <option>Mercedes</option>
  <option>BMW</option>
  <option>Audi</option>
</select>
  </div>
      </div>

      <div class="placePrix">
        <div class="mb-4">
          <label class="block text-gray-700 font-bold mb-2" 
          for="place">
              place
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
             id="place"
             name="place"
             type="text"
             placeholder="4"
             v-model="lead.place"
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
      </div>

      <div class="mb-4">
       <label class="block text-gray-700 font-bold mb-2" for="fuel">
         Boite de vitesse
       </label>
       <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 venteing-tight focus:outline-none focus:shadow-outline" 
            id="boiteVitesse"
            name="boiteVitesse"
            v-model="lead.boiteVitesse">
         <option value="automatique">Automatique</option>
         <option value="manuelle">Manuel</option>
       </select>
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
   <div class="img grid grid-cols-3">
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
   
      <div class="titre">
        <div class="carbRegion grid grid-cols-2">
          <div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2" for="fuel">
      Carburant
    </label>
    <select class="shadow appearance-none border rounded  w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
         id="carburant"
         name="carburant"
         v-model="lead.carburant">
      <option value="essence">Essence</option>
      <option value="diesel">Diesel</option>
    </select>
  </div>




  <div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2" for="region">
      Region
    </label>
      <select class="shadow appearance-none  border rounded  w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
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
        </div>
      </div>

         <button type="submit" class="bg-yellow-500 px-5 py-1 rounded-2xl">save</button>
  
    </form>
  </div>
</div>
<div v-if="lead.type=='vente'">
  <div class="p-6  w-5/6 m-auto rounded-2xl border-2 shadow-lg border-slate-200  lg:w-2/5 ">
       <form @submit.prevent="handleSubmitVente">       
         <div class="mb-4">
  <h2 class="my-5 text-center bg-amber-300 rounded-full py-3">Ecrivez votre annonce de voiture</h2>

             <label class="block text-gray-700 font-bold mb-2" 
             for="nom">
                 Titre
             </label>
             <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 venteing-tight focus:outline-none focus:shadow-outline" 
                id="nom"
                name="nom"
                type="text"
                placeholder="Entrez le titre de votre ..."
                v-model="vente.nom"
                required>
         </div>
 
        <div class="flex">
          <div class="mb-4 flex flex-col">
            <label class="block text-gray-700 font-bold mb-2" for="text">Marque</label>
         <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 venteing-tight focus:outline-none focus:shadow-outline"
         name="marque"
         id="marque"
         v-model="vente.marque"
         required >
     <option>Toyota</option>
     <option>Nissan</option>
     <option>Honda</option>
     <option>Hyundai</option>
     <option>Kia</option>
     <option>Mercedes</option>
     <option>BMW</option>
     <option>Audi</option>
   </select>
     </div>

    <!--  -->
     <div class="mb-4 w-full m-auto">
            <div class="bg-white w-5/6 mx-auto ">
              <label class="block text-gray-700 font-bold mb-2 w-24 mx-auto" for="model">
                 Modèle
             </label>
              <input class="shadow appearance-none border rounded py-2 px-auto text-gray-700 venteing-tight focus:outline-none focus:shadow-outline w-full" 
                id="model" 
                type="text" 
                name="model"
                placeholder="Entrez le modèle"
                v-model="vente.model"
                required>
            </div>
         </div>
        </div>
      <div class="prixAnnee grid grid-cols-2 gap-2 ">
        <div class="mb-4 ">
             <label class="block text-gray-700 font-bold mb-2" 
             for="annee">
                 Annee
             </label>
             <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 venteing-tight focus:outline-none focus:shadow-outline" 
                id="annee"
                name="annee"
                type="text"
                placeholder="1999"
                v-model="vente.annee"
                required>
         </div>
        
 
         <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2" for="price">
                 Prix
             </label>
             <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 venteing-tight focus:outline-none focus:shadow-outline" 
                id="prix" 
                type="text" 
                placeholder="Entrez le prix"
                name="prix"
                v-model="vente.prix"
                required>
         </div>
      </div>
        <div class="kiloPlace">
          <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2" for="price">
                 kilometrage
             </label>
             <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 venteing-tight focus:outline-none focus:shadow-outline" 
                id="kilometrage" 
                type="text" 
                placeholder="Entrez le kilometrage"
                name="kilometrage"
                v-model="vente.kilometrage"
                required>
         </div>

         <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2" for="price">
                 place
             </label>
             <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 venteing-tight focus:outline-none focus:shadow-outline" 
                id="place" 
                type="text" 
                placeholder="Entrez le place"
                name="place"
                v-model="vente.place"
                required>
         </div>
        </div>

         <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2" for="description">
                 Description
             </label>
             <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 venteing-tight focus:outline-none focus:shadow-outline" 
                id="description" rows="5" 
                name="description" 
                v-model="vente.description" 
                placeholder="Entrez la description"
                required></textarea>
         </div>
        
      
            <div class="carb">
              <div class="mb-4">
       <label class="block text-gray-700 font-bold mb-2" for="fuel">
         Carburant
       </label>
       <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 venteing-tight focus:outline-none focus:shadow-outline" 
            id="carburant"
            name="carburant"
            v-model="vente.carburant">
         <option value="essence">Essence</option>
         <option value="diesel">Diesel</option>
       </select>
     </div>
 
     <div class="mb-4">
       <label class="block text-gray-700 font-bold mb-2" for="fuel">
         Boite de vitesse
       </label>
       <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 venteing-tight focus:outline-none focus:shadow-outline" 
            id="boiteVitesse"
            name="boiteVitesse"
            v-model="vente.boiteVitesse">
         <option value="automatique">Automatique</option>
         <option value="manuelle">Manuel</option>
       </select>
     </div>
            </div>

     <div class="etatRegion">
      <div class="mb-4">
       <label class="block text-gray-700 font-bold mb-2" for="fuel">
         Etat
       </label>
       <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 venteing-tight focus:outline-none focus:shadow-outline" 
            id="etat"
            name="etat"
            v-model="vente.etat">
         <option value="occasion">occasion</option>
         <option value="neuf">neuf</option>
       </select>
     </div>

     <div class="mb-4">
      <label class="block text-gray-700 font-bold mb-2" for="region">
         Region
       </label>
         <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 venteing-tight focus:outline-none focus:shadow-outline"
         name="region"
         id="region"
         v-model="vente.region"
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
     </div>
     <div class="img grid grid-cols-3">
      <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2" 
                for="image"
                >
                 Image 1
             </label>
             <input type="file" @input="vente.image1 = $event.target.files[0]" @change="vente.image1" />
             <progress v-if="vente.progress" :value="vente.progress.percentage" max="100">
      {{ vente.progress.percentage }}%
    </progress>
         </div>

          <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2" 
                for="image"
                >
                 Image 2
             </label>
             <input type="file" @input="vente.image2 = $event.target.files[0]" />
             <progress v-if="vente.progress" :value="vente.progress.percentage" max="100">
      {{ vente.progress.percentage }}%
    </progress>
         </div>

         <div class="mb-4">
             <label class="block text-gray-700 font-bold mb-2" 
                for="image"
                >
                 Image 3
             </label>
             <input type="file" @input="vente.image3 = $event.target.files[0]" />
             <progress v-if="vente.progress" :value="vente.progress.percentage" max="100">
      {{ vente.progress.percentage }}%
    </progress>
         </div> 
     </div>

            <button type="submit" class="bg-yellow-500 px-5 py-1 rounded-2xl">save</button>
     
       </form>
     </div>
</div>
</AppLayout>

 
 

</template>

<style>
.kiloPlace , .carb , .placePrix {
 display: grid;
 grid-template-columns: 35% 62%;
 grid-gap: 2%;
 margin: auto;
}

.etatRegion , .titre {
  display: grid;
 grid-template-columns:62% 35% ;
 grid-gap: 2%;
 margin: auto;
}

#titre {
  margin: 0;
  width: 68%;
}

#menu {
  width: 95%;
  margin: auto;
  display: grid;
  grid-template-columns: 48% 48%;
  grid-gap: 4%;
}
#menu img  {
  width: 65%;
  margin:auto
}

</style>

<script>
export default {
  data() {
    return {
      images: [
        { id: 1, src: "https://img.freepik.com/vecteurs-libre/achat-location-voiture-sport-rapide-nouvelle_3446-651.jpg?w=2000", alt: "Image 1" ,titre:"vente" },
        { id: 2, src: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4cbKD05717C87IvUZtFveQS-FOoiwt99H0crhA_M5qaoXJQxCHnQNo2n9v4ZVIAnuYzQ&usqp=CAU", alt: "Image 2" ,titre:"location" },
      ],
      selectedImage: null
    }
  }}
</script>

