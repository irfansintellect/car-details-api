<script setup>
import CarDetails from "@/Components/App/CarDetails.vue";
import FAQs from "@/Components/App/FAQs.vue";
import PrivacyPolicy from "@/Components/App/PrivacyPolicy.vue";
import TrustedPartner from "@/Components/App/TrustedPartner.vue";
import WhyChooseUs from "@/Components/App/WhyChooseUs.vue";
import PcpLayout from "@/Layouts/PcpLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { useVuelidate } from "@vuelidate/core";
import { email, helpers, required } from "@vuelidate/validators";
import { computed, onMounted, onUpdated, ref } from "vue";
import CheckNowRibbon from "../../Components/App/CheckNowRibbon.vue";
import Loading from "@/Components/App/Loading.vue";
import { usePage } from "@inertiajs/vue3";

const generalSetting = usePage().props.generalSetting;

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
    dob: "",
    vehicle_value: "",
    owned_since: "",
    pcp_taken_out: "",
    dealers_name: "",
    lenders_name: "",
    confirmClaim: null,
});

onMounted(() => {
    console.log('registrationNumber', form.registrationNumber)
    console.log(props.data)
    // props.taxStatus = props.data?.taxStatus,

})

onUpdated(() => {
    form.registrationNumber = props.data?.registrationNumber;
        form.taxStatus = props.data?.taxStatus;
        form.taxDueDate = props.data?.taxDueDate;
        form.motStatus = props.data?.motStatus;
        form.make = props.data?.make;
        form.yearOfManufacture = props.data?.yearOfManufacture;
        form.engineCapacity = props.data?.engineCapacity;
        form.co2Emissions = props.data?.co2Emissions;
        form.fuelType = props.data?.fuelType;
        form.markedForExport = props.data?.markedForExport;
        form.colour = props.data?.colour;
        form.typeApproval = props.data?.typeApproval;
        form.dateOfLastV5CIssued = props.data?.dateOfLastV5CIssued;
        form.motExpiryDate = props.data?.motExpiryDate;
        form.wheelplan = props.data?.wheelplan;
        form.monthOfFirstRegistration = props.data?.monthOfFirstRegistration;
        console.log("updated")
})
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
    pcp_taken_out: {
        required: helpers.withMessage(
            "Please Choose PCP Taken Value.",
            required
        ),
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

async function prevStep() {
    currentStep.value--;
}

function submitCliam() {
    isLoading.value = true;
    form.post(route("store-claim"), {
        onSuccess: () => {
            console.log("here");
            isLoading.value = false;
        },
        onError: () => {
            isLoading.value = false;
        },
    });
}

function searchCarDetails() {
    isLoading.value = true;
    form.post(route("search-car-details"), {
        onSuccess: (data) => {
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

const sectionHome = ref(null);
const sectionFAQs = ref(null);
const sectionPrivacyPolicy = ref(null);

const scrollToSection = (newValue) => {
    let element;
    if (newValue == "home") {
        element = sectionHome.value;
    } else if (newValue == "FAQs") {
        element = sectionFAQs.value;
    } else if (newValue == "privacyPolicy") {
        element = sectionPrivacyPolicy.value;
    }
    element.scrollIntoView({
        behavior: "smooth",
        block: "start",
    });
};
</script>

<template>

    <Head title="Welcome" />
    <div ref="sectionHome">
        <PcpLayout @viewSection="scrollToSection">
            <main>
                <section class="bg-secondary-500 poster relative">
                    <div v-if="showCarDetails">
                        <div class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-60 z-10"></div>
                        <div class="absolute z-20 right-0 left-0 flex justify-center items-center">
                            <CarDetails :form="form" @update:showCarDetails="showCarDetails = $event" />
                        </div>
                    </div>

                    <div class="container mx-auto pb-20 pt-20 px-4">
                        <div class="md:block lg:grid grid-cols-5 gap-10">
                            <div class="md:col-span-2">
                                <div class="bg-white p-10 mt-16 rounded-lg shadow-lg text-center relative overflow-hidden" v-if="currentStep == 1">
                                    <CheckNowRibbon />
                                    {{ form }}
                                    <h3 class="text-2xl mt-10">
                                        If you've ever taken out a <br />
                                        <span class="text-3xl font-bold">Car Finance Agreement</span>
                                    </h3>
                                    <p class="text-3xl my-4">
                                        You could be owed
                                        <span class="text-red-800 font-bold">£1000's</span>!
                                    </p>
                                    <form>
                                        <div class="my-4">
                                            <input type="text" v-model="form.regno" class="w-full mr-3 text-center text-3xl rounded-lg p-3 bg-gray-100" :class="{
                                                'border-red-600':
                                                    form.errors.regno &&
                                                    !form.regno,
                                            }" placeholder="TYPE REG HERE" />
                                            <small class="text-red-600" v-if="
                                                form.errors.regno &&
                                                !form.regno
                                            ">
                                                {{ form.errors.regno }}
                                            </small>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" @click.prevent="nextStep"
                                                class="w-full items-center text-xl justify-center px-5 py-3 font-medium text-center border rounded-lg bg-green-500 hover:bg-green-600 transition-all text-white">
                                                <Loading v-if="isLoading" />
                                                <template v-else>
                                                    <div class="flex justify-center">
                                                        <span class="mr-3">Search Claim</span>

                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-[24px] fill-white">
                                                            <path
                                                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                                                        </svg>
                                                    </div>
                                                </template>
                                            </button>
                                        </div>
                                        <div class="relative mb-10">
                                            <div class="absolute top-0 left-0 w-full">
                                                <div class="mt-2 text-xl text-red-500" v-if="
                                                    errorMessage &&
                                                    !isLoading
                                                ">
                                                    {{ errorMessage }}
                                                </div>
                                                <div class="mt-2 text-xl text-green-600" v-else>
                                                    <div class="flex items-center justify-center gap-1 my-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-4 w-4 fill-green-600">
                                                            <path
                                                                d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                                                        </svg>
                                                        <p class="italic">
                                                            It only takes a
                                                            minute.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="bg-white p-10 mt-16 rounded-lg shadow-lg relative overflow-hidden" v-if="currentStep == 2">
                                    <CheckNowRibbon />
                                    <form>
                                        <div class="flex items-center gap-x-3 whitespace-nowrap mb-3">
                                            <div class="flex w-full items-center">
                                                <div class="flex w-full h-6 bg-gray-200 rounded overflow-hidden" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="flex flex-col justify-center rounded overflow-hidden bg-red-800 px-3 text-xs text-white text-left whitespace-nowrap transition duration-500"
                                                        style="width: 50%">
                                                        Vehicle Details
                                                    </div>
                                                </div>
                                                <div class="w-10 text-end">
                                                    <span class="text-xl ml-1 text-red-800">50%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            {{ form }}
                                            <label for="vehicle_value" class="block text-base font-bold">Vehicle Value</label>
                                            <div>
                                                <select name="vehicle_value" id="vehicle_value" v-model="form.vehicle_value" :class="{
                                                    'border-red-600':
                                                        v$.vehicle_value
                                                            ?.$error,
                                                }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                    <option value="" disabled>
                                                        Select
                                                    </option>
                                                    <option value="£0 - £14,999">
                                                        £0 - £14,999
                                                    </option>
                                                    <option value="£15,999 - £24,999">
                                                        £15,999 - £24,999
                                                    </option>
                                                    <option value="£25,000 - £34,999">
                                                        £25,000 - £34,999
                                                    </option>
                                                    <option value="£35,000+">
                                                        £35,000+
                                                    </option>
                                                </select>
                                                <div class="input--select-arrow"></div>
                                            </div>
                                            <small class="text-red-600" v-if="v$.vehicle_value?.$error">
                                                {{
                                                    v$.vehicle_value?.$errors[0]
                                                        ?.$message
                                                }}
                                            </small>
                                        </div>
                                        <div class="mb-5">
                                            <label for="owned_since" class="block text-base font-bold">How long have you had/did you
                                                have the vehicle for?</label>
                                            <div>
                                                <select name="owned_since" id="owned_since" v-model="form.owned_since" :class="{
                                                    'border-red-600':
                                                        v$.owned_since
                                                            ?.$error,
                                                }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                                                    <option value="More Than 48 Months">
                                                        More Than 48 Months
                                                    </option>
                                                </select>
                                                <div class="input--select-arrow"></div>
                                                <small class="text-red-600" v-if="
                                                    v$.owned_since?.$error
                                                ">
                                                    {{
                                                        v$.owned_since
                                                            ?.$errors[0]
                                                            ?.$message
                                                    }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            <label for="" class="block text-base font-bold">Was your PCP/HP taken out in
                                                the last 8 years?</label>
                                            <div :class="{
                                                'border-red-600':
                                                    v$.pcp_taken_out
                                                        ?.$error,
                                            }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <div class="flex items-center">
                                                    <label for="rbyes" class="flex items-center cursor-pointer">
                                                        <input type="radio" id="rbyes" v-model="form.pcp_taken_out
                                                            " value="yes" class="form-radio h-5 w-5 text-green-500" />
                                                        <span class="ml-2 text-sm">Yes</span>
                                                    </label>

                                                    <label for="rbno" class="flex items-center ml-5 cursor-pointer">
                                                        <input type="radio" id="rbno" v-model="form.pcp_taken_out
                                                            " value="no" class="form-radio h-5 w-5 text-red-500" />
                                                        <span class="ml-2 text-sm">No</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <small class="text-red-600" v-if="v$.pcp_taken_out?.$error">
                                                {{
                                                    v$.pcp_taken_out?.$errors[0]
                                                        ?.$message
                                                }}
                                            </small>
                                        </div>

                                        <div class="block md:flex justify-between">
                                            <div class="mb-5">
                                                <label for="dealers_name" class="block text-base font-bold">Your Dealer's name</label>
                                                <input type="dealers_name" id="dealers_name" v-model="form.dealers_name" :class="{
                                                    'border-red-600':
                                                        v$.dealers_name
                                                            ?.$error,
                                                }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="Your Dealer's name" />
                                                <small class="text-red-600" v-if="
                                                    v$.dealers_name?.$error
                                                ">
                                                    {{
                                                        v$.dealers_name
                                                            ?.$errors[0]
                                                            ?.$message
                                                    }}
                                                </small>
                                            </div>

                                            <div class="mb-5">
                                                <label for="lenders_name" class="block text-base font-bold">Your Lender's name</label>
                                                <input type="lenders_name" id="lenders_name" v-model="form.lenders_name" :class="{
                                                    'border-red-600':
                                                        v$.lenders_name
                                                            ?.$error,
                                                }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="Your Lender's name" />
                                                <small class="text-red-600" v-if="
                                                    v$.lenders_name?.$error
                                                ">
                                                    {{
                                                        v$.lenders_name
                                                            ?.$errors[0]
                                                            ?.$message
                                                    }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="mt-2 flex gap-6">
                                            <button type="submit" @click.prevent="prevStep"
                                                class="w-full items-center text-xl justify-center px-5 py-3 font-medium text-center border rounded-lg bg-blue-950 hover:bg-blue-900 transition-all text-white">
                                                <div class="flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="fill-white w-[16px]">
                                                        <path
                                                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                                                    </svg>
                                                    <span class="ms-3">
                                                        Previous
                                                    </span>
                                                </div>
                                            </button>
                                            <button type="submit" @click.prevent="nextStep"
                                                class="w-full items-center text-xl justify-center px-5 py-3 font-medium text-center border rounded-lg bg-green-500 hover:bg-green-600 transition-all text-white">
                                                <div class="flex items-center justify-center">
                                                    <span class="mr-3">
                                                        Next
                                                    </span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="fill-white w-[16px]">
                                                        <path
                                                            d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="bg-white p-10 mt-16 rounded-lg shadow-lg relative overflow-hidden" v-if="currentStep == 3">
                                    <CheckNowRibbon />
                                    <form>
                                        <div class="flex items-center gap-x-3 whitespace-nowrap mb-3">
                                            <div class="flex w-full items-center">
                                                <div class="flex w-full h-6 bg-gray-200 rounded overflow-hidden" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="flex flex-col justify-center rounded overflow-hidden bg-red-800 px-3 text-xs text-white text-left whitespace-nowrap transition duration-500"
                                                        style="width: 90%">
                                                        Personal Details
                                                    </div>
                                                </div>
                                                <div class="w-10 text-end">
                                                    <span class="text-xl ml-1 text-red-800">90%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            <label for="title" class="block text-base font-bold">Title</label>
                                            <div>
                                                <select name="title" id="title" v-model="form.title" :class="{
                                                    'border-red-600':
                                                        form.errors.title &&
                                                        !form.title,
                                                }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                    <option value="" disabled>
                                                        Select
                                                    </option>
                                                    <option value="Mr">
                                                        Mr
                                                    </option>
                                                    <option value="Mrs">
                                                        Mrs
                                                    </option>
                                                    <option value="Miss">
                                                        Miss
                                                    </option>
                                                    <option value="Ms">
                                                        Ms
                                                    </option>
                                                    <option value="Dr">
                                                        Dr
                                                    </option>
                                                </select>
                                                <div class="input--select-arrow"></div>
                                                <small class="text-red-600" v-if="
                                                    form.errors.title &&
                                                    !form.title
                                                ">
                                                    {{ form.errors.title }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            <label for="name" class="block text-base font-bold">Your Name</label>
                                            <input type="name" id="name" v-model="form.name" :class="{
                                                'border-red-600':
                                                    form.errors.name &&
                                                    !form.name,
                                            }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Your Name" />
                                            <small class="text-red-600" v-if="
                                                form.errors.name &&
                                                !form.name
                                            ">
                                                {{ form.errors.name }}
                                            </small>
                                        </div>
                                        <div class="mb-5">
                                            <label for="email" class="block text-base font-bold">Your Email</label>
                                            <input type="email" id="email" v-model="form.email" :class="{
                                                'border-red-600':
                                                    form.errors.email &&
                                                    !form.email,
                                            }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@flowbite.com" />
                                            <small class="text-red-600" v-if="
                                                form.errors.email &&
                                                !form.email
                                            ">
                                                {{ form.errors.email }}
                                            </small>
                                        </div>
                                        <div class="block md:flex justify-between">
                                            <div class="mb-5">
                                                <label for="phone" class="block text-base font-bold">Date of Birth</label>
                                                <input type="date" id="phone" v-model="form.dob" :class="{
                                                    'border-red-600':
                                                        form.errors.dob &&
                                                        !form.dob,
                                                }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Your Phone" />
                                                <small class="text-red-600" v-if="
                                                    form.errors.dob &&
                                                    !form.dob
                                                ">
                                                    {{ form.errors.dob }}
                                                </small>
                                            </div>
                                            <div class="mb-5">
                                                <label for="phone" class="block text-base font-bold">Your Phone</label>
                                                <input type="phone" id="phone" v-model="form.phone" :class="{
                                                    'border-red-600':
                                                        form.errors.phone &&
                                                        !form.phone,
                                                }" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Your Phone" />
                                                <small class="text-red-600" v-if="
                                                    form.errors.phone &&
                                                    !form.phone
                                                ">
                                                    {{ form.errors.phone }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between mb-5">
                                            <div class="flex items-center h-5 gap-1">
                                                <input id="remember" type="checkbox" v-model="form.confirmClaim" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" />
                                                <label for="remember" class="block text-base font-bold">I agree to terms and
                                                    conditions</label>
                                            </div>
                                            <button class="text-indigo-500" @click.prevent="
                                                showCarDetails = true
                                                ">
                                                <div class="flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-[16px] fill-green-600">
                                                        <path
                                                            d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
                                                    </svg>
                                                    <span class="ms-1 text-green-600">
                                                        Details
                                                    </span>
                                                </div>
                                            </button>
                                        </div>

                                        <div class="mt-2 flex gap-6">
                                            <button type="submit" @click.prevent="prevStep"
                                                class="w-full items-center text-xl justify-center px-5 py-3 font-medium text-center border rounded-lg bg-blue-950 hover:bg-blue-900 transition-all text-white">
                                                <div class="flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="fill-white w-[16px]">
                                                        <path
                                                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                                                    </svg>
                                                    <span class="ms-3">
                                                        Previous
                                                    </span>
                                                </div>
                                            </button>

                                            <button type="submit" @click.prevent="submitCliam" :disabled="!form.confirmClaim ||
                                                isLoading
                                                " :class="form.confirmClaim
                                                    ? 'bg-green-500'
                                                    : 'bg-green-200'
                                                    " class="w-full items-center text-xl justify-center px-5 py-3 font-medium text-center border rounded-lg text-white">
                                                <Loading v-if="isLoading" />
                                                <template v-else>
                                                    <div class="">
                                                        <span class="whitespace-nowrap">
                                                            <div class="relative">
                                                                <span>
                                                                    Submit Claim
                                                                </span>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </template>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="relative col-span-3 mt-14 text-wrap flex flex-col justify-center text-white">
                                <h1 class="text-xl md:text-2xl font-bold uppercase mb-3">
                                    Have you purchased a car through PCP
                                    finance?
                                </h1>
                                <h1 class="text-3xl md:text-6xl font-bold uppercase mb-3">
                                    You may be eligible for a claim!
                                </h1>
                                <p class="text-sm md:text-xl lg:text-xl pr-10">
                                    At {{ generalSetting.company_name }}, we
                                    understand the frustration and confusion
                                    that can arise from mis-sold Personal
                                    Contract Purchase agreements
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
                <TrustedPartner :name="generalSetting.company_name" />
                <WhyChooseUs :name="generalSetting.company_name" />
                <div ref="sectionFAQs">
                    <FAQs :name="generalSetting.company_name" />
                </div>
                <div ref="sectionPrivacyPolicy">
                    <PrivacyPolicy :generalSetting="generalSetting" />
                </div>
            </main>
        </PcpLayout>
    </div>
</template>
