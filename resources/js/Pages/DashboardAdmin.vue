<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps, reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    immobiliers: Array,
    voitures:Array,
});

const data = reactive({
    activeTab: 'dashboard',
    showMenu: false,
    popupVisible: false,
});

const showPopup = () => {
    data.popupVisible = true;
};

const confirmAction = () => {
    data.popupVisible = false;
    // Add logic to perform action
};

const cancelAction = () => {
    data.popupVisible = false;
};

// Example navigate methods
const navigateUpdateVenduVehicule = (id) => {
    Inertia.visit(`/update/navigateUpdateVenduVehicule/${id}`);
};

const navigateUpdateVenduImmobilier = (id) => {
    Inertia.visit(`/update/navigateUpdateVenduImmobilier/${id}`);
};
</script>

<style>
.custom-grid {
    display: grid;
    grid-template-rows: 20% 80%;
}
.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}
.popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
}
</style>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div>
            <div class="left-0 px-5 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform"></div>
        </div>
        <div class="custom-grid">
            <!-- All Articles -->
            <div class="flex flex-wrap justify-center mt-20 text-gray-800">
                <div v-for="immobilier in immobiliers" :key="immobilier.id" @click="navigateToDetail(immobilier.id)" class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-2">
                    <div class="bg-secondaire rounded-2xl shadow-2xl relative mt-4">
                        <div class="w-full h-full">
                            <img :src="'/storage/' + immobilier.image1" :alt="immobilier.imageAlt" class="w-full h-full object-fill rounded-2xl shadow-lg">
                        </div>
                        <img class="mb-3 w-[4rem] h-[4rem] rounded-full shadow-2xl absolute bottom-1/3 right-0" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Profile image">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-white">{{ immobilier.nom }}</h3>
                            <p class="text-gray-300">{{ immobilier.affaire }}</p>
                            <p class="text-principal text-lg">{{ immobilier.prix }}<span class="text-principal text-opacity-60"> Fcfa</span></p>
                            <div class="flex items-center space-x-4 justify-between">
                                <div class="flex flex-row space-x-1">
                                    <!-- Placeholder for buttons if needed -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ---------------------------------------------------------------------------------------------------------- -->
        <div class="custom-grid">

            <div class="flex flex-wrap justify-center mt-20 text-gray-800">
                <div v-for="voiture in voitures" :key="voiture.id" @click="navigateToDetailVoiture(voiture.id)" class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 p-2">
                    <div class="bg-secondaire rounded-2xl shadow-2xl relative mt-4">
                        <div class="w-full h-full">
                            <img :src="'/storage/' + voiture.image1" :alt="voiture.imageAlt" class="w-full h-full object-fill rounded-2xl shadow-lg">
                        </div>
                        <img class="mb-3 w-[4rem] h-[4rem] rounded-full shadow-2xl absolute bottom-1/3 right-0" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="Profile image">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-white">{{ voiture.nom }}</h3>
                            <p class="text-gray-300">{{ voiture.affaire }}</p>
                            <p class="text-principal text-lg">{{ voiture.prix }}<span class="text-principal text-opacity-60"> Fcfa</span></p>
                            <div class="flex items-center space-x-4 justify-between">
                                <div class="flex flex-row space-x-1">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popup -->
        <div v-if="data.popupVisible" class="popup">
            <div class="popup-content">
                <p>Are you sure?</p>
                <button @click="confirmAction">Yes</button>
                <button @click="cancelAction">No</button>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import {Head} from '@inertiajs/vue3'

export default {
  data() {
    return {
      sections: [
        { id: 1, titre:"Mes rendez-vous" },
      ],
    }
  },

  methods: {
    navigateToDetail(id) {
      this.$inertia.visit(`/statusImmobilier/${id}`);
    },

    navigateToDetailVoiture(id) {
      this.$inertia.visit(`/statusVehicule/${id}`);
    }
  },}
</script>
