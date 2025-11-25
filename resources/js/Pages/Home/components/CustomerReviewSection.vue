<template>
  <section id="reviews" class="bg-[#050B16] text-white py-16">
    <div class="w-full px-6 md:px-16 flex flex-col gap-8">
      <div
        class="w-full flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-white/20 pb-6"
      >
        <div>
          <p class="uppercase tracking-[0.4rem] text-emerald-200 text-sm">Kata Kostumer</p>
          <h2 class="text-4xl md:text-5xl font-bold mt-2">Cerita hangat dari tetangga kami</h2>
          <p class="text-white/70 text-lg mt-2">
            Bagikan pengalamanmu menikmati kopi, tempat, dan waktu di Utara.
          </p>
        </div>
        <button
          @click="openForm"
          class="self-start md:self-auto bg-sky-500 hover:bg-sky-400 text-white px-6 py-3 rounded-xl font-semibold transition shadow-lg"
        >
          Tambahkan Review
        </button>
      </div>

      <div
        class="flex gap-6 overflow-x-auto pb-4 -mx-6 md:-mx-16 px-6 md:px-16 snap-x snap-mandatory"
        style="scrollbar-width: thin"
      >
        <article
          v-for="review in displayedReviews"
          :key="review.id || review.name"
          class="min-w-[260px] max-w-sm bg-white text-gray-900 rounded-3xl shadow-2xl border border-slate-200 flex flex-col gap-4 p-6 snap-start"
        >
          <div class="flex items-center gap-4">
            <img
              :src="review.avatar_url || defaultAvatar"
              alt="avatar"
              class="h-12 w-12 rounded-full object-cover border border-slate-200"
            />
            <div>
              <p class="font-semibold text-lg leading-tight">{{ review.name }}</p>
              <p class="text-sm text-gray-500">{{ review.title || 'Tetangga Setia Utara' }}</p>
            </div>
          </div>

          <div class="flex items-center gap-2 text-amber-500">
            <div class="flex text-xl leading-none">
              <span v-for="i in 5" :key="i">
                {{ starIcon(i, review.rating) }}
              </span>
            </div>
            <span class="text-gray-700 font-semibold text-sm">{{ formatRating(review.rating) }}</span>
          </div>

          <p class="text-gray-700 text-sm leading-relaxed">
            {{ review.message }}
          </p>
        </article>
      </div>
    </div>
  </section>

  <section id="location" class="bg-[#e9f3ff] border-t border-[#cbd7e8] py-16">
    <div class="w-full px-4 sm:px-8">
      <div class="flex flex-col lg:flex-row gap-6 w-full">
        <div
          class="w-full lg:w-1/2 bg-white rounded-3xl shadow-[0_12px_30px_rgba(17,24,39,0.12)] p-8 border border-black"
        >
          <div class="flex items-center gap-4 mb-6">
            <img src="/public/logo.png" alt="Logo Utara" class="h-16" />
            <h3 class="text-4xl font-extrabold tracking-wide text-[#00553d]">UTARA</h3>
          </div>
          <p class="text-lg text-gray-800 leading-relaxed">
            Tempatnya cerita, tawa, dan kopi yang diseduh dengan hati. Kami hadir di belakang kampus
            untuk menemani tugas, obrolan, dan pagi yang hangat.
          </p>
          <div class="mt-8 grid gap-4 sm:grid-cols-2">
            <button
              class="rounded-2xl border-2 border-black shadow-[0_8px_0_rgba(0,0,0,0.25)] overflow-hidden text-left bg-white"
              @click="openWhatsApp"
            >
              <div class="bg-[#6dc5ff] px-5 py-3">
                <p class="font-semibold text-sm uppercase tracking-wide text-black">
                  Kontak Whatsapp / Reservasi
                </p>
              </div>
              <div class="px-5 py-5">
                <p class="text-3xl font-extrabold tracking-widest text-black text-center">
                  0812 1524 6678
                </p>
              </div>
            </button>
            <div
              class="rounded-2xl border-2 border-black shadow-[0_8px_0_rgba(0,0,0,0.25)] overflow-hidden bg-white"
            >
              <div class="bg-[#aaf1c6] px-5 py-3">
                <p class="font-semibold text-sm uppercase tracking-wide text-black text-center">
                  Sosial Media
                </p>
              </div>
              <div class="px-5 py-4 flex items-center justify-center gap-6">
                <button
                  class="flex items-center gap-2 text-black font-semibold"
                  @click="openInstagram"
                >
                  <img src="/public/instagram.png" alt="Instagram" class="h-6 w-6 object-contain" />
                  <span>@Utara.yk</span>
                </button>
                <button
                  class="flex items-center gap-2 text-black font-semibold"
                  @click="openTiktok"
                >
                  <span class="text-xl font-bold">TikTok</span>
                  <span>Utara.yk</span>
                </button>
              </div>
            </div>
          </div>
          <button
            class="mt-6 inline-flex items-center gap-2 text-[#00553d] font-semibold underline decoration-dotted"
            @click="openMaps"
          >
            Lihat di Google Maps
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>

        <div
          class="w-full lg:w-1/2 bg-white rounded-3xl border-2 border-black shadow-[0_12px_30px_rgba(17,24,39,0.12)] overflow-hidden flex flex-col"
        >
          <div class="px-6 py-4 border-b border-black flex items-center gap-3">
            <span class="text-xl font-semibold">Map</span>
            <p class="text-sm text-gray-900 font-semibold">
              Jl. Kemuning, Tlogo, Tamantirto <span class="font-bold">(Belakang Unires Putra UMY)</span>
            </p>
          </div>
          <div class="relative flex-1 cursor-pointer" @click="openMaps">
            <iframe
              class="w-full h-full pointer-events-none"
              :src="mapsEmbedUrl"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
            <div class="absolute inset-0 border-t-4 border-[#0a2240] pointer-events-none"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <transition name="fade">
    <div v-if="showForm" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center px-4">
      <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 space-y-4 relative">
        <button @click="closeForm" class="absolute right-4 top-4 text-gray-500 hover:text-gray-800">
          X
        </button>
        <h3 class="text-2xl font-bold text-gray-900">Bagikan Review-mu</h3>
        <p class="text-sm text-gray-500">Kami senang mendengar pengalamanmu di Utara.</p>

        <form @submit.prevent="submitForm" class="space-y-4">
          <div>
            <label class="text-sm font-medium text-gray-700">Nama</label>
            <input
              v-model="form.name"
              type="text"
              class="w-full mt-1 rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:outline-none"
              placeholder="Agung Prio Rismawan"
            />
            <p v-if="errors.name" class="text-xs text-red-500 mt-1">{{ errors.name }}</p>
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700">Peran / Kesibukan</label>
            <input
              v-model="form.title"
              type="text"
              class="w-full mt-1 rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:outline-none"
              placeholder="Mahasiswa, Freelancer, dsb."
            />
            <p v-if="errors.title" class="text-xs text-red-500 mt-1">{{ errors.title }}</p>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="text-sm font-medium text-gray-700">Rating</label>
              <select
                v-model="form.rating"
                class="w-full mt-1 rounded-xl border border-gray-300 px-4 py-2 bg-white focus:ring-2 focus:ring-emerald-500 focus:outline-none"
              >
                <option v-for="option in ratingOptions" :key="option" :value="option">
                  {{ option }}
                </option>
              </select>
              <p v-if="errors.rating" class="text-xs text-red-500 mt-1">{{ errors.rating }}</p>
            </div>
            <div>
              <label class="text-sm font-medium text-gray-700">Foto Profil</label>
              <div
                class="mt-1 border-2 border-dashed border-gray-300 rounded-xl p-4 flex flex-col items-center justify-center text-sm text-gray-500 cursor-pointer hover:border-emerald-500 transition"
                @click="triggerAvatarUpload"
              >
                <input
                  ref="avatarInput"
                  type="file"
                  accept="image/*"
                  class="hidden"
                  @change="onAvatarChange"
                />
                <template v-if="avatarPreview">
                  <img :src="avatarPreview" alt="Preview" class="h-20 w-20 rounded-full object-cover mb-2" />
                  <p class="text-xs text-gray-400">Klik untuk ganti foto</p>
                </template>
                <template v-else>
                  <span class="text-2xl mb-1 font-semibold">Upload</span>
                  <p>Klik untuk upload foto</p>
                </template>
              </div>
              <p v-if="errors.avatar" class="text-xs text-red-500 mt-1">{{ errors.avatar }}</p>
            </div>
          </div>

          <div>
            <label class="text-sm font-medium text-gray-700">Cerita kamu</label>
            <textarea
              v-model="form.message"
              rows="4"
              class="w-full mt-1 rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:outline-none"
              placeholder="Cerita singkatmu ketika menikmati waktu di Utara..."
            ></textarea>
            <p v-if="errors.message" class="text-xs text-red-500 mt-1">{{ errors.message }}</p>
          </div>

          <p v-if="errors.general" class="text-sm text-red-500">{{ errors.general }}</p>

          <button
            type="submit"
            :disabled="submitting"
            class="w-full bg-emerald-600 hover:bg-emerald-700 disabled:bg-emerald-400 text-white font-semibold py-3 rounded-xl transition"
          >
            {{ submitting ? 'Mengirim...' : 'Kirim Review' }}
          </button>
        </form>
      </div>
    </div>
  </transition>
