<template>
  <div class="min-h-screen bg-[#f6f7f9] text-gray-900">
    <Header 
      :scrolled="scrolled" 
      :isMobileMenuOpen="isMobileMenuOpen"
      @toggleMobileMenu="isMobileMenuOpen = !isMobileMenuOpen"
    />

    <main class="pt-16 pb-20 space-y-0">
      <!-- GRID BCK1/BCK2 -->
      <section class="relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] w-screen">
        <div class="grid md:grid-cols-2 grid-rows-2 gap-0">
          <div
            class="min-h-[320px] md:min-h-[440px] lg:min-h-[520px] bg-left bg-cover w-full"
            style="background-image: url('/bck1.jpg'); background-color: #dfe7ea; background-position: left center;"
          ></div>

          <div class="bg-[#8fd0d8] flex flex-col justify-center items-center text-center px-8 py-12 w-full">
            <h2 class="text-3xl md:text-4xl font-black font-serif text-[#1e272b] mb-4 leading-snug">
              Tempat Nyaman untuk<br />Ngopi &amp; Nugas
            </h2>
            <p class="text-gray-800 max-w-lg leading-relaxed text-sm md:text-base">
              Kopi Utara adalah ruang santai di belakang kampus tempat cerita, ide, dan tawa bertemu dalam satu meja.
            </p>
          </div>

          <div class="bg-[#99d4de] flex flex-col justify-center items-center text-center px-8 py-12 w-full">
            <h3 class="text-3xl font-black font-serif text-[#1e272b] mb-6 leading-snug">
              Rumah Kedua untuk<br />Semua
            </h3>
            <p class="text-gray-900 max-w-lg leading-relaxed text-sm md:text-base">
              Dari mahasiswa yang kejar deadline hingga teman ngobrol santai, kami ingin jadi tempat kamu kembali setiap hari.
            </p>
          </div>

          <div
            class="min-h-[320px] md:min-h-[440px] lg:min-h-[520px] bg-right bg-cover w-full"
            style="background-image: url('/bck1.jpg'); background-color: #dfe7ea; background-position: right center;"
          ></div>
        </div>
      </section>

      <!-- PHILOSOPHY SECTION -->
      <section class="w-full">
        <!-- Header -->
        <div class="bg-black py-10 text-center">
          <h2 class="text-3xl md:text-5xl font-serif font-black text-yellow-400 flex items-center justify-center gap-4 tracking-wide">
            <span class="text-green-500 text-4xl transform -rotate-12">🌱</span>
            Filosofi & Nilai Kami
          </h2>
        </div>

        <!-- Columns -->
        <div class="grid grid-cols-1 md:grid-cols-3">
          <!-- Column 1 -->
          <div class="bg-[#6B82F8] p-12 md:p-16 text-center flex flex-col items-center justify-center min-h-[350px]">
            <h3 class="text-3xl font-serif font-black mb-6 text-black tracking-tight">Kopi untuk Semua</h3>
            <p class="text-gray-900 text-lg leading-relaxed max-w-xs font-medium">
              Kami menghadirkan kopi dan minuman segar dengan harga yang ramah kantong mahasiswa tanpa mengorbankan rasa dan kualitas.
            </p>
          </div>

          <!-- Column 2 -->
          <div class="bg-[#FF99D6] p-12 md:p-16 text-center flex flex-col items-center justify-center min-h-[350px]">
            <h3 class="text-3xl font-serif font-black mb-6 text-black tracking-tight">Ruang untuk Terhubung</h3>
            <p class="text-gray-900 text-lg leading-relaxed max-w-xs font-medium">
              Kopi Utara dirancang sebagai tempat yang hidup: bisa buat kerja, main kartu, ngobrol, curhat, atau sekadar duduk menikmati suasana.
            </p>
          </div>

          <!-- Column 3 -->
          <div class="bg-[#5BC0F8] p-12 md:p-16 text-center flex flex-col items-center justify-center min-h-[350px]">
            <h3 class="text-3xl font-serif font-black mb-6 text-black tracking-tight">Lokal & Autentik</h3>
            <p class="text-gray-900 text-lg leading-relaxed max-w-xs font-medium">
              Rasa yang jujur, pelayanan yang tulus, dan vibe yang hangat. Itu yang ingin kami jaga dalam setiap seduhan dan kunjungan.
            </p>
          </div>
        </div>
      </section>

      <!-- MOSAIC SECTION -->
      <section class="w-full">
        <!-- Row 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 min-h-[500px]">
          <div class="bg-[#FFD700] flex items-center justify-center p-12 md:p-20 text-center order-2 md:order-1">
            <h3 class="text-4xl md:text-6xl font-serif font-black text-black leading-tight">
              Kopi susu sebagai menu favorit
            </h3>
          </div>
          <div class="h-[500px] md:h-auto order-1 md:order-2">
            <img src="/public/bck4.jpg" class="w-full h-full object-cover object-left" alt="Kopi Susu" />
          </div>
        </div>

        <!-- Row 2 -->
        <div class="grid grid-cols-1 md:grid-cols-2 min-h-[500px]">
          <div class="h-[500px] md:h-auto">
            <img src="/public/bck5.jpg" class="w-full h-full object-cover" alt="Tempat Nyaman" />
          </div>
          <div class="bg-[#6EE7B7] flex items-center justify-center p-12 md:p-20 text-center">
            <h3 class="text-4xl md:text-6xl font-serif font-black text-black leading-tight">
              Tempat yang nyaman buat nugas, meeting kecil, dan santai sore
            </h3>
          </div>
        </div>

        <!-- Row 3 -->
        <div class="grid grid-cols-1 md:grid-cols-2 min-h-[500px]">
          <div class="bg-[#F9A8D4] flex items-center justify-center p-12 md:p-20 text-center order-2 md:order-1">
            <h3 class="text-4xl md:text-6xl font-serif font-black text-black leading-tight">
              Signature refreshment
            </h3>
          </div>
          <div class="h-[500px] md:h-auto order-1 md:order-2">
            <img src="/public/bck6.png" class="w-full h-full object-cover" alt="Signature Refreshment" />
          </div>
        </div>

        <!-- Row 4 -->
        <div class="grid grid-cols-1 md:grid-cols-2 min-h-[500px]">
          <div class="h-[500px] md:h-auto">
            <img src="/public/bck7.png" class="w-full h-full object-cover" alt="Burger & Snack" />
          </div>
          <div class="bg-[#F5E6CA] flex items-center justify-center p-12 md:p-20 text-center">
            <h3 class="text-4xl md:text-6xl font-serif font-black text-black leading-tight">
              Burger & snack untuk teman ngopi
            </h3>
          </div>
        </div>
      </section>
    <section class="relative py-20 px-6 flex items-center justify-center min-h-[500px]">
        <!-- Background Image with Blur -->
        <div class="absolute inset-0 z-0">
          <img src="/public/bck8.png" class="w-full h-full object-cover blur-sm" alt="Background">
          <div class="absolute inset-0 bg-black/20"></div>
        </div>

        <!-- Content Card -->
        <div class="relative z-10 bg-white rounded-3xl p-10 md:p-14 max-w-4xl text-center shadow-2xl">
          <h2 class="text-3xl md:text-4xl font-serif font-black text-black mb-6">Dari Kami, Untuk Kamu</h2>
          <p class="text-gray-800 text-lg leading-relaxed">
            Kopi Utara ingin kamu merasa diterima seperti teman. Setiap kali kamu datang, kami ingin kamu pulang dengan perasaan lebih baik entah karena kopinya enak, suasananya nyaman, atau karena kamu menemukan momen kecil yang berarti di sini.
          </p>
        </div>
      </section>
      <!-- HERO BEIGE + CREW -->
      <section class="bg-[#FDF6E3] border-t-[10px] border-[#2f2a24] py-16 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center">
          <h1 class="text-4xl md:text-5xl font-black text-black mb-12 font-serif tracking-tight">These are men who cooked.</h1>
          
          <div class="flex flex-col items-center gap-y-12 select-none max-w-7xl mx-auto">
            <!-- ROW 1 (Max 4) -->
            <div v-if="crewPhotos.length > 0" class="flex flex-wrap justify-center items-end gap-x-4 md:gap-x-8 gap-y-8 md:gap-y-10 transition-all">
              <div
                v-for="crew in crewPhotos.slice(0, 4)"
                :key="crew.id"
                class="relative group transition-transform hover:scale-105 md:hover:scale-110 hover:z-10 duration-300 flex flex-col items-center w-[40%] sm:w-auto"
                @click="toggleCrew(crew.id)"
              >
                <img
                  :src="crew.image_url"
                  :alt="crew.name || 'Crew'"
                  class="h-32 sm:h-48 md:h-64 w-auto object-contain transition-all duration-500 mb-2 crew-photo-outline"
                  :class="{ 'scale-105 md:scale-110 z-10': activeCrewId === crew.id }"
                  draggable="false"
                />
                <div 
                  class="mt-1 md:mt-2 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center"
                  :class="{ 'md:opacity-100': activeCrewId === crew.id }"
                >
                  <p class="text-[10px] md:text-sm font-black text-black uppercase tracking-wider">{{ crew.name }}</p>
                  <p class="text-[8px] md:text-[10px] font-bold text-gray-600 uppercase">{{ crew.position }}</p>
                </div>
              </div>
            </div>

            <!-- ROW 2 (Max 2) -->
            <div v-if="crewPhotos.length > 4" class="flex flex-wrap justify-center items-end gap-x-4 md:gap-x-8 gap-y-8 md:gap-y-10 transition-all">
              <div
                v-for="crew in crewPhotos.slice(4, 6)"
                :key="crew.id"
                class="relative group transition-transform hover:scale-105 md:hover:scale-110 hover:z-10 duration-300 flex flex-col items-center w-[40%] sm:w-auto"
                @click="toggleCrew(crew.id)"
              >
                <img
                  :src="crew.image_url"
                  :alt="crew.name || 'Crew'"
                  class="h-32 sm:h-48 md:h-64 w-auto object-contain transition-all duration-500 mb-2 crew-photo-outline"
                  :class="{ 'scale-105 md:scale-110 z-10': activeCrewId === crew.id }"
                  draggable="false"
                />
                <div 
                  class="mt-1 md:mt-2 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center"
                  :class="{ 'md:opacity-100': activeCrewId === crew.id }"
                >
                  <p class="text-[10px] md:text-sm font-black text-black uppercase tracking-wider">{{ crew.name }}</p>
                  <p class="text-[8px] md:text-[10px] font-bold text-gray-600 uppercase">{{ crew.position }}</p>
                </div>
              </div>
            </div>

            <!-- ROW 3 (Max 3) -->
            <div v-if="crewPhotos.length > 6" class="flex flex-wrap justify-center items-end gap-x-4 md:gap-x-8 gap-y-8 md:gap-y-10 transition-all">
              <div
                v-for="crew in crewPhotos.slice(6, 9)"
                :key="crew.id"
                class="relative group transition-transform hover:scale-105 md:hover:scale-110 hover:z-10 duration-300 flex flex-col items-center w-[40%] sm:w-auto"
                @click="toggleCrew(crew.id)"
              >
                <img
                  :src="crew.image_url"
                  :alt="crew.name || 'Crew'"
                  class="h-32 sm:h-48 md:h-64 w-auto object-contain transition-all duration-500 mb-2 crew-photo-outline"
                  :class="{ 'scale-105 md:scale-110 z-10': activeCrewId === crew.id }"
                  draggable="false"
                />
                <div 
                  class="mt-1 md:mt-2 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center"
                  :class="{ 'md:opacity-100': activeCrewId === crew.id }"
                >
                  <p class="text-[10px] md:text-sm font-black text-black uppercase tracking-wider">{{ crew.name }}</p>
                  <p class="text-[8px] md:text-[10px] font-bold text-gray-600 uppercase">{{ crew.position }}</p>
                </div>
              </div>
            </div>

            <!-- REST (if any) -->
            <div v-if="crewPhotos.length > 9" class="flex flex-wrap justify-center items-end gap-x-4 md:gap-x-8 gap-y-8 md:gap-y-10 transition-all">
              <div
                v-for="crew in crewPhotos.slice(9)"
                :key="crew.id"
                class="relative group transition-transform hover:scale-105 md:hover:scale-110 hover:z-10 duration-300 flex flex-col items-center w-[40%] sm:w-auto"
                @click="toggleCrew(crew.id)"
              >
                <img
                  :src="crew.image_url"
                  :alt="crew.name || 'Crew'"
                  class="h-32 sm:h-48 md:h-64 w-auto object-contain transition-all duration-500 mb-2 crew-photo-outline"
                  :class="{ 'scale-105 md:scale-110 z-10': activeCrewId === crew.id }"
                  draggable="false"
                />
                <div 
                  class="mt-1 md:mt-2 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center"
                  :class="{ 'md:opacity-100': activeCrewId === crew.id }"
                >
                  <p class="text-[10px] md:text-sm font-black text-black uppercase tracking-wider">{{ crew.name }}</p>
                  <p class="text-[8px] md:text-[10px] font-bold text-gray-600 uppercase">{{ crew.position }}</p>
                </div>
              </div>
            </div>

            <!-- FALLBACK IF EMPTY -->
            <template v-if="crewPhotos.length === 0">
              <div class="flex flex-wrap justify-center items-end gap-x-8 gap-y-10">
                <div
                  v-for="(person, idx) in fallbackEmployees"
                  :key="'fallback-'+idx"
                  class="relative group transition-transform hover:scale-110 hover:z-10 duration-300 flex flex-col items-center"
                >
                  <img
                    :src="person.photo"
                    :alt="person.name"
                    class="h-40 md:h-64 w-auto object-contain filter drop-shadow-[0_0_8px_rgba(255,255,255,1)]"
                    draggable="false"
                  />
                </div>
              </div>
            </template>
          </div>
        </div>
      </section>

      <!-- BRAND CARD + MAP -->
      <section class="w-full px-4 md:px-6 py-12">
        <div class="bg-white rounded-[30px] shadow-[0_18px_60px_rgba(0,0,0,0.14)] border border-gray-200 overflow-hidden">
          <div class="grid md:grid-cols-2">
            <div class="p-8 md:p-10 flex flex-col gap-6">
              <!-- Logo -->
              <div class="flex items-center justify-center md:justify-start">
                <img :src="logoUtara" alt="Utara" class="h-32 md:h-44 w-auto" />
              </div>
              
              <!-- Tagline -->
              <div class="space-y-1 text-center md:text-left">
                <p class="text-gray-700 text-base md:text-lg leading-relaxed">
                  Tempatnya cerita, tawa, dan kopi yang diseduh dengan hati.
                </p>
                <p class="text-gray-700 text-base md:text-lg leading-relaxed">
                  Kami hadir di belakang kampus untuk menemani tugas, obrolan, dan pagi yang hangat.
                </p>
              </div>
              
              <!-- Buttons -->
              <div class="flex flex-col sm:flex-row gap-4">
                <!-- WhatsApp / Reservasi Button -->
                <div class="flex-1 border-2 border-black rounded-xl overflow-hidden shadow-lg">
                  <a 
                    href="https://wa.me/6281215246678?text=Halo%20Kopi%20Utara%2C%20saya%20mau%20reservasi" 
                    target="_blank" 
                    class="block bg-sky-400 text-white font-bold text-center py-3.5 text-sm md:text-base hover:bg-sky-500 transition-all"
                  >
                    Kontak Whatsapp / Reservasi
                  </a>
                  <div class="bg-white text-gray-900 font-bold text-center py-3.5 border-t-2 border-black text-base md:text-lg">
                    081215246678
                  </div>
                </div>

                <!-- Social Media Button -->
                <div class="flex-1 border-2 border-black rounded-xl overflow-hidden shadow-lg">
                  <div class="bg-emerald-500 text-white font-bold text-center py-3.5 text-sm md:text-base">
                    Sosial Media
                  </div>
                  <div class="bg-white py-3 px-4 border-t-2 border-black flex items-center justify-center gap-4">
                    <a 
                      href="https://instagram.com/utara.yk" 
                      target="_blank" 
                      class="flex items-center gap-2 hover:scale-110 transition-transform"
                    >
                      <div class="bg-gradient-to-br from-purple-600 via-pink-500 to-orange-400 p-1.5 rounded-lg">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                      </div>
                      <span class="font-bold text-gray-900 text-sm">Utara.yk</span>
                    </a>
                    <a 
                      href="https://tiktok.com/@utara.yk" 
                      target="_blank" 
                      class="flex items-center gap-2 hover:scale-110 transition-transform"
                    >
                      <div class="bg-black p-1.5 rounded-lg">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                        </svg>
                      </div>
                      <span class="font-bold text-gray-900 text-sm">Utara.yk</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="border-t md:border-t-0 md:border-l border-gray-200 bg-[#f5fff6] p-6 flex flex-col gap-4">
              <div class="flex items-start gap-3 text-sm text-gray-800">
                <span class="mt-1 text-red-500">◆</span>
                <p>Jl. Karungmiri, Tlogo, Tamantirto (Belakang Universitas Putra Yogyakarta)</p>
              </div>
              <div class="rounded-xl overflow-hidden border border-gray-300 shadow">
                <iframe
                  class="w-full h-64"
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.7842927507836!2d110.326659!3d-7.607496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a572e1cce7d5f%3A0x895d4b5fffcc9f0b!2sUniversitas%20Muhammadiyah%20Yogyakarta!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                  style="border:0;"
                  allowfullscreen=""
                  loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import { Header } from '@/Components';

