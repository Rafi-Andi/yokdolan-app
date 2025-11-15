<script setup>
import { Icon } from '@iconify/vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    mission: Object,
});

const url = 'http://127.0.0.1:8000';

console.log(props.mission);

const goBack = () => {
    history.back();
};

const convertTo62 = (phoneNumber) => {
    if (typeof phoneNumber !== 'string' || !phoneNumber) {
        return '';
    }
    
    const cleanedNumber = phoneNumber.replace(/\D/g, ''); 

    if (cleanedNumber.startsWith('0')) {
        return '62' + cleanedNumber.substring(1);
    } 
    
    return cleanedNumber;
};
</script>

<template>
    <div
        class="rounded-b-[50px] bg-[url('/images/texture.png')] bg-cover bg-center bg-no-repeat"
    >
        <div class="rounded-b-3xl px-6 pt-6">
            <div class="flex items-center justify-between">
                <a @click.prevent="goBack()" class="p-1">
                    <Icon icon="mdi:arrow-left" class="text-3xl text-white" />
                </a>
                <a :href="`https://wa.me/${convertTo62(mission.ekraf_partner?.ekraf_partner?.phone)}`" class="rounded-full bg-green-500 p-2 shadow-md">
                    <Icon icon="mdi:whatsapp" class="text-2xl text-white" />
                </a>
            </div>

            <h1 class="mt-6 text-center text-3xl font-bold text-white">
                {{ mission.ekraf_partner?.ekraf_partner?.business_name }}
            </h1>
        </div>

        <div class="relative mt-44 rounded-t-3xl bg-white p-8 shadow-2xl">
            <div
                class="relative z-10 mx-auto -mt-40 flex w-fit items-center justify-center rounded-2xl border-10 border-white bg-gray-300 shadow"
            >
                <img
                    :src="`${url}/storage/${mission.mission_photo_path}`"
                    :alt="`Gambar ${mission.title}`"
                    class="h-48 w-48 rounded-2xl"
                />
            </div>

            <h2 class="mt-6 text-3xl font-bold text-black">
                {{ mission.title }}
            </h2>
            <p class="mt-2 text-base text-gray-600">
                {{ mission.description }}
            </p>

            <div class="mt-8 space-y-5">
                <div>
                    <h3 class="text-lg font-bold text-black">Tipe Misi</h3>
                    <p class="text-base text-gray-600">Misi {{ mission.type }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-black">Poin</h3>
                    <p class="text-base text-gray-600">{{ mission.reward_points }} Poin</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-black">Alamat Wisata</h3>
                    <p class="text-base text-gray-600">
                        {{ mission.channel.location }}
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-black">Patokan</h3>
                    <p class="text-base text-gray-600">
                        {{ mission.ekraf_partner?.ekraf_partner?.business_address }}
                    </p>
                </div>
            </div>

            <div class="mt-5 flex w-full justify-end">
                <div class="cursor-pointer rounded-lg bg-[#1485FF] p-3 shadow">
                    <Icon icon="mdi:qrcode-scan" class="text-4xl text-white" />
                </div>
            </div>
        </div>
    </div>
</template>
