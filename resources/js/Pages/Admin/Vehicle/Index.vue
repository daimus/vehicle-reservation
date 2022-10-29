<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    vehicles: Array,
})

</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kendaraan
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-start mb-4">
                            <Link href="/admin/vehicle/create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                                Tambah Kendaraan
                            </Link>
                        </div>
                        <div>
                            <Alert />
                        </div>

                        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Merk/Model
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Jenis
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Kepemilikan
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        No Polisi
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Ketersediaan
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Total Jarak Tempuh
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Konsumsi Bahan Bakar
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>


                                <tr class="bg-white border-b hover:bg-gray-50" v-if="vehicles.length <= 0">
                                    <th colspan="6" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap text-center">
                                        Tidak Ada Data
                                    </th>
                                </tr>
                                <tr class="bg-white border-b hover:bg-gray-50" v-else v-for="(vehicle, index) in vehicles">
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ vehicle.brand }} / {{ vehicle.model }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ vehicle.type }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ vehicle.ownership }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ vehicle.vehicle_no }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        <span :class="vehicle.is_available ? 'text-green-500' : 'text-red-500'">{{ vehicle.is_available ? 'AVAILABLE' : 'UNAVAILABLE' }}</span>
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ vehicle.total_trip }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        Total: {{ vehicle.total_fuel_consumption }}
                                        <br>
                                        Rata-Rata: {{ vehicle.avg_fuel_consumption }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        <Link :href="`/admin/vehicle/${vehicle.id}/edit`" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Edit</Link>
                                        <Link :href="`/admin/vehicle/${vehicle.id}`" method="delete"  type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Hapus</Link>
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