export default {
  name: 'AboutPage',
  components: { Link, Header },
  props: {
    employees: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      isMobileMenuOpen: false,
      scrolled: false,
      crewPhotos: [],
      activeCrewId: null,
      logoUtara: '/logo' + 'utara.png',


      mosaicBlocks: [
        {
          title: 'Kopi susu sebagai menu favorit',
          color: 'bg-[#ffd93b] text-gray-900',
          textSize: 'text-3xl font-black'
        },
        {
          image: '/public/hero-cafelux.jpg',
          position: 'center'
        },
        {
          image: '/public/Banner1.jpg',
          position: 'center'
        },
        {
          title: 'Burger & snack untuk teman ngopi',
          color: 'bg-[#f5e9c4] text-gray-900',
          textSize: 'text-2xl font-black'
        },
      ],
      fallbackEmployees: [
        { name: 'Barista Utara', position: 'Head Barista', photo: '/orang1.png', hashtag: '#teamutara' },
        { name: 'Crew Dapur', position: 'Cook', photo: '/orang2.png', hashtag: '#freshburger' },
        { name: 'Service Lead', position: 'Front Desk', photo: '/orang3.png', hashtag: '#hospitality' },
        { name: 'Brew Specialist', position: 'Brewer', photo: '/orang4.png', hashtag: '#brewwithheart' },
      ],
    };
  },
  mounted() {
    this.fetchCrewPhotos();
    window.addEventListener('scroll', this.handleScroll);
  },
  beforeUnmount() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  computed: {
    displayEmployees() {
      if (this.employees && this.employees.length) {
        return this.employees.map((emp, idx) => ({
          name: emp.name || this.fallbackEmployees[idx % this.fallbackEmployees.length].name,
          position: emp.position || '',
          hashtag: emp.hashtag || '',
          photo: this.resolvePhoto(emp, idx),
        }));
      }
      return this.fallbackEmployees;
    },
  },
  methods: {
    async fetchCrewPhotos() {
      try {
        const response = await fetch('/crew/photos');
        if (response.ok) {
          this.crewPhotos = await response.json();
        }
      } catch (error) {
        console.error('Failed to fetch crew photos:', error);
      }
    },
    handleScroll() {
      this.scrolled = window.scrollY > 50;
    },
    toggleCrew(id) {
      if (this.activeCrewId === id) {
        this.activeCrewId = null;
      } else {
        this.activeCrewId = id;
      }
    },
    resolvePhoto(emp, idx) {
      const fallbackPhotos = ['/public/orang1.png', '/public/orang2.png', '/public/orang3.png', '/public/orang4.png'];
      const photo = emp?.photo;
      if (photo) {
        if (photo.startsWith('http')) return photo;
        if (photo.startsWith('/')) return photo;
        return `/storage/${photo}`;
      }
      return fallbackPhotos[idx % fallbackPhotos.length];
    },
  },
};
</script>

<style scoped>
.crew-photo-outline {
  filter: drop-shadow(2px 2px 0 white) drop-shadow(-2px -2px 0 white) drop-shadow(2px -2px 0 white) drop-shadow(-2px 2px 0 white);
}

@media (min-width: 768px) {
  .crew-photo-outline {
    filter: drop-shadow(4px 4px 0 white) drop-shadow(-4px -4px 0 white) drop-shadow(4px -4px 0 white) drop-shadow(-4px 4px 0 white);
  }
}
</style>