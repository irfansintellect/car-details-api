<script setup>
defineProps({
    logo: String,
});
</script>

<template>
    <img :src="logo" alt="error" />
</template>
