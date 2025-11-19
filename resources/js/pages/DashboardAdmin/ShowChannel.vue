<script setup>
import { email } from '@/routes/password';
import { Icon } from '@iconify/vue';
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps({
    channel: Object,
    adminEmail: String,
});

const url = 'http://127.0.0.1:8000';

console.log(props.channel);
</script>

<template>
    <Head title="Detail Wisata"></Head>
    <div class="relative min-h-screen bg-[#EBF5FF]">
        <div class="pb-20 md:pb-6">
            <div class="mx-auto">
                <header class="flex items-center gap-16 p-4">
                    <Link href="/dashboard/admin" class="text-gray-800">
                        <Icon
                            icon="mdi:arrow-left"
                            class="text-3xl"
                        ></Icon>
                    </Link>
                    <h1 class="text-xl font-bold text-black">Detail Wisata</h1>
                </header>

                <main class="space-y-5 px-4">
                    <div
                        class="mt-8 rounded-xl bg-gradient-to-r from-[#0BB6FC] to-[#5372EE] px-3 py-4 shadow-lg"
                    >
                        <h2 class="text-md font-bold text-white">
                            {{ channel.name }}
                        </h2>
                        <p class="text-sm text-white">
                            {{ channel.location }}
                        </p>

                        <div
                            class="mt-3 inline-flex items-center gap-2 rounded-2xl text-black"
                        >
                            <Icon
                                icon="mdi:timer-sand"
                                class="text-lg"
                            ></Icon>
                            <span
                                v-if="channel.is_active"
                                class="flex-shrink-0 rounded-full bg-[#85CE4D] px-3 py-0.5 text-xs font-medium text-white"
                                >Aktif</span
                            >
                            <span
                                v-else-if="
                                    !channel.is_active && !channel.is_verified
                                "
                                class="flex-shrink-0 rounded-full bg-white px-3 py-0.5 text-xs font-medium text-gray-700"
                                >Menunggu Verifikasi</span
                            >
                            <span
                                v-else
                                class="flex-shrink-0 rounded-full bg-[#E52C2C] px-3 py-0.5 text-xs font-medium text-white"
                                >Nonaktif</span
                            >
                        </div>
                    </div>

                    <div class="pt-4">
                        <h3 class="mb-2 text-lg font-bold text-gray-900">
                            Informasi Kontak
                        </h3>

                        <div
                            class="mt-4 space-y-4 rounded-xl bg-[#D8EBFF] px-3 py-4 shadow-lg"
                        >
                            <ul class="space-y-4">
                                <li class="flex items-center gap-4">
                                    <div
                                        class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-white"
                                    >
                                        <Icon
                                            icon="mdi:phone-outline"
                                            class="text-xl text-gray-800"
                                        ></Icon>
                                    </div>
                                    <p class="font-medium text-gray-800">
                                        {{ channel.phone }}
                                    </p>
                                </li>

                                <li class="flex items-center gap-4">
                                    <div
                                        class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-white"
                                    >
                                        <Icon
                                            icon="mdi:email-outline"
                                            class="text-xl text-gray-800"
                                        ></Icon>
                                    </div>
                                    <p
                                        class="min-w-0 font-medium break-words text-gray-800"
                                    >
                                        {{ adminEmail }}
                                    </p>
                                </li>

                                <li class="flex items-center gap-4">
                                    <div
                                        class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-white"
                                    >
                                        <Icon
                                            icon="mynaui:location"
                                            class="text-xl text-gray-800"
                                        ></Icon>
                                    </div>
                                    <p class="font-medium text-gray-800">
                                        {{ channel.location }}
                                    </p>
                                </li>
                            </ul>

                            <div class="pt-2">
                                <div
                                    class="flex h-48 w-full items-center justify-center rounded-xl"
                                >
                                    <img :src="`${url}/storage/${channel.profile_photo_path}`" alt="Foto Wisata">
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <div
            class="bottom-0 w-full p-6 md:relative md:mt-6 md:border-t-0 md:bg-transparent"
        >
            <div class="mx-auto max-w-2xl space-y-2">
                <div v-if="channel.is_active">
                    <Link as="button" :href="`/dashboard/admin/wisata/deactivate/${channel.id}`"
                        class="cursor-pointer w-full rounded-3xl bg-[#E52C2C] px-4 py-3 text-base font-medium text-white transition-all"
                    >
                        Nonaktifkan Wisata
                    </Link>
                    <div class="mt-3">
                        <a href="/dashboard/admin" class="block">
                            <button
                                class=" cursor-pointer w-full rounded-3xl border border-[#01ABFF] bg-transparent px-4 py-3 text-base font-medium text-[#01ABFF] transition-all"
                            >
                                Kembali
                            </button>
                        </a>
                    </div>
                </div>

                <div v-else-if="!channel.is_verified">
                    <Link as="button" :href="`/dashboard/admin/wisata/verify/${channel.id}`"
                        class="cursor-pointer w-full rounded-3xl bg-[#01ABFF] px-4 py-3 text-base font-medium text-white transition-all"
                    >
                        Verifikasi Wisata
                    </Link>
                    <div class="gap-3 mt-3">
                        <Link href="/dashboard/admin" class="block">
                            <button
                                class="cursor-pointer w-full rounded-3xl border border-[#01ABFF] bg-transparent px-4 py-3 text-base font-medium text-[#01ABFF] transition-all"
                            >
                                Kembali
                            </button>
                        </Link>
                    </div>
                </div>

                <div v-else>
                    <Link as="button" :href="`/dashboard/admin/wisata/activate/${channel.id}`"
                        class="cursor-pointer w-full rounded-3xl bg-[#85CE4D] px-4 py-3 text-base font-medium text-white transition-all"
                    >
                        Aktifkan Wisata
                    </Link>
                    <div class="grid  gap-3 mt-3">
                        <Link href="/dashboard/admin" class="block">
                            <button
                                class="cursor-pointer w-full rounded-3xl border border-[#01ABFF] bg-transparent px-4 py-3 text-base font-medium text-[#01ABFF] transition-all"
                            >
                                Kembali
                            </button>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
