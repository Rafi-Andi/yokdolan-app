<script setup>
import { Icon } from '@iconify/vue';
import { Link, router } from '@inertiajs/vue3';
import { debounce } from 'lodash';
import { ref, watch } from 'vue';

const props = defineProps({
    wisata: Object,
    filters: Object,
    user: Object,
});

console.log(props.user)

const url = 'http://127.0.0.1:8000';

const search = ref(props.filters.search || '');

const searchHandler = debounce((value) => {
    router.get(
        '/dashboard/wisata',
        { search: value },
        {
            preserveState: true,
            replace: true,
            preserveScroll: true,
        },
    );
}, 300);

watch(search, searchHandler);
</script>

<template>
    <div class="bg-[#D8EBFF] pb-32 text-white">
        <main class="relative">
            <div class="flex w-full items-center justify-between p-6">
                <div>
                    <h1 class="text-3xl font-bold text-black">Ayo Jelajahi!</h1>
                    <p class="text-sm text-black">
                        Jelajahi wisata dan selesaikan misinya!
                    </p>
                    <Link href="/register/channel">
                        <div
                            class="mt-2 w-fit rounded-3xl border border-black px-4 py-1 font-bold text-black"
                        >
                            <p>Daftar Channel Wisata</p>
                        </div>
                    </Link>
                </div>
                <Link
                    as="button"
                    href="/dashboard/profile"
                    class="h-10 w-10 cursor-pointer overflow-hidden rounded-lg bg-transparent"
                >
                    <img
                        :src="user?.profile_url "
                        alt="profile"
                        class="h-full w-full object-cover"
                    />
                </Link>
            </div>

            <div class="mt-6 px-6">
                <div class="relative">
                    <span
                        class="absolute inset-y-0 left-0 flex items-center pl-4"
                    >
                        <Icon icon="mdi:magnify" class="text-2xl text-black" />
                    </span>
                    <input
                        type="text"
                        placeholder="Cari Channel Wisata disini...."
                        v-model="search"
                        class="w-full rounded-xl bg-[#EBF2FA] py-3.5 pr-4 pl-12 text-black placeholder-gray-500 focus:outline-none"
                    />
                </div>
            </div>

            <div class="mt-8 space-y-6 px-6">
                <div
                    v-for="(wisatas, index) in props.wisata.data ?? []"
                    :key="wisatas?.id ?? index"
                            :class="[
                                'flex items-start justify-between rounded-4xl p-6', 
                                index % 4 === 0 ? 'bg-linear-to-r from-[#5372EE] to-[#0BB6FC]' : 
                                index % 4 === 1 ? 'bg-linear-to-r from-[#FA9F47] to-[#F3D16F]' : 
                                index % 4 === 2 ? 'bg-linear-to-r from-[#A38ECE] to-[#F8BCE8]' : 
                                'bg-linear-to-r from-[#ED896C] to-[#EE6E9E]'
                            ]"
                >
                    <div class="w-full">
                        <h2 class="text-xl font-semibold text-white">
                            {{ wisatas?.name ?? '—' }}
                        </h2>
                        <p class="text-white">
                            {{ wisatas?.location ?? 'Lokasi tidak tersedia' }}
                        </p>
                        <div class="flex w-full justify-end">
                            <Link
                                v-if="wisatas?.id"
                                :href="`/dashboard/wisata/${wisatas.id}`"
                                class="w-fit rounded-full border border-white px-6 py-1"
                            >
                                <p class="text-sm">Kunjungi</p>
                            </Link>
                        </div>
                    </div>
                </div>

                <div
                    v-if="props.wisata.data.length === 0"
                    class="py-10 text-center text-black/70"
                >
                    <p>Tidak ada channel wisata yang ditemukan.</p>
                </div>

                <div class="mt-8 flex justify-center pt-4 pb-12">
                    <template v-for="(link, key) in wisata.links" :key="key">
                        <div
                            v-if="link.url === null"
                            class="mr-1 mb-1 rounded-lg border border-none px-3 py-2 text-xs leading-4 text-gray-500"
                            v-html="link.label"
                        />
                        <Link
                            v-else
                            class="mr-1 mb-1 rounded-lg border px-3 py-2 text-xs leading-4 transition hover:bg-white/50"
                            :class="{
                                'border-none bg-[#1485FF] text-white':
                                    link.active,
                                'bg-white text-black': !link.active,
                            }"
                            :href="link.url"
                            v-html="link.label"
                            preserve-scroll
                            preserve-state
                        />
                    </template>
                </div>
            </div>
        </main>

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
                    <Icon icon="mdi:home" class="text-3xl text-gray-400"></Icon>
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
                    <Icon
                        icon="mdi:qrcode-scan"
                        class="text-4xl text-white"
                    ></Icon>
                </Link>

                <Link
                    href="/dashboard/wisata"
                    class="flex flex-col items-center p-2 text-[#1485FF]"
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
    </div>
</template>

<style>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
