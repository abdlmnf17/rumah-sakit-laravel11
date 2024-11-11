<script setup>
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  patients: Array,
  userRole: String,
});
</script>

<template>
  <AppLayout title="Data Pasien">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Pasien</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Table Section -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="min-h-screen bg-gray-100">
            <div class="p-6">
              <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900">Daftar Pasien</h1>
              </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
              <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Telepon</th>
                    <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Aksi</th> -->
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-if="props.patients.length === 0">
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada pasien ditemukan</td>
                  </tr>
                  <tr v-for="patient in props.patients" :key="patient.id" class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ patient.name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ patient.address || 'Tidak ada' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ patient.phone || 'Tidak ada' }}</td>
                    <!-- <td class="px-6 py-4 text-sm text-gray-500">
                      <Link :href="route('patients.show', patient.id)" class="text-blue-600 hover:text-blue-700">Lihat</Link>
                    </td> -->
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
