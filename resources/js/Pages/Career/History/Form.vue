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
                <form @submit.prevent="submitForm">
                    <FormGrid v-for="i in nbr_career">
                        <div class="col-span-6">
                            <FormInput>
                                <template #label>
                                    {{ $t("fields.career_name") }}
                                </template>
                                <template #input="inputProps">
                                    <Select
                                        v-model="
                                            form.career_histories.career_id
                                        "
                                        v-bind="inputProps"
                                        :options="careerOptions"
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
                                        v-model="
                                            form.career_histories.start_date
                                        "
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
                        <!--Skills-->
                        <div class="col-span-6">
                            <FormInput>
                                <template #label>
                                    {{ $t("fields.skill.plural") }}
                                </template>
                                <template #input="inputProps">
                                    <Select
                                        v-model="form.career_histories.skills"
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
                </form>
                {{ form }}
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

function addCareer(career) {
    itemsTableRef.value?.add({
        career_id: career.career_id,
        start_date: career.start_date,
        end_date: career.end_date,
        skills: career.skills,
    });
}
const submitForm = () => {
    form.post(route("career.histories.store"));
};

const handleCloseModal = () => {
    showModal.value = false;
};
const handleOpenModal = () => {
    showModal.value = true;
};
</script>
