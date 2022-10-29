<script setup>
import OfficerLayout from '@/Layouts/OfficerLayout.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    approvals: Array,
})

</script>

<template>
    <Head title="Dashboard" />

    <OfficerLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Permintaan Persetujuan
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div>
                            <Alert />
                        </div>

                        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Tanggal Reservasi
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Catatan Reservasi
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Kendaraan
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Status
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>


                                <tr class="bg-white border-b hover:bg-gray-50" v-if="approvals.length <= 0">
                                    <th colspan="4" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap text-center">
                                        Tidak Ada Data
                                    </th>
                                </tr>
                                <tr class="bg-white border-b hover:bg-gray-50" v-else v-for="(approval, index) in approvals">
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ approval.created_at }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ approval.reservation.note }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ approval.vehicle.brand }} {{ approval.vehicle.model }} - {{ approval.vehicle.type }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        <span v-if="approval.is_approved === null" class="text-gray-500">MENUNGGU PERSETUJUAN</span>
                                        <span v-else :class="approval.is_approved ? 'text-green-500' : 'text-red-500'">{{ approval.is_approved ? 'DISETUJUI' : 'DITOLAK' }}</span>
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        <div v-if="approval.is_approved === null">
                                            <Link :href="`/officer/approval/${approval.id}/approve`" method="patch" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Setujui</Link>
                                            <Link :href="`/officer/approval/${approval.id}/reject`" method="patch" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Tolak</Link>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </OfficerLayout>
</template>
