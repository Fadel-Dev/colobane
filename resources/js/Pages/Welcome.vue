<template>

    <Head title="Accueil" />

    <Navbar class="relative" />
    <div id="principal" class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
        <div class="lg:w-8/12 mx-auto px-4">
            <!-- Slide -->
            <SlidePub />

            <!-- Navigation Categories - Style amélioré -->
            <div class="mt-8">
                <div class="swiper w-full lg:w-4/4 lg:mt-[10px]" id="cat">
                    <div class="swiper-wrapper pt-10 pb-4">
                        <div v-for="item in items" :key="item.id"
                            class="swiper-slide w-1/4 sm:w-1/4 md:w-1/6 lg:w-6/6 xl:w-1/6 flex flex-col">
                            <div :id="item.id"
                                class="text-center transform hover:scale-110 transition-all duration-300 cursor-pointer group"
                                @click="activeTab = item.name">
                                <div class="p-4 rounded-2xl bg-white/80 backdrop-blur-sm shadow-lg hover:shadow-xl transition-all duration-300 relative overflow-hidden"
                                    :class="{
                                        'ring-4 ring-principal ring-opacity-60 shadow-2xl scale-105': activeTab === item.name
                                    }">
                                    <!-- Effet de fond animé -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-principal/10 to-secondaire/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    </div>

                                    <!-- Icône avec animation -->
                                    <div class="relative z-10">
                                        <div
                                            class="inline-flex items-center justify-center w-16 h-16 mx-auto mb-3 rounded-full bg-principal/10 group-hover:bg-principal/20 transition-colors duration-300">
                                            <i
                                                :class="`fas fa-${item.icon} text-3xl text-principal group-hover:text-principal-dark transition-colors duration-300`"></i>
                                        </div>
                                        <div class="mt-2">
                                            <span
                                                class="font-semibold text-secondaire group-hover:text-principal transition-colors duration-300">{{
                                                item.name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="lg:max-w-[80vw] max-w-[970vw] mx-auto mt-8">
                    <!-- Immobilier Tab -->
                    <div v-if="activeTab === 'Immobilier'" class="space-y-8">
                        <!-- Section Boostée -->
                        <div class="mb-10">
                            <h3 class="text-xl font-bold text-secondaire mb-6 flex items-center">
                                <span class="w-4 h-4 bg-principal rounded-full mr-2"></span>
                                Annonces en vedette
                                <span class="ml-auto text-sm font-normal text-principal flex items-center">
                                    <i class="fas fa-bolt mr-1"></i> Boostées
                                </span>
                            </h3>

                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <div v-for="immobillierBoost in immobilliersBoost.data" :key="immobillierBoost.id"
                                        @click="navigateToDetail(immobillierBoost.id)"
                                        class="swiper-slide w-full sm:w-1/4 md:w-1/4 lg:w-1/6 xl:w-1/6 p-2">
                                        <!-- Card améliorée -->
                                        <div
                                            class="card group relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 h-full flex flex-col">
                                            <!-- Badge Boost -->
                                            <div class="absolute top-4 right-4 z-10 flex items-center gap-2">
                                                <button
                                                    @click.stop="toggleFavorite(immobillierBoost.id)"
                                                    :class="[
                                                        'bg-white rounded-full p-2 shadow-md hover:shadow-lg transition-all duration-300',
                                                        isFavorite(immobillierBoost.id)
                                                            ? 'text-red-500'
                                                            : 'text-gray-400 hover:text-red-400'
                                                    ]"
                                                    aria-label="Ajouter aux favoris"
                                                >
                                                    <i :class="isFavorite(immobillierBoost.id) ? 'fas fa-heart' : 'far fa-heart'" class="text-sm"></i>
                                                </button>
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-400 to-yellow-500 text-white shadow-md">
                                                    <i class="fas fa-bolt mr-1"></i> Boost
                                                </span>
                                            </div>

                                            <div class="aspect-square overflow-hidden relative bg-gray-200">
                                                <!-- Image directement depuis la base de données (image1, image2, ou image3) -->
                                                <img :src="getFirstAvailableImage(immobillierBoost)"
                                                    :alt="immobillierBoost.nom || 'Image du bien'"
                                                    :title="immobillierBoost.nom"
                                                    class="h-full w-full object-cover transition-all duration-500 group-hover:scale-110"
                                                    @error="handleImageError($event)"
                                                    loading="lazy"
                                                    @load="() => {}">
                                                <!-- Overlay au hover -->
                                                <div
                                                    class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                </div>
                                            </div>

                                            <div class="p-4 space-y-2 flex-grow">
                                                <p class="text-lg font-bold text-principal">
                                                    {{ immobillierBoost.prix }}
                                                    <span class="text-sm text-secondaire">Fcfa</span>
                                                </p>

                                                <p class="text-secondaire font-medium truncate">
                                                    {{ immobillierBoost.nom.substring(0, 20) }}
                                                </p>

                                                <div
                                                    class="flex items-center text-sm text-principal border-t border-gray-100 pt-2 mt-2">
                                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                                    {{ immobillierBoost.region }}, Senegal
                                                </div>
                                            </div>

                                            <button
                                                class="w-full bg-gradient-to-r from-principal to-principal-dark text-white py-3 px-4 transform transition-all duration-300 hover:opacity-90 group-hover:translate-y-0 flex items-center justify-center space-x-2">
                                                <i class="fas fa-phone-alt"></i>
                                                <span>Contacter</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Call to Action amélioré -->
<Action />
                        <!-- Latest Listings Section améliorée -->
                        <section class="py-8" id="transparent">
                            <div class="mx-auto max-w-screen-xl px-4">
                                <div class="text-center mb-12 relative">
                                    <h2 class="text-3xl font-bold text-secondaire inline-flex items-center">
                                        <i class="fas fa-home mr-3 text-principal"></i>
                                        Dernières Annonces au Sénégal
                                    </h2>
                                    <div
                                        class="w-24 h-1 bg-gradient-to-r from-principal to-secondaire mx-auto mt-4 rounded-full">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                                    <article v-for="maison in maisons.data" :key="maison.id"
                                        @click="navigateToDetail(maison.id)"
                                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 h-full flex flex-col">
                                        <div class="relative bg-gray-200">
                                            <!-- Image directement depuis la base de données (image1, image2, ou image3) -->
                                            <img :src="getFirstAvailableImage(maison)"
                                                :alt="maison.nom || 'Image du bien immobilier'"
                                                :title="maison.nom"
                                                class="w-full h-64 object-cover" 
                                                loading="lazy"
                                                @error="handleImageError($event)"
                                                @load="() => {}">
                                            <div class="absolute top-4 left-4">
                                                <span
                                                    class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">
                                                    {{ maison.affaire }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="p-6 flex-grow">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h3 class="text-xl font-bold mb-1 text-principal">
                                                        {{ maison.nom.substring(0, 20) }}{{ maison.nom.length > 20 ?
                                                        '...' : '' }}
                                                    </h3>
                                                    <p class="text-gray-600 mb-2">
                                                        <i class="fas fa-map-marker-alt text-[#eb2d53] mr-2"></i>
                                                        {{ maison.region }}, Sénégal
                                                    </p>
                                                </div>
                                            </div>

                                            <div
                                                class="flex justify-between items-center mt-4 border-b-2 border-gray-300">
                                                <div>
                                                    <span class="text-gray-500 text-sm">Prix:</span>
                                                    <span class="text-lg font-bold text-[#eb2d53]">
                                                        {{ maison.prix }} FCFA
                                                        <span class="text-sm text-gray-500">{{ maison.type }}</span>
                                                    </span>
                                                </div>
                                                <button 
                                                    @click.stop="toggleFavorite(maison.id)"
                                                    :class="[
                                                        'transition-colors duration-300',
                                                        isFavorite(maison.id)
                                                            ? 'text-red-500 hover:text-red-600'
                                                            : 'text-[#eb2d53] hover:text-indigo-800'
                                                    ]"
                                                    aria-label="Ajouter aux favoris"
                                                >
                                                    <i :class="isFavorite(maison.id) ? 'fas fa-heart' : 'far fa-heart'" class="text-xl"></i>
                                                </button>
                                            </div>

                                            <div v-if="maison.status == 'accepter'" class="mt-6 ">
                                                <a href="#"
                                                    class="block text-center bg-[#eb2d53] hover:bg-[#d12648] text-white py-2 rounded-lg transition duration-300">
                                                    <span class="flex items-center justify-center space-x-2">
                                                        <i class="fas fa-phone-alt"></i>
                                                        <span>Contacter</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Other Tabs -->
                    <div v-else-if="activeTab == 'Chambre'" class="bg-transparent">
                        <Chambre :chambres="chambres" :chambresBoost="chambresBoost" />
                    </div>
                    <div v-else-if="activeTab == 'Villa'" class="bg-transparent">
                        <Villa :villas="villas" :villasBoost="villasBoost" />
                    </div>
                    <div v-else-if="activeTab == 'Immeuble'" class="bg-transparent">
                        <Immeuble :immeubles="immeubles" :immeublesBoost="immeublesBoost" />
                    </div>
                    <div v-else-if="activeTab == 'Terrain'" class="bg-transparent">
                        <Terrain :terrains="terrains" :terrainsBoost="terrainsBoost" />
                    </div>
                    <div v-else-if="activeTab == 'Verger'" class="bg-transparent">
                        <Verger :vergers="vergers" :vergersBoost="vergersBoost" />
                    </div>
                    <div v-else-if="activeTab == 'Appartement'" class="bg-transparent">
                        <Appartement :appartements="appartements" :appartements-boost="appartementsBoost" />
                    </div>
                    <div v-else-if="activeTab == 'Studio'" class="bg-transparent">
                        <Studio :studios="studios" :studios-boost="studiosBoost" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Footer />
    
    <!-- Toast Notification -->
    <Toast 
        :show="showToast" 
        :message="toastMessage" 
        :type="toastType"
        @close="closeToast"
    />
</template>

<style scoped>
#principal {
    min-height: 100vh;
    background: linear-gradient(135deg, #f6f8fc 0%, #f1f4f9 100%);
}

/* Animation pour les cartes */
.card {
    @apply bg-white rounded-2xl overflow-hidden shadow-lg transition-all duration-300;
}

.card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Effet de glassmorphisme */
.backdrop-blur-sm {
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

/* Animation pour les images */
.aspect-square img {
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.aspect-square:hover img {
    transform: scale(1.1);
}

/* Style pour les boutons */
button {
    @apply transition-all duration-300;
}

button:hover {
    transform: translateY(-2px);
}

/* Animation pour les catégories */
.swiper-slide>div {
    transition: all 0.3s ease;
}

.swiper-slide:hover>div {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

/* Effet de hover sur les titres */
h2 {
    position: relative;
}

/* Animation des icônes */
.fa-icon {
    transition: transform 0.3s ease;
}

.group:hover .fa-icon {
    transform: scale(1.1);
}

/* Gradient text pour les éléments importants */
.text-gradient {
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    background-image: linear-gradient(to right, var(--color-principal), var(--color-secondaire));
}
</style>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    immobilliersBoost: Object,
    maisons: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    chambres: Object,
    chambresBoost: Object,
    villas: Object,
    villasBoost: Object,
    immeubles: Object,
    immeublesBoost: Object,
    terrains: Object,
    terrainsBoost: Object,
    vergers: Object,
    vergersBoost: Object,
    appartements: Object,
    appartementsBoost: Object,
    studios: Object,
    studiosBoost: Object,
});

let items = [
    {
        "id": 1,
        "icon": "home",
        "name": "Villa"
    },
    {
        "id": 2,
        "icon": "map-marked",
        "name": "Terrain"
    },
    {
        "id": 4,
        "icon": "bed",
        "name": "Chambre"
    },
    {
        "id": 5,
        "icon": "building",
        "name": "Immeuble"
    },
    {
        "id": 6,
        "icon": "apple-alt",
        "name": "Verger"
    },
    {
        "id": 7,
        "icon": "city",
        "name": "Appartement"
    },
    {
        "id": 8,
        "icon": "home",
        "name": "Studio"
    },
    {
        "id": 9,
        "icon": "key",
        "name": "Immobilier"
    },
];
</script>

<script>
import { InertiaProgress } from '@inertiajs/progress';
import SwitchBtn from './BoutCode/SwitchBtn.vue';
import SlidePub from './BoutCode/SlidePub.vue';
import Action from './BoutCode/Action.vue';
import Chambre from './ForWelcome/Chambre.vue';
import Immobilier from './Categories/immobilier.vue';
import Villa from './ForWelcome/Villa.vue';
import Immeuble from './ForWelcome/Immeuble.vue';
import Terrain from './ForWelcome/Terrain.vue';
import Verger from './ForWelcome/Verger.vue';
import Appartement from './ForWelcome/Appartement.vue';
import Studio from './ForWelcome/Studio.vue';
import Footer from '../Components/Footer.vue';
import Navbar from '../Components/Navbar.vue';
import Toast from '../Components/Toast.vue';

export default {
    components: {
        Toast,
    },
    data() {
        return {
            activeTab: 'Immobilier',
            showMenu: false,
            favorites: new Set(), // Set pour stocker les IDs des favoris
            showToast: false,
            toastMessage: '',
            toastType: 'success',
        };
    },
    mounted() {
        // Charger les favoris de l'utilisateur si connecté
        if (this.$page.props.auth?.user) {
            this.loadFavorites();
        }
    },
    methods: {
        navigateToDetail(id) {
            this.$inertia.visit(`/detail/${id}`);
        },
        async toggleFavorite(id) {
            if (!this.$page.props.auth?.user) {
                this.$inertia.visit('/login');
                return;
            }

            try {
                const response = await fetch(`/favoris/toggle/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                });

                const data = await response.json();
                
                if (data.status === 'added') {
                    this.favorites.add(id);
                    this.toastMessage = 'Bien ajouté aux favoris avec succès!';
                    this.toastType = 'success';
                    this.showToast = true;
                } else if (data.status === 'removed') {
                    this.favorites.delete(id);
                    this.toastMessage = 'Bien retiré des favoris';
                    this.toastType = 'info';
                    this.showToast = true;
                }
            } catch (error) {
                console.error('Erreur lors de l\'ajout aux favoris:', error);
                this.toastMessage = 'Erreur lors de l\'opération';
                this.toastType = 'error';
                this.showToast = true;
            }
        },
        closeToast() {
            this.showToast = false;
        },
        isFavorite(id) {
            return this.favorites.has(id);
        },
        async loadFavorites() {
            if (!this.$page.props.auth?.user) return;

            // Charger les favoris pour tous les biens affichés
            const allIds = [
                ...(this.immobilliersBoost?.data || []).map(m => m.id),
                ...(this.maisons?.data || []).map(m => m.id),
            ];

            for (const id of allIds) {
                try {
                    const response = await fetch(`/favoris/check/${id}`, {
                        headers: {
                            'Accept': 'application/json',
                        },
                    });
                    const data = await response.json();
                    if (data.isFavorite) {
                        this.favorites.add(id);
                    }
                } catch (error) {
                    // Ignorer les erreurs silencieusement
                }
            }
        },
        getImageUrl(imagePath) {
            // Debug: vérifier que l'image vient bien de la base de données
            if (process.env.NODE_ENV === 'development') {
                console.log('Image path from DB:', imagePath);
            }
            
            if (!imagePath || imagePath === 'null' || imagePath === '') {
                // Image par défaut si aucune image
                return 'https://via.placeholder.com/500x300?text=Image+non+disponible';
            }
            
            // Si c'est une URL externe (http:// ou https://), retourner tel quel
            // Ces URLs viennent directement de la base de données (seeders ou uploads)
            if (imagePath.startsWith('http://') || imagePath.startsWith('https://')) {
                return imagePath;
            }
            
            // Si c'est un chemin local (uploadé par l'utilisateur), ajouter /storage/
            // Vérifier si le chemin commence déjà par storage/
            if (imagePath.startsWith('storage/') || imagePath.startsWith('/storage/')) {
                return imagePath.startsWith('/') ? imagePath : '/' + imagePath;
            }
            
            // Sinon, ajouter /storage/ devant (format: topics/filename.jpg)
            return '/storage/' + imagePath;
        },
        // Fonction pour obtenir la première image disponible (image1, image2, ou image3)
        getFirstAvailableImage(article) {
            if (article.image1 && article.image1 !== '' && article.image1 !== 'null') {
                return this.getImageUrl(article.image1);
            }
            if (article.image2 && article.image2 !== '' && article.image2 !== 'null') {
                return this.getImageUrl(article.image2);
            }
            if (article.image3 && article.image3 !== '' && article.image3 !== 'null') {
                return this.getImageUrl(article.image3);
            }
            return 'https://via.placeholder.com/500x300?text=Image+non+disponible';
        },
        handleImageError(event) {
            // Remplacer par une image placeholder en cas d'erreur
            if (event.target && !event.target.dataset.errorHandled) {
                event.target.dataset.errorHandled = 'true';
                event.target.src = 'https://via.placeholder.com/500x300?text=Image+non+disponible';
                event.target.onerror = null; // Éviter les boucles infinies
            }
        },
    },
    mounted() {
        new Swiper('.swiper', {
            slidesPerView: 'auto',
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });

        InertiaProgress.init({
            delay: 200,
            color: '#eb2d53',
            includeCSS: true,
            showSpinner: true,
        });
    },
};
</script>
