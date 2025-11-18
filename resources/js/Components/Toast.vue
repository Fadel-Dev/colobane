<script setup>
import { ref, watch, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    },
    message: {
        type: String,
        default: ''
    },
    type: {
        type: String,
        default: 'success' // success, error, warning, info
    },
    duration: {
        type: Number,
        default: 3000 // Durée en millisecondes
    }
});

const emit = defineEmits(['close']);

const isVisible = ref(false);

const typeConfig = {
    success: {
        bg: 'bg-green-500',
        icon: 'bi-check-circle-fill',
        text: 'text-white'
    },
    error: {
        bg: 'bg-red-500',
        icon: 'bi-x-circle-fill',
        text: 'text-white'
    },
    warning: {
        bg: 'bg-yellow-500',
        icon: 'bi-exclamation-triangle-fill',
        text: 'text-white'
    },
    info: {
        bg: 'bg-blue-500',
        icon: 'bi-info-circle-fill',
        text: 'text-white'
    }
};

let timeoutId = null;

const close = () => {
    isVisible.value = false;
    setTimeout(() => {
        emit('close');
    }, 300); // Attendre la fin de l'animation
};

watch(() => props.show, (newVal) => {
    if (newVal) {
        isVisible.value = true;
        // Auto-fermer après la durée spécifiée
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        timeoutId = setTimeout(() => {
            close();
        }, props.duration);
    } else {
        isVisible.value = false;
    }
});

onUnmounted(() => {
    if (timeoutId) {
        clearTimeout(timeoutId);
    }
});
</script>

<template>
    <Teleport to="body">
        <Transition
            enter-active-class="transition ease-out duration-300"
            enter-from-class="opacity-0 translate-y-[-100%]"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition ease-in duration-300"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 translate-y-[-100%]"
        >
            <div
                v-if="show && isVisible"
                :class="[
                    'fixed top-4 right-4 z-[9999] min-w-[300px] max-w-md',
                    'rounded-xl shadow-2xl p-4 flex items-center gap-3',
                    typeConfig[type].bg,
                    typeConfig[type].text
                ]"
            >
                <!-- Icône -->
                <div class="flex-shrink-0">
                    <i :class="[typeConfig[type].icon, 'text-2xl']"></i>
                </div>
                
                <!-- Message -->
                <div class="flex-1">
                    <p class="font-semibold text-sm">{{ message }}</p>
                </div>
                
                <!-- Bouton fermer -->
                <button
                    @click="close"
                    class="flex-shrink-0 hover:opacity-80 transition-opacity"
                    aria-label="Fermer"
                >
                    <i class="bi bi-x-lg text-xl"></i>
                </button>
            </div>
        </Transition>
    </Teleport>
</template>

