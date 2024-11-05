<template>
    <transition
        enter-active-class="transition ease-out duration-200 transform"
        enter-from-class="opacity-0 -translate-y-2"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition ease-in duration-500"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div v-if="flash != null && display" class="w-[75%]">
            <div
                :class="'px-4 py-3 my-2 rounded relative ' + classes"
                role="alert"
            >
                <span class="block sm:inline"> {{ flash }} </span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg
                        @click="toggle()"
                        class="fill-current h-6 w-6 text-gray-500"
                        role="button"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"
                        />
                    </svg>
                </span>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";

const display = ref(false);

let timer = 0;

const props = defineProps({
    flash: {
        type: String,
        default: null,
    },
    name: {
        type: String,
        default: "message",
    },
});

const classes = computed(() => {
    switch (props.name) {
        case "message":
            return "bg-blue-200 border border-blue-400 text-blue-700";
            break;
        case "success":
            return "bg-green-200 border border-green-400 text-green-700";
            break;
        case "warning":
            return "bg-orange-200 border border-orange-400 text-orange-700";
            break;
        case "error":
            return "bg-red-200 border border-red-400 text-red-700";
            break;
        default:
            return "bg-blue-200 border border-blue-400 text-blue-700";
            break;
    }
});

function toggle() {
    clearInterval(timer);
    display.value = false;
    delete usePage().props.flash[props.name];
}

onMounted(() => {
    display.value = true;
    timer = setInterval(() => toggle(), 5000);
});
</script>
