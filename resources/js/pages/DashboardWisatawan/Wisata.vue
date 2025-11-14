<script setup lang="ts">
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';

interface Wisata {
  id?: number | string;
  name?: string;
  location?: string;
  [key: string]: any;
}

const props = defineProps<{
  wisata: Wisata[] | any;
}>();
</script>

<template>
  <div class="bg-[#D8EBFF] text-white pb-32">
    <main class="relative">
      <div class="flex w-full justify-between items-center p-6">
        <div>
          <h1 class="font-bold text-3xl text-black">Ayo Jelajahi!</h1>
          <p class="text-sm text-black">Jelajahi wisata dan selesaikan misinya!</p>
        </div>
        <div class="h-12 w-12 rounded-lg bg-white/20"></div>
      </div>

      <div class="px-6 mt-6">
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-4">
            <Icon icon="mdi:magnify" class="text-2xl text-black" />
          </span>
          <input
            type="text"
            placeholder="Cari Channel Wisata disini...."
            class="w-full bg-[#EBF2FA] text-black placeholder-gray-500 rounded-xl py-3.5 pl-12 pr-4 focus:outline-none"
          />
        </div>
      </div>

      <div class="px-6 mt-8 space-y-6">
        <div
          v-for="(wisatas, index) in props.wisata ?? []"
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
              <div class="border border-white w-fit py-1 px-6 rounded-full">
                <p class="text-sm">Kunjungi</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

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
