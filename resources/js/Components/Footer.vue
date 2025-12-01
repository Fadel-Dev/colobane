<template>
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-principal rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondaire rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="relative z-10 max-w-[95rem] mx-auto px-6 sm:px-8 lg:px-12 py-16">
            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Logo and Description -->
                <div class="lg:col-span-1">
                    <Link href="/" class="inline-block mb-6">
                        <img 
                            :src="'/storage/slide/NoflayHub.png'" 
                            alt="NoflayHub Logo" 
                            class="h-12 w-auto bg-white p-2 rounded-lg"
                            loading="lazy"
                        >
                    </Link>
                    <p class="text-gray-300 text-sm leading-relaxed mb-6 max-w-xs">
                        Votre plateforme de référence pour la location et la vente de biens immobiliers et de véhicules au Sénégal. Trouvez votre logement ou véhicule idéal en quelques clics.
                    </p>
                    
                    <!-- Social Media Links -->
                    <div class="flex items-center space-x-4">
                        <a 
                            href="https://facebook.com/noflayhub" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="w-10 h-10 bg-white/10 hover:bg-principal rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 group"
                            aria-label="Facebook"
                        >
                            <i class="fab fa-facebook-f text-white group-hover:text-white text-sm"></i>
                        </a>
                        <a 
                            href="https://twitter.com/noflayhub" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="w-10 h-10 bg-white/10 hover:bg-principal rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 group"
                            aria-label="Twitter"
                        >
                            <i class="fab fa-twitter text-white group-hover:text-white text-sm"></i>
                        </a>
                        <a 
                            href="https://instagram.com/noflayhub" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="w-10 h-10 bg-white/10 hover:bg-principal rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 group"
                            aria-label="Instagram"
                        >
                            <i class="fab fa-instagram text-white group-hover:text-white text-sm"></i>
                        </a>
                        <a 
                            href="https://linkedin.com/company/noflayhub" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="w-10 h-10 bg-white/10 hover:bg-principal rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 group"
                            aria-label="LinkedIn"
                        >
                            <i class="fab fa-linkedin-in text-white group-hover:text-white text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Immobilier Links -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-home text-principal mr-2"></i>
                        Immobilier
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <Link href="/categorie/villa" class="text-gray-300 hover:text-principal transition-colors duration-200 flex items-center group text-sm">
                                <i class="fas fa-chevron-right text-xs mr-2 text-gray-500 group-hover:text-principal group-hover:translate-x-1 transition-transform"></i>
                                Villas à louer
                            </Link>
                        </li>
                        <li>
                            <Link href="/categorie/appartements" class="text-gray-300 hover:text-principal transition-colors duration-200 flex items-center group text-sm">
                                <i class="fas fa-chevron-right text-xs mr-2 text-gray-500 group-hover:text-principal group-hover:translate-x-1 transition-transform"></i>
                                Appartements à louer
                            </Link>
                        </li>
                        <li>
                            <Link href="/categorie/chambre" class="text-gray-300 hover:text-principal transition-colors duration-200 flex items-center group text-sm">
                                <i class="fas fa-chevron-right text-xs mr-2 text-gray-500 group-hover:text-principal group-hover:translate-x-1 transition-transform"></i>
                                Chambres à louer
                            </Link>
                        </li>
                        <li>
                            <Link href="/categorie/studio" class="text-gray-300 hover:text-principal transition-colors duration-200 flex items-center group text-sm">
                                <i class="fas fa-chevron-right text-xs mr-2 text-gray-500 group-hover:text-principal group-hover:translate-x-1 transition-transform"></i>
                                Studios à louer
                            </Link>
                        </li>
                        <li>
                            <Link href="/categorie/terrain" class="text-gray-300 hover:text-principal transition-colors duration-200 flex items-center group text-sm">
                                <i class="fas fa-chevron-right text-xs mr-2 text-gray-500 group-hover:text-principal group-hover:translate-x-1 transition-transform"></i>
                                Terrains à louer
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Entreprise & Support -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-info-circle text-principal mr-2"></i>
                        Informations
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <Link href="/about" class="text-gray-300 hover:text-principal transition-colors duration-200 flex items-center group text-sm">
                                <i class="fas fa-chevron-right text-xs mr-2 text-gray-500 group-hover:text-principal group-hover:translate-x-1 transition-transform"></i>
                                À propos de nous
                            </Link>
                        </li>
                        <li>
                            <Link href="/contact" class="text-gray-300 hover:text-principal transition-colors duration-200 flex items-center group text-sm">
                                <i class="fas fa-chevron-right text-xs mr-2 text-gray-500 group-hover:text-principal group-hover:translate-x-1 transition-transform"></i>
                                Nous contacter
                            </Link>
                        </li>
                        <li>
                            <Link href="/aide" class="text-gray-300 hover:text-principal transition-colors duration-200 flex items-center group text-sm">
                                <i class="fas fa-chevron-right text-xs mr-2 text-gray-500 group-hover:text-principal group-hover:translate-x-1 transition-transform"></i>
                                Centre d'aide
                            </Link>
                        </li>
                        <li>
                            <Link href="/faq" class="text-gray-300 hover:text-principal transition-colors duration-200 flex items-center group text-sm">
                                <i class="fas fa-chevron-right text-xs mr-2 text-gray-500 group-hover:text-principal group-hover:translate-x-1 transition-transform"></i>
                                FAQ
                            </Link>
                        </li>
                        <li>
                            <Link href="/comment-ca-marche" class="text-gray-300 hover:text-principal transition-colors duration-200 flex items-center group text-sm">
                                <i class="fas fa-chevron-right text-xs mr-2 text-gray-500 group-hover:text-principal group-hover:translate-x-1 transition-transform"></i>
                                Comment ça marche ?
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Contact & Legal -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-shield-alt text-principal mr-2"></i>
                        Légal & Contact
                    </h3>
                    <ul class="space-y-3 mb-6">
                        <li>
                            <Link href="/terms" class="text-gray-300 hover:text-principal transition-colors duration-200 flex items-center group text-sm">
                                <i class="fas fa-chevron-right text-xs mr-2 text-gray-500 group-hover:text-principal group-hover:translate-x-1 transition-transform"></i>
                                Conditions d'utilisation
                            </Link>
                        </li>
                        <li>
                            <Link href="/privacy" class="text-gray-300 hover:text-principal transition-colors duration-200 flex items-center group text-sm">
                                <i class="fas fa-chevron-right text-xs mr-2 text-gray-500 group-hover:text-principal group-hover:translate-x-1 transition-transform"></i>
                                Politique de confidentialité
                            </Link>
                        </li>
                        <li>
                            <Link href="/cookies" class="text-gray-300 hover:text-principal transition-colors duration-200 flex items-center group text-sm">
                                <i class="fas fa-chevron-right text-xs mr-2 text-gray-500 group-hover:text-principal group-hover:translate-x-1 transition-transform"></i>
                                Politique de cookies
                            </Link>
                        </li>
                    </ul>

                    <!-- Contact Info -->
                    <div class="mt-6 pt-6 border-t border-gray-700">
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-principal mr-3 mt-1"></i>
                                <p class="text-gray-300 text-sm">
                                    Keur Mbaye Fall, Pikine<br>Dakar, Sénégal
                                </p>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone text-principal mr-3"></i>
                                <a href="tel:+221771234567" class="text-gray-300 hover:text-principal transition-colors text-sm">
                                    +221 77 123 45 67
                                </a>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-principal mr-3"></i>
                                <a href="mailto:contact@noflayhub.com" class="text-gray-300 hover:text-principal transition-colors text-sm">
                                    contact@noflayhub.com
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Newsletter Section -->
            <div class="border-t border-gray-700 pt-8 mb-8">
                <div class="max-w-2xl mx-auto text-center">
                    <h3 class="text-xl font-bold text-white mb-3">
                        Restez informé de nos dernières annonces
                    </h3>
                    <p class="text-gray-300 text-sm mb-6">
                        Recevez des notifications sur les nouvelles annonces qui correspondent à vos critères
                    </p>
                    <form @submit.prevent="subscribeNewsletter" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                        <input 
                            type="email" 
                            v-model="newsletterEmail"
                            placeholder="Votre adresse email"
                            required
                            class="flex-1 px-4 py-3 rounded-lg bg-white/10 border border-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-principal focus:border-transparent transition-all"
                        >
                        <button 
                            type="submit"
                            class="px-6 py-3 bg-principal hover:bg-principal/90 text-white font-semibold rounded-lg transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-principal focus:ring-offset-2 focus:ring-offset-gray-800"
                        >
                            <span class="flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                S'abonner
                            </span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-gray-400 text-sm text-center md:text-left">
                        &copy; {{ currentYear }} NoflayHub. Tous droits réservés.
                    </p>
                    <div class="flex items-center space-x-6 text-sm">
                        <a href="/sitemap.xml" class="text-gray-400 hover:text-principal transition-colors">
                            Plan du site
                        </a>
                        <span class="text-gray-600">|</span>
                        <a href="/sitemap.xml" class="text-gray-400 hover:text-principal transition-colors">
                            Sitemap XML
                        </a>
                        <span class="text-gray-600">|</span>
                        <span class="text-gray-400">
                            Made with <i class="fas fa-heart text-principal mx-1"></i> in Senegal
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Link,
    },
    data() {
        return {
            newsletterEmail: '',
            currentYear: new Date().getFullYear(),
        };
    },
    methods: {
        subscribeNewsletter() {
            // TODO: Implémenter l'abonnement à la newsletter
            if (this.newsletterEmail) {
                alert(`Merci pour votre abonnement ! Vous recevrez nos dernières annonces à ${this.newsletterEmail}`);
                this.newsletterEmail = '';
            }
        },
    },
};
</script>

<style scoped>
/* Animations supplémentaires si nécessaire */
</style>
