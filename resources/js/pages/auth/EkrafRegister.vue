<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm, usePage, router } from '@inertiajs/vue3'; 

const form = useForm({
    business_name: '',
    business_address: '',
    // TAMBAHAN: Field Telepon
    phone: '', 
});

const page = usePage();

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
    <AuthBase
        title="Daftar Mitra Ekraf"
        description="Lengkapi detail bisnis Anda untuk verifikasi"
    >
        <Head title="Daftar Ekraf" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="business_name">Nama Ekraf</Label>
                    <Input
                        id="business_name"
                        type="text"
                        required
                        autofocus
                        autocomplete="organization"
                        name="business_name"
                        v-model="form.business_name"
                        placeholder="Masukkan nama ekraf kamu"
                    />
                    <InputError :message="form.errors.business_name" /> 
                </div>
                
                <!-- TAMBAHAN: Input Telepon -->
                <div class="grid gap-2">
                    <Label for="phone">Nomor Telepon</Label>
                    <Input
                        id="phone"
                        type="tel"
                        required
                        autocomplete="tel"
                        name="phone"
                        v-model="form.phone"
                        placeholder="Cth: 081234567890"
                    />
                    <InputError :message="form.errors.phone" />
                </div>
                <!-- AKHIR TAMBAHAN -->


                <div class="grid gap-2">
                    <Label for="business_address">Alamat Detail</Label>
                    <Input
                        id="business_address"
                        type="text"
                        required
                        autocomplete="street-address"
                        name="business_address"
                        v-model="form.business_address"
                        placeholder="Masukkan detail alamat"
                    />
                    <InputError :message="form.errors.business_address" />
                </div>

                <Button
                    type="submit"
                    class="mt-2 w-full"
                    tabindex="5"
                    :disabled="form.processing"
                    data-test="register-ekraf-button"
                >
                    <Spinner v-if="form.processing" />
                    Daftarkan Ekrafmu
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                <p>
                    Anda mendaftar sebagai Mitra Ekraf menggunakan akun yang
                    sedang login.
                </p>
            </div>
        </form>
    </AuthBase>
</template>