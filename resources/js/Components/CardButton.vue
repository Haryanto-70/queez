<script setup>
import { ref, defineProps } from "vue";

defineProps({ buttonName: String });
</script>

<template>
    <div
        class="p-10 w-48 rounded-lg text-xl text-sky-100 font-semibold shadow hover:shadow-lg my-4 mx-2"
    >
        <button class="flex justify-center my-auto">
            {{ buttonName }}
        </button>
    </div>
</template>
