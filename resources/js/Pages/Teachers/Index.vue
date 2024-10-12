// resources/js/Pages/Teachers/Index.vue
<template>
    <div>
        <h1 class="text-2xl font-bold">Teachers List</h1>
        <!-- Render the teachers data -->
        <ul>
            <li v-for="teacher in teachers" :key="teacher.id">{{ teacher.name }}</li>
        </ul>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    teachers: Array,
});
</script>
