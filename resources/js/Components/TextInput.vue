<template>
    <textarea
        v-if="type === 'textarea'"
        v-model="inputValue"
        v-bind="$attrs"
        ref="inputRef"
        class="outline-none rounded-lg p-3 w-full block"
        @click.stop
    />
    <input
        v-else
        v-model="inputValue"
        v-bind="$attrs"
        ref="inputRef"
        :type="type"
        class="outline-none rounded-lg p-3 w-full"
        @click.stop
    />
</template>

<script setup>
import { computed, ref } from "vue";

const props = defineProps({
    modelValue: {
        type: [Number, String],
        default: () => "",
    },
    type: {
        type: String,
        default: "text",
        validator: (value) =>
            ["email", "tel", "text", "textarea", "password", "search"].includes(
                value
            ),
    },
});

const emit = defineEmits(["update:modelValue"]);

const inputRef = ref();

defineExpose({
    focus: () => inputRef.value?.focus(),
    blur: () => inputRef.value?.blur(),
});

const inputValue = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});
</script>
