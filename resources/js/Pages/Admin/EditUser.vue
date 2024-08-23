<script setup>

import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, onMounted, defineProps } from 'vue'


const form = useForm({
    name: '',
    email: '',
    role: '',
    status: false,

});
const selected = ref('')
const roles = ref([])

const props = defineProps(['name', 'email', 'role', 'active'])

onMounted(() => {
    form.name = props.name
    form.email = props.email
    form.role = props.role
    form.status = props.active


    roleList();

})

const updateUserForm = async ($data) => {

    if ($data == "") {

        router.post("/edituser/" + 'nonewrole', form);
    } else {
        router.post("/edituser/" + $data, form);
    }
}


const roleList = async () => {
    const responses = await axios.get("roleslist");
    roles.value = responses.data;

}

</script>

<template>
    <div class="ml-4">
        <form @submit.prevent="updateUserForm(selected)">
            <div class="sm:col-span-4 mt-2">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                <div class="">
                    <div
                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">

                        <input v-model.capitalize="form.name" type="text" name="username" id="username"
                            autocomplete="username"
                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="janesmith">
                    </div>
                </div>
            </div>
            <div class="sm:col-span-4 mt-2">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="">
                    <div
                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                        <input disabled v-model="form.email" type="email" name="username" id="username"
                            autocomplete="username"
                            class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                            placeholder="yourname@guenet.com">
                    </div>
                </div>
            </div>

            <div class="sm:col-span-4">
                <div class="flex mt-2">
                    <div class="">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Role</label>
                        <div class="">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input disabled v-model="form.role" type="text" name="username" id="username"
                                    autocomplete="username"
                                    class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="yourname@guenet.com">
                            </div>
                        </div>
                    </div>
                    <div class="ml-2">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">New Role</label>
                        <div class="">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input disabled v-model="selected" type="text" name="username" id="username"
                                    autocomplete="username"
                                    class="block flex-1 border-0 rounded-md bg-gray-100 py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="select new role">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="text-sm">Selected: {{ selected }}</div>

                    <select v-model="selected">
                        <option class="text-sm" value="">Please select one</option>
                        <option class="text-xs" v-for="(item, index) in roles" :value="item.role">
                            <p class="font-bold text-sm">{{ item.role }} </p> : {{
            item.description }}
                        </option>

                    </select>
                </div>
            </div>

            <div class="sm:col-span-4 mt-2">
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                <div class="">
                    <div class="flex items-center">
                        <input v-model="form.status" type="checkbox" name="username" id="username">
                        <p class="ml-2">active</p>
                    </div>
                </div>
            </div>

            <div class="mt-4 mb-8"><button @click="" type="submit"
                    class="bg-blue-700 text-gray-50 px-3 py-2 rounded-md mx-3">Save</button>
                <button @click="addUserForm" class="bg-blue-700 text-gray-50 px-3 py-2 rounded-md mx-3">Cancel</button>
            </div>
        </form>
    </div>
</template>