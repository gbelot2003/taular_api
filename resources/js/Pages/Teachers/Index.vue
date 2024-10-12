<template>
    <div class="container mx-auto py-8">
      <h1 class="text-2xl font-bold mb-4">Lista de Maestros</h1>
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="py-2 text-left">Nombre</th>
            <th class="py-2 text-left">Email</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="teacher in teachers" :key="teacher.id">
            <td class="py-2">{{ teacher.name }}</td>
            <td class="py-2">{{ teacher.email }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

  <script setup>
  const props = defineProps({
    teachers: Array,
  });
  </script>
