<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref, onUnmounted, onMounted } from "vue";
import Counter from "./Counter.vue";
import Queue from "./Queue.vue";

axios.defaults.baseURL = "http://127.0.0.1:8000/";
const header = ref("Hallo");
const header2 = ref("Hallo-2");
const count = ref(0);
const users = ref([]);
const datas = ref([]);
const time = ref();
const namapt = ref("PT. BANK RAKYAT INDONESIA");
const inCounter1 = ref("A001");
const inCounter2 = ref("A002");
const inCounter3 = ref("A003");
const inCounter4 = ref("B001");
const inCounter5 = ref("B002");
const inCounter6 = ref("----");
let ads = 4;
const imageAds = ref();
const linkAds = "images/advs/advs1.png";
const active1 = ref(true);
const active2 = ref(false);
const active3 = ref(false);
const active4 = ref(false);
let sound_0 = new Audio("audio/queue/0.wav");
let sound_1 = new Audio("audio/queue/1.wav");
let sound_2 = new Audio("audio/queue/2.wav");
let sound_3 = new Audio("audio/queue/3.wav");
let sound_4 = new Audio("audio/queue/4.wav");
let sound_5 = new Audio("audio/queue/5.wav");
let sound_6 = new Audio("audio/queue/6.wav");
let sound_7 = new Audio("audio/queue/7.wav");
let sound_8 = new Audio("audio/queue/8.wav");
let sound_9 = new Audio("audio/queue/9.wav");
let sound_10 = new Audio("audio/queue/10.wav");
let sound_11 = new Audio("audio/queue/11.wav");
let sound_12 = new Audio("audio/queue/12.wav");
let sound_13 = new Audio("audio/queue/13.wav");
let sound_14 = new Audio("audio/queue/14.wav");
let sound_A = new Audio("audio/queue/A.wav");
let sound_B = new Audio("audio/queue/B.wav");
let sound_C = new Audio("audio/queue/C.wav");
let sound_D = new Audio("audio/queue/D.wav");
let sound_E = new Audio("audio/queue/E.wav");
let soundLogin = new Audio("audio/queue/loginsound.mp3");
let soundAttention = new Audio("audio/queue/attention.mp3");
let soundToCounter = new Audio("audio/queue/tocounter.wav");
let soundQueNo = new Audio("audio/queue/queueno.wav");
let soundAtCounter = new Audio("audio/queue/di-counter.wav");
const toggle = ref(true);

onMounted(() => {
    getResponse();
});

