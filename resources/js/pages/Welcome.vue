<script setup lang="ts">
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Icon } from '@iconify/vue';

// --- PROPS ---
withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);

// --- DATA NAVIGASI ---
const navLinks = [
    { label: 'Tentang', href: '#about' },
    { label: 'Fitur', href: '#features' },
    { label: 'Galeri', href: '#gallery' },
];

// --- DATA STATISTIK HERO ---
const impactMetrics = [
    { label: 'Destinasi Terverifikasi', value: '150+' },
    { label: 'Transaksi UMKM', value: '12K+' },
    { label: 'Wisatawan Aktif', value: '48K+' },
];

// --- DATA FITUR (Slide 2) ---
const featurePillars = computed(() => [
    {
        title: 'Gamifikasi Misi Lokal',
        body: 'Misi lintas kabupaten dengan reward poin, badge eksplorasi, dan leaderboard real-time.',
        accentIcon: 'from-blue-500 to-cyan-400',
        icon: 'lucide:gamepad-2',
    },
    {
        title: 'Integrasi Ekraf',
        body: 'UMKM dapat mengelola stok, membuat reward bundling, hingga memvalidasi transaksi secara langsung.',
        accentIcon: 'from-blue-600 to-indigo-500',
        icon: 'lucide:shopping-bag',
    },
    {
        title: 'Insight Wisatawan',
        body: 'Dashboard multi-peran untuk pemerintah, channel wisata, hingga ekraf partner.',
        accentIcon: 'from-cyan-500 to-blue-400',
        icon: 'lucide:bar-chart-4',
    },
]);

// --- DATA ALUR MISI (Slide 3) ---
const missionFlow = [
    {
        step: '01',
        title: 'Rancang Narasi Daerah',
        detail: 'Kurasi cerita unik, signature kuliner, dan micro-event yang ingin diangkat di YokDolan.',
        icon: 'lucide:pen-tool',
    },
    {
        step: '02',
        title: 'Bangun Misi Interaktif',
        detail: 'Hubungkan spot wisata, tantangan QR, dan reward ekraf agar wisatawan bergerak aktif.',
        icon: 'lucide:qr-code',
    },
    {
        step: '03',
        title: 'Skalakan Ekosistem',
        detail: 'Monitor dampak ekonomi kreatif dari dashboard analytics dan optimalkan kampanye.',
        icon: 'lucide:trending-up',
    },
];

// --- DATA GALERI TIM ---
// Data ini dipanggil manual di template menggunakan index [0], [1], [2]
const galleryItems = [
    {
        title: 'Euforia Kemenangan',
        description: 'Senyum bangga tim Pemuda Sintaks saat dinobatkan sebagai Juara 2 JYCC. Bukti kerja keras kami untuk pariwisata Jatim.',
        image: '/foto/foto1.jpg',
    },
    {
        title: 'Di Balik Layar',
        description: 'Diskusi teknis dan pematangan strategi sebelum presentasi.',
        image: '/foto/foto2.jpg',
    },
    {
        title: 'Awarding Night',
        description: 'berfoto bersama trofi kemenangan setelah sesi final yang menegangkan.',
        image: '/foto/foto3.jpg',
    },
];

// --- DATA FOOTER ---
const socialLinks = [
    { icon: 'lucide:instagram', href: '#', label: 'Instagram' },
    { icon: 'lucide:twitter', href: '#', label: 'Twitter' },
    { icon: 'lucide:linkedin', href: '#', label: 'LinkedIn' },
    { icon: 'lucide:youtube', href: '#', label: 'Youtube' },
];

const footerColumns = [
    {
        title: 'Platform',
        links: [
            { label: 'Jelajah Destinasi', href: '#' },
            { label: 'Event Kalender', href: '#' },
            { label: 'Leaderboard', href: '#' },
            { label: 'Mitra Ekraf', href: '#' },
        ],
    },
    {
        title: 'Dukungan',
        links: [
            { label: 'Pusat Bantuan', href: '#' },
            { label: 'Hubungi Kami', href: '#' },
            { label: 'Syarat & Ketentuan', href: '#' },
            { label: 'Kebijakan Privasi', href: '#' },
        ],
    },
    {
        title: 'Pemuda Sintaks',
        links: [
            { label: 'Moch Rafi Andi P', href: '#' },
            { label: 'Randi Permana Shidiq', href: '#' },
            { label: 'Habl Sankrumi Pradhab', href: '#' },
            { label: 'Lutfi Dwi Putra', href: '#' },
            { label: 'Reno Alif', href: '#' },
        ],
    },
];
</script>

