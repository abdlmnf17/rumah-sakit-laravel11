<script setup>
import { ref } from 'vue';
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';

// Registering chart.js components
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

// Dummy data untuk analytics
const analytics = ref({
  rawatInap: {
    total: 145,
    tersedia: 55,
    terisi: 90,
    persentase: 62
  },
  rawatJalan: {
    hariIni: 78,
    antrian: 23,
    selesai: 55
  },
  igd: {
    aktif: 12,
    menunggu: 3,
    ditangani: 9
  },
  dokter: {
    hadir: 45,
    totalDokter: 50,
    spesialis: 30,
    umum: 20
  }
});

// Data chart untuk Rawat Inap
const rawatInapChartData = {
  labels: ['Tersedia', 'Terisi'],
  datasets: [
    {
      label: 'Kamar',
      data: [analytics.value.rawatInap.tersedia, analytics.value.rawatInap.terisi],
      backgroundColor: ['#4CAF50', '#FF5722'],
    },
  ],
};

// Opsi chart
const chartOptions = {
  responsive: true,
  plugins: {
    legend: {
      position: 'top',
    },
  },
};
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200 p-6">
      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <h1 class="ml-4 text-2xl font-bold text-gray-900">
            Dashboard 
          </h1>
        </div>
        <div class="text-right">
          <p class="text-sm text-gray-600">Senin, 10 November 2024</p>
          <p class="text-lg font-medium text-gray-900">07:00 - 19:00 WIB</p>
        </div>
      </div>
    </div>

    <!-- Analytics Cards -->
    <div class="p-6">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Rawat Inap Analytics -->
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-xl transition-shadow duration-300">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Rawat Inap</h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
          </div>
          <div class="space-y-4">
            <p class="text-3xl font-bold text-gray-900">{{ analytics.rawatInap.terisi }}/{{ analytics.rawatInap.total }}</p>
            <p class="text-sm text-gray-600">Kamar Terisi</p>
            <Bar :data="rawatInapChartData" :options="chartOptions" class="h-48 w-full" />
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div class="bg-blue-600 h-2.5 rounded-full" :style="{ width: analytics.rawatInap.persentase + '%' }"></div>
            </div>
            <p class="text-sm text-gray-600">{{ analytics.rawatInap.tersedia }} Kamar Tersedia</p>
          </div>
        </div>

        <!-- Rawat Jalan Analytics -->
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-xl transition-shadow duration-300">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Rawat Jalan</h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
          </div>
          <div class="space-y-2">
            <p class="text-3xl font-bold text-gray-900">{{ analytics.rawatJalan.hariIni }}</p>
            <p class="text-sm text-gray-600">Pasien Hari Ini</p>
            <div class="flex justify-between text-sm">
              <span>Antrian: {{ analytics.rawatJalan.antrian }}</span>
              <span>Selesai: {{ analytics.rawatJalan.selesai }}</span>
            </div>
          </div>
        </div>

        <!-- IGD Analytics -->
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-xl transition-shadow duration-300">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">IGD</h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
          </div>
          <div class="space-y-2">
            <p class="text-3xl font-bold text-gray-900">{{ analytics.igd.aktif }}</p>
            <p class="text-sm text-gray-600">Kasus Aktif</p>
            <div class="flex justify-between text-sm">
              <span>Menunggu: {{ analytics.igd.menunggu }}</span>
              <span>Ditangani: {{ analytics.igd.ditangani }}</span>
            </div>
          </div>
        </div>

        <!-- Dokter Analytics -->
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-xl transition-shadow duration-300">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Dokter</h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>
          <div class="space-y-2">
            <p class="text-3xl font-bold text-gray-900">{{ analytics.dokter.hadir }}/{{ analytics.dokter.totalDokter }}</p>
            <p class="text-sm text-gray-600">Dokter Hadir</p>
            <div class="flex justify-between text-sm">
              <span>Spesialis: {{ analytics.dokter.spesialis }}</span>
              <span>Umum: {{ analytics.dokter.umum }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

      <!-- Menu Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Rawat Inap Menu -->
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-semibold text-gray-900">Rawat Inap</h3>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
            </div>
            <p class="text-gray-600 mb-4">Kelola pasien rawat inap, kamar, dan monitoring pasien</p>
            <ul class="text-sm text-gray-600 space-y-2">
              <li>• Pendaftaran Pasien Baru</li>
              <li>• Manajemen Kamar</li>
              <li>• Monitoring Pasien</li>
              <li>• Administrasi</li>
            </ul>
          </div>
          <div class="px-6 py-4 bg-gray-50 rounded-b-lg">
            <button class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors duration-300">
              Akses Menu
            </button>
          </div>
        </div>

        <!-- Rawat Jalan Menu -->
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-semibold text-gray-900">Rawat Jalan</h3>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
              </svg>
            </div>
            <p class="text-gray-600 mb-4">Pendaftaran dan pengelolaan pasien rawat jalan</p>
            <ul class="text-sm text-gray-600 space-y-2">
              <li>• Pendaftaran Online/Offline</li>
              <li>• Antrian Poliklinik</li>
              <li>• Jadwal Dokter</li>
              <li>• Rekam Medis</li>
            </ul>
          </div>
          <div class="px-6 py-4 bg-gray-50 rounded-b-lg">
            <button class="w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition-colors duration-300">
              Akses Menu
            </button>
          </div>
        </div>

        <!-- IGD Menu -->
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-semibold text-gray-900">IGD</h3>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
            </div>
            <p class="text-gray-600 mb-4">Penanganan kasus gawat darurat</p>
            <ul class="text-sm text-gray-600 space-y-2">
              <li>• Triage</li>
              <li>• Penanganan Cepat</li>
              <li>• Monitoring Pasien</li>
              <li>• Rujukan</li>
            </ul>
          </div>
          <div class="px-6 py-4 bg-gray-50 rounded-b-lg">
            <button class="w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition-colors duration-300">
              Akses Menu
            </button>
          </div>
        </div>
      </div>
  </div>
</template>
