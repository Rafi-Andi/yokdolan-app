<template>
    <div class="relative min-h-screen">
        <div class="pb-60 md:pb-60">
            <header class="flex items-center gap-4 bg-white p-4">
                <a href="daftarhadiah.html" class="text-gray-800">
                    <iconify-icon
                        icon="mdi:arrow-left"
                        class="text-2xl"
                    ></iconify-icon>
                </a>
                <div class="flex-grow md:ml-8">
                    <h1 class="text-xl font-bold text-gray-900">
                        Tambah Hadiah Baru
                    </h1>
                    <p class="text-sm text-gray-500">
                        Atur Detail hadiah promosi anda
                    </p>
                </div>
            </header>

            <main class="px-4">
                <div class="mt-4 rounded-xl bg-white p-6 shadow-sm">
                    <form class="space-y-4">
                        <div>
                            <label
                                for="nama_hadiah"
                                class="mb-1 block text-sm font-medium"
                            >
                                Nama Hadiah
                            </label>
                            <input
                                type="text"
                                id="nama_hadiah"
                                placeholder="Contoh: Gratis 1 Gelas Kopi Susu"
                                class="w-full rounded-lg border-none bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-gray-300 focus:outline-none"
                            />
                        </div>

                        <div>
                            <label
                                for="deskripsi_hadiah"
                                class="mb-1 block text-sm font-medium"
                            >
                                Deskripsi Hadiah
                            </label>
                            <textarea
                                id="deskripsi_hadiah"
                                placeholder="Dapatkan gratis 1 produk spesial"
                                rows="4"
                                class="w-full rounded-lg border-none bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-gray-300 focus:outline-none"
                            ></textarea>
                        </div>

                        <div>
                            <label
                                for="tipe_hadiah"
                                class="mb-1 block text-sm font-medium"
                            >
                                Tipe Hadiah
                            </label>
                            <div class="relative">
                                <select
                                    id="tipe_hadiah"
                                    class="w-full appearance-none rounded-lg border-none bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-gray-300 focus:outline-none"
                                >
                                    <option value="" disabled selected>
                                        Pilih tipe hadiah
                                    </option>
                                    <option value="transaksi">
                                        Voucher Diskon
                                    </option>
                                    <option value="interaksi">
                                        Gratis Produk
                                    </option>
                                    <option value="foto">
                                        Beli 1 Gratis 1
                                    </option>
                                </select>
                                <div
                                    class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2"
                                >
                                    <iconify-icon
                                        icon="mdi:chevron-down"
                                        class="relative top-1 text-xl text-gray-500"
                                    ></iconify-icon>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label
                                for="biaya_poin"
                                class="mb-1 block text-sm font-medium"
                            >
                                Biaya Poin
                            </label>
                            <input
                                type="number"
                                id="biaya_poin"
                                placeholder="Masukkan jumlah biaya poin"
                                class="w-full rounded-lg border-none bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-gray-300 focus:outline-none"
                            />
                        </div>

                        <div>
                            <label
                                for="gambar_hadiah"
                                class="mb-1 block text-sm font-medium"
                            >
                                Gambar Hadiah
                            </label>
                            <div
                                class="flex h-48 w-full flex-col items-center justify-center rounded-xl bg-gray-200"
                            >
                                <iconify-icon
                                    icon="mdi:image-outline"
                                    class="text-6xl text-gray-400"
                                ></iconify-icon>
                                <p class="text-gray-600">Upload Gambar</p>
                            </div>
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
                    class="w-full rounded-xl bg-gray-700 px-4 py-3 text-base font-medium text-white transition-all hover:bg-gray-800"
                >
                    Simpan Reward
                </button>
                <button
                    class="w-full rounded-xl bg-gray-200 px-4 py-3 text-base font-medium text-gray-800 transition-all hover:bg-gray-300"
                >
                    Batal
                </button>
            </div>
        </div>
    </div>
</template>
