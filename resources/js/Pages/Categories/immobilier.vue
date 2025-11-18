<script setup>
import { ref, computed } from 'vue';
import { useForm } from "@inertiajs/vue3";
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const lead = useForm({
    nom: null,
    description: null,
    prix: null,
    region: null,
    images: [], // Tableau pour toutes les images
    type: null,
    npiece: null,
    surface: null,
    affaire: null,
});

const currentStep = ref(1);

// Image previews - tableau dynamique
const imagePreviews = ref([]);

function nextStep() {
    if (currentStep.value < 3) currentStep.value++;
}

function prevStep() {
    if (currentStep.value > 1) currentStep.value--;
}

function handleMultipleImages(event) {
    const files = Array.from(event.target.files);
    addFiles(files);
    
    // Réinitialiser l'input pour permettre de sélectionner les mêmes fichiers
    if (event.target) {
        event.target.value = '';
    }
}

function addFiles(files) {
    // Limiter à maxImages images maximum
    const remainingSlots = maxImages - imagePreviews.value.length;
    const filesToAdd = files.slice(0, remainingSlots);
    
    filesToAdd.forEach(file => {
        if (file.type.startsWith('image/')) {
            const preview = URL.createObjectURL(file);
            imagePreviews.value.push({
                file: file,
                preview: preview,
                id: Date.now() + Math.random()
            });
            lead.images.push(file);
        }
    });
}

function handleDrop(event) {
    event.preventDefault();
    event.stopPropagation();
    
    const files = Array.from(event.dataTransfer.files);
    addFiles(files);
}

function handleDragOver(event) {
    event.preventDefault();
    event.stopPropagation();
}

function removeImage(index) {
    // Révocquer l'URL de l'objet
    if (imagePreviews.value[index].preview) {
        URL.revokeObjectURL(imagePreviews.value[index].preview);
    }
    
    // Retirer de l'array
    imagePreviews.value.splice(index, 1);
    lead.images.splice(index, 1);
}

function handleSubmit() {
    // Préparer les données pour l'envoi
    // Les 3 premières images seront envoyées comme image1, image2, image3 pour compatibilité
    if (lead.images.length > 0) {
        lead.image1 = lead.images[0] || null;
        lead.image2 = lead.images.length > 1 ? lead.images[1] : null;
        lead.image3 = lead.images.length > 2 ? lead.images[2] : null;
    }
    
    let url = '/immobilier/save';
    if (lead.type === 'Verger') {
        url = '/immobilier2/save';
    } else if (lead.type === 'Ferme') {
        url = '/immobilier3/save';
    }
    
    // Envoyer le formulaire avec les images
    // Inertia.js gère automatiquement les fichiers dans le form
    lead.post(url);
}

