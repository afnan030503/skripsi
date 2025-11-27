<template>
  <div class="min-h-screen bg-[#f6f7f9] text-gray-900">
    <header class="fixed top-0 inset-x-0 z-40 bg-white/90 backdrop-blur shadow-sm border-b border-gray-100">
      <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <Link href="/" class="flex items-center justify-center gap-3 py-4 px-4">
          <img src="/public/utara.jpg" alt="Utara" class="h-12 w-auto rounded-xl shadow" />
          <span class="text-2xl font-black text-emerald-700 tracking-wide">UTARA</span>
        </Link>
        <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-gray-700">
          <a href="/#home" class="hover:text-emerald-700 transition">Home</a>
          <a href="/#menu" class="hover:text-emerald-700 transition">Menu</a>
          <a href="/#tetangga" class="hover:text-emerald-700 transition">Community</a>
          <Link href="/about" class="text-emerald-700 border-b-2 border-emerald-700 pb-1">About Us</Link>
          <a href="/#blog" class="hover:text-emerald-700 transition">Blog</a>
          <a href="/#contact" class="hover:text-emerald-700 transition">Contact Us</a>
        </nav>
        <div class="flex items-center justify-center gap-3 py-4 px-4">
          <Link href="/login" class="hidden sm:inline-block px-4 py-2 rounded-full border border-gray-200 text-sm font-semibold hover:border-emerald-600 hover:text-emerald-700 transition">Login</Link>
          <a href="https://wa.me/6281215246678?text=Halo%20Kopi%20Utara" target="_blank" class="px-5 py-2 rounded-full bg-emerald-600 text-white font-semibold shadow hover:bg-emerald-700 transition">Reservasi</a>
        </div>
      </div>
    </header>

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
      <!-- HERO BELGE + EMPLOYEES -->
      <section class="bg-[#FDF6E3] border-t-[10px] border-[#2f2a24] py-16 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center">
          <h1 class="text-4xl md:text-5xl font-black text-black mb-12 font-serif tracking-tight">These are men who cooked.</h1>
          
          <div class="flex flex-wrap justify-center items-end gap-[-20px] md:gap-4 select-none">
            <div
              v-for="(person, idx) in displayEmployees"
              :key="person.name + idx"
              class="relative group transition-transform hover:scale-110 hover:z-10 duration-300"
            >
              <img
                :src="person.photo"
                :alt="person.name"
                class="h-40 md:h-64 w-auto object-contain filter drop-shadow-[0_0_8px_rgba(255,255,255,1)] drop-shadow-[0_0_15px_rgba(255,255,255,0.8)]"
                draggable="false"
              />
            </div>
          </div>
        </div>
      </section>

      <!-- BRAND CARD + MAP -->
      <section class="w-full px-4 md:px-6 py-12">
        <div class="bg-white rounded-[30px] shadow-[0_18px_60px_rgba(0,0,0,0.14)] border border-gray-200 overflow-hidden">
          <div class="grid md:grid-cols-2">
            <div class="p-8 flex flex-col gap-4">
              <div class="flex items-center justify-center gap-3 py-4 px-4">
                <img src="/public/logo.png" alt="Utara" class="h-20 w-auto drop-shadow" />
                <h2 class="text-5xl font-black text-[#0c5c38] leading-none">UTARA</h2>
              </div>
              <p class="text-gray-700 leading-relaxed text-sm">
                Tempatnya cerita, tawa, dan kopi yang diseduh dengan hati. Kami hadir di belakang kampus untuk menemani tugas, obrolan, dan pagi yang hangat.
              </p>
              <div class="grid sm:grid-cols-2 gap-3">
                <a href="https://wa.me/6281215246678?text=Halo%20Kopi%20Utara%2C%20saya%20mau%20reservasi" target="_blank" class="border border-[#0f72c7] bg-[#0f72c7] text-white text-sm font-semibold rounded-sm text-center py-2 shadow hover:bg-blue-700 transition">
                  Kontak Whatsapp / Reservasi
                </a>
                <div class="bg-[#e2f8e9] border border-[#9fd8b6] rounded-sm p-3 text-sm text-gray-800">
                  <p class="font-semibold">081215246678</p>
                  <p class="mt-1">Social Media: Utara.yk</p>
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

export default {
  name: 'AboutPage',
  components: { Link },
  props: {
    employees: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {

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




