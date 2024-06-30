<script setup>
import { nextTick, ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import MultiSelect from "primevue/multiselect";
import Select from "primevue/select";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AddNewButton from "@/Components/AddNewButton.vue";
import SubmitButton from "@/Components/SubmitButton.vue";
import CancelButton from "@/Components/CancelButton.vue";

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

const form = useForm({
    name: "",
    code: "",
});

const editStudy = useForm({
    id: "",
    name: "",
    code: "",
});

const preset = ref({
    types_option: ["abc", "b22", "c55", "f55", "hgvui"],
    name: "my name",
    cols_option: ["abc", "b22", "c55", "f55"],
    cols_val: ["c55", "f55"],
    filter_option: ["abc", "b22", "c55", "f55"],
    sheets_option: {
        sheet1: ["col1", "col2", "col3"],
        sheet2: ["col19", "col2", "col31"],
        sheet3: ["col1", "col22", "col36"],
        sheet4: ["col1", "col23", "col3"],
        sheet5: ["col1", "col0", "col3"],
        sheet6: ["filed", "var", "sdtm"],
    },
});

const selectedPresetTypes = ref([]);
const selectedPreserveCols = ref([]);
const selectedFilterOption = ref([]);
const selectedSheetRelation = ref(null);
const selectedSheetCols = ref([]);
const selectedSheetRelation2 = ref(null);
const selectedSheetCols2 = ref([]);

// Delete action in preserve cols
const handleDeleteCols = (ind) => {
    selectedPreserveCols.value.splice(ind, 1);
};

// Delete action in filter options
const handleDeleteFilterOption = (ind) => {
    selectedFilterOption.value.splice(ind, 1);
};

// Get All Key On Sheets_option
const sheetOptions = Object.keys(preset.value.sheets_option);

// Change Sheet Relation Data
const updateSheetRelation = () => {
    selectedSheetCols.value =
        preset.value.sheets_option[selectedSheetRelation.value] || [];
};

const updateSheetRelation2 = () => {
    selectedSheetCols2.value =
        preset.value.sheets_option[selectedSheetRelation2.value] || [];
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center pb-6">
                <h2 class="font-semibold text-[18px] text-black leading-tight">
                    New Preset
                </h2>
            </div>
        </template>

        <template #content>
            <div class="border p-10 rounded-xl">
                <table class="space-y-7">
                    <tr class="flex items-start gap-5">
                        <td class="text-right w-[200px]">
                            <h4 class="text-[24px] text-black">Preset type:</h4>
                        </td>
                        <td class="flex items-center gap-4">
                            <div class="card bg-white flex justify-center">
                                <Select
                                    v-model="selectedPresetTypes"
                                    multiselect.disabled.background
                                    :options="preset.types_option"
                                    filter
                                    placeholder="Select Preset Types"
                                    class="w-full md:w-52 bg-white"
                                />
                            </div>
                            <input
                                class="w-full md:w-52 rounded border-[#e5e7eb] hover:border-[#94a3b8]"
                                :value="preset.name"
                                type="text"
                            />
                        </td>
                    </tr>
                    <tr class="flex items-start gap-5">
                        <td class="text-right w-[200px]">
                            <h4 class="text-[24px] text-black">
                                Preserve col:
                            </h4>
                        </td>
                        <td>
                            <div class="card bg-white flex">
                                <MultiSelect
                                    v-model="selectedPreserveCols"
                                    :options="preset.cols_option"
                                    filter
                                    placeholder="Select Preserve col"
                                    :maxSelectedLabels="3"
                                    class="w-full md:w-52 bg-white"
                                />
                            </div>
                            <ul class="flex items-center gap-4 mt-6">
                                <li
                                    v-for="(
                                        selectedPreserveCol, index
                                    ) in selectedPreserveCols"
                                    :key="index"
                                    class="w-full md:w-52 rounded py-2 px-3 border border-[#e5e7eb] hover:border-[#94a3b8] flex items-center justify-between"
                                >
                                    {{ selectedPreserveCol }}
                                    <Button
                                        @click="handleDeleteCols(index)"
                                        class="px-1 py-1 dark:bg-[#e5e7eb] border-0 dark:text-slate-400 bg-transparent dark:hover:bg-[#e5e7eb] rounded-full w-3 h-3 flex items-center justify-center hover:text-slate-600 focus:ring-0 focus:ring-offset-0"
                                    >
                                        <i
                                            class="pi pi-times-circle text-[0.5rem]"
                                        ></i>
                                    </Button>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr class="flex items-start gap-5">
                        <td class="text-right w-[200px]">
                            <h4 class="text-[24px] text-black">Filter:</h4>
                        </td>
                        <td>
                            <div class="card bg-white flex">
                                <MultiSelect
                                    v-model="selectedFilterOption"
                                    :options="preset.filter_option"
                                    filter
                                    placeholder="Select Filter Option"
                                    :maxSelectedLabels="3"
                                    class="w-full md:w-52 bg-white"
                                />
                            </div>
                            <ul class="flex items-center gap-4 mt-6">
                                <li
                                    v-for="(
                                        selectedFilters, index
                                    ) in selectedFilterOption"
                                    :key="index"
                                    class="w-full md:w-52 rounded py-2 px-3 border border-[#e5e7eb] hover:border-[#94a3b8] flex items-center justify-between"
                                >
                                    {{ selectedFilters }}
                                    <Button
                                        @click="handleDeleteFilterOption(index)"
                                        class="px-1 py-1 dark:bg-[#e5e7eb] border-0 dark:text-slate-400 bg-transparent dark:hover:bg-[#e5e7eb] rounded-full w-3 h-3 flex items-center justify-center hover:text-slate-600 focus:ring-0 focus:ring-offset-0"
                                    >
                                        <i
                                            class="pi pi-times-circle text-[0.5rem]"
                                        ></i>
                                    </Button>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr class="flex items-start gap-5">
                        <td class="text-right w-[200px]">
                            <h4 class="text-[24px] text-black">
                                Sheet Relation:
                            </h4>
                        </td>
                        <td class="space-y-4">
                            <div class="flex items-center gap-4">
                                <div class="card bg-white flex justify-center">
                                    <Select
                                        v-model="selectedSheetRelation"
                                        :options="sheetOptions"
                                        filter
                                        placeholder="Sheet"
                                        class="w-full md:w-52 bg-white"
                                        @change="updateSheetRelation"
                                    />
                                </div>
                                <div class="card bg-white flex justify-center">
                                    <Select
                                        v-model="selectedSheetCols"
                                        :options="selectedSheetCols"
                                        filter
                                        placeholder="Columns"
                                        class="w-full md:w-52 bg-white"
                                    />
                                </div>
                                <p>
                                    <i
                                        class="pi pi-arrow-right text-slate-500"
                                    ></i>
                                </p>
                                <div class="card bg-white flex justify-center">
                                    <Select
                                        v-model="selectedSheetRelation2"
                                        :options="sheetOptions"
                                        filter
                                        placeholder="Sheet"
                                        class="w-full md:w-52 bg-white"
                                        @change="updateSheetRelation2"
                                    />
                                </div>
                                <div class="card bg-white flex justify-center">
                                    <Select
                                        v-model="selectedSheetCols2"
                                        :options="selectedSheetCols2"
                                        filter
                                        placeholder="Columns"
                                        class="w-full md:w-52 bg-white"
                                    />
                                </div>
                                <AddNewButton />
                            </div>
                            <div class="flex items-center gap-4">
                                <SubmitButton style="margin-left: 0 !important"
                                    >Save</SubmitButton
                                >
                                <CancelButton>Close</CancelButton>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </template>
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
