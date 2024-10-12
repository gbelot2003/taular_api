<template>
    <div class="container mx-auto py-8">
      <h1 class="text-2xl font-bold mb-4">Lista de Clases</h1>
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="py-2 text-left">Nombre de la Clase</th>
            <th class="py-2 text-left">Maestro</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="classItem in classes" :key="classItem.id">
            <td class="py-2">{{ classItem.name }}</td>
            <td class="py-2">{{ classItem.teacher.name }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

  <script setup>
  const props = defineProps({
    classes: Array,
  });
  </script>
