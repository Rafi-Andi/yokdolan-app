<script setup>
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    user: Object,
    channels: Array,
});

console.log(props.channels);

console.log(props.user);
const url = 'http://127.0.0.1:8000';
</script>

<template>
    <div class="bg-[#EBF5FF] pb-24">
        <main class="relative">
            <div
                class="container-header w-full rounded-b-[45px] bg-[#D8EBFF] pb-20"
            >
                <div class="flex w-full justify-between p-6">
                    <p class="text-lg font-bold text-[#1485FF]">YokDolan</p>
                    <div class="h-10 w-10 overflow-hidden rounded-lg bg-black">
                        <img
                            src="https://i.ibb.co/6yTXMLN/image-961bf3.jpg"
                            alt="profile"
                            class="h-full w-full object-cover"
                        />
                    </div>
                </div>

                <div class="flex w-full items-center justify-between p-6">
                    <div class="">
                        <h1 class="text-2xl font-bold">Hallo!</h1>
                        <p class="text-2xl">{{ user?.name }}</p>
                        <p class="text-xs text-gray-500">
                            Wisata Jadi Lebih Seru dengan Misi Berhadiah.
                        </p>
                    </div>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="30"
                        height="25"
                        viewBox="0 0 640 512"
                    >
                        <path
                            fill="#1485FF"
                            d="M353.8 54.1L330.2 6.3c-3.9-8.3-16.1-8.6-20.4 0l-23.6 47.8l-52.3 7.5c-9.3 1.4-13.3 12.9-6.4 19.8l38 37l-9 52.1c-1.4 9.3 8.2 16.5 16.8 12.2l46.9-24.8l46.6 24.4c8.6 4.3 18.3-2.9 16.8-12.2l-9-52.1l38-36.6c6.8-6.8 2.9-18.3-6.4-19.8l-52.3-7.5zM256 256c-17.7 0-32 14.3-32 32v192c0 17.7 14.3 32 32 32h128c17.7 0 32-14.3 32-32V288c0-17.7-14.3-32-32-32zM32 320c-17.7 0-32 14.3-32 32v128c0 17.7 14.3 32 32 32h128c17.7 0 32-14.3 32-32V352c0-17.7-14.3-32-32-32zm416 96v64c0 17.7 14.3 32 32 32h128c17.7 0 32-14.3 32-32v-64c0-17.7-14.3-32-32-32H480c-17.7 0-32 14.3-32 32"
                        />
                    </svg>
                </div>
            </div>

            <div
                class="no-scrollbar z-10 -mt-20 flex w-full flex-nowrap gap-4 overflow-x-auto px-6"
            >
                <div
                    class="relative flex h-fit w-50 flex-shrink-0 flex-col items-center justify-between overflow-hidden rounded-3xl bg-gradient-to-tr from-[#1485FF] to-[#A3CFFF] p-4 text-white shadow-xl"
                >
                    <div class="z-10 flex w-full flex-col gap-8">
                        <div
                            class="bg-opacity-20 mb-2 w-fit rounded-full bg-white p-3"
                        >
                            <Icon
                                icon="mdi:medal"
                                class="text-4xl text-yellow-500"
                            ></Icon>
                        </div>
                        <div class="">
                            <h2 class="mb-1 text-xl font-semibold">
                                Poin Misi
                            </h2>
                            <p class="mb-3 text-sm">
                                {{
                                    props.user?.tourist_profile
                                        ?.point_akumulasi ?? 'Loading...'
                                }}
                                poin
                            </p>
                            <div
                                class="mb-4 h-1.5 w-16 rounded-full bg-yellow-400"
                            ></div>
                        </div>
                    </div>

                    <button
                        class="z-10 w-full rounded-full bg-white px-6 py-2 text-sm font-medium text-blue-600 shadow-lg transition duration-300 hover:bg-gray-100"
                    >
                        Dapatkan
                    </button>
                </div>

                <div
                    class="relative flex h-fit w-50 flex-shrink-0 flex-col items-center justify-between overflow-hidden rounded-3xl bg-gradient-to-tr from-[#7467D1] to-[#aea4ec] p-4 text-white shadow-xl"
                >
                    <div class="z-10 flex w-full flex-col gap-8">
                        <div
                            class="bg-opacity-20 mb-2 w-fit rounded-full bg-white p-3"
                        >
                            <Icon
                                icon="material-symbols:stars"
                                class="text-4xl text-blue-500"
                            ></Icon>
                        </div>
                        <div class="">
                            <h2 class="mb-1 text-xl font-semibold">
                                Poin Hadiah
                            </h2>
                            <p class="mb-3 text-sm">
                                {{
                                    props.user?.tourist_profile?.point_value ??
                                    'Loading...'
                                }}
                                poin
                            </p>
                            <div
                                class="mb-4 h-1.5 w-16 rounded-full bg-yellow-400"
                            ></div>
                        </div>
                    </div>

                    <button
                        class="z-10 w-full rounded-full bg-white px-6 py-2 text-sm font-medium text-blue-600 shadow-lg transition duration-300 hover:bg-gray-100"
                    >
                        Dapatkan
                    </button>
                </div>
            </div>

            <div class="mt-8 flex w-full justify-between gap-3 px-6">
                <div class="relative w-full rounded-lg bg-white p-2 py-4">
                    <input
                        type="text"
                        placeholder="Cari hadiah..."
                        class="px-8 outline-none"
                    />
                    <Icon
                        icon="material-symbols:search-rounded"
                        class="absolute top-3 text-3xl"
                    />
                </div>
                <div
                    class="flex h-fit w-fit items-center justify-center rounded-lg bg-[#01ABFF] p-2"
                >
                    <Icon icon="mage:filter" class="text-4xl" />
                </div>
            </div>

            <div class="p-6">
                <h2 class="text-xl font-bold">Channel Wisata</h2>
            </div>

            <div class="no-scrollbar flex gap-4 overflow-auto pl-6">
                <div
                    v-for="(channel, index) in props.channels"
                    :key="index"
                    class="w-72 flex-shrink-0 overflow-hidden rounded-xl bg-[#9DCCFF] shadow-md"
                >
                    <div class="relative rounded-lg p-2">
                        <img
                            :src="`${url}/storage/${channel.profile_photo_path}`"
                            alt="Kampoeng Heritage Kajoetangan"
                            class="h-36 w-full object-cover"
                        />
                        <div
                            class="absolute bottom-3 left-3 rounded-full bg-[#48A9F8] px-7 py-[2px] text-sm text-white shadow"
                        >
                            {{ channel.missions_count }} Misi
                        </div>
                    </div>
                    <div class="p-2">
                        <h3
                            class="text-[16px] leading-tight font-semibold text-black"
                        >
                            {{ channel.name }}
                        </h3>
                        <p class="text-xs text-gray-600">
                            {{ channel.location }}
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <nav
        class="fixed right-0 bottom-0 left-0 border-t border-gray-200 bg-white"
        style="border-radius: 30px 30px 0 0"
    >
        <div
            class="mx-auto flex h-20 max-w-lg items-center justify-around px-4"
        >
            <Link
                href="/dashboard"
                class="flex flex-col items-center p-2 text-gray-400"
            >
                <Icon icon="mdi:home" class="text-3xl text-[#1485FF]"></Icon>
            </Link>

            <Link
                href="/dashboard/leaderboard"
                class="flex flex-col items-center p-2"
            >
                <Icon
                    icon="material-symbols:leaderboard-rounded"
                    class="text-3xl text-gray-400"
                ></Icon>
            </Link>

            <Link
                href="/dashboard/scan"
                class="-mt-10 rounded-full bg-[#1485FF] p-4 shadow-lg"
            >
                <Icon icon="mdi:qrcode-scan" class="text-4xl text-white"></Icon>
            </Link>

            <Link
                href="/dashboard/wisata"
                class="flex flex-col items-center p-2 text-gray-400"
            >
                <Icon
                    icon="streamline-flex:target-solid"
                    class="text-3xl"
                ></Icon>
            </Link>

            <Link
                href="/dashboard/hadiah"
                class="flex flex-col items-center p-2 text-gray-400"
            >
                <Icon icon="mdi:gift" class="text-3xl"></Icon>
            </Link>
        </div>
    </nav>
</template>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none; /* IE dan Edge */
    scrollbar-width: none; /* Firefox */
}
</style>
