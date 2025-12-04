<template>
  <div class="min-h-screen bg-stone-50 flex flex-col">
    <header class="fixed top-0 inset-x-0 z-40 bg-white/90 backdrop-blur shadow-sm border-b border-gray-100">
      <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <Link href="/" class="flex items-center justify-center gap-3 py-4 px-4">
          <img src="/public/utara.jpg" alt="Utara" class="h-12 w-auto rounded-xl shadow" />
          <span class="text-2xl font-black text-emerald-700 tracking-wide">UTARA</span>
        </Link>
        <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-gray-700">
          <a href="#home" class="text-emerald-700 border-b-2 border-emerald-700 pb-1">Home</a>
          <a href="#menu" class="hover:text-emerald-700 transition">Menu</a>
          <a href="#tetangga" class="hover:text-emerald-700 transition">Community</a>
          <Link href="/promo-loyalty" class="hover:text-emerald-700 transition">Promo & Loyalty</Link>
          <Link href="/about" class="hover:text-emerald-700 transition">About Us</Link>
          <a href="#blog" class="hover:text-emerald-700 transition">Blog</a>
          <a href="#contact" class="hover:text-emerald-700 transition">Contact Us</a>
        </nav>
        <div class="flex items-center justify-center gap-3 py-4 px-4">
          <Link href="/login" class="hidden sm:inline-block px-4 py-2 rounded-full border border-gray-200 text-sm font-semibold hover:border-emerald-600 hover:text-emerald-700 transition">Login</Link>
          <a href="https://wa.me/6281215246678?text=Halo%20Kopi%20Utara" target="_blank" class="px-5 py-2 rounded-full bg-emerald-600 text-white font-semibold shadow hover:bg-emerald-700 transition">Reservasi</a>
        </div>
      </div>
    </header>

    <section id="home" class="relative h-[500px] overflow-hidden mt-20">
      <div 
        class="absolute inset-0 overflow-x-auto overflow-y-hidden flex items-center justify-start banner-scroll select-none scroll-smooth"
        ref="bannerScroll"
        style="scrollbar-width: none; -ms-overflow-style: none;"
      >
        <div 
          class="flex items-center"
        >
          <div 
            v-for="(img, idx) in bannerImages"
            :key="img + idx"
            class="relative shrink-0 overflow-hidden shadow-2xl rounded-lg"
          >
            <img 
              :src="img" 
              :style="{ height: `${bannerHeight}px`, width: 'auto' }" 
              class="h-full object-cover" 
              draggable="false"
            />
          </div>
        </div>
      </div>
    </section>

    <section id="menu" class="w-full bg-black">
      <!-- FULL 2×2 GRID (BESAR) -->
      <div class="grid grid-cols-1 md:grid-cols-2 w-full">

        <!-- LEFT TOP – FOOD IMAGE -->
        <div class="relative w-full h-[540px]">
          <img 
            :src="selectedFoodImage || '/public/food1.jpg'"
            class="w-full h-full object-contain p-8 bg-gray-50"
          >

          <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white/50 transition-all duration-300">
            <div class="flex justify-between items-start gap-4">
              <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ selectedFoodMenu?.name || 'Pilih Menu' }}</h3>
                <p class="text-gray-600 leading-relaxed">
                  {{ selectedFoodMenu?.description || 'Silakan pilih menu di samping untuk melihat detail.' }}
                </p>
              </div>
              <span class="bg-gradient-to-r from-blue-500 to-sky-400 text-white px-5 py-2 rounded-full font-bold text-xl shadow-lg whitespace-nowrap">
                {{ selectedFoodMenu ? formatPrice(selectedFoodMenu.price) : 'Rp 0' }}
              </span>
            </div>
          </div>
        </div>

        <!-- RIGHT TOP – FOOD CATEGORY BOX -->
        <div class="p-10 md:p-14 bg-gradient-to-br from-sky-400 to-blue-500 text-white">
          <!-- CATEGORY BUTTONS (BESAR) -->
          <div class="flex flex-wrap gap-4 mb-10">
            <button 
              v-for="cat in foodCategory.subcategories"
              :key="cat.id"
              @click="selectFoodSubcategory(cat.id)"
              :class="[
                'px-6 py-2 rounded-full font-bold transition-all duration-300 shadow-sm border-2',
                selectedFoodSubcategory === cat.id 
                  ? 'bg-white text-blue-600 border-white scale-105 shadow-lg'
                  : 'bg-transparent text-white border-white/30 hover:bg-white/10'
              ]"
            >
              {{ cat.name }}
            </button>
          </div>

          <!-- FOOD LIST (BESAR) -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div 
              v-for="menu in foodMenus"
              :key="menu.id"
              @click="selectFoodMenu(menu)"
              class="group bg-white/10 backdrop-blur-sm border border-white/20 p-5 rounded-2xl cursor-pointer hover:bg-white hover:text-blue-900 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
            >
              <div class="flex justify-between items-start mb-2">
                <h4 class="font-bold text-lg leading-tight">{{ menu.name }}</h4>
                <span class="bg-white/20 group-hover:bg-blue-100 group-hover:text-blue-600 px-2 py-1 rounded-lg text-sm font-bold whitespace-nowrap transition-colors">
                  {{ formatPrice(menu.price) }}
                </span>
              </div>
              <p class="text-sm opacity-80 line-clamp-2 group-hover:opacity-100">
                {{ menu.description || 'Delicious food choice' }}
              </p>
            </div>
          </div>
        </div>

        <!-- LEFT BOTTOM – DRINK SUBCATEGORIES -->
        <div class="p-10 md:p-14 bg-gradient-to-br from-emerald-300 to-teal-500 text-white">
          <!-- SUBCATEGORY BUTTONS (BESAR) -->
          <div class="flex flex-wrap gap-4 mb-10">
            <button
              v-for="sub in drinkCategory.subcategories"
              :key="sub.id"
              @click="selectDrinkSubcategory(sub.id)"
              :class="[
                'px-6 py-2 rounded-full font-bold transition-all duration-300 shadow-sm border-2',
                selectedDrinkSubcategory === sub.id 
                  ? 'bg-white text-teal-700 border-white scale-105 shadow-lg' 
                  : 'bg-transparent text-white border-white/30 hover:bg-white/10'
              ]"
            >
              {{ sub.name }}
            </button>
          </div>

          <!-- DRINK LIST (BESAR) -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div 
              v-for="menu in drinkMenus"
              :key="menu.id"
              @click="selectDrinkMenu(menu)"
              class="group bg-white/10 backdrop-blur-sm border border-white/20 p-5 rounded-2xl cursor-pointer hover:bg-white hover:text-teal-900 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
            >
              <div class="flex justify-between items-start mb-2">
                <h4 class="font-bold text-lg leading-tight">{{ menu.name }}</h4>
                <span class="bg-white/20 group-hover:bg-teal-100 group-hover:text-teal-600 px-2 py-1 rounded-lg text-sm font-bold whitespace-nowrap transition-colors">
                  {{ formatPrice(menu.price) }}
                </span>
              </div>
              <p class="text-sm opacity-80 line-clamp-2 group-hover:opacity-100">
                {{ menu.description || 'Refreshing drink choice' }}
              </p>
            </div>
          </div>
        </div>

        <!-- RIGHT BOTTOM – DRINK IMAGE -->
        <div class="relative w-full h-[540px]">
          <img 
            :src="selectedDrinkImage || '/public/drink1.jpg'"
            class="w-full h-full object-contain p-8 bg-gray-50"
          >

          <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-xl border border-white/50 transition-all duration-300">
            <div class="flex justify-between items-start gap-4">
              <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ selectedDrinkMenu?.name || 'Pilih Menu' }}</h3>
                <p class="text-gray-600 leading-relaxed">
                  {{ selectedDrinkMenu?.description || 'Silakan pilih menu di samping untuk melihat detail.' }}
                </p>
              </div>
              <span class="bg-gradient-to-r from-emerald-500 to-teal-400 text-white px-5 py-2 rounded-full font-bold text-xl shadow-lg whitespace-nowrap">
                {{ selectedDrinkMenu ? formatPrice(selectedDrinkMenu.price) : 'Rp 0' }}
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center py-14 bg-black">
        <p class="text-white mb-8 tracking-widest uppercase text-sm">
          Online ordering available at
        </p>

        <div class="flex justify-center gap-8">
          <!-- GOFOOD -->
          <a 
            href="https://YOUR_GOFOOD_LINK" 
            target="_blank"
            class="bg-white px-6 py-3 rounded-xl border-2 border-red-500 shadow-lg hover:shadow-red-500/40 transition"
          >
            <img src="/public/gofood-logo.png" class="h-12">
          </a>

          <!-- GRABFOOD -->
          <a 
            href="https://YOUR_GRABFOOD_LINK" 
            target="_blank"
            class="bg-white px-6 py-3 rounded-xl border-2 border-green-500 shadow-lg hover:shadow-green-500/40 transition"
          >
            <img src="/public/grabfood-logo.png" class="h-12">
          </a>

          <!-- SHOPEEFOOD -->
          <a 
            href="https://YOUR_SHOPEEFOOD_LINK" 
            target="_blank"
            class="bg-white px-6 py-3 rounded-xl border-2 border-orange-500 shadow-lg hover:shadow-orange-500/40 transition"
          >
            <img src="/public/shopeefood-logo.png" class="h-12">
          </a>
        </div>
      </div>
    </section>

    <CommunitySection />
    <CustomerReviewSection />

    <section id="location" class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 items-start">
          <!-- LEFT SIDE: UTARA LOGO & BUTTONS -->
          <div class="space-y-4">
            <!-- UTARA Logo Image -->
            <div class="flex items-start justify-start">
              <img 
                src="/public/utara.jpg" 
                alt="UTARA Logo" 
                class="w-auto h-24 object-contain"
                style="max-width: 450px;"
              />
            </div>

            <!-- Tagline -->
            <p class="text-gray-700 text-sm leading-relaxed" style="max-width: 450px;">
              Tempatnya cerita, tawa, dan kopi yang diseduh dengan hati.<br />
              Kami hadir di belakang kampus untuk menemani tugas, obrolan, dan pagi yang hangat.
            </p>

            <!-- Buttons -->
            <div class="flex gap-3" style="max-width: 450px;">
              <!-- WhatsApp / Reservasi Button with Phone Number -->
              <div class="flex-1 border-2 border-black rounded-lg overflow-hidden shadow-md">
                <a 
                  href="https://wa.me/6281215246678?text=Halo%20Kopi%20Utara" 
                  target="_blank"
                  class="block bg-sky-400 text-white font-bold text-center py-2.5 text-sm hover:bg-sky-500 transition-all"
                >
                  Kontak Whatsapp / Reservasi
                </a>
                <div class="bg-white text-gray-900 font-bold text-center py-2.5 border-t-2 border-black text-sm">
                  081215246678
                </div>
              </div>

              <!-- Social Media Button with Usernames -->
              <div class="flex-1 border-2 border-black rounded-lg overflow-hidden shadow-md">
                <div class="bg-emerald-500 text-white font-bold text-center py-2.5 text-sm">
                  Sosial Media
                </div>
                <div class="bg-white py-2 px-2 border-t-2 border-black flex items-center justify-center gap-2">
                  <a 
                    href="https://instagram.com/utara.yk" 
                    target="_blank" 
                    class="flex items-center gap-1.5 hover:scale-105 transition-transform"
                  >
                    <div class="bg-pink-500 p-1.5 rounded">
                      <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                      </svg>
                    </div>
                    <span class="font-semibold text-gray-900 text-xs">Utara.yk</span>
                  </a>
                  <a 
                    href="https://tiktok.com/@utara.yk" 
                    target="_blank" 
                    class="flex items-center gap-1.5 hover:scale-105 transition-transform"
                  >
                    <div class="bg-gray-900 p-1.5 rounded">
                      <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                      </svg>
                    </div>
                    <span class="font-semibold text-gray-900 text-xs">Utara.yk</span>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- RIGHT SIDE: MAP -->
          <div class="bg-white rounded-xl overflow-hidden shadow-lg border-2 border-black">
            <div class="bg-gray-50 px-4 py-2 border-b-2 border-black">
              <h3 class="text-gray-800 font-bold text-center text-sm">
                📍 Jl. Kenurising, Tlogo, Tamantirto (Belakang Unires Putra UMY)
              </h3>
            </div>
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.666666666666!2d106.816666!3d-6.200000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMDAuMCJTIDEwNsKwNDknMDAuMCJF!5e0!3m2!1sen!2sid!4v1234567890"
              width="100%"
              height="350"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
            />
          </div>
        </div>
      </div>
    </section>


  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import CommunitySection from '@/Pages/Home/components/CommunitySection.vue';
