<script setup>
import { Icon } from '@iconify/vue';
import { Head, Link } from '@inertiajs/vue3';


</script>
<template>
<div class="pb-24 bg-[#EBF5FF]">
        
        <header class="p-4 flex items-center gap-11">
            <Link href="/dashboard/ekraf" class="text-black">
                <icon icon="mdi:arrow-left" class="text-3xl"></icon>
            </Link>
            <h1 class="text-xl font-bold text-black">
                Validasi Transaksi
            </h1>
        </header>

        <main class="px-4 space-y-4">
            
            <div class="relative w-full pt-6 pb-6">
                <div class="absolute left-2 top-8">
                    <icon icon="mdi:search" class="text-3xl text-gray-400"></icon>
                </div>
                <input 
                    type="text" 
                    placeholder="Cari ID Voucher atau Nama..."
                    class="w-full rounded-xl border-none text-black bg-white py-3 pl-12"
                />
            </div>

            <button class="w-full bg-linear-to-r from-[#176CC9] to-[#6BAFF8] text-white font-medium py-2 rounded-3xl text-base">
                Validasi Sekali Klik
            </button>

            <h2 class="text-xl font-semibold text-gray-900 pt-6">
                Voucher Menunggu Validasi
            </h2>

            <div class="space-y-3">
                
                <div class="bg-[#D8EBFF] rounded-xl shadow-xl p-4 space-y-3">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-500">Voucher ID</p>
                            <p class="font-semibold text-gray-900">EKRAF-XYZ123</p>
                        </div>
                        <span class="text-xs font-medium bg-white text-gray-500 px-2 py-0.5 rounded-full">Menunggu</span>
                    </div>

                    <div class="border-t border-gray-300 pt-3">
                        <p class="text-xs text-gray-500">Hadiah</p>
                        <p class="text-lg font-semibold text-gray-900">Gratis 1 Gelas Seduhan Kopi Tubruk</p>
                    </div>

                    <div class="border-t border-gray-300 pt-3">
                        <p class="text-xs text-gray-500">Pengguna</p>
                        <p class="font-medium text-gray-900">Randi Permana</p>
                        <p class="text-xs text-gray-500">15 Des 2025, 15:30</p>
                    </div>

                    <div class="pt-3 grid grid-cols-2 gap-3">
                        <button class="w-full bg-transparent border border-[#01ABFF] text-[#01ABFF] font-medium py-2 px-4 rounded-3xl text-md">
                            Tolak
                        </button>
                        <button class="w-full bg-[#01ABFF] text-white font-medium py-2 px-4 rounded-3xl text-md">
                            Validasi
                        </button>
                    </div>
                </div>

                <div class="bg-[#D8EBFF] rounded-xl shadow-xl p-4 space-y-3">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-500">Voucher ID</p>
                            <p class="font-semibold text-gray-900">EKRAF-ABC456</p>
                        </div>
                        <span class="text-xs font-medium bg-white text-gray-500 px-2 py-0.5 rounded-full">Menunggu</span>
                    </div>

                    <div class="border-t border-gray-300 pt-3">
                        <p class="text-xs text-gray-500">Hadiah</p>
                        <p class="text-lg font-semibold text-gray-900">Voucher Diskon 30%</p>
                    </div>

                    <div class="border-t border-gray-300 pt-3">
                        <p class="text-xs text-gray-500">Pengguna</p>
                        <p class="font-medium text-gray-900">Habl Sankrumi</p>
                        <p class="text-xs text-gray-500">15 Des 2025, 11:10</p>
                    </div>

                    <div class="pt-3 grid grid-cols-2 gap-3">
                        <button class="w-full bg-transparent border border-[#01ABFF] text-[#01ABFF] font-medium py-2 px-4 rounded-3xl text-md">
                            Tolak
                        </button>
                        <button class="w-full bg-[#01ABFF] text-white font-medium py-2 px-4 rounded-3xl text-md">
                            Validasi
                        </button>
                    </div>
                </div>

            </div>

        </main>
        
    </div>
</template>