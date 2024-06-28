<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router  } from '@inertiajs/vue3';
import Footer from '../Components/Footer.vue';
import { Inertia } from '@inertiajs/inertia';



const  props = defineProps({
car:Object,
    maison:Object,
        vehicules:Object,
        habitats:Object,
     results:Object,
     total:Object,
     totalImmobilier:Object,
     totalVehicule:Object,
    //  ARTICLE VENDUS
    totalImmobilierVendu:Object,
    totalVehiculeVendu:Object,
    resultsVendu:Object,
    totalVendu:Object,
    // ARTICLE Actuel

    totalImmobilierActuel:Object,
    totalVehiculeActuel:Object,
    resultsActuel:Object,
    totalActuel:Object,

    //total articles vendus price

    totalVenduSomme:Object,
    sommeHabitatVendu:Object,
    sommeVehiculeVendu:Object,
    });
</script>

<style>
  .custom-grid {
    display: grid;
    grid-template-rows: 20% 80%; /* First column 10%, second column 90% */
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
      
        <div class=" w-[80%] mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">En savoir plus</h1>
    
        <section class="mb-8">
          <h2 class="text-2xl font-semibold mb-4">Comment ouvrir une boutique sur notre application ?</h2>
          <p class="mb-4">Ouvrir une boutique sur notre application est simple et rapide. Suivez les étapes ci-dessous :</p>
          <ol class="list-decimal list-inside space-y-2">
            <li>Inscrivez-vous ou connectez-vous à votre compte.</li>
            <li>Accédez à la section "Créer une boutique" dans votre tableau de bord.</li>
            <li>Remplissez les informations nécessaires sur votre boutique, comme le nom, la description et le logo.</li>
            <li>Soumettez votre demande et attendez l'approbation.</li>
            <li>Une fois approuvé, commencez à ajouter des produits à votre boutique.</li>
          </ol>
        </section>
    
        <section class="mb-8">
          <h2 class="text-2xl font-semibold mb-4">Comment booster un article ?</h2>
          <p class="mb-4">Booster un article vous permet de le mettre en avant et d'atteindre plus de clients potentiels. Voici comment faire :</p>
          <ol class="list-decimal list-inside space-y-2">
            <li>Accédez à votre tableau de bord et sélectionnez l'article que vous souhaitez booster.</li>
            <li>Cliquez sur l'option "Booster" à côté de l'article.</li>
            <li>Choisissez la durée et le montant du boost.</li>
            <li>Confirmez et effectuez le paiement.</li>
            <li>Votre article sera mis en avant immédiatement après la confirmation.</li>
          </ol>
        </section>
      </div>
 


    </AppLayout>



</template>
<script>
import {InertiaProgress} from '@inertiajs/progress';
import {Head} from '@inertiajs/vue3'

export default {

    data () {
        return {
          activeTab: 'dashboard',
        showMenu: false,
        popupVisible: false

        }
    },
    methods: {
        showPopup() {
      this.popupVisible = true;
    },
    confirmAction() {
      // Logique à exécuter lorsque "oui" est cliqué
      this.popupVisible = false;
      // Ajoutez ici le code pour effectuer l'action
    },
    cancelAction() {
      // Logique à exécuter lorsque "non" est cliqué
      this.popupVisible = false;
    },
        navigateUpdateImmobilier(id)
        {
            this.$inertia.visit(`/update/immobilier/${id}`);
        },

        navigateUpdateVehicule(id)
        {
            this.$inertia.visit(`/update/vehicule/${id}`);
        },
        navigateToBoostImmobillier(id)
        {
            this.$inertia.visit(`/boost/immo/${id}`);
        },
        navigateToBoostVehicule(id)
        {
            this.$inertia.visit(`/boost/vehi/${id}`);
        },
        navigateUpdateVenduImmobilier(id)
        {
            this.$inertia.visit(`/update/navigateUpdateVenduImmobilier/${id}`);
        },
        navigateUpdateVenduVehicule(id)
        {
            this.$inertia.visit(`/update/navigateUpdateVenduVehicule/${id}`);
        },
    }
}

    </script>


