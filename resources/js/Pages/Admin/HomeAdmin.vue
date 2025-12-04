<template>
  <div class="flex min-h-screen bg-slate-50 font-sans">
    <!-- SIDEBAR -->
    <AdminSidebar />

    <!-- CONTENT -->
    <main class="flex-1 overflow-y-auto">
      <!-- TOP BAR -->
      <header class="bg-white border-b border-slate-200 px-8 py-4 sticky top-0 z-10 flex justify-between items-center">
        <div>
          <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Dashboard</h1>
          <p class="text-sm text-slate-500">Overview statistik dan aktivitas terbaru</p>
        </div>
        <div class="flex items-center gap-4">
          <div class="text-right hidden md:block">
            <p class="text-sm font-bold text-slate-700">Admin User</p>
            <p class="text-xs text-slate-500">Administrator</p>
          </div>
          <div class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden border border-slate-300">
            <img src="https://ui-avatars.com/api/?name=Admin+User&background=6366f1&color=fff" alt="Admin" class="w-full h-full object-cover">
          </div>
        </div>
      </header>

      <div class="p-8 max-w-7xl mx-auto">
        <!-- WELCOME CARD -->
        <div class="bg-indigo-600 rounded-2xl p-8 text-white shadow-xl shadow-indigo-200 mb-8 relative overflow-hidden">
          <div class="relative z-10">
            <h2 class="text-3xl font-bold mb-2">Selamat Datang Kembali! 👋</h2>
            <p class="text-indigo-100 max-w-2xl text-lg">
              Kelola semua data menu, kategori, dan konten website Utara Coffee dari satu tempat.
            </p>
          </div>
          <!-- Decorative circles -->
          <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
          <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-black opacity-10 rounded-full blur-2xl"></div>
        </div>

        <!-- STATS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          
          <!-- Foods Card -->
          <div 
            @click="navigateTo('/admin/menu?tab=foods')"
            class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-all cursor-pointer group"
          >
            <div class="flex justify-between items-start mb-4">
              <div class="p-3 bg-emerald-50 rounded-lg text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
              </div>
              <span class="text-xs font-bold px-2 py-1 bg-slate-100 text-slate-600 rounded-full">Foods</span>
            </div>
            <h3 class="text-3xl font-bold text-slate-800 mb-1">{{ foodsCount }}</h3>
            <p class="text-sm text-slate-500 font-medium">Total Menu Makanan</p>
          </div>

          <!-- Drinks Card -->
          <div 
            @click="navigateTo('/admin/menu?tab=drinks')"
            class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-all cursor-pointer group"
          >
            <div class="flex justify-between items-start mb-4">
              <div class="p-3 bg-blue-50 rounded-lg text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
              </div>
              <span class="text-xs font-bold px-2 py-1 bg-slate-100 text-slate-600 rounded-full">Drinks</span>
            </div>
            <h3 class="text-3xl font-bold text-slate-800 mb-1">{{ drinksCount }}</h3>
            <p class="text-sm text-slate-500 font-medium">Total Menu Minuman</p>
          </div>

          <!-- Subcategories Card -->
          <div 
            @click="navigateTo('/admin/subcategories')"
            class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-all cursor-pointer group"
          >
            <div class="flex justify-between items-start mb-4">
              <div class="p-3 bg-amber-50 rounded-lg text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
              </div>
              <span class="text-xs font-bold px-2 py-1 bg-slate-100 text-slate-600 rounded-full">Kategori</span>
            </div>
            <h3 class="text-3xl font-bold text-slate-800 mb-1">{{ totalSubcategories }}</h3>
            <p class="text-sm text-slate-500 font-medium">Total Subkategori</p>
          </div>

          <!-- Post Moderation Card -->
          <div 
            @click="navigateTo('/admin/posts')"
            class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-all cursor-pointer group"
          >
            <div class="flex justify-between items-start mb-4">
              <div class="p-3 bg-pink-50 rounded-lg text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
              </div>
              <span class="text-xs font-bold px-2 py-1 bg-slate-100 text-slate-600 rounded-full">Moderasi</span>
            </div>
            <h3 class="text-3xl font-bold text-slate-800 mb-1">Post</h3>
            <p class="text-sm text-slate-500 font-medium">Cek Postingan Baru</p>
          </div>

        </div>

        <!-- QUICK ACTIONS / RECENT ACTIVITY PLACEHOLDER -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h3 class="font-bold text-slate-800 mb-4">Aktivitas Terbaru</h3>
            <div class="space-y-4">
              <div class="flex items-center gap-4 p-3 bg-slate-50 rounded-lg">
                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                <p class="text-sm text-slate-600">System admin panel updated successfully.</p>
                <span class="ml-auto text-xs text-slate-400">Baru saja</span>
              </div>
              <!-- More items can be added here -->
            </div>
          </div>
          
          <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
            <h3 class="font-bold text-slate-800 mb-4">Quick Links</h3>
            <div class="space-y-2">
              <button @click="navigateTo('/admin/banners')" class="w-full text-left px-4 py-3 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-700 text-sm font-medium transition-colors flex justify-between items-center">
                Manage Banners
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
              </button>
              <button @click="navigateTo('/admin/users')" class="w-full text-left px-4 py-3 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-700 text-sm font-medium transition-colors flex justify-between items-center">
                Manage Users
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
              </button>
            </div>
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

const navigateTo = (url) => {
  router.visit(url)
}
</script>