<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Alert from '@/Components/Alert.vue';
import {Head, useForm, usePage} from '@inertiajs/inertia-vue3';

const vehicle = usePage().props.value.vehicle;
const reservation = usePage().props.value.reservation;
const form = useForm({
    reservation_id: reservation.id,
    vehicle_id: vehicle.id,
    total_trip: '',
    fuel_consumption: '',
    out_date: '',
    entry_date: '',

});

const submit = () => {
    form.post('/admin/trip', {
        onFinish: () => {

        },
    });
};
</script>

<template>
    <Head title="Dashboard Admin" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah Riwayat Kendaraan Keluar
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <Alert />
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="out_date" value="Tanggal Keluar" />
                                <TextInput id="out_date" type="datetime-local" class="mt-1 block w-full" v-model="form.out_date" required autofocus />
                                <InputError class="mt-2" :message="form.errors.out_date" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Simpan
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
