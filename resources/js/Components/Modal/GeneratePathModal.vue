<template>
    <Modal :show="show" @close="handleClose">
        <div
            class="h-screen bg-white dark:bg-slate-600 text-white p-10 rounded-lg"
        >
            <h1 class="text-lg font-bold text-center">Resume</h1>
            <div v-for="career_h in careerHistories" class="mt-6">
                <div
                    class="p-2 w-full border-2 border-gray-400 rounded-tl-lg rounded-tr-lg font-bold text-center text-green-500"
                >
                    {{ career_h.career.title }}
                </div>
                <div class="p-2 w-full border-2 border-gray-400">
                    <p class="flex flex-row space-x-1">
                        <span v-for="skill in career_h.skills"
                            >{{ skill.name }},
                        </span>
                    </p>
                </div>
            </div>
            <div class="text-center my-10">Convert TO</div>
            <div>
                <h1 class="text-center font-bold text-lg text-blue">
                    {{ selectedCareerName }}
                </h1>
            </div>
            <div>
                <button
                    class="bg-blue-500 px-4 rounded-lg py-1 flex flex-row space-x-3 mx-auto mt-11"
                    @click="generate()"
                    type=""
                    @mouseover="activateSpinAnimation"
                    @mouseleave="desactivateSpinAnimation"
                >
                    <span> generate </span>
                    <CogIcon :class="spin_setting ? 'animate-spin' : ''" />
                </button>
            </div>
        </div>
    </Modal>
</template>
<script setup>
import Modal from "../Modal.vue";
import FormGrid from "@/Components/Form/FormGrid.vue";
import FormInput from "@/Components/Form/FormInput.vue";
import Select from "@/Components/Inputs/Select.vue";
import { computed, ref } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import { CogIcon, GrabIcon, SaveIcon, Trash, TrashIcon } from "lucide-vue-next";
import axios from "axios";

const props = defineProps({
    careerHistories: {
        type: Array,
        default: [],
    },
    selectedCareerName: {
        type: String,
        default: "",
    },
});

const spin_setting = ref(false);
function activateSpinAnimation() {
    spin_setting.value = true;
}
function desactivateSpinAnimation() {
    spin_setting.value = false;
}

const content_request = computed(() => {
    let resultat = props.careerHistories
        .map((objet) => {
            const skillsNames = objet.skills
                .map((skill) => skill.name)
                .join(", ");

            return `I was ${objet.career.title} and i have these skills: ${skillsNames}`;
        })
        .join(" and ");
    let request = `${resultat} now i want to be ${props.selectedCareerName}.Based on previous careers and skills Give me the steps i need to reach my goals and also the ressources i need for each step `;

    return request;
});

async function generate() {
    try {
        const response = await axios.post("chat-response", {
            content: content_request.value,
        });

        // Une fois la requête réussie, vous pouvez naviguer
        Inertia.visit(route("dashboard")); // Rediriger vers une autre page
    } catch (error) {
        console.error("Erreur lors de la requête POST", error);
    }
}
</script>
