<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <img src="yayasan.png" width="120" alt="yayasan logo" />
            <!-- <Link href="yayasan.png">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link> -->
        </div>

        <div class="w-full sm:max-w-md mt-6    dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
