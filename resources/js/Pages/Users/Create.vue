<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  roles: Array,
});

// Form state using Inertia's useForm
const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  roles: [],
});

const submit = () => {
  form.post(route('users.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
  });
};
</script>

<template>
  <AppLayout title="Create User">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Buat Pengguna Baru
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <form @submit.prevent="submit" class="space-y-6">
              <!-- Name Input -->
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input
                  id="name"
                  type="text"
                  v-model="form.name"
                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                  required
                />
                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                  {{ form.errors.name }}
                </div>
              </div>

              <!-- Email Input -->
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                  id="email"
                  type="email"
                  v-model="form.email"
                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                  required
                />
                <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                  {{ form.errors.email }}
                </div>
              </div>

              <!-- Password Input -->
              <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input
                  id="password"
                  type="password"
                  v-model="form.password"
                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                  required
                />
                <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">
                  {{ form.errors.password }}
                </div>
              </div>

              <!-- Password Confirmation Input -->
              <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input
                  id="password_confirmation"
                  type="password"
                  v-model="form.password_confirmation"
                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                  required
                />
              </div>

              <!-- Role Selection -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Pilih Role</label>
                <div class="mt-2 space-y-2">
                  <div v-for="role in roles" :key="role.id" class="flex items-center">
                    <input
                      type="checkbox"
                      :id="'role_' + role.id"
                      v-model="form.roles"
                      :value="role.id"
                      class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    />
                    <label :for="'role_' + role.id" class="ml-2 block text-sm text-gray-900">
                      {{ role.name }}
                    </label>
                  </div>
                </div>
                <div v-if="form.errors.roles" class="text-red-500 text-sm mt-1">
                  {{ form.errors.roles }}
                </div>
              </div>

              <!-- Submit Button -->
              <div class="flex justify-end">
                <button
                  type="submit"
                  class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                  :disabled="form.processing"
                >
                  {{ form.processing ? 'Menyimpan...' : 'Simpan' }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
