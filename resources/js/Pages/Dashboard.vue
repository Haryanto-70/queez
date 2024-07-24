<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref, onUnmounted, onMounted } from "vue";
import CardButton from "../Components/CardButton.vue";

axios.defaults.baseURL = "http://127.0.0.1:8000/";
const header = ref("Hallo");
const header2 = ref("Hallo-2");
const count = ref(0);
const users = ref([]);
const datas = ref([]);

onMounted(() => {
    //  getResponse();
});

// const getResponse = async () => {
//     try {
//         const responses = await axios.get("users ");
//         users.value = responses.data;
//         console.log("interval 2 s");
//         header.value = "READ DATABASE";
//         count.value = count.value + 1;
//     } catch (error) {
//         header.value = "ERROR READ DATABASE";
//     }
// };

// const interval2Sec = setInterval(() => {
//     if (header.value == "Hallo") {
//         getResponse();
//     } else {
//         header.value = "Hallo";
//     }
// }, 2000);

// const interval1Sec = setInterval(() => {
//     if (header2.value == "Hallo-2") {
//         header2.value = "THIS IS DASBOARD 2";
//         console.log("interval 1 s");
//     } else {
//         header2.value = "Hallo-2";
//     }
// }, 1000);

onUnmounted(() => {
    // clearInterval(interval2Sec);
    // clearInterval(interval1Sec);
    console.log("on Unmounted");
});

function onDisplay() {
    router.get("/display");
}

function deskCounter(cNo) {
    router.get("/desk/" + cNo);
}
function tokenDispenser() {
    router.get("/dispenser");
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                {{ header }} {{ count }}
            </h2>
            <h2>{{ header2 }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        You're logged in!
                    </div>
                    <div class="flex flex-wrap justify-around">
                        <CardButton
                            @click="deskCounter(1)"
                            buttonName="DESK COUNTER 01"
                            class="bg-[#FF4C4C]"
                        />
                        <CardButton
                            @click="deskCounter(2)"
                            buttonName="DESK COUNTER 02"
                            class="bg-[#5de586]"
                        />
                        <CardButton
                            @click="deskCounter(3)"
                            buttonName="DESK COUNTER 03"
                            class="bg-[#c7d547]"
                        />
                        <CardButton
                            @click="deskCounter(4)"
                            buttonName="DESK COUNTER 04"
                            class="bg-[#2badd8]"
                        />
                        <CardButton
                            @click="onDisplay"
                            buttonName="DISPLAY QUEUE"
                            class="bg-[#4256d7]"
                        />
                        <CardButton
                            @click="tokenDispenser"
                            buttonName="TOKEN DISPENSER"
                            class="bg-[#4256d7]"
                        />
                    </div>
                    <!-- <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User Name</th>
                                <th scope="col" class="text-center">email</th>
                                <th scope="col" class="text-center">email</th>

                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) of users" class="">
                                <th scope="row">{{ index + 1 }}</th>
                                <td>{{ item.name }}</td>
                                <td class="text-center">
                                    {{ item.email }}
                                </td>
                                <td class="text-center">
                                    {{ item.email }}
                                </td>
                                <td>
                                    <a
                                        @click="say([item])"
                                        href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                        >Edit
                                    </a>
                                    <a
                                        @click="removeCluster(item.id)"
                                        href="#"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"
                                        >Remove</a
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table> -->
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
