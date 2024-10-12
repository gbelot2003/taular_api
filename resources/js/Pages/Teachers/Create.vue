<template>
    <div class="container mx-auto py-8">
      <h1 class="text-2xl font-bold mb-4">Crear Maestro</h1>
      <form @submit.prevent="submitForm">
        <div class="mb-4">
          <label class="block text-gray-700">Nombre</label>
          <input v-model="form.name" type="text" class="form-input mt-1 block w-full" />
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Email</label>
          <input v-model="form.email" type="email" class="form-input mt-1 block w-full" />
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Contraseña</label>
          <input v-model="form.password" type="password" class="form-input mt-1 block w-full" />
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
          Crear
        </button>
      </form>
    </div>
  </template>

  <script setup>
  import { useForm } from '@inertiajs/vue3';

  const form = useForm({
    name: '',
    email: '',
    password: '',
  });

  const submitForm = () => {
    form.post(route('teachers.store'));
  };
  </script>
