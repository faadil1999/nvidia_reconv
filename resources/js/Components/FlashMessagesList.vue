<template>
    <div
        class="top-20 opacity-75 inset-0 fixed z-50 h-fit left-72 lg:left-20 lg:sidebar-expanded:!left-72 2xl:!left-72 transition-all duration-200 ease-in-out"
    >
        <div class="flex flex-col items-center">
            <FlashMessage
                v-for="(flash, name, index) in flashMessages"
                :flash="flash"
                :name="name"
                :key="index"
            />
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import FlashMessage from "./FlashMessage.vue";

const flashMessages = computed(() =>
    Object.fromEntries(
        Object.entries(usePage().props.flash).filter(
            ([key, value]) => value != null
        )
    )
);
</script>
