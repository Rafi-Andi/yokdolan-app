<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm, usePage, router } from '@inertiajs/vue3'; 
import { ref } from 'vue';

const photoPreviewUrl = ref<string | null>(null);

const form = useForm({
    name: '',
    location: '',
    phone: '', 
    description: '',
    
    profile_photo: null as File | null, 
    is_verified: false,
    is_active: true,
});

const page = usePage();

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
    <AuthBase
        title="Daftar Channel Wisata"
        description="Lengkapi detail bisnis Anda untuk verifikasi"
    >
        <Head title="Daftar Wisata" />

        <form @submit.prevent="submit" class="flex flex-col gap-6" enctype="multipart/form-data">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">Nama Wisata</Label>
                    <Input
                        id="name"
                        type="text"
                        required
                        autofocus
                        autocomplete="organization"
                        name="name"
                        v-model="form.name"
                        placeholder="Masukkan nama ekraf kamu"
                    />
                    <InputError :message="form.errors.name" /> 
                </div>

                <div class="grid gap-2">
                    <Label for="phone">Nomor Telepon Bisnis</Label>
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
                
                <div class="grid gap-2">
                    <Label for="description">Deskripsi Singkat</Label>
                    <textarea
                        id="description"
                        name="description"
                        v-model="form.description"
                        rows="3"
                        placeholder="Jelaskan secara singkat tentang wisata/bisnis Anda (Maks 255 karakter)"
                        maxlength="255"
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                    ></textarea>
                    <InputError :message="form.errors.description" />
                </div>

                <div class="grid gap-2">
                    <Label for="location">Alamat Detail</Label>
                    <Input
                        id="location"
                        type="text"
                        required
                        autocomplete="street-address"
                        name="location"
                        v-model="form.location"
                        placeholder="Masukkan detail alamat"
                    />
                    <InputError :message="form.errors.location" />
                </div>
                
                <div class="grid gap-2">
                    <Label for="profile_photo">Foto Profil Channel (Wajib)</Label>
                    
                    <div v-if="photoPreviewUrl" class="mb-3">
                        <img 
                            :src="photoPreviewUrl" 
                            alt="Preview Foto Profil" 
                            class="h-32 w-32 object-cover rounded-md border-2 border-gray-200"
                        />
                    </div>

                    <Input
                        id="profile_photo"
                        type="file"
                        required
                        name="profile_photo"
                        accept="image/*"
                        @change="handleFileChange"
                        :disabled="form.processing"
                        class="p-0 file:text-sm file:font-semibold file:mr-2 file:cursor-pointer"
                    />
                    <InputError :message="form.errors.profile_photo" />
                </div>


                <Button
                    type="submit"
                    class="mt-2 w-full"
                    tabindex="5"
                    :disabled="form.processing"
                    data-test="register-ekraf-button"
                >
                    <Spinner v-if="form.processing" />
                    Daftarkan Wisatamu
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                <p>
                    Anda mendaftar sebagai Pemilik Wisata menggunakan akun yang
                    sedang login.
                </p>
            </div>
        </form>
    </AuthBase>
</template>