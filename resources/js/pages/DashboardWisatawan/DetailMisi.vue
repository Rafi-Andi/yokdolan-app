<script setup lang="ts">
import { Icon } from '@iconify/vue';


</script>

<template>
    <div class="rounded-b-[50px] bg-[url('/images/texture.png')] bg-cover bg-center bg-no-repeat ">
        
        <div class="rounded-b-3xl pt-6 px-6 ">
            
            <div class="flex justify-between items-center">
                <a href="#" class="p-1">
                    <Icon icon="mdi:arrow-left" class="text-3xl text-white" />
                </a>
                <a href="#" class="bg-green-500 rounded-full p-2 shadow-md">
                    <Icon icon="mdi:whatsapp" class="text-2xl text-white" />
                </a>
            </div>

            <h1 class="text-center text-3xl font-bold text-white mt-6">
                Toko Kopi Lonceng
            </h1>
        </div>
        
        <div class="bg-white rounded-t-3xl p-8  shadow-2xl relative mt-44">
            
            <div class="w-fit bg-gray-300 border-10 border-white rounded-2xl flex items-center justify-center mx-auto -mt-40 relative z-10 shadow">
                <img src="/images/Rectangle 58.png" alt="" class="w-48 h-48 rounded-2xl">
            </div>

            <h2 class="text-3xl font-bold text-black  mt-6">Toko Kopi Lonceng</h2>
            <p class="text-gray-600 mt-2 text-base ">
                Toko kopi legendaris yang masih menjual biji kopi yang digiling di tempat dengan mesin sangrai tua.
            </p>

            <div class="mt-8 space-y-5">
                <div>
                    <h3 class="text-lg font-bold text-black">Tipe Misi</h3>
                    <p class="text-gray-600 text-base">Misi Transaksi</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-black">Poin</h3>
                    <p class="text-gray-600 text-base">400 Poin</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-black">Alamat Wisata</h3>
                    <p class="text-gray-600 text-base">Malang, Kota Malang, Jawa Timur</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-black">Patokan</h3>
                    <p class="text-gray-600 text-base">sebelah gerbang masuk sebelah kanan</p>
                </div>
            </div>

            <div class="flex justify-end w-full mt-5">
                <div class=" p-3 bg-[#1485FF] rounded-lg shadow cursor-pointer">
                <Icon icon="mdi:qrcode-scan" class="text-4xl text-white" />
                </div>
            </div>
        </div>
    </div>
</template>