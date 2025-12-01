<template>
    <SeoHead 
        title="Centre d'aide - NoflayHub"
        description="Trouvez des réponses à vos questions et obtenez de l'aide sur l'utilisation de NoflayHub."
        keywords="aide noflayhub, support, assistance, guide utilisateur"
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
                    Centre d'aide
                </h1>
                <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                    Trouvez rapidement les réponses à vos questions
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <main class="max-w-[95rem] mx-auto px-6 sm:px-8 lg:px-12 py-16">
            <!-- Search Bar -->
            <div class="mb-12">
                <div class="max-w-2xl mx-auto">
                    <div class="relative">
                        <input 
                            type="text" 
                            v-model="searchQuery"
                            placeholder="Rechercher dans l'aide..."
                            class="w-full px-6 py-4 pl-14 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-principal focus:border-transparent text-lg"
                        >
                        <i class="fas fa-search absolute left-5 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <div 
                    v-for="category in helpCategories" 
                    :key="category.id"
                    @click="selectedCategory = category.id"
                    :class="[
                        'bg-white rounded-xl shadow-lg p-6 cursor-pointer transition-all duration-300 hover:shadow-xl hover:scale-105',
                        selectedCategory === category.id ? 'ring-2 ring-principal' : ''
                    ]"
                >
                    <div class="w-16 h-16 bg-principal/10 rounded-lg flex items-center justify-center mb-4">
                        <i :class="[category.icon, 'text-principal text-2xl']"></i>
                    </div>
                    <h3 class="text-xl font-bold text-secondaire mb-2">{{ category.title }}</h3>
                    <p class="text-gray-600 text-sm">{{ category.description }}</p>
                </div>
            </div>

            <!-- Help Articles -->
            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-secondaire mb-6">
                    {{ selectedCategoryTitle }}
                </h2>
                <div class="space-y-4">
                    <div 
                        v-for="article in filteredArticles" 
                        :key="article.id"
                        class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow"
                    >
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-secondaire mb-2">{{ article.title }}</h3>
                                <p class="text-gray-600 text-sm">{{ article.excerpt }}</p>
                            </div>
                            <button 
                                @click="toggleArticle(article.id)"
                                class="ml-4 text-principal hover:text-principal/80 transition-colors"
                            >
                                <i :class="[
                                    'fas text-xl',
                                    expandedArticles.includes(article.id) ? 'fa-chevron-up' : 'fa-chevron-down'
                                ]"></i>
                            </button>
                        </div>
                        <div 
                            v-if="expandedArticles.includes(article.id)"
                            class="mt-4 pt-4 border-t border-gray-200"
                        >
                            <div class="prose max-w-none text-gray-700" v-html="article.content"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="mt-16 bg-gradient-to-r from-principal/10 to-secondaire/10 rounded-2xl p-8 md:p-12 text-center">
                <h2 class="text-2xl font-bold text-secondaire mb-4">Besoin d'aide supplémentaire ?</h2>
                <p class="text-gray-700 mb-6">Notre équipe de support est là pour vous aider</p>
                <Link href="/contact" class="inline-block px-8 py-4 bg-principal hover:bg-principal/90 text-white font-semibold rounded-lg transition-all duration-300 hover:scale-105">
                    Contacter le support
                </Link>
            </div>
        </main>
    </div>

    <Footer />
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '../Components/Navbar.vue';
import Footer from '../Components/Footer.vue';
import SeoHead from '../Components/SeoHead.vue';

const searchQuery = ref('');
const selectedCategory = ref(null);
const expandedArticles = ref([]);

const helpCategories = [
    { id: 'getting-started', title: 'Premiers pas', description: 'Commencer avec NoflayHub', icon: 'fas fa-rocket' },
    { id: 'account', title: 'Mon compte', description: 'Gérer votre compte', icon: 'fas fa-user-circle' },
    { id: 'search', title: 'Recherche', description: 'Trouver des annonces', icon: 'fas fa-search' },
    { id: 'publish', title: 'Publier', description: 'Créer une annonce', icon: 'fas fa-plus-circle' },
    { id: 'payments', title: 'Paiements', description: 'Options de paiement', icon: 'fas fa-credit-card' },
    { id: 'safety', title: 'Sécurité', description: 'Rester en sécurité', icon: 'fas fa-shield-alt' },
];

