<script setup>
import { logout } from '@/routes';
import { Icon } from '@iconify/vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { computed, onMounted } from 'vue';

const page = usePage();

const successMessage = computed(() => page.props.flash?.success);
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

const props = defineProps({
    stats: Object,
    pendingValidations: Array,
});

props.pendingValidations.forEach(element => {
    console.log(element.tourist.profile_url);
});
console.log(props.pendingValidations);
console.log(props.stats);
</script>

<template>
    <Head title="Dasbor Mitra Ekraf" />
    <div class="min-h-screen bg-[#EBF5FF] pb-24">
            <main class="space-y-6 px-6 pt-12">
                <div class="flex justify-between">
                    <div></div>
                    <Link as="button" :href="logout()" class="cursor-pointer hover:text-red-700 hover:border-red-700 border-2 w-fit px-4 py-[0.5px] rounded-2xl border-red-500 text-red-500"><p>Logout</p></Link>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-black">
                        Dasbor Mitra Ekraf
                    </h1>
                    <p class="text-md font-semibold pt-2 text-gray-600">
                        Pengelolaan Mitra untuk manajemen misi dan reward
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div
                        class="rounded-xl bg-linear-to-t from-[#B1D6FF] to-[#D8EBFF] p-4 shadow-xl"
                    >
                        <p class="text-md font-semibold text-gray-700">
                            Total Poin Dikeluarkan
                        </p>
                        <p class="text-3xl font-bold text-gray-900">
                            {{ props.stats.total_points_spent }}
                        </p>
                    </div>
                    <div
                        class="rounded-xl bg-linear-to-t from-[#B1D6FF] to-[#D8EBFF] p-4 shadow-xl"
                    >
                        <p class="text-md font-semibold text-gray-700">
                            Total Reward Misi Selesai
                        </p>
                        <p class="text-3xl font-bold text-gray-900">
                            {{ props.stats.total_missions_redeemed }}
                        </p>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-900">
                        Manajemen Konten
                    </h2>

                    <div class="space-y-3">
                        <Link
                            href="/dashboard/ekraf/mission"
                            class="flex items-center justify-between rounded-xl px-4 py-2 bg-linear-to-r from-[#1485FF] to-[#A3CFFF] hover:from-[#0F6FCC] hover:to-[#7FB8E8] transition-all"
                        >
                            <span class="flex items-center gap-3">
                                <Icon
                                    icon="mdi:target-arrow"
                                    class="text-5xl text-white"
                                ></Icon>
                                <span
                                    class="text-base font-medium text-white"
                                    >Kelola Misi</span
                                >
                            </span>
                            <icon
                                icon="mdi:chevron-right"
                                class="text-3xl text-gray-600"
                            ></icon>
                        </Link>

                        <Link
                            href="/dashboard/ekraf/reward"
                            class="flex items-center justify-between rounded-xl px-4 py-2 bg-linear-to-r from-[#7467D1] to-[#9A90DE] hover:from-[#5C4BB3] hover:to-[#7F74CE] transition-all"
                        >
                            <span class="flex items-center gap-3">
                                <icon
                                    icon="fa-solid:medal"
                                    class="text-5xl text-white"
                                ></icon>
                                <span
                                    class="text-base font-medium text-white"
                                    >Kelola Hadiah</span
                                >
                            </span>
                            <icon
                                icon="mdi:chevron-right"
                                class="text-3xl text-gray-600"
                            ></icon>
                        </Link>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="pt-6 text-xl font-semibold text-gray-900">
                        Menunggu Validasi
                    </h2>

                    <div class="space-y-4 rounded-xl bg-[#D8EBFF] p-4">
                        <div
                            v-for="(reward, index) in props.pendingValidations"
                            :key="index"
                            class="space-y-4"
                        >
                            <div
                                class="flex items-center gap-3 border-b-2 border-gray-400 pb-2"
                            >
                                <div
                                class="h-10 w-10 flex-shrink-0 rounded-full bg-transparent"
                                >
                                <img :src="reward.tourist.profile_url" alt="">
                            
                                </div>
                                <div class="flex-grow">
                                    <p
                                        class="text-sm font-bold text-black"
                                    >
                                        {{ reward.reward.title }}
                                    </p>
                                    <p class="text-xs font-semibold text-gray-500">
                                        {{ reward.tourist.name }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div v-if="props.pendingValidations.length === 0" class="bg-[#D8EBFF] rounded-xl shadow-xl p-4 text-center">
                            <p class="text-gray-500">Tidak ada voucher yang menunggu validasi</p>
                        </div>

                        <div class="space-y-2 border-gray-100 pt-2">
                            <Link
                                href="/dashboard/ekraf/reward/validate-all"
                                method="post"
                                as="button"
                                class="w-full rounded-3xl bg-linear-to-r from-[#146AC7] to-[#75B7FD] px-4 py-2 text-sm font-medium text-white hover:from-[#0F4F9C] hover:to-[#4C90E0] transition-all"
                            >
                                Validasi Sekali Klik
                            </Link>
                            <Link href="/dashboard/ekraf/validation" class="block">
                                <button
                                    class="w-full cursor-pointer rounded-3xl border-2 bg-white px-4 py-2 text-sm font-medium text-black hover:bg-gray-200 transition-all"
                                >
                                    Cek Antrian Validasi
                                </button>
                            </Link>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <nav
            class="right-0 bottom-0 left-0 bg-white"
        >
            <div
                class="mx-auto flex h-16 max-w-lg items-center justify-around px-4"
            >
                <Link href="/dashboard/ekraf" class="p-2">
                    <icon icon="mdi:home" class="text-3xl text-[#1485FF]"></icon>
                </Link>

                <Link href="/dashboard/ekraf/mission" class="p-2">
                    <icon icon="tabler:target-arrow" class="text-3xl text-gray-400"></icon>
                </Link>

                <Link href="/dashboard/ekraf/reward" class="p-2">
                    <icon icon="mdi:gift" class="text-3xl text-gray-400"></icon>
                </Link>
            </div>
        </nav>
</template>
