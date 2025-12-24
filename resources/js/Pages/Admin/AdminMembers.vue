<template>
  <div class="flex min-h-screen bg-gray-50 font-sans">
    <AdminSidebar :isOpen="isSidebarOpen" @close="isSidebarOpen = false" />

    <main class="flex-1 min-w-0 overflow-y-auto">
      <header class="bg-white border-b border-slate-200 px-4 md:px-8 py-4 sticky top-0 z-30 flex justify-between items-center">
        <div class="flex items-center gap-4">
          <button @click="isSidebarOpen = true" class="lg:hidden p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
          </button>
          <div>
            <h1 class="text-xl md:text-2xl font-bold text-gray-800">Kelola Member</h1>
            <p class="text-xs text-gray-500 hidden sm:block">Manajemen poin dan royalti kustomer Utara</p>
          </div>
        </div>
        
        <button @click="openAddModal" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-bold transition flex items-center gap-2 shadow-sm text-sm">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
          Tambah Member
        </button>
      </header>

      <div class="p-4 md:p-8">
        <!-- Search & Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <div class="col-span-1 md:col-span-2">
            <div class="relative group">
              <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
              </span>
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Cari nama atau nomor HP member..."
                class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all shadow-sm"
              />
            </div>
          </div>
          <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
             <div>
               <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">Total Member</p>
               <p class="text-2xl font-black text-slate-800">{{ filteredMembers.length }}</p>
             </div>
             <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
             </div>
          </div>
        </div>

        <!-- Members Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full text-left">
              <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                  <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Member</th>
                  <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nomor HP</th>
                  <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Poin Saat Ini</th>
                  <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100">
                <tr v-for="member in filteredMembers" :key="member.id" class="hover:bg-gray-50/50 transition-colors">
                  <td class="px-6 py-4">
                    <div class="font-bold text-gray-900">{{ member.name }}</div>
                    <div class="text-xs text-gray-400">ID: #{{ member.id }}</div>
                  </td>
                  <td class="px-6 py-4 text-sm font-medium text-gray-600">
                    {{ member.phone }}
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                       <span class="px-3 py-1 rounded-full text-sm font-black bg-indigo-50 text-indigo-700 border border-indigo-100">
                         {{ member.points }} Poin
                       </span>
                       <span v-if="member.points >= 9" class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700 uppercase">
                         Bisa Redeem!
                       </span>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-2">
                       <button @click="openAdjustModal(member)" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition" title="Adjust Points">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                       </button>
                       <button v-if="member.points >= 9" @click="openRedeemModal(member)" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold transition shadow-sm" title="Redeem Free Menu">
                         🎁 Redeem
                       </button>
                       <button @click="openEditModal(member)" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-gray-100 rounded-lg transition">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                       </button>
                    </div>
                  </td>
                </tr>
                <tr v-if="filteredMembers.length === 0">
                  <td colspan="4" class="px-6 py-12 text-center text-gray-400 font-medium">
                    Tidak ada member ditemukan.
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>

    <!-- MODAL: ADD/EDIT MEMBER -->
    <div v-if="showMemberModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] flex items-center justify-center p-4">
      <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
           <h3 class="text-lg font-bold text-gray-800">{{ isEditing ? 'Edit Member' : 'Tambah Member Baru' }}</h3>
           <button @click="closeMemberModal" class="text-gray-400 hover:text-gray-600 transition text-2xl">×</button>
        </div>
        <form @submit.prevent="saveMember" class="p-6 space-y-4">
           <div>
             <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Lengkap</label>
             <input v-model="memberForm.name" type="text" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="Contoh: Ahmad Subardjo"/>
           </div>
           <div>
             <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nomor Handphone</label>
             <input v-model="memberForm.phone" type="tel" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="Contoh: 08123456789"/>
           </div>
           <div v-if="!isEditing">
             <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Poin Awal (Opsional)</label>
             <input v-model="memberForm.points" type="number" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="0"/>
           </div>
           <div class="pt-4 flex gap-3">
             <button type="button" @click="closeMemberModal" class="flex-1 px-4 py-2 bg-gray-100 text-gray-600 rounded-lg font-bold hover:bg-gray-200 transition">Batal</button>
             <button type="submit" :disabled="processing" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition disabled:opacity-50">
                {{ processing ? 'Menyimpan...' : 'Simpan Member' }}
             </button>
           </div>
        </form>
      </div>
    </div>

    <!-- MODAL: ADJUST POINTS -->
    <div v-if="showAdjustModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] flex items-center justify-center p-4">
      <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden transform transition-all">
        <div class="px-6 py-4 border-b border-gray-100">
           <h3 class="text-lg font-bold text-gray-800">Atur Poin: {{ currentMember?.name }}</h3>
        </div>
        <div class="p-6 space-y-6 text-center">
            <div class="flex items-center justify-center gap-6">
               <button @click="pointAction = -1" :class="pointAction === -1 ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-500'" class="w-12 h-12 rounded-full flex items-center justify-center text-2xl font-bold transition">
                 -
               </button>
               <div class="text-4xl font-black text-gray-800">{{ pointDelta }}</div>
               <button @click="pointAction = 1" :class="pointAction === 1 ? 'bg-indigo-500 text-white' : 'bg-gray-100 text-gray-500'" class="w-12 h-12 rounded-full flex items-center justify-center text-2xl font-bold transition">
                 +
               </button>
            </div>
            <div class="flex justify-center gap-3">
               <button @click="pointDelta = Math.max(1, pointDelta - 1)" class="px-3 py-1 bg-gray-50 rounded text-xs font-bold">- 1</button>
               <button @click="pointDelta = pointDelta + 1" class="px-3 py-1 bg-gray-50 rounded text-xs font-bold">+ 1</button>
               <button @click="pointDelta = pointDelta + 5" class="px-3 py-1 bg-gray-50 rounded text-xs font-bold">+ 5</button>
            </div>
            <p class="text-xs text-gray-400">Poin sekarang: {{ currentMember?.points }} → Akan menjadi: {{ (currentMember?.points || 0) + (pointAction * pointDelta) }}</p>
            <div class="pt-4 flex gap-3">
               <button @click="showAdjustModal = false" class="flex-1 px-4 py-2 bg-gray-100 text-gray-600 rounded-lg font-bold hover:bg-gray-200 transition">Batal</button>
               <button @click="updatePoints" :disabled="processing" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition disabled:opacity-50">
                  {{ processing ? '...' : 'Konfirmasi' }}
               </button>
            </div>
        </div>
      </div>
    </div>

    <!-- MODAL: REDEEM -->
    <div v-if="showRedeemModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] flex items-center justify-center p-4">
      <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden transform transition-all">
        <div class="p-6 text-center space-y-4">
           <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full mx-auto flex items-center justify-center text-3xl mb-2">🎁</div>
           <h3 class="text-xl font-black text-gray-900 leading-tight">Redeem Menu Gratis?</h3>
           <p class="text-sm text-gray-500">Member <b>{{ currentMember?.name }}</b> memiliki {{ currentMember?.points }} poin.</p>
           
           <div class="bg-gray-50 p-4 rounded-xl space-y-3">
              <label class="block text-xs font-bold text-gray-400 uppercase">Jumlah Menu Gratis</label>
              <div class="flex items-center justify-center gap-4">
                 <button @click="redeemCount = Math.max(1, redeemCount - 1)" class="w-10 h-10 bg-white border border-gray-200 rounded-lg shadow-sm font-bold text-gray-600">-</button>
                 <span class="text-2xl font-black text-gray-800">{{ redeemCount }}</span>
                 <button @click="redeemCount = Math.min(Math.floor(currentMember?.points / 9), redeemCount + 1)" class="w-10 h-10 bg-white border border-gray-200 rounded-lg shadow-sm font-bold text-gray-600">+</button>
              </div>
              <p class="text-xs font-bold text-indigo-600">Total Poin yang akan dipotong: {{ redeemCount * 9 }}</p>
           </div>

           <div class="pt-4 flex gap-3">
             <button @click="showRedeemModal = false" class="flex-1 px-4 py-2 bg-gray-100 text-gray-600 rounded-lg font-bold hover:bg-gray-200 transition text-sm">Batal</button>
             <button @click="confirmRedeem" :disabled="processing" class="flex-1 px-4 py-2 bg-emerald-600 text-white rounded-lg font-bold hover:bg-emerald-700 transition text-sm shadow-lg shadow-emerald-100 disabled:opacity-50">
                {{ processing ? '...' : 'Konfirmasi Redeem' }}
             </button>
           </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import AdminSidebar from "@/Layouts/AdminSidebar.vue";
