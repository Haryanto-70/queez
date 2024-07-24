<script setup>
import { defineProps } from "vue";

defineProps({ qNo: String });
</script>

<template>
    <div>
        <div
            class="flex w-56 bg-[#EB5B00] py-2 text-center rounded-md mb-2 h-12"
        >
            <p class="text-2xl flex mx-auto font-bold text-dark-50">
                {{ qNo }}
            </p>
        </div>
    </div>
</template>
