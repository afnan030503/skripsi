<template>
  <div class="min-h-screen bg-stone-50 flex flex-col">
    <header class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur shadow-sm border-b border-gray-100">
      <div class="max-w-7xl mx-auto px-4 md:px-6 h-20 flex items-center justify-between">
        <Link href="/" class="flex items-center gap-2 md:gap-3">
          <img src="/public/utara.jpg" alt="Utara" class="h-10 md:h-12 w-auto rounded-xl shadow" />
        </Link>
        
        <!-- Desktop Nav -->
        <nav class="hidden lg:flex items-center gap-6 text-sm font-semibold text-gray-700">
          <a href="#home" class="text-emerald-700 border-b-2 border-emerald-700 pb-1">Home</a>
          <a href="#menu" class="hover:text-emerald-700 transition">Menu</a>
          <a href="#tetangga" class="hover:text-emerald-700 transition">Community</a>
          <Link href="/promo-loyalty" class="hover:text-emerald-700 transition">Promo & Loyalty</Link>
          <Link href="/about" class="hover:text-emerald-700 transition">About Us</Link>
          <a href="#blog" class="hover:text-emerald-700 transition">Blog</a>
          <a href="#contact" class="hover:text-emerald-700 transition">Contact Us</a>
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
            <a @click="isMobileMenuOpen = false" href="#home" class="p-2 hover:bg-emerald-50 rounded-lg">Home</a>
            <a @click="isMobileMenuOpen = false" href="#menu" class="p-2 hover:bg-emerald-50 rounded-lg">Menu</a>
            <a @click="isMobileMenuOpen = false" href="#tetangga" class="p-2 hover:bg-emerald-50 rounded-lg">Community</a>
            <Link @click="isMobileMenuOpen = false" href="/promo-loyalty" class="p-2 hover:bg-emerald-50 rounded-lg">Promo & Loyalty</Link>
            <Link @click="isMobileMenuOpen = false" href="/about" class="p-2 hover:bg-emerald-50 rounded-lg">About Us</Link>
            <a @click="isMobileMenuOpen = false" href="#blog" class="p-2 hover:bg-emerald-50 rounded-lg">Blog</a>
            <a @click="isMobileMenuOpen = false" href="#contact" class="p-2 hover:bg-emerald-50 rounded-lg text-emerald-600">Contact Us</a>
            <Link @click="isMobileMenuOpen = false" href="/login" class="p-2 bg-gray-100 rounded-lg text-center">Login</Link>
          </nav>
        </div>
      </transition>
    </header>

    <section id="home" class="relative hover:cursor-grab active:cursor-grabbing h-[300px] md:h-[500px] overflow-hidden mt-20">
      <div 
        class="absolute inset-0 overflow-x-auto overflow-y-hidden flex items-center justify-start banner-scroll select-none scroll-smooth"
        ref="bannerScroll"
        @mousedown="onScrollDragStart"
        @mousemove="onScrollDragMove"
        @mouseup="onScrollDragEnd"
        @mouseleave="onScrollDragEnd"
        @wheel="onBannerWheel"
        style="scrollbar-width: none; -ms-overflow-style: none;"
      >
        <div class="flex items-center">
          <div 
            v-for="(img, idx) in bannerImages"
            :key="img + idx"
            class="relative shrink-0 overflow-hidden shadow-2xl rounded-lg"
          >
            <img 
              :src="img" 
              class="h-[300px] md:h-[500px] w-auto object-cover" 
              draggable="false"
            />
          </div>
        </div>
      </div>
    </section>

    <section id="menu" class="w-full bg-black">
      <!-- FULL GRID -->
      <div class="grid grid-cols-1 md:grid-cols-2 w-full overflow-hidden">

        <!-- LEFT TOP – FOOD IMAGE (Responsive Height) -->
        <div class="relative w-full aspect-[4/3] md:aspect-auto md:h-full bg-gray-50 overflow-hidden">
          <img 
            :src="selectedFoodImage || '/public/food1.jpg'"
            class="w-full h-full object-cover"
            alt="Food"
          >
          <!-- Price Badge -->
          <div class="absolute bottom-4 left-4 bg-white/95 backdrop-blur px-3 py-1.5 md:px-4 md:py-2 rounded-lg shadow-xl border-2 border-gray-200">
            <div class="text-[10px] md:text-sm text-gray-600 mb-0.5 md:mb-1">{{ selectedFoodMenu?.name || 'Menu Item' }}</div>
            <div class="text-lg md:text-2xl font-black text-emerald-600">
              {{ selectedFoodMenu ? formatPrice(selectedFoodMenu.price) : '24k' }}
            </div>
          </div>
        </div>

        <!-- RIGHT TOP – FOOD CATEGORY & LIST -->
        <div class="bg-gradient-to-br from-sky-300 via-sky-400 to-blue-500 text-gray-900 min-h-[400px] md:aspect-[4/3] p-6 flex flex-col">
          <!-- CATEGORY TABS -->
          <div class="flex gap-2 mb-4 md:mb-6 border-b-2 border-gray-800/20 pb-2 overflow-x-auto no-scrollbar">
            <button 
              v-for="cat in foodCategory.subcategories"
              :key="cat.id"
              @click="selectFoodSubcategory(cat.id)"
              :class="[
                'px-4 py-2 font-bold text-xs md:text-sm whitespace-nowrap transition-all duration-200',
                selectedFoodSubcategory === cat.id 
                  ? 'bg-white text-gray-900 rounded-md shadow-md'
                  : 'text-gray-800 hover:bg-white/30 rounded-md'
              ]"
            >
              {{ cat.name }}
            </button>
          </div>

          <!-- FOOD LIST -->
          <div class="flex-1 overflow-y-auto space-y-1 pr-2 custom-scrollbar">
            <div 
              v-for="menu in foodMenus"
              :key="menu.id"
              @click="selectFoodMenu(menu)"
              :class="[
                'py-2 px-3 border-b border-dotted border-gray-800/30 cursor-pointer hover:bg-white/20 transition-colors rounded',
                selectedFoodMenu?.id === menu.id ? 'bg-white/30' : ''
              ]"
            >
              <div class="flex justify-between items-center">
                <span class="font-semibold text-xs md:text-sm">{{ menu.name }}</span>
                <span class="font-bold text-xs md:text-sm ml-2">{{ formatPrice(menu.price) }}</span>
              </div>
              <p v-if="menu.description" class="text-[10px] md:text-xs text-gray-700 mt-1 line-clamp-1">
                {{ menu.description }}
              </p>
            </div>
          </div>
        </div>

        <!-- LEFT BOTTOM – DRINK CATEGORY & LIST (Moved after image on mobile via order classes) -->
        <div class="bg-gradient-to-br from-emerald-200 via-emerald-300 to-teal-400 text-gray-900 min-h-[400px] md:aspect-[4/3] p-6 flex flex-col order-last md:order-none">
          <!-- CATEGORY TABS -->
          <div class="flex gap-2 mb-4 md:mb-6 border-b-2 border-gray-800/20 pb-2 overflow-x-auto no-scrollbar">
            <button
              v-for="sub in drinkCategory.subcategories"
              :key="sub.id"
              @click="selectDrinkSubcategory(sub.id)"
              :class="[
                'px-4 py-2 font-bold text-xs md:text-sm whitespace-nowrap transition-all duration-200',
                selectedDrinkSubcategory === sub.id 
                  ? 'bg-white text-gray-900 rounded-md shadow-md' 
                  : 'text-gray-800 hover:bg-white/30 rounded-md'
              ]"
            >
              {{ sub.name }}
            </button>
          </div>

          <!-- DRINK LIST -->
          <div class="flex-1 overflow-y-auto space-y-1 pr-2 custom-scrollbar">
            <div 
              v-for="menu in drinkMenus"
              :key="menu.id"
              @click="selectDrinkMenu(menu)"
              :class="[
                'py-2 px-3 border-b border-dotted border-gray-800/30 cursor-pointer hover:bg-white/20 transition-colors rounded',
                selectedDrinkMenu?.id === menu.id ? 'bg-white/30' : ''
              ]"
            >
              <div class="flex justify-between items-center">
                <span class="font-semibold text-xs md:text-sm">{{ menu.name }}</span>
                <span class="font-bold text-xs md:text-sm ml-2">{{ formatPrice(menu.price) }}</span>
              </div>
              <p v-if="menu.description" class="text-[10px] md:text-xs text-gray-700 mt-1 line-clamp-1">
                {{ menu.description }}
              </p>
            </div>
          </div>
        </div>

        <!-- RIGHT BOTTOM – DRINK IMAGE -->
        <div class="relative w-full aspect-[4/3] md:aspect-auto md:h-full bg-gray-50 overflow-hidden">
          <img 
            :src="selectedDrinkImage || '/public/drink1.jpg'"
            class="w-full h-full object-cover"
            alt="Drink"
          >
          <!-- Price Badge -->
          <div class="absolute bottom-4 left-4 bg-white/95 backdrop-blur px-3 py-1.5 md:px-4 md:py-2 rounded-lg shadow-xl border-2 border-gray-200">
            <div class="text-[10px] md:text-sm text-gray-600 mb-0.5 md:mb-1">{{ selectedDrinkMenu?.name || 'Menu Item' }}</div>
            <div class="text-lg md:text-2xl font-black text-emerald-600">
              {{ selectedDrinkMenu ? formatPrice(selectedDrinkMenu.price) : '24k' }}
            </div>
          </div>
        </div>
      </div>

      <div class="text-center py-14 bg-black">
        <p class="text-white mb-8 tracking-widest uppercase text-sm">
          Online ordering available at
        </p>

        <div class="flex flex-wrap justify-center gap-4 md:gap-8 px-4">
          <!-- GOFOOD -->
          <a 
            href="https://YOUR_GOFOOD_LINK" 
            target="_blank"
            class="bg-white px-4 py-2 md:px-6 md:py-3 rounded-xl border-2 border-red-500 shadow-lg hover:shadow-red-500/40 transition"
          >
            <img src="/public/gofood-logo.png" class="h-8 md:h-12">
          </a>

          <!-- GRABFOOD -->
          <a 
            href="https://YOUR_GRABFOOD_LINK" 
            target="_blank"
            class="bg-white px-4 py-2 md:px-6 md:py-3 rounded-xl border-2 border-green-500 shadow-lg hover:shadow-green-500/40 transition"
          >
            <img src="/public/grabfood-logo.png" class="h-8 md:h-12">
          </a>

          <!-- SHOPEEFOOD -->
          <a 
            href="https://YOUR_SHOPEEFOOD_LINK" 
            target="_blank"
            class="bg-white px-4 py-2 md:px-6 md:py-3 rounded-xl border-2 border-orange-500 shadow-lg hover:shadow-orange-500/40 transition"
          >
            <img src="/public/shopeefood-logo.png" class="h-8 md:h-12">
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
          <div class="space-y-4 flex flex-col items-center md:items-start text-center md:text-left">
            <!-- UTARA Logo Image -->
            <div class="flex items-center justify-center md:items-start md:justify-start w-full">
              <img 
                src="/public/utara.jpg" 
                alt="UTARA Logo" 
                class="w-auto h-20 md:h-24 object-contain rounded-lg"
                style="max-width: 100%;"
              />
            </div>

            <!-- Tagline -->
            <p class="text-gray-700 text-xs md:text-sm leading-relaxed max-w-sm md:max-w-[450px]">
              Tempatnya cerita, tawa, dan kopi yang diseduh dengan hati.<br />
              Kami hadir di belakang kampus untuk menemani tugas, obrolan, dan pagi yang hangat.
            </p>

            <!-- Buttons Stack -->
            <div class="flex flex-col sm:flex-row gap-3 w-full max-w-sm md:max-w-[450px]">
              <!-- WhatsApp / Reservasi Button -->
              <div class="flex-1 border-2 border-black rounded-lg overflow-hidden shadow-md">
                <a 
                  href="https://wa.me/6281215246678?text=Halo%20Kopi%20Utara" 
                  target="_blank"
                  class="block bg-sky-400 text-white font-bold text-center py-2.5 text-xs md:text-sm hover:bg-sky-500 transition-all"
                >
                  Kontak Whatsapp / Reservasi
                </a>
                <div class="bg-white text-gray-900 font-bold text-center py-2.5 border-t-2 border-black text-xs md:text-sm">
                  081215246678
                </div>
              </div>

              <!-- Social Media Button -->
              <div class="flex-1 border-2 border-black rounded-lg overflow-hidden shadow-md">
                <div class="bg-emerald-500 text-white font-bold text-center py-2.5 text-xs md:text-sm">
                  Sosial Media
                </div>
                <div class="bg-white py-2 px-2 border-t-2 border-black flex items-center justify-center gap-4">
                  <a 
                    href="https://instagram.com/utara.yk" 
                    target="_blank" 
                    class="flex items-center gap-1.5 hover:scale-110 transition-transform"
                  >
                    <div class="bg-pink-500 p-1.5 rounded-md">
                      <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                      </svg>
                    </div>
                  </a>
                  <a 
                    href="https://tiktok.com/@utara.yk" 
                    target="_blank" 
                    class="flex items-center gap-1.5 hover:scale-110 transition-transform"
                  >
                    <div class="bg-black p-1.5 rounded-md">
                      <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                      </svg>
                    </div>
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
      isMobileMenuOpen: false,
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
