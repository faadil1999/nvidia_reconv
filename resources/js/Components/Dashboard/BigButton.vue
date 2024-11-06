<template>
    <div
        class="col-span-1 w-full rounded-lg hover:cursor-pointer hover:animate-bounce"
        :class="bg_color"
    >
        <div class="w-full h-full mx-auto">
            <button class="items-center flex flex-row mx-auto h-full">
                <slot name="icon">
                    <HomeIcon />
                </slot>
                <span class="text-lg">
                    {{ label }}
                </span>
            </button>
        </div>
    </div>
</template>
<script setup>
import { HomeIcon } from "lucide-vue-next";

const props = defineProps({
    label: {
        type: String,
        default: "Step",
    },

    bg_color: {
        type: String,
        default: "bg-blue-300",
    },
});
</script>
