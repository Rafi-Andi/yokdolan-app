<script setup>
import { Icon } from '@iconify/vue';
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps({
    rewards: Array,
});
console.log(props.rewards)
</script>

<template>
    <Head title="Daftar Hadiah Ekraf"/>
    <div class="bg-[#EBF5FF]">
        <div class="pb-100">
            <div class="h-fit rounded-b-[50px] bg-[url('/images/texture.png')] bg-cover bg-center bg-no-repeat mb-6">
            <div class="flex items-center gap-19 p-4">
                <Link href="/dashboard/ekraf" class="text-gray-800">
                    <icon
                        icon="mdi:arrow-left"
                        class="text-2xl text-white"
                    ></icon>
                </Link>
                <h1 class="text-xl font-bold text-white">Daftar Hadiah</h1>
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
                        placeholder="Cari hadiah..."
                        class="w-full rounded-xl border-none text-black bg-white py-3 pl-12"
                    />
                </div>
            </div>

            <main class="space-y-4 px-4">

                <div class="space-y-3">
                    <a v-for="(reward, index) in rewards" :key="index" href="detailhadiah.html" class="block">
                        <div
                            :class="[
                                'flex items-start justify-between rounded-xl p-4', 
                                index % 2 === 0 ? 'bg-linear-to-l from-[#FFE0B2] to-[#FFF3E0]' : 'bg-linear-to-l from-[#F8BBD0] to-[#FCE4EC]'
                            ]"
                        >
                            <div>
                                <p class="font-semibold text-gray-900">
                                    {{ reward.title }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Tipe: {{ reward.type }}
                                </p>
                            </div>
                            <div
                                class="flex flex-shrink-0 items-center gap-1.5"
                            >
                                <icon
                                    icon="el:star-alt"
                                    class="text-xl text-gray-600"
                                ></icon>
                                <span class="text-sm font-medium text-gray-700"
                                    >{{ reward.points_cost }} Poin</span
                                >
                            </div>
                        </div>
                    </a>
                </div>
            </main>
        </div>
        <Link
            href="/dashboard/ekraf/add-reward"
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
                    <icon icon="mdi:home" class="text-3xl text-[#1485FF]"></icon>
                </Link>

                <Link href="/dashboard/ekraf/mission" class="p-2">
                    <icon icon="tabler:target-arrow" class="text-3xl text-[#1485FF]"></icon>
                </Link>

                <Link href="/dashboard/ekraf/reward" class="p-2">
                    <icon icon="mdi:gift" class="text-3xl text-[#1485FF]"></icon>
                </Link>
            </div>
        </nav>
    </div>
</template>
