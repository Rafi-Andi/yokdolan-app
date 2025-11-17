<script setup>
import { Icon } from '@iconify/vue';
import { Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    reward: Array,
    user: Object,
    types: Array,
    partners: Array,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const selectedType = ref(props.filters?.type || '');
const selectedPartner = ref(props.filters?.partner_id || '');
const showFilterModal = ref(false);

let searchTimeout = null;

watch(search, (newValue) => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        applyFilters();
    }, 500);
});

const applyFilters = () => {
    const params = {};

    if (search.value && search.value.trim() !== '') {
        params.search = search.value;
    }
    if (selectedType.value && selectedType.value !== '') {
        params.type = selectedType.value;
    }
    if (selectedPartner.value && selectedPartner.value !== '') {
        params.partner_id = selectedPartner.value;
    }

    router.get('/dashboard/hadiah', params, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: (page) => {
            console.log('Filter applied successfully:', page.props);
        },
        onError: (errors) => {
            console.error('Filter error:', errors);
        },
    });
};

const resetFilters = () => {
    search.value = '';
    selectedType.value = '';
    selectedPartner.value = '';
    showFilterModal.value = false;

    router.get(
        '/dashboard/hadiah',
        {},
        {
            preserveState: true,
            preserveScroll: true,
        },
    );
};

const applyModalFilters = () => {
    showFilterModal.value = false;
    applyFilters();
};

const getPartnerName = (reward) => {
    if (reward?.ekraf_partner?.business_name) {
        return reward.ekraf_partner.business_name;
    }
    if (reward?.partner_user?.name) {
        return reward.partner_user.name;
    }
    return 'Partner Tidak Tersedia';
};
</script>

