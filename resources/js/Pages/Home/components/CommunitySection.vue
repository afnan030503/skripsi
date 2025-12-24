<template>
  <!-- ================= TOAST NOTIFICATION ================= -->
  <transition name="slide-down">
    <div
      v-if="showToast"
      class="fixed top-20 left-1/2 -translate-x-1/2 z-[100] w-full max-w-md px-4"
    >
      <div class="bg-white border-l-4 border-green-500 rounded-lg shadow-2xl p-4 flex items-start gap-3">
        <div class="flex-shrink-0">
          <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <div class="flex-1">
          <h4 class="text-sm font-bold text-gray-900 mb-1">Upload Berhasil! 🎉</h4>
          <p class="text-xs text-gray-600">
            Postingan Anda telah diterima dan sedang menunggu persetujuan dari admin. 
            Kami akan segera meninjau konten Anda!
          </p>
        </div>
        <button @click="showToast = false" class="flex-shrink-0 text-gray-400 hover:text-gray-600">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
    </div>
  </transition>

  <!-- ================= HERO KOMUNITAS ================= -->
  <section id="tetangga" class="relative h-[calc(80vh-57px)] bg-[#0f3d2e] py-10">
    <div class="pl-5 pt-10 font-tuku_handwriting text-3xl lg:pl-16 text-white">
      <h3>
        "DARI PELANGGAN," <br />
        "JADI TEMAN"
      </h3>
    </div>

    <div class="h-[20px]"></div>

    <div
      class="relative mt-6 flex h-[calc(80vh-220px)] min-w-full overflow-x-auto overflow-y-hidden gap-10 px-10"
    >
      <div
        class="group relative w-fit flex-shrink-0 overflow-visible cursor-pointer"
      >
        <img
          src="/public/orang1.png"
          alt="Tetangga Petani Garut"
          class="h-full w-auto object-contain transition-all duration-500 group-hover:scale-[1.03]"
        />

        <div
          class="absolute bottom-0 left-1/2 z-10 -translate-x-1/2 translate-y-0 opacity-0
                 group-hover:opacity-100 group-hover:-translate-y-3
                 transition-all duration-500 ease-in-out
                 whitespace-nowrap border border-black
                 bg-[#f1e8d7] px-6 py-3 rounded-md
                 font-tuku_handwriting text-2xl shadow-sm"
        >
          Tetangga Petani Garut
        </div>
      </div>

      <div
        class="group relative w-fit flex-shrink-0 overflow-visible cursor-pointer"
      >
        <img
          src="/public/orang2.png"
          alt="NFTetangga Bintaro"
          class="h-full w-auto object-contain transition-all duration-500 group-hover:scale-[1.03]"
        />

        <div
          class="absolute bottom-0 left-1/2 z-10 -translate-x-1/2 translate-y-0 opacity-0
                 group-hover:opacity-100 group-hover:-translate-y-3
                 transition-all duration-500 ease-in-out
                 whitespace-nowrap border border-black
                 bg-[#f1e8d7] px-6 py-3 rounded-md
                 font-tuku_handwriting text-2xl shadow-sm"
        >
          NFTetangga Bintaro
        </div>
      </div>

      <div
        class="group relative w-fit flex-shrink-0 overflow-visible cursor-pointer"
      >
        <img
          src="/public/orang3.png"
          alt="Tetangga Cipete"
          class="h-full w-auto object-contain transition-all duration-500 group-hover:scale-[1.03]"
        />

        <div
          class="absolute bottom-0 left-1/2 z-10 -translate-x-1/2 translate-y-0 opacity-0
                 group-hover:opacity-100 group-hover:-translate-y-3
                 transition-all duration-500 ease-in-out
                 whitespace-nowrap border border-black
                 bg-[#f1e8d7] px-6 py-3 rounded-md
                 font-tuku_handwriting text-2xl shadow-sm"
        >
          Tetangga Cipete
        </div>
      </div>

      <div
        class="group relative w-fit flex-shrink-0 overflow-visible cursor-pointer"
      >
        <img
          src="/public/orang4.png"
          alt="Tetangga BSD"
          class="h-full w-auto object-contain transition-all duration-500 group-hover:scale-[1.03]"
        />

        <div
          class="absolute bottom-0 left-1/2 z-10 -translate-x-1/2 translate-y-0 opacity-0
                 group-hover:opacity-100 group-hover:-translate-y-3
                 transition-all duration-500 ease-in-out
                 whitespace-nowrap border border-black
                 bg-[#f1e8d7] px-6 py-3 rounded-md
                 font-tuku_handwriting text-2xl shadow-sm"
        >
          Tetangga BSD
        </div>
      </div>
    </div>
  </section>

  <!-- ================= GALERI KOMUNITAS ================= -->
  <section class="py-20 bg-white w-full">
    <div class="px-6 w-full">
      <!-- HEADER -->
      <div class="flex items-center justify-between mb-12">
        <h2 class="text-5xl font-bold text-black">Galeri Komunitas</h2>

        <button
          @click="openModal"
          class="px-4 py-2 border border-black text-black rounded-lg hover:bg-black hover:text-white transition"
        >
          Tambahkan Post
        </button>
      </div>

      <!-- LOOP KATEGORI -->
      <div v-for="category in categories" :key="category" class="mb-12">
        <h3 class="text-2xl font-bold text-black mb-4">{{ category }}</h3>

        <div class="overflow-x-auto pb-4">
          <div class="flex gap-6 min-w-full snap-x snap-mandatory">
            <!-- Jika ADA postingan dari database -->
            <template v-if="postsByCategory(category).length > 0">
            <div
              v-for="post in postsByCategory(category)"
              :key="post.id"
              class="rounded-[32px] overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1 bg-white h-80 flex flex-col flex-shrink-0 w-[260px] snap-start"
            >
              <div
                class="px-4 py-3 flex items-center justify-between"
                :style="{ backgroundColor: post.color || '#a0aec0' }"
              >
                <div class="h-9 w-9 rounded-full bg-black/30 border border-white flex items-center justify-center overflow-hidden">
                  <img :src="logoSrc" alt="Utara logo" class="h-full w-full object-contain" />
                </div>
                <p class="text-white font-semibold text-sm tracking-wide truncate ml-3">
                  #{{ post.tag || post.category || 'Tetangga' }}
                </p>
              </div>

              <div
                class="flex-1 relative px-4 pb-6"
                :style="{ backgroundColor: post.color || '#a0aec0' }"
              >
                <div class="absolute inset-0 opacity-30 bg-gradient-to-b from-white/40 to-black/10 pointer-events-none"></div>
                <img
                  v-if="post.image || post.image_url"
                  :src="post.image_url || `/storage/${post.image}`"
                  class="relative z-10 w-full h-full object-contain drop-shadow-[0_15px_25px_rgba(0,0,0,0.3)]"
                />
              </div>
            </div>
          </template>

          <!-- Jika TIDAK ADA postingan → 5 placeholder -->
          <template v-else>
            <div
              v-for="i in 5"
              :key="i"
              class="rounded-[32px] overflow-hidden shadow-lg h-80 flex flex-col bg-white flex-shrink-0 w-[260px] snap-start"
            >
              <div class="px-4 py-3 flex items-center justify-between bg-gray-200">
                <div class="h-9 w-9 rounded-full bg-gray-400 flex items-center justify-center overflow-hidden">
                  <img :src="logoSrc" alt="Utara logo" class="h-full w-full object-contain" />
                </div>
                <p class="text-gray-600 font-semibold text-sm truncate ml-3">#{{ category }}</p>
              </div>
              <div class="flex-1 flex items-center justify-center bg-gray-100 text-gray-400 text-xs">
                Belum ada foto
              </div>
            </div>
          </template>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= POPUP MODAL ================= -->
  <transition name="fade">
    <div
      v-if="showModal"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
    >
      <div class="bg-white rounded-xl shadow-xl w-full max-w-5xl mx-4 relative p-8">
        <!-- Close Button -->
        <button
          @click="closeModal"
          class="absolute top-4 right-4 text-gray-700 hover:text-black text-2xl"
        >
          ✕
        </button>

        <!-- Title -->
        <h3 class="text-2xl font-bold text-gray-900 mb-8">
          Bagikan Momen di utara
        </h3>

        <!-- MAIN LAYOUT: LEFT UPLOAD + RIGHT FORM -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
          <!-- LEFT: UPLOAD BOX -->
          <div
            class="border-2 border-dashed border-gray-300 rounded-xl p-6 flex flex-col items-center justify-center cursor-pointer hover:border-black transition min-h-[340px]"
            @click="triggerFileInput"
          >
            <input
              ref="fileInput"
              type="file"
              accept="image/*"
              class="hidden"
              @change="onFileChange"
            />

            <!-- Preview -->
            <div v-if="imagePreview" class="w-full">
              <img
                :src="imagePreview"
                class="rounded-lg w-full h-[300px] object-cover"
              />
            </div>

            <!-- Empty box -->
            <div
              v-else
              class="flex flex-col items-center text-gray-500 text-center"
            >
              <span class="text-5xl mb-3">📄</span>
              <p class="text-sm leading-tight">
                drag paste click to upload an<br />image
              </p>
            </div>
          </div>

          <p v-if="errors.image" class="text-xs text-red-500 mt-2">
            {{ errors.image }}
          </p>

          <!-- RIGHT: FORM -->
          <div class="space-y-6">
            <!-- Title -->
            <div>
              <label class="text-sm font-semibold text-gray-800">
                Judul Post
              </label>
              <input
                v-model="form.title"
                type="text"
                class="w-full border rounded-lg px-4 py-2 mt-1 text-sm focus:ring-black focus:border-black"
                placeholder="Masukkan judul postingan"
              />
              <p v-if="errors.title" class="text-xs text-red-500 mt-1">
                {{ errors.title }}
              </p>
            </div>

            <!-- Category -->
            <div>
              <label class="text-sm font-semibold text-gray-800">
                Kategori
              </label>
              <div class="flex flex-wrap gap-2 mt-2">
                <button
                  v-for="option in categoryOptions"
                  :key="option"
                  type="button"
                  class="px-4 py-1 rounded-full border text-sm transition"
                  :class="form.category === option ? 'bg-black text-white border-black' : 'border-gray-300 text-gray-700'"
                  @click="form.category = option"
                >
                  {{ option }}
                </button>
              </div>
              <p v-if="errors.category" class="text-xs text-red-500 mt-1">
                {{ errors.category }}
              </p>
            </div>

            <!-- Tag -->
            <div>
              <label class="text-sm font-semibold text-gray-800">
                Tagar
              </label>
              <input
                v-model="form.tag"
                type="text"
                class="w-full border rounded-lg px-4 py-2 mt-1 text-sm focus:ring-black focus:border-black"
                placeholder="Masukkan tagar postingan"
              />
            </div>

            <!-- Colors -->
            <div>
              <label class="text-sm font-semibold text-gray-800">
                Pilih Warna Background
              </label>

              <div class="flex flex-wrap gap-3 mt-2">
                <button
                  v-for="color in colorOptions"
                  :key="color"
                  type="button"
                  class="w-8 h-8 rounded-full border-2"
                  :class="{
                    'border-black ring-2 ring-black': form.color === color,
                    'border-gray-400': form.color !== color
                  }"
                  :style="{ backgroundColor: color }"
                  @click="form.color = color"
                ></button>
              </div>

              <p v-if="errors.color" class="text-xs text-red-500 mt-1">
                {{ errors.color }}
              </p>
            </div>
          </div>
        </div>

        <!-- SUBMIT BUTTON -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mt-10">
          <p v-if="errors.general" class="text-sm text-red-500">
            {{ errors.general }}
          </p>
          <button
            class="px-6 py-2 bg-[#2196F3] hover:bg-[#1976D2] text-white font-semibold rounded shadow-md"
            :disabled="submitting"
            @click="submitForm"
          >
            Submit Post
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const categories = ['Sambat', 'Romansa', 'Skripshit'];
const logoSrc = '/logo.png';
const categoryOptions = [...categories];

const posts = ref([]);
const csrfToken = ref(
  document.head.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || null
);
const showModal = ref(false);
const submitting = ref(false);
const showToast = ref(false);

const fileInput = ref(null);
const selectedFile = ref(null);
const imagePreview = ref(null);

const form = ref({
  title: '',
  tag: '',
  category: categoryOptions[0],
  color: '',
});

const errors = ref({
  title: null,
  category: null,
  image: null,
  color: null,
  general: null,
});

const colorOptions = [
  '#F97373',
  '#FBBF24',
  '#4ADE80',
  '#38BDF8',
  '#A855F7',
  '#F97316',
];

const fetchCsrfToken = async () => {
  if (csrfToken.value) {
    return;
  }
  try {
    const res = await fetch('/csrf-token');
    if (res.ok) {
      const data = await res.json();
      csrfToken.value = data.csrf_token;
    }
  } catch (error) {
    console.error('Failed to retrieve CSRF token', error);
  }
};

const fetchPosts = async () => {
  try {
    const res = await fetch('/posts');
    if (res.ok) {
      posts.value = await res.json();
    }
  } catch (error) {
    console.error('Failed to fetch posts', error);
  }
};

const postsByCategory = (category) => {
  const categoryLower = category.toLowerCase();
  return posts.value.filter((post) => {
    const postCategory = (post.category || '').toLowerCase();
    if (postCategory) {
      return postCategory === categoryLower;
    }
    // fallback ke tag lama
    return (post.tag || '').toLowerCase() === categoryLower;
  });
};

const openModal = () => {
  resetForm();
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
  submitting.value = false;
};

const triggerFileInput = () => {
  fileInput.value.click();
};

const onFileChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    selectedFile.value = file;
    imagePreview.value = URL.createObjectURL(file);
    errors.value.image = null;
  }
};

const resetForm = () => {
  form.value = { title: '', tag: '', category: categoryOptions[0], color: '' };
  selectedFile.value = null;
  imagePreview.value = null;
  submitting.value = false;
  errors.value = {};
};

const submitForm = async () => {
  errors.value = {};
  submitting.value = true;

  if (!form.value.title) errors.value.title = 'Judul wajib diisi.';
  if (!form.value.category) errors.value.category = 'Kategori wajib dipilih.';
  if (!form.value.color) errors.value.color = 'Warna wajib dipilih.';
  if (!selectedFile.value) errors.value.image = 'Gambar wajib diupload.';

  if (Object.keys(errors.value).length) {
    submitting.value = false;
    return;
  }

  if (!csrfToken.value) {
    await fetchCsrfToken();
    if (!csrfToken.value) {
      errors.value.general = 'Token keamanan tidak tersedia. Coba ulangi beberapa saat lagi.';
      submitting.value = false;
      return;
    }
  }

  const payload = new FormData();
  payload.append('title', form.value.title);
  payload.append('category', form.value.category);
  if (form.value.tag) payload.append('tag', form.value.tag);
  payload.append('color', form.value.color);
  payload.append('image', selectedFile.value);

  try {
    const res = await fetch('/posts', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken.value,
        Accept: 'application/json',
      },
      body: payload,
    });

    if (res.ok) {
      await fetchPosts();
      resetForm();
      closeModal();
      
      // Tampilkan toast notification
      showToast.value = true;
      
      // Auto-hide toast setelah 5 detik
      setTimeout(() => {
        showToast.value = false;
      }, 5000);
    } else if (res.status === 422) {
      const data = await res.json();
      errors.value = data.errors || {};
    } else {
      errors.value.general = 'Gagal mengirim data.';
    }
  } catch (error) {
    errors.value.general = 'Gagal mengirim data.';
  } finally {
    submitting.value = false;
  }
};

onMounted(async () => {
  await fetchCsrfToken();
  await fetchPosts();
});
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.15s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Toast notification animation */
.slide-down-enter-active,
.slide-down-leave-active {
  transition: all 0.3s ease-out;
}
.slide-down-enter-from {
  transform: translate(-50%, -100%);
  opacity: 0;
}
.slide-down-leave-to {
  transform: translate(-50%, -100%);
  opacity: 0;
}
</style>
