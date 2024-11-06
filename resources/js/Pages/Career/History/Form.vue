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
            <div class="bg-slate-300 rounded-lg p-10 flex flex-col">
                <FormGrid v-for="career_history in careerHistoriesList">
                    <h1 class="font-bold col-span-6 text-lg">
                        {{ career_history.title }}
                    </h1>
                    <div class="col-span-6">
                        <FormInput disabled>
                            <template #label>
                                {{ $t("fields.career_name") }}
                            </template>
                            <template #input="inputProps">
                                <Select
                                    v-model="career_history.career_id"
                                    v-bind="inputProps"
                                    :options="careerOptions"
                                ></Select>
                            </template>
                        </FormInput>
                    </div>

                    <div class="col-span-6">
                        <FormInput disabled>
                            <template #label>
                                {{ $t("fields.start_date") }}
                            </template>
                            <template #input="inputProps">
                                <input
                                    v-model="career_history.start_date"
                                    type="date"
                                    v-bind="inputProps"
                                />
                            </template>
                        </FormInput>
                    </div>

                    <div class="col-span-6">
                        <FormInput disabled>
                            <template #label>
                                {{ $t("fields.end_date") }}
                            </template>
                            <template #input="inputProps">
                                <input
                                    type="date"
                                    v-model="career_history.end_date"
                                    v-bind="inputProps"
                                />
                            </template>
                        </FormInput>
                    </div>
                    <!--Skills-->
                    <div class="col-span-6">
                        <FormInput disabled>
                            <template #label>
                                {{ $t("fields.skill.plural") }}
                            </template>
                            <template #input="inputProps">
                                <Select
                                    v-model="career_history.skills"
                                    v-bind="inputProps"
                                    :options="skillOptions"
                                    multiple
                                ></Select>
                            </template>
                        </FormInput>
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
        ></CareerModalForm>
    </DashboardLayout>
</template>
<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import FormGrid from "@/Components/Form/FormGrid.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import Select from "@/Components/Inputs/Select.vue";
import { useForm } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import { PlusIcon } from "lucide-vue-next";
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

const nbr_career = ref(1);
const selected_career = ref(0);
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

const form = useForm({
    career_histories: [
        {
            career_id: "",
            start_date: "",
            end_date: "",
            skills: [],
        },
    ],
});

const itemsTableRef = ref();

const handleCloseModal = () => {
    showModal.value = false;
};
const handleOpenModal = () => {
    showModal.value = true;
};
</script>
