<script setup>
import { defineProps } from "vue";

defineProps({ cNo: String, inService: String });
</script>

<template>
    <div class="">
        <div class="w-56 h-36 py-4 rounded-lg">
            <p class="text-2xl flex justify-center font-bold">
                COUNTER {{ cNo }}
            </p>
            <div class="text-7xl p-4 flex justify-center items-center">
                {{ inService }}
            </div>
        </div>
    </div>
</template>
