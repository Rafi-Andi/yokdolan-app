<script setup lang="ts">
import { X } from 'lucide-vue-next';

defineProps<{
    show: boolean;
}>();

const emit = defineEmits<{
    close: [];
}>();
</script>

<template>
    <div 
        v-if="show"
        @click="emit('close')"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
    >
        <div 
            @click.stop
            class="bg-[#D8EBFF] rounded-2xl max-w-md w-full max-h-[85vh] flex flex-col"
        >
            <div class="relative p-6 pb-4">
                <button 
                    @click="emit('close')"
                    class="absolute top-4 right-4 text-gray-700 hover:text-gray-900 transition-colors"
                >
                    <X class="w-6 h-6 cursor-pointer" />
                </button>
                
                <h3 class="text-xl font-bold text-gray-900 text-center px-8 mt-4">
                    Syarat dan Ketentuan Layanan YokDolan
                </h3>
            </div>
            
            <div class="overflow-y-auto px-6 pb-6 text-sm text-gray-700 leading-relaxed space-y-4">
                <p class="font-medium text-gray-900">
                    Berikut adalah poin-poin penting dalam Kebijakan Pengguna untuk aplikasi web YokDolan, dibagi berdasarkan peran dan fungsi sistem:
                </p>

                <div class="space-y-4">
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">
                            1. Ketentuan Umum Akun Pengguna (Wisatawan)
                        </h4>
                        
                        <div class="space-y-2">
                            <div>
                                <p class="font-semibold text-gray-800">Penerimaan Syarat:</p>
                                <p>
                                    Dengan mendaftar dan/atau menggunakan Aplikasi Web YokDolan, Anda (Wisatawan/Mitra Ekraf) secara tegas menyetujui untuk terikat pada Syarat dan Ketentuan Layanan ini.                                </p>
                            </div>

                            <div>
                                <p class="font-semibold text-gray-800">Pendaftaran:</p>
                                <p>
                                    Pengguna wajib memberikan data yang akurat dan lengkap saat membuat Profil User. Anda bertanggung jawab penuh atas kerahasiaan dan semua aktivitas yang terjadi di bawah akun Anda.                                </p>
                            </div>

                            <div>
                                <p class="font-semibold text-gray-800">Penggunaan Misi:</p>
                                <p>
                                    Fitur Misi dirancang untuk mendorong interaksi aktif dan otentik dengan budaya dan pelaku Ekonomi Kreatif (Ekraf) di Jawa Timur.                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">
                            2. Aturan Gamifikasi dan Reward
                        </h4>
                        
                        <div class="space-y-2">
                            <div>
                                <p class="font-semibold text-gray-800">Poin Akumulasi dan Poin Value:</p>
                                <p>
                                    Terdapat dua jenis poin di YokDolan, yaitu Poin Akumulasi (untuk peringkat Leaderboard dan status) dan Poin Value (dapat ditukar dengan reward).                                </p>
                            </div>

                            <div>
                                <p class="font-semibold text-gray-800">Penyelesaian Misi:</p>
                                <p>
                                    Poin Value hanya akan diberikan setelah Wisatawan menyelesaikan Misi dan berhasil memindai Kode QR unik yang disediakan oleh Mitra Ekraf di lokasi Misi. Klaim poin harus dilakukan secara instan di lokasi.                                </p>
                            </div>

                            <div>
                                <p class="font-semibold text-gray-800">Pelarangan Kecurangan (Anti-Curang):</p>
                                <p>
                                    Segala bentuk upaya manipulasi (termasuk, namun tidak terbatas pada, scanning QR tanpa menyelesaikan Misi atau membuat Misi fiktif) akan mengakibatkan akun diblokir secara permanen dan seluruh Poin Value ditarik.                                </p>
                            </div>

                            <div>
                                <p class="font-semibold text-gray-800">Penukaran Reward:</p>
                                <p>
                                    Poin Value dapat ditukar dengan reward berupa Produk Spesial atau Voucher Diskon Mandiri yang ditawarkan oleh Mitra Ekraf di Reward Catalog.                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">
                            3. Ketentuan untuk Mitra Ekraf (Tuan Rumah Misi)
                        </h4>
                        
                        <div class="space-y-2">
                            <div>
                                <p class="font-semibold text-gray-800">Pendaftaran dan Kurasi:</p>
                                <p>
                                    Pendaftaran Mitra Ekraf diverifikasi dan disetujui oleh Pemilik Wisata (Channel Owner).                                </p>
                            </div>

                            <div>
                                <p class="font-semibold text-gray-800">Biaya Promosi (Reward):</p>
                                <p>
                                    Mitra Ekraf bertanggung jawab penuh atas biaya yang timbul dari reward yang mereka tawarkan (Produk Spesial atau Voucher Diskon Mandiri) di Katalog, yang berfungsi sebagai biaya promosi mandiri. YokDolan hanya memfasilitasi penukaran.                                </p>
                            </div>

                            <div>
                                <p class="font-semibold text-gray-800">Validasi Voucher:</p>
                                <p>
                                    Mitra Ekraf wajib menghormati dan memvalidasi voucher digital yang ditunjukkan oleh Wisatawan sesuai dengan deskripsi reward yang ditawarkan di Katalog.                                </p>
                            </div>

                            <div>
                                <p class="font-semibold text-gray-800">Penggunaan Kode QR:</p>
                                <p>
                                    Mitra wajib menempelkan Kode QR Misi unik yang dihasilkan oleh sistem di lokasi fisik mereka sebagai alat validasi utama untuk klaim Poin.                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">
                            4. Batasan Tanggung Jawab
                        </h4>
                        
                        <div class="space-y-2">
                            <div>
                                <p class="font-semibold text-gray-800">Jasa Pihak Ketiga:</p>
                                <p>
                                    YokDolan bertindak sebagai platform gamifikasi dan pemasaran digital yang menghubungkan Wisatawan dengan Mitra Ekraf. YokDolan <strong>tidak bertanggung jawab</strong> atas kualitas produk, layanan, atau penolakan transaksi yang dilakukan oleh Mitra Ekraf.                                </p>
                            </div>

                            <div>
                                <p class="font-semibold text-gray-800">Data Analitik:</p>
                                <p>
                                    Data interaksi dan pola penyebaran Poin Value yang dikumpulkan melalui aplikasi akan digunakan untuk keperluan analitik (Smart Tourism) oleh Pemilik Wisata (Pemerintah/Dinas Pariwisata) untuk perencanaan program.                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-blue-900">
                        Dengan menggunakan YokDolan, Anda menyetujui semua ketentuan di atas.
                    </p>
                </div>
            </div>

            <div class="p-6 pt-4 border-t border-gray-300">
                <button
                    @click="emit('close')"
                    class="cursor-pointer w-full h-12 bg-gradient-to-r from-[#1485FF] to-[#79BAFF] hover:from-[#0F6FD1] hover:to-[#5A9CE6] text-white font-semibold rounded-full transition-all"
                >
                    Saya Mengerti
                </button>
            </div>
        </div>
    </div>
</template>
