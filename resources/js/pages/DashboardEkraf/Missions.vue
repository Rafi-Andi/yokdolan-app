<script setup>
import { Icon } from '@iconify/vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { debounce } from 'lodash';
import { ref, watch } from 'vue';

const props = defineProps({
    missions: Object,
    filters: Object,
});

const search = ref(props.filters?.search || '');

const searchHandler = debounce((value) => {
    router.get(
        '/dashboard/ekraf/mission',
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
    <Head title="Daftar Misi Ekraf"/>
    <div class="min-h-screen bg-[#EBF5FF]">
            <div class="h-fit rounded-b-[50px] bg-[url('/images/texture.png')] bg-cover bg-center bg-no-repeat mb-6">
                <div class="flex items-center gap-19 p-4">
                    <Link href="/dashboard/ekraf" class="text-gray-800">
                        <icon
                            icon="mdi:arrow-left"
                            class="text-2xl text-white"
                        ></icon>
                    </Link>
                    <h1 class="text-xl font-bold text-white">Daftar Misi</h1>
                </div>
                <div class="relative w-full pt-6 pb-12 px-6">
                    <div class="absolute top-8 left-8">
                        <icon
                            icon="mdi:search"
                            class="text-3xl text-black"
                        ></icon>
                    </div>
                    <input
                        type="text"
                        placeholder="Cari misi..."
                        v-model="search"
                        class="w-full rounded-xl border-none text-black bg-white py-3 pl-12"
                    />
                </div>
            </div>

            <main class="space-y-4 px-4">
                <div class="space-y-3">
                    <Link v-for="(mission, index) in missions.data ?? []" :key="mission.id" :href="`/dashboard/ekraf/mission/${mission.id}`" class="block">
                        <div
                            :class="[
                                'flex items-start justify-between rounded-xl p-4', 
                                index % 3 === 0 ? 'bg-linear-to-r from-[#29A983] to-[#ACDD36]' : 
                                index % 3 === 1 ? 'bg-linear-to-r from-[#329ED6] to-[#54C5F0]' : 
                                'bg-linear-to-r from-[#EE924C] to-[#F0DC55]'
                            ]"
                        >
                            <div>
                                <p class="font-semibold text-white">
                                    {{ mission.title }}
                                </p>
                                <p class="text-sm text-white">
                                    Tipe: {{ mission.type }}
                                </p>
                            </div>
                            <div
                                class="flex flex-shrink-0 items-center gap-1.5"
                            >
                                <icon
                                    icon="el:star-alt"
                                    class="text-xl text-gray-600"
                                ></icon>
                                <span class="text-sm font-medium text-white"
                                    >{{ mission.reward_points }} Poin</span
                                >
                            </div>
                        </div>
                    </Link>
                    
                    <div v-if="missions.data && missions.data.length === 0" class="text-center text-gray-600 py-10">
                        <p>Tidak ada misi yang ditemukan.</p>
                    </div>
                </div>
                
                <div class="mt-8 pt-4 pb-12 flex justify-center">
                    <template v-for="(link, key) in missions.links" :key="key">
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
        <Link
            href="/dashboard/ekraf/add-mission"
            class="fixed right-6 bottom-24 flex h-14 w-14 items-center justify-center rounded-full bg-white shadow-lg"
        >
            <icon
                icon="mdi:plus"
                class="text-3xl text-[#1485FF]"
            ></icon>
        </Link>

        <nav
            class="fixed right-0 bottom-0 left-0 bg-white"
        >
            <div
                class="mx-auto flex h-16 max-w-lg items-center justify-around px-4"
            >
                <Link href="/dashboard/ekraf" class="p-2">
                    <icon icon="mdi:home" class="text-3xl text-gray-400"></icon>
                </Link>

                <Link href="/dashboard/ekraf/mission" class="p-2">
                    <icon icon="tabler:target-arrow" class="text-3xl text-[#1485FF]"></icon>
                </Link>

                <Link href="/dashboard/ekraf/reward" class="p-2">
                    <icon icon="mdi:gift" class="text-3xl text-gray-400"></icon>
                </Link>
            </div>
        </nav>
</template>