<script setup>
import { Icon } from '@iconify/vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const form = useForm({
    title: '',
    description: '',
    type: '',
    reward_photo: null,
});

const props = defineProps({
    pointMap: {
        type: Object,
        default: () => ({ Transaksi: 300, Interaksi: 700, Promosi: 500 }),
    },
});

const calculatedCost = computed(() => {
    return props.pointMap[form.type] || 0;
});

const photoPreview = ref(null);

const submit = () => {
    form.post('/dashboard/ekraf/store-reward', {
        onError: (errors) => {
            console.error('Validation Errors:', errors);
        },
    });
};

const handlePhotoUpload = (event) => {
    const file = event.target.files[0];

    if (file) {
        form.reward_photo = file;

        const reader = new FileReader();
        reader.onload = (e) => {
            photoPreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        form.reward_photo = null;
        photoPreview.value = null;
    }
};

const clearPhoto = () => {
    photoPreview.value = null;
    form.reward_photo = null;
    document.getElementById('gambar_hadiah_input').value = null;
};
</script>
<template>
    <div class="relative min-h-screen bg-[#EBF5FF]">
        <Head title="Tambah Hadiah" />
        
        <div class="pb-60">
            
            <header
                class="bg-top bg-no-repeat bg-cover flex flex-col gap-8 p-4 h-fit bg-[url('/images/texture.png')] mb-6"
            >
                <Link href="/dashboard/ekraf/reward" class="text-white">
                    <Icon icon="mdi:arrow-left" class="text-3xl"></Icon>
                </Link>
                <div class="flex-grow md:ml-8">
                    <h1 class="text-xl font-bold text-white">
                        Tambah Hadiah Baru
                    </h1>
                    <p class="text-sm text-white/80">
                        Atur Detail hadiah promosi anda
                    </p>
                </div>
            </header>

            <main class="px-4">
                <div class="mt-4 rounded-xl bg-[#D8EBFF] p-6 shadow-sm">
                    <form @submit.prevent="submit" class="space-y-4">
                        <div>
                            <label
                                for="nama_hadiah"
                                class="mb-1 block text-sm font-bold"
                            >
                                Nama Hadiah
                            </label>
                            <input
                                type="text"
                                id="nama_hadiah"
                                v-model="form.title"
                                placeholder="Contoh: Gratis 1 Gelas Kopi Susu"
                                class="w-full rounded-lg border-none bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-gray-300 focus:outline-none"
                                :class="{
                                    'border-red-500 ring-red-500':
                                        form.errors.title,
                                }"
                            />
                            <p
                                v-if="form.errors.title"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.title }}
                            </p>
                        </div>

                        <div>
                            <label
                                for="deskripsi_hadiah"
                                class="mb-1 block text-sm font-bold"
                            >
                                Deskripsi Hadiah
                            </label>
                            <textarea
                                id="deskripsi_hadiah"
                                v-model="form.description"
                                placeholder="Dapatkan gratis 1 produk spesial"
                                rows="4"
                                class="w-full rounded-lg border-none bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-gray-300 focus:outline-none"
                                :class="{
                                    'border-red-500 ring-red-500':
                                        form.errors.description,
                                }"
                            ></textarea>
                            <p
                                v-if="form.errors.description"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.description }}
                            </p>
                        </div>

                        <div>
                            <label
                                for="tipe_hadiah"
                                class="mb-1 block text-sm font-bold"
                            >
                                Tipe Hadiah
                            </label>
                            <div class="relative">
                                <select
                                    id="tipe_hadiah"
                                    v-model="form.type"
                                    class="w-full appearance-none rounded-lg border-none bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-gray-300 focus:outline-none"
                                    :class="{
                                        'border-red-500 ring-red-500':
                                            form.errors.type,
                                    }"
                                >
                                    <option value="" disabled>
                                        Pilih tipe hadiah
                                    </option>
                                    <option value="Diskon">
                                        Voucher Diskon
                                    </option>
                                    <option value="Gratis">
                                        Gratis Produk
                                    </option>
                                    <option value="Bonus">
                                        Beli 1 Gratis 1 (Bonus)
                                    </option>
                                </select>
                                <div
                                    class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2"
                                >
                                    <Icon
                                        icon="mdi:chevron-down"
                                        class="relative top-1 text-xl text-gray-500"
                                    ></Icon>
                                </div>
                            </div>
                            <p
                                v-if="form.errors.type"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.type }}
                            </p>
                        </div>

                        <div v-if="form.type">
                            <label
                                class="mb-1 block text-sm font-bold text-gray-700"
                                >Biaya Poin Ditukar</label
                            >
                            <div
                                class="flex items-center gap-2 rounded-lg border border-blue-300 bg-blue-100 p-3 text-lg font-extrabold text-blue-700"
                            >
                                <Icon
                                    icon="el:star-alt"
                                    class="text-2xl text-blue-600"
                                ></Icon>
                                {{ calculatedCost }} Poin
                            </div>
                            <p class="mt-1 text-xs text-gray-500">
                                Poin yang akan dipotong dari saldo wisatawan
                                saat menukarkan hadiah ini.
                            </p>
                        </div>

                        <div>
                            <label
                                for="gambar_hadiah_input"
                                class="mb-1 block text-sm font-bold"
                            >
                                Gambar Hadiah
                            </label>
                            <div class="relative">
                                <input
                                    type="file"
                                    id="gambar_hadiah_input"
                                    @change="handlePhotoUpload"
                                    class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0"
                                    accept="image/*"
                                />

                                <div
                                    class="flex h-48 w-full flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-dashed border-gray-400 bg-white"
                                    :class="{
                                        'border-red-500':
                                            form.errors.reward_photo,
                                    }"
                                >
                                    <div
                                        v-if="photoPreview"
                                        class="relative h-full w-full"
                                    >
                                        <img
                                            :src="photoPreview"
                                            alt="Reward Preview"
                                            class="h-full w-full object-cover"
                                        />
                                        <button
                                            type="button"
                                            @click.stop="clearPhoto"
                                            class="absolute top-2 right-2 rounded-full bg-black/50 p-1 text-white transition hover:bg-black/70"
                                        >
                                            <Icon
                                                icon="mdi:close"
                                                class="text-lg"
                                            ></Icon>
                                        </button>
                                    </div>

                                    <div v-else class="text-center">
                                            <Icon
                                                icon="fa6-solid:image"
                                                class="text-6xl text-gray-400 mx-auto"
                                            ></Icon>
                                        <p class="text-gray-600">
                                            Upload Gambar (Max 5MB)
                                        </p>
                                    </div>
                                    
                                </div>
                            </div>
                            <p
                                v-if="form.errors.reward_photo"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ form.errors.reward_photo }}
                            </p>
                        </div>
                    </form>
                </div>
            </main>
        </div>

        <div
            class="absolute bottom-0 w-full bg-[#D8EBFF] p-4"
        >
            <div class="space-y-2">
                <button
                    @click="submit"
                    :disabled="form.processing"
                    class="w-full rounded-xl bg-linear-to-r from-[#146AC7] to-[#75B7FD] px-4 py-3 text-base font-medium text-white hover:from-[#0F4F9C] hover:to-[#4C90E0] transition-all"
                >
                    {{ form.processing ? 'Menyimpan...' : 'Simpan Reward' }}
                </button>
                <Link
                    href="/dashboard/ekraf/reward"
                    class="block w-full rounded-xl bg-white px-4 py-3 text-center text-base font-semibold text-black hover:bg-gray-200 transition-all"
                >
                    Batal
                </Link>
            </div>
        </div>
    </div>
</template>
