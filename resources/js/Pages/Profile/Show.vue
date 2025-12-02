<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});

const activeSection = ref('profile');

const sections = [
    {
        id: 'profile',
        label: 'Informations personnelles',
        icon: 'user',
        color: 'blue',
    },
    {
        id: 'password',
        label: 'Mot de passe',
        icon: 'lock',
        color: 'green',
    },
    {
        id: 'security',
        label: 'Sécurité',
        icon: 'shield',
        color: 'purple',
    },
    {
        id: 'sessions',
        label: 'Sessions',
        icon: 'devices',
        color: 'orange',
    },
    {
        id: 'danger',
        label: 'Zone de danger',
        icon: 'alert',
        color: 'red',
    },
];
</script>

<template>
    <AppLayout title="Mon Profil">
        <div class="min-h-screen bg-gray-50">
            <!-- Header Section Premium -->
            <div class="relative overflow-hidden bg-gradient-to-r from-principal via-principal/98 to-secondaire py-12 sm:py-16">
                <!-- Background patterns -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
                </div>

                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                        <div>
                            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-2">
                                Mon Profil
                            </h1>
                            <p class="text-white/80 text-lg">
                                Gérez vos informations personnelles et vos paramètres de sécurité
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <img 
                                :src="$page.props.auth.user.profile_photo_url" 
                                :alt="$page.props.auth.user.name"
                                class="w-20 h-20 rounded-xl object-cover border-4 border-white shadow-lg"
                            >
                            <div class="text-white">
                                <p class="font-bold text-lg">{{ $page.props.auth.user.name }}</p>
                                <p class="text-white/80 text-sm">{{ $page.props.auth.user.email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <!-- Sidebar Navigation -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                            <nav class="space-y-1 p-4">
                                <button
                                    v-for="section in sections"
                                    :key="section.id"
                                    @click="activeSection = section.id"
                                    :class="[
                                        'w-full text-left px-4 py-3.5 rounded-lg font-medium transition-all duration-300 flex items-center space-x-3',
                                        activeSection === section.id
                                            ? 'bg-principal/10 text-principal border-l-4 border-principal'
                                            : 'text-gray-700 hover:bg-gray-50'
                                    ]"
                                >
                                    <svg v-if="section.icon === 'user'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <svg v-else-if="section.icon === 'lock'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <svg v-else-if="section.icon === 'shield'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <svg v-else-if="section.icon === 'devices'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 00-2 2m2-2a2 2 0 002 2m-2-2h4m0 0a2 2 0 002-2m-2 2a2 2 0 00-2-2m2-2h4m0 0V7a2 2 0 00-2-2m2 2a2 2 0 00-2-2" />
                                    </svg>
                                    <svg v-else-if="section.icon === 'alert'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 5v1m7-7l-3 3m0 0l-3 3m3-3l-3-3m3 3l3-3" />
                                    </svg>
                                    <span>{{ section.label }}</span>
                                </button>
                            </nav>
                        </div>
                    </div>

                    <!-- Content Area -->
                    <div class="lg:col-span-3">
                        <!-- Profile Information -->
                        <div v-show="activeSection === 'profile' && $page.props.jetstream.canUpdateProfileInformation" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 animate-fadeIn">
                            <UpdateProfileInformationForm :user="$page.props.auth.user" />
                        </div>

                        <!-- Password Update -->
                        <div v-show="activeSection === 'password' && $page.props.jetstream.canUpdatePassword" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 animate-fadeIn">
                            <UpdatePasswordForm />
                        </div>

                        <!-- Two Factor Authentication -->
                        <div v-show="activeSection === 'security' && $page.props.jetstream.canManageTwoFactorAuthentication" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 animate-fadeIn">
                            <TwoFactorAuthenticationForm
                                :requires-confirmation="confirmsTwoFactorAuthentication"
                            />
                        </div>

                        <!-- Logout Other Sessions -->
                        <div v-show="activeSection === 'sessions'" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 animate-fadeIn">
                            <LogoutOtherBrowserSessionsForm :sessions="sessions" />
                        </div>

                        <!-- Delete Account -->
                        <div v-show="activeSection === 'danger' && $page.props.jetstream.hasAccountDeletionFeatures" class="bg-white rounded-2xl shadow-sm border-2 border-red-200 p-8 animate-fadeIn">
                            <DeleteUserForm />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
}
</style>
