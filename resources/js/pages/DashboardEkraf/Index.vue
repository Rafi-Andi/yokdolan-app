<script setup>
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
console.log(props.pendingValidations);
console.log(props.stats);
</script>

<template>
    <Head title="Dasbor Mitra Ekraf" />
    <div class="bg-gray-100">
        <div class="pb-24">
            <main class="space-y-6 px-6 pt-12">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Dasbor Mitra Ekraf
                    </h1>
                    <p class="text-md pt-2 text-gray-500">
                        Pengelolaan Mitra untuk manajemen misi dan reward
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div
                        class="rounded-xl border-2 border-gray-300 bg-white p-4 shadow-sm"
                    >
                        <p class="text-sm font-medium text-gray-500">
                            Total Poin Dikeluarkan
                        </p>
                        <p class="text-3xl font-bold text-gray-900">
                            {{ props.stats.total_points_spent }}
                        </p>
                    </div>
                    <div
                        class="rounded-xl border-2 border-gray-300 bg-white p-4 shadow-sm"
                    >
                        <p class="text-sm font-medium text-gray-500">
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
                            class="flex items-center justify-between rounded-xl bg-gray-300 p-4 transition-all hover:bg-gray-400"
                        >
                            <span class="flex items-center gap-3">
                                <Icon
                                    icon="tabler:target-arrow"
                                    class="text-3xl text-gray-600"
                                ></Icon>
                                <span
                                    class="text-base font-medium text-gray-800"
                                    >Kelola Misi</span
                                >
                            </span>
                            <icon
                                icon="mdi:chevron-right"
                                class="text-3xl text-gray-500"
                            ></icon>
                        </Link>

                        <Link
                            href="/dashboard/ekraf/reward"
                            class="flex items-center justify-between rounded-xl bg-gray-300 p-4 transition-all hover:bg-gray-400"
                        >
                            <span class="flex items-center gap-3">
                                <icon
                                    icon="fa-solid:medal"
                                    class="text-3xl text-gray-600"
                                ></icon>
                                <span
                                    class="text-base font-medium text-gray-800"
                                    >Kelola Hadiah</span
                                >
                            </span>
                            <icon
                                icon="mdi:chevron-right"
                                class="text-3xl text-gray-500"
                            ></icon>
                        </Link>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="pt-6 text-xl font-semibold text-gray-900">
                        Menunggu Validasi
                    </h2>

                    <div class="space-y-4 rounded-xl bg-gray-300 p-4 shadow-sm">
                        <div
                            v-for="(reward, index) in props.pendingValidations"
                            :key="index"
                            class="space-y-4"
                        >
                            <div
                                class="flex items-center gap-3 border-b-2 border-gray-500 pb-2"
                            >
                                <div
                                    class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-600"
                                ></div>
                                <div class="flex-grow">
                                    <p
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ reward.reward.title }}
                                    </p>
                                    <p class="text-xs text-black">
                                        {{ reward.tourist.name }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2 border-gray-100 pt-2">
                            <Link
                                href="/dashboard/ekraf/reward/validate-all"
                                method="post"
                                as="button"
                                class="w-full rounded-3xl bg-gray-600 px-4 py-3 text-sm font-medium text-white transition-all hover:bg-gray-700"
                            >
                                Validasi Sekali Klik
                            </Link>
                            <a href="validasihadiah.html" class="block">
                                <button
                                    class="w-full rounded-3xl border-2 border-white px-4 py-3 text-sm font-medium text-gray-700 transition-all hover:bg-gray-200"
                                >
                                    Cek Antrian Validasi
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <nav
            class="fixed right-0 bottom-0 left-0 border-t border-gray-200 bg-blue-100"
        >
            <div
                class="mx-auto flex h-16 max-w-lg items-center justify-around px-4"
            >
                <Link href="/dashboard/ekraf" class="p-2">
                    <icon icon="mdi:home" class="text-3xl"></icon>
                </Link>

                <Link href="/dashboard/ekraf/mission" class="p-2">
                    <icon icon="tabler:target-arrow" class="text-3xl"></icon>
                </Link>

                <Link href="/dashboard/ekraf/reward" class="p-2">
                    <icon icon="mdi:gift" class="text-3xl"></icon>
                </Link>
            </div>
        </nav>
    </div>
</template>
