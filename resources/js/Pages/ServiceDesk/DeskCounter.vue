<script setup>
import { defineProps, onMounted, ref } from "vue";
import { Head, router } from "@inertiajs/vue3";
import ModeButton from "./ModeButton.vue";

axios.defaults.baseURL = "http://127.0.0.1:8000/";

const header = ref();
const queues = ref([]);
const queueNo = ref({});
const users = ref([]);
const deskNo = ref();
const status = ref('')
const selectView = ref(true);
const viewNext = ref(true);
const viewCall = ref(false);
const viewStart = ref(false);
const viewPause = ref(false);
const viewStop = ref(false);
const viewCancel = ref(false);

onMounted(() => {
    getResponse();
    getResponse2("all");
    console.log('on mounted Desk', queues.value);
    // if (queues.value.queue_no == "---") {

    //     selectView.value = false;
    // } else {
    //     selectView.value = true;
    // }
});

const getResponse = async (type) => {
    try {
        const responses = await axios.get("userdesk");
        users.value = responses.data[0];
        queueNo.value = users.value.queue_no
        console.log("user data", users, queueNo.value);

        // status.value = 'new'

        if (queueNo.value != "----") {
            selectView.value = false;



        } else {
            selectView.value = true;

        }

        // if (status.value == "call") {
        //     status.value = 'start'
        // }

        playView();

    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
};

const getResponse2 = async (type) => {
    try {
        const responses = await axios.get("userdesk/queue/" + type);
        queues.value = responses.data;
        console.log("queue data", queues);
    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
};
const getResponse3 = async (type) => {
    try {
        const responses = await axios.put("userdesk/select/" + type);
        // queues.value = responses.data;
        // console.log("queue data", queues);
        getResponse();
        getResponse2('all');
    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
};

const getResponse4 = async (type) => {
    try {
        const responses = await axios.put("userdesk/calling/" + type);
        // queues.value = responses.data;
        // console.log("queue data", queues);

    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
};

const getResponseFinished = async (type) => {
    try {
        const responses = await axios.put("userdesk/finished/" + type);
        // queues.value = responses.data;
        // console.log("queue data", queues);

    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
};

const getResponseCancel = async (qNo) => {
    try {
        const responses = await axios.put("userdesk/quecancel/" + qNo);
        // queues.value = responses.data;
        // console.log("queue data", queues);

    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
};

const getResponseStart = async (qNo) => {
    try {
        const responses = await axios.put("userdesk/questart/" + qNo);
        console.log('response start', responses.data)

        if (responses.data >= 1) {
            status.value = 'started'
        } else {
            alert('Wait for Calling Queue Number ')
        }
        // queues.value = responses.data;
        // console.log("queue data", queues);

    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
};

const getExitDesk = async () => {
    try {
        await axios.get("userdesk/exitdesk");
        // queues.value = responses.data;
        // console.log("queue data", queues);

    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
};



function serviceList(type) {
    getResponse2(type);
}

function say(uuid) {
    console.log(uuid[0])
    getResponse3(uuid[0])
    hideSelect();
    status.value = 'call'
    playView();
}

function callingQueue(qNo) {
    if (status.value == 'call') {
        console.log(qNo);
        getResponse4(qNo);
        getResponse();
        getResponse2('all');
        status.value = 'start'
    } else {
        alert('please select ')
    }
}

function hideSelect() {

    selectView.value = !selectView.value
}

function playView() {
    console.log('status value:', status.value)
    if (status.value == 'call') {
        viewNext.value = false
        viewCall.value = true
        viewStart.value = false
        viewPause.value = false
        viewStop.value = false
        viewCancel.value = true
    } else if (status.value = 'start') {
        viewNext.value = false
        viewCall.value = false
        viewStart.value = true
        viewPause.value = true
        viewStop.value = true
        viewCancel.value = false
    } else if (status.value = 'paused') {
        viewNext.value = false
        viewCall.value = false
        viewStart.value = false
        viewPause.value = true
        viewStop.value = true
        viewCancel.value = false
    } else if (status.value = 'stop') {
        viewNext.value = true
        viewStart.value = false
        viewPause.value = false
        viewStop.value = false
        viewCancel.value = false
    } else {
        viewNext.value = true
        viewStart.value = false
        viewPause.value = false
        viewStop.value = false
        viewCancel.value = false
    }
}

function startedQueue(qNo) {
    console.log(status.value)
    if (status.value == 'start') {
        getResponseStart(qNo);

    } else {
        alert('please start')
    }
}

function pausedQueue(qNo) {
    console.log(status.value)
    if (status.value == 'started') {


        // getResponse();


        status.value = 'paused'
    } else {
        alert('please start')
    }
}
function canceledQueue(qNo) {
    console.log(status.value)
    if (status.value == 'call') {

        hideSelect();
        getResponseCancel(qNo);
        // getResponse();

        getResponse2('all');
        getResponse5(qNo);
        queueNo.value = "----"
        status.value = ''
        // getResponse();



    } else {
        alert('please start')
    }
}

function finishedQueue(qNo) {

    console.log(status.value)

    if (status.value == 'started') {
        hideSelect();

        // getResponse();
        getResponse2('all');
        getResponseFinished(qNo);
        queueNo.value = "----"
        status.value = ''
    } else {
        alert('please start')
    }
}

function exitDesk() {
    console.log('exit desk')
    router.get("/userdesk/exitdesk");

}

</script>

<template>
    <div class=" bg-gradient-to-r from-[#4638bd] to-[#070136] h-screen">

        <div class="fixed top-7 flex w-3/4">

            <div class="col col-span-10 flex flex-row ">

                <div class=" ml-2 mr-2 rounded-lg mb-2 h-32 0 px-6 py-2 bg-[#FFDE4D] border-[#FF4C4C] border-2">
                    <p class="flex justify-start items-center pt-3 text-cool-gray-800 font-bold text-2xl">
                        DESK COUNTER:
                    <p class="text-yellow-700 mx-auto">{{ users.desk_no }} </p>
                    </p>
                    <p class="flex justify-start items-center pt-3 text-cool-gray-800 font-bold text-2xl">
                        USER NAME :
                    <p class="text-yellow-700">{{ users.name }}</p>
                    </p>
                </div>
                <div
                    class="flex flex-col   items-center p-4 text-xl border-2 w-80 h-32 rounded-lg border-dark-500 bg-[#FFDE4D] border-[#FF4C4C]">
                    <p class="flex items-center">QUEUE NUMBER :</p>
                    <p class="font-bold text-7xl flex items-center text-yellow-700 ml-2">
                        {{ queueNo }}
                    </p>
                </div>
                <div>
                    <p>Status : {{ status }}</p>
                </div>
            </div>
            <div class="flex flex-col col-span-2   m-4 fixed right-0 bottom-12 rounded-lg">
                <div class="">
                    <div v-if="!selectView" class="">
                        <div v-if="viewNext"
                            class="flex p-4 m-2 text-md border-2 w-48 mx-2 py-2 rounded-lg border-dark-500 items-center bg-[#FF4C4C] hover:bg-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-8 text-sky-50">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811V8.69ZM12.75 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061a1.125 1.125 0 0 1-1.683-.977V8.69Z" />
                            </svg>

                            <div class="flex w-24 ml-2">
                                <p class="flex text-center font-bold mx-auto text-sky-50">
                                    NEXT QUE
                                </p>
                            </div>
                        </div>
                        <div @click="callingQueue(users.queue_no)" v-if="viewCall"
                            class="flex p-4 m-2 text-md border-2 w-48 mx-2 py-2 rounded-lg border-dark-500 items-center bg-[#FF4C4C] hover:bg-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-8 text-sky-50">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>

                            <div class="flex w-24 ml-2">
                                <p class="flex text-center font-bold mx-auto text-sky-50">
                                    CALL
                                </p>
                            </div>
                        </div>
                        <div @click="startedQueue(users.queue_no)" v-if="viewStart"
                            class="flex p-4 m-2 text-md border-2 w-48 mx-2 py-2 rounded-lg border-dark-500 items-center bg-[#FF4C4C] hover:bg-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-8 text-sky-50">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 7.5V18M15 7.5V18M3 16.811V8.69c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811Z" />
                            </svg>

                            <div class="flex w-24 ml-2">
                                <p class="flex text-center font-bold mx-auto text-sky-50">
                                    START
                                </p>
                            </div>
                        </div>
                        <div @click="pausedQueue(users.queue_no)" v-if="viewPause"
                            class="flex p-4 m-2 text-md border-2 w-48 mx-2 py-2 rounded-lg border-dark-500 items-center bg-[#FF4C4C] hover:bg-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-8 text-sky-50">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            <div class="flex w-24 ml-2">
                                <p class="flex text-center font-bold mx-auto text-sky-50">
                                    PAUSED
                                </p>
                            </div>
                        </div>
                        <div @click="finishedQueue(users.queue_no)" v-if="viewStop"
                            class="flex p-4 m-2 text-md border-2 w-48 mx-2 py-2 rounded-lg border-dark-500 items-center bg-[#FF4C4C] hover:bg-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-8 text-sky-50">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 9.563C9 9.252 9.252 9 9.563 9h4.874c.311 0 .563.252.563.563v4.874c0 .311-.252.563-.563.563H9.564A.562.562 0 0 1 9 14.437V9.564Z" />
                            </svg>

                            <div class="flex w-24 ml-2">
                                <p class="flex text-center font-bold mx-auto text-sky-50">
                                    STOP
                                </p>
                            </div>
                        </div>
                        <div @click="canceledQueue(users.queue_no)" v-if="viewCancel"
                            class="flex p-4 m-2 text-md border-2 w-48 mx-2 py-2 rounded-lg border-dark-500 items-center bg-[#FF4C4C] hover:bg-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-8 text-sky-50">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            <div class="flex w-24 ml-2">
                                <p class="flex text-center font-bold mx-auto text-sky-50">
                                    CANCEL
                                </p>
                            </div>
                        </div>


                    </div>
                    <div v-if="selectView" @click="exitDesk"
                        class="flex p-4 m-2 text-md border-2 w-48 mx-2 py-2 rounded-lg border-dark-500 items-center bg-[#196a23] hover:bg-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8 text-sky-50">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        <div class="flex w-24 ml-2">
                            <p class="flex text-center font-bold mx-auto text-sky-50">
                                EXIT
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="col-span-2 ">
                <div class="pt-48">
                    <div class="flex flex-row">
                        <ModeButton @click="serviceList('all')" serviceType="SHOW ALL"
                            description="layanan ini melingkupi semua"
                            class="bg-[#FFB22C] hover:bg-[#d8a245] hover:text-sky-50" />
                        <ModeButton @click="serviceList('A')" serviceType="LAYANAN A"
                            description="layanan ini melingkupi abscd"
                            class="bg-[#FFB22C] hover:bg-[#d8a245] hover:text-sky-50" />
                        <ModeButton @click="serviceList('B')" serviceType="LAYANAN B"
                            description="layanan ini melingkupi efgh"
                            class="bg-[#FFB22C] hover:bg-[#d8a245] hover:text-sky-50" />
                        <ModeButton @click="serviceList('C')" serviceType="LAYANAN C"
                            description="layanan ini melingkupi opkl"
                            class="bg-[#FFB22C] hover:bg-[#d8a245] hover:text-sky-50" />
                        <ModeButton @click="serviceList('D')" serviceType="LAYANAN D"
                            description="layanan ini melingkupi xyz"
                            class="bg-[#FFB22C] hover:bg-[#d8a245] hover:text-sky-50" />
                    </div>
                </div>
            </div>
            <div class="flex bg-gradient-to-r from-[#4638bd] to-[#070136]">
                <div class="ml-5 mt-8">
                    <table class="border-separate border-spacing-2 border border-slate-400">
                        <thead>
                            <tr class="text-gray-300 bg-gray-700 px-3">
                                <th class="  text-md border border-slate-300 ">No</th>
                                <th class="  text-md px-3 border border-slate-300">Queue Number</th>
                                <th class="  text-md px-3 border border-slate-300">Category</th>
                                <th class="  text-md px-3 border border-slate-300">Status</th>
                                <th class="  text-md px-3 border border-slate-300">Time</th>
                                <th class="  text-md px-3 border border-slate-300">ID</th>
                                <th class="  text-md px-3 border border-slate-300">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) of queues"
                                class="text-xl hover:bg-yellow-500  py-6 text-gray-300 hover:text-gray-700 ">
                                <th scope="row">{{ index + 1 }}.</th>
                                <td class="text-center  px-2">{{ item.queue_no }}</td>
                                <td class="text-center  px-2">
                                    {{ item.service_type }}
                                </td>
                                <td class="text-center  px-2">
                                    {{ item.status }}
                                </td>
                                <td class="text-center  px-2">
                                    {{ item.created_at }}
                                </td>
                                <td class="text-center  px-2">
                                    {{ item.quuid }}
                                </td>

                                <td class="text-center  px-2">
                                    <a v-if="selectView" @click="say([item.quuid, item.queue_no])" href="#"
                                        class="font-medium   text-red-700 dark:text-blue-500 hover:underline">Select
                                    </a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</template>
