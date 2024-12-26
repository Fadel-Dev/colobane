<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link :href="'/'">
    <!-- <span>  </span> -->
    <router-link to="/publier" class="text-2xl text-principal"></router-link>
    <img class="w-2/4 mx-auto lg:mx-auto  mx-auto lg:mx-0  p-1" :src="'/storage/slide/NoflayHub.png'" alt="Image logo">

    </Link>
</template>
