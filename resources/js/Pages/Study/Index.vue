<script setup>
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import DangerButton from "@/Components/DangerButton.vue";
import AddNewButton from "@/Components/AddNewButton.vue";
import { nextTick, ref } from "vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { useForm } from "@inertiajs/vue3";
import SubmitButton from "@/Components/SubmitButton.vue";
import ActionBtnEdit from "@/Components/ActionBtnEdit.vue";
import ActionBtnDelete from "@/Components/ActionBtnDelete.vue";
import userModalIcon from "../../../images/userModalIcon.svg";

defineProps({
    studies: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    name: "",
    code: "",
});

const editStudy = useForm({
    id: "",
    name: "",
    code: "",
});

const tblCols = ["ID", "name", "Code", "Actions"];
const modalIsVisible = ref(false);
const editModalIsVisible = ref(false);
const nameInputFocus = ref("");

const showModalForAddNew = () => {
    modalIsVisible.value = true;

    nextTick(() => nameInputFocus.value.focus());
};

const showModalForEdit = (idd) => {
    editModalIsVisible.value = true;
    editStudy.value = idd;

    console.log("wth....", idd, editStudy.value);

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
    form.post(route("studies.store"), {
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
                <h2 class="font-semibold text-[18px] text-black leading-tight">
                    List of studies
                </h2>

                <AddNewButton @click="showModalForAddNew">
                    Create
                </AddNewButton>
            </div>
        </template>

        <template #content>
            <table
                class="w-full border border-[#f3f3f7] rounded-lg"
                id="usertbl"
            >
                <thead>
                    <tr class="bg-[#f1f4f9]">
                        <th
                            v-for="col in tblCols"
                            :key="col"
                            class="text-left p-4"
                        >
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
                            <ActionBtnEdit @click="showModalForEdit(study)">
                            </ActionBtnEdit>
                            <ActionBtnDelete @click="showModalForAddNew"
                                ><i class="pi pi-trash"></i
                            ></ActionBtnDelete>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>

        <!-- Create New Study modal Here -->
        <Modal :show="modalIsVisible" @close="closeModal">
            <div class="rounded-2xl">
                <div class="p-6 pt-10 bg-white">
                    <div class="text-center mb-6">
                        <img class="mx-auto mb-5" :src="userModalIcon" alt="" />
                        <h3 class="text-[20px] font-medium text-[#1C1E38]">
                            Update project info
                        </h3>
                        <p class="text-sm text-[#5E606E]">
                            Update project details
                        </p>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm font-semibold" for="sname"
                                >Study Name</label
                            >
                            <input
                                class="block w-full focus:outline-none focus:ring focus:ring-[#4790FC] mt-3 rounded-lg bg-[#f8f9fb] border-0 p-4"
                                type="text"
                                id="sname"
                                name="sname"
                                placeholder="Dummy"
                            />
                        </div>
                        <div>
                            <label class="text-sm font-semibold" for="scode"
                                >Study Code</label
                            >
                            <input
                                class="block w-full focus:outline-none focus:ring focus:ring-[#4790FC] mt-3 rounded-lg bg-[#f8f9fb] border-0 p-4"
                                type="text"
                                id="scode"
                                name="scode"
                                placeholder="SE- 2345"
                            />
                        </div>
                        <div>
                            <label class="text-sm font-semibold"
                                >User access details</label
                            >
                            <table id="stbl" class="w-full mt-3 rounded-lg">
                                <tr>
                                    <th
                                        class="text-left text-[12px] p-3 bg-[#f8f9fb]"
                                    >
                                        User
                                    </th>
                                    <th
                                        class="text-left text-[12px] p-3 bg-[#f8f9fb]"
                                    >
                                        Access
                                    </th>
                                </tr>
                                <tr>
                                    <td class="text-[12px] p-3">Test User</td>
                                    <td class="p-3 flex items-center gap-2">
                                        <input
                                            type="checkbox"
                                            name="hasAccess"
                                            id="hasAccess1"
                                        />
                                        <label
                                            class="text-[12px]"
                                            for="hasAccess1"
                                            >HAs Access
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-[12px] p-3">Test User</td>
                                    <td class="p-3 flex items-center gap-2">
                                        <input
                                            type="checkbox"
                                            name="hasAccess"
                                            id="hasAccess2"
                                        />
                                        <label
                                            class="text-[12px]"
                                            for="hasAccess2"
                                            >HAs Access
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="bg-[#F8F9FB] p-6 flex items-center justify-end">
                    <button
                        class="border border-[#E9E9EC] bg-white py-2 px-3 font-medium text-[12px] rounded-xl mr-4"
                    >
                        Cencel
                    </button>
                    <button
                        class="bg-[#4790FC] hover:opacity-[0.8] duration-300 py-2 px-3 font-medium text-[12px] rounded-xl border border-[#E9E9EC] text-white"
                    >
                        Save
                    </button>
                </div>
            </div>
        </Modal>

        <!-- Edit on table modal Here -->
        <Modal :show="editModalIsVisible" @close="closeModal">
            <div>
                <div class="p-6 pt-10 bg-white text-black">
                    <img class="mx-auto mb-4" :src="userModalIcon" alt="" />
                    <h2 class="text-lg font-medium text-center">
                        Update project info
                    </h2>

                    <p
                        class="mt-1 text-sm text-gray-600 dark:text-gray-400"
                    ></p>

                    <div class="mt-6">
                        <InputLabel
                            for="name"
                            value="Study name"
                            class="sr-only"
                        />

                        <TextInput
                            id="name"
                            ref="nameInputFocus"
                            v-model="form.name"
                            class=""
                            placeholder="Study name..."
                        />

                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <InputLabel
                            for="code"
                            value="Study code"
                            class="sr-only"
                        />

                        <TextInput
                            id="code"
                            v-model="form.code"
                            class=""
                            placeholder="Study code..."
                        />

                        <InputError :message="form.errors.code" class="mt-2" />
                    </div>
                </div>
                <div class="bg-[#f8f9fb] p-6 flex items-center justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

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
#usertbl {
    tr:nth-child(even) {
        td {
            background-color: #f1f4f9 !important;
        }
    }
}

#stbl {
    border: 1px solid #f8f9fb;
    border-collapse: collapse;

    th,
    td {
        border: 1px solid #f8f9fb;
    }
}
</style>
