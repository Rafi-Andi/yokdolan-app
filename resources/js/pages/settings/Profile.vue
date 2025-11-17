<script setup>
import { Icon } from '@iconify/vue';
import { ref } from 'vue';

const missionDetail = ref({
  title: 'Toko Kopi Lonceng',
  subtitle: 'Aroma Klasik',
  description: 'Toko kopi legendaris yang masih menjual biji kopi yang digiling di tempat dengan mesin sangrai tua.',
  missionType: 'Misi Transaksi',
  points: 400,
  address: 'Malang, Kota Malang, Jawa Timur',
  landmark: 'sebelah gerbang masuk sebelah kanan'
});

const props = defineProps({
    user: Object,
    toouristProfile: Object,
});

console.log(props.user)
</script>

<template>
    <div class="bg-[#D6EFFF]">
        
        <div class="bg-[#D6EFFF]  rounded-b-3xl pt-6 px-6 h-screen">
           
        </div>
        
        <div class="fixed bottom-0 right-0 left-0 z-50 bg-white rounded-t-3xl p-8  shadow-2xl  mt-30">
            <div class="w-fit mx-auto max-w-sm bg-white -mt-20 rounded-xl p-5 shadow-md">
                    <Icon icon="mdi:image-outline" class="text-7xl text-gray-500" />
            </div>

            <div class="flex flex-col justify-center items-center">
                <h1 class="font-bold text-xl text-[#333333]">{{ user.name }}</h1>
                <p class="text-sm">{{ user.email }}</p>
            </div>

            <div class=" w-full h-20 mt-8 flex items-center">
                <div class="w-30">
                    <div class="flex items-center justify-center gap-2 mb-2">
                        <Icon icon="el:star-alt" class="text-2xl text-[#333333]"/>
                        <h1 class="font-bold text-xl text-[#333333]">400</h1>
                    </div>
                    <p class="text-gray-600 font-medium text-sm text-center leading-4">Poin Hadiah Anda</p>
                </div>
                <div class="h-14 bg-gray-400 w-[0.2px]">

                </div>
                <div class="w-30">
                    <div class="flex items-center justify-center gap-2 mb-2">
                        <Icon icon="el:star-alt" class="text-2xl text-[#333333]"/>
                        <h1 class="font-bold text-xl text-[#333333]">400</h1>
                    </div>
                    <p class="text-gray-600 font-medium text-sm text-center leading-4">Poin Hadiah Anda</p>
                </div>
                
                <div class="w-30">
                    <div class="flex items-center justify-center gap-2 mb-2">
                        <Icon icon="el:star-alt" class="text-2xl text-[#333333]"/>
                        <h1 class="font-bold text-xl text-[#333333]">400</h1>
                    </div>
                    <p class="text-gray-600 font-medium text-sm text-center leading-4">Poin Hadiah Anda</p>
                </div>
            </div>

            <div class="">
                <div class="border-b-1 py-5 border-[#333333]">
                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold text-[#333333]">Leaderboard</h1>
                        <Icon icon="weui:arrow-filled" class="text-4xl text-[#333333]"/>
                    </div>
                </div>
                <div class="border-b-1 py-5 border-[#333333]">
                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold text-[#333333]">Daftar Misi</h1>
                        <Icon icon="weui:arrow-filled" class="text-4xl text-[#333333]"/>
                    </div>
                </div>
                <div class="border-b-1 py-5 border-[#333333]">
                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold text-[#333333]">Klaim Hadiah</h1>
                        <Icon icon="weui:arrow-filled" class="text-4xl text-[#333333]"/>
                    </div>
                </div>
                <div class="border-b-1 py-5 border-[#333333]">
                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold text-[#333333]">Logout</h1>
                        <Icon icon="heroicons-outline:logout" class="text-4xl text-[#333333]"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>