<script setup>
defineProps({
    status: {
        type: String,
        default: '1',  // 0 | 1
    },
});
</script>

<template>
    <button class="">

        <i class="pi pi-trash"></i>
        <i class="pi pi-pen-to-square text-[#60a5fa] text-[16px]"></i>

        <slot />
    </button>
</template>
