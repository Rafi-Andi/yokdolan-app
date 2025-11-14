<script setup lang="ts">
import { Icon } from '@iconify/vue';

</script>

<template>
    <div class="bg-[#D1E4F7]">
        <div class="pb-40">
            <div class="h-70 rounded-b-[50px] bg-[url('/images/texture.png')] bg-cover bg-center bg-no-repeat">
                <div class="w-full flex justify-end py-4 px-6">
                    <img src="/images/Rectangle 61.png" alt="" class="w-10 rounded-lg">
                </div>

                <div class="px-6 flex gap-3 w-full">
                    <div class="w-fit h-full object-cover flex justify-center items-center rounded-[50%]  border-[1.6px] border-white p-2">
                        <img src="/images/Rectangle 61.png" class="rounded-[50%]" alt="">
                    </div>

                    <div class="">
                        <h2 class="font-bold text-xl">Kampoeng Heritage Kajoetangan</h2>
                        <p class="text-sm leading-5 mt-1">Masuk dan temukan galeri seni tersembunyi, kopi legendaris, dan kriya otentik di jantung sejarah Kota Malang.</p>
                    </div>
                </div>
            </div>

            <div class="px-3 -mt-12 flex flex-col gap-4">
                <div class="bg-gradient-to-br from-[#ACDD36] to-[#29A983] rounded-4xl p-6 flex gap-4 justify-between items-center shadow-xl">
                        <div class=" w-full">
                            <h2 class="text-xl font-semibold text-white">Aroma Klasik</h2>
                            <p class="text-white text-[12px] mb-4">Lakukan pembelian minimal 100gr biji kopi giling (jenis apa saja) langsung dari toko.</p>
                            <div class=" w-full flex">
                                <div class="border bg-white border-white w-[90%] py-2 px-6 rounded-full flex justify-center">
                                <p class="text-xs text-[#5ABC66] font-semibold text-center">Lihat Selengkapnya</p>
                                </div>
                            </div>
                        </div>
                        <img src="/images/Rectangle 58.png" alt="" class="rounded-2xl w-25 shadow-xl">
                </div>

                <div class="bg-gradient-to-br from-[#54C5F0] to-[#329ED6] rounded-4xl p-6 flex gap-4 justify-between items-center shadow-xl">
                        <div class=" w-full">
                            <h2 class="text-xl font-semibold text-white">Aroma Klasik</h2>
                            <p class="text-white text-[12px] mb-4">Lakukan pembelian minimal 100gr biji kopi giling (jenis apa saja) langsung dari toko.</p>
                            <div class=" w-full flex">
                                <div class="border bg-white border-white w-[90%] py-2 px-6 rounded-full flex justify-center">
                                <p class="text-xs text-[#5ABC66] font-semibold">Lihat Selengkapnya</p>
                                </div>
                            </div>
                        </div>
                        <img src="/images/Rectangle 58.png" alt="" class="rounded-2xl shadow-xl">
                </div>
                <div class="bg-gradient-to-br from-[#F0DC55] to-[#EE924C] rounded-4xl p-6 flex gap-4 justify-between items-center shadow-xl">
                        <div class=" w-full">
                            <h2 class="text-xl font-semibold text-white">Aroma Klasik</h2>
                            <p class="text-white text-[12px] mb-4">Lakukan pembelian minimal 100gr biji kopi giling (jenis apa saja) langsung dari toko.</p>
                            <div class=" w-full flex">
                                <div class="border bg-white border-white w-[90%] py-2 px-6 rounded-full flex justify-center">
                                <p class="text-xs text-[#5ABC66] font-semibold">Lihat Selengkapnya</p>
                                </div>
                            </div>
                        </div>
                        <img src="/images/Rectangle 58.png" alt="" class="rounded-2xl shadow-xl">
                </div>
            </div>
        </div>

            <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200" style="border-radius: 30px 30px 0 0;">
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
                
                <Link href="/dashboard/hadiah" class="p-2 flex flex-col items-center text-gray-400">
                    <Icon icon="mdi:gift" class="text-3xl"></Icon>
                </Link>
            </div>
        </nav>
    </div>
</template>