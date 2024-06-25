<script setup>
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import DangerButton from '@/Components/DangerButton.vue';
import AddNewButton from '@/Components/AddNewButton.vue';
import {nextTick, ref} from 'vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import {useForm} from '@inertiajs/vue3';
import SubmitButton from '@/Components/SubmitButton.vue';
import ActionBtnEdit from '@/Components/ActionBtnEdit.vue';
import ActionBtnDelete from '@/Components/ActionBtnDelete.vue';
import editIcon from '../../../images/edit.svg'

defineProps({
    studies: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    name: '',
    code: '',
});

const editStudy = useForm({
    id: '',
    name: '',
    code: '',
});




const tblCols = ["ID", "name", "Code", "Actions"];
const modalIsVisible = ref(false);
const editModalIsVisible = ref(false);
const nameInputFocus = ref('');

const showModalForAddNew = () => {
    modalIsVisible.value = true;

    nextTick(() => nameInputFocus.value.focus());
};

const showModalForEdit = (idd) => {

    editModalIsVisible.value = true;
    editStudy.value = idd;

    console.log('wth....', idd, editStudy.value);


    // axios.get(route('studies.edit', idd), { studyId: idd})
    //       .then(function (response) {
    //
    //     console.log(response);
    // })
    //       .catch(function (error) {
    //     // handle error
    //     console.log(error);
    // })
    //       .finally(function () {
    //     // always executed
    // });

    //nextTick(() => nameInputFocus.value.focus());
};

const closeModal = () => {
    modalIsVisible.value = false;
    editModalIsVisible.value = false;
    form.reset();
    editStudy.reset();
};

const createProject = () => {
    form.post(route('studies.store'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => nameInputFocus.value.focus(),
        onFinish: () => form.reset(),
    });
};

</script>

<template>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center pb-6">
                <h2 class="font-semibold text-[18px] text-black leading-tight">Default Study
                    Configuration
                </h2>

                <AddNewButton @click="showModalForAddNew">+ Add new</AddNewButton>
            </div>

        </template>

        <template #content>


            <table class="w-full border border-[#f3f3f7] rounded-lg">
                <thead>
                    <tr class="bg-[#f1f4f9]">
                        <th v-for="col in tblCols" :key="col" class="text-left p-4">
                            {{ col }}
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="study in studies" :key="study.id">
                        <td class="p-4">{{ study.id }}</td>
                        <td class="p-4">{{ study.name }}</td>
                        <td class="p-4">{{ study.code }}</td>
                        <td class="p-4 flex items-center gap-3">
                            <ActionBtnEdit @click="showModalForEdit(study.id)">
                                <img class="w-[16px]" :src="editIcon" alt="">
                            </ActionBtnEdit>
                            <ActionBtnDelete @click="showModalForAddNew"><i class="pi pi-trash
"></i></ActionBtnDelete>
                        </td>
                    </tr>
                </tbody>
            </table>

        </template>



        <Modal :show="modalIsVisible" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Are you sure ...................
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                </p>

                <div class="mt-6">
                    <InputLabel for="name" value="Study name" class="sr-only" />

                    <TextInput id="name" ref="nameInputFocus" v-model="form.name" class="mt-1 block w-3/4"
                        placeholder="Study name..." />

                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="mt-6">
                    <InputLabel for="code" value="Study code" class="sr-only" />

                    <TextInput id="code" v-model="form.code" class="mt-1 block w-3/4" placeholder="Study code..." />

                    <InputError :message="form.errors.code" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <SubmitButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="createProject">
                        Create
                    </SubmitButton>
                </div>
            </div>
        </Modal>



        <Modal :show="editModalIsVisible" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Update project info
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                </p>

                <div class="mt-6">
                    <InputLabel for="name" value="Study name" class="sr-only" />

                    <TextInput
                        id="name"
                        ref="nameInputFocus"
                        v-model="form.name"
                        class="mt-1 block w-3/4"
                        placeholder="Study name..."
                    />

                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div class="mt-6">
                    <InputLabel for="code" value="Study code" class="sr-only" />

                    <TextInput
                        id="code"
                        v-model="form.code"
                        class="mt-1 block w-3/4"
                        placeholder="Study code..."
                    />

                    <InputError :message="form.errors.code" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <SubmitButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="createProject"
                    >
                        Create
                    </SubmitButton>
                </div>
            </div>
        </Modal>


    </AuthenticatedLayout>


</template>

<style scoped lang="scss">

table {
    tr:nth-child(even) {
       
            td {
                background-color: #f1f4f9 !important;
            }
        
    }
}
</style>
