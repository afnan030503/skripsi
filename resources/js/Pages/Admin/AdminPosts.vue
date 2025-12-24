<template>
  <div class="flex min-h-screen bg-gray-100 font-sans">
    <!-- SIDEBAR -->
    <AdminSidebar :isOpen="isSidebarOpen" @close="isSidebarOpen = false" />
 
    <!-- CONTENT -->
    <main class="flex-1 min-w-0 overflow-y-auto">
      <!-- TOP BAR -->
      <header class="bg-white border-b border-slate-200 px-4 md:px-8 py-4 sticky top-0 z-30 flex justify-between items-center mb-6 md:mb-8">
        <div class="flex items-center gap-4">
          <!-- HAMBURGER -->
          <button 
            @click="isSidebarOpen = true"
            class="lg:hidden p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
          </button>

          <div>
            <h1 class="text-xl md:text-3xl font-bold text-gray-800">Moderasi Postingan</h1>
            <p class="text-xs md:text-sm text-gray-500 hidden sm:block">
              Kelola postingan komunitas (Approve/Reject)
            </p>
          </div>
        </div>
        
        <!-- PENDING COUNTER -->
        <div class="bg-yellow-100 text-yellow-800 px-3 py-1 md:px-4 md:py-2 rounded-lg font-bold border border-yellow-200 text-xs md:text-base">
          {{ pendingCount }} <span class="hidden sm:inline">Pending</span>
        </div>
      </header>

      <div class="px-4 md:px-8 pb-8">

      <!-- FILTERS -->
      <div class="bg-white p-4 rounded-xl shadow-sm mb-6 flex flex-wrap gap-4 items-center">
        <!-- Status Filter -->
        <div class="flex items-center gap-2">
          <span class="text-sm font-semibold text-gray-600">Status:</span>
          <div class="flex bg-gray-100 rounded-lg p-1">
            <button 
              v-for="s in ['all', 'pending', 'approved', 'rejected']" 
              :key="s"
              @click="filterStatus = s"
              class="px-3 py-1 rounded-md text-sm capitalize transition-all"
              :class="filterStatus === s ? 'bg-white shadow text-black font-bold' : 'text-gray-500 hover:text-gray-700'"
            >
              {{ s }}
            </button>
          </div>
        </div>

        <!-- Category Filter -->
        <div class="flex items-center gap-2">
          <span class="text-sm font-semibold text-gray-600">Kategori:</span>
          <select 
            v-model="filterCategory" 
            class="border-gray-300 rounded-lg text-sm focus:ring-black focus:border-black"
          >
            <option value="all">Semua Kategori</option>
            <option value="Sambat">Sambat</option>
            <option value="Romansa">Romansa</option>
            <option value="Skripshit">Skripshit</option>
          </select>
        </div>
      </div>

      <!-- POSTS GRID -->
      <div v-if="filteredPosts.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div 
          v-for="post in filteredPosts" 
          :key="post.id" 
          class="bg-white rounded-xl overflow-hidden shadow-md border border-gray-200 flex flex-col"
        >
          <!-- Image -->
          <div class="h-48 bg-gray-100 relative group">
            <img 
              :src="post.image_url" 
              class="w-full h-full object-contain p-2"
              :style="{ backgroundColor: post.color || '#f3f4f6' }"
            />
            
            <!-- Download Button (Overlay) -->
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all flex items-center justify-center pointer-events-none">
              <a 
                :href="post.image_url" 
                download 
                target="_blank"
                class="pointer-events-auto opacity-0 group-hover:opacity-100 bg-white/90 hover:bg-white text-gray-800 p-2 rounded-full shadow-lg transition-all transform translate-y-2 group-hover:translate-y-0"
                title="Download Foto"
              >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
              </a>
            </div>

            <div class="absolute top-2 right-2">
              <span 
                class="px-2 py-1 rounded text-xs font-bold uppercase tracking-wider shadow-sm border"
                :class="{
                  'bg-yellow-100 text-yellow-800 border-yellow-200': post.status === 'pending',
                  'bg-green-100 text-green-800 border-green-200': post.status === 'approved',
                  'bg-red-100 text-red-800 border-red-200': post.status === 'rejected',
                }"
              >
                {{ post.status }}
              </span>
            </div>
          </div>

          <!-- Content -->
          <div class="p-4 flex-1 flex flex-col">
            <div class="flex justify-between items-start mb-2">
              <span class="text-xs font-bold px-2 py-1 bg-gray-100 rounded-full text-gray-600">
                {{ post.category }}
              </span>
              <span class="text-xs text-gray-400">
                {{ new Date(post.created_at).toLocaleDateString() }}
              </span>
            </div>
            
            <h3 class="font-bold text-lg text-gray-900 mb-1 line-clamp-2" :title="post.title">
              {{ post.title }}
            </h3>
            
            <p class="text-sm text-gray-500 mb-4">
              #{{ post.tag || '-' }}
            </p>

            <!-- Actions -->
            <div class="mt-auto pt-4 border-t flex gap-2">
              <!-- Edit Button -->
              <button 
                @click="openEditModal(post)"
                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg text-sm font-bold transition flex justify-center items-center gap-1"
              >
                ✏️ Edit
              </button>
              
              <button 
                v-if="post.status !== 'approved'"
                @click="approvePost(post)"
                :disabled="processing === post.id"
                class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg text-sm font-bold transition flex justify-center items-center gap-1"
              >
                <span v-if="processing === post.id">...</span>
                <span v-else>✓ Approve</span>
              </button>
              
              <button 
                v-if="post.status !== 'rejected'"
                @click="rejectPost(post)"
                :disabled="processing === post.id"
                class="flex-1 bg-red-100 hover:bg-red-200 text-red-700 py-2 rounded-lg text-sm font-bold transition flex justify-center items-center gap-1"
              >
                <span v-if="processing === post.id">...</span>
                <span v-else>✕ Reject</span>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- EMPTY STATE -->
      <div v-else class="text-center py-20 bg-white rounded-xl border border-dashed border-gray-300">
        <p class="text-gray-500 text-lg">Tidak ada postingan yang sesuai filter.</p>
      </div>

      </div>
    </main>

    <!-- EDIT MODAL -->
    <div 
      v-if="showEditModal" 
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
      @click.self="closeEditModal"
    >
      <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
        <div class="flex justify-between items-start mb-4 gap-4">
          <h2 class="text-xl md:text-2xl font-bold text-gray-800 leading-tight">Edit Postingan</h2>
          <button 
            @click="closeEditModal"
            class="text-gray-400 hover:text-gray-600 text-3xl shrink-0 -mt-1"
          >
            ✕
          </button>
        </div>

        <form @submit.prevent="saveEdit">
          <!-- Title/Deskripsi -->
          <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Deskripsi
            </label>
            <textarea 
              v-model="editForm.title"
              class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              rows="4"
              required
            ></textarea>
          </div>

          <!-- Category -->
          <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Kategori
            </label>
            <select 
              v-model="editForm.category"
              class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              required
            >
              <option value="Sambat">Sambat</option>
              <option value="Romansa">Romansa</option>
              <option value="Skripshit">Skripshit</option>
            </select>
          </div>

           <!-- Tag/Tagar -->
          <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Tagar (tanpa #)
            </label>
            <input 
              v-model="editForm.tag"
              type="text"
              class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="contoh: utara"
            />
          </div>

          <!-- RE-UPLOAD PHOTO -->
          <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Ganti Foto (Opsional)
            </label>
            <input 
              type="file"
              @change="handleFileSelect"
              accept="image/*"
              class="w-full border border-gray-300 rounded-lg p-2 text-sm"
            />
            <div v-if="editPreview" class="mt-4 bg-gray-50 rounded-lg p-2 flex justify-center border border-dashed border-gray-300">
               <img :src="editPreview" class="h-32 w-auto object-contain rounded shadow-sm"/>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex gap-3">
            <button 
              type="button"
              @click="closeEditModal"
              class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg font-bold transition"
            >
              Batal
            </button>
            <button 
              type="submit"
              :disabled="saving"
              class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-bold transition disabled:opacity-50"
            >
              {{ saving ? 'Menyimpan...' : 'Simpan' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import AdminSidebar from "@/Layouts/AdminSidebar.vue";
import axios from 'axios';
import { router } from '@inertiajs/vue3';

const isSidebarOpen = ref(false);

const props = defineProps({
  posts: {
    type: Array,
    default: () => []
  }
});

// Use local ref for posts to allow updates (like status changes) without full reload if desired,
// though Inertia best practice is usually to reload. 
// Since we are doing manual axios updates for approve/reject, we can keep using a ref initialized from props.
const localPosts = ref([...props.posts]);

const filterStatus = ref('pending'); // Default show pending
const filterCategory = ref('all');
const processing = ref(null);

// Edit modal state
const showEditModal = ref(false);
const editingPost = ref(null);
const editForm = ref({
  title: '',
  tag: '',
  category: '',
  image: null
});
const editPreview = ref(null);
const saving = ref(false);

const handleFileSelect = (event) => {
  const file = event.target.files[0];
  if (file) {
    editForm.value.image = file;
    const reader = new FileReader();
    reader.onload = (e) => editPreview.value = e.target.result;
    reader.readAsDataURL(file);
  }
};

// Client-side filtering
const filteredPosts = computed(() => {
  return localPosts.value.filter(post => {
    const statusMatch = filterStatus.value === 'all' || post.status === filterStatus.value;
    const categoryMatch = filterCategory.value === 'all' || post.category === filterCategory.value;
    return statusMatch && categoryMatch;
  });
});

const pendingCount = computed(() => {
  return localPosts.value.filter(p => p.status === 'pending').length;
});

const approvePost = async (post) => {
  if (!confirm(`Approve postingan "${post.title}"?`)) return;
  
  processing.value = post.id;
  try {
    await axios.post(`/admin/posts/${post.id}/approve`);
    // Update local state
    const index = localPosts.value.findIndex(p => p.id === post.id);
    if (index !== -1) {
      localPosts.value[index].status = 'approved';
    }
  } catch (error) {
    alert('Gagal approve post');
  } finally {
    processing.value = null;
  }
};

const rejectPost = async (post) => {
  if (!confirm(`Reject postingan "${post.title}"?`)) return;

  processing.value = post.id;
  try {
    await axios.post(`/admin/posts/${post.id}/reject`);
    // Update local state
    const index = localPosts.value.findIndex(p => p.id === post.id);
    if (index !== -1) {
      localPosts.value[index].status = 'rejected';
    }
  } catch (error) {
    alert('Gagal reject post');
  } finally {
    processing.value = null;
  }
};

// Edit functions
const openEditModal = (post) => {
  editingPost.value = post;
  editForm.value = {
    title: post.title,
    tag: post.tag || '',
    category: post.category,
    image: null
  };
  editPreview.value = post.image_url;
  showEditModal.value = true;
};

const closeEditModal = () => {
  showEditModal.value = false;
  editingPost.value = null;
  editForm.value = { title: '', tag: '', category: '', image: null };
  editPreview.value = null;
};

const saveEdit = async () => {
  if (!editingPost.value) return;
  
  saving.value = true;
  try {
    const formData = new FormData();
    formData.append('_method', 'PUT'); // For Laravel with FormData
    formData.append('title', editForm.value.title);
    formData.append('tag', editForm.value.tag);
    formData.append('category', editForm.value.category);
    if (editForm.value.image) {
      formData.append('image', editForm.value.image);
    }

    const response = await axios.post(`/admin/posts/${editingPost.value.id}`, formData, {
      headers: { 'Content-Type': 'multipart/form-data' }
    });
    
    // Update local state
    const index = localPosts.value.findIndex(p => p.id === editingPost.value.id);
    if (index !== -1) {
      localPosts.value[index].title = editForm.value.title;
      localPosts.value[index].tag = editForm.value.tag;
      localPosts.value[index].category = editForm.value.category;
      if (response.data.post.image_url) {
        localPosts.value[index].image_url = response.data.post.image_url;
        localPosts.value[index].image = response.data.post.image;
      }
    }
    
    closeEditModal();
    alert('Postingan berhasil diupdate!');
  } catch (error) {
    alert('Gagal mengupdate postingan');
    console.error(error);
  } finally {
    saving.value = false;
  }
};
</script>
