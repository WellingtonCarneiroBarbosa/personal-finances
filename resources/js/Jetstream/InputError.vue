<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm mt-1 text-red-600">
            {{ message }}
        </p>
    </div>
</template>
