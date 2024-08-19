<script setup>
import CardButton from "./CardButton.vue";
import { ref, onMounted } from "vue";

const queueNo = ref();
const queue = ref([]);
const queprint = ref(true);
const dispencers = ref([]);

onMounted(() => {
    getListLayanan();
});

const getListLayanan = async () => {

    try {
        const responses = await axios.get("dispencers");
        dispencers.value = responses.data;
        console.log("dispencers", dispencers);
    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
};


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

const takeTicket = async ($id) => {

    switch ($id) {
        case 'layanan1':
            layanan1();
            break;
        case 'layanan2':
            layanan2();
            break;
        case 'layanan3':
            layanan3();
            break;
        case 'layanan4':
            layanan4();
            break;
        case 'layanan5':
            layanan5();
            break;
        case 'layanan6':
            layanan6();
            break;
        case 'layanan7':
            layanan7();
            break;


        default:
            break;
    }

}

const layanan1 = async () => {
    console.log("layanan A");
    getResponse("A");
};
const layanan2 = async () => {
    console.log("layanan B");
    getResponse("B");
};
const layanan3 = async () => {
    console.log("layanan C");
    getResponse("C");
};
const layanan4 = async () => {
    console.log("layanan D");
    getResponse("D");
};
const layanan5 = async () => {
    console.log("layanan E");
    getResponse("E");
};
const layanan6 = async () => {
    console.log("layanan F");
    getResponse("F");
};
const layanan7 = async () => {
    console.log("layanan G");
    getResponse("G");
};


function queueprint() {
    queprint.value = !queprint.value;
}
</script>

<template>
    <div class="flex justify-center min-h-svh items-center">
        <img id="background" class="absolute w-screen -z-10" src="images/dispenser.png" />
        <div class="flex-col bg-[#2a6fa0] w-2/5 rounded-xl shadow-lg shadow-[#698aa1]">
            <h1 class="text-center text-2xl py-3 text-slate-200 font-sans">
                TICKETING SYSTEM
            </h1>
            <div v-if="queprint">
                <h1 class="text-center text-4xl py-3 text-slate-200 font-sans">
                    SILAHKAN PILIH LAYANAN
                </h1>

                <div class="mt-4">

                    <div v-for="(item, index) of dispencers">
                        <CardButton class="mb-8" @click="takeTicket(item.service_list)" :serviceType="item.name"
                            :desciption="item.detail" />

                    </div>
                    <!-- 
                    <CardButton class="mb-8" @click="layanan1" serviceType="LAYANAN A"
                        desciption="Layanan Rawat Inap,Rawat Jalan,Bedah,UGD " />
                    <CardButton class="mb-8" @click="layanan2" serviceType="LAYANAN B"
                        desciption="Layanan Laboratorium,Layanan Radiologi" />
                    <CardButton class="mb-8" @click="layanan3" serviceType="LAYANAN C"
                        desciption="Layanan Rehabilitasi,Layanan Psikologi/Psikiatri" />
                    <CardButton class="mb-8" @click="layanan4" serviceType="LAYANAN D"
                        desciption="Layanan Farmasi,Layanan Gizi" /> -->
                </div>
            </div>

            <div class="flex-col justify-center bg-green-400 py-12" v-if="!queprint">
                <div class="text-center">
                    <h1>NO ANTRIAN ANDA</h1>
                </div>
                <div class="text-7xl font-bold text-center">
                    {{ queue.queue_no }}
                </div>
                <div class="text-center pt-8">SILAHKAN MENUNGGU</div>
                <div @click="queueprint"
                    class="text-center bg-red-700 hover:bg-red-500 text-sky-100 mx-auto w-40 mt-4 text-4xl p-2">
                    <h2>CETAK</h2>
                </div>
            </div>
        </div>
    </div>
</template>
