<script setup>
import { Icon } from '@iconify/vue';
import { Link, router } from '@inertiajs/vue3';
import { debounce } from 'lodash';
import { ref, watch } from 'vue';

const props = defineProps({
    user: Object,
    channels: Array,
    missions: Array,
    filters: Object,
});

const globalSearch = ref(props.filters.search || '');
const activeType = ref(props.filters.type || null);

const missionTypes = [
    { label: 'Semua', value: null },
    { label: 'Transaksi', value: 'transaksi' },
    { label: 'Promosi', value: 'promosi' },
    { label: 'Interaksi', value: 'interaksi' },
];

const searchHandler = debounce((value) => {
    router.get(
        '/dashboard',
        { search: value, type: activeType.value },
        {
            preserveState: true,
            replace: true,
            preserveScroll: true,
        },
    );
}, 300);

watch(globalSearch, searchHandler);

const setMissionType = (typeValue) => {
    activeType.value = typeValue;
    router.get(
        '/dashboard',
        { search: globalSearch.value, type: typeValue },
        {
            preserveState: true,
            replace: true,
            preserveScroll: true,
        },
    );
};

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
                    <Link as="button" href="/dashboard/profile" class="cursor-pointer h-10 w-10 overflow-hidden rounded-lg bg-transparent ">
                        <img
                            :src="`${user?.profile_url}`"
                            alt="profile"
                            class="h-full w-full object-cover"
                        />
                    </Link>
                </div>

                <div class="flex w-full items-center justify-between p-6">
                    <div class="">
                        <h1 class="text-2xl font-bold text-black">Hallo!</h1>
                        <p class="text-2xl text-black">{{ user?.name }}</p>
                        <p class="text-xs text-gray-500">
                            Wisata Jadi Lebih Seru dengan Misi Berhadiah.
                        </p>
                    </div>
                    <Link href="/dashboard/leaderboard">
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
                    </Link>
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
                                        ?.point_akumulasi ?? '0'
                                }}
                                poin
                            </p>
                            <div
                                class="mb-4 h-1.5 w-16 rounded-full bg-yellow-400"
                            ></div>
                        </div>
                    </div>

                    <Link
                        href="/dashboard/wisata"
                        class="z-10 w-full rounded-full bg-white px-6 py-2 text-center text-sm font-medium text-blue-600 shadow-lg transition duration-300 hover:bg-gray-100"
                    >
                        Dapatkan
                    </Link>
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
                                    '0'
                                }}
                                poin
                            </p>
                            <div
                                class="mb-4 h-1.5 w-16 rounded-full bg-yellow-400"
                            ></div>
                        </div>
                    </div>

                    <Link
                        href="/dashboard/wisata"
                        class="z-10 w-full rounded-full bg-white px-6 py-2 text-center text-sm font-medium text-blue-600 shadow-lg transition duration-300 hover:bg-gray-100"
                    >
                        Dapatkan
                    </Link>
                </div>
            </div>

            <div class="mt-8 flex w-full justify-between gap-3 px-6">
                <div
                    class="relative w-full rounded-lg bg-white p-2 py-4 shadow-md"
                >
                    <input
                        type="text"
                        placeholder="Cari Wisata atau Misi..."
                        v-model="globalSearch"
                        class="w-full px-8 text-gray-800 outline-none"
                    />
                    <Icon
                        icon="material-symbols:search-rounded"
                        class="absolute top-3 left-1 text-3xl text-gray-500"
                    />
                </div>
            </div>

            <div class="p-6">
                <h2 class="text-xl font-bold text-black">Channel Wisata</h2>
            </div>
            <div class="no-scrollbar flex gap-4 overflow-auto pl-6">
                <div
                    v-for="(channel, index) in props.channels"
                    :key="index"
                    :class="index % 2 === 0 ? 'bg-gradient-to-tr from-[#328dee] to-[#bbdbfe]' : 'bg-gradient-to-tr from-[#F4C90D] to-[#f8e799]' "
                    class="w-72 flex-shrink-0 overflow-hidden rounded-xl  shadow-lg"
                >
                    <Link :href="`/dashboard/wisata/${channel.id}`">
                        <div class="relative rounded-lg p-2">
                            <img
                                :src="`${url}/storage/${channel.profile_photo_path}`"
                                alt="Foto Channel"
                                class="h-36 w-full object-cover rounded-lg"
                            />
                            <div
                                class="absolute bottom-3 left-3 rounded-full px-7 py-[2px] text-sm text-white shadow"
                                :class="index %2 === 0 ? 'bg-[#48A9F8]' : 'bg-[#F7B500]' "
                            >
                                {{ channel.missions_count }} Misi
                            </div>
                        </div>
                        <div class="p-2">
                            <h3
                                class="text-[16px] leading-tight font-semibold text-white"
                            >
                                {{ channel.name }}
                            </h3>
                            <p class="text-xs text-white">
                                {{ channel.location }}
                            </p>
                        </div>
                    </Link>
                </div>

                <div
                    v-if="channels.length === 0"
                    class="w-full py-4 pr-6 text-center text-gray-500"
                >
                    <p>Tidak ada channel wisata yang ditemukan.</p>
                </div>
            </div>

            <div class="p-6">
                <h2 class="mb-3 text-xl font-bold text-black">Misi Terbaru</h2>

                <div class="no-scrollbar flex gap-3 overflow-x-auto pb-4">
                    <button
                        v-for="type in missionTypes"
                        :key="type.value"
                        @click="setMissionType(type.value)"
                        :class="[
                            'cursor-pointer flex-shrink-0 rounded-full px-4 py-1.5 text-sm shadow-md transition',
                            activeType === type.value ||
                            (!activeType && type.value === null)
                                ? 'bg-[#1485FF] font-semibold text-white'
                                : 'bg-white text-gray-700',
                        ]"
                    >
                        {{ type.label }}
                    </button>
                </div>
            </div>

            <div class="space-y-4 px-6">
                <div
                    v-for="(mission, index) in props.missions"
                    :key="index"
                    class="flex w-full items-center justify-between rounded-xl bg-white p-3 shadow-md"
                >
                    <div class="flex items-center gap-3">
                        <div
                            :class="[
                                'h-10 w-fit  rounded-lg p-1.5',
                                mission.type === 'Transaksi'
                                    ? 'bg-green-500'
                                    : mission.type === 'Promosi'
                                      ? 'bg-blue-500'
                                      : 'bg-[#ff9900]',
                            ]"
                        >
                            <Icon
                                icon="tabler:target-arrow"
                                class="text-3xl text-white"
                            />
                        </div>
                        <div>
                            <h3
                                class="text-sm leading-tight font-semibold text-gray-800"
                            >
                                {{ mission.title }}
                            </h3>
                            <p class="text-xs text-gray-500">
                                {{ mission.channel?.name }}
                            </p>
                        </div>
                    </div>
                    <Link
                        :href="`/dashboard/misi/${mission.id}`"
                        class="flex items-center gap-1 text-xs font-semibold text-[#1485FF]"
                    >
                        Kerjakan
                        <Icon icon="mdi:chevron-right" class="text-xl" />
                    </Link>
                </div>

                <div
                    v-if="missions.length === 0"
                    class="py-4 text-center text-gray-500"
                >
                    <p>Tidak ada misi yang ditemukan.</p>
                </div>
            </div>

            <div class="h-16"></div>
        </main>
    </div>
    <nav
        class="fixed right-0 bottom-0 left-0 z-50 border-t border-gray-200 bg-white"
        style="border-radius: 30px 30px 0 0"
    >
        <div
            class="mx-auto flex h-20 max-w-lg items-center justify-around px-4"
        >
            <Link
                href="/dashboard"
                class="flex flex-col items-center p-2 text-gray-400"
            >
                <Icon icon="mdi:home" class="text-3xl text-[#1485FF]" />
            </Link>

            <Link
                href="/dashboard/leaderboard"
                class="flex flex-col items-center p-2"
            >
                <Icon
                    icon="material-symbols:leaderboard-rounded"
                    class="text-3xl text-gray-400"
                />
            </Link>

            <Link
                href="/dashboard/scan"
                class="-mt-10 rounded-full bg-[#1485FF] p-4 shadow-lg"
            >
                <Icon icon="mdi:qrcode-scan" class="text-4xl text-white" />
            </Link>

            <Link
                href="/dashboard/wisata"
                class="flex flex-col items-center p-2 text-gray-400"
            >
                <Icon icon="streamline-flex:target-solid" class="text-3xl" />
            </Link>

            <Link
                href="/dashboard/hadiah"
                class="flex flex-col items-center p-2 text-gray-400"
            >
                <Icon icon="mdi:gift" class="text-3xl" />
            </Link>
        </div>
    </nav>
</template>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
