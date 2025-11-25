<template>
  <div class="flex min-h-screen bg-gray-100 font-sans">
    <!-- SIDEBAR -->
    <AdminSidebar />

    <!-- CONTENT -->
    <main class="flex-1 p-8 overflow-y-auto">
      <div class="mb-8 pb-4 border-b flex justify-between items-center">
        <div>
          <h1 class="text-3xl font-bold text-gray-800">Kelola Banner</h1>
          <p class="text-sm text-gray-500">Upload dan kelola banner halaman utama</p>
        </div>
      </div>

      <!-- UPLOAD FORM -->
      <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
        <h3 class="text-lg font-bold mb-4">Tambah Banner Baru</h3>
        <form @submit.prevent="submit" class="flex gap-4 items-end">
          <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul (Opsional)</label>
            <input v-model="form.title" type="text" class="w-full border rounded px-3 py-2" placeholder="Contoh: Promo Merdeka">
          </div>
          <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
            <input @change="handleFileChange" type="file" accept="image/*" class="w-full border rounded px-3 py-2">
            <div v-if="form.errors.image" class="text-red-500 text-sm mt-1">{{ form.errors.image }}</div>
          </div>
          <button type="submit" :disabled="form.processing" class="bg-emerald-600 text-white px-6 py-2 rounded hover:bg-emerald-700 transition">
            Upload
          </button>
        </form>
      </div>

      <!-- BANNER LIST -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="banner in banners" :key="banner.id" class="bg-white rounded-xl shadow overflow-hidden group relative">
          <img :src="banner.image" class="w-full h-48 object-cover">
          <div class="p-4">
            <h4 class="font-bold text-gray-800">{{ banner.title || 'Tanpa Judul' }}</h4>
            <p class="text-xs text-gray-500 mt-1">Diupload: {{ new Date(banner.created_at).toLocaleDateString() }}</p>
          </div>
          
          <!-- DELETE BUTTON OVERLAY -->
          <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
            <button @click="deleteBanner(banner.id)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
              Hapus
            </button>
          </div>
        </div>
      </div>
      
      <div v-if="banners.length === 0" class="text-center py-12 text-gray-500">
        Belum ada banner yang diupload.
      </div>

    </main>
  </div>
</template>

<script setup>
import { useForm, router } from '@inertiajs/vue3';
import AdminSidebar from "@/Layouts/AdminSidebar.vue";

const props = defineProps({
  banners: Array,
});

const form = useForm({
  title: '',
  image: null,
});

const handleFileChange = (e) => {
  form.image = e.target.files[0];
};

const submit = () => {
  form.post('/admin/banners', {
    onSuccess: () => {
      form.reset();
      // Reset file input manually if needed
    },
  });
};

const deleteBanner = (id) => {
  if (confirm('Apakah Anda yakin ingin menghapus banner ini?')) {
    router.delete(`/admin/banners/${id}`);
  }
};
</script>
