<script setup>
import { defineProps } from "vue";

defineProps({ serviceType: String, desciption: String });
</script>

<template>
    <div class="bg-[#FF4C4C] ml-8 mr-8 rounded-lg mb-2 hover:bg-red-300">
        <p
            class="flex justify-center items-center pt-3 text-cool-gray-800 font-bold text-2xl"
        >
            {{ serviceType }}
        </p>
        <p
            class="flex justify-center items-center text-red-200 font-bold text-lg"
        >
            {{ desciption }}
        </p>
    </div>
</template>
