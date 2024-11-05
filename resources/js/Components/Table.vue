<template>
    <table class="w-full table table-auto">
        <!-- Table header -->
        <thead>
            <tr
                class="border-b-2 text-zinc-800/50 dark:text-theme-secondary-light text-left font-semibold text-xs"
            >
                <slot name="header"></slot>
            </tr>
        </thead>
        <!-- Table body -->
        <tbody>
            <!-- Row -->
            <tr
                v-for="(item, index) in data"
                :key="index"
                class="border-t text-center"
            >
                <slot name="row" :item="item" :key="index">
                    <td>
                        {{ item }}
                    </td>
                </slot>
            </tr>
            <tr v-if="data.length <= 0" class="text-center">
                <slot name="empty-table-row">
                    <td colspan="100%">
                        {{ $t("components.table.nothing_to_display") }}
                    </td>
                </slot>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
defineProps({
    data: {
        type: Array,
        required: true,
    },
});
</script>
