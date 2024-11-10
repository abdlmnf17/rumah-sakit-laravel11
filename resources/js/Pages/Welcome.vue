<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const slides = ref([
    {
        image: 'http://rsuddrloekmonohadi.kuduskab.go.id/wp-content/uploads/2024/07/STOP-GRATIFIKASI-WEB-1.png',
        title: 'Pelayanan Kesehatan Terpadu',
        description: 'Memberikan layanan kesehatan terbaik dengan standar internasional'
    },
    {
        image: 'http://rsuddrloekmonohadi.kuduskab.go.id/wp-content/uploads/2024/05/5.png',
        title: 'Dokter Spesialis Berpengalaman',
        description: 'Ditangani oleh tim dokter spesialis yang kompeten dan berpengalaman'
    },
    {
        image: 'http://rsuddrloekmonohadi.kuduskab.go.id/wp-content/uploads/2023/10/2-1.png',
        title: 'Fasilitas Modern',
        description: 'Dilengkapi dengan peralatan medis terkini untuk diagnosis dan pengobatan'
    }
]);

const currentSlide = ref(0);

const nextSlide = () => {
    currentSlide.value = (currentSlide.value + 1) % slides.value.length;
};

const prevSlide = () => {
    currentSlide.value = currentSlide.value === 0 ? slides.value.length - 1 : currentSlide.value - 1;
};

// Auto slide setiap 5 detik
setInterval(nextSlide, 5000);
</script>

<template>
    <Head title="RSUD dr. Loekmono Hadi" />
    <div class="min-h-screen bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg fixed w-full z-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <div class="text-xl font-bold text-blue-600">
                            RSUD dr. Loekmono Hadi
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <template v-if="canLogin">
                            <Link
                                v-if="$page.props.auth.user"
                                :href="route('dashboard')"
                                class="text-gray-700 hover:text-blue-600 px-3 py-2"
                            >
                                Dashboard
                            </Link>

                            <template v-else>
                                <Link
                                    :href="route('login')"
                                    class="text-gray-700 hover:text-blue-600 px-3 py-2"
                                >
                                    Login
                                </Link>

                                <Link
                                    v-if="canRegister"
                                    :href="route('register')"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                                >
                                    Register
                                </Link>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </nav>
        

        <!-- Hero Slider -->
        <div class="relative pt-16 overflow-hidden">
            <div class="relative h-[900px]">
                <div v-for="(slide, index) in slides"
                     :key="index"
                     :class="['absolute w-full h-full transition-opacity duration-500',
                             index === currentSlide ? 'opacity-100' : 'opacity-0']">
                    <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-black bg-opacity-40">
                        <div class="max-w-7xl mx-auto px-4 h-full flex items-center">
                            <div class="text-white">
                                <h2 class="text-4xl font-bold mb-4">{{ slide.title }}</h2>
                                <p class="text-xl">{{ slide.description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slider Controls -->
                <button @click="prevSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/50 p-2 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="nextSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/50 p-2 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>


          <!-- Keunggulan -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Mengapa Memilih Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-white">24</span>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Layanan 24 Jam</h3>
                        <p class="text-gray-600">Siap melayani kebutuhan medis Anda sepanjang hari</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-white">50+</span>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Dokter Spesialis</h3>
                        <p class="text-gray-600">Tim dokter spesialis berpengalaman</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-white">100+</span>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Tempat Tidur</h3>
                        <p class="text-gray-600">Kamar rawat inap nyaman dan modern</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-white">10+</span>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Tahun Pengalaman</h3>
                        <p class="text-gray-600">Melayani masyarakat dengan dedikasi</p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Layanan Unggulan -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Layanan Unggulan</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- IGD 24 Jam -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">IGD 24 Jam</h3>
                        <p class="text-gray-600">Pelayanan gawat darurat 24 jam dengan tim medis yang siaga</p>
                    </div>

                    <!-- Poliklinik Spesialis -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Poliklinik Spesialis</h3>
                        <p class="text-gray-600">Berbagai layanan poliklinik spesialis dengan dokter berpengalaman</p>
                    </div>

                    <!-- Laboratorium -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Laboratorium Modern</h3>
                        <p class="text-gray-600">Fasilitas laboratorium lengkap dengan teknologi terkini</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Fitur Masyarakat -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Fitur untuk Masyarakat</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- PPID -->
                    <div class="text-center bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-2">PPID</h3>
                        <p class="text-gray-600 mb-4">Akses informasi publik melalui PPID untuk transparansi layanan.</p>
                        <Link href="/ppid" class="text-blue-600 hover:text-blue-800">Lihat Detail</Link>
                    </div>

                    <!-- Pendaftaran Rawat Jalan -->
                    <div class="text-center bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-2">Pendaftaran Rawat Jalan</h3>
                        <p class="text-gray-600 mb-4">Daftar untuk rawat jalan secara online, mudah dan cepat.</p>
                        <Link href="/pendaftaran-rawat-jalan" class="text-blue-600 hover:text-blue-800">Daftar Sekarang</Link>
                    </div>

                    <!-- Survey Kepuasan -->
                    <div class="text-center bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-2">Survey Kepuasan Masyarakat</h3>
                        <p class="text-gray-600 mb-4">Berikan feedback untuk meningkatkan pelayanan kami.</p>
                        <Link href="/survey-kepuasan" class="text-blue-600 hover:text-blue-800">Isi Survey</Link>
                    </div>

                    <!-- Pengaduan Online -->
                    <div class="text-center bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold mb-2">Pengaduan Online</h3>
                        <p class="text-gray-600 mb-4">Laporkan masalah atau keluhan Anda secara online.</p>
                        <Link href="/pengaduan-online" class="text-blue-600 hover:text-blue-800">Kirim Pengaduan</Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4">RSUD dr. Loekmono Hadi</h3>
                        <p class="text-gray-400">Memberikan pelayanan kesehatan terbaik untuk masyarakat</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Kontak</h3>
                        <p class="text-gray-400">Jl. Dr. Sutomo No.42</p>
                        <p class="text-gray-400">Telepon: (0123) 456789</p>
                        <p class="text-gray-400">Email: info@rsloekmonohadi.com</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Jam Operasional</h3>
                        <p class="text-gray-400">IGD: 24 Jam</p>
                        <p class="text-gray-400">Poliklinik: Senin - Jumat</p>
                        <p class="text-gray-400">08.00 - 16.00 WIB</p>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; {{ new Date().getFullYear() }} RSUD dr. Loekmono Hadi. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>
