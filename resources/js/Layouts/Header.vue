<script setup>
import { ref } from "vue";

defineProps({
    logo: String,
});
const navValue = ref(null);
const isMenuOpen = ref(false);

const emit = defineEmits(["viewSection"]);

const newValue = ref("");
const onClickScrollToSection = (newValue) => {
    navValue.value = newValue;
    emit("viewSection", newValue);
};

function toggleMenu() {
    isMenuOpen.value = !isMenuOpen.value;
}
</script>

<template>
    <nav class="bg-white border-gray-200 fixed top-0 w-full z-20">
        <div
            class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4"
        >
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img :src="logo" class="h-12 w-full" alt="Flowbite Logo" />
            </a>
            <button
                data-collapse-toggle="navbar-default"
                type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-default"
                aria-expanded="false"
                @click="toggleMenu"
            >
                <span class="sr-only">Open main menu</span>
                <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 17 14"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15"
                    />
                </svg>
            </button>
            <div
                class="w-full md:block md:w-auto"
                id="navbar-default"
                :class="{ block: isMenuOpen, hidden: !isMenuOpen }"
            >
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white"
                >
                    <li>
                        {{ newValue }}
                        <button
                            @click="onClickScrollToSection('home')"
                            class="block py-2 px-3 text-gray-900 rounded md:p-0 hover:text-green-600 transition-all"
                            :class="{ 'text-green-600': navValue == 'home' }"
                            aria-current="page"
                        >
                            Start Claim
                        </button>
                    </li>
                    <li>
                        <button
                            @click="onClickScrollToSection('FAQs')"
                            class="block py-2 px-3 text-gray-900 rounded md:border-0 md:p-0 hover:text-green-600 transition-all"
                            :class="{ 'text-green-600': navValue == 'FAQs' }"
                        >
                            FAQs
                        </button>
                    </li>
                    <li>
                        <button
                            @click="onClickScrollToSection('privacyPolicy')"
                            class="block py-2 px-3 text-gray-900 rounded md:p-0 hover:text-green-600 transition-all"
                            :class="{
                                'text-green-600': navValue == 'privacyPolicy',
                            }"
                        >
                            Privacy Policy
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
