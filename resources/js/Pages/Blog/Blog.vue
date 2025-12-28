<template>
  <div class="min-h-screen bg-white flex flex-col">
    <!-- Navbar -->
    <header class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur shadow-sm border-b border-gray-100">
      <div class="max-w-7xl mx-auto px-4 md:px-6 h-20 flex items-center justify-between">
        <Link href="/" class="flex items-center gap-2 md:gap-3">
          <img :src="utaraImg" alt="Utara" class="h-10 md:h-12 w-auto rounded-xl shadow" />
        </Link>
        
        <!-- Desktop Nav -->
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
          <!-- Mobile Menu Toggle -->
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

    <!-- Spacer untuk navbar fixed -->
    <div class="h-20"></div>

    <!-- News Ticker -->
    <div class="bg-emerald-700 text-white py-2 overflow-hidden">
      <div class="flex items-center gap-4 animate-marquee whitespace-nowrap">
        <span class="bg-emerald-900 px-3 py-1 text-xs font-bold rounded">NEWS TICKER</span>
        <span class="mx-4">»»»</span>
        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit</span>
        <span class="mx-4">»»»</span>
        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit</span>
        <span class="mx-4">»»»</span>
        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit</span>
      </div>
    </div>

    <!-- Main Content -->
    <main class="flex-1">
      <div class="max-w-6xl mx-auto px-4 py-8">
        
        <!-- Hero Section -->
        <section class="mb-8">
          <!-- Title + Content Grid -->
          <div class="grid md:grid-cols-2 gap-8 mb-8">
            <!-- Left: Large Title -->
            <div>
              <h1 class="text-5xl md:text-7xl font-black text-[#0f3d2e] leading-none tracking-tight" style="font-family: 'Arial Black', sans-serif;">
                KOPI<br/>
                DIPAGI<br/>
                HARI
              </h1>
            </div>
            
            <!-- Right: Description & Meta -->
            <div class="flex flex-col justify-center">
              <p class="text-gray-700 text-sm leading-relaxed mb-6">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas dui id ornare arcu odio ut sem. Cras ornare arcu dui vivamus arcu felis bibendum ut. Porttitor leo a diam.
              </p>
              
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-6 text-xs text-gray-600">
                  <span><strong>Post By</strong> Utara</span>
                  <span><strong>Date</strong> 16. March 2022</span>
                  <span><strong>Duration</strong> 1 Min</span>
                </div>
                
                <button class="px-4 py-2 border border-gray-400 rounded text-xs font-semibold text-gray-700 hover:bg-gray-100 transition">
                  BACA LEBIH
                </button>
              </div>
            </div>
          </div>
          
          <!-- Full Width Image -->
          <div class="w-full overflow-hidden rounded-lg">
            <img 
              :src="blog1Img" 
              alt="KOPI DIPAGI HARI" 
              class="w-full h-[400px] md:h-[600px] object-cover"
            />
          </div>
        </section>

        <!-- Blog List (Blog 2-7) -->
        <div class="space-y-0 mt-12">
          <article 
            v-for="(blog, index) in otherBlogs" 
            :key="blog.id"
            class="flex flex-col md:flex-row gap-6 py-6 border-t border-gray-200"
          >
            <!-- Left: Square Image -->
            <div class="md:w-40 flex-shrink-0">
              <img 
                :src="blog.image" 
                :alt="blog.title" 
                class="w-full md:w-40 h-40 object-cover"
              />
            </div>
            
            <!-- Right: Content -->
            <div class="flex-1 flex flex-col justify-between">
              <div>
                <!-- Title -->
                <h2 class="text-xl font-bold text-gray-900 mb-2">{{ blog.title }}</h2>
                
                <!-- Description -->
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                  {{ blog.excerpt }}
                </p>
              </div>
              
              <!-- Bottom: Meta + Tag -->
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-6 text-xs text-gray-500">
                  <span><strong class="text-gray-700">Post By</strong> {{ blog.author }}</span>
                  <span><strong class="text-gray-700">Date</strong> {{ blog.date }}</span>
                  <span><strong class="text-gray-700">Read</strong> {{ blog.duration }}</span>
                </div>
                
                <!-- Tag Button -->
                <button class="px-3 py-1.5 border border-gray-300 rounded text-xs font-medium text-gray-600 hover:bg-gray-100 transition uppercase">
                  {{ blog.tag || 'ART' }}
                </button>
              </div>
            </div>
          </article>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-12">
      <div class="max-w-6xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-8 items-start">
          <!-- Left: Logo & Info -->
          <div class="space-y-4">
            <img :src="utaraImg" alt="UTARA" class="h-16 w-auto" />
            
            <p class="text-gray-600 text-sm leading-relaxed max-w-md">
              Tempatmu cerita, tawa, dan kopi yang diseduh dengan hati.<br/>
              Kami hadir di belakang kampus untuk menemani tugas, obrolan, dan pagi yang hangat.
            </p>

            <!-- Contact Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
              <div class="border-2 border-black rounded-lg overflow-hidden">
                <a 
                  href="https://wa.me/6281215246678?text=Halo%20Kopi%20Utara" 
                  target="_blank"
                  class="block bg-cyan-400 text-white font-bold text-center py-2 px-4 text-sm"
                >
                  Kontak Whatsapp / Reservasi
                </a>
                <div class="bg-white text-gray-900 font-bold text-center py-2 border-t-2 border-black text-sm">
                  081215246678
                </div>
              </div>

              <div class="border-2 border-black rounded-lg overflow-hidden">
                <div class="bg-cyan-400 text-white font-bold text-center py-2 px-4 text-sm">
                  Sosial Media
                </div>
                <div class="bg-white py-2 px-4 border-t-2 border-black flex items-center justify-center gap-3">
                  <a href="https://instagram.com/utara.yk" target="_blank" class="flex items-center gap-1.5 hover:scale-110 transition-transform">
                    <div class="bg-gradient-to-br from-purple-600 via-pink-500 to-orange-400 p-1.5 rounded">
                      <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                      </svg>
                    </div>
                    <span class="font-bold text-gray-900 text-xs">Utara.yk</span>
                  </a>
                  <a href="https://tiktok.com/@utara.yk" target="_blank" class="flex items-center gap-1.5 hover:scale-110 transition-transform">
                    <div class="bg-black p-1.5 rounded">
                      <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                      </svg>
                    </div>
                    <span class="font-bold text-gray-900 text-xs">Utara.yk</span>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Right: Map -->
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
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  blogs: {
    type: Object,
    default: () => ({ data: [] })
  }
});

