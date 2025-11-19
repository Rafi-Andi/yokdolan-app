<script setup lang="ts">
import { ArrowLeft } from 'lucide-vue-next';
import { router } from '@inertiajs/vue3';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();

const goBack = () => {
    history.back()
};
</script>

<template>
    <div class="min-h-screen bg-[#D8EBFF]">
        <header class="top-0 z-10 flex items-center gap-10 backdrop-blur-sm px-4 py-3 border-b border-blue-100">
            <button
                @click="goBack"
                class="flex cursor-pointer items-center justify-center w-10 h-10"
                aria-label="Kembali"
            >
                <ArrowLeft class="w-7 h-7 text-black" />
            </button>
            <h1 class="text-md font-bold text-black flex-1">
                {{ title }}
            </h1>
        </header>

        <!-- Content -->
        <main class="px-4 py-6 pb-8">
            <div class="max-w-md mx-auto">
                <slot />
            </div>
        </main>
    </div>
</template>

