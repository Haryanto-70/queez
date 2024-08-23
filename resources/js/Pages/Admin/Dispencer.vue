<script setup>

import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, onUnmounted, onMounted } from "vue";


const dispencer = ref([])
const form = useForm({
    company: '',
    service_list: '',
    name: '',
    detail: '',

});

onMounted(() => {
    getDispencer();
});

const getDispencer = async () => {

    const responses = await axios.get("display/dispencer");
    dispencer.value = responses.data;
    console.log(dispencer);
    form.company = dispencer.value.company;
    form.service_list = dispencer.value.service_list;
    form.name = dispencer.value.name;
    form.detail = dispencer.value.detail;
}
</script>

<template>
    <div>
        <div class="ml-8">
            <div v-for="(item, index) in dispencer">
                <div class="sm:col-span-4 mt-2 flex items-center">
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900 w-24">Service {{
                index + 1 }}
                    </label>
                    <div class="ml-4">
                        <div
                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                            <input :value="item.name" type="text" name="username" id="username" autocomplete="username"
                                class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                placeholder="service name">
                        </div>
                    </div>
                    <div class="ml-4">
                        <div
                            class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                            <input :value="item.detail" type="text" name="username" id="username"
                                autocomplete="username"
                                class="block w-96 flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                placeholder="Detail Service 1">
                        </div>
                    </div>
                    <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">save</button>
                </div>
            </div>
        </div>
    </div>
</template>