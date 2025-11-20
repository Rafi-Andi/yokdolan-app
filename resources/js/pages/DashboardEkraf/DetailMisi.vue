<script setup>
import { Icon } from '@iconify/vue';
import { router, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { onMounted, computed, watch } from 'vue';

const props = defineProps({
    detail: Object,
});

console.log(props.detail)

console.log(props.detail);

const url = 'http://127.0.0.1:8000';

const formatTanggal = (tanggal) => {
    if (!tanggal) return '-';
    const date = new Date(tanggal);
    return date.toLocaleDateString('id-ID', {
        weekday: 'long',
        day: '2-digit',
        month: 'long',
        year: 'numeric',
    });
};

const goBack = () => {
    history.back();
};

const page = usePage();
const successMessage = computed(() => page.props.flash?.success);
const errorMessage = computed(() => page.props.flash?.error ?? page.props.flash?.warning ?? page.props.flash?.message);

onMounted(() => {
    if (successMessage.value) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: successMessage.value,
            confirmButtonColor: '#38a169',
        });
        page.props.flash.success = null;
    }

    if (errorMessage.value) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: errorMessage.value,
            confirmButtonColor: '#e53e3e',
        });
        if (page.props.flash.error) page.props.flash.error = null;
        if (page.props.flash.warning) page.props.flash.warning = null;
        if (page.props.flash.message) page.props.flash.message = null;
    }
});

watch(successMessage, (val) => {
    if (val) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: val,
            confirmButtonColor: '#38a169',
        });
        page.props.flash.success = null;
    }
});

watch(errorMessage, (val) => {
    if (val) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: val,
            confirmButtonColor: '#e53e3e',
        });
        if (page.props.flash.error) page.props.flash.error = null;
        if (page.props.flash.warning) page.props.flash.warning = null;
        if (page.props.flash.message) page.props.flash.message = null;
    }
});

</script>

<template>
    <div class="bg-[#EBF5FF] pb-32">
        <header class="flex items-center gap-19 p-4">
            <button @click.prevent="goBack()" class="text-black cursor-pointer">
                <Icon icon="mdi:arrow-left" class="text-3xl"></Icon>
            </button>
            <h1 class="text-xl font-bold text-black">Detail Misi</h1>
        </header>

        <main class="space-y-5 px-4">
            <div
                class="flex items-center justify-center rounded-xl bg-gray-200"
            >
                <img
                    :src="`${url}/storage/${detail.mission_photo_path}`"
                    alt="qrcode misi"
                    class="w-100"
                />
            </div>

            <div class="space-y-2">
                <p class="text-lg font-medium">Transaksi</p>
                <h2 class="text-2xl font-bold">{{ detail.title }}</h2>
                <p class="text-base text-gray-700">
                    {{ detail.description }}
                </p>
            </div>

            <div class="mb-16 space-y-3 rounded-xl bg-[#D8EBFF] p-4 shadow-xl">
                <div
                    class="flex items-center gap-3 border-b border-gray-400 pb-3"
                >
                    <div class="flex-shrink-0 rounded-b-full bg-white p-2">
                        <Icon
                            icon="tabler:target-arrow"
                            class="text-3xl text-black"
                        ></Icon>
                    </div>
                    <div class="flex-grow">
                        <p class="text-xs text-gray-500">Tipe Misi</p>
                        <p class="font-semibold text-gray-900">
                            {{ detail.type }}
                        </p>
                    </div>
                </div>

                <div
                    class="flex items-center gap-3 border-b border-gray-400 pb-3"
                >
                    <div class="flex-shrink-0 rounded-full bg-white p-2">
                        <Icon
                            icon="mingcute:calendar-2-fill"
                            class="text-3xl text-black"
                        ></Icon>
                    </div>
                    <div class="flex-grow">
                        <p class="text-xs text-gray-500">Tanggal Dibuat</p>
                        <p class="font-semibold text-gray-900">
                            {{ formatTanggal(detail.created_at) }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 rounded-t-full bg-white p-2">
                        <Icon
                            icon="el:star-alt"
                            class="text-3xl text-black"
                        ></Icon>
                    </div>
                    <div class="flex-grow">
                        <p class="text-xs text-gray-500">Poin Hadiah</p>
                        <p class="font-semibold text-gray-900">
                            {{ detail.reward_points }} Poin
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-center gap-4 bg-white p-4">
                <h2 class="text-base font-semibold text-gray-900">
                    Kode QR Misi
                </h2>
                <div
                    class="flex h-48 w-48 items-center justify-center bg-gray-100"
                >
                    <img
                        :src="`${url}/storage/${detail.qr_code_path}`"
                        alt="qrcode misi"
                        class="w-full"
                    />
                </div>
                <a
                    :href="`${url}/storage/${detail.qr_code_path}`"
                    download
                    class="flex w-full items-center justify-center gap-2 rounded-lg bg-[#01ABFF] px-4 py-3 text-sm font-medium text-white transition-all hover:bg-gray-400"
                >
                    <Icon
                        icon="material-symbols:download"
                        class="text-xl"
                    ></Icon>
                    Unduh QR Code
                </a>
            </div>
        </main>
    </div>
    <div class="fixed right-0 bottom-0 left-0 p-4">
        <div class="mx-auto max-w-lg">
            <button 
                v-if="detail.is_active"
                @click="router.put(`/missions/${detail.id}/nonaktif`)"
                class="w-full rounded-xl bg-linear-to-r from-[#146AC7] to-[#75B7FD] px-4 py-3 text-base font-semibold text-white transition-all hover:from-[#0F4F9C] hover:to-[#4C90E0]"
            >
                Nonaktifkan Misi
            </button>
            <button 
                v-else
                @click="router.put(`/missions/${detail.id}/aktif`)"
                class="w-full rounded-xl bg-linear-to-r from-[#146AC7] to-[#75B7FD] px-4 py-3 text-base font-semibold text-white transition-all hover:from-[#0F4F9C] hover:to-[#4C90E0]"
            >
                Aktifkan Misi
            </button>
        </div>
    </div>
</template>