const getResponse = async () => {
    try {
        const responses = await axios.get("users ");
        users.value = responses.data;
        console.log("interval 2 2 Display");
        header.value = "READ DATABASE";
        count.value = count.value + 1;
    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
};

setInterval(() => {
    if (header.value == "Hallo") {
        getResponse();
    } else {
        header.value = "Hallo";
    }
}, 2000);

setInterval(() => {
    let times = Date().toString();
    let index = times.indexOf("GMT") - 1;
    time.value = times.substring(0, index);
}, 1000);

setInterval(() => {
    active1.value = false;
    active2.value = false;
    active3.value = false;
    active4.value = false;
    switch (ads) {
        case 1:
            active1.value = true;
            active2.value = false;
            active3.value = false;
            active4.value = false;
            ads = 0;
            break;
        case 2:
            active2.value = true;
            active1.value = false;

            active3.value = false;
            active4.value = false;
            break;
        case 3:
            active3.value = true;
            active1.value = false;
            active2.value = false;

            active4.value = false;
            break;
        case 4:
            active4.value = true;
            break;

        default:
            active1.value = true;
            active1.value = false;
            active2.value = false;
            active3.value = false;
            break;
    }
    ads--;
    ads = ads <= 0 ? 4 : ads;
    console.log("ads no: ", ads);
    //soundAttention.play();
    if (soundAttention.ended) {
        soundToCounter.play();
        sound_12.play();
    }
}, 10000);

onUnmounted(() => {
    clearInterval();
    console.log("on Unmounted");
});

function onDisplay() {
    router.get("/dsiplay");
}
</script>

<template>
    <div class="h-svh">
        <div class="flex flex-col">
            <div class="flex flex-row justify-between px-5 my-2">
                <div class="flex flex-row items-center">
                    <img src="/images/logobri.JPEG" width="100px" alt="" />
                    <div>
                        <p class="text-light-200 text-2xl">{{ namapt }}</p>
                    </div>
                </div>
                <div
                    class="text-slate-800 text-2xl font-bold flex items-center"
                >
                    {{ time }}
                </div>
            </div>
        </div>
        <div class="flex flex-row">
            <div class="">
                <img
                    v-if="active1"
                    src="images/advs/advs1.png"
                    alt="advertising"
                    style="width: 5400px; height: 650px"
                    srcset=""
                />
                <img
                    v-if="active2"
                    src="images/advs/advs2.png"
                    alt="advertising"
                    style="width: 5400px; height: 650px"
                    srcset=""
                />
                <img
                    v-if="active3"
                    src="images/advs/advs3.png"
                    alt="advertising"
                    style="width: 5400px; height: 650px"
                    srcset=""
                />
                <img
                    v-if="active4"
                    src="images/advs/advs4.png"
                    alt="advertising"
                    style="width: 5400px; height: 650px"
                    srcset=""
                />
            </div>
            <div class="w-full flex flex-col h-full mx-1">
                <div class="h-1/2">
                    <div
                        class="w-full bg-orange-500 flex justify-center text-2xl mb-2 py-3 font-extrabold text-slate-100 rounded-t-lg"
                    >
                        Customer Service
                    </div>
                    <div class="flex flex-col">
                        <Queue qNo="A001" class="flex justify-center" />
                        <Queue qNo="A001" class="flex justify-center" />
                        <Queue qNo="A001" class="flex justify-center" />
                        <Queue qNo="A001" class="flex justify-center" />
                        <Queue qNo=" " class="flex justify-center" />
                    </div>
                </div>
                <div class="h-48">
                    <div
                        class="w-full bg-orange-500 flex justify-center text-2xl mb-2 py-3 font-extrabold text-slate-100 rounded-t-lg"
                    >
                        Special Transaction
                    </div>
                    <div class="flex flex-col">
                        <Queue qNo="B001" class="flex justify-center" />
                        <Queue qNo="B001" class="flex justify-center" />
                        <Queue qNo="B001" class="flex justify-center" />
                        <Queue qNo="B001" class="flex justify-center" />
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-around items-center h-40">
            <div>
                <Counter
                    cNo="01"
                    :inService="inCounter1"
                    class="bg-[#FF4C4C]"
                />
            </div>
            <div>
                <Counter
                    cNo="02"
                    :inService="inCounter2"
                    class="bg-[#FFB22C]"
                />
            </div>
            <div>
                <Counter
                    cNo="03"
                    :inService="inCounter3"
                    class="bg-[#FFDE4D]"
                />
            </div>
            <div>
                <Counter
                    cNo="04"
                    :inService="inCounter4"
                    class="bg-[#F3FEB8]"
                />
            </div>
            <div>
                <Counter
                    cNo="05"
                    :inService="inCounter5"
                    class="bg-[#73BBA3]"
                />
            </div>
            <div>
                <Counter
                    cNo="06"
                    :inService="inCounter6"
                    class="bg-[#F6FB7A]"
                />
            </div>
        </div>
        <div
            v-if="toggle"
            class="fixed top-1/2 left-1/3 bg-slate-800 p-5 rounded-md border-light-100 border-2 shadow-yellow-500 hover:bg-red-500"
        >
            <div @click="toggle = !toggle" class="text-white">
                <h1>OPEN QUEUEING DSIPLAY CONFIRMED ?</h1>
                <h1>Click here !!</h1>
            </div>
        </div>
    </div>
</template>
