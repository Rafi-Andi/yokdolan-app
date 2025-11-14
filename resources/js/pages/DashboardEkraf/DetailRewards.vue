<script setup>
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        detail: Object
    })

    const url = "http://127.0.0.1:8000"

    console.log(props.detail)

    const formatTanggal = (tanggal) => {
    if (!tanggal) return '-';
    const date = new Date(tanggal);
    return date.toLocaleDateString('id-ID', {
        weekday: 'long', 
        day: '2-digit',
        month: 'long',
        year: 'numeric'
    });
    };
</script>

<template>
    <div class="pb-32 bg-[#EBF5FF]"> 
        <header class="p-4 flex items-center gap-16">
            <Link href="/dashboard/ekraf/reward" class="text-black">
                <Icon icon="mdi:arrow-left" class="text-3xl"></Icon>
            </Link>
            <h1 class="text-xl font-bold text-black">
                Detail Hadiah
            </h1>
        </header>

        <main class="px-4 space-y-5">
            
            <div class="bg-gray-200 rounded-xl flex items-center justify-center">
                <img :src="`${url}/storage/${detail.reward_photo_path}`" alt="qrcode misi" class="w-100 rounded-lg">
            </div>

            <div class="space-y-2">
                <p class="text-lg font-medium">{{ detail.type }}</p>
                <h2 class="text-2xl font-bold">{{ detail.title }}</h2>
                <div class="flex text-xl font-semibold gap-2">
                <Icon icon="el:star-alt" class="text-3xl text-gray-500 relative bottom-0.5"></Icon>
                <p>{{ detail.points_cost }} Poin</p>
                </div>
                <p class="text-base text-gray-700">
                    {{ detail.description }}
                </p>
            </div>

            <div class="bg-[#D8EBFF] rounded-xl shadow-xl p-4 space-y-3">
                
                <div class="flex items-center gap-3 pb-3 border-b border-gray-400">
                    <div class="flex-shrink-0 rounded-b-full bg-white p-2">
                        <Icon icon="tabler:target-arrow" class="text-3xl text-black"></Icon>
                    </div>
                    <div class="flex-grow">
                        <p class="text-xs text-gray-500">Tipe Hadiah</p>
                        <p class="font-semibold text-gray-900">{{ detail.type }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 pb-3 border-b border-gray-400">
                    <div class="flex-shrink-0 rounded-full bg-white p-2">
                        <Icon icon="mingcute:calendar-2-fill" class="text-3xl text-black"></Icon>
                    </div>
                    <div class="flex-grow">
                        <p class="text-xs text-gray-500">Tanggal di buat</p>
                        <p class="font-semibold text-gray-900">{{ formatTanggal(detail.created_at) }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 rounded-t-full bg-white p-2">
                        <Icon icon="el:star-alt" class="text-3xl text-black"></Icon>
                    </div>
                    <div class="flex-grow">
                        <p class="text-xs text-gray-500">Harga Hadiah</p>
                        <p class="font-semibold text-gray-900">{{ detail.points_cost }} Poin</p>
                    </div>
                </div>
            </div>

        </main>
    </div> 
    <div class="fixed bottom-0 left-0 right-0 p-4">
        <div class="max-w-lg mx-auto">
            <button class="w-full bg-linear-to-r from-[#146AC7] to-[#75B7FD] text-white font-semibold py-3 px-4 rounded-xl text-base transition-all">
                Nonaktifkan Hadiah
            </button>
        </div>
    </div>
</template>