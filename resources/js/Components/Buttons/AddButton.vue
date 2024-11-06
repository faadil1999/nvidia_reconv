<template>
    <div
        class="flex flex-row space-x-2 p-4 bg-green-400 hover:bg-green-600 text-theme-secondary-light cursor-pointer rounded-lg w-24 h-5 items-center"
    >
        <span>{{ $t("actions.add") }}</span> <PlusIcon />
    </div>
</template>
<script setup>
import { PlusIcon } from "lucide-vue-next";
</script>
