<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { useVuelidate } from "@vuelidate/core";
import { email, helpers, required } from "@vuelidate/validators";
import { computed, ref } from "vue";

const currentStep = ref(1);
const isLoading = ref(false);
const errorMessage = ref(null);
const validationError = ref(false);
const showCarDetails = ref(false);

const props = defineProps({
    data: {
        type: Object,
        default: null,
    },
    searchError: {
        type: String,
        default: null,
    },
});

const form = useForm({
    registrationNumber: props.data?.registrationNumber,
    taxStatus: props.data?.taxStatus,
    taxDueDate: props.data?.taxDueDate,
    motStatus: props.data?.motStatus,
    make: props.data?.make,
    yearOfManufacture: props.data?.yearOfManufacture,
    engineCapacity: props.data?.engineCapacity,
    co2Emissions: props.data?.co2Emissions,
    fuelType: props.data?.fuelType,
    markedForExport: props.data?.markedForExport,
    colour: props.data?.colour,
    typeApproval: props.data?.typeApproval,
    dateOfLastV5CIssued: props.data?.dateOfLastV5CIssued,
    motExpiryDate: props.data?.motExpiryDate,
    wheelplan: props.data?.wheelplan,
    monthOfFirstRegistration: props.data?.monthOfFirstRegistration,
    regno: "Kj16cnz",
    title: "",
    name: "",
    email: "",
    phone: "",
    vehicle_value: "",
    owned_since: "",
    pcp_taken_out: false,
    dealers_name: "",
    lenders_name: "",
});

const validations = computed(() => ({
    vehicle_value: {
        required: helpers.withMessage(
            "Please select your vehicle value.",
            required
        ),
    },
    owned_since: {
        required: helpers.withMessage("Please select owned time.", required),
    },
    dealers_name: {
        required: helpers.withMessage("Please enter dealer name.", required),
    },
    lenders_name: {
        required: helpers.withMessage("Please enter lender name.", required),
    },
}));
const v$ = useVuelidate(validations, form);

async function nextStep() {
    if (currentStep.value == 1) {
        searchCarDetails();
    } else if (currentStep.value == 2) {
        const isValid = await v$.value.$validate();
        if (!isValid) {
            validationError.value = true;
        } else {
            currentStep.value++;
        }
    }
}

function submitCliam() {
    form.post(route("store-claim"), {
        onSuccess: () => {
            window.location.href = route("thank-you");
        },
    });
}

function searchCarDetails() {
    isLoading.value = true;
    form.post(route("search-car-details"), {
        onSuccess: (data) => {
            console.log(data);
            isLoading.value = false;
            if (!props.searchError) {
                currentStep.value++;
            } else {
                errorMessage.value = props.searchError;
            }
        },
        onError: (errors) => {
            isLoading.value = false;
        },
    });
}
</script>

