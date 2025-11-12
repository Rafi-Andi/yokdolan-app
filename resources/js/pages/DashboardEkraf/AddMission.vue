<script setup>
import { Icon } from '@iconify/vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    description: '',
    type: '',
    reward_points: null,
});

const props = defineProps({
    channels: {
        type: Array,
        default: () => [{ id: 1, name: 'Bromo & Sekitarnya' }],
    },
});

const submit = () => {
    form.post('/dashboard/ekraf/store-mission', {
        onSuccess: () => {
            form.reset();
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
                            />
                            <span
                                v-if="form.errors.title"
                                class="text-xs text-red-500"
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
                            ></textarea>
                            <span
                                v-if="form.errors.description"
                                class="text-xs text-red-500"
                                >{{ form.errors.description }}</span
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
                                    class="text-xs text-red-500"
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
                                v-model="form.reward_points"
                                required
                                class="w-full rounded-lg border-none bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-gray-300 focus:outline-none"
                            />
                            <span
                                v-if="form.errors.reward_points"
                                class="text-xs text-red-500"
                                >{{ form.errors.reward_points }}</span
                            >
                        </div>

                        <input type="hidden" v-model="form.channel_id" />
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
                    class="w-full rounded-xl bg-gray-700 px-4 py-3 text-base font-medium text-white transition-all hover:bg-gray-800"
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