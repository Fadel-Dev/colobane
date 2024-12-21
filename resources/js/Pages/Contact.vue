<template>

    <Navbar />


    <div class="flex flex-col items-center justify-center h-screen bg-gray-100" id="myMain">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Vendre? Contactez-nous!</h1>
        <h2 class="">
            Bienvenu chez NoflayHub votre espace de vent,<br> Vous voules vendre rien de compliquer <br> contactez-nous
            via
            Whatsapp,<br> Nous sommes heureux de vous recevor dans notre plateforme.
        </h2>
        <a :href="whatsappLink" target="_blank"
            class="flex items-center px-6 py-3 text-white bg-green-500 rounded-lg shadow-lg hover:bg-green-600 transition">
            <i class="fab fa-whatsapp text-2xl mr-2"></i>
            <span>Contactez-nous sur WhatsApp</span>
        </a>
    </div>
</template>

<style>
#myMain {
    width: 70%;
    height: 70vh;
    margin-left: auto;
    margin-right: auto;
    box-shadow: 20px 40px 100px 120px #eb2d53;
    border-radius: 40px;
}
</style>

<script setup>
import Navbar from '../Components/Navbar.vue';

</script>

<script>

export default {

    data() {
        return {
            phoneNumber: "221775276864", // Remplacez par votre numéro WhatsApp avec indicatif
            message: "Bonjour, je souhaite vendre via votre plateforme.",
        };
    },
    computed: {
        whatsappLink() {
            return `https://wa.me/${this.phoneNumber}?text=${encodeURIComponent(this.message)}`;
        },
    },
};
</script>

<style scoped>
@import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css";
</style>
