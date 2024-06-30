<script setup>
import { nextTick, ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Fieldset from "primevue/fieldset";
import TextInput from "@/Components/TextInput.vue";
import Select from "primevue/select";
import SubmitButton from "@/Components/SubmitButton.vue";
import CancelButton from "@/Components/CancelButton.vue";
import ActionBtnActive from "@/Components/ActionBtnActive.vue";
import ActionBtnDelete from "@/Components/ActionBtnDelete.vue";
import Paginator from "primevue/paginator";

const props = defineProps({
    studies: {
        type: Array,
        default: () => [],
    },
    users: {
        type: Array,
        default: () => [],
    },
    preset: {
        type: Object,
        default: () => {
            return {};
        },
    },
});

const fileName = ref("");
const filetypes = ref(["Type 1", "type 2", "Type 3", "Type 4"]);
const selectedFileTypes = ref("");

// Clear Action
const handleClearAction = () => {
    fileName.value = "";
    selectedFileTypes.value = "";
};

const form = useForm({
    name: "",
    code: "",
});

const editStudy = useForm({
    id: "",
    name: "",
    code: "",
});
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="pb-6">
                <Fieldset legend="Filters">
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <label
                                class="text-2xl text-black w-[105px]"
                                for="fileName"
                            >
                                File name
                            </label>
                            <TextInput
                                v-model="fileName"
                                class="w-52"
                                placeholder="ABC"
                                id="fileName"
                            />
                        </div>
                        <div class="flex items-center gap-4">
                            <label
                                class="text-2xl text-black w-[105px]"
                                for="fileType "
                            >
                                File type
                            </label>
                            <div class="card">
                                <Select
                                    id="fileType"
                                    v-model="selectedFileTypes"
                                    :options="filetypes"
                                    placeholder="File type"
                                    class="w-full md:w-52 p-2"
                                />
                            </div>
                            <SubmitButton> Search </SubmitButton>
                            <CancelButton @click="handleClearAction">
                                Clear
                            </CancelButton>
                        </div>
                    </div>
                </Fieldset>
            </div>
        </template>

        <template #content>
            <div>
                <table class="w-full" id="usertbl">
                    <tr>
                        <th>#</th>
                        <th>File</th>
                        <th>Date</th>
                        <th>By</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Als.bxh</td>
                        <td>01.01.2024</td>
                        <td>Atiq</td>
                        <td>
                            <button class="bg-[#dfe6f3] rounded py-2 px-5">
                                Active
                            </button>
                        </td>
                        <td class="flex items-center gap-4">
                            <ActionBtnActive /> <ActionBtnDelete />
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Bls.bxh</td>
                        <td>02.01.2024</td>
                        <td>Shrabon</td>
                        <td>
                            <button class="bg-[#dfe6f3] rounded py-2 px-5">
                                Active
                            </button>
                        </td>
                        <td class="flex items-center gap-4">
                            <ActionBtnActive /> <ActionBtnDelete />
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Cls.bxh</td>
                        <td>03.01.2024</td>
                        <td>Akash</td>
                        <td>
                            <button class="bg-[#dfe6f3] rounded py-2 px-5">
                                Active
                            </button>
                        </td>
                        <td class="flex items-center gap-4">
                            <ActionBtnActive /> <ActionBtnDelete />
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Dls.bxh</td>
                        <td>04.01.2024</td>
                        <td>Hello</td>
                        <td>
                            <button class="bg-[#dfe6f3] rounded py-2 px-5">
                                Active
                            </button>
                        </td>
                        <td class="flex items-center gap-4">
                            <ActionBtnActive /> <ActionBtnDelete />
                        </td>
                    </tr>
                </table>
                <div class="card w-fit ms-auto pagination mt-4">
                    <Paginator
                        :template="{
                            default:
                                'FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink JumpToPageDropdown JumpToPageInput',
                        }"
                        :rows="10"
                        :totalRecords="120"
                    >
                    </Paginator>
                </div>
                <SubmitButton class="ms-0 py-4 px-6 text-[20px] capitalize">
                    Upload New
                </SubmitButton>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
#usertbl {
    border: 1px solid #f8f9fb;

    th {
        text-align: left;
        padding: 20px 10px;
        background-color: #f1f4f9 !important;
    }

    td {
        padding: 0px 10px;
        min-height: 80px;
    }

    tr:nth-child(odd) {
        td {
            background-color: #f1f4f9 !important;
        }
    }
}
</style>
