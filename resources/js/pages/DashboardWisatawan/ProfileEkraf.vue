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
</template>
