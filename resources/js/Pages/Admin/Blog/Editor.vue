<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, onMounted } from 'vue';
import Toast from '@/Components/Toast.vue';

const props = defineProps({
    post: Object,
});

const isEditing = !!props.post;
const showToast = ref(false);
const toastMessage = ref('');
const imagePreview = ref(null);

const form = useForm({
    title: props.post?.title || '',
    content: props.post?.content || '',
    excerpt: props.post?.excerpt || '',
    status: props.post?.status || 'draft',
    image: null,
});

const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.image = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const submit = () => {
    const routeName = isEditing ? 'admin.blog.update' : 'admin.blog.store';
    const routeParams = isEditing ? props.post.id : {};
    
    // We use post even for update because of file upload handling in Laravel/Inertia
    form.post(route(routeName, routeParams), {
        onSuccess: () => {
            toastMessage.value = isEditing ? 'Article mis à jour !' : 'Article créé !';
            showToast.value = true;
        },
    });
};
</script>

<template>
    <AppLayout :title="isEditing ? 'Modifier Article' : 'Nouvel Article'">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-bold text-2xl text-gray-900 flex items-center gap-3">
                    <i class="fas fa-edit text-principal"></i>
                    {{ isEditing ? 'Modifier l\'article' : 'Créer un nouvel article' }}
                </h2>
                <Link :href="route('admin.blog.index')" class="text-gray-500 hover:text-gray-700 font-bold text-sm flex items-center gap-2">
                    <i class="fas fa-times"></i>
                    Annuler
                </Link>
            </div>
        </template>

        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="space-y-8">
                    <!-- Main Card -->
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
                        <div class="space-y-6">
                            <!-- Titre -->
                            <div>
                                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-widest mb-2">Titre de l'article</label>
                                <input v-model="form.title" type="text" required placeholder="Ex: 5 conseils pour acheter sa première maison au Sénégal"
                                    class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-principal/10 focus:border-principal transition-all font-bold text-lg">
                                <div v-if="form.errors.title" class="mt-2 text-red-500 text-xs font-bold">{{ form.errors.title }}</div>
                            </div>

                            <!-- Image -->
                            <div>
                                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-widest mb-2">Image de couverture</label>
                                <div class="flex flex-col sm:flex-row gap-6 items-start">
                                    <div class="w-full sm:w-64 aspect-video bg-gray-100 rounded-2xl overflow-hidden relative border-2 border-dashed border-gray-200">
                                        <img v-if="imagePreview || (isEditing && post.featured_image)" 
                                            :src="imagePreview || '/storage/' + post.featured_image" 
                                            class="w-full h-full object-cover">
                                        <div v-else class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                            <i class="fas fa-cloud-upload-alt text-3xl mb-2"></i>
                                            <span class="text-[10px] font-bold uppercase">Aucune image</span>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <input @change="handleImageChange" type="file" accept="image/*" class="hidden" id="blog-image">
                                        <label for="blog-image" class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-sm cursor-pointer transition-colors mb-4">
                                            <i class="fas fa-image mr-2"></i>
                                            Choisir une image
                                        </label>
                                        <p class="text-xs text-gray-400 leading-relaxed">
                                            Recommandé : Format 16:9, max 2MB. Cette image sera utilisée comme couverture de l'article et dans les aperçus sur les réseaux sociaux.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Extrait -->
                            <div>
                                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-widest mb-2">Extrait / Résumé</label>
                                <textarea v-model="form.excerpt" rows="3" placeholder="Bref résumé de l'article pour les listes..."
                                    class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-principal/10 focus:border-principal transition-all text-sm"></textarea>
                                <div class="flex justify-between mt-1">
                                    <div v-if="form.errors.excerpt" class="text-red-500 text-xs font-bold">{{ form.errors.excerpt }}</div>
                                    <div class="text-[10px] text-gray-400 font-bold uppercase">{{ form.excerpt.length }}/500</div>
                                </div>
                            </div>

                            <!-- Contenu -->
                            <div>
                                <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-widest mb-2">Contenu de l'article (HTML supporté)</label>
                                <textarea v-model="form.content" rows="15" required placeholder="Écrivez votre article ici..."
                                    class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-principal/10 focus:border-principal transition-all text-base leading-relaxed font-mono"></textarea>
                                <div v-if="form.errors.content" class="mt-2 text-red-500 text-xs font-bold">{{ form.errors.content }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar / Options -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
                            <label class="block text-sm font-extrabold text-gray-700 uppercase tracking-widest mb-4">Statut de publication</label>
                            <div class="flex gap-4">
                                <label class="flex-1 cursor-pointer group">
                                    <input type="radio" v-model="form.status" value="draft" class="hidden">
                                    <div class="p-4 border-2 rounded-2xl transition-all flex flex-col items-center gap-2"
                                        :class="form.status === 'draft' ? 'border-orange-500 bg-orange-50' : 'border-gray-100 hover:border-gray-200'">
                                        <i class="fas fa-pencil-alt" :class="form.status === 'draft' ? 'text-orange-500' : 'text-gray-300'"></i>
                                        <span class="text-xs font-extrabold uppercase tracking-widest" :class="form.status === 'draft' ? 'text-orange-700' : 'text-gray-400'">Brouillon</span>
                                    </div>
                                </label>
                                <label class="flex-1 cursor-pointer group">
                                    <input type="radio" v-model="form.status" value="published" class="hidden">
                                    <div class="p-4 border-2 rounded-2xl transition-all flex flex-col items-center gap-2"
                                        :class="form.status === 'published' ? 'border-green-500 bg-green-50' : 'border-gray-100 hover:border-gray-200'">
                                        <i class="fas fa-check-circle" :class="form.status === 'published' ? 'text-green-500' : 'text-gray-300'"></i>
                                        <span class="text-xs font-extrabold uppercase tracking-widest" :class="form.status === 'published' ? 'text-green-700' : 'text-gray-400'">Publié</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center gap-4">
                            <button type="submit" :disabled="form.processing"
                                class="w-full py-4 bg-principal text-white rounded-2xl font-extrabold shadow-xl shadow-principal/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                                <i v-if="!form.processing" class="fas fa-save"></i>
                                <svg v-else class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                {{ isEditing ? 'Enregistrer les modifications' : 'Publier l\'article' }}
                            </button>
                            <Link :href="route('admin.blog.index')" class="w-full py-4 bg-white text-gray-500 border border-gray-100 rounded-2xl font-bold text-center hover:bg-gray-50 transition-colors">
                                Retour à la liste
                            </Link>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <Toast :show="showToast" :message="toastMessage" @close="showToast = false" />
    </AppLayout>
</template>
