<script setup>
import { defineProps } from "vue";

defineProps({ serviceType: String, desciption: String });
</script>

<template>
    <div class="bg-[#e9db7f] ml-8 mr-8 rounded-lg mb-2 hover:bg-red-300">
        <p
            class="flex justify-center items-center pt-3 text-cool-gray-800 font-bold text-2xl font-sans"
        >
            {{ serviceType }}
        </p>
        <p
            class="flex justify-center items-center text-cool-gray-100 text-lg font-sans"
        >
            {{ desciption }}
        </p>
    </div>
</template>
