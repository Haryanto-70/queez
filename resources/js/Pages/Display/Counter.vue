<script setup>
import { defineProps } from "vue";

defineProps({ cNo: String, inService: String });
</script>

<template>
    <div class="rounded-lg">
        <div class="w-56 h-36 py-4">
            <p
                class="text-2xl flex justify-center font-bold text-cool-gray-800"
            >
                COUNTER {{ cNo }}
            </p>
            <div
                class="text-7xl p-4 flex justify-center items-center text-cool-gray-800"
            >
                {{ inService }}
            </div>
        </div>
    </div>
</template>
