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
const queues = ref([]);
const dashboard = ref([]);
const logo = ref('/images/logo-puskesmas.png');
const advs1 = ref();
const advs2 = ref();
const advs3 = ref();
const advs4 = ref();
const advs5 = ref();
const advs6 = ref();
const advs7 = ref();
const datas = ref([]);
const time = ref();
const callReady = ref(true);
const callQueueNo = ref("-911");
const callDeskNo = ref(5);
const callQUuid = ref("AXAX");
const namapt = ref("PUSKESMAS CIBANGKONG BANDUNG");
const inCounter1 = ref("C001");
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
    getDashboard();

});

const getDashboard = async () => {
    try {
        const responses = await axios.get("display/dashboard");
        dashboard.value = responses.data[0];
        console.log('dashbaord', dashboard, dashboard.value.company_logo)
        namapt.value = dashboard.value.dashboard_name
        logo.value = "/images/" + dashboard.value.company_logo;
        advs1.value = "/images/advs/" + dashboard.value.image_1;
        advs2.value = "/images/advs/" + dashboard.value.image_2;
        advs3.value = "/images/advs/" + dashboard.value.image_3;
        advs4.value = "/images/advs/" + dashboard.value.image_4;

    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
}

const getResponse = async () => {
    try {
        const responses = await axios.get("dsiplay/queue ");
        queues.value = responses.data;
        inCounter1.value = queues.value.counterNo1;
        inCounter2.value = queues.value.counterNo2;
        inCounter3.value = queues.value.counterNo3;
        inCounter4.value = queues.value.counterNo4;
        inCounter5.value = queues.value.counterNo5;
        inCounter6.value = queues.value.counterNo6;
        callQueueNo.value = queues.value.callQNumber;
        callDeskNo.value = queues.value.callDeskNumber;
        callQUuid.value = queues.value.quuid;
        // console.log(
        //     "interval getQueue",
        //     callQueueNo.value,
        //     callDeskNo.value,
        //     callQUuid.value
        // );
        callQueue();
        count.value = count.value + 1;
    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
};

const getQueue = setInterval(() => {
    if (header.value == "Hallo") {
        getResponse();
    } else {
        header.value = "Hallo";
    }
}, 2000);

const getTime = setInterval(() => {
    let times = Date().toString();
    let index = times.indexOf("GMT") - 1;
    time.value = times.substring(0, index);
}, 1000);

const getAdvs = setInterval(() => {
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
}, 10000);

onUnmounted(() => {
    clearInterval(getQueue);
    clearInterval(getTime);
    clearInterval(getAdvs);

});

function onDisplay() {
    router.get("/dsiplay/queue");
}

const callNext = async (qUuid) => {
    try {
        const responses = await axios.put("queue/next/" + qUuid);
        callDeskNo.value = 0;
        callQueueNo.value = "----";
        // console.log(responses.data);


        callReady.value = true;
    } catch (error) {
        console.log("error", error);
    }
};

function callQueue() {
    let count = 0;
    let queue = callQueueNo.value;
    const char1 = queue[0];
    const char2 = queue[1];
    const char3 = queue[2];
    const char4 = queue[3];
    const deskNo = callDeskNo.value;
    const qUuid = callQUuid.value;
    // console.log("call queue");
    if (char1 == "-") {
        // console.log("no call");
        // console.log("wait for calling");
        return;
    }

    if (!callReady.value) {
        // console.log("calling sound");
        // console.log("wait for calling");
        return;
    }


    const callSound1 = soundAttention;
    const callSound2 = soundQueNo;
    let callSound3 = sound_A;
    let callSound4 = sound_0;
    let callSound5 = sound_1;
    let callSound6 = sound_2;
    const callSound7 = soundToCounter;
    let callSound8 = sound_1;
    const callSound9 = soundAttention;

    callReady.value = false;
    callSound1.load();
    callSound2.load();

    switch (char1) {
        case "A":
            callSound3 = sound_A;
            break;
        case "B":
            callSound3 = sound_B;
            break;
        case "C":
            callSound3 = sound_C;
            break;
        case "D":
            callSound3 = sound_D;
            break;

        default:
            callSound3 = sound_D;
            break;
    }

    callSound3.load();

    switch (char2) {
        case "0":
            callSound4 = sound_0;
            break;
        case "1":
            callSound4 = sound_1;
            break;
        case "2":
            callSound4 = sound_2;
            break;
        case "3":
            callSound4 = sound_3;
            break;
        case "4":
            callSound4 = sound_4;
            break;
        case "5":
            callSound4 = sound_5;
            break;
        case "6":
            callSound4 = sound_6;
            break;
        case "7":
            callSound4 = sound_7;
            break;
        case "8":
            callSound4 = sound_8;
            break;
        case "9":
            callSound4 = sound_9;
            break;

        default:
            callSound4 = sound_9;
            break;
    }

    callSound4.load();

    switch (char3) {
        case "0":
            callSound5 = sound_0;
            break;
        case "1":
            callSound5 = sound_1;
            break;
        case "2":
            callSound5 = sound_2;
            break;
        case "3":
            callSound5 = sound_3;
            break;
        case "4":
            callSound5 = sound_4;
            break;
        case "5":
            callSound5 = sound_5;
            break;
        case "6":
            callSound5 = sound_6;
            break;
        case "7":
            callSound5 = sound_7;
            break;
        case "8":
            callSound5 = sound_8;
            break;
        case "9":
            callSound5 = sound_9;
            break;

        default:
            callSound5 = sound_9;
            break;
    }

    callSound5.load();

    switch (char4) {
        case "0":
            callSound6 = sound_0;
            break;
        case "1":
            callSound6 = sound_1;
            break;
        case "2":
            callSound6 = sound_2;
            break;
        case "3":
            callSound6 = sound_3;
            break;
        case "4":
            callSound6 = sound_4;
            break;
        case "5":
            callSound6 = sound_5;
            break;
        case "6":
            callSound6 = sound_6;
            break;
        case "7":
            callSound6 = sound_7;
            break;
        case "8":
            callSound6 = sound_8;
            break;
        case "9":
            callSound6 = sound_9;
            break;

        default:
            callSound6 = sound_9;
            break;
    }

    callSound6.load();
    callSound7.load();

    switch (deskNo) {
        case 0:
            callSound8 = sound_0;
            break;
        case 1:
            callSound8 = sound_1;
            break;
        case 2:
            callSound8 = sound_2;
            break;
        case 3:
            callSound8 = sound_3;
            break;
        case 4:
            callSound8 = sound_4;
            break;
        case 5:
            callSound8 = sound_5;
            break;
        case 6:
            callSound8 = sound_6;
            break;
        case 7:
            callSound8 = sound_7;
            break;
        case 8:
            callSound8 = sound_8;
            break;
        case 9:
            callSound8 = sound_9;
            break;

        default:
            callSound8 = sound_10;
            break;
    }
    callSound8.load();
    callSound9.load();

    // console.log("Call Ready Status", callReady.value);



    callSound1.play(); // login
    setTimeout(function () {
        callSound2.load();
        callSound2.play(); // Call
    }, 4000);
    setTimeout(function () {
        callSound3.load();
        callSound3.play(); //A
    }, 6000);
    setTimeout(function () {
        callSound4.load(); //B
        callSound4.play(); //0
    }, 7200);
    setTimeout(function () {
        callSound5.load(); //C
        callSound5.play(); //1
    }, 8400);
    setTimeout(function () {
        callSound6.load(); //D
        callSound6.play(); //2
    }, 9600);
    setTimeout(function () {
        callSound7.play(); //to
    }, 10800);
    setTimeout(function () {
        callSound8.play(); //1
    }, 12800);
    setTimeout(function () {
        callSound9.play(); //closing
    }, 14000);
    setTimeout(function () {
        callNext(qUuid);
    }, 17000);


}
</script>

<template>
    <div class="h-svh">
        <div class="flex flex-col">
            <div class="flex flex-row justify-between px-5 my-2">
                <div class="flex flex-row items-center">
                    <img :src="logo" width="100px" alt="" />
                    <div>
                        <p class="text-cool-gray-800 text-2xl font-bold font-changa">
                            {{ namapt }}
                        </p>
                    </div>
                </div>
                <div class="text-cool-gray-800 text-2xl font-bold flex items-center">
                    {{ time }}
                </div>
            </div>
        </div>
        <div class="flex flex-row">
            <div class="">
                <img v-if="active1" :src="advs1" alt="advertising" style="width: 5400px; height: 650px" srcset="" />
                <img v-if="active2" :src="advs2" alt="advertising" style="width: 5400px; height: 650px" srcset="" />
                <img v-if="active3" :src="advs3" alt="advertising" style="width: 5400px; height: 650px" srcset="" />
                <img v-if="active4" :src="advs4" alt="advertising" style="width: 5400px; height: 650px" srcset="" />
            </div>
            <div class="w-full flex flex-col h-full mx-1">
                <div class="h-1/2">
                    <div
                        class="w-full bg-[#B60071] flex justify-center text-2xl mb-2 py-3 font-extrabold text-slate-100 rounded-t-lg">
                        Customer Service
                    </div>
                    <div class="flex flex-col">
                        <Queue :qNo="queues.cs1" class="flex justify-center" />
                        <Queue :qNo="queues.cs2" class="flex justify-center" />
                        <Queue :qNo="queues.cs3" class="flex justify-center" />
                        <Queue :qNo="queues.cs4" class="flex justify-center" />
                        <Queue :qNo="queues.cs5" class="flex justify-center" />
                    </div>
                </div>
                <div class="h-48">
                    <div
                        class="w-full bg-[#B60071] flex justify-center text-2xl mb-2 py-3 font-extrabold text-slate-100 rounded-t-lg">
                        Special Transaction
                    </div>
                    <div class="flex flex-col">
                        <Queue :qNo="queues.cs6" class="flex justify-center" />
                        <Queue :qNo="queues.cs7" class="flex justify-center" />
                        <Queue :qNo="queues.cs8" class="flex justify-center" />
                        <Queue :qNo="queues.cs9" class="flex justify-center" />
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-around items-center h-40">
            <div>
                <Counter cNo="01" :inService="inCounter1" class="bg-[#FF4C4C]" />
            </div>
            <div>
                <Counter cNo="02" :inService="inCounter2" class="bg-[#FFB22C]" />
            </div>
            <div>
                <Counter cNo="03" :inService="inCounter3" class="bg-[#FFDE4D]" />
            </div>
            <div>
                <Counter cNo="04" :inService="inCounter4" class="bg-[#F3FEB8]" />
            </div>
            <div>
                <Counter cNo="05" :inService="inCounter5" class="bg-[#73BBA3]" />
            </div>
            <div>
                <Counter @click="callQueue" cNo="06" :inService="inCounter6" class="bg-[#F6FB7A]" />
            </div>
        </div>
        <div v-if="toggle"
            class="fixed top-1/2 left-1/3 bg-slate-800 p-5 rounded-md border-light-100 border-2 shadow-yellow-500 hover:bg-red-500">
            <div @click="toggle = !toggle" class="text-white">
                <h1>OPEN QUEUEING DISPLAY CONFIRMED ?</h1>
                <h1>Click here !!</h1>
            </div>
        </div>
    </div>
</template>
