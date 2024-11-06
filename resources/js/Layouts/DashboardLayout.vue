<template>
    <div class="flex items-stretch h-screen">
        <Sidebar
            :sidebarOpen="sidebarOpen"
            @close-sidebar="sidebarOpen = false"
            @toggle-sidebar="sidebarOpen = !sidebarOpen"
            :image_url="image_url"
        />
        <div
            id="layout-container"
            class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden"
        >
            <Header />
            <main class="min-h-screen bg-theme-primary-light dark:bg-gray-800">
                <slot name="currentPage" />
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import Sidebar from "@/Layouts/Partials/Client/Sidebar.vue";
import FlashMessagesList from "@/Components/FlashMessagesList.vue";
import Header from "./Partials/Client/Header.vue";

const sidebarOpen = ref(false);
const props = defineProps({
    image_url: {
        type: String,
        default:
            "http://nvidia_reconv.test/storage/images/logo_nvidia_reconv.png",
    },
});
</script>
