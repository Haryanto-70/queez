<script setup>
import { defineProps, onMounted, ref } from "vue";
import ModeButton from "./ModeButton.vue";

axios.defaults.baseURL = "http://127.0.0.1:8000/";

const header = ref();
const queues = ref([]);
const users = ref([]);
const deskNo = ref();

onMounted(() => {
    getResponse();
    getResponse2("all");
});

const getResponse = async (type) => {
    try {
        const responses = await axios.get("userdesk");
        users.value = responses.data[0];
        console.log("user data", users);
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
</script>

<template>
    <div>
        <div
            class="bg-red-700 ml-2 mr-2 rounded-lg mb-2 hover:bg-red-300 px-6 py-2 fixed top-7"
        >
            <p
                class="flex justify-start items-center pt-3 text-slate-100 font-bold text-2xl"
            >
                DESK COUNTER: {{ users.desk_no }}
            </p>
            <p
                class="flex justify-start items-center pt-3 text-slate-100 font-bold text-2xl"
            >
                USER NAME : {{ users.name }}
            </p>
        </div>

        <div class="mt-36">
            <div class="flex flex-row">
                <ModeButton
                    serviceType="SHOW ALL"
                    description="layanan ini melingkupi semua"
                    class="bg-blue-400"
                />
                <ModeButton
                    serviceType="LAYANAN A"
                    description="layanan ini melingkupi abscd"
                    class="bg-blue-700"
                />
                <ModeButton
                    serviceType="LAYANAN B"
                    description="layanan ini melingkupi efgh"
                    class="bg-blue-400"
                />
                <ModeButton
                    serviceType="LAYANAN C"
                    description="layanan ini melingkupi opkl"
                    class="bg-blue-800"
                />
                <ModeButton
                    serviceType="LAYANAN C"
                    description="layanan ini melingkupi xyz"
                    class="bg-blue-600"
                />
            </div>
        </div>
        <div class="">
            <div>
                <table class="table mb-32">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" class="mr-12">QUEUE NO</th>
                            <th scope="col" class="text-center">CATEGORY</th>
                            <th scope="col" class="text-center">TIME</th>

                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) of queues" class="">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ item.queue_no }}</td>
                            <td class="text-center">
                                {{ item.service_type }}
                            </td>
                            <td class="text-center">
                                {{ item.created_at }}
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
                </table>
            </div>
        </div>
        <div>
            <div class="fixed bottom-4">
                <div
                    class="flex p-4 text-xl border-2 w-80 m-2 rounded-lg border-dark-500"
                >
                    <p class="flex items-end">QUEUE NUMBER :</p>
                    <p class="font-bold text-3xl text-yellow-700 ml-2">A0010</p>
                </div>
                <div class="flex flex-row">
                    <div
                        class="flex p-4 text-xl border-2 w-48 mx-2 py-8 rounded-lg border-dark-500 items-center bg-green-200 hover:bg-green-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811V8.69ZM12.75 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061a1.125 1.125 0 0 1-1.683-.977V8.69Z"
                            />
                        </svg>

                        <div class="flex w-24 ml-2">
                            <p class="flex text-center font-bold mx-auto">
                                NEXT QUEUE
                            </p>
                        </div>
                    </div>
                    <div
                        class="flex p-4 text-xl border-2 w-48 mx-2 py-8 rounded-lg border-dark-500 items-center bg-green-200 hover:bg-green-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z"
                            />
                        </svg>

                        <div class="flex w-24 ml-2">
                            <p class="flex text-center font-bold mx-auto">
                                CALL
                            </p>
                        </div>
                    </div>
                    <div
                        class="flex p-4 text-xl border-2 w-48 mx-2 py-8 rounded-lg border-dark-500 items-center bg-green-200 hover:bg-green-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 7.5V18M15 7.5V18M3 16.811V8.69c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811Z"
                            />
                        </svg>

                        <div class="flex w-24 ml-2">
                            <p class="flex text-center font-bold mx-auto">
                                START
                            </p>
                        </div>
                    </div>
                    <div
                        class="flex p-4 text-xl border-2 w-48 mx-2 py-8 rounded-lg border-dark-500 items-center bg-green-200 hover:bg-green-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                            />
                        </svg>

                        <div class="flex w-24 ml-2">
                            <p class="flex text-center font-bold mx-auto">
                                PAUSED
                            </p>
                        </div>
                    </div>
                    <div
                        class="flex p-4 text-xl border-2 w-48 mx-2 py-8 rounded-lg border-dark-500 items-center bg-green-200 hover:bg-green-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 9.563C9 9.252 9.252 9 9.563 9h4.874c.311 0 .563.252.563.563v4.874c0 .311-.252.563-.563.563H9.564A.562.562 0 0 1 9 14.437V9.564Z"
                            />
                        </svg>

                        <div class="flex w-24 ml-2">
                            <p class="flex text-center font-bold mx-auto">
                                FINISH
                            </p>
                        </div>
                    </div>
                    <div
                        class="flex p-4 text-xl border-2 w-48 mx-2 py-8 rounded-lg border-dark-500 items-center bg-green-200 hover:bg-green-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                            />
                        </svg>

                        <div class="flex w-24 ml-2">
                            <p class="flex text-center font-bold mx-auto">
                                CANCEL
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
