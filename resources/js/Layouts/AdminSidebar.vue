<template>
  <aside class="w-64 bg-white shadow-lg flex flex-col">
    <!-- HEADER -->
    <div class="p-4 flex items-center gap-3 border-b">
      <img
        src="https://placehold.co/48x48/10b981/ffffff?text=Logo"
        alt="Logo Admin"
        class="w-12 h-12 object-cover rounded-full"
      />
      <h1 class="text-xl font-extrabold text-gray-800">Admin Panel</h1>
    </div>

    <!-- NAVIGATION -->
    <nav class="mt-4 flex-1">
      <ul class="space-y-6">

        <!-- DASHBOARD -->
        <li>
          <Link
            href="/admin"
            class="w-full text-left px-4 py-3 rounded-r-full font-semibold transition duration-150"
            :class="currentRoute === '/admin'
              ? 'bg-indigo-600 text-white shadow-md'
              : 'text-gray-700 hover:bg-gray-200'"
          >
            Dashboard
          </Link>
        </li>

        <!-- Kelola Kategori -->
        <li>
          <Link
            href="/admin/subcategory"
            class="w-full text-left px-4 py-3 rounded-r-full font-semibold transition duration-150"
            :class="currentRoute.startsWith('/admin/subcategory')
              ? 'bg-indigo-600 text-white shadow-md'
              : 'text-gray-700 hover:bg-gray-200'"
          >
            Kelola Kategori
          </Link>
        </li>

        <!-- Kelola Menu -->
        <li>
          <button
            @click="menuOpen = !menuOpen"
            class="w-full text-left px-4 py-3 font-semibold flex justify-between items-center rounded-r-full transition duration-150"
            :class="currentRoute.includes('/admin/menu')
              ? 'bg-indigo-600 text-white shadow-md'
              : 'text-gray-700 hover:bg-gray-200'"
          >
            Kelola Menu
            <svg :class="['w-4 h-4 transform transition-transform duration-300', {'rotate-180': menuOpen}]"
              fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
        </li>

        <!-- SUBMENU -->
        <ul
          v-if="menuOpen"
          class="ml-4 pl-2 border-l border-gray-300 space-y-1"
        >
          <li>
            <Link
              href="/admin/menu?tab=foods"
              class="block px-3 py-2 w-full text-left transition duration-150 rounded text-gray-600 hover:bg-gray-100"
              :class="tab === 'foods' ? 'bg-emerald-100 text-emerald-700 font-semibold' : ''"
            >
              Foods
            </Link>
          </li>

          <li>
            <Link
              href="/admin/menu?tab=drinks"
              class="block px-3 py-2 w-full text-left transition duration-150 rounded text-gray-600 hover:bg-gray-100"
              :class="tab === 'drinks' ? 'bg-blue-100 text-blue-700 font-semibold' : ''"
            >
              Drinks
            </Link>
          </li>
        </ul>

        <!-- Kelola Banner -->
        <li>
          <Link
            href="/admin/banners"
            class="w-full text-left px-4 py-3 rounded-r-full font-semibold transition duration-150"
            :class="currentRoute.includes('/admin/banners')
              ? 'bg-indigo-600 text-white shadow-md'
              : 'text-gray-700 hover:bg-gray-200'"
          >
            Kelola Banner
          </Link>
        </li>

        <!-- Kelola Pengguna -->
        <li>
          <Link
            href="/admin/users"
            class="w-full text-left px-4 py-3 rounded-r-full font-semibold transition duration-150"
            :class="currentRoute === '/admin/users'
              ? 'bg-indigo-600 text-white shadow-md'
              : 'text-gray-700 hover:bg-gray-200'"
          >
            Kelola Pengguna
          </Link>
        </li>

      </ul>
    </nav>

    <!-- LOGOUT -->
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
</template>

<script setup>
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

const menuOpen = ref(false);

const page = usePage();

// Detect route
const currentRoute = page.url;
const tab = new URLSearchParams(window.location.search).get("tab");

// Logout function
const logout = () => router.post("/logout");
</script>
