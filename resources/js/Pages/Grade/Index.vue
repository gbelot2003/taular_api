<!-- Cursos.vue -->
<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import Pagination from '../../Components2/Pagination.vue';
import Modal from '../../Components/Modal.vue'; // Asegúrate de que la ruta sea correcta
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { ref, watch } from "vue";
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    cursos: Object,
    filters: Object
});

let search = ref(props.filters.search);
let showModal = ref(false);

watch(search, value => {
    router.get('/cursos', { search: value }, { preserveState: true });
});

const openModal = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};

const createCurso = (formData) => {
    router.post('/cursos', formData, {
        onSuccess: () => {
            closeModal();
        },
    });
};
</script>

<template>
    <Head title="Administración de Cursos" />
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Administración de Cursos</h2>
        </template>

        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-6">Administración de Cursos</h1>

            <div class="flex flex-col md:flex-row md:justify-between items-center mb-6">
                <button @click="openModal" class="bg-blue-950 text-white py-2 px-4 rounded-full hover:bg-blue-800 transition duration-300">
                    Nuevo <span class="mdi mdi-plus-circle-outline"></span>
                </button>
                <input type="text" class="mt-4 md:mt-0 w-full md:w-1/2 p-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500" v-model="search" placeholder="Buscar..." />
            </div>

            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-lg shadow-lg">
                    <thead class="bg-blue-400 text-white">
                        <tr>
                            <th class="p-3 text-left">Nombre</th>
                            <th class="p-3 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="curso in cursos.data" :key="curso.id" class="border-b border-gray-200 hover:bg-gray-100 transition duration-300">
                            <td class="p-3">{{ curso.nombre }}</td>
                            <td class="p-3 flex items-center space-x-2">
                                <Link :href="`cursos/${curso.id}/edit`" class="bg-blue-700 text-white px-3 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                                    Editar
                                </Link>
                                <Link :href="`cursos/${curso.id}`" class="bg-red-800 text-white px-3 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                                    Ver
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <Pagination :links="cursos.links" class="mt-6" />
        </div>

        <!-- Modal para crear un nuevo grado -->
        <Modal :show="showModal" @close="closeModal">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Crear Nuevo Grado</h2>
                <form @submit.prevent="createCurso({ nombre: form.nombre })">
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="nombre" v-model="form.nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required />
                    </div>
                    <!-- Otros campos del formulario -->
                    <div class="flex justify-end">
                        <button type="button" @click="closeModal" class="mr-2 px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Cancelar</button>
                        <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-600 rounded-md hover:bg-blue-700">Guardar</button>
                    </div>
                </form>
            </div>
        </Modal>
    </AppLayout>
</template>

<style scoped>
@media (min-width: 640px) {
    table {
        display: inline-table !important;
    }

    thead tr:not(:first-child) {
        display: none;
    }
}

td:not(:last-child) {
    border-bottom: 0;
}

th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, .1);
}
</style>
