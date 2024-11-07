<template>
    <Modal :show="show" @close="handleClose">
        <FormGrid class="py-10 lg:py-14">
            <h1 class="col-span-full text-lg text-white">
                {{ $t("components.modal.dashboard.choose_new_career") }}
            </h1>
            <div class="col-span-full">
                <FormInput>
                    <template #label>
                        <p class="">
                            {{ $t("fields.career_name") }}
                        </p>
                    </template>
                    <template #input="inputProps">
                        <Select
                            v-model="selectedCareer"
                            v-bind="inputProps"
                            :options="careerOptions"
                        ></Select>
                    </template>
                </FormInput>
            </div>
            <div class="flex flex-row space-x-3">
                <button
                    type="button"
                    @click="selectCareer()"
                    class="flex flex-row space-x-4 bg-green-500 hover:bg-green-600 text-white rounded-lg px-3 py-1"
                >
                    <span>{{ $t("actions.select") }}</span>
                    <GrabIcon />
                </button>
                <button
                    type="button"
                    @click="clearCareer()"
                    class="flex flex-row space-x-4 bg-red-500 hover:bg-red-600 text-white rounded-lg px-3 py-1"
                >
                    <span>{{ $t("actions.clear") }}</span>
                    <TrashIcon />
                </button>
            </div>
        </FormGrid>
    </Modal>
</template>
<script setup>
import Modal from "../Modal.vue";
import FormGrid from "@/Components/Form/FormGrid.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import Select from "@/Components/Inputs/Select.vue";
import { computed, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { GrabIcon, SaveIcon, Trash, TrashIcon } from "lucide-vue-next";

const props = defineProps({
    show: {
        type: Boolean,
        required: true,
    },
    careers: {
        types: Array,
        default: [],
    },
});

const selectedCareer = ref(0);
const emit = defineEmits(["selectedCareerName"]);
const careerOptions = computed(() =>
    props.careers.map((career) => {
        return {
            value: career.id,
            label: career.title,
        };
    })
);

function selectCareer() {
    var selectCareer = careerOptions.value.find(
        (object) => object.value == selectedCareer.value
    );
    emit("selectedCareerName", selectCareer);
}

function clearCareer() {
    selectedCareer.value = null;
    emit("selectedCareerName", { label: "" });
}
</script>
