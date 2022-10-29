<script setup>
import SuperLayout from '@/Layouts/SuperLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Alert from '@/Components/Alert.vue';
import {Head, useForm, usePage} from '@inertiajs/inertia-vue3';
const users = usePage().props.value.users;
const office = usePage().props.value.office;
const form = useForm({
    name: office.name,
    type: office.type,
    user_id: office.user_id,
});

const submit = () => {
    form.patch(`/super/office/${office.id}`, {
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
                Edit Kantor
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
                                <InputLabel for="type" value="Jenis Kantor" />
                                <select name="type" id="type" v-model="form.type" class="mt-1 block w-full">
                                    <option value="HEAD">HEAD OFFICE</option>
                                    <option value="BRANCH">BRANCH OFFICE</option>
                                    <option value="MINE_SITE">MINE SITE</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.type" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="manager" value="Manager" />
                                <select name="user_id" id="manager" v-model="form.user_id" class="mt-1 block w-full">
                                    <option v-for="(user, index) in users" :value="user.id">{{ user.name }}</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.user_id" />
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
