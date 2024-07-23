<script setup>
import { defineProps } from "vue";

defineProps({ serviceType: String, desciption: String });
</script>

<template>
    <div class="bg-red-600 ml-8 mr-8 rounded-lg mb-2 hover:bg-red-300">
        <p
            class="flex justify-center items-center pt-3 text-slate-100 font-bold text-2xl"
        >
            {{ serviceType }}
        </p>
        <p
            class="flex justify-center items-center text-slate-300 font-bold text-lg"
        >
            {{ desciption }}
        </p>
    </div>
</template>