const isMobileMenuOpen = ref(false);

// Image paths (using string concatenation to avoid Vite import analysis)
const utaraImg = '/utara' + '.jpg';
const blog1Img = '/blog1' + '.jpg';

// Static blog data using blog1.jpg - blog7.jpg
const staticBlogs = [
  {
    id: 1,
    title: 'KOPI DIPAGI HARI',
    slug: 'kopi-dipagi-hari',
    excerpt: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed enim ut sem viverra aliquet eget sit amet. Ornare arcu dui vivamus arcu felis bibendum ut.',
    image: '/blog1' + '.jpg',
    author: 'Admin',
    date: '16 March 2022',
    duration: '2 Min',
    featured: true
  },
  {
    id: 2,
    title: 'Hope dies last',
    slug: 'hope-dies-last',
    excerpt: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas dui id ornare arcu odio ut sem. Cras ornare arcu dui vivamus arcu felis bibendum ut. Porttitor leo a diam.',
    image: '/blog2' + '.jpg',
    author: 'Utara',
    date: '16. March 2022',
    duration: '1 Min',
    tag: 'ART',
    featured: false
  },
  {
    id: 3,
    title: 'The best art museums',
    slug: 'the-best-art-museums',
    excerpt: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas dui id ornare arcu odio ut sem. Cras ornare arcu dui vivamus arcu felis bibendum ut. Porttitor leo a diam.',
    image: '/blog3' + '.jpg',
    author: 'Utara',
    date: '16. March 2022',
    duration: '1 Min',
    tag: 'SCULPTURES',
    featured: false
  },
  {
    id: 4,
    title: 'The devil is the details',
    slug: 'the-devil-is-the-details',
    excerpt: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas dui id ornare arcu odio ut sem. Cras ornare arcu dui vivamus arcu felis bibendum ut. Porttitor leo a diam.',
    image: '/blog4' + '.jpg',
    author: 'Utara',
    date: '16. March 2022',
    duration: '1 Min',
    tag: 'ART',
    featured: false
  },
  {
    id: 5,
    title: 'An indestructible hope',
    slug: 'an-indestructible-hope',
    excerpt: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas dui id ornare arcu odio ut sem. Cras ornare arcu dui vivamus arcu felis bibendum ut. Porttitor leo a diam.',
    image: '/blog5' + '.jpg',
    author: 'Utara',
    date: '16. March 2022',
    duration: '1 Min',
    tag: 'ART',
    featured: false
  },
  {
    id: 6,
    title: 'Street art festival',
    slug: 'street-art-festival',
    excerpt: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas dui id ornare arcu odio ut sem. Cras ornare arcu dui vivamus arcu felis bibendum ut. Porttitor leo a diam.',
    image: '/blog6' + '.jpg',
    author: 'Utara',
    date: '16. March 2022',
    duration: '1 Min',
    tag: 'STREET ART',
    featured: false
  },
  {
    id: 7,
    title: 'Through the eyes of street artists',
    slug: 'through-the-eyes-of-street-artists',
    excerpt: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas dui id ornare arcu odio ut sem. Cras ornare arcu dui vivamus arcu felis bibendum ut. Porttitor leo a diam.',
    image: '/blog7' + '.jpg',
    author: 'Utara',
    date: '16. March 2022',
    duration: '1 Min',
    tag: 'STREET ART',
    featured: false
  }
];

// Use backend data if available, otherwise use static data
const blogList = computed(() => {
  if (props.blogs?.data?.length > 0) {
    return props.blogs.data;
  }
  return staticBlogs;
});

const featuredBlog = computed(() => blogList.value[0]);
const otherBlogs = computed(() => blogList.value.slice(1));
</script>

<style scoped>
@keyframes marquee {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}

.animate-marquee {
  animation: marquee 20s linear infinite;
}
</style>
