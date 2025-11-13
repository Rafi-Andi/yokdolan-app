<script setup>
import { Icon } from '@iconify/vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue'; // Tambahkan ref

// Perbarui form state untuk mencakup foto
const form = useForm({
    title: '',
    description: '',
    type: '',
    reward_points: null,
    mission_photo: null, // Field untuk file foto
});

// State untuk menampilkan preview gambar
const photoPreview = ref(null);

const props = defineProps({
    channels: {
        type: Array,
        default: () => [{ id: 1, name: 'Bromo & Sekitarnya' }],
    },
    // Pastikan errors dikirim ke komponen
    errors: Object, 
});

// Fungsi untuk menangani upload file dan membuat preview
const handlePhotoUpload = (event) => {
    const file = event.target.files[0];

    if (file) {
        // Simpan file ke form
        form.mission_photo = file;

        // Buat preview URL
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

// Fungsi untuk menghapus preview/file (opsional)
const clearPhoto = () => {
    photoPreview.value = null;
    form.mission_photo = null;
    // Reset file input agar bisa upload file yang sama lagi
    document.getElementById('gambar_misi_input').value = null;
}


const submit = () => {
    // Gunakan POST untuk form yang mengandung file
    // Inertia akan otomatis menggunakan multipart/form-data
    form.post('/dashboard/ekraf/store-mission', {
        onSuccess: () => {
            form.reset();
            clearPhoto(); // Bersihkan preview setelah sukses
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
                                :class="{'ring-red-500 border-red-500': form.errors.title}"
                            />
                            <span
                                v-if="form.errors.title"
                                class="text-xs text-red-500 mt-1"
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
                                :class="{'ring-red-500 border-red-500': form.errors.description}"
                            ></textarea>
                            <span
                                v-if="form.errors.description"
                                class="text-xs text-red-500 mt-1"
                                >{{ form.errors.description }}</span
                            >
                        </div>
                        
                        <!-- BARU: GAMBAR MISI -->
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
                                    class="absolute inset-0 z-10 h-full w-full opacity-0 cursor-pointer"
                                    accept="image/*"
                                />

                                <div
                                    class="flex h-48 w-full flex-col items-center justify-center rounded-xl bg-gray-200 border-2 border-dashed border-gray-400 overflow-hidden"
                                    :class="{'border-red-500 ring-red-500': form.errors.mission_photo}"
                                >
                                    <div v-if="photoPreview" class="relative h-full w-full">
                                        <!-- Preview Gambar -->
                                        <img
                                            :src="photoPreview"
                                            alt="Mission Preview"
                                            class="h-full w-full object-cover"
                                        />
                                        <!-- Tombol Hapus Preview -->
                                        <button 
                                            type="button" 
                                            @click.stop="clearPhoto"
                                            class="absolute top-2 right-2 bg-black/50 p-1 rounded-full text-white hover:bg-black/70 transition z-20"
                                        >
                                            <Icon icon="mdi:close" class="text-lg"></Icon>
                                        </button>
                                    </div>

                                    <div v-else class="text-center">
                                        <!-- Placeholder jika belum ada gambar -->
                                        <Icon
                                            icon="mdi:image-outline"
                                            class="text-6xl text-gray-400"
                                        ></Icon>
                                        <p class="text-gray-600">Klik untuk Upload Gambar (Max 5MB)</p>
                                    </div>
                                </div>
                            </div>
                            <span v-if="form.errors.mission_photo" class="text-xs text-red-500 mt-1">{{ form.errors.mission_photo }}</span>
                        </div>
                        <!-- AKHIR GAMBAR MISI -->


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
                                    :class="{'ring-red-500 border-red-500': form.errors.type}"
                                >
                                    <option value="" disabled>
                                        Pilih tipe misi
                                    </option>
                                    <option value="Transaksi">Transaksi</option>
                                    <option value="Interaksi">Interaksi</option>
                                    <option value="Promosi">Promosi</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2"
                                >
                                    <Icon
                                        icon="mdi:chevron-down"
                                        class="relative top-1 text-xl text-gray-500"
                                    ></Icon>
                                </div>
                                <span
                                    v-if="form.errors.type"
                                    class="text-xs text-red-500 mt-1"
                                    >{{ form.errors.type }}</span
                                >
                            </div>
                        </div>

                        <div>
                            <label
                                for="poin"
                                class="mb-1 block text-sm font-medium"
                                >Poin</label
                            >
                            <input
                                type="number"
                                id="poin"
                                placeholder="Masukkan jumlah poin"
                                v-model.number="form.reward_points"
                                required
                                class="w-full rounded-lg border-none bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-gray-300 focus:outline-none"
                                :class="{'ring-red-500 border-red-500': form.errors.reward_points}"
                            />
                            <span
                                v-if="form.errors.reward_points"
                                class="text-xs text-red-500 mt-1"
                                >{{ form.errors.reward_points }}</span
                            >
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