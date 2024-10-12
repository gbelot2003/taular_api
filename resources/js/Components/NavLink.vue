<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'flex w-11/12 items-center px-4 py-2 border-l-4 border-purple-600 text-sm font-semibold text-purple-900 bg-purple-100 shadow-sm transition duration-200 ease-in-out'
        : 'flex w-11/12 items-center px-4 py-2 border-l-4 border-transparent text-sm font-medium text-gray-500 hover:text-purple-700 hover:bg-purple-50 hover:border-purple-400 transition duration-200 ease-in-out';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
