<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap justify-center -mb-1 pagination">
            <template v-for="(link, k) in links" :key="k">
                <Link
                    class="mr-1 mb-1 py-2 px-3 text-sm leading-5 border rounded"
                    :class="[
                        link.active
                            ? 'bg-red-300 hover:bg-red-600 text-theme-primary-light focus:border-white focus:text-white activePagination'
                            : 'bg-white focus:border-red-500 focus:text-red-500',
                    ]"
                    :href="link.url"
                    ><span class="h-4">{{ link.label }}</span></Link
                >
            </template>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    links: Array,
});
</script>
