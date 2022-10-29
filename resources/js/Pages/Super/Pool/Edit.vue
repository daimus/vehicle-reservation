<script setup>
import SuperLayout from '@/Layouts/SuperLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Alert from '@/Components/Alert.vue';
import {Head, useForm, usePage} from '@inertiajs/inertia-vue3';
const heads = usePage().props.value.heads;
const admins = usePage().props.value.admins;
const offices = usePage().props.value.offices;
const pool = usePage().props.value.pool;
const form = useForm({
    name: pool.name,
    office_id: pool.office_id,
    head_user_id: pool.head_user_id,
    admin_user_id: pool.admin_user_id,
});

const submit = () => {
    form.patch(`/super/pool/${pool.id}`, {
        onFinish: () => {

        },
    });
};
</script>

<template>
    <Head title="Dashboard Admin" />

    <SuperLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Pool
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <Alert />
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="office_id" value="Kantor" />
                                <select name="office_id" id="office_id" v-model="form.office_id" class="mt-1 block w-full">
                                    <option v-for="(office, index) in offices" :value="office.id">{{ office.name }}</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.office_id" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="head_user_id" value="Kepala Pool" />
                                <select name="head_user_id" id="head_user_id" v-model="form.head_user_id" class="mt-1 block w-full">
                                    <option v-for="(head, index) in heads" :value="head.id">{{ head.name }}</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.head_user_id" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="admin_user_id" value="Admin Pool" />
                                <select name="admin_user_id" id="admin_user_id" v-model="form.admin_user_id" class="mt-1 block w-full">
                                    <option v-for="(admin, index) in admins" :value="admin.id">{{ admin.name }}</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.admin_user_id" />
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
    </SuperLayout>
</template>
