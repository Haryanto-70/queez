<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, onUnmounted, onMounted } from "vue";
import UserList from './UserList.vue'


axios.defaults.baseURL = "http://127.0.0.1:8000/";
const userView = ref(true);
const dashboardView = ref(false);
const dispencerView = ref(false);
const addUserView = ref(false);
const editUserView = ref(false);
const userName = ref('')
const userEmail = ref('')
const userAccessLevel = ref('')
const userStatus = ref(false)
const activeClass = ref("bg-gray-700 text-gray-50")
const form = useForm({
    name: '',
    email: '',

});

onMounted(() => {

});


onUnmounted(() => {


});

const user = async () => {
    userView.value = true;
    dashboardView.value = false;
    dispencerView.value = false;
    addUserView.value = false;
    editUserView.value = false;
}

const dashboard = async () => {
    userView.value = false
    dashboardView.value = true
    dispencerView.value = false
}
const dispencer = async () => {
    userView.value = false
    dashboardView.value = false
    dispencerView.value = true
}

const addUserForm = async () => {
    addUserView.value = !addUserView.value
    editUserView.value = false

}
const editUserForm = async () => {
    editUserView.value = !editUserView.value
    addUserView.value = false

}

const saveUserForm = async ($id) => {
    addUserView.value = false
    console.log('userForm Add', form)
    router.post("/adduser/" + $id, form);

}