<template>
    <div class="bg-[#D6EFFF] pb-30">
        <div class="flex items-center justify-between p-6">
            <p class="text-2xl font-bold text-black">Katalog Hadiah</p>

            <Link
                as="button"
                href="/dashboard/profile"
                class="h-10 w-10 cursor-pointer overflow-hidden rounded-lg bg-transparent"
            >
                <img
                    :src="`${user?.profile_url}`"
                    alt="profile"
                    class="h-full w-full object-cover"
                />
            </Link>
        </div>

        <div class="px-6">
            <div
                class="flex h-fit w-full flex-col gap-4 overflow-hidden rounded-3xl bg-gradient-to-b from-[#0BB6FC] to-[#5372EE] p-4 text-white shadow-lg"
            >
                <div class="flex items-center gap-4">
                    <div
                        class="bg-opacity-20 mb-2 h-fit w-fit rounded-full bg-white p-2"
                    >
                        <Icon
                            icon="ic:round-stars"
                            class="text-6xl text-[#1485FF]"
                        />
                    </div>

                    <div>
                        <h2 class="mb-1 text-xl font-semibold">Poin Hadiah</h2>
                        <p class="mb-3 text-xl font-medium">
                            Anda
                            <span class="font-bold">
                                {{
                                    props.user?.tourist_profile?.point_value ??
                                    'Loading...'
                                }}
                                poin
                            </span>
                        </p>
                    </div>
                </div>

                <div class="h-1.5 w-full rounded-full bg-yellow-400"></div>

                <Link
                    href="/dashboard/wisata"
                    class="flex justify-center rounded-full bg-white px-6 py-2 text-sm font-medium text-blue-600 shadow-lg transition duration-300 hover:bg-gray-100"
                >
                    Dapatkan Poin
                </Link>
            </div>
        </div>

        <div class="px-6 pt-4">
            <h1 class="text-2xl font-bold text-black">Daftar Hadiah</h1>
        </div>

        <div class="mt-2 flex w-full justify-between gap-3 px-6">
            <div class="relative w-full rounded-lg bg-white p-2 py-4">
                <input
                    v-model="search"
                    type="text"
                    placeholder="Cari hadiah..."
                    class="w-full px-8 text-black outline-none"
                />
                <Icon
                    icon="material-symbols:search-rounded"
                    class="absolute top-3 left-2 text-3xl text-gray-500"
                />

                <button
                    v-if="search"
                    @click="search = ''"
                    class="absolute top-3 right-2 text-gray-400 hover:text-gray-600"
                >
                    <Icon icon="mdi:close-circle" class="text-2xl" />
                </button>
            </div>

            <button
                @click="showFilterModal = true"
                class="relative flex h-fit w-fit items-center justify-center rounded-lg bg-[#01ABFF] p-2"
            >
                <Icon icon="mage:filter" class="text-4xl" />
                <span
                    v-if="selectedType || selectedPartner"
                    class="absolute -top-1 -right-1 h-3 w-3 rounded-full bg-red-500"
                ></span>
            </button>
        </div>

        <div
            v-if="selectedType || selectedPartner"
            class="mt-3 flex flex-wrap gap-2 px-6"
        >
            <div
                v-if="selectedType"
                class="flex items-center gap-2 rounded-full bg-white px-4 py-2 shadow-sm"
            >
                <span class="text-sm text-black">Tipe: {{ selectedType }}</span>
                <button
                    @click="
                        selectedType = '';
                        applyFilters();
                    "
                >
                    <Icon icon="mdi:close" class="text-lg text-gray-500" />
                </button>
            </div>

            <div
                v-if="selectedPartner"
                class="flex items-center text-black gap-2 rounded-full bg-white px-4 py-2 shadow-sm"
            >
                <span class="text-sm">
                    Partner:
                    {{
                        partners.find((p) => p.id == selectedPartner)
                            ?.business_name
                    }}
                </span>
                <button
                    @click="
                        selectedPartner = '';
                        applyFilters();
                    "
                >
                    <Icon icon="mdi:close" class="text-lg text-gray-500" />
                </button>
            </div>

            <button
                @click="resetFilters"
                class="rounded-full bg-red-100 px-4 py-2 text-sm font-medium text-red-600"
            >
                Reset Semua
            </button>
        </div>

        <div class="mt-6 mb-28 flex flex-col gap-3 px-6">
            <div
                v-if="props.reward.data && props.reward.data.length === 0"
                class="py-10 text-center"
            >
                <Icon
                    icon="mdi:gift-off"
                    class="mx-auto mb-3 text-6xl text-gray-400"
                />
                <p class="text-lg text-gray-500">Tidak ada hadiah ditemukan</p>
                <button
                    @click="resetFilters"
                    class="mt-4 text-blue-600 underline"
                >
                    Reset Filter
                </button>
            </div>

            <template v-else>
                <Link
                    v-for="(rewards, index) in props.reward.data"
                    :key="rewards.id"
                    :href="`/dashboard/hadiah/${rewards.id}`"
                    :class="[
                        'w-full rounded-xl p-5 shadow-md transition',
                        index % 2 === 0
                            ? 'bg-gradient-to-r from-[#FFF2DE] to-[#FFE0B2]'
                            : 'bg-gradient-to-r from-[#FCE4EC] to-[#F8BBD0]',
                    ]"
                >
                    <h2 class="text-xl leading-tight font-bold text-gray-900">
                        {{ rewards?.title ?? 'Loading...' }}
                    </h2>

                    <div class=" mt-3 flex items-center justify-between">
                        <div>
                            <p class="text-base text-gray-700">
                                Tipe: {{ rewards?.type ?? '-' }}
                            </p>
                            <p class="mt-1 text-sm text-gray-600">
                                Partner: {{ getPartnerName(rewards) }}
                            </p>
                        </div>

                        <div class="flex items-center space-x-1">
                            <Icon
                                icon="mdi:star"
                                class="text-2xl text-gray-600"
                            />
                            <span class="text-sm font-semibold text-gray-800">
                                {{ rewards?.points_cost ?? 0 }} Poin
                            </span>
                        </div>
                    </div>
                </Link>

                <div
                    v-if="props.reward.links && props.reward.links.length > 3"
                    class="mt-6 flex items-center justify-center gap-2"
                >
                    <Link
                        v-for="(link, index) in props.reward.links"
                        :key="index"
                        :href="link.url || '#'"
                        :class="[
                            'rounded-lg px-4 py-2 font-medium transition',
                            link.active
                                ? 'bg-[#01ABFF] text-white'
                                : link.url
                                  ? 'bg-white text-gray-700 hover:bg-gray-100'
                                  : 'cursor-not-allowed bg-gray-100 text-gray-400',
                            'flex min-w-[40px] items-center justify-center',
                        ]"
                        :preserve-scroll="true"
                        v-html="link.label"
                    />
                </div>

                <div
                    v-if="props.reward.total"
                    class="mt-4 text-center text-sm text-gray-600"
                >
                    Menampilkan {{ props.reward.from }} -
                    {{ props.reward.to }} dari {{ props.reward.total }} hadiah
                </div>
            </template>
        </div>

        <div
            v-if="showFilterModal"
            class="bg-opacity-50 fixed inset-0 z-[60] flex items-end bg-black"
            @click.self="showFilterModal = false"
        >
            <div
                class="animate-slide-up max-h-[85vh] w-full overflow-y-auto rounded-t-3xl bg-white p-6 pb-32"
            >
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-black">Filter Hadiah</h3>
                    <button @click="showFilterModal = false" type="button">
                        <Icon icon="mdi:close" class="text-2xl text-gray-500" />
                    </button>
                </div>

                <div class="mb-6">
                    <label class="mb-2 block text-sm font-medium text-gray-700"
                        >Tipe Hadiah</label
                    >
                    <select
                        v-model="selectedType"
                        @change="console.log('Type changed to:', selectedType)"
                        class="text-black w-full rounded-lg border border-gray-300 p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    >
                        <option value="">Semua Tipe</option>
                        <option
                            v-for="(type, index) in props.types"
                            :key="index"
                            :value="type"
                        >
                            {{ type }}
                        </option>
                    </select>
                    <p
                        v-if="!props.types || props.types.length === 0"
                        class="mt-1 text-xs text-red-500"
                    >
                        Tidak ada tipe tersedia
                    </p>
                    <p v-else class="mt-1 text-xs text-gray-500">
                        {{ props.types.length }} tipe tersedia
                    </p>
                </div>

                <div class="mb-6">
                    <label class="mb-2 block text-sm font-medium text-gray-700"
                        >Partner EKRAF</label
                    >
                    <select
                        v-model="selectedPartner"
                        @change="
                            console.log('Partner changed to:', selectedPartner)
                        "
                        class="text-black w-full rounded-lg border border-gray-300 p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    >
                        <option value="">Semua Partner</option>
                        <option
                            v-for="partner in props.partners"
                            :key="partner.id"
                            :value="partner.id"
                        >
                            {{ partner.business_name }}
                        </option>
                    </select>
                    <p
                        v-if="!props.partners || props.partners.length === 0"
                        class="mt-1 text-xs text-red-500"
                    >
                        Tidak ada partner tersedia
                    </p>
                    <p v-else class="mt-1 text-xs text-gray-500">
                        {{ props.partners.length }} partner tersedia
                    </p>
                </div>

                <div class="mt-6 flex gap-3 pb-4">
                    <button
                        @click.prevent="resetFilters"
                        type="button"
                        class="flex-1 rounded-lg border-2 border-gray-300 py-4 text-base font-medium text-gray-700 hover:bg-gray-50"
                    >
                        Reset
                    </button>
                    <button
                        @click.prevent="applyModalFilters"
                        type="button"
                        class="flex-1 rounded-lg bg-[#01ABFF] py-4 text-base font-medium text-white hover:bg-blue-600"
                    >
                        Terapkan
                    </button>
                </div>
            </div>
        </div>

        <nav
            class="fixed right-0 bottom-0 left-0 z-50 border-t border-gray-200 bg-white"
            style="border-radius: 30px 30px 0 0"
        >
            <div
                class="mx-auto flex h-20 max-w-lg items-center justify-around px-4"
            >
                <Link
                    href="/dashboard"
                    class="flex flex-col items-center p-2 text-gray-400"
                >
                    <Icon icon="mdi:home" class="text-3xl" />
                </Link>

                <Link
                    href="/dashboard/leaderboard"
                    class="flex flex-col items-center p-2"
                >
                    <Icon
                        icon="material-symbols:leaderboard-rounded"
                        class="text-3xl text-gray-400"
                    />
                </Link>

                <Link
                    href="/dashboard/scan"
                    class="-mt-10 rounded-full bg-[#1485FF] p-4 shadow-lg"
                >
                    <Icon icon="mdi:qrcode-scan" class="text-4xl text-white" />
                </Link>

                <Link
                    href="/dashboard/wisata"
                    class="flex flex-col items-center p-2 text-gray-400"
                >
                    <Icon
                        icon="streamline-flex:target-solid"
                        class="text-3xl"
                    />
                </Link>

                <Link
                    href="/dashboard/hadiah"
                    class="flex flex-col items-center p-2 text-[#1485FF]"
                >
                    <Icon icon="mdi:gift" class="text-3xl" />
                </Link>
            </div>
        </nav>
    </div>
</template>

<style scoped>
@keyframes slide-up {
    from {
        transform: translateY(100%);
    }
    to {
        transform: translateY(0);
    }
}

.animate-slide-up {
    animation: slide-up 0.3s ease-out;
}
</style>
