<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AddNewButton from "@/Components/AddNewButton.vue";
import { nextTick, ref } from "vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { useForm } from "@inertiajs/vue3";
import SubmitButton from "@/Components/SubmitButton.vue";
import ActionBtnEdit from "@/Components/ActionBtnEdit.vue";
import userModalIcon from "../../../images/userModalIcon.svg";
import CancelButton from "@/Components/CancelButton.vue";
import ActionBtnActive from "@/Components/ActionBtnActive.vue";
import {assignedUserIds} from '@/helper.js';

const props = defineProps({
    studies: {
        type: Array,
        default: () => [],
    },
    users: {
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
const assignedUsers = ref([]);

assignedUsers.value = props.users;

const populateAssignedUsers = (assigned) => {

    assignedUsers.value.map(user => {

        user.hasAccess = false;

        if(assigned) {

            const found = assigned.find(element => element.id === user.id);

            if(found) {
                user.hasAccess = true;
            }
        }
    });
};



const showModalForAddNew = () => {
    modalIsVisible.value = true;

    //extTick(() => nameInputFocus.value.focus());
};

const showModalForEdit = (std) => {

    editModalIsVisible.value = true;

    editStudy.id = std.id;
    editStudy.name = std.name;
    editStudy.code = std.code;

    populateAssignedUsers(std.users);

    //nextTick(() => nameInputFocus.value.focus());
};

const closeModal = () => {
    modalIsVisible.value = false;
    editModalIsVisible.value = false;
    form.reset();
    editStudy.reset();
};


const createProject = () => {
    form.
        transform((data) => ({
            ...data,
            users: assignedUserIds(props.users),
        }))
        .post(route("studies.store"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => nameInputFocus.value.focus(),
        onFinish: () => form.reset(),
    });
};

const updateProject = () => {

    editStudy.
        transform((data) => ({
            ...data,
            users: assignedUserIds(props.users)
        }))
        .put(route("studies.update",editStudy.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => {

        },
        onFinish: () => editStudy.reset(),
    });

}

const toggleAssigned = (user) => {

    if (assignedUsers.value.includes(user.id)) {
        assignedUsers.value = assignedUsers.value.filter(id => id !== user.id);
    } else {
        assignedUsers.value.push(user.id);
    }
}
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
                            <ActionBtnEdit @click="showModalForEdit(study)" />

                            <ActionBtnActive status="1" />
                        </td>
                    </tr>
                </tbody>
            </table>


<!--            <pre>{{ assignedUserIds(assignedUsers) }}</pre>-->
<!--            <pre>{{ assignedUsers }}</pre>-->


        </template>

        <!-- Create New Study modal Here -->
        <Modal :show="modalIsVisible" @close="closeModal">
            <div class="rounded-2xl">
                <div class="p-6 pt-10 bg-white">
                    <div class="text-center mb-6">
                        <img class="mx-auto mb-5" :src="userModalIcon" alt="" />
                        <h3 class="text-[20px] font-medium text-[#1C1E38]">
                            Create project
                        </h3>
                        <p class="text-sm text-[#5E606E]">project details</p>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="text-sm font-semibold" for="sname">
                                Study Name
                            </label>
                            <input
                                class="block w-full focus:outline-none focus:ring focus:ring-[#4790FC] mt-3 rounded-lg bg-[#f8f9fb] border-0 p-4"
                                type="text"
                                v-model="form.name"
                                id="sname"
                                name="sname"
                                placeholder="Dummy"
                            />
                        </div>
                        <div>
                            <label class="text-sm font-semibold" for="scode">
                                Study Code
                            </label>
                            <input
                                class="block w-full focus:outline-none focus:ring focus:ring-[#4790FC] mt-3 rounded-lg bg-[#f8f9fb] border-0 p-4"
                                type="text"
                                v-model="form.code"
                                id="scode"
                                name="scode"
                                placeholder="SE- 2345"
                            />
                        </div>
                        <div>
                            <label class="text-sm font-semibold">
                                User access details
                            </label>
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

                                <tr v-for="user in users" :key="user.id">
                                    <td class="text-[12px] p-3">
                                        {{ user.name }}
                                    </td>
                                    <td class="p-3 flex items-center gap-2">
                                        <input
                                            type="checkbox"
                                            v-model="user.hasAccess"
                                            name="hasAccess"
                                            id="hasAccess1"
                                        />
                                        <label
                                            class="text-[12px]"
                                            for="hasAccess1"
                                        >
                                            Has Access
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="bg-[#F8F9FB] p-6 flex items-center justify-end">

                    <CancelButton @click="closeModal"> Cancel </CancelButton>

                    <SubmitButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="createProject"
                    >
                        Create
                    </SubmitButton>
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

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"></p>

                    <div class="mt-6">
                        <InputLabel
                            for="name"
                            value="Study name"
                            class="sr-only"
                        />

                        <TextInput
                            id="name"
                            ref="nameInputFocus"
                            v-model="editStudy.name"
                            class=""
                            placeholder="Study name..."
                        />

                        <InputError :message="editStudy.errors.name" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <InputLabel
                            for="code"
                            value="Study code"
                            class="sr-only"
                        />

                        <TextInput
                            id="code"
                            v-model="editStudy.code"
                            :readonly="true"
                            :disabled="true"
                            placeholder="Study code..."
                        />

                        <InputError :message="editStudy.errors.code" class="mt-2" />
                    </div>
                    <div class="mt-6">
                        <label class="text-sm font-semibold">
                            User access details
                        </label>
                        <table id="stbl" class="w-full mt-3 rounded-lg">
                            <tr>
                                <th class="text-left text-[12px] p-3 bg-[#f8f9fb]" >
                                    User
                                </th>
                                <th class="text-left text-[12px] p-3 bg-[#f8f9fb]" >
                                    Access
                                </th>
                            </tr>

                            <tr v-for="user in assignedUsers" :key="user.id">
                                <td class="text-[12px] p-3">
                                    {{ user.name }}
                                </td>
                                <td class="p-3 flex items-center gap-2">
                                    <input
                                        type="checkbox"
                                        :value="user.id"
                                        v-model="user.hasAccess"
                                    />
                                    <label class="text-[12px]" for="hasAccess1">
                                        Has Access
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="bg-[#f8f9fb] p-6 flex items-center justify-end">
                    <CancelButton @click="closeModal">
                        Cancel
                    </CancelButton>

                    <SubmitButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="updateProject"
                    >
                        Save
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
