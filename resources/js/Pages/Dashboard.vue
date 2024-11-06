<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { SettingsIcon } from "lucide-vue-next";

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
                >
                    {{ $t("menu.career_histories") }}
                </button>
            </div>
            <!--Career path selected-->
            <div
                class="col-span-1 w-full bg-green-300 rounded-lg hover:animate-bounce hover:cursor-pointer"
            >
                <button class="w-full h-full">
                    {{ $t("menu.reconversion_career") }}
                </button>
            </div>
            <!--Generate career and needed skills according to career history-->
            <div
                class="col-span-1 w-full bg-blue-300 rounded-lg hover:cursor-pointer"
            >
                <div class="w-full h-full mx-auto">
                    <button class="items-center flex flex-row mx-auto h-full">
                        <SettingsIcon class="hover:animate-spin h-20 w-20" />
                        <span class="text-lg">
                            {{ $t("menu.generate") }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
