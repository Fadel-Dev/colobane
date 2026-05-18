<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';

const props = defineProps({
    targetUserId: Number,
    immobilierId: Number,
    existingRating: {
        type: Number,
        default: 0
    },
    existingComment: {
        type: String,
        default: ''
    }
});

const form = useForm({
    target_user_id: props.targetUserId,
    immobilier_id: props.immobilierId,
    rating: props.existingRating || 5,
    comment: props.existingComment || ''
});

const hoverRating = ref(0);

const setRating = (rating) => {
    form.rating = rating;
};

const submit = () => {
    form.post(route('review.store'), {
        preserveScroll: true,
        onSuccess: () => {
            // Optionnel: Message de succès
        }
    });
};
</script>

<template>
    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
        <h3 class="font-bold text-gray-900 mb-4 text-lg">Laisser un avis</h3>
        
        <form @submit.prevent="submit">
            <div class="mb-4">
                <InputLabel value="Votre note" class="mb-2" />
                <div class="flex items-center space-x-1">
                    <button 
                        v-for="i in 5" 
                        :key="i"
                        type="button"
                        @click="setRating(i)"
                        @mouseenter="hoverRating = i"
                        @mouseleave="hoverRating = 0"
                        class="focus:outline-none transition-transform hover:scale-110"
                    >
                        <svg 
                            :class="[
                                'w-8 h-8',
                                (hoverRating || form.rating) >= i ? 'text-yellow-400 fill-current' : 'text-gray-300'
                            ]"
                            xmlns="http://www.w3.org/2000/svg" 
                            viewBox="0 0 24 24" 
                            stroke="currentColor" 
                            stroke-width="2" 
                            stroke-linecap="round" 
                            stroke-linejoin="round"
                        >
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </button>
                    <span class="ml-2 text-sm font-semibold text-gray-600">
                        {{ form.rating }}/5
                    </span>
                </div>
            </div>

            <div class="mb-4">
                <InputLabel for="comment" value="Votre commentaire (optionnel)" />
                <textarea
                    v-model="form.comment"
                    class="mt-1 block w-full border-gray-300 focus:border-principal focus:ring-principal rounded-md shadow-sm"
                    rows="3"
                    placeholder="Comment s'est passée votre interaction ?"
                ></textarea>
            </div>

            <div class="flex justify-end">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Publier l'avis
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>
