<template>
    <Head title="Dashboard" />

    <DashboardLayout :image_url="image_url">
        <div class="h-screen">
            <div class="p-12 grid grid-cols-3 gap-x-4 h-1/2">
                <!--Career history-->
                <BigButton
                    bg_color="bg-yellow-300"
                    @click="router.get(route('career.histories.create'))"
                    :label="$t('menu.career_histories')"
                >
                    <template #icon>
                        <InboxIcon class="h-20 w-20" />
                    </template>
                </BigButton>
                <!--Career path selected-->
                <BigButton
                    @click="handleOpenModal()"
                    bg_color="bg-green-300"
                    :label="$t('menu.reconversion_career')"
                >
                    <template #careerlabel>
                        <div
                            class="text-center text-blue-600"
                            v-if="selectedCareerName"
                        >
                            {{ selectedCareerName }} (selected)
                        </div>
                    </template>
                    <template #icon>
                        <DramaIcon class="h-20 w-20" />
                    </template>
                </BigButton>

                <!--Generate career and needed skills according to career history-->
                <div
                    class="col-span-1 w-full bg-blue-300 rounded-lg hover:cursor-pointer hover:bg-blue-500"
                    @mouseover="activateSpinAnimation"
                    @mouseleave="desactivateSpinAnimation"
                    @click="handleOpenModalGenerator()"
                >
                    <div class="w-full h-full mx-auto">
                        <button
                            class="items-center flex flex-row mx-auto h-full"
                        >
                            <SettingsIcon
                                class="h-20 w-20"
                                :class="spin_setting ? 'animate-spin' : ''"
                            />
                            <span class="text-lg">
                                {{ $t("menu.generate") }}
                            </span>
                        </button>
                    </div>
                </div>
                <SelectCareerPathModal
                    :show="showModal"
                    :careers="careers"
                    @close="handleCloseModal"
                    @selectedCareerName="getSelectedCareer"
                />

                <GeneratePathModal
                    :show="showModalGenerator"
                    @close="handleCloseModalGenerator"
                    :selectedCareerName="selectedCareerName"
                    :careerHistories="careerHistories"
                />
            </div>
        </div>
    </DashboardLayout>
</template>
<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import BigButton from "@/Components/Dashboard/BigButton.vue";
import { Head, router } from "@inertiajs/vue3";
import { DramaIcon, InboxIcon, SettingsIcon } from "lucide-vue-next";
import { ref } from "vue";
import SelectCareerPathModal from "@/Components/Modal/SelectCareerPathModal.vue";
import GeneratePathModal from "@/Components/Modal/GeneratePathModal.vue";

const props = defineProps({
    image_url: {
        type: String,
        default: "",
    },
    careers: {
        type: Object,
        default: null,
    },
    careerHistories: {
        type: Array,
        default: [],
    },
});
const spin_setting = ref(false);
const showModal = ref(false);
const showModalGenerator = ref(false);
const selectedCareerName = ref("");

const handleCloseModal = () => {
    showModal.value = false;
};
const handleOpenModal = () => {
    showModal.value = true;
};

const handleOpenModalGenerator = () => {
    showModalGenerator.value = true;
};

const handleCloseModalGenerator = () => {
    showModalGenerator.value = false;
};

function activateSpinAnimation() {
    spin_setting.value = true;
}
function desactivateSpinAnimation() {
    spin_setting.value = false;
}

function getSelectedCareer(event) {
    selectedCareerName.value = event.label;
    handleCloseModal();
}
</script>
