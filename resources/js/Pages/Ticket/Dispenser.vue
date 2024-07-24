<script setup>
import CardButton from "./CardButton.vue";
import { ref, onMounted } from "vue";

const queueNo = ref();
const queue = ref([]);
const queprint = ref(true);

onMounted(() => {});

const getResponse = async (sId) => {
    queueprint();
    try {
        const responses = await axios.put("queue/" + sId);
        queue.value = responses.data;
        console.log("user data", queue);
    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
};

const layananA = async () => {
    console.log("layanan A");
    getResponse("A");
};
const layananB = async () => {
    console.log("layanan B");
    getResponse("B");
};
const layananC = async () => {
    console.log("layanan C");
    getResponse("C");
};
const layananD = async () => {
    console.log("layanan D");
    getResponse("D");
};

function queueprint() {
    queprint.value = !queprint.value;
}
</script>

<template>
    <div class="flex justify-center min-h-svh bg-[#F3FEB8] items-center">
        <div class="flex-col bg-[#FFB22C] w-2/5 rounded-xl">
            <h1 class="text-center text-2xl py-3 text-slate-900">
                TICKETING SYSTEM
            </h1>
            <div v-if="queprint">
                <h1 class="text-center text-4xl py-3 text-slate-900">
                    SILAHKAN PILIH LAYANAN
                </h1>

                <div class="mt-4">
                    <CardButton
                        class="mb-8"
                        @click="layananA"
                        serviceType="LAYANAN A"
                        desciption="layanan ini melingkupi abscd"
                    />
                    <CardButton
                        class="mb-8"
                        @click="layananB"
                        serviceType="LAYANAN B"
                        desciption="layanan ini melingkupi efgh"
                    />
                    <CardButton
                        class="mb-8"
                        @click="layananC"
                        serviceType="LAYANAN C"
                        desciption="layanan ini melingkupi opkl"
                    />
                    <CardButton
                        class="mb-8"
                        @click="layananD"
                        serviceType="LAYANAN D"
                        desciption="layanan ini melingkupi xyz"
                    />
                </div>
            </div>

            <div
                class="flex-col justify-center bg-green-400 py-12"
                v-if="!queprint"
            >
                <div class="text-center"><h1>NO ANTRIAN ANDA</h1></div>
                <div class="text-7xl font-bold text-center">
                    {{ queue.queue_no }}
                </div>
                <div class="text-center pt-8">SILAHKAN MENUNGGU</div>
                <div
                    @click="queueprint"
                    class="text-center bg-red-700 hover:bg-red-500 text-sky-100 mx-auto w-40 mt-4 text-4xl p-2"
                >
                    <h2>CETAK</h2>
                </div>
            </div>
        </div>
    </div>
</template>
