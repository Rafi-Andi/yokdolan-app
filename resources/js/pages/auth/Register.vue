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
import { User, Mail, Lock, Check } from 'lucide-vue-next';
import { ref } from 'vue';

const agreeToTerms = ref(false);
const selectedAvatar = ref('');
const showAvatarModal = ref(false);

const avatars = [
    { id: 1, url: '/images/avatar/femaleavatar(1).png', label: 'Female Avatar 1' },
    { id: 2, url: '/images/avatar/femaleavatar(2).png', label: 'Female Avatar 2' },
    { id: 3, url: '/images/avatar/femaleavatar(3).png', label: 'Female Avatar 3' },
    { id: 4, url: '/images/avatar/femaleavatar(4).png', label: 'Female Avatar 4' },
    { id: 5, url: '/images/avatar/maleavatar(1).png', label: 'Male Avatar 1' },
    { id: 6, url: '/images/avatar/maleavatar(2).png', label: 'Male Avatar 2' },
    { id: 7, url: '/images/avatar/maleavatar(3).png', label: 'Male Avatar 3' },
    { id: 8, url: '/images/avatar/maleavatar(4).png', label: 'Male Avatar 4' },
];

const selectAvatar = (avatarUrl: string) => {
    selectedAvatar.value = avatarUrl;
    showAvatarModal.value = false;
};
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
                <!-- Avatar Selection -->
                <div class="flex flex-col gap-2">
                    <Label class="text-sm font-medium text-black">
                        Pilih Avatar
                    </Label>
                    <div class="flex items-center gap-3">
                        <div 
                            @click="showAvatarModal = true"
                            class="relative w-20 h-20 rounded-full border-2 border-gray-300 overflow-hidden cursor-pointer hover:border-blue-500 transition-colors flex items-center justify-center bg-gray-50"
                        >
                            <img 
                                v-if="selectedAvatar" 
                                :src="selectedAvatar" 
                                alt="Selected Avatar"
                                class="w-full h-full object-cover"
                            />
                            <User v-else class="w-10 h-10 text-gray-400" />
                        </div>
                        <Button
                            type="button"
                            @click="showAvatarModal = true"
                            class="px-4 py-2 text-sm bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg"
                        >
                            {{ selectedAvatar ? 'Ganti Avatar' : 'Pilih Avatar' }}
                        </Button>
                    </div>
                    <input type="hidden" name="profile_url" :value="selectedAvatar" />
                    <InputError :message="errors.profile_url" />
                    <p v-if="!selectedAvatar" class="text-xs text-red-500">
                        * Avatar wajib dipilih
                    </p>
                </div>

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
                    :disabled="processing || !agreeToTerms || !selectedAvatar"
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

        <!-- Avatar Selection Modal -->
        <div 
            v-if="showAvatarModal"
            @click="showAvatarModal = false"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
        >
            <div 
                @click.stop
                class="bg-white rounded-2xl p-6 max-w-md w-full max-h-[80vh] overflow-y-auto"
            >
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Pilih Avatar</h3>
                    <button 
                        @click="showAvatarModal = false"
                        class="text-gray-400 hover:text-gray-600"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="grid grid-cols-4 gap-3">
                    <button
                        v-for="avatar in avatars"
                        :key="avatar.id"
                        @click="selectAvatar(avatar.url)"
                        class="relative aspect-square rounded-full overflow-hidden border-2 transition-all hover:scale-105"
                        :class="selectedAvatar === avatar.url ? 'border-blue-500 ring-2 ring-blue-200' : 'border-gray-200 hover:border-blue-300'"
                    >
                        <img 
                            :src="avatar.url" 
                            :alt="avatar.label"
                            class="w-full h-full object-cover"
                        />
                        <div 
                            v-if="selectedAvatar === avatar.url"
                            class="absolute inset-0 bg-blue-500 bg-opacity-20 flex items-center justify-center"
                        >
                            <div class="bg-blue-500 rounded-full p-1">
                                <Check class="w-4 h-4 text-white" />
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </AuthMobileLayout>
</template>