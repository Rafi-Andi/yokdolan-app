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

    <div class="relative min-h-screen">
        <div class="pb-60 md:pb-12">
            <header class="flex items-center gap-4 bg-white p-4">
                <Link href="/dashboard/ekraf/mission" class="text-gray-800">
                    <Icon icon="mdi:arrow-left" class="text-2xl"></Icon>
                </Link>
                <div class="flex-grow md:ml-8">
                    <h1 class="text-xl font-bold text-gray-900">
                        Tambah Misi Baru
                    </h1>
                    <p class="text-sm text-gray-500">
                        Atur Detail misi promosi anda
                    </p>
                </div>
            </header>

            <main class="px-4">
                <div class="mt-4 rounded-xl bg-white p-6 shadow-sm">
                    <form @submit.prevent="submit" class="space-y-4">
                        <div>
                            <label
                                for="judul_misi"
                                class="mb-1 block text-sm font-medium"
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
                                class="mb-1 block text-sm font-medium"
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
                                for="gambar_misi_input"
                                class="mb-1 block text-sm font-medium"
                            >
                                Gambar Misi (Opsional)
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
                                    class="flex h-48 w-full flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-dashed border-gray-400 bg-gray-200"
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
                                            icon="mdi:image-outline"
                                            class="text-6xl text-gray-400"
                                        ></Icon>
                                        <p class="text-gray-600">
                                            Klik untuk Upload Gambar (Max 5MB)
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

                        <div>
                            <label
                                for="tipe_misi"
                                class="mb-1 block text-sm font-medium"
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
                                class="flex items-center gap-2 rounded-lg border border-blue-300 bg-blue-100 p-3 text-lg font-extrabold text-gray-800"
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
                    </form>
                </div>
            </main>
        </div>

        <div
            class="absolute bottom-0 w-full border-t border-gray-200 bg-gray-50 p-4"
        >
            <div class="space-y-2">
                <button
                    @click="submit"
                    :disabled="form.processing"
                    class="w-full rounded-xl bg-gray-700 px-4 py-3 text-base font-medium text-white transition-all hover:bg-gray-800 disabled:bg-gray-400"
                >
                    {{
                        form.processing
                            ? 'Memproses...'
                            : 'Simpan & Generate Kode Qr'
                    }}
                </button>
                <Link
                    href="/dashboard/ekraf/mission"
                    class="block w-full rounded-xl bg-gray-200 px-4 py-3 text-center text-base font-medium text-gray-800 transition-all hover:bg-gray-300"
                >
                    Batal
                </Link>
            </div>
        </div>
    </div>
</template>
