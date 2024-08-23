<script setup>
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, onUnmounted, onMounted } from "vue";


const dashboard = ref([])
const form = useForm({
    dashboard_name: '',
    company_logo: '',
    image_1: '',
    image_2: '',
    image_3: '',
    image_4: '',
    image_5: '',
    image_6: '',
    image_7: '',

});

onMounted(() => {
    getdashboard();
});

const getdashboard = async () => {

    const responses = await axios.get("display/dashboard");
    dashboard.value = responses.data[0];
    console.log(dashboard.value.dashboard_name);
    form.dashboard_name = dashboard.value.dashboard_name;
    form.company_logo = dashboard.value.company_logo;
    form.image_1 = dashboard.value.image_1;
    form.image_2 = dashboard.value.image_2;
    form.image_3 = dashboard.value.image_3;
    form.image_4 = dashboard.value.image_4;
    form.image_5 = dashboard.value.image_5;
    form.image_6 = dashboard.value.image_6;
    form.image_7 = dashboard.value.image_7;


}


</script>

<template>
    <div>
        <div class="ml-8">
            <div class="sm:col-span-4 mt-2 flex items-center">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Company
                    Name</label>
                <div class="ml-4">
                    <div
                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                        <input v-model="form.dashboard_name" type="text" name="username" id="username"
                            autocomplete="username"
                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="Company Name">
                    </div>
                </div>
            </div>
            <div class="sm:col-span-4 mt-2 flex items-center">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900 w-24">Company Logo
                </label>
                <div class="ml-4">
                    <div
                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                        <input v-model="form.company_logo" type="text" name="username" id="username"
                            autocomplete="username"
                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="Image 1">
                    </div>
                </div>
                <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">replace</button>
            </div>
            <div class="sm:col-span-4 mt-2 flex items-center">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900 w-24">Image 1
                </label>
                <div class="ml-4">
                    <div
                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                        <input v-model="form.image_1" type="text" name="username" id="username" autocomplete="username"
                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="Image 1">
                    </div>
                </div>
                <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">replace</button>
            </div>
            <div class="sm:col-span-4 mt-2 flex items-center">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900 w-24">Image 2
                </label>
                <div class="ml-4">
                    <div
                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                        <input v-model="form.image_2" type="text" name="username" id="username" autocomplete="username"
                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="Image 2">
                    </div>
                </div>
                <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">replace</button>
            </div>
            <div class="sm:col-span-4 mt-2 flex items-center">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900 w-24">Image 3
                </label>
                <div class="ml-4">
                    <div
                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                        <input v-model="form.image_3" type="text" name="username" id="username" autocomplete="username"
                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="Image 3">
                    </div>
                </div>
                <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">replace</button>
            </div>
            <div class="sm:col-span-4 mt-2 flex items-center">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900 w-24">Image 4
                </label>
                <div class="ml-4">
                    <div
                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                        <input v-model="form.image_4" type="text" name="username" id="username" autocomplete="username"
                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="Image 4">
                    </div>
                </div>
                <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">replace</button>
            </div>
            <div class="sm:col-span-4 mt-2 flex items-center">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900 w-24">Image 5
                </label>
                <div class="ml-4">
                    <div
                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                        <input v-model="form.image_5" type="text" name="username" id="username" autocomplete="username"
                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="Image 5">
                    </div>
                </div>
                <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">replace</button>
            </div>
            <div class="sm:col-span-4 mt-2 flex items-center">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900 w-24">Image 6
                </label>
                <div class="ml-4">
                    <div
                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                        <input v-model="form.image_6" type="text" name="username" id="username" autocomplete="username"
                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="Image 6">
                    </div>
                </div>
                <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">replace</button>
            </div>
            <div class="sm:col-span-4 mt-2 flex items-center">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900 w-24">Image 7
                </label>
                <div class="ml-4">
                    <div
                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                        <input v-model="form.image_7" type="text" name="username" id="username" autocomplete="username"
                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="Image 7">
                    </div>
                </div>
                <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">replace</button>
            </div>


        </div>
    </div>
</template>