<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    title: String,
    hideLogo: Boolean,
});
</script>

<template>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Logo Section -->
        <div v-if="!hideLogo" class="flex w-1/2 items-center justify-center bg-white">
            <Link href="/">
                <ApplicationLogo class="h-32 w-32 fill-current text-gray-500" />
            </Link>
        </div>
        <!-- Content Section -->
        <div class=" sm:w-1/2">
            <div class="mx-auto w-full max-w-md overflow-hidden bg-white">
                <h2 v-if="title" class="mb-4 text-center text-xl font-semibold text-gray-700">
                    {{ title }}
                </h2>
                <slot />
            </div>
            <div class="mx-auto mt-4 w-full max-w-md">
                <slot name="footer" />
            </div>
        </div>
    </div>
</template>
