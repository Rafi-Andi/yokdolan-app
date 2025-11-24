<script setup>
import { Icon } from '@iconify/vue';

</script>

<template>
    <div
        class="rounded-b-[50px] bg-[url('/images/texture.png')] bg-cover bg-center bg-no-repeat"
    >
        <div class="rounded-b-3xl px-6 pt-6">
            <div class="flex items-center justify-between">
                <a href="" class="p-1">
                    <Icon icon="mdi:arrow-left" class="text-3xl text-white cursor-pointer" />
                </a>
                <a href="" class="rounded-full bg-green-500 p-2 shadow-md">
                    <Icon icon="mdi:whatsapp" class="text-2xl text-white" />
                </a>
            </div>

            <h1 class="mt-6 text-center text-3xl font-bold text-white">
                Profil Ekraf
            </h1>
        </div>

        <div class="relative mt-44 rounded-t-3xl p-8 shadow-2xl">
            <div
                class="flex-col z-10 mx-auto -mt-40 flex w-fit items-center justify-center rounded-2xl"
            >
                <p class="text-white font-bold text-3xl">Toko Kopi Lonceng</p>
                <p class="text-white text-lg underline italic">email@email.com</p>
            </div>

            <h2 class="mt-6 text-3xl font-bold text-black">
            </h2>
            
            <div class="flex justify-between px-5">
                <div class="flex flex-col items-center justify-center">
                    <Icon icon="ic:baseline-phone" class="text-white text-4xl"/>  
                    <p class="text-white text-xl">080990</p>    
                </div>
                <div class="flex flex-col items-center justify-center ">
                    <Icon icon="mdi:location" class="text-white text-4xl"/>  
                    <p class="text-white text-md text-center">Malang, Kota Malang, Jawa Timur (sebelah gerbang masuk sebelah kanan)</p>    
                </div>
            </div>

            <div class="mt-8 space-y-5">

            </div>

            <div class="mt-5 flex w-full justify-end">
                <Link href="/dashboard/scan" class="cursor-pointer rounded-lg bg-[#1485FF] p-3 shadow">
                    <Icon icon="mdi:qrcode-scan" class="text-4xl text-white" />
                </Link>
            </div>
        </div>
    </div>
        <div class="mt-8 p-6 gap-6">
            <div>
            <h1 class="text-xl font-bold">Toko Kopi Lonceng</h1>
            <p class="font-semibold">Toko Kopi loncong adalah toko kopi jaman dahulu, dibangun sejak zaman Belanda </p>
            </div>
            <div class="mt-6">
            <h1 class="text-xl font-bold">Lokasi Mitra Ekraf</h1>
            <p class="font-semibold">Toko Kopi Lonceng terletak di Malang, Jawa Timur ( Sebelah Gerbang Selatan, berjarak 200 meter dari gerbang wisata)</p>
            </div>
            <div class="flex gap-6">
                <div class="py-2 px-4 border-2 border-blue-300 rounded-xl shadow-lg mt-6">
                    <h1 class="font-bold text-xl">Jumlah Misi</h1>
                    <h2 class="font-semibold">30 Misi</h2>
                    <button class="text-center">Lihat Misi</button>
                </div>
                <div class="py-2 px-4 border-2 border-blue-300 rounded-xl shadow-lg mt-6 flex flex-col">
                    <h1 class="font-bold text-xl">Level Misi</h1>
                    <h2 class="font-semibold border-2 px-2 mt-2 inline-block border-red-600 rounded-full bg-red-100 text-red-600">Sulit</h2>
                    <h2 class="font-semibold border-2 px-2 mt-2 inline-block border-yellow-600 rounded-full bg-orange-100 text-yellow-600">Sedang</h2>
                    <h2 class="font-semibold border-2 px-2 mt-2 inline-block border-green-600 rounded-full bg-green-100 text-green-600">Mudah</h2>
                </div>
            </div>
        </div>
</template>