const helpArticles = [
    {
        id: 1,
        category: 'getting-started',
        title: 'Comment créer un compte ?',
        excerpt: 'Apprenez à créer votre compte NoflayHub en quelques étapes simples.',
        content: '<p>Pour créer un compte sur NoflayHub :</p><ol><li>Cliquez sur "S\'inscrire" en haut à droite</li><li>Remplissez le formulaire avec vos informations</li><li>Vérifiez votre email</li><li>Connectez-vous et commencez à utiliser la plateforme</li></ol>'
    },
    {
        id: 2,
        category: 'getting-started',
        title: 'Comment rechercher une annonce ?',
        excerpt: 'Découvrez comment utiliser notre moteur de recherche avancé.',
        content: '<p>Pour rechercher une annonce :</p><ol><li>Utilisez la barre de recherche en haut de la page</li><li>Filtrez par type, prix, surface, etc.</li><li>Consultez les résultats et cliquez sur une annonce pour voir les détails</li></ol>'
    },
    {
        id: 3,
        category: 'publish',
        title: 'Comment publier une annonce ?',
        excerpt: 'Guide complet pour publier votre première annonce.',
        content: '<p>Pour publier une annonce :</p><ol><li>Connectez-vous à votre compte</li><li>Cliquez sur "Publier une annonce"</li><li>Remplissez tous les champs requis</li><li>Ajoutez des photos de qualité</li><li>Validez et publiez votre annonce</li></ol>'
    },
    {
        id: 4,
        category: 'account',
        title: 'Comment modifier mon profil ?',
        excerpt: 'Apprenez à mettre à jour vos informations personnelles.',
        content: '<p>Pour modifier votre profil :</p><ol><li>Connectez-vous à votre compte</li><li>Allez dans "Mon profil"</li><li>Modifiez les informations souhaitées</li><li>Sauvegardez les modifications</li></ol>'
    },
    {
        id: 5,
        category: 'safety',
        title: 'Comment rester en sécurité ?',
        excerpt: 'Conseils pour éviter les arnaques et rester en sécurité.',
        content: '<p>Conseils de sécurité :</p><ul><li>Ne partagez jamais vos informations bancaires</li><li>Rencontrez les personnes en public</li><li>Vérifiez l\'identité de votre interlocuteur</li><li>Signalez tout comportement suspect</li></ul>'
    },
    {
        id: 6,
        category: 'payments',
        title: 'Comment fonctionnent les paiements ?',
        excerpt: 'Informations sur les méthodes de paiement acceptées.',
        content: '<p>NoflayHub accepte plusieurs méthodes de paiement :</p><ul><li>Paiement en ligne sécurisé</li><li>Virement bancaire</li><li>Mobile money</li><li>Espèces (pour certaines transactions)</li></ul>'
    },
];

const selectedCategoryTitle = computed(() => {
    if (!selectedCategory.value) return 'Tous les articles';
    const category = helpCategories.find(c => c.id === selectedCategory.value);
    return category ? category.title : 'Tous les articles';
});

const filteredArticles = computed(() => {
    let articles = helpArticles;
    
    if (selectedCategory.value) {
        articles = articles.filter(a => a.category === selectedCategory.value);
    }
    
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        articles = articles.filter(a => 
            a.title.toLowerCase().includes(query) || 
            a.excerpt.toLowerCase().includes(query)
        );
    }
    
    return articles;
});

const toggleArticle = (id) => {
    const index = expandedArticles.value.indexOf(id);
    if (index > -1) {
        expandedArticles.value.splice(index, 1);
    } else {
        expandedArticles.value.push(id);
    }
};
</script>