import axios from 'axios';

const props = defineProps({
  members: Array
});

const isSidebarOpen = ref(false);
const searchQuery = ref('');
const localMembers = ref([...props.members]);
const processing = ref(false);

const filteredMembers = computed(() => {
  if (!searchQuery.value) return localMembers.value;
  const query = searchQuery.value.toLowerCase();
  return localMembers.value.filter(m => 
    m.name.toLowerCase().includes(query) || 
    m.phone.includes(query)
  );
});

// Member Modal State
const showMemberModal = ref(false);
const isEditing = ref(false);
const memberForm = ref({
  id: null,
  name: '',
  phone: '',
  points: 0
});

const openAddModal = () => {
  isEditing.value = false;
  memberForm.value = { name: '', phone: '', points: 0 };
  showMemberModal.value = true;
};

const openEditModal = (member) => {
  isEditing.value = true;
  memberForm.value = { ...member };
  showMemberModal.value = true;
};

const closeMemberModal = () => {
  showMemberModal.value = false;
  memberForm.value = { name: '', phone: '', points: 0 };
};

const saveMember = async () => {
  processing.value = true;
  try {
    if (isEditing.value) {
      const resp = await axios.put(`/admin/members/${memberForm.value.id}`, memberForm.value);
      const idx = localMembers.value.findIndex(m => m.id === memberForm.value.id);
      if (idx !== -1) localMembers.value[idx] = resp.data.member;
    } else {
      const resp = await axios.post('/admin/members', memberForm.value);
      localMembers.value.unshift(resp.data.member);
    }
    closeMemberModal();
  } catch (err) {
    alert(err.response?.data?.message || 'Gagal menyimpan member');
  } finally {
    processing.value = false;
  }
};

