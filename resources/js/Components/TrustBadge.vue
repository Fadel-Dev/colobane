<script setup>
defineProps({
    verified: {
        type: Boolean,
        default: false
    },
    size: {
        type: String,
        default: 'md' // sm, md, lg
    }
});

const sizeClasses = {
    sm: 'w-4 h-4',
    md: 'w-5 h-5',
    lg: 'w-6 h-6'
};
</script>

<template>
    <div v-if="verified" class="inline-flex items-center" title="Propriétaire Vérifié">
        <div :class="['bg-blue-500 rounded-full flex items-center justify-center text-white shadow-sm', sizeClasses[size]]">
            <svg class="w-3/4 h-3/4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <span v-if="size === 'lg'" class="ml-2 text-sm font-bold text-blue-600">Vérifié</span>
    </div>
</template>