</template>

<script setup>
import { computed, onMounted, reactive, ref } from 'vue';

const reviews = ref([]);
const showForm = ref(false);
const submitting = ref(false);
const errors = reactive({});
const avatarInput = ref(null);
const avatarFile = ref(null);
const avatarPreview = ref(null);

const form = reactive({
  name: '',
  title: '',
  rating: 4.5,
  message: '',
});

const defaultAvatar = '/public/orang1.png';
const mapsUrl = 'https://maps.app.goo.gl/d5qfdnQCY6A2tpT66';
const mapQuery = encodeURIComponent('Jl. Kemuning, Tlogo, Tamantirto (Belakang Unires Putra UMY)');
const mapsEmbedUrl = `https://www.google.com/maps?width=700&height=440&hl=id&q=${mapQuery}&t=&z=17&ie=UTF8&iwloc=B&output=embed`;

const ratingOptions = [5, 4.5, 4, 3.5, 3];

const placeholderReviews = [
  {
    name: 'Agung Prio Rismawan',
    title: 'Mahasiswa UMY',
    rating: 4.5,
    message:
      'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.',
    avatar_url: '/public/orang1.png',
  },
  {
    name: 'Alya Nabila',
    title: 'Content Creator',
    rating: 4.5,
    message:
      'Tempat favorit buat ngerjain konten, kopi enak dan suasana super nyaman. Staff ramah banget!',
    avatar_url: '/public/orang2.png',
  },
  {
    name: 'Farhan Nugraha',
    title: 'Freelance Designer',
    rating: 4.5,
    message:
      'Colokan banyak, wifi kenceng, makanan enak. Cocok banget buat kerja remote seharian.',
    avatar_url: '/public/orang3.png',
  },
];

