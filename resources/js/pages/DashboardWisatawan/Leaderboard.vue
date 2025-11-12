<script setup lang="ts">
import { Icon } from '@iconify/vue';
import { ref } from 'vue';

const leaderboardData = ref([
  { id: 1, rank: 1, name: 'Habl Sank', points: 400, avatar: null },
  { id: 2, rank: 2, name: 'Kevin Han', points: 380, avatar: null },
  { id: 3, rank: 3, name: 'James Don', points: 340, avatar: null },
  { id: 4, rank: 4, name: 'Jean K', points: 320, avatar: null },
]);

</script>

<template>
    <div class=" bg-[#EBF5FF] min-h-screen">
        <main class="relative">
            <div class="w-full pb-40 rounded-b-[45px] bg-[#D8EBFF] container-header">
                <div class="flex w-full justify-between items-center p-6">
                    <p></p>
                    <h2 class="font-bold text-2xl text-[#1485FF]">Papan Peringkat</h2>
                <div class="h-10 w-10 rounded-lg bg-gray-200"></div> 
            </div>
            </div>

            <div class="px-6 -mt-28">

                <div class="relative bg-gradient-to-tr from-[#1485FF] to-[#6abaff] rounded-3xl shadow-lg pt-16 pb-6 px-4 text-white">
                    
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-gray-300 rounded-2xl border-4 border-white shadow-md overflow-hidden">
                         <img src="" alt="profile" class="object-cover w-full h-full">
                    </div>
                    
                    <h3 class="text-center text-xl font-semibold">Pencapaian Anda</h3>
                    <p class="text-center text-xs text-white/80 mt-1">Teruskan! 400 poin berhasil kamu kumpulkan!</p>
                    
                    <div class="mt-6 flex justify-around divide-x divide-white/30">
                        <div class="flex-1 flex flex-col items-center text-center px-2">
                            <Icon icon="mdi:medal" class="text-3xl text-yellow-400"></Icon>
                            <span class="text-lg font-bold mt-1">400</span>
                            <span class="text-xs">Poin Misi</span>
                        </div>
                        <div class="flex-1 flex flex-col items-center text-center px-2">
                            <Icon icon="tabler:target-arrow" class="text-3xl text-red-600"></Icon>
                            <span class="text-lg font-bold mt-1">10</span>
                            <span class="text-xs">Misi Selesai</span>
                        </div>
                        <div class="flex-1 flex flex-col items-center text-center px-2 text-yellow-200">
                            <Icon icon="mdi:podium" class="text-3xl"></Icon>
                            <span class="text-lg font-bold mt-1">1</span>
                            <span class="text-xs">Peringkat</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 bg-[#C4E1FF] pb-30 rounded-t-3xl p-6 -mx-6">
                    <div class="flex justify-center items-baseline mb-8 px-1">
                        <h3 class="text-xl font-bold">Peringkat Poin Misi</h3>
                    </div>
                    <div class="flex justify-between items-baseline mb-4 px-1">
                        <h3 class="text-sm text-gray-500">Peringkat</h3>
                        <p class="text-sm text-gray-500">Total Poin</p>
                    </div>

                    <div class="space-y-4">
                        <div v-for="user in leaderboardData" :key="user.id" class="flex items-center gap-4 p-2">
                            <span class="text-2xl font-bold w-8 text-left text-gray-800">{{ user.rank }}</span>
                            
                            <div class="w-12 h-12 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                <img v-if="user.avatar" :src="user.avatar" class="w-full h-full object-cover" />
                            </div>
                            
                            <span class="flex-1 font-semibold text-gray-800 truncate">{{ user.name }}</span>
                            <span class="font-bold text-lg text-[#1485FF]">{{ user.points }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div> 

    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200" style="border-radius: 30px 30px 0 0;">
        <div class="flex justify-around items-center h-20 max-w-lg mx-auto px-4">
            
            <a href="#" class="p-2 flex flex-col items-center text-gray-400">
                <Icon icon="mdi:home" class="text-3xl"></Icon>
                <span class="text-xs font-medium">Home</span>
            </a>
            
            <a href="#" class="p-2 flex flex-col items-center text-[#1485FF]">
                <Icon icon="mdi:chart-bar" class="text-3xl"></Icon>
                <span class="text-xs font-medium">Peringkat</span>
            </a>

            <a href="#" class="p-4 bg-[#1485FF] rounded-full -mt-10 shadow-lg">
                <Icon icon="mdi:qrcode-scan" class="text-4xl text-white"></Icon>
            </a>

            <a href="#" class="p-2 flex flex-col items-center text-gray-400">
                <Icon icon="tabler:target-arrow" class="text-3xl"></Icon>
                <span class="text-xs font-medium">Misi</span>
            </a>
            
            <a href="#" class="p-2 flex flex-col items-center text-gray-400">
                <Icon icon="mdi:gift" class="text-3xl"></Icon>
                <span class="text-xs font-medium">Hadiah</span>
            </a>
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