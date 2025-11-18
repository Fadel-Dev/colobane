<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { router, useForm, Head } from "@inertiajs/vue3";
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    maison: Object,
    nameSeler: Object,
    mailSeler: Object,
    phoneSeler: Object,
    urlActuelle: Object,
});

// Initialiser le formulaire avec les valeurs existantes
  const form = useForm({
    nom: props.maison?.nom || '',
    description: props.maison?.description || '',
    prix: props.maison?.prix || '',
    type: props.maison?.type || '',
    npiece: props.maison?.npiece || '',
    surface: props.maison?.surface || '',
    region: props.maison?.region || '',
    categorie: props.maison?.categorie || '',
    affaire: props.maison?.affaire || '',
    images: [], // Nouvelles images à uploader
    image1: null,
    image2: null,
    image3: null,
    deletedImages: [], // Images existantes à supprimer
});

// Image previews - tableau dynamique pour nouvelles images
const imagePreviews = ref([]);
const maxImages = 10;

// Images supprimées (pour masquer visuellement)
const deletedImageUrls = ref([]);

// Images existantes depuis la base de données
const existingImages = computed(() => {
    const imgArray = [];
    
    // Ajouter les images individuelles si elles existent
    if (props.maison?.image1 && props.maison.image1 !== '' && !deletedImageUrls.value.includes(props.maison.image1)) {
        imgArray.push({
            url: props.maison.image1,
            id: 'image1',
            isExisting: true
        });
    }
    if (props.maison?.image2 && props.maison.image2 !== '' && !deletedImageUrls.value.includes(props.maison.image2)) {
        imgArray.push({
            url: props.maison.image2,
            id: 'image2',
            isExisting: true
        });
    }
    if (props.maison?.image3 && props.maison.image3 !== '' && !deletedImageUrls.value.includes(props.maison.image3)) {
        imgArray.push({
            url: props.maison.image3,
            id: 'image3',
            isExisting: true
        });
    }
    
    // Ajouter toutes les images du champ JSON si elles existent
    let jsonImages = [];
    if (props.maison?.images) {
        if (Array.isArray(props.maison.images)) {
            jsonImages = props.maison.images;
        } else if (typeof props.maison.images === 'string') {
            try {
                jsonImages = JSON.parse(props.maison.images);
            } catch (e) {
                console.error('Erreur parsing JSON images:', e);
                jsonImages = [];
            }
        }
    }
    
    // Ajouter les images JSON sans doublons et sans les supprimées
    if (Array.isArray(jsonImages)) {
        jsonImages.forEach((img, index) => {
            if (img && img !== '' && 
                !imgArray.some(existing => existing.url === img) &&
                !deletedImageUrls.value.includes(img)) {
                imgArray.push({
                    url: img,
                    id: `json_${index}`,
                    isExisting: true
                });
            }
        });
    }
    
    return imgArray;
});

// Fonction helper pour obtenir l'URL complète d'une image
const getImageUrl = (imagePath) => {
    if (!imagePath || imagePath === 'null' || imagePath === '') {
        return 'https://via.placeholder.com/800x600?text=Image+non+disponible';
    }
    
    if (imagePath.startsWith('http://') || imagePath.startsWith('https://')) {
        return imagePath;
    }
    
    if (imagePath.startsWith('storage/') || imagePath.startsWith('/storage/')) {
        return imagePath.startsWith('/') ? imagePath : '/' + imagePath;
    }
    
    return '/storage/' + imagePath;
};

function handleMultipleImages(event) {
    const files = Array.from(event.target.files);
    addFiles(files);
    
    if (event.target) {
        event.target.value = '';
    }
}

