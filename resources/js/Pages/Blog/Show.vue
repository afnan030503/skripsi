<template>
  <div class="min-h-screen bg-white flex flex-col">
    <!-- Navbar -->
    <header class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur shadow-sm border-b border-gray-100">
      <div class="max-w-7xl mx-auto px-4 md:px-6 h-20 flex items-center justify-between">
        <Link href="/" class="flex items-center gap-2 md:gap-3">
          <img :src="utaraImg" alt="Utara" class="h-10 md:h-12 w-auto rounded-xl shadow" />
        </Link>
        
        <!-- Desktop Nav (Reused from Blog.vue) -->
        <nav class="hidden lg:flex items-center gap-6 text-sm font-semibold text-gray-700">
          <Link href="/" class="hover:text-emerald-700 transition">Home</Link>
          <a href="/#menu" class="hover:text-emerald-700 transition">Menu</a>
          <a href="/#tetangga" class="hover:text-emerald-700 transition">Community</a>
          <Link href="/promo-loyalty" class="hover:text-emerald-700 transition">Promo & Loyalty</Link>
          <Link href="/about" class="hover:text-emerald-700 transition">About Us</Link>
          <Link href="/blog" class="text-emerald-700 border-b-2 border-emerald-700 pb-1">Blog</Link>
          <a href="/#contact" class="hover:text-emerald-700 transition">Contact Us</a>
        </nav>

        <div class="flex items-center gap-2 md:gap-3">
            <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="lg:hidden p-2 text-gray-600">
              <svg v-if="!isMobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
              <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <Link href="/login" class="hidden sm:inline-block px-4 py-2 rounded-full border border-gray-200 text-sm font-semibold hover:border-emerald-600 hover:text-emerald-700 transition">Login</Link>
            <a href="https://wa.me/6281215246678?text=Halo%20Kopi%20Utara" target="_blank" class="px-4 md:px-5 py-2 rounded-full bg-emerald-600 text-white text-sm md:text-base font-semibold shadow hover:bg-emerald-700 transition">Reservasi</a>
        </div>
      </div>

       <!-- Mobile Menu Overlay -->
       <transition 
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="opacity-0 -translate-y-4"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition duration-150 ease-in"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 -translate-y-4"
      >
        <div v-if="isMobileMenuOpen" class="lg:hidden bg-white border-t border-gray-100 shadow-xl overflow-hidden absolute w-full top-20 left-0">
          <nav class="flex flex-col p-4 gap-4 text-gray-800 font-bold">
            <Link @click="isMobileMenuOpen = false" href="/" class="p-2 hover:bg-emerald-50 rounded-lg">Home</Link>
            <a @click="isMobileMenuOpen = false" href="/#menu" class="p-2 hover:bg-emerald-50 rounded-lg">Menu</a>
            <a @click="isMobileMenuOpen = false" href="/#tetangga" class="p-2 hover:bg-emerald-50 rounded-lg">Community</a>
            <Link @click="isMobileMenuOpen = false" href="/promo-loyalty" class="p-2 hover:bg-emerald-50 rounded-lg">Promo & Loyalty</Link>
            <Link @click="isMobileMenuOpen = false" href="/about" class="p-2 hover:bg-emerald-50 rounded-lg">About Us</Link>
            <Link @click="isMobileMenuOpen = false" href="/blog" class="p-2 hover:bg-emerald-50 rounded-lg text-emerald-600">Blog</Link>
            <a @click="isMobileMenuOpen = false" href="/#contact" class="p-2 hover:bg-emerald-50 rounded-lg">Contact Us</a>
            <Link @click="isMobileMenuOpen = false" href="/login" class="p-2 bg-gray-100 rounded-lg text-center">Login</Link>
          </nav>
        </div>
      </transition>
    </header>

    <div class="h-20"></div>

    <!-- Main Content -->
    <main class="flex-1 w-full max-w-4xl mx-auto px-4 py-8 md:py-12">
        
        <!-- Top Navigation -->
        <div class="flex justify-between items-center mb-8 text-xs font-bold tracking-wider text-gray-800">
            <Link href="/blog" class="flex items-center hover:text-emerald-700">
                <span class="mr-2">←</span> KEMBALI
            </Link>
            <span>KATEGORI</span>
        </div>

        <!-- Title / Header -->
        <h1 class="text-4xl md:text-6xl font-black text-[#0f3d2e] leading-tight mb-8 font-serif">
            {{ blog.title }}
        </h1>

        <!-- Content Top -->
        <div class="grid md:grid-cols-3 gap-8 mb-12">
             <!-- Empty space or introduction could go here if layout requires, but image suggests simple flow -->
             <!-- Actually image suggests full width or floating sections, let's keep it simple first -->
             <div class="md:col-span-3">
                 <p class="text-gray-600 leading-relaxed mb-6">{{ blog.excerpt || blog.content ? blog.content.substring(0, 150) : '' }}...</p>
             </div>
        </div>

        <!-- Hero Image -->
        <div class="w-full aspect-video overflow-hidden mb-12">
             <img :src="blog.image || '/blog1.jpg'" :alt="blog.title" class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-700" />
        </div>

        <!-- Meta & Content Wrapper -->
        <div class="grid md:grid-cols-4 gap-8">
            <!-- Sidebar: Author & Share -->
            <div class="md:col-span-1 border-t border-b md:border-t-0 md:border-b-0 border-gray-200 py-4 md:py-0">
                <div class="flex flex-col gap-6 sticky top-24">
                    <div class="flex items-center gap-3">
                        <img :src="utaraImg" class="w-10 h-10 rounded-full border border-gray-200 p-1" />
                        <div>
                             <p class="font-bold text-sm text-[#0f3d2e]">{{ blog.author?.name || 'Utara' }}</p>
                             <p class="text-xs text-gray-500">Author</p>
                        </div>
                    </div>
                    
                    <div class="space-y-1">
                        <div class="flex justify-between text-xs text-gray-600">
                            <span>Date</span>
                            <span class="font-medium">{{ formatDate(blog.created_at) }}</span>
                        </div>
                        <div class="flex justify-between text-xs text-gray-600">
                            <span>Read</span>
                            <span class="font-medium">1484</span>
                        </div>
                        <div class="flex justify-between text-xs text-gray-600">
                            <span>Share</span>
                            <div class="flex gap-2">
                                <a href="#" class="hover:text-emerald-600"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="hover:text-emerald-600"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="md:col-span-3">
                <article class="prose prose-emerald max-w-none text-gray-800">
                    <div v-html="blog.content" class="leading-relaxed"></div>
                    
                    <!-- Fallback if content is empty (though should not happen) -->
                    <p v-if="!blog.content" class="italic text-gray-400">Belum ada konten untuk artikel ini.</p>
                </article>
            </div>
        </div>

    </main>

    <!-- Footer (Same as Blog.vue) -->
    <footer class="bg-white border-t border-gray-200 py-12 mt-auto">
      <div class="max-w-6xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-8 items-start">
          <div class="space-y-4">
            <img :src="utaraImg" alt="UTARA" class="h-16 w-auto" />
            <p class="text-gray-600 text-sm leading-relaxed max-w-md">
              Tempatmu cerita, tawa, dan kopi yang diseduh dengan hati.<br/>
              Kami hadir di belakang kampus untuk menemani tugas, obrolan, dan pagi yang hangat.
            </p>
            <div class="flex flex-col sm:flex-row gap-3">
              <div class="border-2 border-black rounded-lg overflow-hidden">
                <a href="https://wa.me/6281215246678?text=Halo%20Kopi%20Utara" target="_blank" class="block bg-cyan-400 text-white font-bold text-center py-2 px-4 text-sm">Kontak Whatsapp / Reservasi</a>
                <div class="bg-white text-gray-900 font-bold text-center py-2 border-t-2 border-black text-sm">081215246678</div>
              </div>
              <div class="border-2 border-black rounded-lg overflow-hidden">
                <div class="bg-cyan-400 text-white font-bold text-center py-2 px-4 text-sm">Sosial Media</div>
                <div class="bg-white py-2 px-4 border-t-2 border-black flex items-center justify-center gap-3">
                  <span class="font-bold text-gray-900 text-xs text-center">@utara.yk</span>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-lg overflow-hidden border-2 border-black">
            <div class="bg-gray-50 px-4 py-2 border-b-2 border-black">
              <h3 class="text-gray-800 font-bold text-center text-sm flex items-center justify-center gap-2">
                <span class="text-red-500">📍</span>
                <span>Jl. Kemuning, Tlogo, Tamantirto (<span class="font-bold">Belakang Unires Putra UMY</span>)</span>
              </h3>
            </div>
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.666666666666!2d106.816666!3d-6.200000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMDAuMCJTIDEwNsKwNDknMDAuMCJF!5e0!3m2!1sen!2sid!4v1234567890"
              width="100%"
              height="250"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
            />
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  blog: {
    type: Object,
    required: true,
    default: () => ({
        title: 'Title',
        content: 'Content...',
        created_at: new Date()
    })
  }
});

const isMobileMenuOpen = ref(false);
const utaraImg = '/utara.jpg';

const formatDate = (dateString) => {
    if(!dateString) return '16. March 2022';
    const options = { day: 'numeric', month: 'long', year: 'numeric' };
    return new Date(dateString).toLocaleDateString('en-GB', options);
};
</script>

<style scoped>
/* Add any specific styles here, mainly relying on Tailwind */
</style>
