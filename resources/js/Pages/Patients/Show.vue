<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  patient: Object,
});
</script>

<template>
  <AppLayout title="Data Pasien">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Pasien</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="min-h-screen bg-gray-100">
            <div class="p-6">
              <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900">Data Pasien</h1>
              </div>
            </div>

            <div class="p-6 bg-white shadow-lg sm:rounded-lg">
              <div class="space-y-4">
                <!-- Name -->
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                  <input
                    type="text"
                    id="name"
                    v-model="props.patient.name"
                    disabled
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>

                <!-- Address -->
                <div>
                  <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                  <input
                    type="text"
                    id="address"
                    v-model="props.patient.address"
                    disabled
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>

                <!-- Phone -->
                <div>
                  <label for="phone" class="block text-sm font-medium text-gray-700">Telepon</label>
                  <input
                    type="text"
                    id="phone"
                    v-model="props.patient.phone"
                    disabled
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>

                <!-- Medical History -->
                <div>
                  <label for="medical_history" class="block text-sm font-medium text-gray-700">Riwayat Medis</label>
                  <textarea
                    id="medical_history"
                    v-model="props.patient.medical_history"
                    disabled
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  ></textarea>
                </div>

                <!-- Tombol Edit -->
                <div class="mt-4">
                  <Link
                    :href="route('patients.edit', props.patient.id)"
                    class="w-full sm:w-auto bg-yellow-600 text-white px-6 py-2 rounded-md hover:bg-yellow-700 transition"
                  >
                    Edit Data Pasien
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
