
<script setup>
  import { useForm } from '@inertiajs/vue3';
  import { Link } from '@inertiajs/vue3';

  // Mendefinisikan props yang diterima dari controller
  const props = defineProps({
    users: Array,
    errors: Object,
    jetstream: Object,
    auth: Object
  });

  // Debug log untuk mengecek data users
  console.log('Users data:', props.users);

  const deleteUser = async (id) => {
    if (confirm('Are you sure you want to delete this user?')) {
      await useForm().delete(route('users.destroy', id));
    }
  };
</script>

<template>
    <div class="min-h-screen bg-gray-100">
      <div class="bg-white border-b border-gray-200 p-6">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <h1 class="ml-4 text-2xl font-bold text-gray-900">
              Pengguna
            </h1>
          </div>
          <div class="text-right">
            <div class="mb-4">
              <Link
                :href="route('users.create')"
                class="inline-block bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition"
              >
                Create User
              </Link>
            </div>
          </div>
        </div>
      </div>

  
    </div>
  </template>