import CustomerReviewSection from '@/Pages/Home/components/CustomerReviewSection.vue';

export default {
  name: 'Home',
  components: {
    Link,
    CommunitySection,
    CustomerReviewSection,
  },

  props: {
    categories: {
      type: Array,
      default: () => []
    },
    banners: {
      type: Array,
      default: () => []
    }
  },

  data() {
    return {
      scrolled: false,
      showWelcome: false,
      // Gunakan banners dari prop jika ada, jika tidak gunakan default dummy
      bannerImages: this.banners.length > 0 
        ? this.banners.map(b => b.image) 
        : ['/Banner1.jpg', '/Banner2.jpg', '/Banner3.jpg'],
      bannerHeight: 500,
      bannerGapPx: 0,
      isDragging: false,
      dragStartX: 0,
      dragDelta: 0,
      dragStartScroll: 0,
      viewportWidth: typeof window !== 'undefined' ? window.innerWidth : 1440,
      bannerScroll: null,
      selectedFoodSubcategory: null,
      selectedDrinkSubcategory: null,
      selectedFoodMenu: null,
      selectedDrinkMenu: null,
    };
  },

  computed: {
    foodCategory() {
      return this.categories.find(cat => cat.id === 1) || { subcategories: [] };
    },
    drinkCategory() {
      return this.categories.find(cat => cat.id === 2) || { subcategories: [] };
    },
    foodSubcategory() {
      return this.foodCategory.subcategories.find(sub => sub.id === this.selectedFoodSubcategory) || { menus: [] };
    },
    drinkSubcategory() {
      return this.drinkCategory.subcategories.find(sub => sub.id === this.selectedDrinkSubcategory) || { menus: [] };
    },
    foodMenus() {
      return this.foodSubcategory.menus || [];
    },
    drinkMenus() {
      return this.drinkSubcategory.menus || [];
    },
    selectedFoodImage() {
      return this.selectedFoodMenu?.image || '/public/food1.jpg';
    },
    selectedDrinkImage() {
      return this.selectedDrinkMenu?.image || '/public/drink1.jpg';
    },
    currentBannerImage() {
      return this.bannerImages[this.activeBannerIndex] || this.bannerImages[0];
    },
    sliderOffset() {
      const widths = this.bannerImages.map((_, idx) => this.getBannerWidth(idx));
      const gap = this.bannerGapPx;
      const before = widths.slice(0, this.activeBannerIndex).reduce((a, b) => a + b, 0) + gap * this.activeBannerIndex;
      const current = widths[this.activeBannerIndex] || widths[0] || 0;
      const container = this.viewportWidth || 0;
      const centerOffset = (container - current) / 2;
      return centerOffset - before;
    },
    dragTransform() {
      return `translateX(${this.sliderOffset + this.dragDelta}px)`;
    }
  },

  mounted() {
    window.addEventListener('scroll', this.handleScroll);
    window.addEventListener('resize', this.handleResize);
    this.handleResize();
    this.initializeSelections();
    this.bannerScroll = this.$refs.bannerScroll;
    this.$nextTick(() => this.scrollToActive(false));
  },

  beforeUnmount() {
    window.removeEventListener('scroll', this.handleScroll);
    window.removeEventListener('resize', this.handleResize);
  },

  methods: {
    handleScroll() {
      this.scrolled = window.scrollY > 50;
    },
    initializeSelections() {
      if (this.foodCategory.subcategories.length) {
        const firstFood = this.foodCategory.subcategories[0];
        this.selectedFoodSubcategory = firstFood.id;
        this.selectedFoodMenu = firstFood.menus[0] || null;
      }
      if (this.drinkCategory.subcategories.length) {
        const firstDrink = this.drinkCategory.subcategories[0];
        this.selectedDrinkSubcategory = firstDrink.id;
        this.selectedDrinkMenu = firstDrink.menus[0] || null;
      }
    },
    selectFoodSubcategory(id) {
      this.selectedFoodSubcategory = id;
      const sub = this.foodCategory.subcategories.find(item => item.id === id);
      this.selectedFoodMenu = sub?.menus?.[0] || null;
    },
    selectDrinkSubcategory(id) {
      this.selectedDrinkSubcategory = id;
      const sub = this.drinkCategory.subcategories.find(item => item.id === id);
      this.selectedDrinkMenu = sub?.menus?.[0] || null;
    },
    selectFoodMenu(menu) {
      this.selectedFoodMenu = menu;
    },
    selectDrinkMenu(menu) {
      this.selectedDrinkMenu = menu;
    },
    scrollToActive(animate = true) {
      // Removed auto-centering logic to allow free scrolling
    },
    onScrollDragStart(e) {
      if (!this.bannerScroll) return;
      this.isDragging = true;
      this.dragStartX = e.clientX;
      this.dragStartScroll = this.bannerScroll.scrollLeft;
      if (e.target.setPointerCapture) {
        e.target.setPointerCapture(e.pointerId);
      }
    },
    onScrollDragMove(e) {
      if (!this.isDragging || !this.bannerScroll) return;
      const delta = e.clientX - this.dragStartX;
      this.bannerScroll.scrollLeft = this.dragStartScroll - delta;
    },
    onScrollDragEnd(e) {
      if (!this.isDragging) return;
      this.isDragging = false;
      if (e && e.target && e.target.releasePointerCapture) {
        e.target.releasePointerCapture(e.pointerId);
      }
    },
    onBannerWheel(e) {
      if (!this.bannerScroll) return;
      const delta = e.deltaY || e.deltaX;
      this.bannerScroll.scrollLeft += delta;
    },
    slideStyle(idx) {
      // Lebar tetap untuk semua gambar agar scrolling lancar
      const width = 800; 
      return {
        width: `${width}px`,
        minWidth: `${width}px`,
        maxWidth: `${width}px`,
        height: `${this.bannerHeight}px`,
        transform: 'scale(1)',
        opacity: 1,
      };
    },
    handleResize() {
      this.viewportWidth = window.innerWidth;
    },
    formatPrice(price) {
      if (typeof price !== 'number') return 'N/A'
      
      // Format shorthand: 10k, 20k, 150k, 1.5M
      if (price >= 1000000) {
        return 'Rp ' + (price / 1000000).toFixed(1).replace(/\.0$/, '') + 'M'
      }
      
      if (price >= 1000) {
        return (price / 1000).toFixed(0) + 'k'
      }
      
      return 'Rp ' + price
    },
  },
};
</script>

<style scoped>
.hero-kenburns {
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.banner-scroll {
  touch-action: pan-x;
  -ms-overflow-style: none;
  scrollbar-width: none; /* Firefox */
}
.banner-scroll::-webkit-scrollbar {
  display: none; /* Chrome, Safari, Opera */
}
.no-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.no-scrollbar::-webkit-scrollbar {
  display: none;
}
</style>
