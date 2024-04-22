<script setup>
import HeaderLayout from "@/Layouts/Header.vue";
import FooterLayout from "@/Layouts/Footer.vue";

const emit = defineEmits(["viewSection"]);

const scrollToSection = (newValue) => {
    emit("viewSection", newValue);
};
</script>

<template>
    <div class="">
        <HeaderLayout @viewSection="scrollToSection"></HeaderLayout>

        <slot />

        <FooterLayout @viewSection="scrollToSection"></FooterLayout>
    </div>
</template>
