<script setup>
import { defineProps, onMounted, ref } from "vue";

axios.defaults.baseURL = "http://127.0.0.1:8000/";

const header = ref();
const users = ref([]);
const deskNo = ref();

onMounted(() => {
    getResponse();
});

const getResponse = async () => {
    try {
        const responses = await axios.get("userdesk");
        users.value = responses.data[0];
        console.log("user data", users);
    } catch (error) {
        header.value = "ERROR READ DATABASE";
    }
};
</script>

<template>
    <div>
        <div>
            <h1>Desk No: {{ users.desk_no }}</h1>
            <h1>Name: {{ users.name }}</h1>
        </div>
        <h1>DESKCOUNTER</h1>
    </div>
</template>
