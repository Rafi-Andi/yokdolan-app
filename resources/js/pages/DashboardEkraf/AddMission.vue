<template>

    <div class="relative min-h-screen">

        <div class="pb-60 md:pb-12">

            <header class="p-4 flex items-center gap-4 bg-white">
                <a href="daftarhadiah.html" class="text-gray-800">
                    <iconify-icon icon="mdi:arrow-left" class="text-2xl"></iconify-icon>
                </a>
                <div class="flex-grow md:ml-8">
                    <h1 class="text-xl font-bold text-gray-900">
                        Tambah Misi Baru
                    </h1>
                    <p class="text-sm text-gray-500">Atur Detail misi promosi anda</p>
                </div>
            </header>

            <main class="px-4">

                <div class="bg-white rounded-xl shadow-sm p-6 mt-4">
                    <form class="space-y-4">

                        <div>
                            <label for="judul_misi" class="block text-sm font-medium mb-1">
                                Judul Misi
                            </label>
                            <input type="text" id="judul_misi" placeholder="Contoh: Membeli Kopi Susu"
                                class="w-full bg-gray-100 rounded-lg border-none focus:outline-none focus:ring-2 focus:ring-gray-300 py-3 px-4" />
                        </div>

                        <div>
                            <label for="deskripsi_misi" class="block text-sm font-medium mb-1">
                                Deskripsi Misi
                            </label>
                            <textarea id="deskripsi_misi" placeholder="Jelaskan detail dan syarat misi di sini" rows="4"
                                class="w-full bg-gray-100 rounded-lg border-none focus:outline-none focus:ring-2 focus:ring-gray-300 py-3 px-4"></textarea>
                        </div>

                        <div>
                            <label for="tipe_misi" class="block text-sm font-medium mb-1">
                                Tipe Misi
                            </label>
                            <div class="relative">
                                <select id="tipe_misi" class="w-full bg-gray-100 rounded-lg border-none focus:outline-none focus:ring-2 focus:ring-gray-300 py-3 px-4
                                           appearance-none">
                                    <option value="" disabled selected>Pilih tipe misi</option>
                                    <option value="transaksi">Transaksi</option>
                                    <option value="interaksi">Interaksi</option>
                                    <option value="foto">Promosi</option>
                                </select>
                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                    <iconify-icon icon="mdi:chevron-down"
                                        class="text-xl text-gray-500 relative top-1"></iconify-icon>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="poin" class="block text-sm font-medium mb-1">
                                Poin
                            </label>
                            <input type="number" id="poin" placeholder="Masukkan jumlah poin"
                                class="w-full bg-gray-100 rounded-lg border-none focus:outline-none focus:ring-2 focus:ring-gray-300 py-3 px-4" />
                        </div>

                    </form>
                </div>

            </main>
        </div>
        <div class="absolute bottom-0 w-full p-4 bg-gray-50 border-t border-gray-200">
            <div class="space-y-2">
                <button
                    class="w-full bg-gray-700 text-white font-medium py-3 px-4 rounded-xl text-base hover:bg-gray-800 transition-all">
                    Simpan & Generate Kode Qr
                </button>
                <button
                    class="w-full bg-gray-200 text-gray-800 font-medium py-3 px-4 rounded-xl text-base hover:bg-gray-300 transition-all">
                    Batal
                </button>
            </div>
        </div>

    </div>
</template>