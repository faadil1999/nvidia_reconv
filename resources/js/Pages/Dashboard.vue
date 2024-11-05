<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head, router } from "@inertiajs/vue3";

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
        <div class="p-12 grid grid-cols-3 gap-x-4 h-1/2">
            <!--Career history-->
            <div
                class="col-span-1 w-full bg-yellow-300 rounded-lg hover:animate-bounce hover:cursor-pointer"
            >
                <button
                    class="w-full h-full"
                    @click="router.get(route('career.histories.index'))"
                ></button>
            </div>
            <!--Career path selected-->
            <div
                class="col-span-1 w-full bg-green-300 rounded-lg hover:animate-bounce hover:cursor-pointer"
            >
                <button></button>
            </div>
            <!--Generate career and needed skills according to career history-->
            <div
                class="col-span-1 w-full bg-blue-300 rounded-lg hover:animate-bounce hover:cursor-pointer"
            >
                <button></button>
            </div>
        </div>
    </DashboardLayout>
</template>
