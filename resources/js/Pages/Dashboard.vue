<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    image_url: {
        type: String,
        default: "",
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <DashboardLayout :image_url="image_url">
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-theme_bg-light shadow-sm sm:rounded-lg dark:bg-theme_bg-dark"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        You're logged in!sds
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
