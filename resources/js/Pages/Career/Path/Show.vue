<template>
    <DashboardLayout>
        <template #currentPage>
            <div class="px-28 pt-8 text-lg text-black dark:text-white">
                <h1>{{ $t("menu.generated") }}</h1>
            </div>
        </template>
        <div class="px-8 mx-12 mt-14 flex flex-col dark:text-white">
            <!--Introduction-->
            <h1 class="text-lg font-bold">{{ $t("fields.introduction") }} :</h1>
            <p class="w-full p-2 text-justify py-6">
                {{ careerPath?.introduction }}
            </p>
            <!--Steps-->
            <div class="grid grid-cols-3 gap-5">
                <div
                    v-for="item in careerPath?.steps"
                    :key="item.id"
                    v-motion
                    :initial="{ opacity: 0, y: 100 }"
                    :visibleOnce="{
                        opacity: 100,
                        y: 0,
                        transition: {
                            type: 'spring',
                            stiffness: 250,
                        },
                    }"
                    :delay="item?.order * 200"
                    class="bg-green-400 rounded-lg"
                >
                    <div class="border-b-2 py-2">
                        <h1 class="text-lg font-bold text-center">
                            {{ $t("fields.step") }} - {{ item?.order }}
                        </h1>
                    </div>
                    <div class="p-4">
                        <h2 class="text-center font-semibold py-2">
                            {{ item.title }}
                        </h2>

                        <p class="text-justify">
                            {{ item.description }}
                        </p>
                        <div>
                            <h3 class="font-semibold">
                                {{ $t("menu.ressource.plural") }} :
                            </h3>
                            <ul>
                                <li v-for="ressource in item.ressources">
                                    {{ ressource.name }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Skills-->
                <div class="col-span-3">
                    <h3 class="font-semibold">
                        {{ $t("menu.skill.plural") }} :
                    </h3>
                    <div class="flex flex-wrap space-x-3 space-y-1">
                        <div
                            v-for="(skill, index) in careerPath.skills"
                            v-motion
                            :initial="{ opacity: 0 }"
                            :visibleOnce="{
                                opacity: 1,

                                transition: {
                                    opacity: {
                                        duration: (index + 1) * 200,
                                        delay: (index + 1) * 200,
                                    },
                                },
                            }"
                        >
                            <div
                                class="bg-blue-500 rounded-lg px-2 p-1 text-white"
                            >
                                {{ skill.name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Comment-->
            <div class="py-5 dark:text-white">
                <h1 class="font-bold">{{ $t("fields.comment") }}:</h1>
                <p class="w-full mt-4">
                    {{ careerPath?.comment }}
                </p>
            </div>
        </div>
    </DashboardLayout>
</template>
<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import AddButton from "@/Components/Buttons/AddButton.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    careerPath: {
        type: Object,
        default: null,
    },
});
</script>
