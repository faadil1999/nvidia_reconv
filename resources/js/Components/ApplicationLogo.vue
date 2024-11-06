<template>
    <img :src="image_url" :class="size" />
</template>

<script setup>
const props = defineProps({
    image_url: {
        type: String,
        default:
            "http://nvidia_reconv.test/storage/images/logo_nvidia_reconv.png",
    },
    size: {
        type: String,
        default: "w-40 h-44",
    },
});
</script>
