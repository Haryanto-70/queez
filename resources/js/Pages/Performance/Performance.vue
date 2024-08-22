<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref, onUnmounted, onMounted } from "vue";


axios.defaults.baseURL = "http://127.0.0.1:8000/";
const header = ref("Hallo");
const header2 = ref("Hallo-2");
const count = ref(0);
const users = ref([]);
const datas = ref([]);

onMounted(() => {

});


onUnmounted(() => {


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
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"></h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-200 dark:text-gray-100">
                        Your Performance!
                    </div>
                    <div class="flex flex-wrap justify-around">
                        <!-- <CardButton @click="deskCounter(1)" buttonName="DESK COUNTER 01" class="bg-[#FF4C4C]" />
                        <CardButton @click="deskCounter(2)" buttonName="DESK COUNTER 02" class="bg-[#30ea68]" />
                        <CardButton @click="deskCounter(3)" buttonName="DESK COUNTER 03" class="bg-[#7d881c]" />
                        <CardButton @click="deskCounter(4)" buttonName="DESK COUNTER 04" class="bg-[#2badd8]" />
                        <CardButton @click="onDisplay" buttonName="DISPLAY QUEUE" class="bg-[#4256d7]" />
                        <CardButton @click="tokenDispenser" buttonName="TOKEN DISPENSER" class="bg-[#4256d7]" /> -->
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
