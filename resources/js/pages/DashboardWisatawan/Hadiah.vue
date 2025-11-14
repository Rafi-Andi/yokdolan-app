<script setup lang="ts">
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';
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

</script>

<template>
    <div class="bg-[#D6EFFF] pb-30">
            
            <div class="flex justify-between items-center p-6">
                <p class="font-bold text-2xl">Katalog Hadiah</p>

                <div class="flex justify-center items-center w-fit h-fit p-1 rounded-lg bg-[#01ABFF]">
                    <Icon icon="" class="text-4xl"/>
                </div>
            </div>

            <div class="px-6">
                <div class="w-full flex-shrink-0 h-fit bg-gradient-to-b from-[#0BB6FC] to-[#5372EE] rounded-3xl shadow-lg p-4 gap-4 flex flex-col text-white overflow-hidden">
                    <div class="flex gap-4 items-center"> 
                        <div class="flex flex-col  z-10">
                            <div class="bg-white bg-opacity-20 rounded-full p-2 mb-2 h-fit w-fit">
                                <Icon icon="ic:round-stars" class="text-6xl text-[#1485FF]"></Icon>
                            </div>
                        </div>
                        
                        <div class="">
                            <h2 class="text-xl font-semibold mb-1">Poin Hadiah</h2>
                            <p class="text-xl mb-3 font-medium">Anda <span class="font-bold">200 poin</span></p>
                        </div>
                    </div> 
                    <div class="w-full h-1.5 bg-yellow-400 rounded-full"></div>
                    <button class="bg-white text-blue-600 text-sm font-medium py-2 px-6 rounded-full shadow-lg hover:bg-gray-100 transition duration-300 z-10">
                        Dapatkan Poin
                    </button>
                </div>
            </div>

            <div class="px-6 pt-4">
                <h1 class="font-bold text-2xl">Daftar Hadiah</h1>
            </div>
            <div class="flex px-6 w-full justify-between mt-2  gap-3">
                <div class="relative  p-2 py-4 bg-white rounded-lg w-full">
                    <input type="text" placeholder="Cari hadiah..." class="px-8 outline-none">
                    <Icon icon="material-symbols:search-rounded" class="absolute top-3 text-3xl "/>
                </div>
                <div class="flex justify-center items-center w-fit h-fit p-2 rounded-lg bg-[#01ABFF]">
                    <Icon icon="mage:filter" class="text-4xl"/>
                </div>
            </div>
        
            <div class="px-6 mt-6 flex flex-col gap-3">
                <div class="w-full max-w-sm bg-gradient-to-r from-[#FFF2DE] to-[#FFE0B2] rounded-xl p-5 shadow-md">
                    <h2 class="text-xl font-bold text-gray-900 leading-tight">
                        Gratis 1 Gelas Seduhan Kopi Tubruk
                    </h2>
                    <div class="flex justify-between items-center mt-3">
                        <p class="text-base text-gray-700">Tipe: Gratis Produk</p>
                        <div class="flex items-center space-x-1">
                        <Icon icon="mdi:star" class="text-2xl text-gray-600" />
                        <span class="text-lg font-semibold text-gray-800">500 Poin</span>
                        </div>
                    </div>
                </div>

                <div class="w-full max-w-sm bg-gradient-to-r from-[#FCE4EC] to-[#F8BBD0] rounded-xl p-5 shadow-md">
                    <h2 class="text-xl font-bold text-gray-900 leading-tight">
                        Gratis 1 Gelas Seduhan Kopi Tubruk
                    </h2>
                    <div class="flex justify-between items-center mt-3">
                        <p class="text-base text-gray-700">Tipe: Gratis Produk</p>
                        <div class="flex items-center space-x-1">
                        <Icon icon="mdi:star" class="text-2xl text-gray-600" />
                        <span class="text-lg font-semibold text-gray-800">500 Poin</span>
                        </div>
                    </div>
                </div>

                <div class="w-full max-w-sm bg-gradient-to-r from-[#FFF2DE] to-[#FFE0B2] rounded-xl p-5 shadow-md">
                    <h2 class="text-xl font-bold text-gray-900 leading-tight">
                        Gratis 1 Gelas Seduhan Kopi Tubruk
                    </h2>
                    <div class="flex justify-between items-center mt-3">
                        <p class="text-base text-gray-700">Tipe: Gratis Produk</p>
                        <div class="flex items-center space-x-1">
                        <Icon icon="mdi:star" class="text-2xl text-gray-600" />
                        <span class="text-lg font-semibold text-gray-800">500 Poin</span>
                        </div>
                    </div>
                </div>
            </div>

        <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50" style="border-radius: 30px 30px 0 0;">
            <div class="flex justify-around items-center h-20 max-w-lg mx-auto px-4">
                
                <Link href="/dashboard" class="p-2 flex flex-col items-center text-gray-400">
                    <Icon icon="mdi:home" class="text-3xl text-gray-400"></Icon>
                </Link>
                
                <Link href="/dashboard/leaderboard" class="p-2 flex flex-col items-center ">
                    <Icon icon="material-symbols:leaderboard-rounded" class="text-3xl text-gray-400 "></Icon>
                </Link>

                <Link href="/dashboard/scan" class="p-4 bg-[#1485FF] rounded-full -mt-10 shadow-lg">
                    <Icon icon="mdi:qrcode-scan" class="text-4xl text-white"></Icon>
                </Link>

                <Link href="/dashboard/wisata" class="p-2 flex flex-col items-center text-gray-400">
                    <Icon icon="streamline-flex:target-solid" class="text-3xl"></Icon>
                </Link>
                
                <Link href="/dashboard/hadiah" class="p-2 flex flex-col items-center text-[#1485FF]">
                    <Icon icon="mdi:gift" class="text-3xl"></Icon>
                </Link>
            </div>
        </nav>

    </div>
</template>