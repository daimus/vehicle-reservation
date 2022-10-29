<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Alert from '@/Components/Alert.vue';
import {Head, useForm, usePage} from '@inertiajs/inertia-vue3';

const reservation = usePage().props.value.reservation;
const vehicles = usePage().props.value.vehicles;
const form = useForm({
    name: reservation.name,
    vehicle_id: reservation.vehicle_id,
    note: reservation.note,
});

const submit = () => {
    form.patch(`/admin/reservation/${reservation.id}`, {
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
                Edit Cabang
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <Alert />
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Nama Pemesan" />
                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="vehicle_id" value="Kendaraan" />
                                <select name="vehicle_id" id="vehicle_id" v-model="form.vehicle_id" class="mt-1 block w-full">
                                    <option v-for="(vehicle, index) in vehicles" :value="vehicle.id">{{ vehicle.brand }} {{ vehicle.model }} - {{ vehicle.type }}</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.vehicle_id" />
                            </div>
                            <div class="mt-4">
                                <InputLabel for="note" value="Catatan Pemesanan" />
                                <textarea id="note" type="text" class="mt-1 block w-full" v-model="form.note" required ></textarea>
                                <InputError class="mt-2" :message="form.errors.note" />
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
