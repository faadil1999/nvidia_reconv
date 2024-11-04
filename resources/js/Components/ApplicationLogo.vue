<template>
    <img :src="image_url" :class="size" />
</template>

<script setup>
const props = defineProps({
    image_url: {
        type: String,
        default: "",
    },
    size: {
        type: String,
        default: "w-32 h-32",
    },
});
</script>
