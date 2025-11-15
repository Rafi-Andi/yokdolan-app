<script setup>
import { Icon } from '@iconify/vue';
import { Link, router } from '@inertiajs/vue3';
import { debounce } from 'lodash';
import { ref, watch } from 'vue';

const props = defineProps({
    wisata: Object, 
    filters: Object, 
});

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
    <div class="bg-[#D8EBFF] text-white pb-32">
        <main class="relative">
            <div class="flex w-full justify-between items-center p-6">
                <div>
                    <h1 class="font-bold text-3xl text-black">Ayo Jelajahi!</h1>
                    <p class="text-sm text-black">Jelajahi wisata dan selesaikan misinya!</p>
                    <Link href="/register/channel">
                        <div class="rounded-3xl text-black font-bold border border-black w-fit px-4 py-1 mt-2">
                            <p>Daftar Channel Wisata</p>
                        </div>

                    </Link>
                </div>
            </div>

            <div class="px-6 mt-6">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                        <Icon icon="mdi:magnify" class="text-2xl text-black" />
                    </span>
                    <input
                        type="text"
                        placeholder="Cari Channel Wisata disini...."
                        v-model="search" class="w-full bg-[#EBF2FA] text-black placeholder-gray-500 rounded-xl py-3.5 pl-12 pr-4 focus:outline-none"
                    />
                </div>
            </div>

            <div class="px-6 mt-8 space-y-6">
                <div
                    v-for="(wisatas, index) in props.wisata.data ?? []"
                    :key="wisatas?.id ?? index"
                    :class="[
                        'rounded-4xl p-6 flex justify-between items-center shadow-lg',
                        index % 2 === 0
                            ? 'bg-gradient-to-tr from-[#5372EE] to-[#0BB6FC]'
                            : 'bg-gradient-to-tr from-[#FA9F47] to-[#F3D16F]'
                    ]"
                >
                    <div class="w-full">
                        <h2 class="text-xl font-semibold text-white">{{ wisatas?.name ?? '—' }}</h2>
                        <p class="text-white">{{ wisatas?.location ?? 'Lokasi tidak tersedia' }}</p>
                        <div class="w-full flex justify-end">
                            <Link 
                                v-if="wisatas?.id"
                                :href="`/dashboard/wisata/${wisatas.id}`" 
                                class="border border-white w-fit py-1 px-6 rounded-full"
                            >
                                <p class="text-sm">Kunjungi</p>
                            </Link>
                        </div>
                    </div>
                </div>
                
                <div v-if="props.wisata.data.length === 0" class="text-center text-black/70 py-10">
                    <p>Tidak ada channel wisata yang ditemukan.</p>
                </div>
                
                <div class="mt-8 pt-4 pb-12 flex justify-center">
                    <template v-for="(link, key) in wisata.links" :key="key">
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
            </div>
        </main>
        
        <nav
            class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50"
            style="border-radius: 30px 30px 0 0;"
        >
            <div class="flex justify-around items-center h-20 max-w-lg mx-auto px-4">
                <Link href="/dashboard" class="p-2 flex flex-col items-center text-gray-400">
                    <Icon icon="mdi:home" class="text-3xl text-gray-400"></Icon>
                </Link>

                <Link href="/dashboard/leaderboard" class="p-2 flex flex-col items-center">
                    <Icon icon="material-symbols:leaderboard-rounded" class="text-3xl text-gray-400"></Icon>
                </Link>

                <Link href="/dashboard/scan" class="p-4 bg-[#1485FF] rounded-full -mt-10 shadow-lg">
                    <Icon icon="mdi:qrcode-scan" class="text-4xl text-white"></Icon>
                </Link>

                <Link href="/dashboard/wisata" class="p-2 flex flex-col items-center text-[#1485FF]">
                    <Icon icon="streamline-flex:target-solid" class="text-3xl"></Icon>
                </Link>

                <Link href="/dashboard/hadiah" class="p-2 flex flex-col items-center text-gray-400">
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