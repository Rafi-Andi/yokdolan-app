<script setup lang="ts">
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

</script>

<template>
    <div class="bg-[#D6EFFF] min-h-screen">
            
            <div class="flex justify-between items-center p-6">
                <p class="font-bold text-2xl">Tukar Poinmu!</p>

                <div class="flex justify-center items-center w-fit h-fit p-1 rounded-lg bg-[#01ABFF]">
                    <Icon icon="" class="text-4xl"/>
                </div>
            </div>

            <div class="px-6">
                <div class="w-full py-6 flex-shrink-0 h-fit bg-gradient-to-tr from-[#7467D1] to-[#c2b9f9] rounded-3xl shadow-lg p-4 gap-4 flex flex-col text-white overflow-hidden">
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
                </div>
            </div>

        <div class="bg-white rounded-t-3xl p-8  shadow-2xl relative mt-30">
            
            <div class="w-full max-w-sm bg-white -mt-28 rounded-xl p-5 shadow-md">
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

            <h2 class="text-3xl font-bold text-black  mt-6"></h2>
            <p class="text-gray-600 mt-2 text-base ">

            </p>

            <div class="mt-8 space-y-5">
                <div class=" border-10 border-white rounded-2xl flex items-center justify-center mx-auto  z-10 shadow">
                    <img src="/images/kajoetangan.png" alt="" class="w-100">
                </div>

                <p class="font-semibold text-justify">Tukarkan poin untuk mendapat 1 gelas kopi tubruk (kopi apa saja) yang diseduh langsung di toko.</p>
            </div>

            <div class="flex w-full mt-5  justify-between">
               <button class="bg-white border border-[#01ABFF] text-[#01ABFF] text-sm font-medium py-2 px-14 rounded-full shadow-lg hover:bg-gray-100 transition duration-300 z-10">
                        Batal
                </button>

                <button class="bg-[#01ABFF] text-white text-sm font-medium py-2 px-14 rounded-full shadow-lg hover:bg-gray-100 transition duration-300 z-10">
                        Tukar
                </button>
            </div>
        </div>

    </div>
</template>