<template>
    <Modal :show="show" @close="handleClose">
        <form @submit.prevent="submitForm" class="h-screen">
            <FormGrid class="mt-14 lg:mt-24">
                <div class="col-span-full">
                    <FormInput>
                        <template #label>
                            {{ $t("fields.career_name") }}
                        </template>
                        <template #input="inputProps">
                            <Select
                                v-model="form.career_id"
                                v-bind="inputProps"
                                :options="careerOptions"
                            ></Select>
                        </template>
                    </FormInput>
                </div>

                <div class="col-span-full">
                    <FormInput>
                        <template #label>
                            {{ $t("fields.start_date") }}
                        </template>
                        <template #input="inputProps">
                            <input
                                v-model="form.start_date"
                                type="date"
                                v-bind="inputProps"
                            />
                        </template>
                    </FormInput>
                </div>

                <div class="col-span-full">
                    <FormInput>
                        <template #label>
                            {{ $t("fields.end_date") }}
                        </template>
                        <template #input="inputProps">
                            <input
                                type="date"
                                v-model="form.end_date"
                                v-bind="inputProps"
                            />
                        </template>
                    </FormInput>
                </div>
                <!--Skills-->
                <div class="col-span-full">
                    <FormInput>
                        <template #label>
                            {{ $t("fields.skill.plural") }}
                        </template>
                        <template #input="inputProps">
                            <Select
                                v-model="form.skills"
                                v-bind="inputProps"
                                :options="skillOptions"
                                multiple
                            ></Select>
                        </template>
                    </FormInput>
                </div>
            </FormGrid>
        </form>
    </Modal>
</template>
<script setup>
import Modal from "../Modal.vue";
import FormGrid from "@/Components/Form/FormGrid.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import Select from "@/Components/Inputs/Select.vue";
import { computed, ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    show: {
        type: Boolean,
        required: true,
    },
    careers: {
        types: Array,
        default: [],
    },
    skills: {
        type: Array,
        default: [],
    },
});

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
    career_id: "",
    start_date: "",
    end_date: "",
    skills: [],
});
</script>
