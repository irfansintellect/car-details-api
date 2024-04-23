<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CarDetails from "@/Components/App/CarDetails.vue";
import { ref } from "vue";
const form = ref({});
const isShowCarDetail = ref(false);

function showCarDetails(query) {
    form.value = query;
    isShowCarDetail.value = true;
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative">
                <div
                    class="bg-white p-4 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>DOB</th>
                                <th>Vehicle Value</th>
                                <th>Owned Since</th>
                                <th>PCP Taken Out</th>
                                <th>Dealers Name</th>
                                <th>Lenders Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="query in $page['props']['quries']"
                                :key="query.id"
                            >
                                <td>{{ query.title }}</td>
                                <td>{{ query.name }}</td>
                                <td>{{ query.email }}</td>
                                <td>{{ query.phone }}</td>
                                <td>{{ query.dob }}</td>
                                <td>{{ query.vehicle_value }}</td>
                                <td>{{ query.owned_since }}</td>
                                <td>{{ query.pcp_taken_out }}</td>
                                <td>{{ query.dealers_name }}</td>
                                <td>{{ query.lenders_name }}</td>
                                <td>
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
                </div>
                <div v-if="isShowCarDetail">
                    <div
                        class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-60 z-10"
                    ></div>
                    <div
                        class="absolute z-20 top-4 right-0 left-0 flex justify-center items-center"
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
