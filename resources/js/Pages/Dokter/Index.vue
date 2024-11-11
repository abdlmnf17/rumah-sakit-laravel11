<script setup>
import { ref, computed } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  dokters: Array,
  userRole: String,
});

// Variabel untuk search query dan pagination
const searchQuery = ref('');
const currentPage = ref(1);
const itemsPerPage = 10;

const filteredDokters = computed(() => {
  if (!searchQuery.value) return props.dokters;
  const query = searchQuery.value.toLowerCase();
  return props.dokters.filter(dokter =>
    dokter.name.toLowerCase().includes(query) ||
    dokter.email.toLowerCase().includes(query) ||
    dokter.specialty.toLowerCase().includes(query)
  );
});

const paginatedDokters = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return filteredDokters.value.slice(start, end);
});

const totalPages = computed(() => {
  return Math.ceil(filteredDokters.value.length / itemsPerPage);
});

const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
  }
};



const deleteDokter = (id) => {
  if (confirm('Are you sure you want to delete this dokter?')) {
    router.delete(route('dokters.destroy', id), {
      preserveScroll: true,
      onSuccess: () => {
        // Flash success message
        console.log('berhasil dihapus');
      },
      onError: (errors) => {
        // Handle error jika terjadi masalah
        console.error('Gagal menghapus:', errors);
      },
    });
  }
};
</script>

<template>
  <AppLayout title="Dokter">


    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Dokter</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="min-h-screen bg-gray-100">
            <!-- Header Section -->
            <div class="bg-white border-b border-gray-200 p-6">
              <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900">Dokter</h1>
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
                  <!-- Search Input -->
                  <input
                    v-model="searchQuery"
                    placeholder="Cari dokter..."
                    class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                  />
                  <!-- Create Button -->
                  <div v-if="userRole === 'admin'">

                      <Link
                        :href="route('dokters.create')"
                        class="w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700"
                      >
                        Tambah Dokter
                      </Link>
    </div>
                </div>
              </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
              <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Spesialisasi</th>
                    <div v-if="userRole === 'admin'">

                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Aksi</th>
    </div>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-if="paginatedDokters.length === 0">
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No Dokters found</td>
                  </tr>
                  <tr v-for="dokter in paginatedDokters" :key="dokter.id" class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ dokter.name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ dokter.email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ dokter.specialty }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <div v-if="userRole === 'admin'">

                            <Link :href="route('dokters.edit', dokter.id)" class="text-yellow-600 hover:text-yellow-700">Edit</Link>
                            <button @click="deleteDokter(dokter.id)" class="text-red-600 hover:text-red-700 ml-4">Delete</button>
    </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Pagination Section -->
            <div class="flex justify-center mt-4">
              <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-l-md hover:bg-gray-300">Previous</button>
              <span class="px-4 py-2 text-sm font-medium text-gray-700">Page {{ currentPage }} of {{ totalPages }}</span>
              <button @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-r-md hover:bg-gray-300">Next</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
