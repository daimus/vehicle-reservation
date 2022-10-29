<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import {Head, Link, usePage} from '@inertiajs/inertia-vue3';

const vehicleStat = usePage().props.value.vehicleStat;
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-wrap -mx-2">
                            <div class="w-full sm:w-1/12 lg:w-1/3 px-2">
                                <div
                                    class="relative min-w-0 break-words rounded-lg overflow-hidden shadow-sm mb-4 w-full bg-white bg-gray-500">
                                    <div class="px-6 py-6 relative">
                                        <div class="flex-auto">
                                            <div class="flex flex-wrap items-center">
                                                <div class="relative ">
                                                    <h5 class="uppercase font-semibold text-xs text-gray-900">
                                                        Total Kendaraan
                                                    </h5>
                                                    <span
                                                        class="mb-0 font-semibold text-md text-lg text-white block w-48 md:w-24 lg:w-20 xl:w-40 overflow-hidden whitespace-nowrap text-ellipsis">
                                                        {{ vehicleStat.total }}</span>
                                                </div>
                                                <span class="flex-auto"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full sm:w-1/12 lg:w-1/3 px-2">
                                <div
                                    class="relative min-w-0 break-words rounded-lg overflow-hidden shadow-sm mb-4 w-full bg-white bg-green-500">
                                    <div class="px-6 py-6 relative">
                                        <div class="flex-auto">
                                            <div class="flex flex-wrap items-center">
                                                <div class="relative ">
                                                    <h5 class="uppercase font-semibold text-xs  text-gray-900">
                                                        Kendaraan Tersedia
                                                    </h5>
                                                    <span
                                                        class="mb-0 font-semibold text-md text-lg text-white block w-48 md:w-24 lg:w-20 xl:w-40 overflow-hidden whitespace-nowrap text-ellipsis">
                                                        {{ vehicleStat.available }}</span>
                                                </div>
                                                <span class="flex-auto"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full sm:w-1/12 lg:w-1/3 px-2">
                                <div
                                    class="relative min-w-0 break-words rounded-lg overflow-hidden shadow-sm mb-4 w-full bg-white bg-yellow-400">
                                    <div class="px-6 py-6 relative">
                                        <div class="flex-auto">
                                            <div class="flex flex-wrap items-center">
                                                <div class="relative ">
                                                    <h5 class="uppercase font-semibold text-xs text-gray-900">
                                                        Kendaraan Terpakai
                                                    </h5>
                                                    <span
                                                        class="mb-0 font-semibold text-md text-lg text-white block w-48 md:w-24 lg:w-20 xl:w-40 overflow-hidden whitespace-nowrap text-ellipsis">
                                                        {{ vehicleStat.unavailable }}</span>
                                                </div>
                                                <span class="flex-auto"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <Link href="/admin/maintenance" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                                Jadwal Perawatan Kendaraan
                                <svg aria-hidden="true" class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
