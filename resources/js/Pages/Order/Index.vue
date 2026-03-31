<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const props = defineProps({
    orders: Object
});

const page = usePage();

const getStatusClass = (status) => {
    switch (status) {
        case 'proses': return 'bg-amber-50 text-amber-600 border-amber-100';
        case 'success': return 'bg-emerald-50 text-emerald-600 border-emerald-100';
        case 'cancel': return 'bg-rose-50 text-rose-600 border-rose-100';
        default: return 'bg-slate-50 text-slate-600 border-slate-100';
    }
};

const loadSnapScript = () => {
    return new Promise((resolve) => {
        if (window.snap) {
            resolve(true);
            return;
        }
        const script = document.createElement('script');
        const isProduction = page.props.midtrans_is_production;
        script.src = isProduction 
            ? 'https://app.midtrans.com/snap/snap.js' 
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
        script.setAttribute('data-client-key', page.props.midtrans_client_key);
        script.onload = () => resolve(true);
        script.onerror = () => resolve(false);
        document.head.appendChild(script);
    });
};

const payWithSnap = async (token, retries = 10) => {
    if (!window.snap) {
        console.log(`Waiting for Midtrans Snap script... (${retries} retries left)`);
        const loaded = await loadSnapScript();
        if (!loaded && retries > 0) {
            setTimeout(() => payWithSnap(token, retries - 1), 1000);
            return;
        }
    }

    if (window.snap) {
        window.snap.pay(token, {
            onSuccess: (result) => { 
                window.location.reload(); 
            },
            onPending: (result) => { 
                console.log('pending', result); 
            },
            onError: (result) => { 
                console.log('error', result); 
                alert('Gagal memproses pembayaran dengan Midtrans. Silakan coba lagi atau hubungi admin.');
            },
            onClose: () => { 
                console.log('customer closed the popup');
            }
        });
    } else {
        console.error('Midtrans Snap script failed to load after retries.');
    }
};

onMounted(async () => {
    if (page.props.flash.snap_token) {
        await payWithSnap(page.props.flash.snap_token);
    } 
});
</script>

<template>
    <Head title="Riwayat Pesanan" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="text-xl md:text-2xl font-bold text-slate-800 tracking-tight">Riwayat Pesanan Saya</h1>
            <p class="text-xs md:text-sm text-slate-500">Pantau status pesanan dan rincian pembayaran Anda</p>
        </template>

        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden min-h-[400px]">
                <div v-if="orders.data.length === 0" class="text-center py-24 flex flex-col items-center gap-4">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center text-slate-200">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <div>
                        <p class="text-slate-900 font-bold text-xl tracking-tight">Belum Ada Pesanan</p>
                        <p class="text-slate-400 text-sm max-w-xs mx-auto mt-1">Anda belum pernah melakukan pemesanan. Nikmati kopi terbaik kami hari ini!</p>
                    </div>
                    <Link :href="route('orders.create')" class="mt-4 bg-emerald-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-emerald-700 transition shadow-xl shadow-emerald-100 active:scale-95">
                        Pesan Menu Sekarang
                    </Link>
                </div>
                
                <div v-else>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">ID Order</th>
                                    <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Detail Pesanan</th>
                                    <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Total Tagihan</th>
                                    <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                <tr v-for="order in orders.data" :key="order.id" class="hover:bg-slate-50/30 transition-all group">
                                    <td class="px-6 py-6 vertical-top">
                                        <div class="flex flex-col">
                                            <span class="font-mono font-bold text-slate-400 text-sm group-hover:text-emerald-600 transition-colors">#{{ order.id }}</span>
                                            <span class="text-xs text-slate-400 mt-1 font-medium">{{ new Date(order.created_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'}) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="space-y-2">
                                            <div v-for="item in order.items" :key="item.id" class="flex items-center justify-between gap-8 max-w-xs">
                                                <span class="text-sm font-bold text-slate-700 truncate capitalize">{{ item.menu?.name || 'Menu dihapus' }}</span>
                                                <span class="text-xs font-black text-slate-400 shrink-0 bg-slate-100 px-1.5 py-0.5 rounded">x{{ item.quantity }}</span>
                                            </div>
                                            <div class="pt-2 border-t border-slate-50 flex items-center gap-2">
                                                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">{{ order.payment_method }}</span>
                                                <span class="text-[10px] font-black text-indigo-400 uppercase tracking-widest bg-indigo-50 px-2 py-0.5 rounded-md">Meja {{ order.table_number || '-' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <span class="text-base font-black text-slate-800">Rp {{ Number(order.total_price).toLocaleString('id-ID') }}</span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex items-center gap-3">
                                                <span :class="['px-4 py-1.5 rounded-full text-[10px] font-black border uppercase tracking-widest shadow-sm', getStatusClass(order.status)]">
                                                    {{ order.status }}
                                                </span>
                                                <!-- Tombol Bayar Ulang (Hanya Digital) -->
                                                <button 
                                                     v-if="order.status === 'proses' && order.payment_method !== 'cash' && order.snap_token"
                                                     @click="payWithSnap(order.snap_token)"
                                                     class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors"
                                                     title="Bayar Sekarang"
                                                 >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                                </button>
                                            </div>
                                            <!-- Alasan Pembatalan -->
                                            <div v-if="order.status === 'cancel' && order.cancel_reason" class="mt-1 px-3 py-2 bg-rose-50 border border-rose-100 rounded-xl max-w-xs">
                                                <p class="text-[10px] font-black text-rose-400 uppercase tracking-widest mb-0.5">Alasan Pembatalan</p>
                                                <p class="text-xs text-rose-600 font-medium leading-relaxed">{{ order.cancel_reason }}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.vertical-top { vertical-align: top; }
</style>
