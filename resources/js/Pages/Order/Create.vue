<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    menus: Array,
    isMember: Boolean
});

const page = usePage();
const user = computed(() => page.props.auth?.user);

const form = useForm({
    items: [],
    payment_method: 'cash',
    table_number: '',
    total_price: 0
});

const cart = ref([]);
const selectedCategory = ref('all');

// Modifikasi 1: Urutkan menu agar yang diskon berada di atas
const filteredMenus = computed(() => {
    let list = props.menus;
    if (selectedCategory.value !== 'all') {
        list = list.filter(menu => menu.category_id === Number(selectedCategory.value));
    }
    // Urutkan berdasarkan diskon persen (yang lebih besar di atas)
    return [...list].sort((a, b) => (b.discount_percent || 0) - (a.discount_percent || 0));
});

const discountedMenus = computed(() => filteredMenus.value.filter(m => m.discount_percent > 0));

const addToCart = (menu) => {
    if (!menu.is_available) return;
    const finalPrice = menu.discount_percent > 0 ? menu.discounted_price : menu.price;
    const item = cart.value.find(i => i.id === menu.id);
    if (item) {
        item.quantity++;
    } else {
        cart.value.push({
            id: menu.id,
            name: menu.name,
            price: Number(finalPrice),
            original_price: Number(menu.price),
            discount_percent: menu.discount_percent || 0,
            quantity: 1
        });
    }
};

const removeFromCart = (index) => cart.value.splice(index, 1);

const updateQuantity = (id, delta) => {
    const item = cart.value.find(i => i.id === id);
    if (item) {
        item.quantity += delta;
        if (item.quantity <= 0) cart.value = cart.value.filter(i => i.id !== id);
    }
};

const totalPrice = computed(() => cart.value.reduce((total, item) => total + (item.price * item.quantity), 0));

const submit = () => {
    if (cart.value.length === 0) return;
    if (!form.table_number) {
        alert('Silakan pilih nomor meja Anda terlebih dahulu.');
        return;
    }
    form.items = cart.value;
    form.total_price = totalPrice.value;
    form.post(route('orders.store'));
};
</script>

