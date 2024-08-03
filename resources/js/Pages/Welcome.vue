<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>

    <Head title="Welcome" />
    <div class="flex flex-center text-black/50 bg-[#020202c6] dark:bg-black dark:text-white/50">

        <img id="background" class="absolute w-screen -z-10 " src="images/background-main.png" height="700" />

        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl  lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3 fixed top-0 w-96 ">
                    <div class="">
                        <nav v-if="canLogin" class="flex justify-between w-screen bg-[#0202024e] py-3">
                            <div class="flex flex-row ml-8">
                                <img class="" src="alkemi-f.png" width="50" />
                                <p class="font-changa text-white text-3xl pt-1 ">ALKEMI</p>
                            </div>
                            <div class="flex items-center">
                                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                                    class="rounded-md px-3 py-2 mr-64 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Dashboard
                                </Link>

                                <template v-else>
                                    <div class="flex flex-row mr-64">
                                        <div class="">
                                            <Link :href="route('login')"
                                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-red-700 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                            Log in
                                            </Link>
                                        </div>
                                        <div class="">
                                            <Link v-if="canRegister" :href="route('register')"
                                                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-red-700 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                            Register
                                            </Link>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </nav>

                    </div>

                </header>

                <main>
                    <div class="flex justify-center flex-col w-96 ">

                        <div class="flex flex-col justify-center  pt-6  w-screen h-screen">
                            <h1 class="font-lastica text-7xl mx-auto text-[#f93636]    font-bold">QUE-NET</h1>

                            <p class="font-dosis mx-auto text-xl text-white">QUE-NET adalah Sistem Manajemen Antrian
                                Untuk
                                Meningkatkan
                                Kepastian
                                Dalam Pelayanan,
                                Terukur dan </p>
                            <p class="font-dosis mx-auto text-xl text-white">Kepuasan Customer.</p>
                            <div class="mt-96 flex justify-center">
                                <button class="bg-[#f42626] py-2 px-4 font-dosis text-white text-xl font-bold">COBA
                                    GRATIS</button>
                                <button
                                    class="bg-[#f42626] py-2 px-4 font-dosis text-white text-xl font-bold ml-4">HUBUNGI
                                    KAMI</button>
                            </div>
                        </div>

                    </div>
                    <div class="flex flex-col justify-start    w-screen bg-white pt-12">
                        <h1 class="font-lastica text-xl mx-auto text-[#f93636] font-bold">QUE-NET</h1>
                        <h1 class="font-dosis text-4xl mx-auto text-[#000000] font-bold pt-6">SISTEM MANAJEMEN ANTRIAN
                        </h1>
                        <p class="w-3/4 mx-auto text-center pt-6">Manajemen sistem antrian adalah proses mengelola alur
                            dan
                            waktu tunggu dalam sistem yang melibatkan antrean. Tujuannya adalah untuk mengoptimalkan
                            efisiensi dan
                            kepuasan pelanggan
                            dengan mengurangi waktu tunggu dan mencegah kemacetan. Tekniknya meliputi analisis dan
                            perancangan model antrian, penjadwalan sumber daya, serta penggunaan algoritma seperti
                            First-Come-First-Serve atau Priority Queue. Faktor-faktor seperti intensitas kedatangan,
                            waktu pelayanan, dan kapasitas sistem dianalisis untuk menentukan konfigurasi optimal.
                            Manajemen yang baik dapat meningkatkan produktivitas dan pengalaman pengguna di berbagai
                            konteks, seperti pelayanan pelanggan, jaringan komputer, dan sistem produksi.</p>
                        <div class="mt-7">
                            <div class="flex justify-evenly mt-3">
                                <img src="images/features/display-f.png" width="500" class="border-2 border-gray-700" />
                                <img src="images/features/dashboard-f.png" width="500"
                                    class="border-2 border-gray-700" />

                                <img src="images/features/desk-f.png" width="500" class="border-2 border-gray-700" />

                            </div>
                            <div class="flex flex-row justify-evenly mt-3">
                                <img src="images/features/ticketing-f.png" width="300" />

                            </div>
                        </div>
                        <div class="my-8 flex justify-center">
                            <button class="bg-[#f42626] py-2 px-4 font-dosis text-white text-xl font-bold">COBA
                                GRATIS</button>
                            <button class="bg-[#f42626] py-2 px-4 font-dosis text-white text-xl font-bold ml-4">HUBUNGI
                                KAMI</button>
                        </div>
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-white dark:text-white/70">
                    <div class="flex flex-row justify-evenly">
                        <p>&copy; 2023 QUE-NET. All rights reserved.</p>
                        <p>Yayasan Alkemi & PT. Alkemi Indonesia</p>

                    </div>
                </footer>
            </div>
        </div>
    </div>
</template>
