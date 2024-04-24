<script setup>
defineProps({
    logo: String,
});
</script>

<template>
    <img :src="logo" />
</template>
