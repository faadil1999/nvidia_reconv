<template>
    <Modal :show="show" @close="handleClose">
        <form @submit.prevent="submitForm" class="h-screen">
            <FormGrid class="mt-14 lg:mt-24">
                <h1 class="col-span-full">{{ $t("menu.career_histories") }}</h1>
                <div class="col-span-full mt-5">
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
                        <template #error v-if="form.errors?.career_id">
                            {{ form.errors.career_id }}
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
                        <template #error v-if="form.errors?.start_date">
                            {{ form.errors.start_date }}
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
                        <template #error v-if="form.errors?.end_date">
                            {{ form.errors.end_date }}
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
                        <template #error v-if="form.errors?.skills">
                            {{ form.errors.skills }}
                        </template>
                    </FormInput>
                </div>
                <div>
                    <button
                        type="submit"
                        class="flex flex-row space-x-4 bg-green-500 hover:bg-green-600 text-white rounded-lg px-3 py-1"
                    >
                        <span>{{ $t("actions.save") }}</span
                        ><SaveIcon />
                    </button>
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
import { computed, ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import { SaveIcon } from "lucide-vue-next";

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
    careerHistory: {
        type: Object,
        default: null,
    },
    isEditing: {
        type: Boolean,
        default: false,
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
    career_id: props.careerHistory?.career_id ?? "",
    start_date: props.careerHistory?.start_date ?? "",
    end_date: props.careerHistory?.end_date ?? "",
    skills: props.careerHistory?.skills ?? [],
});

watch(
    () => props.careerHistory,
    () => {
        form.career_id = props.careerHistory?.career_id;
        form.start_date = props.careerHistory?.start_date;
        form.end_date = props.careerHistory?.end_date;
        form.skills = props.careerHistory?.skills.map((skill) => skill.id);
    }
);
const emit = defineEmits(["close"]);
const handleClose = () => {
    form.clearErrors();
    emit("close");
};

const submitForm = () => {
    const { careerHistory } = props;
    if (!props.isEditing) {
        form.post(route("career.histories.store"), {
            onSuccess: handleClose,
        });
    } else {
        form.post(
            route("career.histories.update", { careerHistory: careerHistory }),
            {
                onSuccess: handleClose,
            }
        );
    }
};
</script>
