<template>
    <Head>
        <!-- Primary Meta Tags -->
        <title>{{ title || defaultTitle }}</title>
        <meta name="title" :content="title || defaultTitle" />
        <meta name="description" :content="description || defaultDescription" />
        <meta name="keywords" :content="keywords || defaultKeywords" />
        <meta name="author" content="NoflayHub" />
        <meta name="robots" :content="robots || 'index, follow'" />
        <meta name="language" content="French" />
        <meta name="revisit-after" content="7 days" />
        <link rel="canonical" :href="canonicalUrl || currentUrl" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" :content="ogType || 'website'" />
        <meta property="og:url" :content="ogUrl || currentUrl" />
        <meta property="og:title" :content="ogTitle || title || defaultTitle" />
        <meta property="og:description" :content="ogDescription || description || defaultDescription" />
        <meta property="og:image" :content="ogImage || defaultImage" />
        <meta property="og:site_name" content="NoflayHub" />
        <meta property="og:locale" content="fr_FR" />

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:url" :content="twitterUrl || currentUrl" />
        <meta name="twitter:title" :content="twitterTitle || title || defaultTitle" />
        <meta name="twitter:description" :content="twitterDescription || description || defaultDescription" />
        <meta name="twitter:image" :content="twitterImage || ogImage || defaultImage" />

        <!-- Additional Meta Tags -->
        <meta name="theme-color" content="#eb2d53" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta name="apple-mobile-web-app-title" content="NoflayHub" />

        <!-- Structured Data (JSON-LD) -->
        <component :is="'script'" type="application/ld+json" v-if="structuredData">{{ JSON.stringify(structuredData) }}</component>
    </Head>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    title: {
        type: String,
        default: null,
    },
    description: {
        type: String,
        default: null,
    },
    keywords: {
        type: String,
        default: null,
    },
    robots: {
        type: String,
        default: 'index, follow',
    },
    canonicalUrl: {
        type: String,
        default: null,
    },
    ogType: {
        type: String,
        default: 'website',
    },
    ogUrl: {
        type: String,
        default: null,
    },
    ogTitle: {
        type: String,
        default: null,
    },
    ogDescription: {
        type: String,
        default: null,
    },
    ogImage: {
        type: String,
        default: null,
    },
    twitterUrl: {
        type: String,
        default: null,
    },
    twitterTitle: {
        type: String,
        default: null,
    },
    twitterDescription: {
        type: String,
        default: null,
    },
    twitterImage: {
        type: String,
        default: null,
    },
    structuredData: {
        type: Object,
        default: null,
    },
});

const defaultTitle = 'NoflayHub - Plateforme de location immobilière au Sénégal';
const defaultDescription = 'Trouvez votre logement idéal au Sénégal. Villas, appartements, chambres, studios et terrains à louer. Des milliers d\'annonces vérifiées dans toutes les régions du Sénégal.';
const defaultKeywords = 'location Sénégal, immobilier Sénégal, villa à louer, appartement à louer, chambre à louer, studio à louer, terrain à louer, location Dakar, location Thiès, location Saint-Louis, NoflayHub';
const defaultImage = computed(() => {
    if (typeof window !== 'undefined') {
        return window.location.origin + '/logo.png';
    }
    return '/logo.png';
});

const currentUrl = computed(() => {
    if (typeof window !== 'undefined') {
        return window.location.href;
    }
    return '';
});
</script>

