<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-[18px] text-black leading-tight">Dashboard</h2>
        </template>


        <template #content>
            <div class="grid grid-cols-3 gap-6">
                <!-- Studes -->
                <div class="col-span-1 p-6 rounded-lg bg-white">

                </div>
                <!-- Chart -->
                <div class="col-span-2 p-6 rounded-lg bg-white"></div>
            </div>
        </template>



    </AuthenticatedLayout>
</template>


<style lang="scss">
.atiq {
    color: lightyellow;
    background: black;
}
</style>
