<script setup>
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';

defineProps({
    studies: {
        type: Array,
        default: () => [],
    },
});

const tblCols = ["ID", "name", "Code"];

</script>

<template>


    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Study</h2>
        </template>


        <div class="py-12">
            <table>
                <thead>
                <tr>
                    <th v-for="col in tblCols" :key="col">
                        {{ col }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="study in studies" :key="study.id">
                    <td>{{ study.name }}</td>
                    <td>{{ study.code }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>




</template>

<style scoped lang="scss">

</style>
