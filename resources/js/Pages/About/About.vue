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

      <section class="relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] w-screen">
        <div class="bg-black text-white w-full">
          <div class="flex items-center justify-center gap-3 py-4 px-4">
            <h3 class="text-3xl md:text-4xl font-black font-serif text-amber-300">Filosofi & Nilai Kami</h3>
          </div>
          <div class="grid md:grid-cols-3 gap-0 auto-rows-[260px] text-center">
            <div
              v-for="card in philosophyCards"
              :key="card.title"
              :class="[card.color, 'p-10 flex flex-col items-center justify-center']"
            >
              <h4 class="text-2xl md:text-3xl font-black font-serif mb-4">{{ card.title }}</h4>
              <p class="text-sm leading-relaxed max-w-xs">{{ card.description }}</p>
            </div>
          </div>
        </div>
      </section>

      <!-- HERO BELGE + EMPLOYEES -->
      <section class="bg-[#e8dcc1] border-t-[10px] border-[#2f2a24] py-12 shadow-inner">
        <div class="max-w-6xl mx-auto px-6 flex flex-col gap-6">
          <h1 class="text-3xl md:text-4xl font-black text-[#2b1c12] text-center font-serif">These are men who cooked.</h1>
          <div class="bg-white/70 rounded-3xl shadow-[0_18px_60px_rgba(0,0,0,0.18)] overflow-hidden border border-[#d8c9a6]">
            <div class="flex flex-wrap justify-center gap-4 px-4 pt-6 pb-4">
              <div
                v-for="(person, idx) in displayEmployees"
                :key="person.name + idx"
                class="bg-white border border-[#c9bfa4] rounded-2xl shadow-sm overflow-hidden max-w-xs"
              >
                <img
                  :src="person.photo"
                  :alt="person.name"
                  class="w-full h-60 object-cover bg-[#f5e9d0]"
                />
                <div class="p-3 text-center">
                  <p class="text-base font-semibold text-[#2b1c12]">{{ person.name }}</p>
                  <p class="text-sm text-gray-600">{{ person.position || person.hashtag }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- BRAND CARD + MAP -->
      <section class="max-w-6xl mx-auto px-6">
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

            <section class="relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] w-screen">
        <div class="grid md:grid-cols-2 gap-0 auto-rows-[520px]">
          <div class="bg-[#ffd93b] text-gray-900 h-full w-full flex items-center justify-center text-center px-8">
            <h4 class="font-serif text-3xl md:text-4xl font-black leading-snug max-w-xl">Kopi susu sebagai menu favorit</h4>
          </div>
          <div
            class="h-full w-full bg-cover bg-center"
            style="background-image: url('/public/hero-cafelux.jpg');"
          ></div>
        </div>
      </section>

      <section class="max-w-5xl mx-auto px-6">
        <div class="rounded-3xl bg-gradient-to-r from-amber-300 via-white to-emerald-100 p-10 shadow-[0_18px_60px_rgba(0,0,0,0.12)] border border-white">
          <h4 class="text-2xl font-black text-center mb-4">Dari Kami, Untuk Kamu</h4>
          <p class="text-center text-lg text-gray-800 leading-relaxed max-w-3xl mx-auto">
            Kopi Utara ingin kamu merasa diterima seperti teman. Setiap kali kamu datang, kami ingin kamu pulang dengan perasaan lebih baik entah karena kopinya enak, suasananya nyaman, atau karena kamu menemukan momen kecil yang berarti di sini.
          </p>
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
      philosophyCards: [
        {
          title: 'Kopi untuk Semua',
          description: 'Kopi menghadirkan kopi dan minuman segar dengan harga yang masih ramah kantong mahasiswa tanpa mengorbankan rasa dan kualitas.',
          color: 'bg-[#6868d1] text-white',
          tagline: 'Terjangkau & tulus'
        },
        {
          title: 'Ruang untuk Terhubung',
          description: 'Kopi Utara dirancang sebagai tempat yang hidup: bisa buat kerja, main kartu, ngobrol, curhat, atau sekadar duduk menikmati suasana.',
          color: 'bg-[#f59ad2] text-gray-900',
          tagline: 'Hangat & hidup'
        },
        {
          title: 'Lokal & Autentik',
          description: 'Rasa yang jujur, pelayanan yang tulus, dan vibe yang hangat. Itu yang ingin kami jaga dalam setiap seduhan dan kunjungan.',
          color: 'bg-[#5cb7f4] text-gray-900',
          tagline: 'Vibe utara'
        },
      ],
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




