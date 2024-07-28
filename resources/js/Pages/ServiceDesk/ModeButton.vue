<script setup>
import { defineProps } from "vue";

defineProps({ serviceType: String, description: String });
</script>

<template>
    <div class="ml-2 mr-2 rounded-lg mb-2 px-6 py-2">
        <p
            class="flex justify-center items-center pt-3 text-cool-gray-800 font-bold text-lg"
        >
            {{ serviceType }}
        </p>
        <p
            class="flex justify-center items-center text-gray-500 font-bold text-sm"
        >
            {{ description }}
        </p>
    </div>
</template>