<template>
    <Head title="Pesan Menu" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-xl md:text-2xl font-bold text-slate-800 tracking-tight">Pesan Menu</h1>
                    <p class="text-xs md:text-sm text-slate-500">Pilih menu favoritmu dan nikmati hidangan spesial kami</p>
                </div>
                <!-- Status Member -->
                <div v-if="isMember" class="flex items-center gap-2 px-4 py-2 bg-emerald-50 border border-emerald-100 rounded-2xl">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-xs font-black text-emerald-700 uppercase tracking-widest">Member Aktif - Diskon Tersedia</span>
                </div>
                <div v-else class="flex items-center gap-2 px-4 py-2 bg-amber-50 border border-amber-100 rounded-2xl">
                    <div class="w-2 h-2 bg-amber-400 rounded-full"></div>
                    <span class="text-xs font-black text-amber-700 uppercase tracking-widest">Guest - Daftar Member untuk Diskon</span>
                </div>
            </div>
        </template>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 max-w-7xl mx-auto pb-12">
            <!-- Menu Grid -->
            <div class="xl:col-span-2 space-y-6">
                <!-- Category Filter Tabs -->
                <div class="flex p-1.5 bg-slate-100 rounded-2xl w-fit mb-4 border border-slate-200 shadow-inner">
                    <button @click="selectedCategory = 'all'" :class="selectedCategory === 'all' ? 'bg-white text-emerald-600 shadow-md ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-800'" class="px-8 py-2.5 rounded-xl text-sm font-black transition-all uppercase tracking-wider">Semua</button>
                    <button @click="selectedCategory = 1" :class="selectedCategory === 1 ? 'bg-white text-emerald-600 shadow-md ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-800'" class="px-8 py-2.5 rounded-xl text-sm font-black transition-all ml-1 uppercase tracking-wider">Makanan</button>
                    <button @click="selectedCategory = 2" :class="selectedCategory === 2 ? 'bg-white text-emerald-600 shadow-md ring-1 ring-slate-200' : 'text-slate-500 hover:text-slate-800'" class="px-8 py-2.5 rounded-xl text-sm font-black transition-all ml-1 uppercase tracking-wider">Minuman</button>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 md:p-8 min-h-[600px]">
                    <div class="flex justify-between items-center mb-10">
                        <div>
                            <h3 class="text-xl font-black text-slate-800 flex items-center gap-3">
                                <span class="p-2 bg-emerald-50 rounded-xl">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </span>
                                {{ selectedCategory === 'all' ? 'Katalog Utama' : (selectedCategory === 1 ? 'Menu Makanan' : 'Menu Minuman') }}
                            </h3>
                            <p class="text-xs text-slate-400 mt-1 font-bold italic">Menampilkan {{ filteredMenus.length }} hidangan istimewa</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
                        <div
                            v-for="menu in filteredMenus"
                            :key="menu.id"
                            :class="[
                                'group rounded-[2rem] border transition-all duration-500 overflow-hidden flex flex-col',
                                menu.is_available
                                    ? 'bg-white border-slate-100 hover:border-emerald-200 hover:shadow-2xl hover:shadow-emerald-100/50'
                                    : 'bg-slate-50 border-slate-200 opacity-70 cursor-not-allowed'
                            ]"
                        >
                            <!-- Image Header -->
                            <div class="relative aspect-[4/3] overflow-hidden bg-slate-50">
                                <img 
                                    :src="menu.image_url || 'https://placehold.co/600x400/f8fafc/cbd5e1?text=' + menu.name" 
                                    :class="[
                                        'w-full h-full object-cover transition-transform duration-700',
                                        menu.is_available ? 'group-hover:scale-110' : 'grayscale scale-105'
                                    ]"
                                    :style="{ 
                                        objectPosition: menu.image_position || 'center',
                                        transform: menu.is_available ? `scale(${menu.image_zoom || 1})` : undefined
                                    }"
                                    alt="Menu Image"
                                />

                                <!-- Overlay hover (hanya untuk yang tersedia) -->
                                <div v-if="menu.is_available" class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                                <!-- Overlay & Badge HABIS -->
                                <div v-if="!menu.is_available" class="absolute inset-0 bg-slate-900/40 flex items-center justify-center">
                                    <div class="bg-white/90 backdrop-blur-sm px-5 py-2.5 rounded-2xl shadow-xl border border-slate-200">
                                        <p class="text-slate-700 font-black text-sm tracking-widest uppercase flex items-center gap-2">
                                            <span>😔</span> Sedang Habis
                                        </p>
                                    </div>
                                </div>

                                <!-- Tombol tambah (hanya muncul jika tersedia) -->
                                <button 
                                    v-if="menu.is_available"
                                    @click="addToCart(menu)" 
                                    class="absolute bottom-4 right-4 w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center hover:bg-emerald-700 active:scale-90 transition-all shadow-xl shadow-emerald-200 translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100"
                                >
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </button>
                                
                                <!-- Badge Diskon -->
                                <div v-if="menu.is_available && menu.discount_percent > 0" class="absolute top-3 left-3 flex flex-col gap-1.5">
                                    <span class="bg-rose-500 text-white text-[10px] font-black px-3 py-1 rounded-full shadow-lg shadow-rose-500/40">
                                        🔥 DISKON {{ menu.discount_percent }}%
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="mb-4">
                                    <h4 :class="['font-black text-lg leading-tight transition-colors', menu.is_available ? 'text-slate-800 group-hover:text-emerald-700' : 'text-slate-400']">{{ menu.name }}</h4>
                                    <p class="text-xs text-slate-400 mt-1 line-clamp-2 leading-relaxed" v-if="menu.description">{{ menu.description }}</p>
                                </div>
                                <div class="mt-auto flex justify-between items-center">
                                    <div v-if="menu.is_available && menu.discount_percent > 0">
                                        <div class="flex items-baseline gap-2">
                                            <span class="text-xl font-black text-emerald-600">Rp {{ Number(menu.discounted_price).toLocaleString('id-ID') }}</span>
                                            <span class="text-xs font-bold text-slate-400 line-through">Rp {{ Number(menu.price).toLocaleString('id-ID') }}</span>
                                        </div>
                                    </div>
                                    <span v-else-if="menu.is_available" class="text-xl font-black text-emerald-600">Rp {{ Number(menu.price).toLocaleString('id-ID') }}</span>
                                    <span v-else class="text-base font-bold text-slate-400 line-through">Rp {{ Number(menu.price).toLocaleString('id-ID') }}</span>
                                    
                                    <!-- Tombol tambah mobile (hanya jika tersedia) -->
                                    <button 
                                        v-if="menu.is_available"
                                        @click="addToCart(menu)" 
                                        class="md:hidden w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </button>

                                    <!-- Label habis di mobile -->
                                    <span v-else class="text-[10px] font-black uppercase tracking-widest text-slate-400 bg-slate-100 px-3 py-1.5 rounded-xl">Habis</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkout Section (Cart) -->
            <div class="xl:col-span-1 relative">
                <!-- mt-[76px] untuk menyejajarkan dengan kotak menu di kiri yang terhalang tabs category -->
                <div class="bg-white rounded-[2.5rem] shadow-sm p-8 sticky top-24 mt-[76px] text-slate-800 overflow-hidden border border-slate-200">
                    <!-- Decor -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-50 rounded-full blur-3xl"></div>
                    
                    <h3 class="text-xl font-black mb-8 flex items-center gap-3 relative z-10">
                        <span class="p-2 bg-emerald-50 rounded-xl">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </span>
                        Keranjang Anda
                    </h3>

                    <div v-if="cart.length === 0" class="text-center py-20 relative z-10">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-200 shadow-inner">
                             <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <p class="text-slate-400 font-bold italic tracking-wide">Belum ada menu yang dipilih</p>
                    </div>

                    <div v-else class="space-y-8 relative z-10">
                        <div class="max-h-[40vh] overflow-y-auto pr-2 space-y-4 custom-scrollbar">
                            <div v-for="(item, index) in cart" :key="index" class="flex justify-between items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:border-emerald-200 transition-all">
                                <div class="flex-1">
                                    <p class="text-sm font-black text-slate-800 leading-tight mb-1">{{ item.name }}</p>
                                    <p class="text-[10px] text-emerald-600 font-bold tracking-widest uppercase">Rp {{ item.price.toLocaleString('id-ID') }}</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center bg-white rounded-xl border border-slate-200 p-1 shadow-sm">
                                        <button @click="updateQuantity(item.id, -1)" class="w-7 h-7 flex items-center justify-center text-slate-400 hover:text-emerald-600 transition-colors font-bold">-</button>
                                        <span class="px-3 text-xs font-black text-slate-800">{{ item.quantity }}</span>
                                        <button @click="updateQuantity(item.id, 1)" class="w-7 h-7 flex items-center justify-center text-emerald-600 hover:text-emerald-500 transition-colors font-bold">+</button>
                                    </div>
                                    <button @click="removeFromCart(index)" class="text-rose-400 hover:text-rose-600 transition-colors p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100">
                            <div class="flex justify-between items-end mb-8 px-2">
                                <div class="flex flex-col">
                                    <span class="text-xs text-slate-400 uppercase font-black tracking-[0.2em] mb-1">Total Bayar</span>
                                    <span class="text-xs text-slate-300 italic font-bold">Incl. tax 10%</span>
                                </div>
                                <span class="text-3xl font-black text-emerald-600 tracking-tighter">Rp {{ totalPrice.toLocaleString('id-ID') }}</span>
                            </div>

                            <div class="space-y-6">
                                <div class="space-y-3">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] px-2">Nomor Meja</p>
                                    <select v-model="form.table_number" class="w-full bg-slate-50 border-slate-200 text-slate-600 rounded-xl py-4 px-4 text-sm font-bold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all cursor-pointer">
                                        <option value="" disabled selected>Pilih Nomor Meja (1-20)</option>
                                        <option v-for="n in 20" :key="n" :value="n">Meja {{ n }}</option>
                                    </select>
                                </div>

                                <div class="space-y-3">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] px-2">Metode Pembayaran</p>
                                    <div class="grid grid-cols-2 gap-3">
                                        <button type="button" @click="form.payment_method = 'cash'" :class="form.payment_method === 'cash' ? 'bg-emerald-600 border-emerald-600 text-white shadow-lg shadow-emerald-100' : 'bg-slate-50 border-slate-200 text-slate-400'" class="py-4 rounded-xl border text-[10px] font-black tracking-widest transition-all uppercase">
                                            💵 Tunai
                                        </button>
                                        <button type="button" @click="form.payment_method = 'qris'" :class="form.payment_method === 'qris' ? 'bg-indigo-600 border-indigo-600 text-white shadow-lg shadow-indigo-100' : 'bg-slate-50 border-slate-200 text-slate-400'" class="py-4 rounded-xl border text-[10px] font-black tracking-widest transition-all uppercase">
                                            📱 QRIS / Digital
                                        </button>
                                    </div>
                                </div>

                                <button @click="submit" :disabled="form.processing || cart.length === 0" class="w-full bg-emerald-600 text-white py-5 rounded-2xl font-black uppercase tracking-[0.15em] hover:bg-emerald-700 transition-all shadow-xl shadow-emerald-100 active:scale-[0.98] disabled:bg-slate-100 disabled:text-slate-300">
                                    {{ form.processing ? 'Memproses...' : 'Buat Pesanan Sekarang' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar { width: 4px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb { background-color: rgba(255,255,255,0.1); border-radius: 20px; }
</style>
