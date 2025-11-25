<template>
  <div class="flex min-h-screen bg-gray-100 font-sans">
    <!-- SIDEBAR -->
    <aside class="w-64 bg-white shadow-lg flex flex-col">
      <div class="p-4 flex items-center gap-3 border-b">
        <img
          src="https://placehold.co/48x48/10b981/ffffff?text=Logo"
          alt="Logo Admin"
          class="w-12 h-12 object-cover rounded-full"
        />
        <h1 class="text-xl font-extrabold text-gray-800">Admin Panel</h1>
      </div>

      <nav class="mt-4 flex-1">
        <ul class="space-y-1">
          <!-- DASHBOARD -->
          <li>
            <Link
              href="/admin"
              class="w-full text-left px-4 py-3 rounded-r-full font-semibold transition duration-150 text-gray-700 hover:bg-gray-200"
            >
              Dashboard
            </Link>
          </li>

          <!-- Kelola Menu Toggle -->
          <li>
            <button
              @click="menuOpen = !menuOpen"
              class="w-full text-left px-4 py-3 font-semibold flex justify-between items-center text-gray-700 hover:bg-gray-200 rounded-r-full transition duration-150"
            >
              Kelola Menu
              <svg :class="['w-4 h-4 transform transition-transform duration-300', {'rotate-180': menuOpen}]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
          </li>

          <!-- Submenu Foods & Drinks -->
          <ul v-if="menuOpen" class="ml-4 pl-2 border-l border-gray-300 space-y-1">
            <li>
              <Link
                href="/admin/menu?tab=foods"
                class="block px-3 py-2 w-full text-left transition duration-150 rounded text-gray-600 hover:bg-gray-100"
              >
                Foods
              </Link>
            </li>
            <li>
              <Link
                href="/admin/menu?tab=drinks"
                class="block px-3 py-2 w-full text-left transition duration-150 rounded text-gray-600 hover:bg-gray-100"
              >
                Drinks
              </Link>
            </li>
          </ul>

          <!-- Kelola Pengguna -->
          <li>
            <Link
              href="/admin/users"
              class="w-full text-left px-4 py-3 rounded-r-full font-semibold transition duration-150 bg-indigo-600 text-white shadow-md"
            >
              Kelola Pengguna
            </Link>
          </li>
        </ul>
      </nav>

      <!-- Logout -->
      <div class="p-4 border-t">
        <form @submit.prevent="logout" class="w-full">
          <button
            type="submit"
            class="w-full text-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition"
          >
            Logout
          </button>
        </form>
      </div>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-8 overflow-y-auto">
      <!-- HEADER -->
      <div class="mb-8 pb-4 border-b">
        <h1 class="text-3xl font-bold text-gray-800">Kelola Pengguna</h1>
        <p class="text-sm text-gray-500">
          Selamat datang di halaman Kelola Pengguna
        </p>
      </div>

      <!-- USERS SECTION -->
      <div class="p-6 bg-white rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-purple-600">Manajemen Pengguna</h2>
        <p class="text-gray-700 mb-6">
          Di sini Anda dapat melihat, menambah, mengedit, dan menghapus data pengguna (admin, kasir, dll.).
        </p>

        <!-- Development Notice -->
        <div class="mt-6 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-indigo-600 rounded-lg">
          <h3 class="text-lg font-bold text-indigo-700 mb-2">🚀 Fitur Sedang Dikembangkan</h3>
          <p class="text-gray-700">
            Fitur manajemen pengguna akan segera tersedia. Anda akan dapat menambah, mengedit, dan menghapus pengguna sistem dengan lebih mudah.
          </p>
          <div class="mt-4 flex gap-3">
            <div class="flex items-center gap-2 text-gray-700">
              <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
              <span>Fitur tambah pengguna</span>
            </div>
            <div class="flex items-center gap-2 text-gray-700">
              <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
              <span>Fitur edit pengguna</span>
            </div>
            <div class="flex items-center gap-2 text-gray-700">
              <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
              <span>Fitur hapus pengguna</span>
            </div>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="mt-8 pt-6 border-t">
          <h3 class="text-lg font-bold mb-4 text-gray-800">Menu Cepat</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <Link
              href="/admin"
              class="p-4 bg-indigo-100 hover:bg-indigo-200 rounded-lg transition border border-indigo-300 text-indigo-700 font-semibold"
            >
              ← Kembali ke Dashboard
            </Link>
            <Link
              href="/admin/menu?tab=foods"
              class="p-4 bg-emerald-100 hover:bg-emerald-200 rounded-lg transition border border-emerald-300 text-emerald-700 font-semibold"
            >
              Kelola Foods →
            </Link>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { router, Link } from '@inertiajs/vue3'

const menuOpen = ref(true)

function logout() {
  router.post('/logout')
}
</script>