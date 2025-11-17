<script setup>
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps({
    channels: Array,
});

console.log(props.channels);
</script>

<template>
    <Head title="Dashboard Admin"></Head>
    <div class="relative min-h-screen bg-[#EBF5FF]">
        <div class="pb-24 md:pb-12">
            <div class="mx-auto">
                <header class="flex items-center gap-8 p-4">
                    <a href="dashboardadmin.html" class="text-gray-800">
                        <icon icon="mdi:arrow-left" class="text-3xl"></icon>
                    </a>
                    <h1 class="text-xl font-bold text-black">
                        Manajemen Wisata
                    </h1>
                </header>

                <main class="space-y-4 px-4">
                    <div class="space-y-3 pt-2">
                        <div
                            v-for="(channel, index) in channels"
                            :key="index"
                            class="space-y-3 overflow-hidden rounded-xl bg-[#D8EBFF] p-4 shadow-xl"
                        >
                            <div class="flex items-start justify-between">
                                <div class="flex min-w-0 flex-col">
                                    <h3
                                        class="text-lg font-semibold text-gray-900"
                                    >
                                        {{ channel.name }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ channel.location }}
                                    </p>
                                </div>
                                <div
                                    class="ml-4 flex flex-shrink-0 flex-col items-end gap-2"
                                >
                                    <span
                                        v-if="channel.is_active"
                                        class="flex-shrink-0 rounded-full bg-[#85CE4D] px-3 py-0.5 text-xs font-medium text-white"
                                    >Aktif</span>
                                    <span
                                        v-else-if="!channel.is_active && !channel.is_verified"
                                        class="flex-shrink-0 rounded-full bg-white px-3 py-0.5 text-xs font-medium text-gray-700"
                                    >Menunggu Verifikasi</span>
                                    <span
                                        v-else
                                        class="flex-shrink-0 rounded-full bg-[#E52C2C] px-3 py-0.5 text-xs font-medium text-white"
                                    >Nonaktif</span>
                                    
                                    <p class="text-xs text-gray-400">
                                        09 Des 2025, 17:30
                                    </p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-3 pt-3">
                                <Link :href="`/dashboard/admin/wisata/${channel.id}`">
                                    <div
                                        class="text-center cursor-pointer w-full rounded-full border border-[#01ABFF] bg-transparent px-4 py-2 text-sm font-medium text-[#01ABFF] transition-all"
                                    >
                                        Lihat Detail
                                    </div>
                                </Link>
                                <button
                                    class="w-full rounded-full bg-[#01ABFF] px-4 py-2 text-sm font-medium text-white transition-all"
                                >
                                    Verifikasi
                                </button>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<style scoped>
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f9fafb;
}
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
