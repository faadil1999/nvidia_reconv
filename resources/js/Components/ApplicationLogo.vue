<template>
    <img :src="image_url" class="w-32 h-32" />
</template>

<script setup>
const props = defineProps({
    image_url: {
        type: String,
        default: "",
    },
});
</script>
