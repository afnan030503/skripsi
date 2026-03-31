<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
  foodsCount: { type: Number, default: 0 },
  drinksCount: { type: Number, default: 0 },
  totalSubcategories: { type: Number, default: 0 }
})
</script>

<template>
  <Head title="Dashboard" />
  
  <AuthenticatedLayout>
    <template #header>
        <h1 class="text-xl md:text-2xl font-bold text-slate-800 tracking-tight">Dashboard User</h1>
        <p class="text-xs md:text-sm text-slate-500">Overview aktivitas Anda</p>
    </template>

    <div class="max-w-7xl mx-auto">
        <!-- WELCOME CARD -->
        <div class="bg-emerald-600 rounded-2xl p-6 md:p-8 text-white shadow-xl shadow-emerald-200 mb-8 relative overflow-hidden">
          <div class="relative z-10">
            <h2 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang! 👋</h2>
            <p class="text-emerald-50 text-base md:text-lg max-w-xl">
              Mau pesan kopi atau camilan apa hari ini? Nikmati layanan terbaik dari Utara Coffee.
            </p>
          </div>
          <!-- Decorative circle -->
          <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
        </div>

        <!-- STATS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4 transition-all hover:shadow-md">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-medium">Menu Makanan</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ foodsCount }} Item</h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4 transition-all hover:shadow-md">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-medium">Menu Minuman</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ drinksCount }} Item</h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4 transition-all hover:shadow-md">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-medium">Total Kategori</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ totalSubcategories }} Jenis</h3>
                </div>
            </div>
        </div>

        <!-- QUICK ACTIONS -->
        <h3 class="font-bold text-slate-800 mb-4 text-xl">Aksi Cepat</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <Link :href="route('orders.create')" class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all group overflow-hidden relative">
                <div class="relative z-10 flex items-center gap-6">
                    <div class="p-4 bg-emerald-100 text-emerald-600 rounded-2xl group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-800">Buat Pesanan Baru</h4>
                        <p class="text-slate-500">Lihat menu dan mulai memesan sekarang.</p>
                    </div>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-50 rounded-full opacity-50 group-hover:scale-150 transition-all duration-500"></div>
            </Link>

            <Link :href="route('orders.index')" class="bg-white p-8 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all group overflow-hidden relative">
                <div class="relative z-10 flex items-center gap-6">
                    <div class="p-4 bg-blue-100 text-blue-600 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-slate-800">Riwayat Pesanan</h4>
                        <p class="text-slate-500">Pantau status pesanan terakhirmu.</p>
                    </div>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-150 transition-all duration-500"></div>
            </Link>
        </div>
    </div>
  </AuthenticatedLayout>
</template>
