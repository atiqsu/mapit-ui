<script setup>
defineProps({
    studies: {
        type: Array,
        default: () => [],
    },
});

const tblCols = ["ID", "name", "Code"];

</script>

<template>

    <div>
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

</template>

<style scoped lang="scss">

</style>
