<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, onUnmounted, onMounted, watch } from "vue";

axios.defaults.baseURL = "http://127.0.0.1:8000/";
const header = ref("Hallo");
const header2 = ref("Hallo-2");
const count = ref(0);
const users = ref([]);
const datas = ref([]);

onMounted(() => {
    getResponse();
});

const getResponse = async () => {
    const responses = await axios.get("users ");
    // users.value = responses.data;
    console.log("tabel users", users);
};

setInterval(() => {
    if (header.value == "Hallo") {
        count.value = count.value + 1;
        header.value = "READ DATABASE";
        getResponse();
    } else {
        header.value = "Hallo";
    }
}, 2000);

setInterval(() => {
    if (header2.value == "Hallo-2") {
        header2.value = "THIS IS DASBOARD 2";
    } else {
        header2.value = "Hallo-2";
    }
}, 1000);

onUnmounted(() => {
    clearInterval();
});
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
                    <table class="table">
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
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
