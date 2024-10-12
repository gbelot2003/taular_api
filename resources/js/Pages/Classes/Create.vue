<template>
    <div class="container mx-auto py-8">
      <h1 class="text-2xl font-bold mb-4">Crear Clase</h1>
      <form @submit.prevent="submitForm">
        <div class="mb-4">
          <label class="block text-gray-700">Nombre de la Clase</label>
          <input v-model="form.name" type="text" class="form-input mt-1 block w-full" />
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Maestro</label>
          <select v-model="form.teacher_id" class="form-select mt-1 block w-full">
            <option v-for="teacher in teachers" :key="teacher.id" :value="teacher.id">{{ teacher.name }}</option>
          </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
          Crear Clase
        </button>
      </form>
    </div>
  </template>

  <script setup>
  import { useForm } from '@inertiajs/vue3';

  const props = defineProps({
    teachers: Array,
  });

  const form = useForm({
    name: '',
    teacher_id: '',
  });

  const submitForm = () => {
    form.post(route('classes.store'));
  };
  </script>
