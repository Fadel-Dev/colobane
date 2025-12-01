<template>
    <SeoHead 
        title="À propos de nous - NoflayHub"
        description="Découvrez NoflayHub, votre plateforme de référence pour la location et la vente de biens immobiliers et de véhicules au Sénégal."
        keywords="à propos noflayhub, qui sommes nous, plateforme immobilière Sénégal"
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
                    À propos de NoflayHub
                </h1>
                <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                    Votre plateforme de confiance pour trouver votre logement ou véhicule idéal au Sénégal
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <main class="max-w-[95rem] mx-auto px-6 sm:px-8 lg:px-12 py-16">
            <!-- Mission Section -->
            <section class="mb-16">
                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-principal/10 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-bullseye text-principal text-2xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-secondaire">Notre Mission</h2>
                    </div>
                    <p class="text-lg text-gray-700 leading-relaxed mb-4">
                        Chez NoflayHub, nous croyons que trouver un logement ou un véhicule ne devrait pas être un parcours du combattant. Notre mission est de simplifier le processus de recherche en mettant à votre disposition une plateforme intuitive, sécurisée et complète.
                    </p>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Nous connectons les propriétaires et les locataires, les vendeurs et les acheteurs, en créant un écosystème où chacun peut trouver ce qu'il cherche rapidement et en toute confiance.
                    </p>
                </div>
            </section>

            <!-- Vision Section -->
            <section class="mb-16">
                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-secondaire/10 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-eye text-secondaire text-2xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-secondaire">Notre Vision</h2>
                    </div>
                    <p class="text-lg text-gray-700 leading-relaxed mb-4">
                        Devenir la plateforme de référence au Sénégal et en Afrique de l'Ouest pour toutes les transactions immobilières et automobiles. Nous aspirons à transformer la façon dont les gens recherchent, trouvent et louent des biens.
                    </p>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Notre vision inclut l'expansion de nos services à d'autres pays africains, tout en maintenant notre engagement envers la qualité, la transparence et l'excellence du service client.
                    </p>
                </div>
            </section>

            <!-- Values Section -->
            <section class="mb-16">
                <h2 class="text-3xl font-bold text-secondaire text-center mb-12">Nos Valeurs</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-principal/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-shield-alt text-principal text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondaire mb-3">Confiance</h3>
                        <p class="text-gray-600">Nous construisons des relations basées sur la transparence et l'intégrité.</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-principal/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-users text-principal text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondaire mb-3">Service Client</h3>
                        <p class="text-gray-600">Votre satisfaction est notre priorité absolue.</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-principal/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-lightbulb text-principal text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondaire mb-3">Innovation</h3>
                        <p class="text-gray-600">Nous innovons constamment pour améliorer votre expérience.</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-principal/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-check-circle text-principal text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondaire mb-3">Qualité</h3>
                        <p class="text-gray-600">Nous maintenons les plus hauts standards de qualité.</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-principal/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-heart text-principal text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondaire mb-3">Engagement</h3>
                        <p class="text-gray-600">Nous nous engageons envers notre communauté et notre pays.</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-principal/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-globe text-principal text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-secondaire mb-3">Accessibilité</h3>
                        <p class="text-gray-600">Nous rendons la recherche accessible à tous.</p>
                    </div>
                </div>
            </section>

            <!-- Stats Section -->
            <section class="mb-16">
                <div class="bg-gradient-to-r from-principal to-secondaire rounded-2xl shadow-xl p-8 md:p-12 text-white">
                    <h2 class="text-3xl font-bold text-center mb-12">NoflayHub en Chiffres</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div class="text-center">
                            <div class="text-4xl md:text-5xl font-bold mb-2">1000+</div>
                            <div class="text-white/90">Annonces actives</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl md:text-5xl font-bold mb-2">5000+</div>
                            <div class="text-white/90">Utilisateurs</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl md:text-5xl font-bold mb-2">15+</div>
                            <div class="text-white/90">Régions couvertes</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl md:text-5xl font-bold mb-2">24/7</div>
                            <div class="text-white/90">Support disponible</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Team Section -->
            <section class="mb-16">
                <h2 class="text-3xl font-bold text-secondaire text-center mb-12">Notre Équipe</h2>
                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        Notre équipe est composée de professionnels passionnés et dévoués qui travaillent sans relâche pour améliorer votre expérience sur NoflayHub. Nous combinons expertise technique, connaissance du marché local et engagement envers l'excellence.
                    </p>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Que vous soyez à la recherche d'un logement, d'un véhicule, ou que vous souhaitiez publier une annonce, notre équipe est là pour vous accompagner à chaque étape.
                    </p>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="text-center">
                <div class="bg-gradient-to-r from-principal/10 to-secondaire/10 rounded-2xl p-8 md:p-12">
                    <h2 class="text-3xl font-bold text-secondaire mb-4">Rejoignez-nous aujourd'hui</h2>
                    <p class="text-lg text-gray-700 mb-8 max-w-2xl mx-auto">
                        Commencez votre recherche ou publiez votre première annonce dès maintenant
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link href="/" class="px-8 py-4 bg-principal hover:bg-principal/90 text-white font-semibold rounded-lg transition-all duration-300 hover:scale-105">
                            Commencer la recherche
                        </Link>
                        <Link href="/contact" class="px-8 py-4 bg-white border-2 border-principal text-principal hover:bg-principal hover:text-white font-semibold rounded-lg transition-all duration-300 hover:scale-105">
                            Nous contacter
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
</script>

