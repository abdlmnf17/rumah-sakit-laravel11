<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  dokter: Object
});

const form = useForm({
  name: props.dokter.name,
  email: props.dokter.email,
  specialty: props.dokter.specialty,
  phone: props.dokter.phone
});

const submitForm = () => {
  form.put(route('dokters.update', props.dokter.id));
};
</script>

<template>
  <AppLayout title="Edit Dokter">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Dokter</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6">
            <form @submit.prevent="submitForm">
              <div class="space-y-6">
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                  <input v-model="form.name" type="text" id="name" class="mt-1 block w-full" :class="{'border-red-500': form.errors.name}" />
                  <div v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</div>
                </div>
                <div>
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input v-model="form.email" type="email" id="email" class="mt-1 block w-full" :class="{'border-red-500': form.errors.email}" />
                  <div v-if="form.errors.email" class="text-sm text-red-500">{{ form.errors.email }}</div>
                </div>
                <div>
                  <label for="specialty" class="block text-sm font-medium text-gray-700">Spesialisasi</label>
                  <input v-model="form.specialty" type="text" id="specialty" class="mt-1 block w-full" :class="{'border-red-500': form.errors.specialty}" />
                  <div v-if="form.errors.specialty" class="text-sm text-red-500">{{ form.errors.specialty }}</div>
                </div>
                <div>
                  <label for="phone" class="block text-sm font-medium text-gray-700">Telepon</label>
                  <input v-model="form.phone" type="text" id="phone" class="mt-1 block w-full" :class="{'border-red-500': form.errors.phone}" />
                  <div v-if="form.errors.phone" class="text-sm text-red-500">{{ form.errors.phone }}</div>
                </div>
                <div>
                  <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md">Perbarui Dokter</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
