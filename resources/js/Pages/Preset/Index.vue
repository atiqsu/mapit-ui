<script setup>
import {nextTick, ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import MultiSelect from "primevue/multiselect";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Select from 'primevue/select';

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
        type: Array,
        default: () => {
            return {
                types_option: ["abc", "b22", "c55", "f55"],
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
            };
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

const tblCols            = ["ID", "name", "Code", "Actions"];
const modalIsVisible     = ref(false);
const editModalIsVisible = ref(false);
const nameInputFocus     = ref("");

const showModalForAddNew = () => {
    modalIsVisible.value = true;

    nextTick(() => nameInputFocus.value.focus());
};

const showModalForEdit = (idd) => {
    editModalIsVisible.value = true;
    editStudy.value          = idd;

    console.log("wth....", idd, editStudy.value);

    //nextTick(() => nameInputFocus.value.focus());
};

const closeModal = () => {
    modalIsVisible.value     = false;
    editModalIsVisible.value = false;
    form.reset();
    editStudy.reset();
};

const createProject = () => {
    form.transform((data) => ({
        ...data,
        users: data.remember ? "on" : "",
    })).post(route("studies.store"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => nameInputFocus.value.focus(),
        onFinish: () => form.reset(),
    });
};

const opt = ["dsfgds", "dkkks", "dsfgg"];

const cities = ref([
    "dfhgfgh",
    "jkjk",
    "wew"
]);
const selectedCities = ref([]);
const selectedCity = ref();

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
                <table>
                    <tr>
                        <td>
                            <h4 class="text-[24px] text-black">Preset type:</h4>
                        </td>
                        <td>

                            <div class="card flex justify-center">
                                <Select v-model="selectedCity"
                                        :options="cities"
                                        placeholder="Select a City"
                                        class="w-full md:w-56" />
                            </div>

                            <div class="card flex justify-center">
                                <MultiSelect v-model="selectedCities" :options="cities"  filter placeholder="Select Cities"
                                             :maxSelectedLabels="3" class="w-full md:w-80" />
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
