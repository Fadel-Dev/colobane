<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import SeoHead from '@/Components/SeoHead.vue';

const props = defineProps({
    posts: Object,
});

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('fr-FR', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
    });
};
</script>

<template>
    <AppLayout title="Blog">
        <SeoHead 
            title="Le Blog NoflayHub - Conseils Immobilier & Auto au Sénégal"
            description="Découvrez nos derniers articles, conseils et actualités sur le marché immobilier et automobile au Sénégal."
            keywords="blog immobilier sénégal, conseils achat maison, actualité auto dakar, noflayhub blog"
        />

        <Navbar />

        <main class="min-h-screen bg-gray-50 pt-20">
            <!-- Hero Section -->
            <div class="bg-secondaire py-16 sm:py-24 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-96 h-96 bg-principal/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center">
                        <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-6">
                            Le Blog <span class="text-principal">NoflayHub</span>
                        </h1>
                        <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                            Toutes les actualités, guides et conseils pour réussir vos projets immobiliers et automobiles au Sénégal.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div v-if="posts.data.length === 0" class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
                    <i class="fas fa-newspaper text-6xl text-gray-200 mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-900">Aucun article pour le moment</h3>
                    <p class="text-gray-500 mt-2">Revenez bientôt pour découvrir nos publications.</p>
                </div>

                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <article v-for="post in posts.data" :key="post.id" 
                        class="bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden flex flex-col group border border-gray-100">
                        
                        <!-- Image -->
                        <Link :href="route('blog.show', post.slug)" class="aspect-video overflow-hidden relative block">
                            <img v-if="post.featured_image" 
                                :src="'/storage/' + post.featured_image" 
                                :alt="post.title"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div v-else class="w-full h-full bg-gray-100 flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-gray-300"></i>
                            </div>
                            <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </Link>

                        <!-- Content -->
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-3 mb-4 text-xs font-bold text-gray-400 uppercase tracking-widest">
                                <span class="text-principal">Actualité</span>
                                <span>•</span>
                                <span>{{ formatDate(post.published_at) }}</span>
                            </div>
                            
                            <h2 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-principal transition-colors line-clamp-2">
                                <Link :href="route('blog.show', post.slug)">{{ post.title }}</Link>
                            </h2>
                            
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                {{ post.excerpt || 'Découvrez notre dernier article sur NoflayHub.' }}
                            </p>

                            <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-principal/10 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-principal text-xs"></i>
                                    </div>
                                    <span class="text-sm font-bold text-gray-700">{{ post.user.name }}</span>
                                </div>
                                <Link :href="route('blog.show', post.slug)" class="text-principal font-bold text-sm flex items-center gap-1 group/btn">
                                    Lire la suite
                                    <i class="fas fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform"></i>
                                </Link>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Pagination -->
                <div v-if="posts.links && posts.links.length > 3" class="mt-16 flex justify-center overflow-x-auto pb-4">
                    <div class="flex space-x-1">
                        <Link v-for="(link, index) in posts.links" :key="index"
                            :href="link.url || '#'"
                            class="px-4 py-2 rounded-xl text-sm font-bold transition-all"
                            :class="[
                                link.active ? 'bg-principal text-white shadow-lg shadow-principal/20' : 'bg-white text-gray-600 hover:bg-gray-50',
                                !link.url ? 'opacity-50 cursor-not-allowed' : ''
                            ]"
                            v-html="link.label">
                        </Link>
                    </div>
                </div>
            </div>
        </main>

        <Footer />
    </AppLayout>
</template>
