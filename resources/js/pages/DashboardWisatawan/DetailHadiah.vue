<script setup>
import { Icon } from '@iconify/vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    detail_reward: Object,
    user: Object,
});

console.log(props.detail_reward);
const url = 'http://127.0.0.1:8000';

const userPoints = props.user?.tourist_profile?.point_value ?? 0;
const rewardCost = props.detail_reward?.points_cost ?? 999999;

const canAfford = userPoints >= rewardCost;

const exchangeForm = useForm({});

const submitExchange = () => {
    if (canAfford) {
        exchangeForm.post(`/dashboard/hadiah/${props.detail_reward.id}`, {
            onSuccess: () => {
                alert('Penukaran berhasil! Kunjungi ekraf untuk detailnya.');
            },
            onError: (errors) => {
                console.log(errors);
                const errorMessage =
                    errors.exchange || 'Gagal memproses penukaran.';
                alert(`Gagal: ${errorMessage}`);
            },
        });
    } else {
        alert('Maaf, poin Anda tidak mencukupi untuk menukar hadiah ini.');
    }
};
</script>
<template>
    <div class="bg-[#D6EFFF]">
        <div class="p-6">
            <div class="mb-6 flex items-center justify-between">
                <p class="text-2xl font-bold text-gray-900">Tukar Poinmu!</p>

                <div
                    class="flex h-fit w-fit items-center justify-center rounded-lg bg-[#01ABFF] p-1"
                >
                    <Icon icon="mdi:gift-open" class="text-4xl text-white" />
                </div>
            </div>

            <div
                class="flex h-fit w-full flex-shrink-0 flex-col gap-4 overflow-hidden rounded-3xl bg-gradient-to-b from-[#0BB6FC] to-[#5372EE] p-4 py-6 text-white shadow-lg"
            >
                <div class="flex items-center gap-4">
                    <div class="z-10 flex flex-col">
                        <div
                            class="bg-opacity-20 mb-2 h-fit w-fit rounded-full bg-white p-2"
                        >
                            <Icon
                                icon="ic:round-stars"
                                class="text-6xl text-yellow-400"
                            ></Icon>
                        </div>
                    </div>

                    <div class="">
                        <h2 class="mb-1 text-xl font-semibold">
                            Poin Hadiah Anda
                        </h2>
                        <p class="mb-3 text-xl font-medium">
                            Anda memiliki
                            <span class="font-bold">{{ userPoints }} poin</span>
                        </p>
                    </div>
                </div>
                <div class="h-1.5 w-full rounded-full bg-yellow-400"></div>
            </div>
        </div>

        <div
            class="relative mt-16 rounded-t-3xl bg-white p-8 pb-20 shadow-2xl sm:mt-20"
        >
            <div
                :class="[
                    'mx-auto -mt-28 w-full rounded-xl bg-gradient-to-r from-[#FFF2DE] to-[#FFE0B2] p-5 shadow-xl transition',
                ]"
            >
                <h2 class="text-xl leading-tight font-bold text-gray-900">
                    {{ detail_reward?.title ?? 'Nama Hadiah' }}
                </h2>
                <div class="mt-3 flex items-center justify-between">
                    <p class="text-base text-gray-700">
                        Tipe: {{ detail_reward?.type ?? 'N/A' }}
                    </p>
                    <div class="flex items-center space-x-1">
                        <Icon
                            icon="mdi:star"
                            class="text-2xl text-yellow-500"
                        />
                        <span class="text-lg font-semibold text-gray-800"
                            >{{ rewardCost }} Poin</span
                        >
                    </div>
                </div>
            </div>

            <p class="mt-2 text-base text-gray-600"></p>

            <div class="mt-8 space-y-5">
                <div
                    class="mx-auto flex items-center justify-center overflow-hidden rounded-2xl border-4 border-white shadow-lg"
                >
                    <img
                        :src="`${url}/storage/${detail_reward?.reward_photo_path}`"
                        alt="foto hadiah"
                        class="w-full rounded-xl object-cover"
                    />
                </div>

                <h2 class="mt-6 text-center text-2xl font-black text-black">
                    {{ detail_reward?.title ?? 'Nama Hadiah' }}
                </h2>
                <div>
                    <h2 class="mt-10 mb-2 text-2xl font-black text-black">
                        Deskripsi Hadiah
                    </h2>
                    <p class="text-justify font-semibold text-gray-700">
                        {{
                            detail_reward?.description ??
                            'Deskripsi tidak tersedia.'
                        }}
                    </p>
                </div>
                <div>
                    <h2 class="mt-10 mb-2 text-2xl font-black text-black">
                        Alamat Ekraf
                    </h2>
                    <p class="text-justify font-semibold text-gray-700">
                        {{
                            `${detail_reward?.ekraf_partner?.channel?.location} (${detail_reward?.ekraf_partner?.business_address})` ??
                            'Alamat tidak tersedia.'
                        }}
                    </p>
                </div>
                <div>
                    <h2 class="mt-10 mb-2 text-2xl font-black text-black">
                        Nomer Telepon 
                    </h2>
                    <p class="text-justify font-semibold text-gray-700">
                        {{
                            detail_reward?.ekraf_partner?.phone ??
                            'nomer tidak tersedia.'
                        }}
                    </p>
                </div>
            </div>

            <div class="mt-8 flex w-full justify-between">
                <Link
                    :href="'/dashboard/hadiah'"
                    as="button"
                    class="z-10 rounded-full border border-[#01ABFF] bg-white px-10 py-2 text-sm font-medium text-[#01ABFF] shadow-lg transition duration-300 hover:bg-gray-100 sm:px-14"
                >
                    Batal
                </Link>

                <button
                    @click="submitExchange"
                    :disabled="exchangeForm.processing || !canAfford"
                    :class="{
                        'bg-[#01ABFF] hover:bg-[#0091e6]': canAfford,
                        'cursor-not-allowed bg-gray-400': !canAfford,
                    }"
                    class="z-10 rounded-full px-10 py-2 text-sm font-medium text-white shadow-lg transition duration-300 sm:px-14"
                >
                    <span v-if="exchangeForm.processing">Memproses...</span>
                    <span v-else>{{
                        canAfford
                            ? 'Tukar Sekarang'
                            : `kurang ${rewardCost - userPoints} poin`
                    }}</span>
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.mt-30 {
    margin-top: 7.5rem;
}
</style>
