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
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                    <button @click="showCarDetails(query)">
                                        22
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="isShowCarDetail">
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
