<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, computed } from 'vue';
import { Link, useForm, usePage, router } from '@inertiajs/vue3'; // pastikan Anda juga mengimpor 'Link' jika digunakan

const props = defineProps({
  users: Array,
  errors: Object,
  jetstream: Object,
  auth: Object,
  userRole: String,
});

// Variabel untuk search query dan pagination
const searchQuery = ref('');
const currentPage = ref(1);
const itemsPerPage = 10;

// Filter users berdasarkan query pencarian
const filteredUsers = computed(() => {
  if (!searchQuery.value) return props.users;

  const query = searchQuery.value.toLowerCase();
  return props.users.filter(user =>
    user.name.toLowerCase().includes(query) ||
    user.email.toLowerCase().includes(query) ||
    user.roles.some(role => role.name.toLowerCase().includes(query))
  );
});

// Pagination logic
const paginatedUsers = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return filteredUsers.value.slice(start, end);
});

// Total halaman
const totalPages = computed(() => {
  return Math.ceil(filteredUsers.value.length / itemsPerPage);
});

// Fungsi untuk ganti halaman
const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
  }
};

// Fungsi delete user
const deleteUser = (id) => {
  if (confirm('Are you sure you want to delete this user?')) {
    router.delete(route('users.destroy', id), {
      preserveScroll: true,
      onSuccess: () => {
        // Flash success message
        console.log('User berhasil dihapus');
      },
      onError: (errors) => {
        // Handle error jika terjadi masalah
        console.error('Gagal menghapus user:', errors);
      },
    });
  }
};

// Mendapatkan flash messages dari Inertia.js
const flash = usePage().props.flash || {};
</script>

<template>

<AppLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Kelola Pengguna
      </h2>
    </template>

    <!-- Alert Success -->
    <div v-if="flash.success" class="bg-green-100 border border-green-400 text-green-700 p-4 mb-4 rounded">
      <strong>Success!</strong> {{ flash.success }}
    </div>

    <!-- Alert Error -->
    <div v-if="flash.error" class="bg-red-100 border border-red-400 text-red-700 p-4 mb-4 rounded">
      <strong>Error!</strong> {{ flash.error }}
    </div>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="min-h-screen bg-gray-100">
            <!-- Header Section -->
            <div class="bg-white border-b border-gray-200 p-6">
              <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900">
                  Pengguna
                </h1>
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
                  <!-- Search Input -->
                  <div class="relative w-full sm:w-64">
                    <input
                      type="text"
                      v-model="searchQuery"
                      placeholder="Cari pengguna..."
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                    />
                    <span v-if="searchQuery"
                          @click="searchQuery = ''"
                          class="absolute right-3 top-2.5 cursor-pointer text-gray-500 hover:text-gray-700">
                      ×
                    </span>
                  </div>
                  <!-- Create Button -->
                  <Link
                    :href="route('users.create')"
                    class="w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition text-center"
                  >
                    Create User
                  </Link>
                </div>
              </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
              <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                      Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                      Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                      Roles
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-if="paginatedUsers.length === 0">
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                      No users found
                    </td>
                  </tr>
                  <tr v-for="user in paginatedUsers" :key="user.id" class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-b">
                      {{ user.name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b">
                      {{ user.email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border-b">
                      <div class="flex flex-wrap gap-1">
                        <span v-for="role in user.roles" :key="role.id"
                              class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded">
                          {{ role.name }}
                        </span>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium border-b">
                      <div class="flex space-x-4">
                        <Link
                          :href="route('users.edit', user.id)"
                          class="text-yellow-600 hover:text-yellow-700"
                        >
                          Edit
                        </Link>
                        <button
                          @click="deleteUser(user.id)"
                          class="text-red-600 hover:text-red-700"
                        >
                          Delete
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Pagination Section -->
            <div class="flex justify-center mt-4">
              <button
                :disabled="currentPage === 1"
                @click="changePage(currentPage - 1)"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-l-md hover:bg-gray-300"
              >
                Previous
              </button>
              <span class="px-4 py-2 text-sm font-medium text-gray-700">
                Page {{ currentPage }} of {{ totalPages }}
              </span>
              <button
                :disabled="currentPage === totalPages"
                @click="changePage(currentPage + 1)"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-r-md hover:bg-gray-300"
              >
                Next
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>



</template>
