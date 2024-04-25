<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import CarDetails from "@/Components/App/CarDetails.vue";
import { ref } from "vue";
import { TailwindPagination } from "laravel-vue-pagination";

const form = ref({});
const isShowCarDetail = ref(false);

function showCarDetails(query) {
    form.value = query;
    isShowCarDetail.value = true;
}

function getResults(e) {
    return router.visit("/dashboard?page=" + e);
}

const props = defineProps({
    quries: Object,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8 relative">
                <div
                    class="bg-white relative overflow-x-auto shadow-md sm:rounded-lg"
                >
                    <table v-if="props.quries?.data.length > 0" class="w-full text-sm text-left rtl:text-right">
                        <thead>
                            <tr>
                                <th class="border p-2 text-sm">Title</th>
                                <th class="border p-2 text-sm">Name</th>
                                <th class="border p-2 text-sm">Email</th>
                                <th class="border p-2 text-sm">Phone</th>
                                <th class="border p-2 text-sm">DOB</th>
                                <th class="border p-2 text-sm">
                                    Vehicle Value
                                </th>
                                <th class="border p-2 text-sm">Owned Since</th>
                                <th class="border p-2 text-sm">
                                    PCP Taken Out
                                </th>
                                <th class="border p-2 text-sm">Dealers Name</th>
                                <th class="border p-2 text-sm">Lenders Name</th>
                                <th class="border p-2 text-sm">Created Date</th>
                                <th class="border p-2 text-sm">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="query in props.quries?.data"
                                :key="query.id"
                            >
                                <td class="border p-2">{{ query.title }}</td>
                                <td class="border p-2">{{ query.name }}</td>
                                <td class="border p-2">{{ query.email }}</td>
                                <td class="border p-2">{{ query.phone }}</td>
                                <td class="border p-2">{{ query.dob }}</td>
                                <td class="border p-2">
                                    {{ query.vehicle_value }}
                                </td>
                                <td class="border p-2">
                                    {{ query.owned_since }}
                                </td>
                                <td class="border p-2">
                                    {{ query.pcp_taken_out }}
                                </td>
                                <td class="border p-2">
                                    {{ query.dealers_name }}
                                </td>
                                <td class="border p-2">
                                    {{ query.lenders_name }}
                                </td>
                                <td class="border p-2">
                                    {{ query.created_at }}
                                </td>
                                <td class="border p-2">
                                    <button
                                        @click="showCarDetails(query)"
                                        class="bg-indigo-700 text-white p-1 rounded shadow-sm"
                                    >
                                        View
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div v-else class="p-5">
                        No records found!
                    </div>
                    <div class="my-5">
                        <TailwindPagination
                            :data="props.quries"
                            @pagination-change-page="getResults"
                        />
                    </div>
                </div>
                <div v-if="isShowCarDetail">
                    <div
                        class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-60 z-10"
                    ></div>
                    <div
                        class="absolute z-20 -top-10 right-0 left-0 flex justify-center items-center"
                    >
                        <CarDetails
                            :form="form"
                            @update:isShowCarDetail="isShowCarDetail = $event"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
