<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    status: {
        type: String,
        default: '1',  // 0 | 1
    },
});
</script>

<template>
    <button class="text-[#43A37E]">
        <i v-if="status == '1'" class="pi pi-check-circle"></i>
        <i v-else class="pi pi-circle"></i>
        <slot />
    </button>
</template>
