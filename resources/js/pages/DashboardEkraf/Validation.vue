<script setup>
import { Icon } from '@iconify/vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { computed, onMounted, ref, watch } from 'vue';
import { debounce } from 'lodash';

const page = usePage();

const props = defineProps({
    pendingValidations: Object,
    filters: Object,
});

const search = ref(props.filters?.search || '');

const searchHandler = debounce((value) => {
    router.get(
        '/dashboard/ekraf/validation',
        { search: value },
        {
            preserveState: true,
            replace: true,
            preserveScroll: true,
        },
    );
}, 300);

watch(search, searchHandler);

const successMessage = computed(() => page.props.flash?.success);
const errorMessage = computed(() => page.props.flash?.error);
const warningMessage = computed(() => page.props.flash?.warning);

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
            title: 'Error!',
            text: errorMessage.value,
            confirmButtonColor: '#e53e3e',
        });
        page.props.flash.error = null;
    }

    if (warningMessage.value) {
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian!',
            text: warningMessage.value,
            confirmButtonColor: '#ed8936',
        });
        page.props.flash.warning = null;
    }
});

const formatTanggal = (tanggal) => {
    if (!tanggal) return '-';
    const date = new Date(tanggal);
    const options = {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    };
    return date.toLocaleString('id-ID', options);
};
</script>
<template>
    <Head title="Validasi Transaksi" />
    <div class="min-h-screen bg-[#EBF5FF]">
        
        <header class="p-4 flex items-center gap-11">
            <Link href="/dashboard/ekraf" class="text-black">
                <Icon icon="mdi:arrow-left" class="text-3xl"></Icon>
            </Link>
            <h1 class="text-xl font-bold text-black">
                Validasi Transaksi
            </h1>
        </header>

        <main class="px-4 space-y-4">
            
            <div class="relative w-full pt-6 pb-6">
                <div class="absolute left-2 top-8">
                    <Icon icon="mdi:search" class="text-3xl text-gray-400"></Icon>
                </div>
                <input 
                    type="text" 
                    placeholder="Cari ID Voucher atau Nama..."
                    v-model="search"
                    class="w-full rounded-xl border-none text-black bg-white py-3 pl-12"
                />
            </div>

            <Link
                href="/dashboard/ekraf/reward/validate-all"
                method="post"
                as="button"
                class="w-full bg-linear-to-r from-[#176CC9] to-[#6BAFF8] text-white font-medium py-2 rounded-3xl text-base"
            >
                Validasi Sekali Klik
            </Link>

            <h2 class="text-xl font-semibold text-gray-900 pt-6">
                Voucher Menunggu Validasi
            </h2>

            <div class="space-y-3">
                <div
                    v-for="(reward, index) in props.pendingValidations.data ?? []"
                    :key="reward.id"
                    class="bg-[#D8EBFF] rounded-xl shadow-xl p-4 space-y-3"
                >
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-500">Voucher ID</p>
                            <p class="font-semibold text-gray-900">EKRAF-{{ reward.id }}</p>
                        </div>
                        <span class="text-xs font-medium bg-white text-gray-500 px-2 py-0.5 rounded-full">Menunggu</span>
                    </div>

                    <div class="border-t border-gray-300 pt-3">
                        <p class="text-xs text-gray-500">Hadiah</p>
                        <p class="text-lg font-semibold text-gray-900">{{ reward.reward.title }}</p>
                    </div>

                    <div class="border-t border-gray-300 pt-3">
                        <p class="text-xs text-gray-500">Pengguna</p>
                        <p class="font-medium text-gray-900">{{ reward.tourist.name }}</p>
                        <p class="text-xs text-gray-500">{{ formatTanggal(reward.exchange_at) }}</p>
                    </div>

                    <div class="pt-3 grid grid-cols-2 gap-3">
                        <Link
                            :href="`/dashboard/ekraf/reward/reject/${reward.id}`"
                            method="post"
                            as="button"
                            class="w-full bg-transparent border border-[#01ABFF] text-[#01ABFF] font-medium py-2 px-4 rounded-3xl text-md"
                        >
                            Tolak
                        </Link>
                        <Link
                            :href="`/dashboard/ekraf/reward/validate/${reward.id}`"
                            method="post"
                            as="button"
                            class="w-full bg-[#01ABFF] text-white font-medium py-2 px-4 rounded-3xl text-md"
                        >
                            Validasi
                        </Link>
                    </div>
                </div>

                <div v-if="props.pendingValidations.data && props.pendingValidations.data.length === 0" class="bg-[#D8EBFF] rounded-xl shadow-xl p-4 text-center">
                    <p class="text-gray-500">Tidak ada voucher yang menunggu validasi</p>
                </div>
            </div>
            
            <div class="mt-8 pt-4 pb-12 flex justify-center">
                <template v-for="(link, key) in props.pendingValidations.links" :key="key">
                    <div
                        v-if="link.url === null"
                        class="mb-1 mr-1 px-3 py-2 text-gray-500 text-xs leading-4 border rounded-lg"
                        v-html="link.label"
                    />
                    <Link
                        v-else
                        class="mb-1 mr-1 px-3 py-2 text-xs leading-4 border rounded-lg hover:bg-white/50 transition"
                        :class="{ 'bg-[#1485FF] text-white border-none': link.active, 'text-black bg-white': !link.active }"
                        :href="link.url"
                        v-html="link.label"
                        preserve-scroll
                        preserve-state
                    />
                </template>
            </div>

        </main>
        
    </div>
</template>
