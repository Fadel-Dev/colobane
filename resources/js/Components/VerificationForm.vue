<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    user: Object
});

const form = useForm({
    documents: []
});

const fileInput = ref(null);
const previewUrls = ref([]);

const handleFileChange = (e) => {
    const files = Array.from(e.target.files);
    form.documents = files;
    
    previewUrls.value = files.map(file => {
        if (file.type.startsWith('image/')) {
            return URL.createObjectURL(file);
        }
        return null;
    });
};

const submit = () => {
    form.post(route('user.verify.submit'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            previewUrls.value = [];
        }
    });
};
</script>

<template>
    <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-xl">
        <div class="flex items-center space-x-4 mb-8">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900">Vérification de compte</h3>
                <p class="text-gray-600 text-sm">Obtenez le badge "Vérifié" pour rassurer vos clients.</p>
            </div>
        </div>

        <div v-if="user.is_verified" class="bg-green-50 border border-green-200 rounded-xl p-6 flex items-center space-x-4">
            <div class="bg-green-500 rounded-full p-2 text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div>
                <p class="font-bold text-green-800">Votre compte est vérifié !</p>
                <p class="text-green-700 text-sm">Le badge bleu est désormais visible sur vos annonces.</p>
            </div>
        </div>

        <div v-else-if="user.verification_documents && user.verification_documents.length > 0" class="bg-blue-50 border border-blue-200 rounded-xl p-6 flex items-center space-x-4">
            <div class="bg-blue-500 rounded-full p-2 text-white animate-pulse">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="font-bold text-blue-800">Vérification en cours...</p>
                <p class="text-blue-700 text-sm">Nos équipes examinent vos documents. Vous recevrez une notification bientôt.</p>
            </div>
        </div>

        <form v-else @submit.prevent="submit" class="space-y-6">
            <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center transition-all hover:border-principal group">
                <input 
                    type="file" 
                    ref="fileInput" 
                    class="hidden" 
                    multiple 
                    @change="handleFileChange"
                    accept="image/*,application/pdf"
                >
                <div class="cursor-pointer" @click="$refs.fileInput.click()">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4 group-hover:text-principal transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <p class="text-lg font-semibold text-gray-700">Cliquez pour ajouter vos documents</p>
                    <p class="text-sm text-gray-500 mt-1">Pièce d'identité (CNI, Passeport) ou Titre de propriété (PDF, JPG, PNG)</p>
                </div>
            </div>

            <div v-if="previewUrls.length > 0" class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div v-for="(url, index) in previewUrls" :key="index" class="relative aspect-square rounded-lg overflow-hidden border border-gray-200">
                    <img v-if="url" :src="url" class="w-full h-full object-cover">
                    <div v-else class="w-full h-full bg-gray-100 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.586-.895l-5-5a1 1 0 00-1.414 0l-5 5A1 1 0 007 9.414V19a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex items-start space-x-2 text-xs text-gray-500 italic">
                <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p>Vos documents sont stockés de manière sécurisée et ne seront jamais partagés avec des tiers.</p>
            </div>

            <div class="flex justify-end">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing || form.documents.length === 0">
                    Soumettre pour vérification
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>
