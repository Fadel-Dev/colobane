<template>
    <SeoHead 
        title="Conditions d'utilisation - NoflayHub"
        description="Consultez les conditions d'utilisation de NoflayHub pour comprendre vos droits et obligations."
        keywords="conditions d'utilisation, termes, règles noflayhub"
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
                    Conditions d'utilisation
                </h1>
                <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                    Dernière mise à jour : {{ lastUpdate }}
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <main class="max-w-4xl mx-auto px-6 sm:px-8 lg:px-12 py-16">
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 prose prose-lg max-w-none">
                <h2>1. Acceptation des conditions</h2>
                <p>
                    En accédant et en utilisant NoflayHub, vous acceptez d'être lié par ces conditions d'utilisation. 
                    Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser notre plateforme.
                </p>

                <h2>2. Description du service</h2>
                <p>
                    NoflayHub est une plateforme en ligne qui permet aux utilisateurs de publier, rechercher et consulter 
                    des annonces de biens immobiliers et de véhicules à louer ou à vendre au Sénégal.
                </p>

                <h2>3. Inscription et compte utilisateur</h2>
                <p>
                    Pour utiliser certaines fonctionnalités de NoflayHub, vous devez créer un compte. Vous êtes responsable de :
                </p>
                <ul>
                    <li>Maintenir la confidentialité de vos identifiants de connexion</li>
                    <li>Toutes les activités qui se produisent sous votre compte</li>
                    <li>Fournir des informations exactes et à jour</li>
                </ul>

                <h2>4. Utilisation de la plateforme</h2>
                <p>Vous vous engagez à :</p>
                <ul>
                    <li>Utiliser la plateforme uniquement à des fins légales</li>
                    <li>Ne pas publier de contenu faux, trompeur ou frauduleux</li>
                    <li>Respecter les droits de propriété intellectuelle</li>
                    <li>Ne pas harceler, menacer ou nuire à d'autres utilisateurs</li>
                    <li>Ne pas utiliser la plateforme pour des activités commerciales non autorisées</li>
                </ul>

                <h2>5. Contenu des annonces</h2>
                <p>
                    Vous êtes seul responsable du contenu que vous publiez. Vous garantissez que :
                </p>
                <ul>
                    <li>Vous avez le droit de publier le contenu</li>
                    <li>Le contenu est exact et à jour</li>
                    <li>Le contenu ne viole aucune loi ou réglementation</li>
                    <li>Vous possédez ou avez l'autorisation d'utiliser toutes les images publiées</li>
                </ul>

                <h2>6. Propriété intellectuelle</h2>
                <p>
                    Tous les contenus de NoflayHub, y compris mais sans s'y limiter, les textes, graphiques, logos, 
                    icônes, images, clips audio et logiciels, sont la propriété de NoflayHub ou de ses fournisseurs 
                    de contenu et sont protégés par les lois sur le droit d'auteur.
                </p>

                <h2>7. Limitation de responsabilité</h2>
                <p>
                    NoflayHub agit en tant que plateforme de mise en relation. Nous ne sommes pas responsables :
                </p>
                <ul>
                    <li>De l'exactitude des informations fournies par les utilisateurs</li>
                    <li>Des transactions entre utilisateurs</li>
                    <li>Des dommages résultant de l'utilisation de la plateforme</li>
                    <li>Des interruptions ou erreurs techniques</li>
                </ul>

                <h2>8. Modifications des conditions</h2>
                <p>
                    Nous nous réservons le droit de modifier ces conditions à tout moment. Les modifications prendront 
                    effet dès leur publication sur la plateforme. Il est de votre responsabilité de consulter régulièrement 
                    ces conditions.
                </p>

                <h2>9. Résiliation</h2>
                <p>
                    Nous nous réservons le droit de suspendre ou de résilier votre compte à tout moment en cas de violation 
                    de ces conditions d'utilisation.
                </p>

                <h2>10. Droit applicable</h2>
                <p>
                    Ces conditions sont régies par les lois du Sénégal. Tout litige sera soumis à la juridiction exclusive 
                    des tribunaux de Dakar.
                </p>

                <h2>11. Contact</h2>
                <p>
                    Pour toute question concernant ces conditions d'utilisation, veuillez nous contacter à 
                    <a href="mailto:legal@noflayhub.com" class="text-principal hover:underline">legal@noflayhub.com</a>
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
</style>

