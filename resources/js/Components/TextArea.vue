<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    rows: {
        type: [String, Number],
        default: 3
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <textarea
        ref="input"
        class="border-gray-300 focus:border-principal focus:ring-principal rounded-md shadow-sm"
        :value="modelValue"
        :rows="rows"
        @input="$emit('update:modelValue', $event.target.value)"
    ></textarea>
</template>
