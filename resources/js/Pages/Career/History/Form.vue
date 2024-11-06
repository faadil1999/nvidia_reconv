<template>
    <Head title="Career histories" />
    <DashboardLayout>
        <template #currentPage>
            <div>
                <h1>
                    {{ $t("menu.career_histories") }} >
                    {{ $t("actions.create") }}
                </h1>
            </div>
        </template>
        <div class="px-12">
            <div class="bg-slate-500">
                <FormGrid>
                    <div class="col-span-6">
                        <FormInput>
                            <template #label>
                                {{ $t("fields.career_name") }}
                            </template>
                            <template #input="inputProps">
                                <Select
                                    v-model="form.career_histories.career_id"
                                    v-bind="inputProps"
                                    :options="careers"
                                ></Select>
                            </template>
                        </FormInput>
                    </div>

                    <div class="col-span-6">
                        <FormInput>
                            <template #label>
                                {{ $t("fields.start_date") }}
                            </template>
                            <template #input="inputProps">
                                <input
                                    v-model="form.career_histories.start_date"
                                    type="date"
                                    v-bind="inputProps"
                                />
                            </template>
                        </FormInput>
                    </div>

                    <div class="col-span-6">
                        <FormInput>
                            <template #label>
                                {{ $t("fields.end_date") }}
                            </template>
                            <template #input="inputProps">
                                <input
                                    type="date"
                                    v-model="form.career_histories.end_date"
                                    v-bind="inputProps"
                                />
                            </template>
                        </FormInput>
                    </div>
                </FormGrid>
            </div>
        </div>
    </DashboardLayout>
</template>
<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import FormGrid from "@/Components/Form/FormGrid.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import Select from "@/Components/Inputs/Select.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    careers: {
        types: Array,
        default: [],
    },
});

const form = useForm({
    career_histories: {
        career_id: "",
        start_date: "",
        end_date: "",
    },
});
</script>
