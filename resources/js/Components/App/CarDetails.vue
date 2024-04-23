<script setup>
defineProps({
    form: {
        type: Object,
        default: null,
    },
});

defineEmits(["update:showCarDetails", "update:isShowCarDetail"]);
</script>

<template>
    <div class="mt-10 bg-white p-10 rounded-lg relative">
        <button
            class="absolute top-3 right-3"
            @click.prevent="
                $emit('update:showCarDetails', false);
                $emit('update:isShowCarDetail', false);
            "
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 384 512"
                class="w-7 h-7"
            >
                <path
                    d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
                />
            </svg>
        </button>
        <div class="grid grid-cols-3 gap-4 mt-2">
            <div class="mb-5">
                <label
                    for="registrationNumber"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Your Registration Number</label
                >
                <input
                    type="registrationNumber"
                    id="registrationNumber"
                    v-model="form.registrationNumber"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>

            <div class="mb-5">
                <label
                    for="taxStatus"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Tax Status</label
                >
                <input
                    type="taxStatus"
                    id="taxStatus"
                    v-model="form.taxStatus"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>

            <div class="mb-5">
                <label
                    for="taxDueDate"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Tax Due Date</label
                >
                <input
                    type="taxDueDate"
                    id="taxDueDate"
                    v-model="form.taxDueDate"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>

            <div class="mb-5">
                <label
                    for="motStatus"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Mot Status</label
                >
                <input
                    type="motStatus"
                    id="motStatus"
                    v-model="form.motStatus"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>
            <div class="mb-5">
                <label
                    for="make"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Make</label
                >
                <input
                    type="make"
                    id="make"
                    v-model="form.make"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>

            <div class="mb-5">
                <label
                    for="yearOfManufacture"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Year of Manufacture</label
                >
                <input
                    type="yearOfManufacture"
                    id="yearOfManufacture"
                    v-model="form.yearOfManufacture"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>
            <div class="mb-5">
                <label
                    for="engineCapacity"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Engine Capacity</label
                >
                <input
                    type="engineCapacity"
                    id="engineCapacity"
                    v-model="form.engineCapacity"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>

            <div class="mb-5">
                <label
                    for="co2Emissions"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Co2 Emissions</label
                >
                <input
                    type="co2Emissions"
                    id="co2Emissions"
                    v-model="form.co2Emissions"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>

            <div class="mb-5">
                <label
                    for="fuelType"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Fuel Type</label
                >
                <input
                    type="fuelType"
                    id="fuelType"
                    v-model="form.fuelType"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>

            <div class="mb-5">
                <label
                    for="markedForExport"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Marked For Export</label
                >
                <input
                    type="markedForExport"
                    id="markedForExport"
                    v-model="form.markedForExport"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>
            <div class="mb-5">
                <label
                    for="colour"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Colour</label
                >
                <input
                    type="colour"
                    id="colour"
                    v-model="form.colour"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>

            <div class="mb-5">
                <label
                    for="typeApproval"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Type Approval</label
                >
                <input
                    type="typeApproval"
                    id="typeApproval"
                    v-model="form.typeApproval"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>
            <div class="mb-5">
                <label
                    for="dateOfLastV5CIssued"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Date of Last V5C Issued</label
                >
                <input
                    type="dateOfLastV5CIssued"
                    id="dateOfLastV5CIssued"
                    v-model="form.dateOfLastV5CIssued"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>

            <div class="mb-5">
                <label
                    for="motExpiryDate"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Mot Expiry Date</label
                >
                <input
                    type="motExpiryDate"
                    id="motExpiryDate"
                    v-model="form.motExpiryDate"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>
            <div class="mb-5">
                <label
                    for="wheelplan"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Wheel Plan</label
                >
                <input
                    type="wheelplan"
                    id="wheelplan"
                    v-model="form.wheelplan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>

            <div class="mb-5">
                <label
                    for="monthOfFirstRegistration"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Month Of First Registration</label
                >
                <input
                    type="monthOfFirstRegistration"
                    id="monthOfFirstRegistration"
                    v-model="form.monthOfFirstRegistration"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    disabled
                />
            </div>
        </div>
    </div>
</template>