function addFiles(files) {
    const remainingSlots = maxImages - imagePreviews.value.length;
    const filesToAdd = files.slice(0, remainingSlots);
    
    filesToAdd.forEach(file => {
        if (file.type.startsWith('image/')) {
            const preview = URL.createObjectURL(file);
            imagePreviews.value.push({
                file: file,
                preview: preview,
                id: Date.now() + Math.random(),
                isExisting: false
            });
            form.images.push(file);
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
    if (imagePreviews.value[index].preview) {
        URL.revokeObjectURL(imagePreviews.value[index].preview);
    }
    imagePreviews.value.splice(index, 1);
    form.images.splice(index, 1);
}

function removeExistingImage(imageUrl) {
    // Ajouter à la liste des images supprimées (pour masquer visuellement)
    if (!deletedImageUrls.value.includes(imageUrl)) {
        deletedImageUrls.value.push(imageUrl);
    }
    
    // Marquer l'image existante pour suppression côté serveur
    // Normaliser l'URL pour correspondre au format stocké en base
    let normalizedUrl = imageUrl;
    
    // Si c'est une URL complète, extraire le chemin relatif
    if (imageUrl.includes('/storage/')) {
        normalizedUrl = imageUrl.split('/storage/')[1] || imageUrl;
    } else if (imageUrl.startsWith('storage/')) {
        normalizedUrl = imageUrl.replace('storage/', '');
    }
    
    // Ajouter les deux formats pour être sûr
    if (!form.deletedImages.includes(normalizedUrl) && !form.deletedImages.includes(imageUrl)) {
        form.deletedImages.push(normalizedUrl);
        // Ajouter aussi l'URL complète si différente
        if (normalizedUrl !== imageUrl) {
            form.deletedImages.push(imageUrl);
        }
    }
}

// Validation
const isStepOneValid = computed(() => {
    return form.nom && form.prix && form.description && form.type;
});

const isStepTwoValid = computed(() => {
    if (['Villa', 'Appartement', 'Immeuble', 'Chambre'].includes(form.type)) {
        return form.npiece && form.affaire;
    } else {
        return form.surface && form.affaire;
    }
});

const currentStep = ref(1);
const totalSteps = 3;

function nextStep() {
    if (currentStep.value < totalSteps) currentStep.value++;
}

function prevStep() {
    if (currentStep.value > 1) currentStep.value--;
}

function submit() {
    // Préparer les images pour l'envoi
    if (form.images.length > 0) {
        form.image1 = form.images[0] || null;
        form.image2 = form.images.length > 1 ? form.images[1] : null;
        form.image3 = form.images.length > 2 ? form.images[2] : null;
    }
    
    form.put(`/immobilier/${props.maison.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            router.visit('/dashboard');
        }
    });
}

// Nettoyage des URLs d'objet
onUnmounted(() => {
    imagePreviews.value.forEach(img => {
        if (img.preview && !img.isExisting) {
            URL.revokeObjectURL(img.preview);
        }
    });
});

const types = [
    { id: 1, titre: "Villa", icon: "bi-house-door" },
    { id: 2, titre: "Appartement", icon: "bi-building" },
    { id: 3, titre: "Terrain", icon: "bi-map" },
    { id: 4, titre: "Chambre", icon: "bi-door-open" },
    { id: 5, titre: "Immeuble", icon: "bi-buildings" },
    { id: 6, titre: "Verger", icon: "bi-tree" },
    { id: 7, titre: "Ferme", icon: "bi-barn" }
];
   </script>

<template>
    <AppLayout title="Modifier l'annonce">
        <Head title="Modifier l'annonce immobilière" />

        <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50 py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        Modifier votre annonce immobilière
                    </h1>
                    <p class="text-gray-600">
                        Modifiez les informations de votre annonce ci-dessous
                    </p>
                </div>

                <!-- Step Indicator -->
                <div v-if="form.type" class="mb-8">
                    <div class="flex items-center justify-between">
                        <div v-for="step in totalSteps" :key="step" class="flex items-center flex-1">
                            <div class="flex items-center flex-1">
                                <div
                                    :class="[
                                        'w-10 h-10 rounded-full flex items-center justify-center font-bold transition-all',
                                        currentStep >= step
                                            ? 'bg-principal text-white'
                                            : 'bg-gray-200 text-gray-500'
                                    ]"
                                >
                                    <i v-if="currentStep > step" class="bi bi-check-lg text-xl"></i>
                                    <span v-else>{{ step }}</span>
                                </div>
                                <div
                                    v-if="step < totalSteps"
                                    :class="[
                                        'flex-1 h-1 mx-2 rounded-full transition-all',
                                        currentStep > step ? 'bg-principal' : 'bg-gray-200'
                                    ]"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Type Selection -->
                <div v-if="!form.type" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                    <div
                        v-for="type in types"
                        :key="type.id"
                        @click="form.type = type.titre"
                        :class="[
                            'relative bg-white rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 cursor-pointer group',
                            form.type === type.titre ? 'ring-4 ring-principal ring-opacity-60' : ''
                        ]"
                    >
                        <div class="p-6 text-center">
                            <i :class="`bi ${type.icon} text-5xl text-principal mb-4 group-hover:scale-110 transition-transform duration-300`"></i>
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-principal transition-colors duration-300">
                                {{ type.titre }}
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Main Form -->
                <form @submit.prevent="submit" v-if="form.type" class="bg-white p-8 rounded-2xl shadow-xl">
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
                                placeholder="Ex: Belle villa avec piscine"
             v-model="form.nom"
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
                                placeholder="Ex: 50000000"
             name="prix"
             v-model="form.prix"
                                required
                            />
      </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Description <span class="text-red-500">*</span>
                            </label>
          <textarea 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-transparent transition-all"
                                id="description"
                                rows="5"
             name="description"
             v-model="form.description"
                                placeholder="Décrivez votre bien en détail..."
                                required
                            ></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Région <span class="text-red-500">*</span>
                            </label>
                            <select
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-transparent transition-all bg-white"
                                v-model="form.region"
                                required
                            >
                                <option value="" disabled selected hidden>Sélectionnez une région</option>
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

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Catégorie <span class="text-red-500">*</span>
                            </label>
                            <select
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-transparent transition-all bg-white"
                                v-model="form.categorie"
                                required
                            >
                                <option value="" disabled selected hidden>Sélectionnez...</option>
                                <option value="Vente">Vente</option>
                                <option value="Location">Location</option>
                            </select>
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

                        <div v-if="['Villa', 'Appartement', 'Immeuble', 'Chambre'].includes(form.type)">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nombre de pièces <span class="text-red-500">*</span>
                            </label>
                            <input
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-transparent transition-all"
                                id="npiece"
                                name="npiece"
                                type="text"
                                placeholder="Ex: 4"
                                v-model="form.npiece"
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
                                v-model="form.surface"
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
                                v-model="form.affaire"
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

                    <!-- Step 3: Images -->
                    <div v-if="currentStep === 3" class="space-y-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                Photos du bien
                            </h2>
                        </div>

                        <!-- Images existantes -->
                        <div v-if="existingImages.length > 0" class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">Images actuelles</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                <div
                                    v-for="(image, index) in existingImages"
                                    :key="image.id"
                                    class="relative group aspect-square rounded-xl overflow-hidden shadow-md border border-gray-200"
                                >
                                    <img
                                        :src="getImageUrl(image.url)"
                                        :alt="`Image ${index + 1}`"
                                        class="w-full h-full object-cover"
                                    />
                                    <button
                                        type="button"
                                        @click="removeExistingImage(image.url)"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 hover:bg-red-600 transition-colors opacity-0 group-hover:opacity-100 z-10"
                                        aria-label="Supprimer l'image"
                                    >
                                        <i class="bi bi-x-lg text-sm"></i>
                                    </button>
                                    <div class="absolute bottom-2 left-2 bg-black/60 text-white px-2 py-1 rounded text-xs font-semibold">
                                        Actuelle
                                    </div>
                                </div>
                            </div>
      </div>

                        <!-- Upload de nouvelles images -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Ajouter de nouvelles photos
                            </label>
                            <p class="text-xs text-gray-500 mb-4">
                                Sélectionnez plusieurs photos à la fois (maximum {{ maxImages }} photos)
                                <span v-if="imagePreviews.length > 0" class="text-principal font-semibold">
                                    - {{ imagePreviews.length }}/{{ maxImages }} sélectionnées
                                </span>
                            </p>
                            
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

                            <!-- Nouvelles images preview -->
                            <div v-if="imagePreviews.length > 0" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                <div
                                    v-for="(image, index) in imagePreviews"
                                    :key="image.id"
                                    class="relative group aspect-square rounded-xl overflow-hidden shadow-md border border-gray-200"
                                >
                                    <img
                                        :src="image.preview"
                                        :alt="`Preview ${index + 1}`"
                                        class="w-full h-full object-cover"
                                    />
                                    <button
                                        type="button"
                                        @click="removeImage(index)"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 hover:bg-red-600 transition-colors opacity-0 group-hover:opacity-100 z-10"
                                        aria-label="Supprimer l'image"
                                    >
                                        <i class="bi bi-x-lg text-sm"></i>
                                    </button>
                                    <div class="absolute bottom-2 left-2 bg-principal text-white px-2 py-1 rounded text-xs font-semibold">
                                        Nouvelle Photo {{ index + 1 }}
                                    </div>
                                </div>
                            </div>
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
                                :disabled="form.processing"
                                :class="[
                                    'px-6 py-3 rounded-xl font-semibold transition-all',
                                    form.processing
                                        ? 'bg-gray-300 text-gray-500 cursor-not-allowed'
                                        : 'bg-principal text-white hover:bg-principal-dark shadow-lg hover:shadow-xl'
                                ]"
                            >
                                {{ form.processing ? 'Enregistrement...' : 'Enregistrer les modifications' }}
                                <i v-if="!form.processing" class="bi bi-check-lg ml-2"></i>
                                <i v-else class="bi bi-hourglass-split animate-spin ml-2"></i>
                            </button>
                        </div>
                    </div>
    </form>
    </div>
  </div>
    </AppLayout>
</template>