const saveEditForm = async () => {
    addUserView.value = false
    editUserView.value = false
}

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

    <Head title="Settings" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"></h2>
        </template>

        <div class=" ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="flex flex-wrap justify-around bg-gray-300 pt-3 rounded-t-lg">
                    <div :class="[userView ? activeClass : '']"
                        class="flex border-t-2 border-b-0 border-x-2 w-48 pt-3 pb-2 justify-center border-gray-400 rounded-t-md hover:bg-gray-500 hover:text-gray-50 ">
                        <button @click="user">User</button>
                    </div>
                    <div :class="[dashboardView ? activeClass : '']"
                        class="flex border-t-2 border-b-0 border-x-2 w-48 pt-3 pb-2 justify-center border-gray-400 rounded-t-md hover:bg-gray-500 hover:text-gray-50 ">
                        <button @click="dashboard">Dashboard</button>
                    </div>
                    <div :class="[dispencerView ? activeClass : '']"
                        class="flex border-t-2 border-b-2   border-x-2 w-48 pt-3 pb-2 justify-center border-gray-400 rounded-t-md hover:bg-gray-500 hover:text-gray-50 ">
                        <button @click="dispencer">Dispencer</button>
                    </div>
                </div>
                <div v-if="userView" class="bg-gray-300 h-fit pb-8 border-t-2 border-gray-400">

                    <div class="flex justify-start ml-3 pt-3">
                        <h1>User List</h1>

                    </div>
                    <div class="flex justify-end">

                        <button v-if="!addUserView" @click="addUserForm"
                            class="bg-blue-700 rounded-md p-3 mr-3 text-gray-300 font-semibold">Add
                            User</button>
                    </div>
                    <div v-if="addUserView" class="ml-4">
                        <form @submit.prevent="saveUserForm('newuser')">
                            <div class="sm:col-span-4">
                                <label for="username"
                                    class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                        <input v-model="form.name" type="text" name="username" id="username"
                                            autocomplete="username"
                                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="janesmith">
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <label for="username"
                                    class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input v-model="form.email" type="email" name="username" id="username"
                                            autocomplete="username"
                                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="yourname@guenet.com">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 mb-8"><button @click="" type="submit"
                                    class="bg-blue-700 text-gray-50 px-3 py-2 rounded-md mx-3">Add</button>
                                <button @click="addUserForm"
                                    class="bg-blue-700 text-gray-50 px-3 py-2 rounded-md mx-3">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div v-if="!editUserView">
                        <UserList />
                    </div>

                    <div v-if="editUserView" class="ml-4">
                        <form action="" method="post">
                            <div class="sm:col-span-4 mt-2">
                                <label for="username"
                                    class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                <div class="">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                        <input v-model="userName" type="text" name="username" id="username"
                                            autocomplete="username"
                                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="janesmith">
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-4 mt-2">
                                <label for="username"
                                    class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                <div class="">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input v-model="userEmail" type="text" name="username" id="username"
                                            autocomplete="username"
                                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="yourname@guenet.com">
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-4 mt-2">
                                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Access
                                    Level</label>
                                <div class="">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input v-model="userAccessLevel" type="text" name="username" id="username"
                                            autocomplete="username"
                                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Customer Service">
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-4 mt-2">
                                <label for="username"
                                    class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                                <div class="">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                        <input v-model="userStatus" type="checkbox"><span
                                            class="flex select-none items-center pl-3 text-gray-700 sm:text-sm">Active</span></input>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4"><button @click="saveEditForm" type="submit"
                                    class="bg-blue-700 text-gray-50 px-3 py-2 rounded-md mx-3">Save</button>
                                <button @click="user"
                                    class="bg-blue-700 text-gray-50 px-3 py-2 rounded-md mx-3">Cancel</button>
                            </div>
                            <div><button @click="user"
                                    class="bg-red-700 text-gray-50 px-3 py-2 my-3 rounded-md mx-3">Reset
                                    Password</button>Reset Default
                                Password (Quenet123)</div>
                        </form>
                    </div>

                </div>
                <div v-if="dashboardView" class="bg-gray-300 h-fit pb-8 border-t-2 border-gray-400">
                    <div class="flex justify-start ml-3 pt-3">
                        <h1>Dashboard</h1>

                    </div>
                    <div class="ml-8">
                        <div class="sm:col-span-4 mt-2 flex items-center">
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Company
                                Name</label>
                            <div class="ml-4">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                    <input type="text" name="username" id="username" autocomplete="username"
                                        class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Company Name">
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4 mt-2 flex items-center">
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900 w-24">Image 1
                            </label>
                            <div class="ml-4">
                                <div
                                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                    <input type="text" name="username" id="username" autocomplete="username"
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

                                    <input type="text" name="username" id="username" autocomplete="username"
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

                                    <input type="text" name="username" id="username" autocomplete="username"
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

                                    <input type="text" name="username" id="username" autocomplete="username"
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

                                    <input type="text" name="username" id="username" autocomplete="username"
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

                                    <input type="text" name="username" id="username" autocomplete="username"
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

                                    <input type="text" name="username" id="username" autocomplete="username"
                                        class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Image 7">
                                </div>
                            </div>
                            <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">replace</button>
                        </div>


                    </div>
                </div>
                <div v-if="dispencerView" class="bg-gray-300 h-fit pb-8 border-t-2 border-gray-400">
                    <div class="flex justify-start ml-3 pt-3">
                        <h1>Ticket Dispencer</h1>

                    </div>
                    <div class="ml-8">
                        <div>
                            <div class="sm:col-span-4 mt-2 flex items-center">
                                <label for="username"
                                    class="block text-sm font-medium leading-6 text-gray-900 w-24">Service 1
                                </label>
                                <div class="ml-4">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                        <input type="text" name="username" id="username" autocomplete="username"
                                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Service 1">
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                        <input type="text" name="username" id="username" autocomplete="username"
                                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Detail Service 1">
                                    </div>
                                </div>
                                <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">replace</button>
                            </div>

                        </div>
                        <div>
                            <div class="sm:col-span-4 mt-2 flex items-center">
                                <label for="username"
                                    class="block text-sm font-medium leading-6 text-gray-900 w-24">Service 1
                                </label>
                                <div class="ml-4">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                        <input type="text" name="username" id="username" autocomplete="username"
                                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Service 1">
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                        <input type="text" name="username" id="username" autocomplete="username"
                                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Detail Service 2">
                                    </div>
                                </div>
                                <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">replace</button>
                            </div>

                        </div>
                        <div>
                            <div class="sm:col-span-4 mt-2 flex items-center">
                                <label for="username"
                                    class="block text-sm font-medium leading-6 text-gray-900 w-24">Service 1
                                </label>
                                <div class="ml-4">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                        <input type="text" name="username" id="username" autocomplete="username"
                                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Service 1">
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                        <input type="text" name="username" id="username" autocomplete="username"
                                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Detail Service 3">
                                    </div>
                                </div>
                                <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">replace</button>
                            </div>

                        </div>
                        <div>
                            <div class="sm:col-span-4 mt-2 flex items-center">
                                <label for="username"
                                    class="block text-sm font-medium leading-6 text-gray-900 w-24">Service 1
                                </label>
                                <div class="ml-4">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                        <input type="text" name="username" id="username" autocomplete="username"
                                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Service 1">
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                                        <input type="text" name="username" id="username" autocomplete="username"
                                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Detail Service 4">
                                    </div>
                                </div>
                                <button class="bg-blue-700 text-gray-100 px-3 py-2 rounded-md ml-2">replace</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,
th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #ffffff;
}
</style>
