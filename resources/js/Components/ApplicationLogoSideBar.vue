<template>
    <img :src="image_url" class="w-36 h-36" />
</template>

<script setup>
const props = defineProps({
    image_url: {
        type: String,
        default: "",
    },
});
</script>
