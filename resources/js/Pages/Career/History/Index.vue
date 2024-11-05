<template>
    <Head title="Career histories" />
    <DashboardLayout>
        <div class="mt-24 mx-12 px-12 bg-slate-300 rounded-lg">
            <Table :data="careerHistories.data">
                <template #header>
                    <th class="px-2 py-3 sm:px-4">#</th>
                    <th class="px-2 py-3 sm:px-4">{{ $t("fields.name") }}</th>
                    <th class="px-2 py-3 sm:px-4">
                        {{ $t("fields.description") }}
                    </th>
                    <th class="px-2 py-3 sm:px-4">
                        {{ $t("fields.start_date") }}
                    </th>
                    <th class="px-2 py-3 sm:px-4">
                        {{ $t("fields.end_date") }}
                    </th>
                    <th class="px-2 py-3 sm:px-4 flex justify-end">
                        {{ $t("views.common.actions") }}
                    </th>
                </template>
                <template #row="{ item: item }">
                    <td class="py-2 px-2 text-left sm:px-4">
                        {{ item.id }}
                    </td>
                    <td class="py-2 px-2 text-left sm:px-4">
                        {{ item.career.name }}
                    </td>
                    <td class="py-2 px-2 text-left sm:px-4">
                        {{ item.career.description }}
                    </td>
                </template>
            </Table>
            <Pagination class="mt-6" :links="careerHistories.links" />
        </div>
    </DashboardLayout>
</template>

<script setup>
import Table from "@/Components/Table.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    careerHistories: {
        type: Array,
        default: [],
    },
});
</script>
