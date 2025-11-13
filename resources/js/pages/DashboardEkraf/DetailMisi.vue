<script setup>
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        detail: Object
    })

    console.log(props.detail)

    const url = "http://127.0.0.1:8000"
    
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
    <div class="pb-32">
        
        <header class="p-4 flex items-center gap-14">
            <Link href="/dashboard/ekraf/mission" class="text-gray-800">
                <Icon icon="mdi:arrow-left" class="text-2xl"></Icon>
            </Link>
            <h1 class="text-xl font-bold text-gray-900">
                Detail Misi
            </h1>
            
        </header>

        <main class="px-4 space-y-5">
            
            <div class=" bg-gray-200 rounded-xl flex items-center justify-center">
                 <img :src="`${url}/storage/${detail.mission_photo_path}`" alt="qrcode misi" class="w-100">
            </div>

            <div class="space-y-2">
                <p class="text-sm font-medium">Transaksi</p>
                <h2 class="text-2xl font-bold">{{ detail.title }}</h2>
                <p class="text-base text-gray-600">
                   {{ detail.description }}
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-xl p-4 space-y-3">
                
                <div class="flex items-center gap-3 pb-3 border-b border-gray-400">
                    <Icon icon="tabler:target-arrow" class="text-3xl text-gray-500"></Icon>
                    <div class="flex-grow">
                        <p class="text-xs text-gray-500">Tipe Misi</p>
                        <p class="font-semibold text-gray-900">{{ detail.type }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 pb-3 border-b border-gray-400">
                    <Icon icon="mingcute:calendar-2-fill" class="text-3xl text-gray-500"></Icon>
                    <div class="flex-grow">
                        <p class="text-xs text-gray-500">Tanggal Dibuat</p>
                        <p class="font-semibold text-gray-900">{{ formatTanggal(detail.created_at) }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <Icon icon="el:star-alt" class="pl-1 text-2xl text-gray-500"></Icon>
                    <div class="flex-grow">
                        <p class="text-xs text-gray-500">Poin Hadiah</p>
                        <p class="font-semibold text-gray-900">{{ detail.reward_points }} Poin</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-200 rounded-xl shadow-sm p-4 flex flex-col items-center gap-4">
                <h2 class="text-base font-semibold text-gray-900">Kode QR Misi</h2>
                <div class="w-48 h-48 bg-gray-100 flex items-center justify-center">
                    <img :src="`${url}/storage/${detail.qr_code_path}`" alt="qrcode misi" class="w-full">
                </div>
                <a :href="`${url}/storage/${detail.qr_code_path}`" download class="w-full bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg text-sm hover:bg-gray-400 transition-all flex items-center justify-center gap-2">
                    <Icon icon="material-symbols:download" class="text-xl"></Icon>
                    Unduh QR Code
                </a>
            </div>

        </main>
    </div> 
    <div class="fixed bottom-0 left-0 right-0 p-4 bg-gray-50 border-t border-gray-200">
        <div class="max-w-lg mx-auto">
            <button class="w-full bg-gray-300 text-gray-800 font-semibold py-3 px-4 rounded-xl text-base hover:bg-gray-400 transition-all">
                Nonaktifkan Misi
            </button>
        </div>
    </div>
</template>