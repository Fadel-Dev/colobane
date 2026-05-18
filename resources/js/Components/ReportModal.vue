<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextArea from '@/Components/TextArea.vue'; // Supposant qu'il existe ou j'utiliserai une balise textarea

const props = defineProps({
    show: Boolean,
    immobilierId: Number
});

const emit = defineEmits(['close']);

const form = useForm({
    reason: '',
    description: ''
});

const reasons = [
    'Annonce frauduleuse / Arnaque',
    'Bien déjà loué / Vendu',
    'Informations incorrectes',
    'Photos trompeuses',
    'Prix irréaliste',
    'Autre'
];

const submit = () => {
    form.post(route('report.immobilier', props.immobilierId), {
        onSuccess: () => {
            form.reset();
            emit('close');
        }
    });
};
</script>

<template>
    <Modal :show="show" @close="$emit('close')">
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">
                Signaler cette annonce
            </h2>
            <p class="text-sm text-gray-600 mb-6">
                Aidez-nous à maintenir NoflayHub sûr. Pourquoi signalez-vous cette annonce ?
            </p>

            <form @submit.prevent="submit">
                <div class="space-y-4">
                    <div>
                        <InputLabel for="reason" value="Raison du signalement" />
                        <select 
                            v-model="form.reason" 
                            class="mt-1 block w-full border-gray-300 focus:border-principal focus:ring-principal rounded-md shadow-sm"
                            required
                        >
                            <option value="" disabled>Sélectionnez une raison</option>
                            <option v-for="reason in reasons" :key="reason" :value="reason">
                                {{ reason }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <InputLabel for="description" value="Précisions (optionnel)" />
                        <textarea
                            v-model="form.description"
                            class="mt-1 block w-full border-gray-300 focus:border-principal focus:ring-principal rounded-md shadow-sm"
                            rows="4"
                            placeholder="Donnez plus de détails pour nous aider à comprendre..."
                        ></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <SecondaryButton @click="$emit('close')"> Annuler </SecondaryButton>
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Envoyer le signalement
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </Modal>
</template>
