<template>
    <Multiselect
        v-model="inputValue"
        :can-clear="canClear"
        :can-deselect="canClear"
        :classes="multiSelectStyle"
        :delay="typeof options === 'function' ? 0 : undefined"
        :label="label"
        :min-chars="2"
        :mode="multiple ? 'tags' : 'single'"
        noOptionsText="Aucun résultat dans la liste"
        noResultsText="Aucun résultat ne correspond"
        :options="options"
        :placeholder="placeholder"
        :searchable="searchable"
        :value-prop="valueProp"
        @search-change="$emit('search', $event)"
        @select="$emit('change', $event)"
        @deselect="$emit('change', $event)"
        @clear="$emit('clear')"
    />
</template>
<script setup>
import Multiselect from "@vueform/multiselect";
import multiSelectStyle from "@/multiSelectDefaultTheme.ts";
import { computed } from "vue";

const props = defineProps({
    canClear: {
        type: Boolean,
        default: true,
    },
    modelValue: {
        type: [Array, Number, null, String],
        required: true,
    },
    label: {
        type: String,
    },
    multiple: {
        type: Boolean,
        default: false,
    },
    options: {
        type: [Array, Function, Object],
        default: [],
    },
    placeholder: {
        type: String,
        default: null,
    },
    searchable: {
        default: true,
    },
    valueProp: {
        type: String,
        default: "value",
    },
});

const emit = defineEmits(["update:modelValue", "change", "clear", "search"]);

const inputValue = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});
</script>
