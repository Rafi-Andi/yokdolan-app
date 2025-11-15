<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthMobileLayout from '@/layouts/auth/AuthMobileLayout.vue';
import { login } from '@/routes';
import { store } from '@/routes/register';
import { Form, Head } from '@inertiajs/vue3';
import { User, Mail, Lock } from 'lucide-vue-next';
import { ref } from 'vue';

const agreeToTerms = ref(false);
</script>

<template>
    <AuthMobileLayout title="Daftar akun Wisatawan">
        <Head title="Daftar akun Wisatawan" />

        <div class="mb-6 flex justify-center">
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
                Bergabung Petualangan
            </h2>
            <p class="text-sm text-gray-700">
                Buat akun pribadi anda sekarang
            </p>
        </div>

        <div class="mb-6">
            <Form
                v-bind="store.form()"
                :reset-on-success="['password', 'password_confirmation']"
                v-slot="{ errors, processing }"
                class="flex flex-col gap-5"
            >
                <div class="flex flex-col gap-2">
                    <Label for="name" class="text-sm font-medium text-black">
                        Nama Lengkap
                    </Label>
                    <div class="relative">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <User class="w-5 h-5" />
                        </div>
                        <Input
                            id="name"
                            type="text"
                            name="name"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="name"
                            placeholder="Masukkan nama kamu"
                            class="pl-10 h-12 bg-white border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        />
                    </div>
                    <InputError :message="errors.name" />
                </div>

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
                            :tabindex="2"
                            autocomplete="email"
                            placeholder="Masukkan email kamu"
                            class="pl-10 h-12 bg-white border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        />
                    </div>
                    <InputError :message="errors.email" />
                </div>

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
                            :tabindex="3"
                            autocomplete="new-password"
                            placeholder="Masukkan Password"
                            class="pl-10 h-12 bg-white border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        />
                    </div>
                    <InputError :message="errors.password" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label
                        for="password_confirmation"
                        class="text-sm font-medium text-black"
                    >
                        Konfirmasi Password
                    </Label>
                    <div class="relative">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <Lock class="w-5 h-5" />
                        </div>
                        <Input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            :tabindex="4"
                            autocomplete="new-password"
                            placeholder="Konfirmasi Password"
                            class="pl-10 h-12 bg-white border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        />
                    </div>
                    <InputError :message="errors.password_confirmation" />
                </div>

                <div class="flex items-start gap-3">
                    <input
                        type="checkbox"
                        id="terms"
                        v-model="agreeToTerms"
                        class="mt-0.5 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    />
                    <Label
                        for="terms"
                        class="text-xs text-gray-600 cursor-pointer leading-relaxed"
                    >
                        Syarat dan Ketentuan Layanan
                    </Label>
                </div>

                <Button
                    type="submit"
                    class="cursor-pointer mt-2 w-full h-12 text-white font-semibold rounded-full bg-gradient-to-r from-[#1485FF] to-[#79BAFF] hover:from-[#0F6FD1] hover:to-[#5A9CE6] disabled:opacity-50 flex items-center justify-center"
                    :tabindex="5"
                    :disabled="processing || !agreeToTerms"
                    data-test="register-user-button"
                >
                    <Spinner v-if="processing" class="mr-2" />
                    <span v-if="!processing">Daftar</span>
                    <span v-else>Memproses...</span>
                </Button>
            </Form>
        </div>

        <div class="text-center text-xs text-gray-600">
            <span>Sudah mempunyai akun? </span>
            <TextLink
                :href="login()"
                class="font-semibold text-black hover:text-blue-700 underline"
                :tabindex="6"
            >
                Masuk
            </TextLink>
        </div>
    </AuthMobileLayout>
</template>