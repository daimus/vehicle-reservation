<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    reservations: Array,
})

</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pemesanan Kendaraan
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-start mb-4">
                            <Link href="/admin/reservation/create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                                Buat Pemesanan Kendaraan
                            </Link>
                            <a href="/admin/reservation/export" class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                                Export
                            </a>
                        </div>
                        <div>
                            <Alert />
                        </div>

                        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Nama Pemesan
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Kendaraan
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Catatan
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Tanggal Pemesanan
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


                                <tr class="bg-white border-b hover:bg-gray-50" v-if="reservations.length <= 0">
                                    <th colspan="6" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap text-center">
                                        Tidak Ada Data
                                    </th>
                                </tr>
                                <tr class="bg-white border-b hover:bg-gray-50" v-else v-for="(reservation, index) in reservations">
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ reservation.name }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ reservation.vehicle.brand }} / {{ reservation.vehicle.model }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ reservation.note }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ reservation.created_at }}
                                    </td>

                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        <span v-if="reservation.approvals.at(-1).is_approved === true" class="text-green-500">DISETUJUI</span>
                                        <span v-else-if="reservation.approvals.at(-1).is_approved === false" class="text-red-500">DITOLAK</span>
                                        <span v-else class="text-gray-800">MENUNGGU PERSETUJUAN</span>
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        <Link :href="`/admin/reservation/${reservation.id}/edit`" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Edit</Link>
                                        <Link :href="`/admin/reservation/${reservation.id}`" method="delete"  type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Hapus</Link>
                                        <div v-if="reservation.approvals.at(-1).is_approved === true">
                                            <Link v-if="!reservation.trip" :href="`/admin/trip/${reservation.id}/create`" type="button" class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Rekam Kendaraan Keluar</Link>
                                            <Link v-else-if="!reservation.trip.entry_date" :href="`/admin/trip/${reservation.trip.id}/edit`" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Rekam Kendaraan Kembali</Link>
                                            <button v-else type="button" class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Pemesanan Selesai</button>
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
    </AdminLayout>
</template>
