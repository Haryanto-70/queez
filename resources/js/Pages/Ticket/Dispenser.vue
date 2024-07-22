<script setup>
import CardButton from "./CardButton.vue";
</script>

<template>
    <div class="flex justify-center min-h-svh bg-yellow-600 items-center">
        <div class="flex-col bg-yellow-100 w-2/5 rounded-xl">
            <h1 class="text-center text-2xl py-3">TICKETING SYSTEM</h1>
            <h1 class="text-center text-4xl py-3">SILAHKAN PILIH LAYANAN</h1>
            <div>
                <CardButton
                    serviceType="LAYANAN A"
                    desciption="layanan ini melingkupi abscd"
                />
                <CardButton
                    serviceType="LAYANAN B"
                    desciption="layanan ini melingkupi efgh"
                />
                <CardButton
                    serviceType="LAYANAN C"
                    desciption="layanan ini melingkupi opkl"
                />
                <CardButton
                    serviceType="LAYANAN D"
                    desciption="layanan ini melingkupi xyz"
                />
            </div>
        </div>
    </div>
</template>
