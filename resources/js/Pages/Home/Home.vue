<template>
  <div class="min-h-screen bg-stone-50 flex flex-col">
    <nav :class="[
        'fixed w-full z-50 transition-all duration-300',
        scrolled ? 'bg-white shadow-md py-1' : 'bg-transparent py-8'
    ]">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
      <Link href="/" class="flex items-center gap-3">
        <img 
            src="/public/utara.jpg" 
            alt="Logo Utara" 
            :class="[
                'h-20 transition-opacity', scrolled ? 'opacity-100' : 'opacity-90' 
            ]"
        />
      </Link>

      <ul :class="[
        'hidden md:flex items-center gap-8 font-medium transition-colors',
        scrolled ? 'text-gray-700' : 'text-white'
      ]">
        <li><a href="#home" class="hover:text-emerald-600 transition">Home</a></li>
        <li><a href="#menu" class="hover:text-emerald-600 transition">Menu</a></li>
        <li><a href="#tetangga" class="hover:text-emerald-600 transition">Community</a></li>
        <li><a href="#about" class="hover:text-emerald-600 transition">About Us</a></li>
        <li><a href="#blog" class="hover:text-emerald-600 transition">Blog</a></li>
        <li><a href="#contact" class="hover:text-emerald-600 transition">Contact Us</a></li>
        <li><a href="#location" class="hover:text-emerald-600 transition">Location</a></li>
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

    <section id="home" class="relative h-[500px] overflow-hidden">
      <div 
        class="absolute inset-0 overflow-hidden flex items-center justify-start banner-scroll select-none"
        ref="bannerScroll"
        :class="{ 'cursor-grabbing': isDragging, 'cursor-grab': !isDragging }"
        @pointerdown="onScrollDragStart"
        @pointermove="onScrollDragMove"
        @pointerup="onScrollDragEnd"
        @pointerleave="onScrollDragEnd"
        @wheel.prevent="onBannerWheel"
      >
        <div 
          class="flex items-center"
          :style="{ gap: `${bannerGapPx}px` }"
        >
          <div 
            v-for="(img, idx) in bannerImages"
            :key="img + idx"
            class="relative shrink-0 overflow-hidden shadow-2xl"
            :style="slideStyle(idx)"
          >
            <img 
              :src="img" 
              :style="{ height: `${bannerHeight}px` }" 
              class="w-full object-cover pointer-events-none" 
              draggable="false"
            />
          </div>
        </div>
      </div>

      <div class="relative h-full"></div>
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
        <div class="text-center mb-12">
          <h2 class="text-5xl font-bold text-gray-900 mb-4">Visit Us</h2>
          <p class="text-gray-600 text-lg">Find our coffee shop and experience the Utara difference</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
          <div class="bg-stone-50 rounded-2xl p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Get in Touch</h3>
            <div class="space-y-4">
              <div class="flex items-start gap-4">
                <div class="bg-emerald-100 p-3 rounded-lg">
                  <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-900 mb-1">Address</h4>
                  <p class="text-gray-600">Jl. Coffee Street No. 123<br />Jakarta, Indonesia</p>
                </div>
              </div>

              <div class="flex items-start gap-4">
                <div class="bg-emerald-100 p-3 rounded-lg">
                  <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-900 mb-1">Phone</h4>
                  <p class="text-gray-600">+62 812-3456-7890</p>
                </div>
              </div>

              <div class="flex items-start gap-4">
                <div class="bg-emerald-100 p-3 rounded-lg">
                  <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                  <p class="text-gray-600">hello@utara.coffee</p>
                </div>
              </div>
            </div>

            <div class="mt-8">
              <h4 class="font-semibold text-gray-900 mb-4">Opening Hours</h4>
              <div class="space-y-2 text-gray-600">
                <div class="flex justify-between">
                  <span>Monday - Friday</span>
                  <span class="font-semibold">07:00 - 22:00</span>
                </div>
                <div class="flex justify-between">
                  <span>Saturday - Sunday</span>
                  <span class="font-semibold">08:00 - 23:00</span>
                </div>
              </div>
            </div>
          </div>

          <div class="rounded-2xl overflow-hidden shadow-lg h-96">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.666666666666!2d106.816666!3d-6.200000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMDAuMCJTIDEwNsKwNDknMDAuMCJF!5e0!3m2!1sen!2sid!4v1234567890"
              width="100%"
              height="100%"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
            />
          </div>
        </div>
      </div>
    </section>

    <footer class="bg-gray-900 text-white py-12">
      <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-8 mb-8">
          <div>
            <div class="flex items-center gap-2 mb-4">
              <span class="text-2xl font-bold border-2 rounded px-2 py-1">北</span>
              <span class="text-2xl font-bold">UTARA</span>
            </div>
            <p class="text-gray-400">Premium Indonesian Coffee Experience</p>
          </div>

          <div>
            <h4 class="font-semibold mb-4">Quick Links</h4>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#home" class="hover:text-emerald-400 transition">Home</a></li>
              <li><a href="#menu" class="hover:text-emerald-400 transition">Menu</a></li>
              <li><a href="#tetangga" class="hover:text-emerald-400 transition">Community</a></li>
              <li><a href="#promo" class="hover:text-emerald-400 transition">Promo & Loyalty</a></li>
              <li><a href="#about" class="hover:text-emerald-400 transition">About</a></li>
              <li><a href="#location" class="hover:text-emerald-400 transition">Contact</a></li>
            </ul>
          </div>

          <div>
            <h4 class="font-semibold mb-4">Legal</h4>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#" class="hover:text-emerald-400 transition">Privacy Policy</a></li>
              <li><a href="#" class="hover:text-emerald-400 transition">Terms of Service</a></li>
            </ul>
          </div>

          <div>
            <h4 class="font-semibold mb-4">Follow Us</h4>
            <div class="flex gap-3">
              <a href="#" class="bg-gray-800 hover:bg-emerald-600 p-3 rounded-full transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>
              <a href="#" class="bg-gray-800 hover:bg-emerald-600 p-3 rounded-full transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
              </a>
            </div>
          </div>
        </div>

        <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
          <p>© 2025 Utara Coffee. All rights reserved.</p>
        </div>
      </div>
    </footer>
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
