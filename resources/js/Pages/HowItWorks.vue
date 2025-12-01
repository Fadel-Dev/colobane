<template>
    <SeoHead 
        title="Comment ça marche - NoflayHub"
        description="Découvrez comment utiliser NoflayHub pour trouver ou publier des annonces de location et de vente."
        keywords="comment utiliser noflayhub, guide, tutoriel"
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
                    Comment ça marche
                </h1>
                <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                    Simple, rapide et efficace
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <main class="max-w-[95rem] mx-auto px-6 sm:px-8 lg:px-12 py-16">
            <!-- For Renters/Buyers -->
            <section class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-secondaire mb-4">Pour les locataires et acheteurs</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Trouvez votre logement ou véhicule idéal en quelques clics
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div 
                        v-for="(step, index) in renterSteps" 
                        :key="index"
                        class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow relative"
                    >
                        <div class="absolute -top-4 -left-4 w-12 h-12 bg-principal text-white rounded-full flex items-center justify-center font-bold text-xl">
                            {{ index + 1 }}
                        </div>
                        <div class="w-16 h-16 bg-principal/10 rounded-lg flex items-center justify-center mb-4 mt-4">
                            <i :class="[step.icon, 'text-principal text-2xl']"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondaire mb-3">{{ step.title }}</h3>
                        <p class="text-gray-600">{{ step.description }}</p>
                    </div>
                </div>
            </section>

            <!-- For Owners/Sellers -->
            <section class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-secondaire mb-4">Pour les propriétaires et vendeurs</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Publiez votre annonce et trouvez rapidement un locataire ou acheteur
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div 
                        v-for="(step, index) in ownerSteps" 
                        :key="index"
                        class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow relative"
                    >
                        <div class="absolute -top-4 -left-4 w-12 h-12 bg-secondaire text-white rounded-full flex items-center justify-center font-bold text-xl">
                            {{ index + 1 }}
                        </div>
                        <div class="w-16 h-16 bg-secondaire/10 rounded-lg flex items-center justify-center mb-4 mt-4">
                            <i :class="[step.icon, 'text-secondaire text-2xl']"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondaire mb-3">{{ step.title }}</h3>
                        <p class="text-gray-600">{{ step.description }}</p>
                    </div>
                </div>
            </section>

            <!-- Features -->
            <section class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-secondaire mb-4">Pourquoi choisir NoflayHub ?</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div 
                        v-for="feature in features" 
                        :key="feature.id"
                        class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-shadow"
                    >
                        <div class="w-20 h-20 bg-principal/10 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i :class="[feature.icon, 'text-principal text-3xl']"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondaire mb-3">{{ feature.title }}</h3>
                        <p class="text-gray-600">{{ feature.description }}</p>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="text-center">
                <div class="bg-gradient-to-r from-principal to-secondaire rounded-2xl shadow-xl p-12 text-white">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Prêt à commencer ?</h2>
                    <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                        Rejoignez des milliers d'utilisateurs qui font confiance à NoflayHub
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link href="/" class="px-8 py-4 bg-white text-principal font-semibold rounded-lg transition-all duration-300 hover:scale-105 hover:shadow-lg">
                            Commencer la recherche
                        </Link>
                        <Link href="/register" class="px-8 py-4 bg-white/10 border-2 border-white text-white font-semibold rounded-lg transition-all duration-300 hover:scale-105 hover:bg-white/20">
                            Créer un compte
                        </Link>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <Footer />
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '../Components/Navbar.vue';
import Footer from '../Components/Footer.vue';
import SeoHead from '../Components/SeoHead.vue';

const renterSteps = [
    {
        icon: 'fas fa-search',
        title: 'Recherchez',
        description: 'Utilisez nos filtres avancés pour trouver exactement ce que vous cherchez'
    },
    {
        icon: 'fas fa-eye',
        title: 'Consultez',
        description: 'Parcourez les annonces détaillées avec photos, descriptions et informations complètes'
    },
    {
        icon: 'fas fa-phone',
        title: 'Contactez',
        description: 'Contactez directement le propriétaire ou vendeur via nos outils de communication'
    },
    {
        icon: 'fas fa-handshake',
        title: 'Finalisez',
        description: 'Concluez votre transaction en toute sécurité et simplicité'
    },
];

const ownerSteps = [
    {
        icon: 'fas fa-user-plus',
        title: 'Créez un compte',
        description: 'Inscrivez-vous gratuitement en quelques minutes'
    },
    {
        icon: 'fas fa-edit',
        title: 'Publiez votre annonce',
        description: 'Remplissez le formulaire avec tous les détails de votre bien ou véhicule'
    },
    {
        icon: 'fas fa-images',
        title: 'Ajoutez des photos',
        description: 'Téléchargez des photos de qualité pour attirer plus d\'attention'
    },
    {
        icon: 'fas fa-bullhorn',
        title: 'Recevez des contacts',
        description: 'Les intéressés vous contactent directement via la plateforme'
    },
];

const features = [
    {
        id: 1,
        icon: 'fas fa-shield-alt',
        title: 'Sécurisé',
        description: 'Plateforme sécurisée avec vérification des annonces'
    },
    {
        id: 2,
        icon: 'fas fa-bolt',
        title: 'Rapide',
        description: 'Recherche et publication en quelques clics'
    },
    {
        id: 3,
        icon: 'fas fa-users',
        title: 'Communauté',
        description: 'Rejoignez une communauté active de milliers d\'utilisateurs'
    },
];
</script>

