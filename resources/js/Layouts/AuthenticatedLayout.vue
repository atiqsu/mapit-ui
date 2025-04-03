<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import "primeicons/primeicons.css";
import { computed } from "vue";

const showingNavigationDropdown = ref(false);

const isActive = ref(1);

const activeLinkStyle = computed(
    () =>
        `after:absolute after:content-[""] after:right-[-20px] after:bottom-0 after:top-0 after:w-0 after:h-0
    after:border-l-[20px] after:border-l-[#fdd0d3] after:border-t-[25px] after:border-t-[transparent]
    after:border-b-[25px] after:border-b-[transparent] before:absolute before:content-[""] before:bottom-0
    before:left-0 before:w-0 before:h-0 before:border-l-[20px] before:border-l-[#f6f6f6] before:border-t-[25px]
    before:border-t-[transparent] before:border-b-[25px] before:border-b-[transparent] font-semibold py-3 px-8 pl-[50px]`
);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="flex">
                <!-- Left Side Navigation Bar -->
                <nav
                    class="fixed top-0 left-0 bg-[#c12f30] p-[21px] border-b border-gray-100 dark:border-gray-700 h-full w-[256px]"
                >
                    <!-- Vertical Navigation Menu -->
                    <div
                        class="w-full h-full flex flex-col justify-between relative"
                    >
                        <div>
                            <!-- Logo -->
                            <div class="mb-5">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo class="bg-white" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden flex-col gap-6 pt-6 sm:flex">
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    <i class="pi pi-objects-column"></i>
                                    Dashboard
                                </NavLink>
                                <NavLink>
                                    <i class="pi pi-ticket"></i>
                                    Projects
                                </NavLink>
                                <NavLink>
                                    <i class="pi pi-users"></i>
                                    Users
                                </NavLink>
                                <NavLink>
                                    <i class="pi pi-th-large"></i>
                                    Rules
                                </NavLink>
                                <NavLink>
                                    <i class="pi pi-chart-bar"></i>
                                    Report
                                </NavLink>
                                <NavLink>
                                    <i class="pi pi-cog"></i>
                                    Setting
                                </NavLink>
                                <NavLink>
                                    <i class="pi pi-power-off"></i>
                                    Logout
                                </NavLink>
                            </div>
                        </div>
                        <!--  Bottom Box -->
                        <div
                            class="bg-[#E06F77] rounded text-white text-center rounded-lg relative"
                        >
                            <div class="relative p-3 z-50">
                                <span
                                    class="absolute top-[-20px] bg-[#C12F30] p-3 rounded-full text-lg font-bold w-[37px] h-[37px] flex items-center justify-center mx-auto right-0 left-0 border border-white border-[5px] text-white"
                                >
                                    <i class="pi pi-question"></i>
                                </span>
                                <h3 class="pt-5 pb-16 text-xl">Help Center</h3>
                                <a
                                    class="bg-white text-[#C12F30] w-full px-3 py-2 rounded-lg block font-semibold"
                                    href
                                    >Documentation</a
                                >
                            </div>
                            <div
                                class="absolute overflow-hidden top-0 right-0 bottom-0 left-0 rounded-lg z-0"
                            >
                                <span
                                    class="absolute top-[-20%] left-[-20%] w-[130px] h-[130px] bg-[#e27a80] rounded-full"
                                ></span>
                                <span
                                    class="absolute bottom-[-20%] right-[-20%] w-[120px] h-[120px] bg-[#e27a80] rounded-full"
                                ></span>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div
                        :class="{
                            block: showingNavigationDropdown,
                            hidden: !showingNavigationDropdown,
                        }"
                        class="sm:hidden"
                    >
                        <div class="pt-2 pb-3 space-y-1">
                            <ResponsiveNavLink
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                            >
                                Dashboard</ResponsiveNavLink
                            >
                        </div>

                        <!-- Responsive Settings Options -->
                        <div
                            class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600"
                        >
                            <div class="px-4">
                                <div
                                    class="font-medium text-base text-gray-800 dark:text-gray-200"
                                >
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">
                                    {{ $page.props.auth.user.email }}
                                </div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <ResponsiveNavLink
                                    :href="route('profile.edit')"
                                >
                                    Profile
                                </ResponsiveNavLink>
                                <ResponsiveNavLink
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </ResponsiveNavLink>
                            </div>
                        </div>
                    </div>
                </nav>

                <div class="w-full bg-white ps-[256px]">
                    <!-- Top Header -->
                    <div
                        class="bg-white w-full shadow border-b h-[fit-content] py-5 text-black"
                    >
                        <header>
                            <div
                                class="hidden sm:flex sm:items-center px-5 justify-between items-center"
                            >
                                <!-- Top header left side Content -->
                                <div
                                    class="flex items-center bg-[#f6f6f6] relative after:absolute after:content-[''] after:right-[-20px] after:bottom-0 after:top-0 after:w-0 after:h-0 after:border-l-[20px] after:border-l-[#f6f6f6] after:border-t-[25px] after:border-t-[transparent] after:border-b-[25px] after:border-b-[transparent]"
                                >
                                    <Link class="py-3 px-8">
                                        <i class="pi pi-home"></i>
                                        Dashboard
                                    </Link>
                                    <Link
                                        class="py-3 px-8 relative bg-[#fdd0d3] text-[#c12f30]"
                                        :class="{
                                            [activeLinkStyle]: (isActive = 1),
                                        }"
                                    >
                                        Admin
                                    </Link>
                                    <Link class="py-3 px-8"> Rules </Link>
                                </div>
                                <!-- Top header right side Content -->
                                <div class="flex items-center gap-3">
                                    <!-- Notification Button -->
                                    <div>
                                        <button
                                            class="bg-white shadow p-3 rounded relative z-0"
                                        >
                                            <div class="relative w-6">
                                                <img
                                                    src="../../images/notify-icon.png"
                                                    alt
                                                />
                                                <div
                                                    class="absolute top-0 right-0 w-3 h-3 border border-white border-[3px] bg-[#db3336] rounded-full z-50"
                                                ></div>
                                            </div>
                                        </button>
                                    </div>
                                    <!-- Settings Dropdown -->
                                    <div class="relative">
                                        <Dropdown align="right" width="48">
                                            <template #trigger>
                                                <span
                                                    class="inline-flex rounded-md"
                                                >
                                                    <button
                                                        type="button"
                                                        class="flex items-center gap-3 px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 focus:outline-none transition ease-in-out duration-150"
                                                    >
                                                        <span>
                                                            <img
                                                                class="w-12"
                                                                src="../../images/profile.webp"
                                                                alt
                                                            />
                                                        </span>
                                                        <span
                                                            class="flex flex-col"
                                                        >
                                                            <span
                                                                class="text-left font-bold text-black text-[18px] capitalize"
                                                            >
                                                                {{
                                                                    $page.props
                                                                        .auth
                                                                        .user
                                                                        .name
                                                                }}
                                                            </span>
                                                            <span>
                                                                {{
                                                                    $page.props
                                                                        .auth
                                                                        .user
                                                                        .email
                                                                }}
                                                            </span>
                                                        </span>

                                                        <svg
                                                            class="ms-2 -me-0.5 h-4 w-4"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 20 20"
                                                            fill="currentColor"
                                                        >
                                                            <path
                                                                fill-rule="evenodd"
                                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"
                                                            />
                                                        </svg>
                                                    </button>
                                                </span>
                                            </template>

                                            <template #content>
                                                <DropdownLink
                                                    :href="
                                                        route('profile.edit')
                                                    "
                                                    >Profile</DropdownLink
                                                >
                                                <DropdownLink
                                                    :href="route('logout')"
                                                    method="post"
                                                    as="button"
                                                    >Log Out
                                                </DropdownLink>
                                            </template>
                                        </Dropdown>
                                    </div>
                                </div>
                            </div>
                        </header>
                    </div>

                    <!-- Page Content -->
                    <main class="bg-white p-6">
                        <div>
                            <slot name="header" />

                            <slot name="content" />
                        </div>

                        <div>
                            <slot />
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>
