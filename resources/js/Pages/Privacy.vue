<template>
    <SeoHead 
        title="Politique de confidentialité - NoflayHub"
        description="Découvrez comment NoflayHub collecte, utilise et protège vos données personnelles."
        keywords="politique de confidentialité, protection des données, vie privée noflayhub"
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
                    Politique de confidentialité
                </h1>
                <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                    Dernière mise à jour : {{ lastUpdate }}
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <main class="max-w-4xl mx-auto px-6 sm:px-8 lg:px-12 py-16">
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 prose prose-lg max-w-none">
                <h2>1. Introduction</h2>
                <p>
                    NoflayHub s'engage à protéger votre vie privée. Cette politique de confidentialité explique comment 
                    nous collectons, utilisons, stockons et protégeons vos informations personnelles.
                </p>

                <h2>2. Informations que nous collectons</h2>
                <h3>2.1. Informations que vous nous fournissez</h3>
                <ul>
                    <li>Nom, prénom et coordonnées (email, téléphone, adresse)</li>
                    <li>Informations de compte (nom d'utilisateur, mot de passe)</li>
                    <li>Contenu des annonces que vous publiez</li>
                    <li>Messages et communications avec d'autres utilisateurs</li>
                </ul>

                <h3>2.2. Informations collectées automatiquement</h3>
                <ul>
                    <li>Adresse IP et données de connexion</li>
                    <li>Type de navigateur et appareil utilisé</li>
                    <li>Pages visitées et temps passé sur le site</li>
                    <li>Cookies et technologies similaires</li>
                </ul>

                <h2>3. Utilisation des informations</h2>
                <p>Nous utilisons vos informations pour :</p>
                <ul>
                    <li>Fournir et améliorer nos services</li>
                    <li>Traiter vos transactions et gérer votre compte</li>
                    <li>Vous contacter concernant votre compte ou nos services</li>
                    <li>Personnaliser votre expérience utilisateur</li>
                    <li>Détecter et prévenir la fraude et les abus</li>
                    <li>Respecter nos obligations légales</li>
                </ul>

                <h2>4. Partage des informations</h2>
                <p>Nous ne vendons jamais vos informations personnelles. Nous pouvons partager vos informations avec :</p>
                <ul>
                    <li><strong>Autres utilisateurs :</strong> Les informations de votre annonce sont visibles par tous les utilisateurs</li>
                    <li><strong>Prestataires de services :</strong> Pour nous aider à exploiter la plateforme (hébergement, paiement, etc.)</li>
                    <li><strong>Autorités légales :</strong> Si requis par la loi ou pour protéger nos droits</li>
                </ul>

                <h2>5. Sécurité des données</h2>
                <p>
                    Nous mettons en œuvre des mesures de sécurité techniques et organisationnelles appropriées pour 
                    protéger vos informations contre l'accès non autorisé, la perte, la destruction ou l'altération.
                </p>

                <h2>6. Vos droits</h2>
                <p>Conformément à la réglementation en vigueur, vous avez le droit de :</p>
                <ul>
                    <li>Accéder à vos données personnelles</li>
                    <li>Rectifier vos données inexactes</li>
                    <li>Demander la suppression de vos données</li>
                    <li>Vous opposer au traitement de vos données</li>
                    <li>Demander la portabilité de vos données</li>
                    <li>Retirer votre consentement à tout moment</li>
                </ul>

                <h2>7. Cookies</h2>
                <p>
                    Nous utilisons des cookies pour améliorer votre expérience. Pour plus d'informations, consultez notre 
                    <Link href="/cookies" class="text-principal hover:underline">Politique de cookies</Link>.
                </p>

                <h2>8. Conservation des données</h2>
                <p>
                    Nous conservons vos données personnelles aussi longtemps que nécessaire pour fournir nos services 
                    et respecter nos obligations légales. Vous pouvez demander la suppression de votre compte à tout moment.
                </p>

                <h2>9. Modifications de cette politique</h2>
                <p>
                    Nous pouvons modifier cette politique de confidentialité à tout moment. Les modifications seront 
                    publiées sur cette page avec une date de mise à jour révisée.
                </p>

                <h2>10. Contact</h2>
                <p>
                    Pour toute question concernant cette politique de confidentialité ou pour exercer vos droits, 
                    contactez-nous à <a href="mailto:privacy@noflayhub.com" class="text-principal hover:underline">privacy@noflayhub.com</a>
                </p>
            </div>
        </main>
    </div>

    <Footer />
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
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

