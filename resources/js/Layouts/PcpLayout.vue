<script setup>
import HeaderLayout from "@/Layouts/Header.vue";
import FooterLayout from "@/Layouts/Footer.vue";
import { usePage } from "@inertiajs/vue3";

const emit = defineEmits(["viewSection"]);

const scrollToSection = (newValue) => {
    emit("viewSection", newValue);
};

const generalSetting = usePage().props.generalSetting;
</script>

<template>
    <div>
        <HeaderLayout
            @viewSection="scrollToSection"
            :logo="generalSetting.logo_black"
        ></HeaderLayout>

        <slot></slot>

        <FooterLayout
            @viewSection="scrollToSection"
            :logo="generalSetting.logo_white"
        ></FooterLayout>
    </div>
</template>
