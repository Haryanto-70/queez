<script setup>
import { defineProps } from "vue";

defineProps({ serviceType: String, description: String });
</script>

<template>
    <div class="ml-2 mr-2 rounded-lg mb-2 hover:bg-red-300 px-6 py-2">
        <p
            class="flex justify-center items-center pt-3 text-slate-100 font-bold text-2xl"
        >
            {{ serviceType }}
        </p>
        <p
            class="flex justify-center items-center text-slate-300 font-bold text-md"
        >
            {{ description }}
        </p>
    </div>
</template>
