<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  patient: Object,
});

const form = useForm({
  name: props.patient.name,
  address: props.patient.address,
  phone: props.patient.phone,
  medical_history: props.patient.medical_history,
});

const submit = () => {
  form.put(route('patients.update', props.patient.id), {
    onSuccess: () => {
      // Handle successful update
    },
  });
};
</script>

<template>
  <AppLayout title="Edit Data Pasien">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Data Pasien</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="min-h-screen bg-gray-100">
            <div class="p-6">
              <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900">Edit Data Pasien</h1>
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
                    v-model="form.name"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>

                <!-- Address -->
                <div>
                  <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                  <input
                    type="text"
                    id="address"
                    v-model="form.address"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>

                <!-- Phone -->
                <div>
                  <label for="phone" class="block text-sm font-medium text-gray-700">Telepon</label>
                  <input
                    type="text"
                    id="phone"
                    v-model="form.phone"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  />
                </div>

                <!-- Medical History -->
                <div>
                  <label for="medical_history" class="block text-sm font-medium text-gray-700">Riwayat Medis</label>
                  <textarea
                    id="medical_history"
                    v-model="form.medical_history"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  ></textarea>
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                  <button
                    @click="submit"
                    class="w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition"
                  >
                    Perbarui Data Pasien
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
