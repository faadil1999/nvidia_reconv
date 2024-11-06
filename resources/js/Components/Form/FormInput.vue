<template>
    <div>
        <label
            v-if="$slots.label"
            :for="id"
            class="mb-1 h-4 block text-xs text-zinc-800 font-medium first-letter:uppercase whitespace-nowrap"
        >
            <slot name="label" />
            <span v-if="required" class="text-red-500">{{ " *" }}</span>
        </label>

        <div
            class="relative rounded-lg flex items-center gap-2 text-sm"
            :class="{
                'border border-zinc-300 focus-within:border-yellow-600 rounded-lg ':
                    !noBorder,
                'bg-white': !disabled,
                'bg-neutral-100': disabled,
            }"
        >
            <div
                v-if="$slots['before-input']"
                class="ms-2 text-xs text-zinc-800/50 whitespace-nowrap"
                @click="focusInput()"
            >
                <slot name="before-input" />
            </div>
            <slot
                name="input"
                :id="id"
                :ref="setRef"
                :required="required"
                :disabled="disabled"
                class="outline-none border-0 rounded-lg w-full"
            />
            <div
                v-if="$slots['after-input']"
                class="me-2 text-xs text-zinc-800/50 whitespace-nowrap"
                @click="focusInput()"
            >
                <slot name="after-input" />
            </div>
        </div>

        <FormError v-if="$slots.error || error">
            <slot name="error">
                {{ error }}
            </slot>
        </FormError>
    </div>
</template>

<script setup>
import { ref } from "vue";
import FormError from "@/Components/Form/FormError.vue";

const props = defineProps({
    modelValue: {
        type: [Number, String],
        default: () => "",
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    required: {
        type: [Boolean, Number],
        default: false,
    },
    error: {
        type: String,
        default: () => null,
    },
    noBorder: {
        type: Boolean,
        default: () => false,
    },
});

const id = (Math.random() + 1).toString(36).substring(2);
const inputRef = ref();

defineExpose({
    focus: () => inputRef.value?.focus?.(),
    blur: () => inputRef.value?.blur?.(),
});

function setRef(element) {
    if (element) {
        inputRef.value = element;
    }
}

function focusInput() {
    inputRef.value?.focus?.();
}
</script>
