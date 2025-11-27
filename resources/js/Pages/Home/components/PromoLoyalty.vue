<template>
  <div class="min-h-screen bg-stone-50 flex flex-col">
    <!-- Navbar sama seperti Home -->
    <nav class="fixed w-full z-50 bg-white shadow-md py-1">
      <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
        <Link href="/" class="flex items-center gap-3">
          <img 
            src="/public/utara.jpg" 
            alt="Logo Utara" 
            class="h-20 opacity-100"
          />
        </Link>

        <ul class="hidden md:flex items-center gap-8 font-medium text-gray-700">
          <li><Link href="/" class="hover:text-emerald-600 transition">Home</Link></li>
          <li><a href="/#menu" class="hover:text-emerald-600 transition">Menu</a></li>
          <li>
            <Link href="/promo-loyalty" class="text-emerald-700 border-b-2 border-emerald-600 pb-1">
              Promo &amp; Loyalty
            </Link>
          </li>
          <li><a href="/#tetangga" class="hover:text-emerald-600 transition">Community</a></li>
          <li><a href="/#about" class="hover:text-emerald-600 transition">About Us</a></li>
          <li><a href="/#blog" class="hover:text-emerald-600 transition">Blog</a></li>
          <li><a href="/#contact" class="hover:text-emerald-600 transition">Contact Us</a></li>
          <li><a href="/#location" class="hover:text-emerald-600 transition">Location</a></li>
        </ul>

        <div class="flex gap-3">
          <Link href="/login" class="bg-blue-500 text-white px-5 py-2 rounded-full hover:bg-blue-600 transition font-medium">
            Login
          </Link>
          <button class="bg-emerald-600 text-white px-5 py-2 rounded-full hover:bg-emerald-700 transition font-medium">
            Order Now
          </button>
        </div>
      </div>
    </nav>



    <!-- Spacer untuk navbar fixed -->
    <div class="h-24"></div>

    <!-- Hero / Form Section dengan Full Width -->
    <section class="bg-[#0f3d2e] text-center text-pink-100 py-14 px-4">
      <div class="max-w-4xl mx-auto space-y-7">
        <div>
          <h1 class="text-4xl md:text-5xl font-black text-pink-200 mb-2 tracking-tight">
            Cek Loyalty Card Kamu
          </h1>
          <p class="text-lg md:text-xl font-semibold">Kamu • Bisa • Ngopi • Gratis</p>
        </div>

        <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 justify-center">
          <button
            @click="showModal = true"
            class="bg-black text-white px-6 py-3 rounded-md font-semibold shadow hover:bg-gray-900 transition"
          >
            Buat Akun
          </button>
          <div class="flex items-center bg-black/80 text-white rounded-md shadow overflow-hidden w-full md:w-auto">
            <input
              type="tel"
              placeholder="Masukkan Nomor handphone kamu"
              class="flex-1 bg-transparent placeholder-gray-300 px-4 py-3 outline-none text-sm md:min-w-[340px]"
            />
            <button class="bg-white text-black px-4 py-3 flex items-center justify-center hover:bg-gray-200 transition">
              <span class="sr-only">Cari</span>
              🔍
            </button>
          </div>
        </div>

        <!-- Stamp Card -->
        <div class="max-w-5xl mx-auto bg-pink-200 border-4 border-pink-300 rounded-2xl shadow-2xl">
          <div class="border-b-2 border-pink-300/70 px-8 py-8">
            <h3 class="text-5xl md:text-6xl font-black text-[#0f3d2e]">SIP &amp; SAVE!</h3>
            <p class="text-xl md:text-2xl text-[#0f3d2e] mt-3 font-semibold">
              Buy 9 cups of coffee, get the 10th one FREE.
            </p>
          </div>

          <div class="px-10 py-10 space-y-8">
            <div class="grid grid-cols-5 gap-6 justify-items-center">
              <div
                v-for="n in 10"
                :key="n"
                class="h-16 w-16 md:h-20 md:w-20 rounded-full bg-pink-300 shadow-inner border-2 border-pink-400/70"
              ></div>
            </div>

            <div class="flex justify-center">
              <div class="rounded-full bg-emerald-700 text-white px-6 py-4 text-sm md:text-base font-bold uppercase tracking-wide shadow-lg">
                Utara
              </div>
            </div>
          </div>

          <div class="border-t-2 border-pink-300/70 px-8 py-6">
            <p class="text-lg md:text-xl text-[#0f3d2e] font-semibold">
              Collect 9 coffee stamps, and your next brew is on us
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact / Map -->
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

    <!-- Modal Popup -->
    <Transition name="modal">
      <div 
        v-if="showModal" 
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-md p-4"
        @click.self="showModal = false"
      >
        <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full relative overflow-hidden">
          <!-- Close Button -->
          <button 
            @click="showModal = false"
            class="absolute top-5 right-5 z-10 text-gray-500 hover:text-gray-800 transition-colors duration-200 bg-white/80 backdrop-blur-sm rounded-full p-2 hover:bg-gray-100"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>

          <!-- Modal Content -->
          <div class="p-10 text-center">
            <!-- Header Title -->
            <h3 class="text-2xl font-black text-gray-900 mb-6">Mau buat akun?</h3>
            
            <!-- Image Mas Aziz with decorative background -->
            <div class="mb-6 flex justify-center relative">
              <div class="absolute inset-0 bg-gradient-to-br from-blue-100 to-emerald-100 rounded-full blur-3xl opacity-30 scale-75"></div>
              <img 
                src="/public/Masaziz.png" 
                alt="Mas Aziz" 
                class="w-56 h-auto object-contain relative z-10 drop-shadow-2xl"
              />
            </div>

            <!-- Main Title -->
            <h4 class="text-3xl font-black text-gray-900 mb-4 leading-tight">
              Mau buat akun?
            </h4>
            
            <!-- Description Text -->
            <p class="text-gray-700 text-lg mb-8 leading-relaxed max-w-sm mx-auto font-medium">
              Bilang ke mas barista nya ya, mau buat membership!
            </p>

            <!-- Button with gradient -->
            <button 
              @click="showModal = false"
              class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold text-base px-10 py-3 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105"
            >
              Mengerti
            </button>
          </div>
        </div>
      </div>
    </Transition>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

// State untuk modal
const showModal = ref(false);

// Data untuk maps
const mapsEmbedUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.123456789!2d110.123456!3d-7.123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMDcnMjQuNSJTIDExMMKwMDcnMjQuNSJF!5e0!3m2!1sen!2sid!4v1234567890";

// Methods
const openWhatsApp = () => {
  window.open('https://wa.me/6281215246678', '_blank');
};

const openInstagram = () => {
  window.open('https://instagram.com/utara.yk', '_blank');
};

const openTiktok = () => {
  window.open('https://tiktok.com/@utara.yk', '_blank');
};

const openMaps = () => {
  window.open('https://maps.google.com/?q=Utara+Coffee', '_blank');
};
</script>

<style scoped>
/* Modal Transition Animations */
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

.modal-enter-active .bg-white,
.modal-leave-active .bg-white {
  transition: transform 0.3s ease;
}

.modal-enter-from .bg-white,
.modal-leave-to .bg-white {
  transform: scale(0.9);
}
</style>

