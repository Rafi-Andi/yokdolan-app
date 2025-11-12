<script setup>
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps({
    missions: Array,
});
console.log(props.missions);
</script>

<template>
    <Head title="Daftar Misi Ekraf"/>
    <div class="bg-gray-50">
        <div class="pb-24">
            <header class="flex items-center gap-14 p-4">
                <a href="index.html" class="text-gray-800">
                    <iconify-icon
                        icon="mdi:arrow-left"
                        class="text-2xl"
                    ></iconify-icon>
                </a>
                <h1 class="text-xl font-bold text-gray-900">Daftar Misi</h1>
            </header>

            <main class="space-y-4 px-4">
                <div class="relative w-full pt-6 pb-12">
                    <div class="absolute top-8 left-2">
                        <iconify-icon
                            icon="mdi:search"
                            class="text-3xl text-gray-400"
                        ></iconify-icon>
                    </div>
                    <input
                        type="text"
                        placeholder="Cari misi..."
                        class="w-full rounded-xl border-none bg-gray-200 py-3 pr-4 pl-12 focus:ring-2 focus:ring-gray-300 focus:outline-none"
                    />
                </div>

                <div class="space-y-3">
                    <a v-for="(mission, index) in missions" :key="index" href="detailmisi.html" class="block">
                        <div
                            class="flex items-start justify-between rounded-xl bg-gray-200 p-4"
                        >
                            <div>
                                <p class="font-semibold text-gray-900">
                                    {{ mission.title }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Tipe: {{ mission.type }}
                                </p>
                            </div>
                            <div
                                class="flex flex-shrink-0 items-center gap-1.5"
                            >
                                <iconify-icon
                                    icon="el:star-alt"
                                    class="text-xl text-gray-600"
                                ></iconify-icon>
                                <span class="text-sm font-medium text-gray-700"
                                    >{{ mission.reward_points }} Poin</span
                                >
                            </div>
                        </div>
                    </a>
                </div>
            </main>
        </div>
        <Link
            href="/dashboard/ekraf/add-mission"
            class="fixed right-6 bottom-24 flex h-14 w-14 items-center justify-center rounded-full bg-gray-200 shadow-lg transition-all hover:bg-gray-300"
        >
            +
    </Link>

        <nav
            class="fixed right-0 bottom-0 left-0 border-t border-gray-200 bg-blue-100"
        >
            <div
                class="mx-auto flex h-16 max-w-lg items-center justify-around px-4"
            >
                <a href="index.html" class="p-2">
                    <iconify-icon
                        icon="mdi:home"
                        class="text-3xl"
                    ></iconify-icon>
                </a>

                <a href="daftarmisi.html" class="p-2">
                    <iconify-icon
                        icon="tabler:target-arrow"
                        class="text-3xl"
                    ></iconify-icon>
                </a>

                <a href="daftarhadiah.html" class="p-2">
                    <iconify-icon
                        icon="mdi:gift"
                        class="text-3xl"
                    ></iconify-icon>
                </a>
            </div>
        </nav>
    </div>
</template>
