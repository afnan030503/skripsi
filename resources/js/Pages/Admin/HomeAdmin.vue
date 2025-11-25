<template>
  <div class="flex min-h-screen bg-gray-100 font-sans">
       <!-- SIDEBAR -->
    <AdminSidebar />

    <!-- CONTENT -->
    <main class="flex-1 p-8 overflow-y-auto">
      <!-- HEADER/BREADCRUMB -->
      <div class="mb-8 pb-4 border-b">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
        <p class="text-sm text-gray-500">
          Selamat datang di Dashboard Admin
        </p>
      </div>

      <!-- DASHBOARD SECTION -->
      <div class="p-6 bg-white rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-4 text-indigo-600">Ringkasan Admin</h2>
        <p class="text-gray-700 mb-6">Selamat datang kembali di halaman Admin Panel. Gunakan menu di samping untuk mengelola data kategori, menu, dan pengguna.</p>
        
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
          <!-- Total Foods -->
          <div class="bg-emerald-500 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition cursor-pointer" @click="navigateTo('/admin/menu?tab=foods')">
            <p class="text-4xl font-bold">{{ foodsCount }}</p>
            <p class="mt-2 text-lg">Total Menu Foods</p>
            <p class="text-sm mt-2 opacity-90">Klik untuk mengelola</p>
          </div>

          <!-- Total Drinks -->
          <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition cursor-pointer" @click="navigateTo('/admin/menu?tab=drinks')">
            <p class="text-4xl font-bold">{{ drinksCount }}</p>
            <p class="mt-2 text-lg">Total Menu Drinks</p>
            <p class="text-sm mt-2 opacity-90">Klik untuk mengelola</p>
          </div>

          <!-- Total Subcategories -->
          <div class="bg-amber-500 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition cursor-pointer" @click="navigateTo('/admin/subcategories')">
            <p class="text-4xl font-bold">{{ totalSubcategories }}</p>
            <p class="mt-2 text-lg">Total Subcategory</p>
            <p class="text-sm mt-2 opacity-90">Klik untuk mengelola</p>
          </div>

          <!-- Banner Management -->
          <div class="bg-purple-500 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition cursor-pointer" @click="navigateTo('/admin/banners')">
            <p class="text-4xl font-bold">Banner</p>
            <p class="mt-2 text-lg">Kelola Gambar</p>
            <p class="text-sm mt-2 opacity-90">Klik untuk mengelola</p>
          </div>

        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, usePage, router } from '@inertiajs/vue3'
import AdminSidebar from "@/Layouts/AdminSidebar.vue";

const props = defineProps({
  foodsCount: {type: Number,default: 0},
  drinksCount: {type: Number,default: 0},
  totalSubcategories: { type: Number, default: 0 }
})

const page = usePage()
const menuOpen = ref(true)

const currentRoute = ref(page.url)

const navigateTo = (url) => {
  router.visit(url)
}

const logout = () => {
  router.post('/logout')
}

</script>