// Point Adjustment Modal
const showAdjustModal = ref(false);
const currentMember = ref(null);
const pointDelta = ref(1);
const pointAction = ref(1); // 1 for add, -1 for subtract

const openAdjustModal = (member) => {
  currentMember.value = member;
  pointDelta.value = 1;
  pointAction.value = 1;
  showAdjustModal.value = true;
};

const updatePoints = async () => {
  processing.value = true;
  const newPoints = currentMember.value.points + (pointAction.value * pointDelta.value);
  try {
    const resp = await axios.put(`/admin/members/${currentMember.value.id}`, { points: newPoints });
    const idx = localMembers.value.findIndex(m => m.id === currentMember.value.id);
    if (idx !== -1) localMembers.value[idx] = resp.data.member;
    showAdjustModal.value = false;
  } catch (err) {
    alert('Gagal update poin');
  } finally {
    processing.value = false;
  }
};

// Redeem Modal
const showRedeemModal = ref(false);
const redeemCount = ref(1);

const openRedeemModal = (member) => {
  currentMember.value = member;
  redeemCount.value = 1;
  showRedeemModal.value = true;
};

const confirmRedeem = async () => {
  processing.value = true;
  try {
    const resp = await axios.post(`/admin/members/${currentMember.value.id}/redeem`, { count: redeemCount.value });
    const idx = localMembers.value.findIndex(m => m.id === currentMember.value.id);
    if (idx !== -1) localMembers.value[idx] = resp.data.member;
    showRedeemModal.value = false;
    alert(`Berhasil redeem ${redeemCount.value} menu gratis!`);
  } catch (err) {
    alert(err.response?.data?.message || 'Gagal redeem poin');
  } finally {
    processing.value = false;
  }
};
</script>