<template>
    <Head title="YokDolan - Smart Tourism Platform">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap"
            rel="stylesheet"
        />
    </Head>

    <div class="relative min-h-screen bg-white text-slate-900 overflow-hidden selection:bg-blue-100 selection:text-blue-900">
        
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
             <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
             <div class="absolute top-0 right-1/4 w-96 h-96 bg-cyan-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
             <div class="absolute -bottom-8 left-20 w-96 h-96 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>
        </div>

        <div class="relative z-10 mx-auto flex w-full max-w-7xl flex-col gap-16 px-6 py-6 lg:px-8">
            
            <header class="sticky top-4 z-50 flex items-center justify-between rounded-2xl border border-blue-100/50 bg-white/80 px-6 py-3 shadow-sm shadow-blue-100/50 backdrop-blur-md">
                <div class="flex items-center gap-2">
                    <div class="h-9 w-9 rounded-lg bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center text-white shadow-md shadow-blue-200">
                        <Icon icon="lucide:compass" class="h-5 w-5" />
                    </div>
                    <div>
                        <p class="text-xl font-bold text-slate-900 tracking-tight">YokDolan</p>
                    </div>
                </div>

                <nav class="hidden items-center gap-8 text-sm font-medium text-slate-600 md:flex">
                    <a
                        v-for="link in navLinks"
                        :key="link.href"
                        :href="link.href"
                        class="transition hover:text-blue-600"
                    >
                        {{ link.label }}
                    </a>
                </nav>

                <div class="flex items-center gap-3 text-sm font-medium">
                    <Link
                        v-if="!$page.props.auth.user"
                        :href="login()"
                        class="hidden rounded-full px-4 py-2 text-slate-600 transition hover:bg-blue-50 hover:text-blue-700 sm:block"
                    >
                        Masuk
                    </Link>
                    <Link
                        v-if="!$page.props.auth.user && canRegister"
                        :href="register()"
                        class="inline-flex items-center gap-2 rounded-full bg-blue-600 px-5 py-2 text-white shadow-md shadow-blue-200 transition hover:bg-blue-700 hover:-translate-y-0.5"
                    >
                        Daftar
                        <Icon icon="lucide:arrow-right" class="h-4 w-4" />
                    </Link>
                    <Link
                        v-else
                        :href="dashboard()"
                        class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-5 py-2 text-blue-700 transition hover:bg-blue-200"
                    >
                        <Icon icon="lucide:layout-dashboard" class="h-4 w-4" />
                        Dashboard
                    </Link>
                </div>
            </header>

            <main class="flex flex-col gap-24 md:gap-32">
                
                <section class="grid items-center gap-12 lg:grid-cols-[1.1fr_0.9fr] pt-8 lg:pt-12">
                    <div class="space-y-8">
                        <div class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-blue-700 shadow-sm">
                            <span class="relative flex h-2 w-2">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                            </span>
                            Smart Tourism Platform Jatim
                        </div>
                        <div class="space-y-6">
                            <h1 class="text-5xl font-bold leading-tight tracking-tight text-slate-900 md:text-6xl lg:text-[4rem]">
                                Jelajah Jawa Timur dengan cara <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">lebih seru</span> dan bermakna.
                            </h1>
                            <p class="text-xl text-slate-600 max-w-xl leading-relaxed">
                                Platform gamifikasi yang menghubungkan wisatawan dan pelaku Ekraf. Selesaikan misi, dapatkan reward, dan dukung ekonomi lokal.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <Link
                                v-if="canRegister && !$page.props.auth.user"
                                :href="register()"
                                class="inline-flex items-center gap-2 rounded-full bg-blue-600 px-8 py-4 text-base font-semibold text-white shadow-lg shadow-blue-200/50 transition hover:-translate-y-1 hover:bg-blue-700"
                            >
                                <Icon icon="lucide:rocket" class="h-5 w-5" />
                                Mulai Petualangan
                            </Link>
                             <Link
                                v-else
                                :href="dashboard()"
                                 class="inline-flex items-center gap-2 rounded-full bg-blue-600 px-8 py-4 text-base font-semibold text-white shadow-lg shadow-blue-200/50 transition hover:-translate-y-1 hover:bg-blue-700"
                            >
                                <Icon icon="lucide:layout-dashboard" class="h-5 w-5" />
                                Ke Dashboard
                            </Link>
                            <a
                                href="#features"
                                class="inline-flex items-center gap-2 rounded-full border-2 border-blue-100 bg-white px-8 py-4 text-base font-semibold text-slate-700 transition hover:border-blue-300 hover:bg-blue-50"
                            >
                                Pelajari Fitur
                            </a>
                        </div>

                        <div class="flex flex-wrap items-center gap-8 pt-4 border-t border-slate-100">
                            <div v-for="metric in impactMetrics" :key="metric.label" class="space-y-1">
                                <p class="text-3xl font-extrabold text-slate-900">{{ metric.value }}</p>
                                <p class="text-sm font-medium text-slate-500">{{ metric.label }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative lg:ml-12">
                        <div class="absolute -inset-4 bg-gradient-to-tr from-blue-200 to-cyan-200 opacity-40 blur-2xl rounded-[40px] -z-10 animate-pulse-slow"></div>

                        <div class="relative rounded-[32px] border border-white/60 bg-white/70 p-8 shadow-2xl shadow-blue-100/50 backdrop-blur-xl">
                            <div class="space-y-6">
                                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                    <div class="flex items-center gap-2">
                                        <span class="flex h-3 w-3 relative">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                        </span>
                                        <span class="text-sm font-bold text-slate-700">Live Mission Feed</span>
                                    </div>
                                    <span class="rounded-full bg-blue-50 px-3 py-1 text-[10px] uppercase tracking-wider font-bold text-blue-600">Realtime</span>
                                </div>

                                <div class="space-y-4">
                                    <div class="group rounded-2xl border border-blue-50 bg-gradient-to-br from-white to-blue-50/30 p-5 transition hover:border-blue-200 hover:shadow-md">
                                        <div class="flex justify-between items-start mb-2">
                                            <p class="text-xs font-bold uppercase tracking-wider text-blue-600">Kota Batu</p>
                                            <Icon icon="lucide:moon" class="text-blue-400 h-5 w-5" />
                                        </div>
                                        <p class="text-lg font-bold text-slate-900 group-hover:text-blue-700 transition">Night Mission · QR Run</p>
                                        <p class="mt-2 text-sm leading-relaxed text-slate-600">Kumpulkan 3 stempel digital dari channel kuliner malam untuk membuka reward voucher.</p>
                                    </div>
                                    <div class="group rounded-2xl border border-blue-50 bg-gradient-to-br from-white to-orange-50/30 p-5 transition hover:border-orange-200 hover:shadow-md">
                                         <div class="flex justify-between items-start mb-2">
                                            <p class="text-xs font-bold uppercase tracking-wider text-orange-500">Surabaya Heritage</p>
                                             <Icon icon="lucide:landmark" class="text-orange-400 h-5 w-5" />
                                        </div>
                                        <p class="text-lg font-bold text-slate-900 group-hover:text-orange-700 transition">Creative Passport</p>
                                        <p class="mt-2 text-sm leading-relaxed text-slate-600">Kolaborasi museum, studio batik, dan coffee shop dalam satu itinerary interaktif.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 grid grid-cols-2 gap-4 rounded-2xl bg-slate-50 p-4 text-center border border-slate-100">
                                <div>
                                    <p class="text-3xl font-bold text-blue-600">87%</p>
                                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Completion Rate</p>
                                </div>
                                <div class="border-l border-slate-200">
                                    <p class="text-3xl font-bold text-cyan-600">3.2x</p>
                                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">Avg. Ekraf Sales</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="features" class="scroll-mt-24">
                    <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                        <h2 class="text-sm font-bold uppercase tracking-[0.2em] text-blue-600">Pilar Utama</h2>
                        <p class="text-4xl font-bold text-slate-900 tracking-tight">Ekosistem Digital yang Terintegrasi</p>
                        <p class="text-lg text-slate-600">Tiga pilar utama yang menjadikan YokDolan platform smart tourism yang komprehensif.</p>
                    </div>

                    <div class="grid gap-8 md:grid-cols-3">
                        <div
                            v-for="(feature, index) in featurePillars"
                            :key="index"
                            class="group relative rounded-3xl border border-slate-100 bg-white p-8 shadow-sm transition-all hover:-translate-y-1 hover:shadow-xl hover:border-blue-100"
                        >
                            <div
                                class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br text-3xl shadow-sm group-hover:scale-110 transition-transform"
                                :class="feature.accentIcon"
                            >
                                <Icon :icon="feature.icon" class="text-white h-7 w-7" />
                            </div>
                            <h3 class="mb-3 text-xl font-bold text-slate-900">{{ feature.title }}</h3>
                            <p class="text-slate-600 leading-relaxed">
                                {{ feature.body }}
                            </p>
                        </div>
                    </div>
                </section>

                 <section id="how-it-works" class="scroll-mt-24 rounded-[40px] bg-blue-50/80 px-8 py-20 md:px-16 relative overflow-hidden border border-blue-100">
                    <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-200/40 rounded-full filter blur-3xl"></div>
                    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-cyan-200/40 rounded-full filter blur-3xl"></div>

                    <div class="relative z-10 text-center max-w-3xl mx-auto mb-16 space-y-4">
                        <h2 class="text-sm font-bold uppercase tracking-[0.2em] text-blue-600">Alur Platform</h2>
                        <p class="text-4xl font-bold text-slate-900 tracking-tight">Bagaimana YokDolan Bekerja?</p>
                        <p class="text-lg text-slate-600">Siklus kolaborasi antara pemerintah daerah, pengelola wisata, dan wisatawan.</p>
                    </div>

                    <div class="relative z-10 grid gap-8 md:grid-cols-3">
                        <div class="absolute top-16 left-0 hidden h-0.5 w-full bg-gradient-to-r from-blue-200 via-cyan-200 to-blue-200 lg:block" aria-hidden="true"></div>

                        <div v-for="(step, index) in missionFlow" :key="step.step" class="relative text-center lg:pt-8 group">
                            <div class="relative mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-white border-4 border-blue-100 text-blue-600 shadow-md z-10 group-hover:border-blue-200 transition">
                                <Icon :icon="step.icon" class="h-8 w-8" />
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3">{{ step.title }}</h3>
                            <p class="text-slate-600 leading-relaxed px-4">{{ step.detail }}</p>
                        </div>
                    </div>
                 </section>

                <section id="about" class="grid gap-12 lg:grid-cols-2 items-center scroll-mt-24 py-12">
                    <div class="space-y-6 order-2 lg:order-1">
                         <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-slate-600">
                            Manifesto Kami
                        </div>
                        <h2 class="text-4xl font-bold text-slate-900 tracking-tight">Creative Economy × Smart Tourism</h2>
                        <p class="text-lg text-slate-600 leading-relaxed">
                            YokDolan menjembatani kesenjangan antara potensi destinasi Jawa Timur dan akses promosi ekonomi kreatif lokal.
                        </p>
                        <p class="text-lg text-slate-600 leading-relaxed">
                            Kami mengubah wisatawan dari sekadar pengunjung pasif menjadi partisipan aktif yang menyelesaikan misi, melakukan transaksi nyata di UMKM, dan membagikan cerita perjalanan mereka.
                        </p>
                        <div class="pt-4">
                            <a href="#" class="text-blue-600 font-bold hover:underline inline-flex items-center gap-1 group">
                                Baca cerita lengkap kami
                                <Icon icon="lucide:arrow-right" class="h-4 w-4 group-hover:translate-x-1 transition" />
                            </a>
                        </div>
                    </div>

                    <div class="order-1 lg:order-2 rounded-[32px] border border-slate-100 bg-white p-8 shadow-xl shadow-blue-100/40">
                        <p class="mb-6 text-sm font-bold uppercase tracking-wider text-blue-600">Multi-Role Journey</p>
                        <ul class="space-y-4">
                            <li class="flex gap-4 rounded-2xl border border-blue-50 bg-blue-50/50 p-5 transition hover:bg-blue-100/50">
                                <div class="mt-1 flex h-10 w-10 flex-none items-center justify-center rounded-lg bg-blue-600 text-white shadow-sm">
                                   <Icon icon="lucide:map" class="h-6 w-6" />
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-slate-900">Wisatawan</p>
                                    <p class="text-slate-600">Mobile missions, AR check-in, wallet poin, dan redeem reward.</p>
                                </div>
                            </li>
                            <li class="flex gap-4 rounded-2xl border border-slate-100 bg-white p-5 transition hover:border-blue-100 hover:shadow-sm">
                                 <div class="mt-1 flex h-10 w-10 flex-none items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 shadow-sm">
                                   <Icon icon="lucide:camera" class="h-5 w-5" />
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-slate-900">Channel Wisata</p>
                                    <p class="text-slate-600">Kurasi narasi daerah, susun itinerary kolaboratif, dan lacak performa.</p>
                                </div>
                            </li>
                            <li class="flex gap-4 rounded-2xl border border-slate-100 bg-white p-5 transition hover:border-blue-100 hover:shadow-sm">
                                 <div class="mt-1 flex h-10 w-10 flex-none items-center justify-center rounded-lg bg-white border border-slate-200 text-slate-600 shadow-sm">
                                   <Icon icon="lucide:store" class="h-5 w-5" />
                                </div>
                                <div>
                                    <p class="text-lg font-bold text-slate-900">Ekraf Partner</p>
                                    <p class="text-slate-600">Mengelola stok, membuat reward bundling, dan validasi transaksi.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>

                <section id="gallery" class="scroll-mt-24">
                    <div class="relative rounded-[40px] bg-gradient-to-b from-slate-50 to-white px-6 py-16 md:px-12 overflow-hidden border border-slate-100">
                        
                        <div class="relative z-10 mb-12 flex flex-col items-center text-center">
                            <div class="mb-8 inline-flex flex-col items-center rounded-3xl bg-gradient-to-br from-blue-600 to-cyan-600 p-1 shadow-lg shadow-blue-200/50">
                                <div class="flex flex-col items-center rounded-[22px] bg-white/10 px-8 py-6 backdrop-blur-sm text-white">
                                     <div class="mb-3 rounded-full bg-yellow-400/20 p-3 backdrop-blur-md ring-4 ring-yellow-400/30">
                                        <Icon icon="lucide:medal" class="h-10 w-10 text-yellow-300 drop-shadow" />
                                    </div>
                                    <h2 class="text-4xl font-extrabold tracking-tight text-white mb-1 drop-shadow-sm">
                                        2nd WINNER
                                    </h2>
                                    <p class="text-sm font-bold uppercase tracking-widest text-blue-100">
                                        JYCC Diskominfo Jatim
                                    </p>
                                </div>
                            </div>

                            <h3 class="text-2xl md:text-3xl font-bold text-slate-900 tracking-tight mb-4">
                                Perjalanan <span class="text-blue-600">Pemuda Sintaks</span>
                            </h3>
                            <p class="text-lg text-slate-600 max-w-2xl">
                                Momen-momen berharga di balik layar inovasi YokDolan, dari kolaborasi ide hingga panggung kemenangan.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 auto-rows-[250px]">
                            
                            <div 
                                class="group relative overflow-hidden rounded-3xl cursor-pointer shadow-sm hover:shadow-md transition-shadow md:col-span-2 md:row-span-2"
                            >
                                <img 
                                    :src="galleryItems[0].image" 
                                    :alt="galleryItems[0].title" 
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/10 to-transparent opacity-60 md:opacity-0 md:group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="absolute bottom-0 left-0 w-full p-6 translate-y-0 md:translate-y-4 md:group-hover:translate-y-0 transition-transform duration-300">
                                    <h3 class="text-lg font-bold text-white mb-1 drop-shadow-sm">{{ galleryItems[0].title }}</h3>
                                    <p class="text-sm text-slate-100 line-clamp-2 drop-shadow-sm">{{ galleryItems[0].description }}</p>
                                </div>
                            </div>

                            <div 
                                class="group relative overflow-hidden rounded-3xl cursor-pointer shadow-sm hover:shadow-md transition-shadow md:col-span-1 md:row-span-1"
                            >
                                <img 
                                    :src="galleryItems[1].image" 
                                    :alt="galleryItems[1].title" 
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/10 to-transparent opacity-60 md:opacity-0 md:group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="absolute bottom-0 left-0 w-full p-6 translate-y-0 md:translate-y-4 md:group-hover:translate-y-0 transition-transform duration-300">
                                    <h3 class="text-lg font-bold text-white mb-1 drop-shadow-sm">{{ galleryItems[1].title }}</h3>
                                    <p class="text-sm text-slate-100 line-clamp-2 drop-shadow-sm">{{ galleryItems[1].description }}</p>
                                </div>
                            </div>

                            <div 
                                class="group relative overflow-hidden rounded-3xl cursor-pointer shadow-sm hover:shadow-md transition-shadow md:col-span-1 md:row-span-1"
                            >
                                <img 
                                    :src="galleryItems[2].image" 
                                    :alt="galleryItems[2].title" 
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/10 to-transparent opacity-60 md:opacity-0 md:group-hover:opacity-100 transition-opacity duration-300"></div>
                                <div class="absolute bottom-0 left-0 w-full p-6 translate-y-0 md:translate-y-4 md:group-hover:translate-y-0 transition-transform duration-300">
                                    <h3 class="text-lg font-bold text-white mb-1 drop-shadow-sm">{{ galleryItems[2].title }}</h3>
                                    <p class="text-sm text-slate-100 line-clamp-2 drop-shadow-sm">{{ galleryItems[2].description }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </main>

            <footer class="mt-20 border-t border-blue-100 pt-16 pb-8">
                <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-4 lg:gap-8">
                    
                    <div class="space-y-6">
                        <div class="flex items-center gap-2">
                            <div class="h-8 w-8 rounded-lg bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center text-white shadow-sm">
                                <Icon icon="lucide:compass" class="h-5 w-5" />
                            </div>
                            <span class="text-xl font-bold text-slate-900 tracking-tight">YokDolan</span>
                        </div>
                        <p class="text-sm leading-relaxed text-slate-500 max-w-xs">
                            Platform smart tourism yang menghubungkan keindahan Jawa Timur dengan potensi ekonomi kreatif lokal melalui gamifikasi.
                        </p>
                        <div class="flex gap-4">
                            <a 
                                v-for="social in socialLinks" 
                                :key="social.label" 
                                :href="social.href"
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-slate-500 transition hover:bg-blue-600 hover:text-white"
                                :aria-label="social.label"
                            >
                                <Icon :icon="social.icon" class="h-5 w-5" />
                            </a>
                        </div>
                    </div>

                    <div v-for="col in footerColumns" :key="col.title">
                        <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-slate-900">{{ col.title }}</h3>
                        <ul class="space-y-3">
                            <li v-for="link in col.links" :key="link.label">
                                <a 
                                    :href="link.href" 
                                    class="text-sm text-slate-500 transition hover:text-blue-600 hover:underline"
                                >
                                    {{ link.label }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-16 border-t border-slate-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-slate-400 text-center md:text-left">
                        &copy; {{ new Date().getFullYear() }} YokDolan Indonesia. All rights reserved.
                    </p>
                    <div class="flex items-center gap-2 text-sm text-slate-400">
                        <span class="flex items-center gap-1">
                            Dibuat dengan <Icon icon="lucide:heart" class="text-red-400 h-3 w-3 fill-red-400" /> oleh Tim Pemuda Sintaks
                        </span>
                    </div>
                </div>
            </footer>

        </div>
    </div>
</template>

<style>
/* Animation for Background Blobs */
@keyframes blob {
  0% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
  100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
  animation: blob 7s infinite;
}
.animation-delay-2000 {
  animation-delay: 2s;
}
.animation-delay-4000 {
  animation-delay: 4s;
}

/* Smooth Scroll */
html {
    scroll-behavior: smooth;
}
</style>