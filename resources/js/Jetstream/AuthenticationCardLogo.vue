<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import img from "../../assets/img/Hysers.png";

</script>

<template>
    <Link :href="'/'">
    <img :src="img" alt="Hysers" class="w-full sm:max-w-md rounded">
    </Link>
</template>