<template>
    <Head title="Welcome" />
    <div>
        <main>
            <section
                class="bg-secondary-500 poster-step-1 relative"
                v-if="currentStep == 1"
            >
                <div class="container mx-auto pb-24 pt-40 px-4">
                    <div
                        class="-mx-4 flex flex-wrap items-center space-y-6 lg:space-y-0"
                    >
                        <div class="px-4 w-full md:w-9/12 xl:w-7/12 2xl:w-5/12">
                            <div
                                class="bg-white p-8 rounded-lg shadow-lg text-center relative overflow-hidden"
                            >
                                <div class="absolute right-0 top-0 h-16 w-16">
                                    <div
                                        class="absolute transform rotate-45 bg-red-800 text-center text-white font-semibold py-1 right-[-35px] top-[32px] w-[170px]"
                                    >
                                        CHECK NOW
                                    </div>
                                </div>
                                <h3 class="text-2xl">
                                    If you've ever taken out a <br />
                                    <span class="text-3xl font-bold"
                                        >Car Finance Agreement</span
                                    >
                                </h3>
                                <p class="text-3xl my-4">
                                    You could be owed
                                    <span class="text-red-800 font-bold"
                                        >£1000's</span
                                    >!
                                </p>
                                <form>
                                    <div class="my-4">
                                        <input
                                            type="text"
                                            v-model="form.regno"
                                            class="w-full mr-3 text-center text-3xl rounded-lg p-3 bg-gray-100"
                                            :class="{
                                                'border-red-600':
                                                    form.errors.regno &&
                                                    !form.regno,
                                            }"
                                            placeholder="TYPE REG HERE"
                                        />
                                        <small
                                            class="text-red-600"
                                            v-if="
                                                form.errors.regno && !form.regno
                                            "
                                        >
                                            {{ form.errors.regno }}
                                        </small>
                                    </div>
                                    <div class="mt-4">
                                        <button
                                            type="submit"
                                            @click.prevent="nextStep"
                                            class="w-full items-center text-xl justify-center px-5 py-3 font-medium text-center border rounded-lg bg-green-500 text-white"
                                        >
                                            <div
                                                role="status"
                                                v-if="isLoading"
                                                class="flex items-center justify-center gap-1"
                                            >
                                                <svg
                                                    aria-hidden="true"
                                                    role="status"
                                                    class="inline w-5 h-5 text-gray-200 animate-spin dark:text-gray-600"
                                                    viewBox="0 0 100 101"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                        fill="currentColor"
                                                    />
                                                    <path
                                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                        fill="#1C64F2"
                                                    />
                                                </svg>
                                                Searching...
                                            </div>
                                            <template v-else>
                                                Search Claim
                                            </template>
                                        </button>
                                    </div>
                                    <div
                                        class="flex items-center justify-center gap-1 my-1"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512"
                                            class="h-4 w-4"
                                        >
                                            <path
                                                d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"
                                            />
                                        </svg>
                                        <p class="italic">
                                            It only takes a minute.
                                        </p>
                                    </div>
                                    <div
                                        class="my-2 text-xl text-red-500"
                                        v-if="errorMessage && !isLoading"
                                    >
                                        {{ errorMessage }}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section
                class="bg-secondary-500 poster-step-2 relative"
                v-if="currentStep == 2"
            >
                <div class="container mx-auto pb-24 pt-40 px-4">
                    <div
                        class="-mx-4 flex flex-wrap items-center space-y-6 lg:space-y-0"
                    >
                        <div class="px-4 w-full md:w-9/12 xl:w-7/12 2xl:w-5/12">
                            <div
                                class="bg-white p-8 rounded-lg shadow-lg text-center relative overflow-hidden"
                            >
                                <div class="absolute right-0 top-0 h-16 w-16">
                                    <div
                                        class="absolute transform rotate-45 bg-red-800 text-center text-white font-semibold py-1 right-[-35px] top-[32px] w-[170px]"
                                    >
                                        CHECK NOW
                                    </div>
                                </div>
                                <form>
                                    <div
                                        class="flex items-center gap-x-3 whitespace-nowrap mb-3"
                                    >
                                        <div class="flex w-full items-center">
                                            <div
                                                class="flex w-full h-6 bg-gray-200 rounded overflow-hidden dark:bg-neutral-700"
                                                role="progressbar"
                                                aria-valuenow="75"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            >
                                                <div
                                                    class="flex flex-col justify-center rounded overflow-hidden bg-red-800 px-3 text-xs text-white text-left whitespace-nowrap transition duration-500"
                                                    style="width: 50%"
                                                >
                                                    Vehicle Details
                                                </div>
                                            </div>
                                            <div class="w-10 text-end">
                                                <span
                                                    class="text-xl ml-1 text-red-800"
                                                    >50%</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        <label
                                            for="vehicle_value"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Vehicle Value</label
                                        >
                                        <div>
                                            <select
                                                name="vehicle_value"
                                                id="vehicle_value"
                                                v-model="form.vehicle_value"
                                                :class="{
                                                    'border-red-600':
                                                        v$.vehicle_value
                                                            ?.$error,
                                                }"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            >
                                                <option value="" disabled>
                                                    Select
                                                </option>
                                                <option value="£0 - £14,999">
                                                    £0 - £14,999
                                                </option>
                                                <option
                                                    value="£15,999 - £24,999"
                                                >
                                                    £15,999 - £24,999
                                                </option>
                                                <option
                                                    value="£25,000 - £34,999"
                                                >
                                                    £25,000 - £34,999
                                                </option>
                                                <option value="£35,000+">
                                                    £35,000+
                                                </option>
                                            </select>
                                            <div
                                                class="input--select-arrow"
                                            ></div>
                                        </div>
                                        <small
                                            class="text-red-600"
                                            v-if="v$.vehicle_value?.$error"
                                        >
                                            {{
                                                v$.vehicle_value?.$errors[0]
                                                    ?.$message
                                            }}
                                        </small>
                                    </div>
                                    <div class="mb-5">
                                        <label
                                            for="owned_since"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >How long have you had/did you have
                                            the vehicle for?</label
                                        >
                                        <div>
                                            <select
                                                name="owned_since"
                                                id="owned_since"
                                                v-model="form.owned_since"
                                                :class="{
                                                    'border-red-600':
                                                        v$.owned_since?.$error,
                                                }"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            >
                                                <option value="" disabled>
                                                    Select
                                                </option>
                                                <option value="12 - 23 Months">
                                                    12 - 23 Months
                                                </option>
                                                <option value="24 - 35 Months">
                                                    24 - 35 Months
                                                </option>
                                                <option value="36 - 47 Months">
                                                    36 - 47 Months
                                                </option>
                                                <option
                                                    value="More Than 48 Months"
                                                >
                                                    More Than 48 Months
                                                </option>
                                            </select>
                                            <div
                                                class="input--select-arrow"
                                            ></div>
                                            <small
                                                class="text-red-600"
                                                v-if="v$.owned_since?.$error"
                                            >
                                                {{
                                                    v$.owned_since?.$errors[0]
                                                        ?.$message
                                                }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        <label
                                            for=""
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Was your PCP/HP taken out in the
                                            last 8 years?</label
                                        >
                                        <div
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                            <div class="flex">
                                                <div class="me-5">
                                                    <input
                                                        type="radio"
                                                        id="rbyes"
                                                        v-model="
                                                            form.pcp_taken_out
                                                        "
                                                        value="yes"
                                                    />
                                                    <label
                                                        for="rbyes"
                                                        class="ms-1"
                                                        >Yes</label
                                                    >
                                                </div>

                                                <div>
                                                    <input
                                                        type="radio"
                                                        id="rbno"
                                                        v-model="
                                                            form.pcp_taken_out
                                                        "
                                                        value="no"
                                                        checked
                                                    />
                                                    <label
                                                        for="rbno"
                                                        class="ms-1"
                                                        >No</label
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-5">
                                        <label
                                            for="dealers_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Your Dealer's name</label
                                        >
                                        <input
                                            type="dealers_name"
                                            id="dealers_name"
                                            v-model="form.dealers_name"
                                            :class="{
                                                'border-red-600':
                                                    v$.dealers_name?.$error,
                                            }"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Your Dealer's name"
                                        />
                                        <small
                                            class="text-red-600"
                                            v-if="v$.dealers_name?.$error"
                                        >
                                            {{
                                                v$.dealers_name?.$errors[0]
                                                    ?.$message
                                            }}
                                        </small>
                                    </div>

                                    <div class="mb-5">
                                        <label
                                            for="lenders_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Your Lender's name</label
                                        >
                                        <input
                                            type="lenders_name"
                                            id="lenders_name"
                                            v-model="form.lenders_name"
                                            :class="{
                                                'border-red-600':
                                                    v$.lenders_name?.$error,
                                            }"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Your Lender's name"
                                        />
                                        <small
                                            class="text-red-600"
                                            v-if="v$.lenders_name?.$error"
                                        >
                                            {{
                                                v$.lenders_name?.$errors[0]
                                                    ?.$message
                                            }}
                                        </small>
                                    </div>
                                    <div class="mt-4">
                                        <button
                                            type="submit"
                                            @click.prevent="nextStep"
                                            class="w-full items-center text-xl justify-center px-5 py-3 font-medium text-center border rounded-lg bg-green-500 text-white"
                                        >
                                            Next Step
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section
                class="bg-secondary-500 poster-step-3 relative"
                v-if="currentStep == 3"
            >
                <div
                    class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-60 z-10"
                    v-if="showCarDetails"
                ></div>
                <div
                    class="absolute z-20 right-0 left-0 flex justify-center items-center"
                    v-if="showCarDetails"
                >
                    <div class="mt-10 bg-white p-10 rounded-lg relative">
                        <button
                            class="absolute top-3 right-3"
                            @click.prevent="showCarDetails = false"
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
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Your Registration Number</label
                                >
                                <input
                                    type="registrationNumber"
                                    id="registrationNumber"
                                    v-model="form.registrationNumber"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>

                            <div class="mb-5">
                                <label
                                    for="taxStatus"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Tax Status</label
                                >
                                <input
                                    type="taxStatus"
                                    id="taxStatus"
                                    v-model="form.taxStatus"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>

                            <div class="mb-5">
                                <label
                                    for="taxDueDate"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Tax Due Date</label
                                >
                                <input
                                    type="taxDueDate"
                                    id="taxDueDate"
                                    v-model="form.taxDueDate"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>

                            <div class="mb-5">
                                <label
                                    for="motStatus"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Mot Status</label
                                >
                                <input
                                    type="motStatus"
                                    id="motStatus"
                                    v-model="form.motStatus"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>
                            <div class="mb-5">
                                <label
                                    for="make"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Make</label
                                >
                                <input
                                    type="make"
                                    id="make"
                                    v-model="form.make"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>

                            <div class="mb-5">
                                <label
                                    for="yearOfManufacture"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Year of Manufacture</label
                                >
                                <input
                                    type="yearOfManufacture"
                                    id="yearOfManufacture"
                                    v-model="form.yearOfManufacture"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>
                            <div class="mb-5">
                                <label
                                    for="engineCapacity"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Engine Capacity</label
                                >
                                <input
                                    type="engineCapacity"
                                    id="engineCapacity"
                                    v-model="form.engineCapacity"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>

                            <div class="mb-5">
                                <label
                                    for="co2Emissions"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Co2 Emissions</label
                                >
                                <input
                                    type="co2Emissions"
                                    id="co2Emissions"
                                    v-model="form.co2Emissions"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>

                            <div class="mb-5">
                                <label
                                    for="fuelType"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Fuel Type</label
                                >
                                <input
                                    type="fuelType"
                                    id="fuelType"
                                    v-model="form.fuelType"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>

                            <div class="mb-5">
                                <label
                                    for="markedForExport"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Marked For Export</label
                                >
                                <input
                                    type="markedForExport"
                                    id="markedForExport"
                                    v-model="form.markedForExport"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>
                            <div class="mb-5">
                                <label
                                    for="colour"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Colour</label
                                >
                                <input
                                    type="colour"
                                    id="colour"
                                    v-model="form.colour"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>

                            <div class="mb-5">
                                <label
                                    for="typeApproval"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Type Approval</label
                                >
                                <input
                                    type="typeApproval"
                                    id="typeApproval"
                                    v-model="form.typeApproval"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>
                            <div class="mb-5">
                                <label
                                    for="dateOfLastV5CIssued"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Date of Last V5C Issued</label
                                >
                                <input
                                    type="dateOfLastV5CIssued"
                                    id="dateOfLastV5CIssued"
                                    v-model="form.dateOfLastV5CIssued"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>

                            <div class="mb-5">
                                <label
                                    for="motExpiryDate"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Mot Expiry Date</label
                                >
                                <input
                                    type="motExpiryDate"
                                    id="motExpiryDate"
                                    v-model="form.motExpiryDate"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>
                            <div class="mb-5">
                                <label
                                    for="wheelplan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Wheel Plan</label
                                >
                                <input
                                    type="wheelplan"
                                    id="wheelplan"
                                    v-model="form.wheelplan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>

                            <div class="mb-5">
                                <label
                                    for="monthOfFirstRegistration"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Month Of First Registration</label
                                >
                                <input
                                    type="monthOfFirstRegistration"
                                    id="monthOfFirstRegistration"
                                    v-model="form.monthOfFirstRegistration"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mx-auto pb-24 pt-40 px-4 relative">
                    <div
                        class="-mx-4 flex flex-wrap items-center space-y-6 lg:space-y-0"
                    >
                        <div class="px-4 w-full md:w-9/12 xl:w-7/12 2xl:w-5/12">
                            <div
                                class="bg-white p-8 rounded-lg shadow-lg text-center relative overflow-hidden"
                            >
                                <div class="absolute right-0 top-0 h-16 w-16">
                                    <div
                                        class="absolute transform rotate-45 bg-red-800 text-center text-white font-semibold py-1 right-[-35px] top-[32px] w-[170px]"
                                    >
                                        CHECK NOW
                                    </div>
                                </div>
                                <form>
                                    <div
                                        class="flex items-center gap-x-3 whitespace-nowrap mb-3"
                                    >
                                        <div class="flex w-full items-center">
                                            <div
                                                class="flex w-full h-6 bg-gray-200 rounded overflow-hidden dark:bg-neutral-700"
                                                role="progressbar"
                                                aria-valuenow="75"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            >
                                                <div
                                                    class="flex flex-col justify-center rounded overflow-hidden bg-red-800 px-3 text-xs text-white text-left whitespace-nowrap transition duration-500"
                                                    style="width: 90%"
                                                >
                                                    Personal Details
                                                </div>
                                            </div>
                                            <div class="w-10 text-end">
                                                <span
                                                    class="text-xl ml-1 text-red-800"
                                                    >90%</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        <label
                                            for="title"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Title</label
                                        >
                                        <div>
                                            <select
                                                name="title"
                                                id="title"
                                                v-model="form.title"
                                                :class="{
                                                    'border-red-600':
                                                        form.errors.title &&
                                                        !form.title,
                                                }"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            >
                                                <option value="" disabled>
                                                    Select
                                                </option>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Miss">
                                                    Miss
                                                </option>
                                                <option value="Ms">Ms</option>
                                                <option value="Dr">Dr</option>
                                            </select>
                                            <div
                                                class="input--select-arrow"
                                            ></div>
                                            <small
                                                class="text-red-600"
                                                v-if="
                                                    form.errors.title &&
                                                    !form.title
                                                "
                                            >
                                                {{ form.errors.title }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        <label
                                            for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Your Name</label
                                        >
                                        <input
                                            type="name"
                                            id="name"
                                            v-model="form.name"
                                            :class="{
                                                'border-red-600':
                                                    form.errors.name &&
                                                    !form.name,
                                            }"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Your Name"
                                        />
                                        <small
                                            class="text-red-600"
                                            v-if="
                                                form.errors.name && !form.name
                                            "
                                        >
                                            {{ form.errors.name }}
                                        </small>
                                    </div>
                                    <div class="mb-5">
                                        <label
                                            for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Your Email</label
                                        >
                                        <input
                                            type="email"
                                            id="email"
                                            v-model="form.email"
                                            :class="{
                                                'border-red-600':
                                                    form.errors.email &&
                                                    !form.email,
                                            }"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="name@flowbite.com"
                                        />
                                        <small
                                            class="text-red-600"
                                            v-if="
                                                form.errors.email && !form.email
                                            "
                                        >
                                            {{ form.errors.email }}
                                        </small>
                                    </div>

                                    <div class="mb-5">
                                        <label
                                            for="phone"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            >Your Phone</label
                                        >
                                        <input
                                            type="phone"
                                            id="phone"
                                            v-model="form.phone"
                                            :class="{
                                                'border-red-600':
                                                    form.errors.phone &&
                                                    !form.phone,
                                            }"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Your Phone"
                                        />
                                        <small
                                            class="text-red-600"
                                            v-if="
                                                form.errors.phone && !form.phone
                                            "
                                        >
                                            {{ form.errors.phone }}
                                        </small>
                                    </div>
                                    <div
                                        class="flex items-center justify-between mb-5"
                                    >
                                        <div class="flex items-start h-5">
                                            <input
                                                id="remember"
                                                type="checkbox"
                                                value=""
                                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                            />
                                            <label
                                                for="remember"
                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                                >I agree to terms and
                                                conditions</label
                                            >
                                        </div>
                                        <button
                                            class="text-indigo-500"
                                            @click.prevent="
                                                showCarDetails = true
                                            "
                                        >
                                            Show Details
                                        </button>
                                    </div>

                                    <div class="mt-4">
                                        <button
                                            type="submit"
                                            @click.prevent="submitCliam"
                                            class="w-full items-center text-xl justify-center px-5 py-3 font-medium text-center border rounded-lg bg-green-500 text-white"
                                        >
                                            Submit Claim
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-24">
                <div class="container mx-auto px-4 space-y-12">
                    <div class="flex flex-wrap items-center">
                        <div class="py-4 w-full lg:w-6/12">
                            <img
                                src="https://images.unsplash.com/photo-1493238792000-8113da705763?ixid=MnwyMDkyMnwwfDF8c2VhcmNofDJ8fGNhcnxlbnwwfHx8fDE2MzE2NzIwOTU&ixlib=rb-1.2.1q=85&fm=jpg&crop=faces&cs=srgb&w=1000&h=650&fit=crop"
                                width="1000"
                                alt="..."
                                height="650"
                            />
                        </div>
                        <div class="py-4 w-full lg:w-6/12">
                            <div class="bg-white lg:-ml-12 lg:pl-12 lg:py-12">
                                <h2 class="mb-2 text-primary-500 text-xl">
                                    Rental Cars &amp; Much More
                                </h2>
                                <h3
                                    class="capitalize font-bold mb-4 text-4xl text-gray-900 xl:text-5xl"
                                >
                                    Experience a Rental service like never
                                    before
                                </h3>
                                <div
                                    class="bg-primary-500 mb-6 pb-1 w-2/12"
                                ></div>
                                <p class="mb-6">
                                    Phasellus pulvinar faucibus neque, nec
                                    rhoncus nunc ultrices sit amet. Lorem ipsum
                                    dolor sit amet, consectetur adipiscing elit.
                                    Phasellus pulvinar faucibus neque, nec
                                    rhoncus nunc ultrices sit amet. Curabitur ac
                                    sagittis neque, vel egestas est.
                                </p>
                                <a
                                    href="#"
                                    class="bg-primary-500 hover:bg-primary-600 inline-block px-6 py-2 text-white"
                                    >Learn More</a
                                >
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center">
                        <div class="py-4 w-full lg:w-4/12 xl:mr-auto xl:w-3/12">
                            <h4
                                class="capitalize font-bold mb-2 text-3xl text-gray-900"
                            >
                                Our Service is Built With Trusr
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit.
                            </p>
                        </div>
                        <div class="py-4 w-full lg:w-8/12">
                            <div class="-mx-4 flex flex-wrap">
                                <div class="p-4 w-full md:w-4/12">
                                    <div>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 65 65"
                                            xml:space="preserve"
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-miterlimit="2"
                                            stroke="currentColor"
                                            width="5rem"
                                            height="5rem"
                                            class="h-20 mb-3 text-primary-500 w-20"
                                        >
                                            <path
                                                d="M13 50v-1.849a2.73 2.73 0 0 0-.741-1.87l-4.038-4.293A4.499 4.499 0 0 1 7 38.907V21.998A2.998 2.998 0 0 1 9.998 19h.004A2.999 2.999 0 0 1 13 21.998V27m38 23v-1.849c0-.695.265-1.364.741-1.87l4.038-4.293A4.499 4.499 0 0 0 57 38.907V21.998A2.998 2.998 0 0 0 54.002 19h-.004A2.999 2.999 0 0 0 51 21.998V27M29 56.379v-4.933c0-.383-.152-.751-.424-1.022A1.442 1.442 0 0 0 27.554 50H13.446c-.383 0-.751.152-1.022.424A1.442 1.442 0 0 0 12 51.446v4.933m23 0v-4.933c0-.383.152-.751.424-1.022A1.442 1.442 0 0 1 36.446 50h14.108c.383 0 .751.152 1.022.424.272.271.424.639.424 1.022v4.933"
                                                fill="none"
                                                stroke-width="2"
                                            ></path>
                                            <path
                                                d="M28 50v-5.491c0-2.439-1-4.771-2.767-6.453l-7.49-7.13a2.71 2.71 0 0 0-3.785.047l-.002.002a2.767 2.767 0 0 0 0 3.912l4.527 4.527M36 50v-5.491c0-2.439 1-4.771 2.767-6.453l7.49-7.13a2.71 2.71 0 0 1 3.785.047l.002.002a2.767 2.767 0 0 1 0 3.912l-4.527 4.527M22.25 16.464a1.499 1.499 0 0 1 1.5-1.5h3.75a1.5 1.5 0 0 0 1.5-1.5V9.5A1.5 1.5 0 0 1 30.5 8h3A1.5 1.5 0 0 1 35 9.5v3.964a1.5 1.5 0 0 0 1.5 1.5h3.75a1.5 1.5 0 0 1 1.5 1.5V19.5a1.503 1.503 0 0 1-1.5 1.5H36.5a1.503 1.503 0 0 0-1.5 1.5v4a1.5 1.5 0 0 1-1.5 1.5h-3a1.5 1.5 0 0 1-1.5-1.5v-4a1.503 1.503 0 0 0-1.5-1.5h-3.75a1.503 1.503 0 0 1-1.5-1.5v-3.036z"
                                                fill="none"
                                                stroke-width="2"
                                            ></path>
                                        </svg>
                                        <h4
                                            class="font-bold text-gray-900 text-xl"
                                        >
                                            Insured &amp; Safe
                                        </h4>
                                    </div>
                                </div>
                                <div class="p-4 w-full md:w-4/12">
                                    <div>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 65 65"
                                            xml:space="preserve"
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-miterlimit="2"
                                            stroke="currentColor"
                                            width="5rem"
                                            height="5rem"
                                            class="h-20 mb-3 text-primary-500 w-20"
                                        >
                                            <path
                                                d="M49.972 21.334c.003-2.264.011-4.339.028-5.976a2.574 2.574 0 0 0-1.082-2.109 2.596 2.596 0 0 0-2.344-.351m-.249.334-.002.001m-16.987-.534a17.589 17.589 0 0 1-11.907.2l-.003-.001A2.596 2.596 0 0 0 14 15.358v18.717m17.455 18.167 11.83-6.799"
                                                fill="none"
                                                stroke-width="2"
                                            ></path>
                                            <path
                                                d="M54 14.908a6.172 6.172 0 0 0-8.146-5.848l-.002.001a14.905 14.905 0 0 1-9.999-.166l-2.623-.984a3.507 3.507 0 0 0-2.46 0l-2.623.984a14.905 14.905 0 0 1-9.999.166l-.002-.001A6.172 6.172 0 0 0 10 14.908V34.14a17.257 17.257 0 0 0 8.263 14.728l11.35 6.93a3.504 3.504 0 0 0 3.573.048l12.156-6.986A17.256 17.256 0 0 0 54 33.898v-18.99z"
                                                fill="none"
                                                stroke-width="2"
                                                stroke-linecap="butt"
                                            ></path>
                                            <circle
                                                cx="32"
                                                cy="26"
                                                r="5"
                                                fill="none"
                                                stroke-width="2"
                                            ></circle>
                                            <path
                                                d="M21.169 40.5C23.64 36.554 27.574 34 32 34c4.426 0 8.36 2.554 10.831 6.5"
                                                fill="none"
                                                stroke-width="2"
                                            ></path>
                                        </svg>
                                        <h4
                                            class="font-bold text-gray-900 text-xl"
                                        >
                                            Certified Chauffeur
                                        </h4>
                                    </div>
                                </div>
                                <div class="p-4 w-full md:w-4/12">
                                    <div>
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 65 65"
                                            xml:space="preserve"
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-miterlimit="2"
                                            stroke="currentColor"
                                            width="5rem"
                                            height="5rem"
                                            class="h-20 mb-3 text-primary-500 w-20"
                                        >
                                            <path
                                                d="M38.028 13.749c8.148 2.342 14.116 9.856 14.116 18.753m-.479 4.315c-1.966 8.695-9.745 15.195-19.03 15.195m-4.854-.61c-8.423-2.159-14.656-9.807-14.656-18.9m.48-4.314c1.966-8.695 9.744-15.195 19.03-15.195m0 33.193v7.316m-13.1-7.9 1.674-1.674m-2.258-11.426h-7.316m7.9-13.099 1.674 1.674m11.426-9.575v7.317m11.425 2.258 1.674-1.674m7.901 13.099h-7.316M44.06 43.928l1.674 1.674"
                                                fill="none"
                                                stroke-width="2"
                                            ></path>
                                            <circle
                                                cx="32.635"
                                                cy="32.502"
                                                r="26"
                                                fill="none"
                                                stroke-width="2"
                                            ></circle>
                                            <path
                                                d="M37.039 34.711a2.369 2.369 0 0 1 1.652 2.01l.214 2a2.177 2.177 0 0 1-2.167 2.412h-.001c-5.92 0-10.727-4.807-10.727-10.728 0-1.799.444-3.495 1.228-4.985a2.779 2.779 0 0 1 2.365-1.44c.457-.051.973-.064 1.467-.077a1.956 1.956 0 0 1 2.004 2.038l-.17 4.093a1.522 1.522 0 0 1-.934 1.34l-1.584.66a6.562 6.562 0 0 0 2.251 3.485l1.456-1.725 2.946.917z"
                                                fill="none"
                                                stroke-width="2"
                                            ></path>
                                        </svg>
                                        <h4
                                            class="font-bold text-gray-900 text-xl"
                                        >
                                            24/7 Support
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer class="bg-black bg-opacity-90 pt-12 text-gray-300">
            <div class="container mx-auto px-4 relative">
                <div class="flex flex-wrap -mx-4">
                    <div class="p-4 w-full lg:w-4/12">
                        <a
                            href="#"
                            class="font-bold font-sans hover:text-opacity-90 inline-flex items-center leading-none mb-4 space-x-2 text-3xl text-primary-500 uppercase"
                            ><span>Prime Drive</span>
                        </a>
                        <ul class="mb-4 space-y-1">
                            <li>9056 Fairground Ave., New York, USA</li>
                            <li>
                                <a
                                    href="#"
                                    class="hover:text-gray-400 text-white"
                                    >+0 123 456 7890</a
                                >
                            </li>
                            <li>
                                <a
                                    href="mailto:hello@fafo.com"
                                    class="hover:text-gray-400 text-white"
                                    >info@company.com</a
                                >
                            </li>
                        </ul>
                        <div class="flex-wrap inline-flex space-x-3">
                            <a
                                href="#"
                                aria-label="facebook"
                                class="hover:text-gray-400"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4v-8.5z"
                                    /></svg
                            ></a>
                            <a
                                href="#"
                                aria-label="twitter"
                                class="hover:text-gray-400"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        d="M22.162 5.656a8.384 8.384 0 0 1-2.402.658A4.196 4.196 0 0 0 21.6 4c-.82.488-1.719.83-2.656 1.015a4.182 4.182 0 0 0-7.126 3.814 11.874 11.874 0 0 1-8.62-4.37 4.168 4.168 0 0 0-.566 2.103c0 1.45.738 2.731 1.86 3.481a4.168 4.168 0 0 1-1.894-.523v.052a4.185 4.185 0 0 0 3.355 4.101 4.21 4.21 0 0 1-1.89.072A4.185 4.185 0 0 0 7.97 16.65a8.394 8.394 0 0 1-6.191 1.732 11.83 11.83 0 0 0 6.41 1.88c7.693 0 11.9-6.373 11.9-11.9 0-.18-.005-.362-.013-.54a8.496 8.496 0 0 0 2.087-2.165z"
                                    /></svg
                            ></a>
                            <a
                                href="#"
                                aria-label="instagram"
                                class="hover:text-gray-400"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 0 1-1.772-1.153 4.904 4.904 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm6.5-.25a1.25 1.25 0 0 0-2.5 0 1.25 1.25 0 0 0 2.5 0zM12 9a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"
                                    /></svg
                            ></a>
                            <a
                                href="#"
                                aria-label="linkedin"
                                class="hover:text-gray-400"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        d="M6.94 5a2 2 0 1 1-4-.002 2 2 0 0 1 4 .002zM7 8.48H3V21h4V8.48zm6.32 0H9.34V21h3.94v-6.57c0-3.66 4.77-4 4.77 0V21H22v-7.93c0-6.17-7.06-5.94-8.72-2.91l.04-1.68z"
                                    /></svg
                            ></a>
                            <a
                                href="#"
                                aria-label="youtube"
                                class="hover:text-gray-400"
                            >
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        d="M21.543 6.498C22 8.28 22 12 22 12s0 3.72-.457 5.502c-.254.985-.997 1.76-1.938 2.022C17.896 20 12 20 12 20s-5.893 0-7.605-.476c-.945-.266-1.687-1.04-1.938-2.022C2 15.72 2 12 2 12s0-3.72.457-5.502c.254-.985.997-1.76 1.938-2.022C6.107 4 12 4 12 4s5.896 0 7.605.476c.945.266 1.687 1.04 1.938 2.022zM10 15.5l6-3.5-6-3.5v7z"
                                    /></svg
                            ></a>
                        </div>
                    </div>
                    <div class="p-4 w-full sm:w-6/12 md:flex-1 lg:w-3/12">
                        <h2 class="font-bold text-color3-500 text-xl">
                            Company
                        </h2>
                        <hr
                            class="border-gray-600 inline-block mb-6 mt-4 w-3/12"
                        />
                        <ul>
                            <li class="mb-4">
                                <a href="#" class="hover:text-gray-400">FAQ</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:text-gray-400">News</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:text-gray-400"
                                    >Careers</a
                                >
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:text-gray-400"
                                    >About Us</a
                                >
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:text-gray-400"
                                    >Contact Us</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="p-4 w-full sm:w-6/12 md:flex-1 lg:w-3/12">
                        <h2 class="font-bold text-color3-500 text-xl">
                            Vehicles
                        </h2>
                        <hr
                            class="border-gray-600 inline-block mb-6 mt-4 w-3/12"
                        />
                        <ul>
                            <li class="mb-4">
                                <a href="#" class="hover:text-gray-400">SUVs</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:text-gray-400"
                                    >Sedans</a
                                >
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:text-gray-400"
                                    >Mini Vans</a
                                >
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:text-gray-400"
                                    >Sports Cars</a
                                >
                            </li>
                            <li class="mb-4">
                                <a href="#" class="hover:text-gray-400"
                                    >Convertibles</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="p-4 w-full md:w-5/12 lg:w-4/12">
                        <h2 class="font-bold text-color3-500 text-xl">
                            Top Cities
                        </h2>
                        <hr
                            class="border-gray-600 inline-block mb-6 mt-4 w-3/12"
                        />
                        <div class="-mx-4 flex flex-wrap">
                            <div class="pb-4 px-4 w-full sm:w-6/12">
                                <ul>
                                    <li class="mb-4">
                                        <a href="#" class="hover:text-gray-400"
                                            >Taxes</a
                                        >
                                    </li>
                                    <li class="mb-4">
                                        <a href="#" class="hover:text-gray-400"
                                            >Boston</a
                                        >
                                    </li>
                                    <li class="mb-4">
                                        <a href="#" class="hover:text-gray-400"
                                            >Colorado</a
                                        >
                                    </li>
                                    <li class="mb-4">
                                        <a href="#" class="hover:text-gray-400"
                                            >California</a
                                        >
                                    </li>
                                    <li class="mb-4">
                                        <a href="#" class="hover:text-gray-400"
                                            >Manhattan</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-4">
                    <hr class="mb-4 opacity-25" />
                    <div class="flex flex-wrap -mx-4 items-center">
                        <div class="px-4 py-2 w-full md:flex-1">
                            <p>
                                &copy; 2002 - 2021. All Rights Reserved -
                                Company Name
                            </p>
                        </div>
                        <div class="px-4 py-2 w-full md:w-auto">
                            <a href="#" class="hover:text-gray-400"
                                >Privacy Policy</a
                            >
                            |
                            <a href="#" class="hover:text-gray-400"
                                >Terms of Use</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
