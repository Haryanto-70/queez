<script setup>
import { ref, onMounted } from 'vue'
import EditUser from './EditUser.vue'

const users = ref([])
const editView = ref(false)
const itemUser = ref([])


onMounted(() => {
    userList();
});

const userList = async () => {
    const responses = await axios.get("userlist");
    users.value = responses.data;

}

const editUserForm = (item) => {

    editView.value = true;
    itemUser.value = item;


}

</script>

<template>
    <div>
        <div v-if="!editView">
            <table class="bg-gray-200">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Access Level</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <tr v-for="(item, index) in users">
                    <td>{{ item.name }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.company }}</td>
                    <td>{{ item.role }}</td>
                    <td>{{ item.active }}</td>
                    <td><button @click="editUserForm(item)" class="text-red-500">Edit</button></td>
                </tr>

            </table>
        </div>

        <div v-if="editView">
            <EditUser v-bind="itemUser" />
        </div>
    </div>
</template>