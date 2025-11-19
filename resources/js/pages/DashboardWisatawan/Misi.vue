<script setup>
import { Icon } from '@iconify/vue';
import { Head, Link, usePage, router } from '@inertiajs/vue3'; 

const props = defineProps({
    channel: Object, 
    missions: Object, 
});

const url = 'http://127.0.0.1:8000';

const missionsData = props.missions;

const goBack = () => {
    history.back() || router.visit('/dashboard/wisata');
};



console.log(props.channel);
</script>
<template>
    <Head title="Misi Mitra Ekraf"/>
    <div class="bg-[#D1E4F7]">
        <div class="pb-40">
            <div
                class="h-90 rounded-b-[50px] bg-[url('/images/texture.png')] bg-cover bg-center bg-no-repeat pt-2"
            >
                <a @click.prevent="goBack()" class="p-1">
                    <Icon icon="mdi:arrow-left" class="text-4xl text-white ml-4" />
                </a>
                <div
                    class="flex w-full flex-col items-center justify-center gap-3 px-6 pt-8"
                >
                    <div
                        class="flex h-full w-fit items-center justify-center rounded-xl border-[1.6px] border-white object-cover p-2"
                    >
                        <img
                            :src="`${url}/storage/${channel.profile_photo_path}`" 
                            class="rounded-xl w-32 h-32 object-cover"
                            alt="Foto Channel"
                        />
                    </div>

                    <div class="flex flex-col items-center justify-center">
                        <h2 class="text-center text-2xl font-black text-white">
                            {{ channel.name }}
                        </h2>
                        <p
                            class="mt-1 justify-center text-center text-sm leading-5 text-white"
                        >
                            {{ channel.location }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="-mt-6 flex justify-center">
                <Link
                    :href="`/register/ekraf?channel_id=${channel.id}`"
                    class="w-fit rounded-[20px] border border-white bg-[#01ABFF] px-4 py-3 shadow-xl"
                >
                    <p class="font-semibold text-white">
                        Daftar Sebagai Mitra Ekraf
                    </p>
                </Link>
            </div>

            <div class="mt-4 flex flex-col gap-4 px-3">
                
                <div
                    v-for="(mission, index) in missions.data"
                    :key="mission.id ?? index"
                    :class="[
                        'flex items-start justify-between rounded-xl p-4',
                        index % 3 === 0
                            ? ' from-[#ACDD36] to-[#29A983]'
                            : index % 3 === 1
                              ? 'from-[#54C5F0] to-[#329ED6]'
                              : 'from-[#F0DC55] to-[#EE924C]',
                    ]"
                    class="flex items-center justify-between gap-4 rounded-4xl bg-gradient-to-br p-6 shadow-xl"
                >
                    <div class="w-full">
                        <h2 class="text-xl font-semibold text-white">
                            {{ mission.title }}
                        </h2>
                        <p class="mb-4 text-[12px] text-white">
                            {{ mission.description }}
                        </p>
                        <div class="flex w-full">
                            <Link
                                :href="`/dashboard/misi/${mission.id}`"
                                class="flex w-[90%] justify-center rounded-full border border-white bg-white px-6 py-2"
                            >
                                <p
                                    class="text-center text-xs font-semibold text-[#5ABC66]"
                                >
                                    Lihat Selengkapnya
                                </p>
                            </Link>
                        </div>
                    </div>
                    <img
                        :src="`${url}/storage/${mission.mission_photo_path}`"
                        alt="Foto Misi"
                        class="w-25 rounded-2xl shadow-xl"
                    />
                </div>
                
                <div v-if="missions.data.length > 0" class="mt-8 pt-4 pb-12 flex justify-center">
                    <template v-for="(link, key) in missions.links" :key="key">
                        <div
                            v-if="link.url === null"
                            class="mb-1 mr-1 px-3 py-2 text-gray-500 text-xs leading-4 border rounded-lg"
                            v-html="link.label"
                        />
                        <Link
                            v-else
                            class="mb-1 mr-1 px-3 py-2 text-xs leading-4 border rounded-lg hover:bg-[#1485FF]/10 transition"
                            :class="{ 'bg-[#1485FF] text-white border-none': link.active, 'text-black bg-white': !link.active }"
                            :href="link.url"
                            v-html="link.label"
                            preserve-scroll
                            preserve-state
                        />
                    </template>
                </div>
                
                <div v-if="missions.data.length === 0" class="text-center text-gray-700 py-10">
                    <p>Tidak ada misi yang ditemukan di channel ini.</p>
                </div>
            </div>
        </div>

        <nav
            class="fixed right-0 bottom-0 left-0 border-t border-gray-200 bg-white"
            style="border-radius: 30px 30px 0 0"
        >
           <div class="mx-auto flex h-20 max-w-lg items-center justify-around px-4">
               <Link href="/dashboard" class="flex flex-col items-center p-2 text-gray-400">
                   <Icon icon="mdi:home" class="text-3xl text-gray-400"></Icon>
               </Link>

               <Link href="/dashboard/leaderboard" class="flex flex-col items-center p-2">
                   <Icon icon="material-symbols:leaderboard-rounded" class="text-3xl text-gray-400"></Icon>
               </Link>

               <Link href="/dashboard/scan" class="-mt-10 rounded-full bg-[#1485FF] p-4 shadow-lg">
                   <Icon icon="mdi:qrcode-scan" class="text-4xl text-white"></Icon>
               </Link>

               <Link href="/dashboard/wisata" class="flex flex-col items-center p-2 text-[#1485FF]">
                   <Icon icon="streamline-flex:target-solid" class="text-3xl"></Icon>
               </Link>

               <Link href="/dashboard/hadiah" class="flex flex-col items-center p-2 text-gray-400">
                   <Icon icon="mdi:gift" class="text-3xl"></Icon>
               </Link>
           </div>
        </nav>
    </div>
</template>

<style scoped>
.rounded-4xl {
    border-radius: 2rem;
}
.h-90 {
    height: 22.5rem; 
}
.pt-15 {
    padding-top: 3.75rem; 
}
.w-25 {
    width: 6.25rem; 
}
</style>
