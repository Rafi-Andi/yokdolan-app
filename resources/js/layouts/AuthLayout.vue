<script setup lang="ts">
import AuthMobileLayout from '@/layouts/auth/AuthMobileLayout.vue';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <AuthMobileLayout :title="title" :description="description">
        <slot />
    </AuthMobileLayout>
</template>
