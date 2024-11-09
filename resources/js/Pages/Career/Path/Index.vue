<template>
    <Head title="Career path" />
    <DashboardLayout>
        <template #currentPage>
            <div class="px-28 pt-8 text-lg text-black dark:text-white">
                <h1>{{ $t("menu.career_path") }}</h1>
            </div>
        </template>

        <div class="px-8 mx-12 mt-14 flex flex-col items-end min-h-screen">
            <div class="mt-4 w-full bg-slate-300 dark:bg-slate-700 rounded-lg">
                <Table :data="careerPaths">
                    <template #header>
                        <th class="px-2 py-3 sm:px-4">#</th>
                        <th class="px-2 py-3 sm:px-4">
                            {{ $t("fields.name") }}
                        </th>
                        <th class="px-2 py-3 sm:px-4">
                            {{ $t("fields.introduction") }}
                        </th>
                        <th class="px-2 py-3 sm:px-4 flex justify-end">
                            {{ $t("views.common.actions") }}
                        </th>
                    </template>
                    <template #row="{ item: item }">
                        <td class="py-2 px-2 text-left sm:px-4">
                            {{ item.id }}
                        </td>
                        <td
                            class="py-2 px-2 text-left sm:px-4 font-bold text-blue-400"
                        >
                            {{ item.career?.title }}
                        </td>
                        <td class="py-2 px-2 text-left sm:px-4">
                            {{ item.introduction }}
                        </td>
                        <td
                            class="py-2 px-2 text-left sm:px-4 flex flex-row space-x-2"
                        >
                            <button
                                class="px-2 py-1 text-white bg-blue-400 rounded-lg flex flex-row space-x-2 hover:bg-blue-600"
                                @click="
                                    router.get(
                                        route('generated.career.path.show', {
                                            careerPath: item,
                                        })
                                    )
                                "
                            >
                                <p>
                                    {{ $t("actions.show") }}
                                </p>
                                <EyeIcon />
                            </button>

                            <button
                                class="px-2 py-1 text-white bg-red-400 rounded-lg flex flex-row space-x-2 hover:bg-red-600"
                                @click="deleteCareerPath(item)"
                            >
                                <p>
                                    {{ $t("actions.delete") }}
                                </p>
                                <Trash2Icon />
                            </button>
                        </td>
                    </template>
                </Table>
            </div>
        </div>
    </DashboardLayout>
</template>

<script setup>
import Table from "@/Components/Table.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import AddButton from "@/Components/Buttons/AddButton.vue";
import { router } from "@inertiajs/vue3";
import { EyeIcon, Trash2Icon } from "lucide-vue-next";

const props = defineProps({
    careerPaths: {
        type: Array,
        default: [],
    },
});

function deleteCareerPath(item) {
    if (confirm("Do want to delete this career path ?")) {
        router.delete(
            route("generated.career.path.delete", {
                careerPath: item,
            })
        );
    }
}
</script>
