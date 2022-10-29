<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    vehicles: Array,
})
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Main></Main>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
                            <span class="font-medium">Info!</span> Perawatan dilakukan setiap 1.000 satuan jarak
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
                                        No Polisi
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Jarak Tempuh
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Konsumsi Bahan Bakar
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Perawatan Berikutnya
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
                                        {{ vehicle.vehicle_no }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        Total: {{ vehicle.total_trip }}
                                        <br>
                                        Rata-Rata Harian: {{ vehicle.avg_daily_trip }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        Total: {{ vehicle.total_fuel_consumption }}
                                        <br>
                                        Rata-Rata: {{ vehicle.avg_fuel_consumption }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        Dalam Jarak: {{ vehicle.next_maintenance_in_range }}
                                        <br>
                                        Dalam Hari: {{ vehicle.next_maintenance_in_day }}
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
