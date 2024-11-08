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
            <div class="rounded-lg p-10 flex flex-col">
                <FormGrid v-for="career_history in careerHistoriesList">
                    <div
                        class="bg-slate-50 dark:bg-slate-700 col-span-6 p-8 rounded-lg mt-10"
                    >
                        <div class="flex flex-row justify-between">
                            <h1 class="font-bold col-span-6 text-lg">
                                {{ career_history.title }}
                            </h1>
                            <div class="flex flex-row space-x-2">
                                <PencilIcon
                                    class="cursor-pointer text-blue-400 hover:text-blue-600"
                                    @click="
                                        openModalSelectedCareerHisotry(
                                            career_history
                                        )
                                    "
                                />
                                <Trash2Icon
                                    @click="deleteCareerHistory(career_history)"
                                    class="cursor-pointer text-red-300 hover:text-red-500"
                                />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <FormInput disabled>
                                <template #label>
                                    {{ $t("fields.career_name") }}
                                </template>
                                <template #input="inputProps">
                                    <Select
                                        class="bg-slate-400"
                                        v-model="career_history.career_id"
                                        v-bind="inputProps"
                                        :options="careerOptions"
                                    ></Select>
                                </template>
                            </FormInput>
                        </div>

                        <div class="col-span-6 mt-2">
                            <FormInput disabled>
                                <template #label>
                                    {{ $t("fields.start_date") }}
                                </template>
                                <template #input="inputProps">
                                    <input
                                        class="bg-slate-400"
                                        v-model="career_history.start_date"
                                        type="date"
                                        v-bind="inputProps"
                                    />
                                </template>
                            </FormInput>
                        </div>

                        <div class="col-span-6 mt-2">
                            <FormInput disabled>
                                <template #label>
                                    {{ $t("fields.end_date") }}
                                </template>
                                <template #input="inputProps">
                                    <input
                                        class="bg-slate-400"
                                        type="date"
                                        v-model="career_history.end_date"
                                        v-bind="inputProps"
                                    />
                                </template>
                            </FormInput>
                        </div>
                        <!--Skills-->
                        <div class="col-span-6 mt-2">
                            <FormInput disabled>
                                <template #label>
                                    {{ $t("fields.skill.plural") }}
                                </template>
                                <template #input="inputProps">
                                    <Select
                                        class="bg-slate-400"
                                        v-model="career_history.skills"
                                        v-bind="inputProps"
                                        :options="skillOptions"
                                        multiple
                                    ></Select>
                                </template>
                            </FormInput>
                        </div>
                    </div>
                </FormGrid>
                <div class="mt-10">
                    <div
                        @click="handleOpenModal()"
                        class="bg-green-400 text-white cursor-pointer hover:bg-green-500 dark:bg-green-800 w-36 px-5 py-1 rounded-lg flex flex-row whitespace-nowrap justify-between"
                    >
                        <span>{{ $t("actions.add_career_history") }}</span>
                        <PlusIcon></PlusIcon>
                    </div>
                </div>
            </div>
        </div>
        <CareerModalForm
            :careers="careers"
            :skills="skills"
            :show="showModal"
            @close="handleCloseModal"
            :careerHistory="selected_career_history"
            :isEditing="isEditing"
        ></CareerModalForm>
    </DashboardLayout>
</template>
<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import FormGrid from "@/Components/Form/FormGrid.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import Select from "@/Components/Inputs/Select.vue";
import { router, useForm } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import { PencilIcon, PlusIcon, Trash2Icon } from "lucide-vue-next";
import CareerModalForm from "@/Components/Form/CareerModalForm.vue";

const props = defineProps({
    careers: {
        types: Array,
        default: [],
    },
    skills: {
        type: Array,
        default: [],
    },
    career_histories: {
        type: Array,
        default: [],
    },
});

const isEditing = ref(false);
const selected_career_history = ref(null);
const showModal = ref(false);
const careerOptions = computed(() =>
    props.careers.map((career) => {
        return {
            value: career.id,
            label: career.title,
        };
    })
);
const careerHistoriesList = computed(() =>
    props.career_histories.map((career_history) => {
        return {
            title: career_history.career.title,
            career_id: career_history.career_id,
            start_date: career_history.start_date,
            end_date: career_history.end_date,
            skills: career_history.skills.map((skill) => skill.id),
            original_model: career_history,
        };
    })
);

const skillOptions = computed(() =>
    props.skills.map((skill) => {
        return {
            value: skill.id,
            label: skill.name,
        };
    })
);

const handleCloseModal = () => {
    selected_career_history.value = null;
    isEditing.value = false;
    showModal.value = false;
};
const handleOpenModal = () => {
    showModal.value = true;
};

function openModalSelectedCareerHisotry(career_history) {
    selected_career_history.value = career_history.original_model;
    isEditing.value = true;
    handleOpenModal();
}

function deleteCareerHistory(career_history) {
    if (confirm("Do you really want to delele")) {
        router.delete(
            route("career.histories.delete", {
                careerHistory: career_history.original_model,
            })
        );
    }
}
</script>
