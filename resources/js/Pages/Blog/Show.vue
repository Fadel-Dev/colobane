<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import SeoHead from '@/Components/SeoHead.vue';
import ChatBot from '@/Components/ChatBot.vue';

import { computed, onMounted, ref } from 'vue';

const page = usePage();
const route = (name, params) => {
    let url = page.props.ziggy?.urls?.[name] || '#';
    if (params) {
        if (typeof params === 'object') {
            for (const key in params) {
                url = url.replace(`{${key}}`, params[key]);
            }
        } else {
            url = url.replace(/\{.*\}/, params);
        }
    }
    return url;
};

const props = defineProps({
    post: Object,
    seoKeywords: String,
});

const currentUrl = ref('');

onMounted(() => {
    currentUrl.value = window.location.href;
});

const formatDate = (date) => {
    if (!date) return '';
    return new Date(date).toLocaleDateString('fr-FR', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
    });
};

const structuredData = computed(() => {
    const origin = typeof window !== 'undefined' ? window.location.origin : '';
    return {
        "@context": "https://schema.org",
        "@type": "BlogPosting",
        "headline": props.post.title,
        "image": props.post.featured_image ? [`${origin}/storage/${props.post.featured_image}`] : [],
        "datePublished": props.post.published_at,
        "author": [{
            "@type": "Person",
            "name": props.post.user?.name || 'Admin',
            "url": origin
        }]
    };
});
</script>

<template>
    <div class="min-h-screen bg-white">
        <SeoHead 
            :title="post.title + ' | Blog NoflayHub'"
            :description="post.excerpt || (post.content ? post.content.substring(0, 160) : '')"
            :keywords="seoKeywords"
            :og-type="'article'"
            :og-image="post.featured_image ? '/storage/' + post.featured_image : null"
            :structured-data="structuredData"
        />

        <Navbar />

        <main class="pt-20">
            <!-- Article Header -->
            <header class="py-12 sm:py-20 bg-gray-50 border-b border-gray-100">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="mb-6 flex justify-center">
                        <Link :href="route('blog.index')" class="inline-flex items-center gap-2 text-principal font-bold text-sm uppercase tracking-widest hover:text-principal/80 transition-colors">
                            <i class="fas fa-arrow-left"></i>
                            Retour au blog
                        </Link>
                    </div>
                    
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 text-center leading-tight mb-8">
                        {{ post.title }}
                    </h1>

                    <div class="flex items-center justify-center gap-6 text-sm font-bold text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center gap-2 text-secondaire">
                            <div class="w-10 h-10 bg-principal rounded-full flex items-center justify-center text-white">
                                <i class="fas fa-user text-xs"></i>
                            </div>
                            <span>{{ post.user?.name || 'Admin' }}</span>
                        </div>
                        <span class="hidden sm:inline text-gray-300">|</span>
                        <div class="flex items-center gap-2">
                            <i class="far fa-calendar-alt text-principal"></i>
                            <span>{{ formatDate(post.published_at) }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            <div v-if="post.featured_image" class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12 sm:-mt-20 mb-12 sm:mb-20">
                <div class="rounded-3xl overflow-hidden shadow-2xl border-8 border-white">
                    <img :src="'/storage/' + post.featured_image" :alt="post.title" class="w-full aspect-[21/9] object-cover">
                </div>
            </div>

            <!-- Content -->
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
                <div class="prose prose-lg prose-red max-w-none text-gray-700 leading-relaxed blog-content" v-html="post.content">
                </div>

                <!-- Footer Article -->
                <div class="mt-20 pt-12 border-t border-gray-100">
                    <div class="bg-gray-50 rounded-3xl p-8 sm:p-12 flex flex-col sm:flex-row items-center gap-8 text-center sm:text-left">
                        <div class="w-24 h-24 bg-principal/10 rounded-full flex items-center justify-center text-principal text-3xl shrink-0">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Partagez cet article</h3>
                            <p class="text-gray-600 mb-6">Si cet article vous a été utile, n'hésitez pas à le partager avec votre entourage.</p>
                            <div class="flex items-center justify-center sm:justify-start gap-4">
                                <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(currentUrl)" target="_blank" class="w-12 h-12 bg-[#1877F2] text-white rounded-xl flex items-center justify-center hover:scale-110 transition-transform">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a :href="'https://twitter.com/intent/tweet?url=' + encodeURIComponent(currentUrl)" target="_blank" class="w-12 h-12 bg-[#1DA1F2] text-white rounded-xl flex items-center justify-center hover:scale-110 transition-transform">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a :href="'https://api.whatsapp.com/send?text=' + encodeURIComponent(post.title + ' ' + currentUrl)" target="_blank" class="w-12 h-12 bg-[#25D366] text-white rounded-xl flex items-center justify-center hover:scale-110 transition-transform">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <Footer />
        <ChatBot />
    </div>
</template>

<style>
.blog-content h2 {
    font-size: 1.875rem;
    font-weight: 800;
    color: #0f172a;
    margin-top: 2.5rem;
    margin-bottom: 1.25rem;
}
.blog-content p {
    margin-bottom: 1.5rem;
}
.blog-content ul {
    list-style-type: disc;
    padding-left: 1.5rem;
    margin-bottom: 1.5rem;
}
.blog-content li {
    margin-bottom: 0.5rem;
}
</style>
