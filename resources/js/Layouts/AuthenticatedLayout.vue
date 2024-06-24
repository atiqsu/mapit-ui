<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import 'primeicons/primeicons.css'

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="flex">
                <!-- Left Side Navigation Bar -->
                <nav
                    class="fixed top-0 left-0 bg-[#c12f30] p-[21px] border-b border-gray-100 dark:border-gray-700 h-[100vh] w-[256px]"
                >
                    <!-- Vertical Navigation Menu -->
                    <div class="w-full">
                        <div>
                            <div class="">
                                <!-- Logo -->
                                <div class=" w-[80%] mb-5">
                                    <Link :href="route('dashboard')">
                                        <ApplicationLogo class="bg-white" />
                                    </Link>
                                </div>

                                <!-- Navigation Links -->
                                <div class="hidden sm:flex ">
                                    <NavLink
                                        :href="route('dashboard')"
                                        :active="route().current('dashboard')"
                                    >
                                        <i class=" pi pi-objects-column"></i>
                                        Dashboard
                                    </NavLink>
                            
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
                                Dashboard
                            </ResponsiveNavLink>
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

                <div class="w-full bg-[#f9f9fb] ps-[256px]">
                    <!-- Top Header -->
                    <div
                        class="bg-white shadow w-full h-[fit-content] py-5 text-black"
                    >
                        <header>
                            <div
                                class="hidden sm:flex sm:items-center px-5 justify-between items-center"
                            >
                                <!-- Top header left side Content -->
                                <div>
                                    <h3 class="text-2xl font-bold">
                                        SDTM Autamation
                                    </h3>
                                    <p class="text-slate-400">
                                        Focused on metadata driven processes
                                    </p>
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
                                                    alt=""
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
                                                                alt=""
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
                                                                }}</span
                                                            >
                                                            <span>
                                                                {{
                                                                    $page.props
                                                                        .auth
                                                                        .user
                                                                        .email
                                                                }}</span
                                                            >
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
                                                >
                                                    Profile
                                                </DropdownLink>
                                                <DropdownLink
                                                    :href="route('logout')"
                                                    method="post"
                                                    as="button"
                                                >
                                                    Log Out
                                                </DropdownLink>
                                            </template>
                                        </Dropdown>
                                    </div>
                                </div>
                            </div>
                        </header>
                    </div>

                    <!-- Page Content -->
                    <main class="p-10 text-black h-[90vh]">
                        <div class="bg-white shadow p-10">Content Here</div>
                        <div class="bg-white shadow p-10 mt-10">
                            Content Here
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>
