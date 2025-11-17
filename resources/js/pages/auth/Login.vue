<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthMobileLayout from '@/layouts/auth/AuthMobileLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { Form, Head } from '@inertiajs/vue3';
import { Mail, Lock } from 'lucide-vue-next';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <AuthMobileLayout title="Masuk akun Wisatawan">
        <Head title="Masuk akun Wisatawan" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-lg p-3"
        >
            {{ status }}
        </div>

        <div class="mb-8 flex justify-center">
            <div class="relative">
                <img
                    src="/images/loginwisatawan.png"
                    alt="Tourist Illustration"
                    class="w-60 h-65 object-cover"
                />
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">
                Selamat Datang Kembali
            </h2>
            <p class=" font-bold text-gray-700 mb-6 text-sm">
                Masuk akun pribadi anda sekarang
            </p>

            <Form
                v-bind="store.form()"
                :reset-on-success="['password']"
                v-slot="{ errors, processing }"
                class="flex flex-col gap-5"
            >
                <div class="flex flex-col gap-2">
                    <Label for="email" class="text-sm font-medium text-black">
                        Alamat Email
                    </Label>
                    <div class="relative">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <Mail class="w-5 h-5" />
                        </div>
                        <Input
                            id="email"
                            type="email"
                            name="email"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="email"
                            placeholder="Masukkan email kamu"
                            class="pl-10 h-12 text-black bg-white border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        />
                    </div>
                    <InputError :message="errors.email" />
                </div>

                <!-- Password Input -->
                <div class="flex flex-col gap-2">
                    <Label
                        for="password"
                        class="text-sm font-medium text-black"
                    >
                        Password
                    </Label>
                    <div class="relative">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <Lock class="w-5 h-5" />
                        </div>
                        <Input
                            id="password"
                            type="password"
                            name="password"
                            required
                            :tabindex="2"
                            autocomplete="current-password"
                            placeholder="Masukkan Password"
                            class="text-black pl-10 h-12 bg-white border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        />
                    </div>
                    <InputError :message="errors.password" />
                </div>

                <Button
                    type="submit"
                    class="cursor-pointer mt-2 w-full h-12 text-white font-semibold rounded-full bg-gradient-to-r from-[#1485FF] to-[#79BAFF] hover:from-[#0F6FD1] hover:to-[#5A9CE6] disabled:opacity-50 flex items-center justify-center"
                    :tabindex="3"
                    :disabled="processing"
                    data-test="login-button"
                >
                    <Spinner v-if="processing" class="mr-2" />
                    <span v-if="!processing">Masuk</span>
                    <span v-else>Memproses...</span>
                </Button>
            </Form>
        </div>

        <div
            class="text-center text-xs text-gray-600"
            v-if="canRegister"
        >
            <span>Belum memiliki akun? </span>
            <TextLink
                :href="register()"
                class="font-semibold hover:text-blue-700 underline"
                :tabindex="4"
            >
                Daftar
            </TextLink>
        </div>
    </AuthMobileLayout>
</template>
