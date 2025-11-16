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
        }
    });
};

const resetFilters = () => {
    search.value = '';
    selectedType.value = '';
    selectedPartner.value = '';
    showFilterModal.value = false;
    
    router.get('/dashboard/hadiah', {}, {
        preserveState: true,
        preserveScroll: true,
    });
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
        <div class="flex justify-between items-center p-6">
            <p class="font-bold text-2xl">Katalog Hadiah</p>

            <div class="flex justify-center items-center w-fit h-fit p-1 rounded-lg bg-[#01ABFF]">
                <Icon icon="mdi:gift" class="text-4xl" />
            </div>
        </div>

        <div class="px-6">
            <div class="w-full h-fit bg-gradient-to-b from-[#0BB6FC] to-[#5372EE]
                 rounded-3xl shadow-lg p-4 gap-4 flex flex-col text-white overflow-hidden">

                <div class="flex gap-4 items-center"> 
                    <div class="bg-white bg-opacity-20 rounded-full p-2 mb-2 h-fit w-fit">
                        <Icon icon="ic:round-stars" class="text-6xl text-[#1485FF]" />
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold mb-1">Poin Hadiah</h2>
                        <p class="text-xl mb-3 font-medium">
                            Anda 
                            <span class="font-bold">
                                {{ props.user?.tourist_profile?.point_value ?? 'Loading...' }} poin
                            </span>
                        </p>
                    </div>
                </div>

                <div class="w-full h-1.5 bg-yellow-400 rounded-full"></div>

                <Link href="/dashboard/wisata" class="flex justify-center bg-white text-blue-600 text-sm font-medium py-2 px-6 rounded-full shadow-lg hover:bg-gray-100 transition duration-300">
                    Dapatkan Poin
                </Link>
            </div>
        </div>

        <div class="px-6 pt-4">
            <h1 class="font-bold text-2xl">Daftar Hadiah</h1>
        </div>

        <div class="flex px-6 w-full justify-between mt-2 gap-3">
            <div class="relative p-2 py-4 bg-white rounded-lg w-full">
                <input 
                    v-model="search"
                    type="text" 
                    placeholder="Cari hadiah..." 
                    class="px-8 outline-none w-full" 
                />
                <Icon icon="material-symbols:search-rounded" class="absolute left-2 top-3 text-3xl text-gray-500" />
                
                <button 
                    v-if="search"
                    @click="search = ''"
                    class="absolute right-2 top-3 text-gray-400 hover:text-gray-600"
                >
                    <Icon icon="mdi:close-circle" class="text-2xl" />
                </button>
            </div>

            <button 
                @click="showFilterModal = true"
                class="flex justify-center items-center w-fit h-fit p-2 rounded-lg bg-[#01ABFF] relative"
            >
                <Icon icon="mage:filter" class="text-4xl" />
                <span 
                    v-if="selectedType || selectedPartner"
                    class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"
                ></span>
            </button>
        </div>

        <div v-if="selectedType || selectedPartner" class="px-6 mt-3 flex flex-wrap gap-2">
            <div v-if="selectedType" class="bg-white rounded-full px-4 py-2 flex items-center gap-2 shadow-sm">
                <span class="text-sm">Tipe: {{ selectedType }}</span>
                <button @click="selectedType = ''; applyFilters()">
                    <Icon icon="mdi:close" class="text-lg text-gray-500" />
                </button>
            </div>
            
            <div v-if="selectedPartner" class="bg-white rounded-full px-4 py-2 flex items-center gap-2 shadow-sm">
                <span class="text-sm">
                    Partner: {{ partners.find(p => p.id == selectedPartner)?.business_name }}
                </span>
                <button @click="selectedPartner = ''; applyFilters()">
                    <Icon icon="mdi:close" class="text-lg text-gray-500" />
                </button>
            </div>

            <button 
                @click="resetFilters"
                class="bg-red-100 text-red-600 rounded-full px-4 py-2 text-sm font-medium"
            >
                Reset Semua
            </button>
        </div>

        <div class="px-6 mt-6 flex flex-col gap-3 mb-28">
            <div v-if="props.reward.data && props.reward.data.length === 0" class="text-center py-10">
                <Icon icon="mdi:gift-off" class="text-6xl text-gray-400 mx-auto mb-3" />
                <p class="text-gray-500 text-lg">Tidak ada hadiah ditemukan</p>
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
                            : 'bg-gradient-to-r from-[#FCE4EC] to-[#F8BBD0]'
                    ]"
                >
                    <h2 class="text-xl font-bold text-gray-900 leading-tight">
                        {{ rewards?.title ?? 'Loading...' }}
                    </h2>

                    <div class="flex justify-between items-center mt-3">
                        <div>
                            <p class="text-base text-gray-700">Tipe: {{ rewards?.type ?? '-' }}</p>
                            <p class="text-sm text-gray-600 mt-1">
                                Partner: {{ getPartnerName(rewards) }}
                            </p>
                        </div>

                        <div class="flex items-center space-x-1">
                            <Icon icon="mdi:star" class="text-2xl text-gray-600" />
                            <span class="text-sm font-semibold text-gray-800">
                                {{ rewards?.points_cost ?? 0 }} Poin
                            </span>
                        </div>
                    </div>
                </Link>

                <div v-if="props.reward.links && props.reward.links.length > 3" class="flex justify-center items-center gap-2 mt-6">
                    <Link
                        v-for="(link, index) in props.reward.links"
                        :key="index"
                        :href="link.url || '#'"
                        :class="[
                            'px-4 py-2 rounded-lg font-medium transition',
                            link.active 
                                ? 'bg-[#01ABFF] text-white' 
                                : link.url 
                                    ? 'bg-white text-gray-700 hover:bg-gray-100' 
                                    : 'bg-gray-100 text-gray-400 cursor-not-allowed',
                            'flex items-center justify-center min-w-[40px]'
                        ]"
                        :preserve-scroll="true"
                        v-html="link.label"
                    />
                </div>

                <div v-if="props.reward.total" class="text-center text-sm text-gray-600 mt-4">
                    Menampilkan {{ props.reward.from }} - {{ props.reward.to }} dari {{ props.reward.total }} hadiah
                </div>
            </template>
        </div>
        
        <div 
            v-if="showFilterModal"
            class="fixed inset-0 bg-black bg-opacity-50 z-[60] flex items-end"
            @click.self="showFilterModal = false"
        >
            <div class="bg-white w-full rounded-t-3xl p-6 pb-32 animate-slide-up max-h-[85vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Filter Hadiah</h3>
                    <button @click="showFilterModal = false" type="button">
                        <Icon icon="mdi:close" class="text-2xl text-gray-500" />
                    </button>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Hadiah</label>
                    <select 
                        v-model="selectedType"
                        @change="console.log('Type changed to:', selectedType)"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
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
                    <p v-if="!props.types || props.types.length === 0" class="text-xs text-red-500 mt-1">
                        Tidak ada tipe tersedia
                    </p>
                    <p v-else class="text-xs text-gray-500 mt-1">
                        {{ props.types.length }} tipe tersedia
                    </p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Partner EKRAF</label>
                    <select 
                        v-model="selectedPartner"
                        @change="console.log('Partner changed to:', selectedPartner)"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
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
                    <p v-if="!props.partners || props.partners.length === 0" class="text-xs text-red-500 mt-1">
                        Tidak ada partner tersedia
                    </p>
                    <p v-else class="text-xs text-gray-500 mt-1">
                        {{ props.partners.length }} partner tersedia
                    </p>
                </div>

                <div class="flex gap-3 mt-6 pb-4">
                    <button 
                        @click.prevent="resetFilters"
                        type="button"
                        class="flex-1 py-4 border-2 border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 text-base"
                    >
                        Reset
                    </button>
                    <button 
                        @click.prevent="applyModalFilters"
                        type="button"
                        class="flex-1 py-4 bg-[#01ABFF] text-white rounded-lg font-medium hover:bg-blue-600 text-base"
                    >
                        Terapkan
                    </button>
                </div>
            </div>
        </div>

        <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50" style="border-radius: 30px 30px 0 0;">
            <div class="flex justify-around items-center h-20 max-w-lg mx-auto px-4">
                <Link href="/dashboard" class="p-2 flex flex-col items-center text-gray-400">
                    <Icon icon="mdi:home" class="text-3xl" />
                </Link>
                
                <Link href="/dashboard/leaderboard" class="p-2 flex flex-col items-center">
                    <Icon icon="material-symbols:leaderboard-rounded" class="text-3xl text-gray-400" />
                </Link>

                <Link href="/dashboard/scan" class="p-4 bg-[#1485FF] rounded-full -mt-10 shadow-lg">
                    <Icon icon="mdi:qrcode-scan" class="text-4xl text-white" />
                </Link>

                <Link href="/dashboard/wisata" class="p-2 flex flex-col items-center text-gray-400">
                    <Icon icon="streamline-flex:target-solid" class="text-3xl" />
                </Link>
                
                <Link href="/dashboard/hadiah" class="p-2 flex flex-col items-center text-[#1485FF]">
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