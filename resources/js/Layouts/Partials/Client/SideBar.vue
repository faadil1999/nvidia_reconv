<template>
    <div>
        <!-- Sidebar backdrop (mobile only) -->
        <div
            class="fixed inset-0 bg-gray-900/30 z-40 lg:hidden lg:z-auto transition-opacity"
            :class="
                sidebarExpanded
                    ? 'opacity-100'
                    : 'opacity-0 pointer-events-none'
            "
            aria-hidden="true"
        ></div>

        <!-- Sidebar -->
        <div
            id="sidebar"
            ref="sidebar"
            class="transition-all fixed lg:static left-0 inset-y-0 z-40 transform -translate-x-full sidebar-expanded:translate-x-0 lg:translate-x-0 bg-theme-secondary-light dark:bg-theme-secondary-dark shrink-0 h-screen w-full lg:w-20 lg:sidebar-expanded:!w-60 2xl:!w-60 flex flex-col overflow-x-hidden overflow-y-auto"
        >
            <!-- Sidebar header -->
            <div class="relative flex items-center justify-center p-4">
                <!-- Logo -->
                <a :href="route('dashboard')" class="max-w-xs">
                    <ApplicationLogoSideBar
                        :image_url="image_url"
                        class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200 h"
                    />
                </a>

                <button
                    ref="trigger"
                    aria-controls="sidebar"
                    :aria-expanded="sidebarExpanded"
                    class="absolute top-5 right-5 lg:hidden text-white"
                    @click.stop="close()"
                >
                    <span class="sr-only">Close sidebar</span>
                    <XIcon class="w-10" />
                </button>
            </div>

            <!-- Links -->
            <ul class="grow space-y-0.5">
                <!-- Tabs -->
                <li
                    v-for="tab in tabs"
                    :key="tab.name"
                    class="transition-colors px-14 lg:px-8 py-3 rounded-sm text-gray-200 hover:text-white max-lg:text-xl font-medium"
                    :class="{
                        'bg-white/10': tab.selected,
                        'hover:bg-white/5 ': !tab.selected,
                    }"
                >
                    <a
                        v-if="!tab.children?.length"
                        :href="tab.route"
                        class="transition truncate hover:text-red-500 dark:hover:text-yellow-500 text-theme-primary-dark dark:text-theme-primary-light"
                        :class="{ 'font-semibold': tab.selected }"
                        @click.stop="close()"
                    >
                        <div
                            class="flex items-center lg:justify-center lg:sidebar-expanded:justify-start 2xl:justify-start gap-3"
                        >
                            <component
                                class="shrink-0 w-4 h-4"
                                :is="tab.icon"
                            />
                            <div
                                class="lg:hidden lg:sidebar-expanded:block 2xl:block"
                            >
                                {{ $t(tab.name) }}
                            </div>
                        </div>
                    </a>
                    <SidebarLinkGroup
                        v-else
                        #default="parentLink"
                        :activeCondition="
                            tab.children.some((child) => child.selected)
                        "
                        @click="sidebarExpanded = true"
                    >
                        <a
                            href="#"
                            class="transition w-full truncate text-start"
                            :class="{ 'font-semibold': tab.selected }"
                            @click.prevent="
                                sidebarExpanded
                                    ? parentLink.toggle()
                                    : parentLink.open()
                            "
                            @click.stop="close()"
                        >
                            <div
                                class="flex items-center lg:justify-center lg:sidebar-expanded:justify-start 2xl:justify-start gap-2"
                            >
                                <component
                                    class="shrink-0 w-4 h-4"
                                    :is="tab.icon"
                                />
                                <div
                                    class="grow lg:hidden lg:sidebar-expanded:block 2xl:block"
                                >
                                    {{ $t(tab.name) }}
                                </div>
                                <svg
                                    class="lg:hidden lg:sidebar-expanded:block 2xl:block shrink-0 w-3 h-3 fill-current"
                                    :class="
                                        parentLink.expanded &&
                                        'transform rotate-180'
                                    "
                                    viewBox="0 0 12 12"
                                >
                                    <path
                                        d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z"
                                    />
                                </svg>
                            </div>
                        </a>
                        <div
                            class="lg:hidden lg:sidebar-expanded:block 2xl:block"
                        >
                            <ul
                                class="mt-1 pl-9 space-y-1"
                                :class="!parentLink.expanded && 'hidden'"
                            >
                                <li
                                    v-for="tabChild in tab.children"
                                    :key="tabChild.name"
                                >
                                    <a
                                        :href="tabChild.route"
                                        class="transition block truncate"
                                        :class="{
                                            'text-blue-500 font-semibold ':
                                                tabChild.selected,
                                        }"
                                    >
                                        {{ $t(tabChild.name) }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </SidebarLinkGroup>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import SidebarLinkGroup from "@/Components/Client/SiderbarLinkGroup.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import ApplicationLogoSideBar from "@/Components/ApplicationLogoSideBar.vue";
import {
    XIcon,
    ChartBarIcon,
    FolderIcon,
    ShareIcon,
    InboxIcon,
    HomeIcon,
    BotIcon,
} from "lucide-vue-next";
import { usePage } from "@inertiajs/vue3";
import { computed, onMounted, onUnmounted, ref, watch } from "vue";

const emit = defineEmits(["closeSidebar", "toggleSidebar"]);
const props = defineProps({
    sidebarOpen: {
        type: Boolean,
        defaul: false,
    },
    image_url: {
        type: String,
        default:
            "http://nvidia_reconv.test/storage/images/logo_nvidia_reconv.png",
    },
});

const trigger = ref(null);
const sidebar = ref(null);
const storedSidebarExpanded = localStorage.getItem("sidebar-expanded");
const sidebarExpanded = ref(
    storedSidebarExpanded === null
        ? props.sidebarOpen ?? false
        : storedSidebarExpanded === "true"
);

const tabs = computed(() => {
    const user = usePage().props.auth.user;
    const routes = [];

    routes.push({
        name: "dashboard",
        route: route("dashboard"),
        icon: HomeIcon,
        selected: route().current("dashboard"),
    });

    routes.push({
        name: "Career histories",
        route: route("career.histories.create"),
        icon: InboxIcon,
        selected: route().current("career.histories.*"),
    });

    routes.push({
        name: "Career path",
        route: route("generated.career.path.index"),
        icon: BotIcon,
        selected: route().current("generated.career.path.*"),
    });

    return routes;
});

// close on click outside
const clickHandler = ({ target }) => {
    if (!sidebar.value || !trigger.value) return;
    if (
        !sidebarExpanded.value ||
        sidebar.value.contains(target) ||
        trigger.value.contains(target)
    )
        return;
    close();
};
// close if the esc key is pressed
const keyHandler = ({ keyCode }) => {
    if (!sidebarExpanded.value || keyCode !== 27) return;
    close();
};

// close function
const close = () => {
    sidebarExpanded.value = false;
    emit("closeSidebar");
};

watch(
    () => props.sidebarOpen,
    () => {
        if (sidebarExpanded.value != props.sidebarOpen) {
            sidebarExpanded.value = props.sidebarOpen;
        }
    },
    { deep: true }
);

watch(sidebarExpanded, () => {
    localStorage.setItem("sidebar-expanded", sidebarExpanded.value);
    document
        .querySelector("body")
        .classList.toggle("sidebar-expanded", sidebarExpanded.value);
});

onMounted(() => {
    document
        .querySelector("body")
        .classList.toggle("sidebar-expanded", sidebarExpanded.value);
    document.addEventListener("click", clickHandler);
    document.addEventListener("keydown", keyHandler);
});

onUnmounted(() => {
    document.removeEventListener("click", clickHandler);
    document.removeEventListener("keydown", keyHandler);
});
</script>
