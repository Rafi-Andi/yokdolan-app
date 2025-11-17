<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthMobileLayout from '@/layouts/auth/AuthMobileLayout.vue';
import TermsModal from '@/components/TermsModal.vue';
import { Head, useForm } from '@inertiajs/vue3'; 
import { Map, MapPin, Phone, FileText, Image } from 'lucide-vue-next';
import { ref } from 'vue';

const photoPreviewUrl = ref<string | null>(null);
const agreeToTerms = ref(false);
const showTermsModal = ref(false);

const form = useForm({
    name: '',
    location: '',
    phone: '', 
    description: '',
    profile_photo: null as File | null, 
    is_verified: false,
    is_active: true,
});

const handleFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    const file = target.files?.[0];

    if (file) {
        form.profile_photo = file;
        photoPreviewUrl.value = URL.createObjectURL(file);
    } else {
        form.profile_photo = null;
        photoPreviewUrl.value = null;
    }
};

const submit = () => {
    form.post('/register/channel', {
        forceFormData: true,
        onSuccess: () => {
            console.log('Pendaftaran Channel Wisata berhasil diproses. Mengalihkan ke Dasbor Channel...');
            if (photoPreviewUrl.value) {
                URL.revokeObjectURL(photoPreviewUrl.value);
                photoPreviewUrl.value = null;
            }
        },
        onError: () => {
            console.error('Pendaftaran gagal. Cek pesan error.');
        }
    });
};
</script>

<template>
    <AuthMobileLayout title="Daftar Akun Wisata">
        <Head title="Daftar Akun Wisata" />

        <div class="mb-6 flex justify-center">
            <div class="relative">
                <img
                    src="/images/registerchannel.png"
                    alt="Channel Illustration"
                    class="w-60 h-65 object-cover"
                />
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">
                Daftar Channel Wisata
            </h2>
            <p class="text-sm text-gray-700">
                Daftar sebagai Channel Wisata YokDolan: Kendalikan Narasi Pariwisata Anda.
            </p>
        </div>

        <div class="mb-6">
            <form @submit.prevent="submit" class="flex flex-col gap-5" enctype="multipart/form-data">
                <div class="flex flex-col gap-2">
                    <Label for="name" class="text-sm font-medium text-black">
                        Nama Wisata
                    </Label>
                    <div class="relative">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <Map class="w-5 h-5" />
                        </div>
                        <Input
                            id="name"
                            type="text"
                            name="name"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="organization"
                            v-model="form.name"
                            placeholder="Masukkan nama wisata kamu"
                            class="pl-10 h-12 bg-white border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        />
                    </div>
                    <InputError :message="form.errors.name" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label for="location" class="text-sm font-medium text-black">
                        Lokasi
                    </Label>
                    <div class="relative">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <MapPin class="w-5 h-5" />
                        </div>
                        <Input
                            id="location"
                            type="text"
                            name="location"
                            required
                            :tabindex="2"
                            autocomplete="street-address"
                            v-model="form.location"
                            placeholder="Masukkan lokasi wisata"
                            class="pl-10 h-12 bg-white border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        />
                    </div>
                    <InputError :message="form.errors.location" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label for="phone" class="text-sm font-medium text-black">
                        Nomor Telepon
                    </Label>
                    <div class="relative">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <Phone class="w-5 h-5" />
                        </div>
                        <Input
                            id="phone"
                            type="tel"
                            name="phone"
                            required
                            :tabindex="3"
                            autocomplete="tel"
                            v-model="form.phone"
                            placeholder="Masukkan nomor telepon cth: 08123456789"
                            class="pl-10 h-12 bg-white border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        />
                    </div>
                    <InputError :message="form.errors.phone" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label for="description" class="text-sm font-medium text-black">
                        Deskripsi Singkat
                    </Label>
                    <div class="relative">
                        <div class="absolute left-3 top-4 text-gray-400">
                            <FileText class="w-5 h-5" />
                        </div>
                        <textarea
                            id="description"
                            name="description"
                            v-model="form.description"
                            :tabindex="4"
                            rows="3"
                            placeholder="Jelaskan secara singkat tentang wisata/bisnis Anda (Maks 255 karakter)"
                            maxlength="255"
                            class="pl-10 w-full rounded-lg border-gray-300 bg-white px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none resize-none"
                        ></textarea>
                    </div>
                    <InputError :message="form.errors.description" />
                </div>


                <div class="flex flex-col gap-2">
                    <Label for="profile_photo" class="text-sm font-medium text-black">
                        Foto Wisata
                    </Label>
                    
                    <div class="relative">
                        <input
                            id="profile_photo"
                            type="file"
                            name="profile_photo"
                            accept="image/*"
                            @change="handleFileChange"
                            :disabled="form.processing"
                            :tabindex="5"
                            class="absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0"
                        />

                        <div
                            class="flex h-48 w-full flex-col items-center justify-center overflow-hidden rounded-xl border-2 border-dashed border-gray-400 bg-white"
                        >
                            <div
                                v-if="photoPreviewUrl"
                                class="relative h-full w-full"
                            >
                                <img
                                    :src="photoPreviewUrl"
                                    alt="Preview Foto Profil"
                                    class="h-full w-full object-cover"
                                />
                            </div>

                            <div v-else class="text-center">
                                <div class="p-6 bg-gray-300 inline-block mx-auto rounded-lg mb-2">
                                    <Image class="w-12 h-12 text-gray-400 mx-auto" />
                                </div>
                                <p class="text-gray-600 text-sm">
                                    Upload Foto Wisata
                                </p>
                            </div>
                        </div>
                    </div>
                    <InputError :message="form.errors.profile_photo" />
                </div>

                <div class="flex items-start gap-3">
                    <input
                        type="checkbox"
                        id="terms"
                        v-model="agreeToTerms"
                        class="cursor-pointer mt-0.5 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    />
                    <Label for="terms" class="text-xs text-gray-600 leading-relaxed">
                        Saya setuju dengan 
                        <button
                            type="button"
                            @click="showTermsModal = true"
                            class="cursor-pointer text-blue-600 hover:text-blue-700 underline font-semibold"
                        >
                            Syarat dan Ketentuan Layanan
                        </button>
                    </Label>
                </div>

                <Button
                    type="submit"
                    class="cursor-pointer mt-2 w-full h-12 text-white font-semibold rounded-full bg-gradient-to-r from-[#1485FF] to-[#79BAFF] hover:from-[#0F6FD1] hover:to-[#5A9CE6] disabled:opacity-50 flex items-center justify-center"
                    :tabindex="6"
                    :disabled="form.processing || !agreeToTerms"
                    data-test="register-channel-button"
                >
                    <Spinner v-if="form.processing" class="mr-2" />
                    <span v-if="!form.processing">Daftar Wisata</span>
                    <span v-else>Memproses...</span>
                </Button>
            </form>
        </div>

        <div class="text-center text-xs text-gray-600">
            <p>
                Anda mendaftar sebagai Pemilik Wisata menggunakan akun yang sedang login.
            </p>
        </div>
        <TermsModal 
            :show="showTermsModal"
            @close="showTermsModal = false"
        />
    </AuthMobileLayout>
</template>
