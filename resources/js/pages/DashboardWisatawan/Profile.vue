<script setup>
import { Icon } from '@iconify/vue';
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { logout } from '@/routes';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
    touristProfile: Object,
});

const goBack = () => {
    history.back() | router.visit('/dashboard');
};

console.log(props.user)
</script>

<template>
    <div class="bg-[#D6EFFF]">
        
        <div class="bg-[#D6EFFF]  rounded-b-3xl pt-6 px-6 h-screen">
            <a  @click.prevent="goBack()" class="p-1">
                <Icon icon="formkit:arrowleft"/>
            </a>
        </div>
        
        <div class="fixed bottom-0 right-0 left-0 z-50 bg-white rounded-t-3xl p-8  shadow-2xl  mt-30">
            <div class="w-fit mx-auto max-w-sm bg-white -mt-20 rounded-xl p-5 shadow-md text-black">
                    <img class="w-[80px]" :src="user.profile_url" alt="Profile">
            </div>

            <div class="flex flex-col justify-center items-center">
                <h1 class="font-bold text-xl text-[#333333]">{{ user?.name }}</h1>
                <p class="text-sm">{{ user?.email }}</p>
            </div>

            <div class=" w-full h-20 mt-8 flex items-center justify-center">
                <div class="w-30">
                    <div class="flex items-center justify-center gap-2 mb-2">
                        <Icon icon="el:star-alt" class="text-2xl text-yellow-400"/>
                        <h1 class="font-bold text-xl text-[#333333]">{{ touristProfile?.point_akumulasi ?? 0}}</h1>
                    </div>
                    <p class="text-gray-600 font-medium text-sm text-center leading-4">Poin Akumulasi</p>
                </div>
                <div class="h-14 bg-gray-400 w-[0.2px]">

                </div>
                <div class="w-30">
                    <div class="flex items-center justify-center gap-2 mb-2">
                        <Icon icon="el:star-alt" class="text-2xl text-yellow-400"/>
                        <h1 class="font-bold text-xl text-[#333333]">{{ touristProfile?.point_value ?? 0}}</h1>
                    </div>
                    <p class="text-gray-600 font-medium text-sm text-center leading-4">Poin Value Anda</p>
                </div>
            </div>

            <div class="">
                <div class="border-b-1 py-5 border-[#333333]">
                    <Link href="/dashboard/leaderboard" class="flex justify-between items-center cursor-pointer">
                        <h1 class="text-lg font-semibold text-[#333333]">Leaderboard</h1>
                        <Icon icon="weui:arrow-filled" class="text-4xl text-[#333333]"/>
                    </Link>
                </div>
                <div class="border-b-1 py-5 border-[#333333]">
                    <Link href="/dashboard/wisata" class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold text-[#333333]">Daftar Misi</h1>
                        <Icon icon="weui:arrow-filled" class="text-4xl text-[#333333]"/>
                    </Link>
                </div>
                <div class="border-b-1 py-5 border-[#333333]">
                    <Link href="/dashboard/hadiah" class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold text-[#333333]">Klaim Hadiah</h1>
                        <Icon icon="weui:arrow-filled" class="text-4xl text-[#333333]"/>
                    </Link>
                </div>
                <div class="border-b-1 py-5 border-[#333333]">
                    <Link as="button" :href="logout()" class="flex justify-between w-full cursor-pointer items-center">
                        <h1 class="text-lg font-semibold text-red-500">Logout</h1>
                        <Icon icon="heroicons-outline:logout" class="text-4xl text-red-500"/>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>