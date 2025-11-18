<script setup>
const props = defineProps({
    ekraf: {
        type: Object,
        required: true,
    },
});
console.log(props.ekraf);
import { Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';
</script>

<template>
    <div class="relative min-h-screen bg-[#EBF5FF]">
        <div class="pb-20 md:pb-6">
            <div class="mx-auto">
                <header class="flex items-center gap-16 p-4">
                    <Link href="/dashboard/channel" class="text-gray-800">
                        <Icon icon="mdi:arrow-left" class="text-3xl" />
                    </Link>
                    <h1 class="text-xl font-bold text-black">Detail Mitra</h1>
                </header>

                <main class="space-y-5 px-4">
                    <div
                        class="mt-8 rounded-xl bg-gradient-to-r from-[#0BB6FC] to-[#5372EE] px-3 py-4 shadow-lg"
                    >
                        <h2 class="text-md font-bold text-white">
                            {{ ekraf.business_name }}
                        </h2>

                        <p class="text-sm text-white">
                            {{ ekraf.business_address }}
                        </p>

                        <!-- STATUS -->
                        <div
                            class="mt-3 inline-flex items-center gap-2 rounded-2xl bg-white px-3 py-1.5 text-black"
                        >
                            <Icon
                                v-if="ekraf.is_verified === 0"
                                icon="mdi:timer-sand"
                                class="text-lg"
                            />
                            <Icon
                                v-else
                                icon="mdi:check-decagram"
                                class="text-lg text-green-600"
                            />

                            <span class="text-sm font-medium">
                                {{ ekraf.is_verified === 0
                                    ? 'Menunggu Verifikasi'
                                    : 'Sudah Diverifikasi'
                                }}
                            </span>
                        </div>
                    </div>

                    <!-- INFORMASI KONTAK -->
                    <div class="pt-4">
                        <h3 class="mb-2 text-lg font-bold text-gray-900">
                            Informasi Kontak
                        </h3>

                        <div
                            class="mt-4 rounded-xl bg-[#D8EBFF] px-3 py-4 shadow-lg"
                        >
                            <ul class="space-y-4">
                                <!-- Telepon -->
                                <li class="flex items-center gap-4">
                                    <div
                                        class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-white"
                                    >
                                        <Icon
                                            icon="mdi:phone-outline"
                                            class="text-xl text-gray-800"
                                        />
                                    </div>
                                    <p class="font-medium text-gray-800">
                                        {{ ekraf.phone ?? 'Tidak ada nomor' }}
                                    </p>
                                </li>

                                <!-- Email (dari user) -->
                                <li class="flex items-center gap-4">
                                    <div
                                        class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-white"
                                    >
                                        <Icon
                                            icon="mdi:email-outline"
                                            class="text-xl text-gray-800"
                                        />
                                    </div>
                                    <p
                                        class="min-w-0 break-words font-medium text-gray-800"
                                    >
                                        {{ ekraf.user?.email ?? 'Tidak ada email' }}
                                    </p>
                                </li>

                                <!-- Alamat -->
                                <li class="flex items-center gap-4">
                                    <div
                                        class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-white"
                                    >
                                        <Icon
                                            icon="mynaui:location"
                                            class="text-xl text-gray-800"
                                        />
                                    </div>
                                    <p class="font-medium text-gray-800">
                                        {{ ekraf.business_address }}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div
            class="bottom-0 w-full p-6 md:relative md:mt-6 md:border-t-0 md:bg-transparent"
        >
            <div class="mx-auto max-w-2xl space-y-2">
                
                
                <div class="grid gap-3" :class="ekraf.is_verified ? 'grid-cols-1' : 'grid-cols-2'">
                    <button
                        v-if="ekraf.is_verified === 0"
                        class="w-full rounded-3xl bg-[#01ABFF] px-4 py-3 text-base font-medium text-white transition-all"
                    >
                        Verifikasi Mitra
                    </button>
                    <Link
                        href="/dashboard/channel"
                        class="block"
                    >
                        <button
                            class="w-full rounded-3xl border border-[#01ABFF] bg-transparent px-4 py-3 text-base font-medium text-[#01ABFF] transition-all"
                        >
                            Kembali
                        </button>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
