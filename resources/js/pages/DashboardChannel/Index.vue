<script setup>
import { logout } from '@/routes';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    ekrafPartners: {
        type: Array,
        default: () => [],
    },
    user: {
        type: Object,
        required: true,
    },
    channel: {
        type: Object,
        required: true,
    },
});

console.log(props.ekrafPartners);
</script>

<template>
    <div class="relative min-h-screen bg-[#EBF5FF]">
        <div class="pb-24 md:pb-12">
            <div class="mx-auto">
                <header class="flex items-center justify-between gap-8 p-4">
                    <h1 class="text-xl font-bold text-black">
                        Manajemen Mitra Ekraf
                    </h1>
                    <Link
                        as="button"
                        :href="logout()"
                        class="cursor-pointer rounded-2xl border-2 border-red-500 px-5"
                    >
                        <p class="text-red-500">Logout</p>
                    </Link>
                </header>

                <main class="space-y-4 px-4">
                    <div class="space-y-3 pt-2">
                        <div
                            v-for="partner in ekrafPartners"
                            :key="partner.id"
                            class="space-y-3 overflow-hidden rounded-xl bg-[#D8EBFF] p-4 shadow-xl"
                        >
                            <div class="flex items-start justify-between">
                                <div class="flex min-w-0 flex-col">
                                    <h3
                                        class="text-lg font-semibold text-gray-900"
                                    >
                                        {{ partner.business_name }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ partner.business_address }}
                                    </p>
                                </div>

                                <div
                                    class="ml-4 flex flex-shrink-0 flex-col items-end gap-2"
                                >
                                    <span
                                        v-if="partner.is_verified === 0"
                                        class="flex-shrink-0 rounded-full bg-white px-3 py-0.5 text-xs font-medium text-gray-700"
                                    >
                                        Menunggu Verifikasi
                                    </span>

                                    <span
                                        v-else
                                        class="flex-shrink-0 rounded-full bg-[#85CE4D] px-3 py-0.5 text-xs font-medium text-white"
                                    >
                                        Aktif
                                    </span>

                                    <p class="text-xs text-gray-400">
                                        {{
                                            new Date(
                                                partner.created_at,
                                            ).toLocaleString('id-ID')
                                        }}
                                    </p>
                                </div>
                            </div>

                            <div :class="[
                                'pt-3',
                                partner.is_verified === 0 ? 'grid grid-cols-2 gap-3' : 'w-full'
                            ]">
                                <Link
                                    :href="`/dashboard/channel/ekraf/${partner.id}`"
                                    class="w-full"
                                >
                                    <button
                                        class="w-full rounded-full border border-[#01ABFF] bg-transparent px-4 py-2 text-sm font-medium text-[#01ABFF] transition-all"
                                    >
                                        Lihat Detail
                                    </button>
                                </Link>

                                <Link
                                :href="`/dashboard/channel/ekraf/verify/${partner.id}`"
                                    v-if="partner.is_verified === 0"
                                    class="text-center w-full rounded-full bg-[#01ABFF] px-4 py-2 text-sm font-medium text-white transition-all"
                                >
                                    Verifikasi
                                </Link>
                            </div>
                        </div>

                        <div v-if="!ekrafPartners.length">
                            <p
                                class="pt-6 text-center text-sm font-medium text-gray-500"
                            >
                                Tidak ada daftar mitra
                            </p>
                        </div>

                        <div v-if="!ekrafPartners.length">
                            <p
                                class="pt-6 text-center text-sm font-medium text-gray-500"
                            >
                                Tidak ada daftar mitra
                            </p>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