const displayedReviews = computed(() => (reviews.value.length ? reviews.value : placeholderReviews));

const starIcon = (index, rating) => {
  const parsed = Number(rating) || 0;
  return parsed >= index ? '*' : '.';
};

const formatRating = (rating) => {
  const parsed = Number(rating) || 0;
  return parsed.toFixed(1);
};

const openForm = () => {
  resetForm();
  showForm.value = true;
};

const closeForm = () => {
  showForm.value = false;
  resetForm();
};

const resetForm = () => {
  form.name = '';
  form.title = '';
  form.rating = 4.5;
  form.message = '';
  avatarFile.value = null;
  if (avatarPreview.value) {
    URL.revokeObjectURL(avatarPreview.value);
  }
  avatarPreview.value = null;
  if (avatarInput.value) {
    avatarInput.value.value = '';
  }
  clearErrors();
};

const triggerAvatarUpload = () => {
  avatarInput.value?.click();
};

const onAvatarChange = (event) => {
  const file = event.target.files?.[0];
  if (file) {
    avatarFile.value = file;
    if (avatarPreview.value) {
      URL.revokeObjectURL(avatarPreview.value);
    }
    avatarPreview.value = URL.createObjectURL(file);
    delete errors.avatar;
  }
};

const clearErrors = () => {
  Object.keys(errors).forEach((key) => {
    delete errors[key];
  });
};

const csrfToken =
  document.head.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

const submitForm = async () => {
  clearErrors();
  submitting.value = true;

  try {
    const payload = new FormData();
    payload.append('name', form.name.trim());
    payload.append('title', form.title.trim() || '');
    payload.append('rating', Number(form.rating).toString());
    payload.append('message', form.message.trim());
    if (avatarFile.value) {
      payload.append('avatar', avatarFile.value);
    }

    const response = await fetch('/reviews', {
      method: 'POST',
      headers: {
        Accept: 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: payload,
    });

    if (response.status === 422) {
      const data = await response.json();
      Object.assign(errors, data.errors || {});
      submitting.value = false;
      return;
    }

    if (!response.ok) {
      errors.general = 'Terjadi kesalahan saat mengirim review.';
      submitting.value = false;
      return;
    }

    const saved = await response.json();
    reviews.value = [saved, ...reviews.value];
    resetForm();
    closeForm();
  } catch (error) {
    errors.general = 'Tidak dapat terhubung ke server.';
  } finally {
    submitting.value = false;
  }
};

const fetchReviews = async () => {
  try {
    const response = await fetch('/reviews');
    if (response.ok) {
      reviews.value = await response.json();
    }
  } catch (error) {
    console.error('Failed to fetch reviews', error);
  }
};

const openWhatsApp = () => {
  window.open('https://wa.me/6281215246678', '_blank');
};

const openMaps = () => {
  window.open(mapsUrl, '_blank');
};

const openInstagram = () => {
  window.open('https://instagram.com/Utara.yk', '_blank');
};

const openTiktok = () => {
  window.open('https://www.tiktok.com/@Utara.yk', '_blank');
};

onMounted(() => {
  fetchReviews();
});
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
