<script setup>
import PcpLayout from "@/Layouts/PcpLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Thank You" />
    <PcpLayout>
        <div
            class="py-20 md:py-64 m-auto text-white"
            style="background-image: url('img/step-1-car-dark.jpg')"
        >
            <h3 class="text-center text-4xl md:text-6xl font-bold mt-6 mb-5">
                Thank you
            </h3>
            <div class="text-center text-xl md:text-2xl">
                <div>Thank you for your submission at My PCP Claim.</div>
                <div>
                    Rest assured, one of our experts will be in touch with you
                    shortly.
                </div>
            </div>
        </div>
    </PcpLayout>
</template>
