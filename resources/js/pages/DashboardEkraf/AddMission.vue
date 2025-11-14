<script setup>
import { Icon } from '@iconify/vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { computed } from 'vue';

const form = useForm({
    title: '',
    description: '',
    type: '',
    mission_photo: null,
});

const photoPreview = ref(null);

const props = defineProps({
    channels: {
        type: Array,
        default: () => [{ id: 1, name: 'Bromo & Sekitarnya' }],
    },
    errors: Object,
    pointMap: {
        type: Object,
        default: () => ({ Transaksi: 300, Interaksi: 700, Promosi: 500 }),
    },
});

const calculatedPoints = computed(() => {
    return props.pointMap[form.type] || 0;
});

const handlePhotoUpload = (event) => {
    const file = event.target.files[0];

    if (file) {
        form.mission_photo = file;

        const reader = new FileReader();
        reader.onload = (e) => {
            photoPreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        form.mission_photo = null;
        photoPreview.value = null;
    }
};

const clearPhoto = () => {
    photoPreview.value = null;
    form.mission_photo = null;
    document.getElementById('gambar_misi_input').value = null;
};

const submit = () => {
    form.post('/dashboard/ekraf/store-mission', {
        onSuccess: () => {
            form.reset();
            clearPhoto();
        },
        onError: (errors) => {
            console.error('Error saat menyimpan misi:', errors);
        },
    });
};
</script>

<template>
    <Head title="Tambah Misi Baru" />

    <div class="relative min-h-screen bg-[#EBF5FF]">
        <div class="pb-60">
            <header class="flex flex-col gap-8 bg-white p-4 h-fit bg-[url('/images/texture.png')] bg-cover bg-top bg-no-repeat mb-6">
                <Link href="/dashboard/ekraf/mission" class="text-white">
                    <Icon icon="mdi:arrow-left" class="text-3xl"></Icon>
                </Link>
                <div class="flex-grow md:ml-8">
                    <h1 class="text-xl font-bold text-white">
                        Tambah Misi Baru
                    </h1>
                    <p class="text-sm text-white/80">
                        Atur Detail misi promosi anda
                    </p>
                </div>
            </header>

            <main class="px-4">
                <div class="mt-4 rounded-xl bg-[#D8EBFF] p-6 shadow-sm">
                    <form @submit.prevent="submit" class="space-y-4">
                        <div>
                            <label
                                for="judul_misi"
                                class="mb-1 block text-sm font-bold"
                                >Judul Misi</label
                            >
                            <input
                                type="text"
                                id="judul_misi"
                                placeholder="Contoh: Membeli Kopi Susu"
                                v-model="form.title"
                                required
                                class="w-full rounded-lg border-none bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-gray-300 focus:outline-none"
                                :class="{
                                    'border-red-500 ring-red-500':
                                        form.errors.title,
                                }"
                            />
                            <span
                                v-if="form.errors.title"
                                class="mt-1 text-xs text-red-500"
                                >{{ form.errors.title }}</span
                            >
                        </div>

                        <div>
                            <label
                                for="deskripsi_misi"
                                class="mb-1 block text-sm font-bold"
                                >Deskripsi Misi</label
                            >
                            <textarea
                                id="deskripsi_misi"
                                placeholder="Jelaskan detail dan syarat misi di sini"
                                rows="4"
                                v-model="form.description"
                                required
                                class="w-full rounded-lg border-none bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-gray-300 focus:outline-none"
                                :class="{
                                    'border-red-500 ring-red-500':
                                        form.errors.description,
                                }"
                            ></textarea>
                            <span
                                v-if="form.errors.description"
                                class="mt-1 text-xs text-red-500"
                                >{{ form.errors.description }}</span
                            >
                        </div>

                        <div>
                            <label
                                for="tipe_misi"
                                class="mb-1 block text-sm font-bold"
                                >Tipe Misi</label
                            >
                            <div class="relative">
                                <select
                                    id="tipe_misi"
                                    v-model="form.type"
                                    required
                                    class="w-full appearance-none rounded-lg border-none bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-gray-300 focus:outline-none"
                                    :class="{
                                        'border-red-500 ring-red-500':
                                            form.errors.type,
                                    }"
                                >
                                    <option value="" disabled>
                                        Pilih tipe misi
                                    </option>
                                    <option value="Transaksi">
                                        Transaksi (300 Poin)
                                    </option>
                                    <option value="Interaksi">
                                        Interaksi (700 Poin)
                                    </option>
                                    <option value="Promosi">
                                        Promosi (500 Poin)
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div v-if="form.type">
                            <label
                                class="mb-1 block text-sm font-bold text-gray-700"
                                >Poin yang Didapatkan</label
                            >
                            <div
                                class="flex items-center gap-2 rounded-lg border border-blue-300 bg-blue-100 p-3 text-lg font-extrabold text-blue-700"
                            >
                                <Icon
                                    icon="el:star-alt"
                                    class="text-2xl text-blue-600"
                                ></Icon>
                                {{ calculatedPoints }} Poin
                            </div>
                            <p class="mt-1 text-xs text-gray-500">
                                Poin ini akan otomatis didapatkan oleh wisatawan
                                yang berhasil menyelesaikan misi.
                            </p>
                        </div>

                        <div>
                            <label
                                for="gambar_misi_input"
                                class="mb-1 block text-sm font-bold"
                            >
                                Gambar Misi
                            </label>
                            <div class="relative">
                                <input
                                    type="file"
                                    id="gambar_misi_input"
                                    @change="handlePhotoUpload"
                                    class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0"
                                    accept="image/*"
                                />

                                <div
                                    class="flex h-48 w-full flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-dashed border-gray-400 bg-white"
                                    :class="{
                                        'border-red-500 ring-red-500':
                                            form.errors.mission_photo,
                                    }"
                                >
                                    <div
                                        v-if="photoPreview"
                                        class="relative h-full w-full"
                                    >
                                        <img
                                            :src="photoPreview"
                                            alt="Mission Preview"
                                            class="h-full w-full object-cover"
                                        />
                                        <button
                                            type="button"
                                            @click.stop="clearPhoto"
                                            class="absolute top-2 right-2 z-20 rounded-full bg-black/50 p-1 text-white transition hover:bg-black/70"
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
                            <span
                                v-if="form.errors.mission_photo"
                                class="mt-1 text-xs text-red-500"
                                >{{ form.errors.mission_photo }}</span
                            >
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
                    class="w-full rounded-xl bg-linear-to-r from-[#146AC7] to-[#75B7FD] px-4 py-3 text-base font-medium text-white"
                >
                    {{
                        form.processing
                            ? 'Memproses...'
                            : 'Simpan & Generate Kode Qr'
                    }}
                </button>
                <Link
                    href="/dashboard/ekraf/mission"
                    class="block w-full rounded-xl bg-white px-4 py-3 text-center text-base font-semibold text-black"
                >
                    Batal
                </Link>
            </div>
        </div>
    </div>
</template>
