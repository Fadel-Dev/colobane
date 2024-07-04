<script setup>
import { ref, computed } from 'vue';
import { useForm } from "@inertiajs/vue3";
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
  surface: null,
  affaire: null,
});

const currentStep = ref(1);

function nextStep() {
  if (currentStep.value < 3) currentStep.value++;
}

function prevStep() {
  if (currentStep.value > 1) currentStep.value--;
}

function handleSubmit() {
  let url = '/immobilier/save';
  if (lead.type === 'Verger') {
    url = '/immobilier2/save';
  } else if (lead.type === 'Ferme') {
    url = '/immobilier3/save';
  }
  lead.post(url);
}

const images = [
  { id: 1, src: "image1.jpg", alt: "Image 1", titre: "Villa" },
  { id: 2, src: "image2.jpg", alt: "Image 2", titre: "Appartement" },
  { id: 3, src: "image3.jpg", alt: "Image 3", titre: "Terrain" },
  { id: 4, src: "image4.jpg", alt: "Image 4", titre: "Chambre" },
  { id: 5, src: "image5.jpg", alt: "Image 5", titre: "Immeuble" },
  { id: 6, src: "image6.jpg", alt: "Image 6", titre: "Verger" },
  { id: 7, src: "image7.jpg", alt: "Image 7", titre: "Ferme" }
];

const isStepOneValid = computed(() => {
  return lead.nom && lead.prix && lead.description;
});

const isStepTwoValid = computed(() => {
  if (['Villa', 'Appartement', 'Immeuble', 'Chambre'].includes(lead.type)) {
    return lead.npiece && lead.affaire;
  } else {
    return lead.surface && lead.affaire;
  }
});
</script>

<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        Publication
      </h2>
    </template>

    <div class="w-11/12 my-7 m-auto rounded-2xl lg:w-2/5 border-2 shadow-lg border-slate-400">
      <h2 class="text-2xl font-bold mb-4 text-center">Sélectionnez une image</h2>
      <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4">
        <div v-for="image in images" :key="image.id">
          <label>
            <input type="radio" class="text-principal focus:border-white focus:ring-white" :value="image.titre" v-model="lead.type">
            <h3>{{ image.titre }}</h3>
            <img :src="image.src" :alt="image.alt" class="w-full rounded-lg shadow-lg">
          </label>
        </div>
      </div>
    </div>

    <div v-if="lead.type" class="p-6">
      <div class="w-full p-3 m-auto rounded-2xl border-2 shadow-lg border-slate-200 lg:w-2/5">
        <h2 class="my-5 text-center bg-principal text-white rounded-full py-3">Ecrivez votre annonce {{ lead.type.toLowerCase() }}</h2>

        <form @submit.prevent="handleSubmit">
          <div v-if="currentStep === 1">
            <!-- NOM -->
            <div class="mb-4">
              <label class="block text-gray-700 font-bold mb-2" for="nom">Titre</label>
              <input class="shadow appearance-none focus:border-gray-500 focus:ring-gray-500 border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nom" name="nom" type="text" placeholder="Entrez le titre de votre annonce" v-model="lead.nom" required>
            </div>

            <!-- PRIX -->
            <div class="mb-4">
              <label class="block text-gray-700 font-bold mb-2" for="prix">Prix</label>
              <input class="shadow appearance-none focus:border-gray-500 focus:ring-gray-500 border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="prix" type="text" placeholder="Entrez le prix" name="prix" v-model="lead.prix" required>
            </div>

            <!-- DESCRIPTION -->
            <div class="mb-4">
              <label class="block text-gray-700 font-bold mb-2" for="description">Description</label>
              <textarea class="shadow appearance-none focus:border-gray-500 focus:ring-gray-500 border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" rows="5" name="description" v-model="lead.description" placeholder="Entrez la description" required></textarea>
            </div>

            <button type="button" @click="nextStep" class="bg-principal text-white px-5 py-1 rounded-2xl" :disabled="!isStepOneValid">Suivant</button>
          </div>

          <div v-if="currentStep === 2">
            <!-- SPECIFIC FIELD BASED ON TYPE -->
            <div v-if="lead.type === 'Villa' || lead.type === 'Appartement' || lead.type === 'Immeuble' || lead.type === 'Chambre'" class="mb-4">
              <label class="block text-gray-700 font-bold mb-2" for="npiece">Nombre de pièce</label>
              <input class="shadow appearance-none focus:border-gray-500 focus:ring-gray-500 border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="npiece" name="npiece" type="text" placeholder="Entrez le nombre de pièce" v-model="lead.npiece" required>
            </div>

            <div v-else class="mb-4">
              <label class="block text-gray-700 font-bold mb-2" for="surface">Surface</label>
              <input class="shadow appearance-none focus:border-gray-500 focus:ring-gray-500 border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="surface" name="surface" type="text" placeholder="Entrez la surface" v-model="lead.surface" required>
            </div>

            <!-- AFFAIRE -->
            <label class="block text-gray-700 font-bold mb-2" for="affaire">Location ou vente</label>
            <select class="shadow appearance-none focus:border-gray-500 focus:ring-gray-500 border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="affaire" name="affaire" v-model="lead.affaire">
              <option value="vente">Vente</option>
              <option value="location">Location</option>
            </select>

            <button type="button" @click="prevStep" class="bg-gray-500 text-white px-5 py-1 rounded-2xl">Précédent</button>
            <button type="button" @click="nextStep" class="bg-principal text-white px-5 py-1 rounded-2xl" :disabled="!isStepTwoValid">Suivant</button>
          </div>

          <div v-if="currentStep === 3">
            <!-- IMAGES -->
            <div class="images mb-4">
              <label class="block text-gray-700 font-bold mb-2" for="image1">Image 1</label>
              <input type="file" @change="event => lead.image1 = event.target.files[0]" />
              <progress v-if="lead.progress" :value="lead.progress.percentage" max="100">{{ lead.progress.percentage }}%</progress>

              <label class="block text-gray-700 font-bold mb-2" for="image2">Image 2</label>
              <input type="file" @change="event => lead.image2 = event.target.files[0]" />
              <progress v-if="lead.progress" :value="lead.progress.percentage" max="100">{{ lead.progress.percentage }}%</progress>

              <label class="block text-gray-700 font-bold mb-2" for="image3">Image 3</label>
              <input type="file" @change="event => lead.image3 = event.target.files[0]" />
              <progress v-if="lead.progress" :value="lead.progress.percentage" max="100">{{ lead.progress.percentage }}%</progress>
            </div>

            <!-- REGION -->
            <div class="mb-4">
              <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" v-model="lead.region" required>
                <option value="" disabled selected hidden>Région</option>
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

            <button type="button" @click="prevStep" class="bg-gray-500 text-white px-5 py-1 rounded-2xl">Précédent</button>
            <button type="submit" class="bg-principal text-white px-5 py-1 rounded-2xl">Soumettre</button>
          </div>
        </form>
      </div>
    </div>
  </app-layout>
</template>

<style scoped>
.images {
  display: grid;
  grid-template-columns: 32% 32% 32%;
  grid-gap: 3%;
}
</style>
