<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import Toast from '@/Components/Toast.vue';

const props = defineProps({
    posts: Object,
});

const showToast = ref(false);
const toastMessage = ref('');

const deletePost = (id) => {
    if (confirm('Voulez-vous vraiment supprimer cet article ?')) {
        router.delete(route('admin.blog.destroy', id), {
            onSuccess: () => {
                toastMessage.value = 'Article supprimé !';
                showToast.value = true;
            }
        });
    }
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('fr-FR', {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
    });
};
</script>

<template>
    <AppLayout title="Gestion Blog">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-bold text-2xl text-gray-900 flex items-center gap-3">
                    <i class="fas fa-newspaper text-principal"></i>
                    Gestion du Blog
                </h2>
                <Link :href="route('admin.blog.create')" class="bg-principal text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-principal/20 hover:scale-105 transition-transform flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Nouvel Article
                </Link>
            </div>
        </template>

        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 text-left">
                                    <th class="px-6 py-4 text-xs font-extrabold text-gray-400 uppercase tracking-widest">Article</th>
                                    <th class="px-6 py-4 text-xs font-extrabold text-gray-400 uppercase tracking-widest">Statut</th>
                                    <th class="px-6 py-4 text-xs font-extrabold text-gray-400 uppercase tracking-widest">Date</th>
                                    <th class="px-6 py-4 text-xs font-extrabold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <tr v-for="post in posts.data" :key="post.id" class="hover:bg-gray-50/50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                                                <img v-if="post.featured_image" :src="'/storage/' + post.featured_image" class="w-full h-full object-cover">
                                                <div v-else class="w-full h-full flex items-center justify-center text-gray-300">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-900 group-hover:text-principal transition-colors">{{ post.title }}</div>
                                                <div class="text-xs text-gray-400">Par {{ post.user.name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span :class="[
                                            'px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest',
                                            post.status === 'published' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700'
                                        ]">
                                            {{ post.status === 'published' ? 'Publié' : 'Brouillon' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 font-medium">
                                        {{ formatDate(post.created_at) }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <Link :href="route('admin.blog.edit', post.id)" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </Link>
                                            <button @click="deletePost(post.id)" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="posts.data.length === 0">
                                    <td colspan="4" class="px-6 py-20 text-center">
                                        <i class="fas fa-newspaper text-4xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">Aucun article trouvé.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="posts.links && posts.links.length > 3" class="mt-8 flex justify-center">
                    <div class="flex space-x-1">
                        <Link v-for="(link, index) in posts.links" :key="index"
                            :href="link.url || '#'"
                            class="px-4 py-2 rounded-xl text-sm font-bold transition-all"
                            :class="[
                                link.active ? 'bg-principal text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-50',
                                !link.url ? 'opacity-50 cursor-not-allowed' : ''
                            ]"
                            v-html="link.label">
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <Toast :show="showToast" :message="toastMessage" @close="showToast = false" />
    </AppLayout>
</template>
