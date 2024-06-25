<script setup>

import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'bg-[#E06F77] text-white w-full transition duration-150 ease-in-out flex items-center gap-3 capitaliezed font-semibold p-3 rounded' : 'transition duration-150 ease-in-out flex items-center gap-3 capitaliezed text-white'
);


</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
