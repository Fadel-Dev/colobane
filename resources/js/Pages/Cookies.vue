<template>
    <SeoHead 
        title="Politique de cookies - NoflayHub"
        description="Découvrez comment NoflayHub utilise les cookies et technologies similaires."
        keywords="politique de cookies, cookies noflayhub, gestion des cookies"
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
                    Politique de cookies
                </h1>
                <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                    Dernière mise à jour : {{ lastUpdate }}
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <main class="max-w-4xl mx-auto px-6 sm:px-8 lg:px-12 py-16">
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 prose prose-lg max-w-none">
                <h2>1. Qu'est-ce qu'un cookie ?</h2>
                <p>
                    Un cookie est un petit fichier texte stocké sur votre appareil (ordinateur, tablette, smartphone) 
                    lorsque vous visitez un site web. Les cookies permettent au site de mémoriser vos préférences et 
                    d'améliorer votre expérience de navigation.
                </p>

                <h2>2. Comment utilisons-nous les cookies ?</h2>
                <p>NoflayHub utilise les cookies pour :</p>
                <ul>
                    <li>Mémoriser vos préférences et paramètres</li>
                    <li>Maintenir votre session de connexion</li>
                    <li>Améliorer la performance et la fonctionnalité du site</li>
                    <li>Analyser l'utilisation du site pour l'améliorer</li>
                    <li>Personnaliser votre expérience</li>
                </ul>

                <h2>3. Types de cookies que nous utilisons</h2>
                
                <h3>3.1. Cookies essentiels</h3>
                <p>
                    Ces cookies sont nécessaires au fonctionnement du site. Ils permettent notamment de maintenir 
                    votre session de connexion et de sécuriser votre navigation.
                </p>
                <ul>
                    <li><strong>Cookies de session :</strong> Maintiennent votre connexion active</li>
                    <li><strong>Cookies de sécurité :</strong> Protègent contre les attaques et fraudes</li>
                </ul>

                <h3>3.2. Cookies de fonctionnalité</h3>
                <p>
                    Ces cookies permettent au site de se souvenir de vos choix (langue, région, préférences) 
                    pour offrir une expérience personnalisée.
                </p>

                <h3>3.3. Cookies analytiques</h3>
                <p>
                    Ces cookies nous aident à comprendre comment les visiteurs utilisent notre site en collectant 
                    des informations de manière anonyme. Cela nous permet d'améliorer continuellement la plateforme.
                </p>

                <h3>3.4. Cookies de publicité</h3>
                <p>
                    Ces cookies sont utilisés pour afficher des publicités pertinentes et mesurer l'efficacité 
                    de nos campagnes publicitaires.
                </p>

                <h2>4. Cookies tiers</h2>
                <p>
                    Certains cookies sont placés par des services tiers que nous utilisons, notamment :
                </p>
                <ul>
                    <li><strong>Google Analytics :</strong> Pour analyser l'utilisation du site</li>
                    <li><strong>Réseaux sociaux :</strong> Pour les fonctionnalités de partage</li>
                    <li><strong>Services de paiement :</strong> Pour sécuriser les transactions</li>
                </ul>

                <h2>5. Gestion des cookies</h2>
                <p>
                    Vous pouvez contrôler et gérer les cookies de plusieurs façons :
                </p>
                <ul>
                    <li><strong>Paramètres du navigateur :</strong> La plupart des navigateurs vous permettent de refuser ou d'accepter les cookies</li>
                    <li><strong>Suppression :</strong> Vous pouvez supprimer les cookies déjà stockés sur votre appareil</li>
                    <li><strong>Notification :</strong> Vous pouvez configurer votre navigateur pour être averti lorsque des cookies sont utilisés</li>
                </ul>

                <h3>Comment gérer les cookies dans votre navigateur :</h3>
                <ul>
                    <li><strong>Chrome :</strong> Paramètres > Confidentialité et sécurité > Cookies</li>
                    <li><strong>Firefox :</strong> Options > Vie privée et sécurité > Cookies</li>
                    <li><strong>Safari :</strong> Préférences > Confidentialité > Cookies</li>
                    <li><strong>Edge :</strong> Paramètres > Confidentialité > Cookies</li>
                </ul>

                <h2>6. Conséquences de la désactivation des cookies</h2>
                <p>
                    Si vous choisissez de désactiver les cookies, certaines fonctionnalités du site peuvent ne pas 
                    fonctionner correctement :
                </p>
                <ul>
                    <li>Vous devrez vous reconnecter à chaque visite</li>
                    <li>Vos préférences ne seront pas mémorisées</li>
                    <li>Certaines fonctionnalités peuvent être indisponibles</li>
                </ul>

                <h2>7. Cookies et appareils mobiles</h2>
                <p>
                    Sur les appareils mobiles, vous pouvez gérer les cookies via les paramètres de votre navigateur 
                    mobile ou les paramètres de l'application.
                </p>

                <h2>8. Modifications de cette politique</h2>
                <p>
                    Nous pouvons modifier cette politique de cookies à tout moment. Les modifications seront publiées 
                    sur cette page avec une date de mise à jour révisée.
                </p>

                <h2>9. Contact</h2>
                <p>
                    Pour toute question concernant notre utilisation des cookies, contactez-nous à 
                    <a href="mailto:privacy@noflayhub.com" class="text-principal hover:underline">privacy@noflayhub.com</a>
                </p>
            </div>
        </main>
    </div>

    <Footer />
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import Navbar from '../Components/Navbar.vue';
import Footer from '../Components/Footer.vue';
import SeoHead from '../Components/SeoHead.vue';

const lastUpdate = 'Janvier 2024';
</script>

<style scoped>
.prose h2 {
    @apply text-2xl font-bold text-secondaire mt-8 mb-4;
}

.prose h2:first-child {
    @apply mt-0;
}

.prose h3 {
    @apply text-xl font-semibold text-secondaire mt-6 mb-3;
}

.prose p {
    @apply text-gray-700 leading-relaxed mb-4;
}

.prose ul {
    @apply list-disc list-inside mb-4 space-y-2;
}

.prose li {
    @apply text-gray-700;
}

.prose a {
    @apply text-principal hover:underline;
}

.prose strong {
    @apply font-semibold text-secondaire;
}
</style>

