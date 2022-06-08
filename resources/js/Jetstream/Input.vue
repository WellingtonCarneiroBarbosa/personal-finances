<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    invalid: {
        type: String,
        default: '',
    },
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
    <input ref="input" :value="modelValue"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        v-bind:class="{ 'border-red-600 focus:border-red-600 focus:ring-red-500': invalid }"
        @input="$emit('update:modelValue', $event.target.value)">
</template>
