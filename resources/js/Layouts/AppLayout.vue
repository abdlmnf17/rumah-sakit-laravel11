
<script setup>
  import { ref } from 'vue';
  import { Head, Link, router } from '@inertiajs/vue3';
  import ApplicationMark from '@/Components/ApplicationMark.vue';
  import Banner from '@/Components/Banner.vue';
  import Dropdown from '@/Components/Dropdown.vue';
  import DropdownLink from '@/Components/DropdownLink.vue';
  import NavLink from '@/Components/NavLink.vue';

  defineProps({
    title: String,
  });

  const showingSidebar = ref(false);

  const toggleSidebar = () => {
    showingSidebar.value = !showingSidebar.value;
  };

  const logout = () => {
    router.post(route('logout'));
  };
  </script>

  <style scoped>
  /* Add custom styles here if needed */
  </style>

<template>
    <div>
      <Head :title="title" />
      <Banner />

      <div class="min-h-screen bg-gray-100 flex">
        <!-- Sidebar -->
        <div
          :class="{
            'w-64 fixed md:relative transition-all duration-300 ease-in-out': true,
            'left-0': showingSidebar,
            '-left-64 md:left-0': !showingSidebar
          }"
          class="bg-gray-800 min-h-screen text-white"
        >
          <!-- Close button for mobile -->
          <div v-if="showingSidebar" class="absolute top-4 right-4 md:hidden">
            <button @click="toggleSidebar" class="text-white">
              <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <!-- Logo Section -->
          <div class="p-6 border-b border-gray-700">
            <Link :href="route('dashboard')" class="flex items-center">
              <ApplicationMark class="block h-9 w-auto text-white" />
              <span class="ml-3 text-xl font-semibold">Rumah Sakit App</span>
            </Link>
          </div>

          <!-- Navigation Links -->
          <nav class="mt-4">
            <div class="px-6 py-2">
              <!-- Dashboard Link -->
              <NavLink
                :href="route('dashboard')"
                :active="route().current('dashboard')"
                class="flex items-center py-3 px-4 rounded-lg transition-colors mb-3"
                :class="{
                  'bg-gray-200': route().current('dashboard'),
                  'hover:bg-gray-300': !route().current('dashboard')
                }"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-lg font-semibold">Dashboard</span>
              </NavLink>



              <!-- Rawat Inap Link -->
              <NavLink
                :href="route('rawat-inap')"
                :active="route().current('rawat-inap')"
                class="flex items-center py-3 px-4 rounded-lg transition-colors mb-3"
                :class="{
                  'bg-gray-200': route().current('rawat-inap'),
                  'hover:bg-gray-300': !route().current('rawat-inap')
                }"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <span class="text-lg font-semibold">Rawat Inap</span>
              </NavLink>

              <!-- Rawat Jalan Link -->
              <NavLink
                :href="route('rawat-jalan')"
                :active="route().current('rawat-jalan')"
                class="flex items-center py-3 px-4 rounded-lg transition-colors mb-3"
                :class="{
                  'bg-gray-200': route().current('rawat-jalan'),
                  'hover:bg-gray-300': !route().current('rawat-jalan')
                }"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20v-6m0 0V8m0 6h4a1 1 0 001-1V5a1 1 0 00-1-1H7a1 1 0 00-1 1v7a1 1 0 001 1h4z" />
                </svg>
                <span class="text-lg font-semibold">Rawat Jalan</span>
              </NavLink>

              <!-- IGD Link -->
              <NavLink
                :href="route('igd')"
                :active="route().current('igd')"
                class="flex items-center py-3 px-4 rounded-lg transition-colors mb-3"
                :class="{
                  'bg-gray-200': route().current('igd'),
                  'hover:bg-gray-300': !route().current('igd')
                }"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h4v10h-4zM7 7h4v10H7z" />
                </svg>
                <span class="text-lg font-semibold">IGD</span>
              </NavLink>

              <!-- Data Dokter Link -->
              <NavLink
                :href="route('dokter')"
                :active="route().current('dokter')"
                class="flex items-center py-3 px-4 rounded-lg transition-colors mb-3"
                :class="{
                  'bg-gray-200': route().current('dokter'),
                  'hover:bg-gray-300': !route().current('dokter')
                }"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2v2H4v12h4v2H4a2 2 0 01-2-2V4a2 2 0 012-2h2zm12 0v2h-2v12h4v2h-4a2 2 0 01-2-2V4a2 2 0 012-2h2z" />
                </svg>
                <span class="text-lg font-semibold">Data Dokter</span>
              </NavLink>

              <!-- Data Kasir Link -->
              <NavLink
                :href="route('kasir')"
                :active="route().current('kasir')"
                class="flex items-center py-3 px-4 rounded-lg transition-colors mb-3"
                :class="{
                  'bg-gray-200': route().current('kasir'),
                  'hover:bg-gray-300': !route().current('kasir')
                }"
              >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <span class="text-lg font-semibold">Data Kasir</span>
              </NavLink>
            </div>
          </nav>

          <!-- User Profile Section -->
          <div class="absolute bottom-0 w-full border-t border-gray-700">
            <div class="px-6 py-4">
              <Dropdown align="right" width="48">
                <template #trigger>
                  <button class="flex items-center w-full px-4 py-2 text-sm hover:bg-gray-700 rounded-lg transition-colors">
                    <div v-if="$page.props.jetstream.managesProfilePhotos" class="mr-3">
                      <img
                        class="h-8 w-8 rounded-full object-cover"
                        :src="$page.props.auth.user.profile_photo_url"
                        :alt="$page.props.auth.user.name"
                      />
                    </div>
                    <div class="flex-1 text-left">
                      <div>{{ $page.props.auth.user.name }}</div>
                      <div class="text-xs text-gray-400">{{ $page.props.auth.user.email }}</div>
                    </div>
                    <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>
                </template>

                <template #content>
                  <div class="absolute bottom-full left-0 mb-2 bg-gray-200 text-white rounded-lg shadow-lg">
                    <DropdownLink :href="route('profile.show')">Profile</DropdownLink>
                    <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">API Tokens</DropdownLink>

                    <div class="border-t border-gray-200"></div>

                    <form @submit.prevent="logout">
                      <DropdownLink as="button">
                        Log Out
                      </DropdownLink>
                    </form>
                  </div>
                </template>
              </Dropdown>
            </div>
          </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
          <div class="bg-white shadow-md p-4 flex items-center md:hidden">
            <button @click="toggleSidebar" class="text-gray-500 hover:text-gray-700">
              <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
          </div>

          <header v-if="$slots.header" class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
              <slot name="header" />
            </div>
          </header>

          <main class="p-4">
            <slot />
          </main>
        </div>
      </div>
    </div>
  </template>

