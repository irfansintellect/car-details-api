<script setup>
import { ref } from "vue";

const emit = defineEmits(["viewSection"]);

const onClickScrollToSection = (newValue) => {
    emit("viewSection", newValue);
};

defineProps({
    logo: String,
});
</script>
<template>
    <footer class="p-4 bg-gray-800 md:p-8 lg:p-10 dark:bg-gray-800 dark">
        <div class="mx-auto max-w-screen-xl text-center">
            <a
                href="#"
                class="flex justify-center items-center text-2xl font-semibold"
            >
                <img
                    :src="logo"
                    class="h-12 w-full fill-red-600"
                    alt="PCP Logo"
                />
            </a>
            <p class="my-6 text-gray-400">
                PCP Claim Services is a marketing partner of ABC Solicitors who
                is authorised and regulated by the Solicitors Regulation
                Authority (No: 427899).
            </p>
            <ul
                class="flex flex-wrap justify-center items-center mb-6 text-white"
            >
                <li>
                    <button
                        @click="onClickScrollToSection('home')"
                        class="mr-4 hover:underline md:mr-6"
                    >
                        Start Claim
                    </button>
                </li>
                <li>
                    <button
                        @click="onClickScrollToSection('FAQs')"
                        class="mr-4 hover:underline md:mr-6"
                    >
                        FAQs
                    </button>
                </li>
                <li>
                    <button
                        @click="onClickScrollToSection('privacyPolicy')"
                        class="mr-4 hover:underline md:mr-6"
                    >
                        Privacy Policy
                    </button>
                </li>
            </ul>
            <span class="text-sm text-gray-400 sm:text-center"
                >© 2024 <a href="#" class="hover:underline">PCP</a>. All Rights
                Reserved.</span
            >
        </div>
    </footer>
</template>
