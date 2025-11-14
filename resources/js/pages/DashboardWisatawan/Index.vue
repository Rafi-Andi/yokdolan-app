<script setup lang="ts">
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    'user': Object
})

console.log(props.user)
</script>

<template>
    <div class="pb-24 bg-[#EBF5FF]">
        <main class="relative">
            <div class="w-full pb-20 rounded-b-[45px] bg-[#D8EBFF] container-header">
                <div class="flex w-full justify-between p-6">
                    <p class="font-bold text-lg text-[#1485FF]">YokDolan</p>
                    <div class="h-10 w-10 rounded-lg bg-black overflow-hidden">
                        <img src="https://i.ibb.co/6yTXMLN/image-961bf3.jpg" alt="profile" class="object-cover w-full h-full">
                    </div>
                </div>

                <div class="p-6 w-full flex items-center justify-between">
                    <div class="">
                        <h1 class="text-2xl font-bold ">Hallo!</h1>
                        <p class="text-2xl">{{ user?.name }}</p>
                        <p class="text-gray-500 text-xs">Wisata Jadi Lebih Seru dengan Misi Berhadiah.</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" viewBox="0 0 640 512"><path fill="#1485FF" d="M353.8 54.1L330.2 6.3c-3.9-8.3-16.1-8.6-20.4 0l-23.6 47.8l-52.3 7.5c-9.3 1.4-13.3 12.9-6.4 19.8l38 37l-9 52.1c-1.4 9.3 8.2 16.5 16.8 12.2l46.9-24.8l46.6 24.4c8.6 4.3 18.3-2.9 16.8-12.2l-9-52.1l38-36.6c6.8-6.8 2.9-18.3-6.4-19.8l-52.3-7.5zM256 256c-17.7 0-32 14.3-32 32v192c0 17.7 14.3 32 32 32h128c17.7 0 32-14.3 32-32V288c0-17.7-14.3-32-32-32zM32 320c-17.7 0-32 14.3-32 32v128c0 17.7 14.3 32 32 32h128c17.7 0 32-14.3 32-32V352c0-17.7-14.3-32-32-32zm416 96v64c0 17.7 14.3 32 32 32h128c17.7 0 32-14.3 32-32v-64c0-17.7-14.3-32-32-32H480c-17.7 0-32 14.3-32 32"/></svg>
                </div>
            </div>

            <div class="z-10 -mt-20 flex w-full flex-nowrap gap-4 overflow-x-auto px-6 no-scrollbar">
                
                <div class="relative w-50 h-fit flex-shrink-0 bg-gradient-to-tr from-[#1485FF] to-[#A3CFFF] rounded-3xl shadow-xl p-4 flex flex-col items-center justify-between text-white overflow-hidden">
                    <div class="z-10 w-full flex flex-col gap-8">
                        <div class="bg-white bg-opacity-20 rounded-full p-3 mb-2 w-fit">
                            <Icon icon="mdi:medal" class="text-4xl text-yellow-500"></Icon>
                        </div>
                        <div class="">
                            <h2 class="text-xl font-semibold mb-1">Poin Misi</h2>
                            <p class="text-sm mb-3">{{ props.user?.tourist_profile?.point_akumulasi ?? 'Loading...' }} poin</p>
                            <div class="w-16 h-1.5 bg-yellow-400 rounded-full mb-4"></div>
                        </div>
                    </div>
                    
                    <button class="bg-white w-full text-blue-600 text-sm font-medium py-2 px-6 rounded-full shadow-lg hover:bg-gray-100 transition duration-300 z-10">
                        Dapatkan
                    </button>
                </div>

                <div class="relative w-50 h-fit flex-shrink-0 bg-gradient-to-tr from-[#7467D1] to-[#aea4ec] rounded-3xl shadow-xl p-4 flex flex-col items-center justify-between text-white overflow-hidden">
                    <div class="z-10 w-full flex flex-col gap-8">
                        <div class="bg-white bg-opacity-20 rounded-full p-3 mb-2 w-fit">
                            <Icon icon="material-symbols:stars" class="text-4xl text-blue-500"></Icon>
                        </div>
                        <div class="">
                            <h2 class="text-xl font-semibold mb-1">Poin Hadiah</h2>
                            <p class="text-sm mb-3">{{ props.user?.tourist_profile?.point_value ?? 'Loading...' }} poin</p>
                            <div class="w-16 h-1.5 bg-yellow-400 rounded-full mb-4"></div>
                        </div>
                    </div>
                    
                    <button class="bg-white w-full text-blue-600 text-sm font-medium py-2 px-6 rounded-full shadow-lg hover:bg-gray-100 transition duration-300 z-10">
                        Dapatkan
                    </button>
                </div>
                </div>
            
            <div class="flex px-6 w-full justify-between mt-8  gap-3">
                <div class="relative  p-2 py-4 bg-white rounded-lg w-full">
                    <input type="text" placeholder="Cari hadiah..." class="px-8 outline-none">
                    <Icon icon="material-symbols:search-rounded" class="absolute top-3 text-3xl "/>
                </div>
                <div class="flex justify-center items-center w-fit h-fit p-2 rounded-lg bg-[#01ABFF]">
                    <Icon icon="mage:filter" class="text-4xl"/>
                </div>
            </div>

            <div class="p-6">
                <h2 class="text-xl font-bold">Channel Wisata</h2>
            </div>

            <div class="pl-6 flex gap-4 overflow-auto no-scrollbar">
                <div class="w-72 flex-shrink-0 rounded-xl bg-[#9DCCFF] shadow-md overflow-hidden">
                    <div class="relative p-2 rounded-lg">
                        <img
                            src="images/kajoetangan.png"
                            alt="Kampoeng Heritage Kajoetangan"
                            class="w-full h-36 object-cover"
                        />
                        <div class="absolute bottom-3 left-3 bg-[#48A9F8] text-white text-sm px-7 py-[2px] rounded-full shadow">
                        5 Misi
                        </div>
                    </div>
                    <div class="p-2">
                        <h3 class="font-semibold text-black leading-tight text-[16px]">
                        Kampoeng Heritage Kajoetangan
                        </h3>
                        <p class="text-gray-600 text-xs">Malang</p>
                    </div>
                </div>
                <div class="w-72 flex-shrink-0 rounded-xl bg-[#F4C90D] shadow-md overflow-hidden">
                    <div class="relative p-2 rounded-lg">
                        <img
                            src="images/kajoetangan.png"
                            alt="Kampoeng Heritage Kajoetangan"
                            class="w-full h-36 object-cover"
                        />
                        <div class="absolute bottom-3 left-3 bg-[#48A9F8] text-white text-sm px-7 py-[2px] rounded-full shadow">
                        5 Misi
                        </div>
                    </div>
                    <div class="p-2">
                        <h3 class="font-semibold text-black leading-tight text-[16px]">
                        Kampoeng Heritage Kajoetangan
                        </h3>
                        <p class="text-gray-600 text-xs">Malang</p>
                    </div>
                </div>
            </div>

        </main>
    </div> 

    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200" style="border-radius: 30px 30px 0 0;">
            <div class="flex justify-around items-center h-20 max-w-lg mx-auto px-4">
                
                <Link href="/dashboard" class="p-2 flex flex-col items-center text-gray-400">
                    <Icon icon="mdi:home" class="text-3xl text-[#1485FF]"></Icon>
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
                
                <Link href="/dashboard/hadiah" class="p-2 flex flex-col items-center text-gray-400">
                    <Icon icon="mdi:gift" class="text-3xl"></Icon>
                </Link>
            </div>
        </nav>
</template>

<style scoped>
        
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
         -ms-overflow-style: none;  /* IE dan Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>