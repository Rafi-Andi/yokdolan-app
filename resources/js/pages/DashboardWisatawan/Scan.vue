<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { Html5QrcodeScanner } from 'html5-qrcode';
import { computed, nextTick, onMounted, onUnmounted, ref } from 'vue';

const qrCodeMessage = ref(null);
const errorMessage = ref(null);
let html5QrCodeScanner = null;
const QrContainerId = 'reader';
const validationEndpoint = '/misi/validasi';

const boxSizePx = ref(240);
const dynamicBoxSize = computed(() => {
    const vw = window.innerWidth;
    let size = vw * 0.8;
    if (size > 320) size = 320;
    if (size < 200) size = 200;
    boxSizePx.value = Math.round(size);
    return boxSizePx.value;
});

const goBack = () => {
   history.back() || router.visit('/dashboard');
};


const onScanSuccess = (decodedText) => {
    qrCodeMessage.value = 'Data berhasil discan, memproses..';
    if (html5QrCodeScanner) html5QrCodeScanner.clear().catch(() => {});
    router.post(
        validationEndpoint,
        {
            qr_code: decodedText,
        },
        {
            preserveScroll: true,
            onStart: () => {
                console.log('loading')
            },
            onSuccess: (page) => {
                console.log('Validasi berhasil:', page);
            },
            onError: (errors) => {
                console.error('Validasi gagal:', errors);
                qrCodeMessage.value = errors.qr_code || 'Terjadi kesalahan saat memvalidasi QR code.';


                setTimeout(() => {
                    refreshScanner();
                    qrCodeMessage.value = null;
                }, 3000);
            },
        },
    );
};

let lastErrorTime = 0;
const onScanError = (err) => {
    const now = Date.now();
    if (now - lastErrorTime > 800) {
        console.warn('Scan error:', err);
        lastErrorTime = now;
    }
};

onMounted(async () => {
    await nextTick();
    const size = dynamicBoxSize.value;
    html5QrCodeScanner = new Html5QrcodeScanner(
        QrContainerId,
        {
            fps: 10,
            qrbox: { width: size, height: size },
        },
        false,
    );
    html5QrCodeScanner.render(onScanSuccess, onScanError);

    setTimeout(() => {
        document.getElementById(QrContainerId)?.classList.add('custom-reader');
    }, 150);
});

onUnmounted(() => {
    if (html5QrCodeScanner) html5QrCodeScanner.clear().catch(() => {});
});

const refreshScanner = () => {
    if (html5QrCodeScanner) {
        const size = dynamicBoxSize.value;
        html5QrCodeScanner
            .clear()
            .then(() => {
                html5QrCodeScanner.render(onScanSuccess, onScanError);
            })
            .catch(() => {
                html5QrCodeScanner.render(onScanSuccess, onScanError);
            });
    }
};
</script>

<template>
    <Head title="QR Scan | YokDolan" />
    <div class="relative flex min-h-screen w-full flex-col bg-black text-white">
        <header
            class="absolute top-0 left-0 z-50 flex w-full items-center justify-between bg-black/30 px-4 py-3 backdrop-blur-md"
        >
            <a
                @click.prevent="goBack()"
                class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-2xl font-bold transition-all hover:bg-white/20 cursor-pointer"
            >
                &times;
            </a>
            <button
                @click="refreshScanner"
                class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-2xl font-semibold transition-all hover:bg-white/20 cursor-pointer"
            >
                &#x21BB;
            </button>
        </header>

        <div
            class="absolute inset-x-0 top-20 z-40 px-6 text-center sm:px-10 md:px-16"
        >
            <h1
                class="text-lg leading-snug font-semibold sm:text-xl md:text-2xl"
            >
                Scan QR untuk menyelesaikan misi dan dapatkan poinmu!
            </h1>
        </div>

        <div class="flex flex-grow items-center justify-center">
            <div
                id="reader"
                class="aspect-square w-[85vw] max-w-[400px] overflow-hidden rounded-2xl border border-white/10 shadow-2xl"
            ></div>
        </div>

        <footer
            class="absolute bottom-6 left-1/2 -translate-x-1/2 text-center text-sm text-gray-400"
        >
            <p>Pastikan pencahayaan cukup untuk hasil scan terbaik ✨</p>
        </footer>

        <transition name="fade">
            <div
                v-if="qrCodeMessage"
                class="absolute bottom-20 left-1/2 z-50 -translate-x-1/2 rounded-full bg-green-600/90 px-5 py-3 text-sm text-white shadow-lg backdrop-blur-md sm:text-base"
            >
                 {{ qrCodeMessage }}
            </div>
        </transition>
    </div>
</template>

<style scoped>
/* Smooth fade for alert */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.4s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* Camera frame styling */
#reader {
    position: relative;
}
#reader::after {
    content: '';
    position: absolute;
    inset: 0;
    border: 3px solid rgba(255, 255, 255, 0.7);
    border-radius: 1rem;
    pointer-events: none;
    box-shadow: 0 0 25px rgba(0, 255, 100, 0.4);
}
</style>
