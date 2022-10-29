<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Alert from '@/Components/Alert.vue';
import {Head, useForm, usePage} from '@inertiajs/inertia-vue3';

const pools = usePage().props.value.pools;
const form = useForm({
    brand: '',
    model: '',
    vehicle_no: '',
    type: '',
    ownership: '',

});

const submit = () => {
    form.post('/admin/vehicle', {
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
                Tambah Kendaraan
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <Alert />
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="brand" value="Merk" />
                                <TextInput id="brand" type="text" class="mt-1 block w-full" v-model="form.brand" required autofocus />
                                <InputError class="mt-2" :message="form.errors.brand" />
                            </div>
                            <div>
                                <InputLabel for="model" value="Model" />
                                <TextInput id="model" type="text" class="mt-1 block w-full" v-model="form.model" required autofocus />
                                <InputError class="mt-2" :message="form.errors.model" />
                            </div>
                            <div>
                                <InputLabel for="vehicle_no" value="No Polisi" />
                                <TextInput id="vehicle_no" type="text" class="mt-1 block w-full" v-model="form.vehicle_no" required autofocus />
                                <InputError class="mt-2" :message="form.errors.vehicle_no" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="type" value="Jenis" />
                                <select name="type" id="type" v-model="form.type" class="mt-1 block w-full">
                                    <option value="SUV">SUV</option>
                                    <option value="MPV">MPV</option>
                                    <option value="DOUBLE_CABIN">DOUBLE CABIN</option>
                                    <option value="TRUCK">TRUCK</option>
                                    <option value="DUMP_TRUCK">DUMP TRUCK</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.type" />
                            </div>
                            <div class="mt-4">
                                <InputLabel for="type" value="Kepemilikan" />
                                <select name="ownership" id="ownership" v-model="form.ownership" class="mt-1 block w-full">
                                    <option value="OWN">Milik Sendiri</option>
                                    <option value="RENT">Sewa</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.ownership" />
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
