<template>
    <Head title="ajout" />

   

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="nom" value="Nom" />
                <TextInput
                    id="nom"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="nom"
                />
            </div>

            <div class="mt-4">
                <InputLabel for="marque" value="Marque" />
                <TextInput
                    id="marque"
                    v-model="form.marque"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="marque"
                />
            </div>

            <div class="mt-4">
                <InputLabel for="description" value="Description" />
                <TextInput
                    id="description"
                    v-model="form.description"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="description"
                />
            </div>

            <div class="mt-4">
                <InputLabel for="prix" value="Prix" />
                <TextInput
                    id="prix"
                    v-model="form.prix"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="prix"
                />
            </div>

            <div class="mt-4">
                <InputLabel for="stockage" value="Stockage" />
                <TextInput
                    id="stockage"
                    v-model="form.stockage"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="stockage"
                />
            </div>

                <div class="mt-4">
                <InputLabel for="region" value="Region" />
                <TextInput
                    id="region"
                    v-model="form.region"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="region"
                />
            </div>
                
            <div class="mt-4">
                <InputLabel for="ville" value="Ville" />
                <TextInput
                    id="ville"
                    v-model="form.ville"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="ville"
                />

                
            </div>

            <div class="mt-4">
                <InputLabel for="etat" value="Etat" />
                <TextInput
                    id="etat"
                    v-model="form.etat"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="etat"
                />

                
            </div>

            <div class="mt-4">
                <InputLabel for="livraison" value="Livraison" />
                <TextInput
                    id="livraison"
                    v-model="form.livraison"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="livraison"
                />

                <div class="mt-4">
                <InputLabel for="image" value="Image" />
                <TextInput
                    id="image"
                    type="file"
                    class="mt-1 block w-full"
                    required
                
                />

                
            </div>

                
            </div>

            <button type="submit">save</button>



           
        </form>
</template>

<script setup>
import {Head, Link, useForm } from '@inertiajs/vue3';
// import {Inertia } from "@inertiajs/inertia"

import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { reactive } from 'vue';

const form = reactive({
    nom: '',
marque: '',
decription: '',
prix: '', stockage: '', region: '', ville: '', etat: ''
, livraison: '', image: '',
   
});
let submit=() => {
    Inertia.post('telephone',form);
}
</script>
