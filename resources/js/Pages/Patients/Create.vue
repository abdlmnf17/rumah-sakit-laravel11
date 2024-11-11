<script setup>
import { ref } from 'vue';
import { useForm, usePage, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
  name: '',
  address: '',
  phone: '',
  medical_history: ''
});

const flash = usePage().props.flash || {};

const submit = () => {
  form.post(route('patients.store'), {
    onSuccess: () => {
      form.reset();
      // Handle success, you can show a flash message if needed
    },
    onError: (errors) => {
      console.log(errors);
    }
  });
};

</script>

<template>
  <AppLayout title="Tambah Pasien">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Data Pasien</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Success message -->
        <div v-if="flash.success" class="bg-green-100 border border-green-400 text-green-700 p-4 mb-4 rounded">
          <strong>Success!</strong> {{ flash.success }}
        </div>

        <!-- Error message -->
        <div v-if="flash.error" class="bg-red-100 border border-red-400 text-red-700 p-4 mb-4 rounded">
          <strong>Error!</strong> {{ flash.error }}
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="min-h-screen bg-gray-100">
            <div class="p-6">
              <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <h1 class="text-2xl font-bold text-gray-900">Form Tambah Pasien</h1>
              </div>
            </div>

            <div class="p-6 bg-white shadow-lg sm:rounded-lg">
              <form @submit.prevent="submit">
                <div class="space-y-4">
                  <!-- Nama -->
                  <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input
                      type="text"
                      id="name"
                      v-model="form.name"
                      required
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                  </div>

                  <!-- Alamat -->
                  <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input
                      type="text"
                      id="address"
                      v-model="form.address"
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                  </div>

                  <!-- Nomor Telepon -->
                  <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Telepon</label>
                    <input
                      type="text"
                      id="phone"
                      v-model="form.phone"
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                  </div>

                  <!-- Riwayat Medis -->
                  <div>
                    <label for="medical_history" class="block text-sm font-medium text-gray-700">Riwayat Medis</label>
                    <textarea
                      id="medical_history"
                      v-model="form.medical_history"
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    ></textarea>
                  </div>

                  <div class="mt-4">
                    <button
                      type="submit"
                      :disabled="form.processing"
                      class="w-full bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition"
                    >
                      Simpan Data Pasien
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
