<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard555</h2>
        </template>


        <template #content>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">ddfgfdgdf</h2>
        </template>



    </AuthenticatedLayout>
</template>


<style lang="scss">
.atiq {
    color: lightyellow;
    background: black;
}
</style>