const images = [
    { id: 1, src: "/storage/slide/villa.png", alt: "Image 1", titre: "Villa", icon: "bi-house-door" },
    { id: 2, src: "/storage/slide/appartement.png", alt: "Image 2", titre: "Appartement", icon: "bi-building" },
    { id: 3, src: "/storage/slide/terrain.png", alt: "Image 3", titre: "Terrain", icon: "bi-map" },
    { id: 4, src: "/storage/slide/chambre.png", alt: "Image 4", titre: "Chambre", icon: "bi-door-open" },
    { id: 5, src: "/storage/slide/immeuble.png", alt: "Image 5", titre: "Immeuble", icon: "bi-buildings" },
    { id: 6, src: "/storage/slide/verger.png", alt: "Image 6", titre: "Verger", icon: "bi-tree" },
    { id: 7, src: "/storage/slide/ferme.png", alt: "Image 7", titre: "Ferme", icon: "bi-barn" }
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

const totalSteps = 3;
const maxImages = 10;
</script>

<template>
    <AppLayout title="Publier un bien immobilier">
        <Head title="Publier un bien immobilier" />

        <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50 py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        Publier un bien immobilier
                    </h1>
                    <p class="text-gray-600">
                        Remplissez le formulaire ci-dessous pour publier votre annonce
                    </p>
                </div>

                <!-- Step Indicator -->
                <div v-if="lead.type" class="mb-8">
                    <div class="flex items-center justify-between">
                        <div
                            v-for="step in totalSteps"
                            :key="step"
                            class="flex items-center flex-1"
                        >
                            <div class="flex items-center flex-1">
                                <div
                                    :class="[
                                        'w-10 h-10 rounded-full flex items-center justify-center font-bold transition-all',
                                        currentStep >= step
                                            ? 'bg-principal text-white'
                                            : 'bg-gray-200 text-gray-500'
                                    ]"
                                >
                                    <i
                                        v-if="currentStep > step"
                                        class="bi bi-check-lg"
                                    ></i>
                                    <span v-else>{{ step }}</span>
                                </div>
                                <div
                                    v-if="step < totalSteps"
                                    :class="[
                                        'flex-1 h-1 mx-2 transition-all',
                                        currentStep > step ? 'bg-principal' : 'bg-gray-200'
                                    ]"
                                ></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-2 text-sm text-gray-600">
                        <span :class="currentStep >= 1 ? 'text-principal font-semibold' : ''">Informations</span>
                        <span :class="currentStep >= 2 ? 'text-principal font-semibold' : ''">Détails</span>
                        <span :class="currentStep >= 3 ? 'text-principal font-semibold' : ''">Finalisation</span>
                    </div>
                </div>

                <!-- Type Selection -->
                <div v-if="!lead.type" class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                        Sélectionnez le type de bien
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <label
                            v-for="image in images"
                            :key="image.id"
                            :class="[
                                'relative cursor-pointer rounded-xl border-2 p-4 transition-all duration-300 hover:shadow-lg',
                                lead.type === image.titre
                                    ? 'border-principal bg-principal/5 shadow-md scale-105'
                                    : 'border-gray-200 hover:border-principal/50'
                            ]"
                        >
                            <input
                                type="radio"
                                class="sr-only"
                                :value="image.titre"
                                v-model="lead.type"
                            />
                            <div class="text-center">
                                <div
                                    :class="[
                                        'w-16 h-16 mx-auto mb-3 rounded-xl flex items-center justify-center transition-all',
                                        lead.type === image.titre
                                            ? 'bg-principal text-white'
                                            : 'bg-gray-100 text-gray-600'
                                    ]"
                                >
                                    <i :class="`bi ${image.icon} text-2xl`"></i>
                                </div>
                                <h3 class="font-semibold text-gray-900">{{ image.titre }}</h3>
                            </div>
                            <div
                                v-if="lead.type === image.titre"
                                class="absolute top-2 right-2 w-6 h-6 bg-principal rounded-full flex items-center justify-center"
                            >
                                <i class="bi bi-check text-white text-sm"></i>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Form -->
                <div v-if="lead.type" class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8">
                    <form @submit.prevent="handleSubmit">
                        <!-- Step 1: Basic Info -->
                        <div v-if="currentStep === 1" class="space-y-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                    Informations de base
                                </h2>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Titre de l'annonce <span class="text-red-500">*</span>
                                </label>
                                <input
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-transparent transition-all"
                                    id="nom"
                                    name="nom"
                                    type="text"
                                    placeholder="Ex: Belle villa 4 chambres à Dakar"
                                    v-model="lead.nom"
                                    required
                                />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Prix (FCFA) <span class="text-red-500">*</span>
                                </label>
                                <input
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-transparent transition-all"
                                    id="prix"
                                    type="text"
                                    placeholder="Ex: 5000000"
                                    name="prix"
                                    v-model="lead.prix"
                                    required
                                />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Description <span class="text-red-500">*</span>
                                </label>
                                <textarea
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-transparent transition-all resize-none"
                                    id="description"
                                    rows="5"
                                    name="description"
                                    v-model="lead.description"
                                    placeholder="Décrivez votre bien en détail..."
                                    required
                                ></textarea>
                            </div>

                            <div class="flex justify-end pt-4">
                                <button
                                    type="button"
                                    @click="nextStep"
                                    :disabled="!isStepOneValid"
                                    :class="[
                                        'px-6 py-3 rounded-xl font-semibold transition-all',
                                        isStepOneValid
                                            ? 'bg-principal text-white hover:bg-principal-dark shadow-lg hover:shadow-xl'
                                            : 'bg-gray-300 text-gray-500 cursor-not-allowed'
                                    ]"
                                >
                                    Suivant
                                    <i class="bi bi-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Details -->
                        <div v-if="currentStep === 2" class="space-y-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                    Détails du bien
                                </h2>
                            </div>

                            <div v-if="['Villa', 'Appartement', 'Immeuble', 'Chambre'].includes(lead.type)">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nombre de pièces <span class="text-red-500">*</span>
                                </label>
                                <input
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-transparent transition-all"
                                    id="npiece"
                                    name="npiece"
                                    type="text"
                                    placeholder="Ex: 4"
                                    v-model="lead.npiece"
                                    required
                                />
                            </div>

                            <div v-else>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Surface (m²) <span class="text-red-500">*</span>
                                </label>
                                <input
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-transparent transition-all"
                                    id="surface"
                                    name="surface"
                                    type="text"
                                    placeholder="Ex: 500"
                                    v-model="lead.surface"
                                    required
                                />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Type d'affaire <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-transparent transition-all bg-white"
                                    id="affaire"
                                    name="affaire"
                                    v-model="lead.affaire"
                                    required
                                >
                                    <option value="" disabled selected>Sélectionnez...</option>
                                    <option value="Vente">Vente</option>
                                    <option value="Location">Location</option>
                                </select>
                            </div>

                            <div class="flex justify-between pt-4">
                                <button
                                    type="button"
                                    @click="prevStep"
                                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition-all"
                                >
                                    <i class="bi bi-arrow-left mr-2"></i>
                                    Précédent
                                </button>
                                <button
                                    type="button"
                                    @click="nextStep"
                                    :disabled="!isStepTwoValid"
                                    :class="[
                                        'px-6 py-3 rounded-xl font-semibold transition-all',
                                        isStepTwoValid
                                            ? 'bg-principal text-white hover:bg-principal-dark shadow-lg hover:shadow-xl'
                                            : 'bg-gray-300 text-gray-500 cursor-not-allowed'
                                    ]"
                                >
                                    Suivant
                                    <i class="bi bi-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Images & Region -->
                        <div v-if="currentStep === 3" class="space-y-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                    Photos et localisation
                                </h2>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Photos du bien <span class="text-red-500">*</span>
                                </label>
                                <p class="text-xs text-gray-500 mb-4">
                                    Sélectionnez plusieurs photos à la fois (maximum {{ maxImages }} photos)
                                    <span v-if="imagePreviews.length > 0" class="text-principal font-semibold">
                                        - {{ imagePreviews.length }}/{{ maxImages }} sélectionnées
                                    </span>
                                </p>
                                
                                <!-- Upload Multiple with Drag & Drop -->
                                <div class="mb-6">
                                    <label
                                        v-if="imagePreviews.length < maxImages"
                                        @drop="handleDrop"
                                        @dragover="handleDragOver"
                                        @dragenter="handleDragOver"
                                        class="block w-full border-2 border-dashed border-principal rounded-xl cursor-pointer hover:bg-principal/5 transition-colors p-8 text-center"
                                    >
                                        <div>
                                            <i class="bi bi-cloud-upload text-5xl text-principal mb-3"></i>
                                            <p class="text-lg font-semibold text-gray-900 mb-1">
                                                Cliquez pour sélectionner des photos
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                ou glissez-déposez vos images ici
                                            </p>
                                            <p class="text-xs text-gray-500 mt-2">
                                                Formats acceptés: JPG, PNG, WEBP (max {{ maxImages }} photos)
                                            </p>
                                        </div>
                                        <input
                                            type="file"
                                            @change="handleMultipleImages"
                                            class="hidden"
                                            accept="image/*"
                                            multiple
                                        />
                                    </label>
                                </div>

                                <!-- Images Preview Grid -->
                                <div v-if="imagePreviews.length > 0" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                    <div
                                        v-for="(image, index) in imagePreviews"
                                        :key="image.id"
                                        class="relative group"
                                    >
                                        <div class="aspect-square rounded-xl overflow-hidden border-2 border-gray-200">
                                            <img
                                                :src="image.preview"
                                                :alt="`Preview ${index + 1}`"
                                                class="w-full h-full object-cover"
                                            />
                                        </div>
                                        <button
                                            type="button"
                                            @click="removeImage(index)"
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 transition-colors shadow-lg"
                                            title="Supprimer cette photo"
                                        >
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                        <div class="absolute bottom-2 left-2 bg-black/70 text-white px-2 py-1 rounded text-xs font-semibold">
                                            Photo {{ index + 1 }}
                                        </div>
                                        <div v-if="index < 3" class="absolute top-2 left-2 bg-principal text-white px-2 py-1 rounded text-xs font-semibold">
                                            Principale
                                        </div>
                                    </div>
                                </div>

                                <!-- Add More Button -->
                                <div v-if="imagePreviews.length > 0 && imagePreviews.length < maxImages" class="mt-4">
                                    <label class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl cursor-pointer transition-colors">
                                        <i class="bi bi-plus-circle mr-2"></i>
                                        Ajouter plus de photos ({{ maxImages - imagePreviews.length }} restantes)
                                        <input
                                            type="file"
                                            @change="handleMultipleImages"
                                            class="hidden"
                                            accept="image/*"
                                            multiple
                                        />
                                    </label>
                                </div>

                                <progress
                                    v-if="lead.progress"
                                    :value="lead.progress.percentage"
                                    max="100"
                                    class="w-full mt-4 h-2 rounded-full"
                                >
                                    {{ lead.progress.percentage }}%
                                </progress>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Région <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-transparent transition-all bg-white"
                                    v-model="lead.region"
                                    required
                                >
                                    <option value="" disabled selected>Sélectionnez une région</option>
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

                            <div class="flex justify-between pt-4">
                                <button
                                    type="button"
                                    @click="prevStep"
                                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition-all"
                                >
                                    <i class="bi bi-arrow-left mr-2"></i>
                                    Précédent
                                </button>
                                <button
                                    type="submit"
                                    :disabled="lead.processing || imagePreviews.length === 0"
                                    :class="[
                                        'px-8 py-3 rounded-xl font-semibold transition-all',
                                        lead.processing || imagePreviews.length === 0
                                            ? 'bg-gray-400 cursor-not-allowed'
                                            : 'bg-principal text-white hover:bg-principal-dark shadow-lg hover:shadow-xl'
                                    ]"
                                >
                                    <span v-if="lead.processing">
                                        <i class="bi bi-hourglass-split animate-spin mr-2"></i>
                                        Publication...
                                    </span>
                                    <span v-else>
                                        <i class="bi bi-check-circle mr-2"></i>
                                        Publier l'annonce ({{ imagePreviews.length }} photo{{ imagePreviews.length > 1 ? 's' : '' }})
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
progress {
    -webkit-appearance: none;
    appearance: none;
}

progress::-webkit-progress-bar {
    background-color: #e5e7eb;
    border-radius: 9999px;
}

progress::-webkit-progress-value {
    background-color: #eb2d53;
    border-radius: 9999px;
}
</style>
