<template>
  <div class="flex min-h-screen bg-gray-100 font-sans">
    <!-- SIDEBAR -->
    <AdminSidebar />

    <!-- CONTENT -->
    <main class="flex-1 p-8 overflow-y-auto">
      <!-- HEADER -->
      <div class="mb-8 pb-4 border-b flex justify-between items-center">
        <div>
          <h1 class="text-3xl font-bold text-gray-800">Moderasi Postingan</h1>
          <p class="text-sm text-gray-500">
            Kelola postingan komunitas (Approve/Reject)
          </p>
        </div>
        
        <!-- PENDING COUNTER -->
        <div class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg font-bold border border-yellow-200">
          {{ pendingCount }} Pending
        </div>
      </div>

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

    </main>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import AdminSidebar from "@/Layouts/AdminSidebar.vue";
import axios from 'axios';
import { router } from '@inertiajs/vue3';

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
</script>
