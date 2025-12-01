<template>
    <SeoHead 
        title="Nous contacter - NoflayHub"
        description="Contactez l'équipe NoflayHub pour toute question, assistance ou suggestion. Nous sommes là pour vous aider."
        keywords="contact noflayhub, support noflayhub, assistance client"
    />
    
    <Navbar />
    
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-r from-principal via-principal/90 to-secondaire text-white py-20 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
            </div>
            <div class="relative z-10 max-w-[95rem] mx-auto px-6 sm:px-8 lg:px-12 text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                    Contactez-nous
                </h1>
                <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                    Nous sommes là pour répondre à toutes vos questions
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <main class="max-w-[95rem] mx-auto px-6 sm:px-8 lg:px-12 py-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                    <h2 class="text-2xl font-bold text-secondaire mb-6">Envoyez-nous un message</h2>
                    <form @submit.prevent="submitForm" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nom complet <span class="text-principal">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name"
                                v-model="form.name"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-principal focus:border-transparent transition-all"
                                placeholder="Votre nom"
                            >
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email <span class="text-principal">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email"
                                v-model="form.email"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-principal focus:border-transparent transition-all"
                                placeholder="votre@email.com"
                            >
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                Téléphone
                            </label>
                            <input 
                                type="tel" 
                                id="phone"
                                v-model="form.phone"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-principal focus:border-transparent transition-all"
                                placeholder="+221 77 123 45 67"
                            >
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                                Sujet <span class="text-principal">*</span>
                            </label>
                            <select 
                                id="subject"
                                v-model="form.subject"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-principal focus:border-transparent transition-all"
                            >
                                <option value="">Sélectionnez un sujet</option>
                                <option value="question">Question générale</option>
                                <option value="support">Support technique</option>
                                <option value="annonce">Question sur une annonce</option>
                                <option value="partnership">Partenariat</option>
                                <option value="other">Autre</option>
                            </select>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                Message <span class="text-principal">*</span>
                            </label>
                            <textarea 
                                id="message"
                                v-model="form.message"
                                required
                                rows="6"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-principal focus:border-transparent transition-all resize-none"
                                placeholder="Votre message..."
                            ></textarea>
                        </div>
                        <button 
                            type="submit"
                            :disabled="isSubmitting"
                            class="w-full px-6 py-4 bg-principal hover:bg-principal/90 text-white font-semibold rounded-lg transition-all duration-300 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span v-if="!isSubmitting" class="flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Envoyer le message
                            </span>
                            <span v-else class="flex items-center justify-center">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Envoi en cours...
                            </span>
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="space-y-6">
                    <!-- Contact Details -->
                    <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                        <h2 class="text-2xl font-bold text-secondaire mb-6">Informations de contact</h2>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-principal/10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-principal text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Adresse</h3>
                                    <p class="text-gray-600">
                                        Keur Mbaye Fall, Pikine<br>
                                        Dakar, Sénégal
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-principal/10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-phone text-principal text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Téléphone</h3>
                                    <a href="tel:+221771234567" class="text-principal hover:text-principal/80 transition-colors">
                                        +221 77 123 45 67
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-principal/10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-envelope text-principal text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                                    <a href="mailto:contact@noflayhub.com" class="text-principal hover:text-principal/80 transition-colors">
                                        contact@noflayhub.com
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-12 h-12 bg-principal/10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-clock text-principal text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Heures d'ouverture</h3>
                                    <p class="text-gray-600">
                                        Lundi - Vendredi : 9h00 - 18h00<br>
                                        Samedi : 9h00 - 13h00<br>
                                        Dimanche : Fermé
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                        <h2 class="text-2xl font-bold text-secondaire mb-6">Suivez-nous</h2>
                        <div class="flex space-x-4">
                            <a href="https://facebook.com/noflayhub" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-principal/10 hover:bg-principal rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110">
                                <i class="fab fa-facebook-f text-principal hover:text-white"></i>
                            </a>
                            <a href="https://twitter.com/noflayhub" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-principal/10 hover:bg-principal rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110">
                                <i class="fab fa-twitter text-principal hover:text-white"></i>
                            </a>
                            <a href="https://instagram.com/noflayhub" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-principal/10 hover:bg-principal rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110">
                                <i class="fab fa-instagram text-principal hover:text-white"></i>
                            </a>
                            <a href="https://linkedin.com/company/noflayhub" target="_blank" rel="noopener noreferrer" class="w-12 h-12 bg-principal/10 hover:bg-principal rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110">
                                <i class="fab fa-linkedin-in text-principal hover:text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <Footer />
    
    <!-- Toast Notification -->
    <Toast 
        :show="showToast" 
        :message="toastMessage" 
        :type="toastType"
    />
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import Navbar from '../Components/Navbar.vue';
import Footer from '../Components/Footer.vue';
import SeoHead from '../Components/SeoHead.vue';
import Toast from '../Components/Toast.vue';

const page = usePage();

const form = ref({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: ''
});

const isSubmitting = ref(false);
const showToast = ref(false);
const toastMessage = ref('');
const toastType = ref('success');

const submitForm = async () => {
    isSubmitting.value = true;
    
    router.post('/contact', form.value, {
        preserveScroll: true,
        onSuccess: () => {
            showToast.value = true;
            toastMessage.value = 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.';
            toastType.value = 'success';
            
            // Réinitialiser le formulaire
            form.value = {
                name: '',
                email: '',
                phone: '',
                subject: '',
                message: ''
            };
            
            isSubmitting.value = false;
            
            // Masquer le toast après 5 secondes
            setTimeout(() => {
                showToast.value = false;
            }, 5000);
        },
        onError: (errors) => {
            showToast.value = true;
            toastMessage.value = 'Une erreur est survenue. Veuillez vérifier vos informations et réessayer.';
            toastType.value = 'error';
            isSubmitting.value = false;
            
            setTimeout(() => {
                showToast.value = false;
            }, 5000);
        }
    });
};

onMounted(() => {
    // Afficher le message de succès s'il existe
    if (page.props.flash?.success) {
        showToast.value = true;
        toastMessage.value = page.props.flash.success;
        toastType.value = 'success';
        setTimeout(() => {
            showToast.value = false;
        }, 5000);
    }
});
</script>
