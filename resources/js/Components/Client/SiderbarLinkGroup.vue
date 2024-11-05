<template>
    <div>
        <slot
            :expanded="expanded"
            :open="open"
            :close="close"
            :toggle="toggle"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps(["activeCondition"]);

const expanded = ref(props.activeCondition);

function open() {
    expanded.value = true;
}
function close() {
    expanded.value = false;
}
function toggle() {
    expanded.value = !expanded.value;
}
</script>
