<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthMobileLayout from '@/layouts/auth/AuthMobileLayout.vue';
import { Head, useForm } from '@inertiajs/vue3'; 
import { Store, MapPin, Phone } from 'lucide-vue-next';
import { ref } from 'vue';  

const props = defineProps({
    channel_id: Number,
});

const form = useForm({
    business_name: '',
    business_address: '',
    phone: '', 
    channel_id: props.channel_id,
});

const agreeToTerms = ref(false);

const submit = () => {
    form.post('/register/ekraf', {
        onSuccess: () => {
            console.log('Pendaftaran Mitra Ekraf berhasil diproses. Mengalihkan ke Dasbor Mitra...');
        },
        onError: () => {
            console.error('Pendaftaran gagal. Cek pesan error.');
        }
    });
};
</script>

<template>
    <AuthMobileLayout title="Daftar akun Mitra Ekraf">
        <Head title="Daftar akun Mitra Ekraf" />

        <div class="mb-6 flex justify-center">
            <div class="relative">
                <img
                    src="/images/registerekraf.png"
                    alt="Ekraf Illustration"
                    class="w-60 h-65 object-cover"
                />
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">
                Daftar mitra ekraf kamu
            </h2>
            <p class="text-sm text-gray-700">
                Buat ekraf kamu terlibat di dalam channel wisata
            </p>
        </div>

        <div class="mb-6">
            <form @submit.prevent="submit" class="flex flex-col gap-5">
                <div class="flex flex-col gap-2">
                    <Label for="business_name" class="text-sm font-medium text-black">
                        Nama Ekraf
                    </Label>
                    <div class="relative">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <Store class="w-5 h-5" />
                        </div>
                        <Input
                            id="business_name"
                            type="text"
                            name="business_name"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="organization"
                            v-model="form.business_name"
                            placeholder="Masukkan nama ekraf kamu"
                            class="pl-10 h-12 bg-white border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        />
                    </div>
                    <InputError :message="form.errors.business_name" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label for="business_address" class="text-sm font-medium text-black">
                        Alamat Detail
                    </Label>
                    <div class="relative">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <MapPin class="w-5 h-5" />
                        </div>
                        <Input
                            id="business_address"
                            type="text"
                            name="business_address"
                            required
                            :tabindex="2"
                            autocomplete="street-address"
                            v-model="form.business_address"
                            placeholder="Masukkan detail alamat(patokan)"
                            class="pl-10 h-12 bg-white border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        />
                    </div>
                    <InputError :message="form.errors.business_address" />
                </div>

                <div class="flex flex-col gap-2">
                    <Label for="phone" class="text-sm font-medium text-black">
                        Nomor Telepon WhatsApp
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
                            placeholder="Masukkan Nomor Telepon"
                            class="pl-10 h-12 bg-white border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        />
                    </div>
                    <InputError :message="form.errors.phone" />
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
                    :tabindex="4"
                    :disabled="form.processing || !agreeToTerms"
                    data-test="register-ekraf-button"
                >
                    <Spinner v-if="form.processing" class="mr-2" />
                    <span v-if="!form.processing">Daftarkan Ekrafmu</span>
                    <span v-else>Memproses...</span>
                </Button>
            </form>
        </div>

        <div class="text-center text-xs text-gray-600">
            <p>
                Anda mendaftar sebagai Mitra Ekraf menggunakan akun yang sedang login.
            </p>
        </div>
    </AuthMobileLayout>
</template>