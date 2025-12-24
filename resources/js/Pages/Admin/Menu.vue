<template>
  <div class="flex h-screen bg-gray-100 font-sans overflow-hidden">
    <!-- SIDEBAR -->
    <AdminSidebar :isOpen="isSidebarOpen" @close="isSidebarOpen = false" />
 
    <!-- CONTENT -->
    <main class="flex-1 min-w-0 overflow-y-auto">
      <!-- TOP BAR -->
      <header class="bg-white border-b border-slate-200 px-4 md:px-8 py-4 sticky top-0 z-30 flex justify-between items-center mb-6 md:mb-8">
        <div class="flex items-center gap-4">
          <!-- HAMBURGER -->
          <button 
            @click="isSidebarOpen = true"
            class="lg:hidden p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
          </button>

          <div>
            <h1 class="text-xl md:text-3xl font-bold text-gray-800">{{ currentTitle }}</h1>
            <p class="text-xs md:text-sm text-gray-500 hidden sm:block">Selamat datang di {{ currentTitle }}</p>
          </div>
        </div>
      </header>

      <div class="px-4 md:px-8 pb-8">

      <!-- FOODS SECTION -->
      <div v-if="tab === 'foods'">
        <button
          @click="openFoodsForm"
          class="px-5 py-2 mb-6 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition duration-150 shadow-md"
        >
          + Tambah Menu Foods
        </button>

        <!-- Form Tambah/Edit Foods -->
        <div v-if="foodsForm" class="bg-white p-6 rounded-xl shadow-xl mb-8 border border-emerald-200">
          <h3 class="text-xl font-bold mb-4 text-emerald-600">{{ editingFoodId ? 'Edit Menu Foods' : 'Form Tambah Menu Foods' }}</h3>
          <form @submit.prevent="submitFoods">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Pilih Subcategory</label>
                <select
                  v-model="foods.subcategory_id"
                  class="w-full border border-gray-300 p-3 rounded-lg focus:ring-emerald-500 focus:border-emerald-500"
                  required
                >
                  <option value="">-- Pilih Subcategory --</option>
                  <option v-for="sub in foodsSubcategories" :key="sub.id" :value="sub.id">
                    {{ sub.name }}
                  </option>
                </select>
              </div>

              <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Nama Menu</label>
                <input
                  v-model="foods.name"
                  type="text"
                  class="w-full border border-gray-300 p-3 rounded-lg focus:ring-emerald-500 focus:border-emerald-500"
                  required
                />
              </div>

              <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Harga (Rupiah)</label>
                <input
                  v-model.number="foods.price"
                  type="number"
                  class="w-full border border-gray-300 p-3 rounded-lg focus:ring-emerald-500 focus:border-emerald-500"
                  required
                  min="0"
                />
              </div>

              <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Gambar (Optional)</label>
                <input
                  type="file"
                  accept="image/*"
                  @change="handleFoodsImage"
                  class="w-full border border-gray-300 p-3 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100"
                />
                <p v-if="foods.image && typeof foods.image === 'object'" class="text-sm text-gray-600 mt-1">
                  File selected: {{ foods.image.name }}
                </p>
              </div>
            </div>

            <div class="mb-6">
              <label class="block font-semibold mb-1 text-gray-700">Deskripsi</label>
              <textarea
                v-model="foods.description"
                class="w-full border border-gray-300 p-3 rounded-lg focus:ring-emerald-500 focus:border-emerald-500"
                rows="3"
              ></textarea>
            </div>

            <div class="flex gap-3">
              <button
                type="submit"
                :disabled="loading"
                class="px-6 py-3 bg-emerald-600 text-white font-bold rounded-lg hover:bg-emerald-700 disabled:bg-gray-400 transition shadow-md"
              >
                {{ loading ? "Menyimpan..." : editingFoodId ? "Update Foods" : "Simpan Foods" }}
              </button>
              <button
                type="button"
                @click="closeFoodsForm"
                class="px-6 py-3 bg-gray-400 text-white font-bold rounded-lg hover:bg-gray-500 transition shadow-md"
              >
                Batal
              </button>
            </div>
          </form>
        </div>

        <!-- List Foods -->
        <div>
          <h2 class="text-2xl font-bold mb-6 text-gray-800">Daftar Makanan ({{ foodsMenus.length }})</h2>
          <div v-if="foodsMenus.length === 0" class="text-gray-500 p-6 bg-white rounded-xl shadow-md text-center">
            <p>Tidak ada data makanan yang tersedia saat ini.</p>
          </div>
          <div v-else class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div
              v-for="food in foodsMenus"
              :key="food.id"
              class="bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 overflow-hidden border border-gray-200 relative group"
            >
              <!-- Image Container -->
              <div class="w-full h-40 bg-emerald-100 flex items-center justify-center overflow-hidden">
                <img
                    v-if="food.image"
                    :src="`/storage/${food.image}`"
                    alt="Food Image"
                    class="w-full h-full object-cover"
                    />
                    <img
                    v-else
                    src="https://placehold.co/200x160/10b981/ffffff?text=FOOD"
                    alt="No Image"
                    class="w-full h-full object-cover"
                />
              </div>

              <!-- Content -->
              <div class="p-4">
                <h3 class="font-bold text-lg text-gray-800 line-clamp-2">{{ food.name }}</h3>
                <p class="text-emerald-600 font-bold text-xl mt-2">Rp {{ food.price.toLocaleString('id-ID') }}</p>
                <p class="text-sm text-gray-600 mt-3 line-clamp-3">{{ food.description || 'Tidak ada deskripsi.' }}</p>
              </div>

              <!-- Action Buttons -->
              <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button
                  @click="editFood(food)"
                  class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow-lg"
                  title="Edit"
                >
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                  </svg>
                </button>
                <button
                  @click="deleteFood(food.id)"
                  class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition shadow-lg"
                  title="Hapus"
                >
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- DRINKS SECTION -->
      <div v-if="tab === 'drinks'">
        <button
          @click="openDrinksForm"
          class="px-5 py-2 mb-6 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-150 shadow-md"
        >
          + Tambah Menu Drinks
        </button>

        <!-- Form Tambah/Edit Drinks -->
        <div v-if="drinksForm" class="bg-white p-6 rounded-xl shadow-xl mb-8 border border-blue-200">
          <h3 class="text-xl font-bold mb-4 text-blue-600">{{ editingDrinkId ? 'Edit Menu Drinks' : 'Form Tambah Menu Drinks' }}</h3>
          <form @submit.prevent="submitDrinks">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Pilih Subcategory</label>
                <select
                  v-model="drinks.subcategory_id"
                  class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                  required
                >
                  <option value="">-- Pilih Subcategory --</option>
                  <option v-for="sub in drinksSubcategories" :key="sub.id" :value="sub.id">
                    {{ sub.name }}
                  </option>
                </select>
              </div>

              <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Nama Menu</label>
                <input
                  v-model="drinks.name"
                  type="text"
                  class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                  required
                />
              </div>

              <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Harga (Rupiah)</label>
                <input
                  v-model.number="drinks.price"
                  type="number"
                  class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                  required
                  min="0"
                />
              </div>

              <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Gambar (Optional)</label>
                <input
                  type="file"
                  accept="image/*"
                  @change="handleDrinksImage"
                  class="w-full border border-gray-300 p-3 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                />
                <p v-if="drinks.image && typeof drinks.image === 'object'" class="text-sm text-gray-600 mt-1">
                  File selected: {{ drinks.image.name }}
                </p>
              </div>
            </div>

            <div class="mb-6">
              <label class="block font-semibold mb-1 text-gray-700">Deskripsi</label>
              <textarea
                v-model="drinks.description"
                class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                rows="3"
              ></textarea>
            </div>

            <div class="flex gap-3">
              <button
                type="submit"
                :disabled="loading"
                class="px-6 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 disabled:bg-gray-400 transition shadow-md"
              >
                {{ loading ? "Menyimpan..." : editingDrinkId ? "Update Drinks" : "Simpan Drinks" }}
              </button>
              <button
                type="button"
                @click="closeDrinksForm"
                class="px-6 py-3 bg-gray-400 text-white font-bold rounded-lg hover:bg-gray-500 transition shadow-md"
              >
                Batal
              </button>
            </div>
          </form>
        </div>

        <!-- List Drinks -->
        <div>
          <h2 class="text-2xl font-bold mb-6 text-gray-800">Daftar Minuman ({{ drinksMenus.length }})</h2>
          <div v-if="drinksMenus.length === 0" class="text-gray-500 p-6 bg-white rounded-xl shadow-md text-center">
            <p>Tidak ada data minuman yang tersedia saat ini.</p>
          </div>
          <div v-else class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div
              v-for="drink in drinksMenus"
              :key="drink.id"
              class="bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 overflow-hidden border border-gray-200 relative group"
            >
              <!-- Image Container -->
              <div class="w-full h-40 bg-blue-100 flex items-center justify-center overflow-hidden">
               <img
                    v-if="drink.image"
                    :src="`/storage/${drink.image}`"
                    alt="Drink Image"
                    class="w-full h-full object-cover"
                    />
                    <img
                    v-else
                    src="https://placehold.co/200x160/3b82f6/ffffff?text=DRINK"
                    alt="No Image"
                    class="w-full h-full object-cover"
                />
              </div>

              <!-- Content -->
              <div class="p-4">
                <h3 class="font-bold text-lg text-gray-800 line-clamp-2">{{ drink.name }}</h3>
                <p class="text-blue-600 font-bold text-xl mt-2">Rp {{ drink.price.toLocaleString('id-ID') }}</p>
                <p class="text-sm text-gray-600 mt-3 line-clamp-3">{{ drink.description || 'Tidak ada deskripsi.' }}</p>
              </div>

              <!-- Action Buttons -->
              <div class="absolute top-2 right-2 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button
                  @click="editDrink(drink)"
                  class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow-lg"
                  title="Edit"
                >
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                  </svg>
                </button>
                <button
                  @click="deleteDrink(drink.id)"
                  class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition shadow-lg"
                  title="Hapus"
                >
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </main>

    <!-- POPUP NOTIFIKASI -->
    <div
      v-if="showPopup"
      :class="[
        'fixed bottom-6 right-6 px-5 py-3 rounded-xl shadow-2xl z-50 transition-transform duration-300 transform ease-out',
        popupType === 'success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white',
      ]"
      style="min-width: 250px;"
    >
      {{ popup }}
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router, Link, usePage } from '@inertiajs/vue3'
import AdminSidebar from "@/Layouts/AdminSidebar.vue";

const isSidebarOpen = ref(false);

const props = defineProps({
  foodsMenus: {
    type: Array,
    default: () => [],
  },
  drinksMenus: {
    type: Array,
    default: () => [],
  },
  tab: {
    type: String,
    default: 'foods'
  },
  foodsSubcategories: {
    type: Array,
    default: () => []
  },
  drinksSubcategories: {
    type: Array,
    default: () => []
  }
})

const page = usePage()
const tab = ref(props.tab || 'foods')
const menuOpen = ref(true)
const loading = ref(false)

// Popup notification
const showPopup = ref(false)
const popup = ref('')
const popupType = ref('success')

const currentTitle = computed(() => {
  if (tab.value === 'foods') return 'Kelola Menu - Foods'
  if (tab.value === 'drinks') return 'Kelola Menu - Drinks'
  return 'Kelola Menu'
})

function notify(msg, type = 'success') {
  popup.value = msg
  popupType.value = type
  showPopup.value = true
  setTimeout(() => (showPopup.value = false), 3000)
}

/* FOODS */
const foodsForm = ref(false)
const editingFoodId = ref(null)
const foods = ref({
  name: '',
  price: null,
  description: '',
  subcategory_id: '',
  image: null,
})

function openFoodsForm() {
  editingFoodId.value = null
  foods.value = { name: '', price: null, description: '', subcategory_id: '', image: null }
  foodsForm.value = true
}

function closeFoodsForm() {
  foodsForm.value = false
  editingFoodId.value = null
  foods.value = { name: '', price: null, description: '', subcategory_id: '', image: null }
}

function editFood(food) {
  editingFoodId.value = food.id
  foods.value = {
    name: food.name,
    price: food.price,
    description: food.description,
    subcategory_id: food.subcategory_id,
    image: null,
  }
  foodsForm.value = true
}

function handleFoodsImage(e) {
  const file = e.target.files ? e.target.files[0] : null
  if (file) {
    // Validasi ukuran file (10MB = 10240KB = 10485760 bytes)
    if (file.size > 10485760) {
      notify('❌ Gambar terlalu besar! Silakan kompres terlebih dahulu. Maksimal 10MB', 'error')
      e.target.value = '' // reset input
      foods.value.image = null
      return
    }
    foods.value.image = file
  } else {
    foods.value.image = null
  }
}

function submitFoods() {
  if (!foods.value.name) {
    notify('Nama menu tidak boleh kosong!', 'error')
    return
  }
  if (!foods.value.price || foods.value.price < 0) {
    notify('Harga tidak valid!', 'error')
    return
  }
  if (!foods.value.subcategory_id) {
    notify('Pilih subcategory terlebih dahulu!', 'error')
    return
  }

  loading.value = true
  const data = new FormData()
  data.append('name', foods.value.name)
  data.append('category_id', 1)
  data.append('subcategory_id', foods.value.subcategory_id)
  data.append('price', foods.value.price)
  data.append('description', foods.value.description || '')
  if (foods.value.image) data.append('image', foods.value.image)

  // Gunakan POST + _method=PUT saat edit
  let endpoint = '/admin/menu/store'
  if (editingFoodId.value) {
    endpoint = `/admin/menu/${editingFoodId.value}`
    data.append('_method', 'PUT')
  }

  console.log('🔥 Submitting to:', endpoint)
  console.log('🔥 Editing Food ID:', editingFoodId.value)
  console.log('🔥 FormData:', {
    name: foods.value.name,
    category_id: 1,
    subcategory_id: foods.value.subcategory_id,
    price: foods.value.price,
    description: foods.value.description,
    has_image: !!foods.value.image
  })

  router.post(endpoint, data, {
    onSuccess: () => {
      loading.value = false
      notify(
        editingFoodId.value
          ? '✅ Menu Foods berhasil diperbarui!'
          : '✅ Menu Foods berhasil ditambahkan!',
        'success'
      )
      closeFoodsForm()
      router.reload({ only: ['foodsMenus'] })
    },
    onError: (errors) => {
      loading.value = false
      console.error('❌ Errors:', errors)
      
      // Tampilkan error detail dari backend jika ada
      let errorMsg = editingFoodId.value
        ? '❌ Gagal memperbarui Foods!'
        : '❌ Gagal menambahkan Foods!'
      
      // Cek jika ada validation errors
      if (errors && typeof errors === 'object') {
        const firstError = Object.values(errors)[0]
        if (firstError && firstError.length > 0) {
          errorMsg += ' ' + firstError[0]
        }
      }
      
      notify(errorMsg, 'error')
    },
  })
}


function deleteFood(foodId) {
  if (confirm('Yakin ingin menghapus menu ini?')) {
    router.delete(`/admin/menu/${foodId}`, {
      onSuccess: () => {
        notify('✅ Menu Foods berhasil dihapus!', 'success')
        router.reload({ only: ['foodsMenus'] })
      },
      onError: () => {
        notify('❌ Gagal menghapus Foods!', 'error')
      }
    })
  }
}

/* DRINKS */
const drinksForm = ref(false)
const editingDrinkId = ref(null)
const drinks = ref({
  name: '',
  price: null,
  description: '',
  subcategory_id: '',
  image: null,
})

function openDrinksForm() {
  editingDrinkId.value = null
  drinks.value = { name: '', price: null, description: '', subcategory_id: '', image: null }
  drinksForm.value = true
}

function closeDrinksForm() {
  drinksForm.value = false
  editingDrinkId.value = null
  drinks.value = { name: '', price: null, description: '', subcategory_id: '', image: null }
}

function editDrink(drink) {
  editingDrinkId.value = drink.id
  drinks.value = {
    name: drink.name,
    price: drink.price,
    description: drink.description,
    subcategory_id: drink.subcategory_id,
    image: null,
  }
  drinksForm.value = true
}

function handleDrinksImage(e) {
  const file = e.target.files ? e.target.files[0] : null
  if (file) {
    // Validasi ukuran file (10MB = 10240KB = 10485760 bytes)
    if (file.size > 10485760) {
      notify('❌ Gambar terlalu besar! Silakan kompres terlebih dahulu. Maksimal 10MB', 'error')
      e.target.value = '' // reset input
      drinks.value.image = null
      return
    }
    drinks.value.image = file
  } else {
    drinks.value.image = null
  }
}

function submitDrinks() {
if (!drinks.value.name) {
notify('Nama menu tidak boleh kosong!', 'error')
return
}
if (!drinks.value.price || drinks.value.price < 0) {
notify('Harga tidak valid!', 'error')
return
}
if (!drinks.value.subcategory_id) {
notify('Pilih subcategory terlebih dahulu!', 'error')
return
}

loading.value = true
const data = new FormData()
data.append('name', drinks.value.name)
data.append('category_id', 2)
data.append('subcategory_id', drinks.value.subcategory_id)
data.append('price', drinks.value.price)
data.append('description', drinks.value.description || '')
if (drinks.value.image) data.append('image', drinks.value.image)

// Gunakan POST + _method=PUT jika edit
let endpoint = '/admin/menu/store'
if (editingDrinkId.value) {
endpoint = `/admin/menu/${editingDrinkId.value}`
data.append('_method', 'PUT')
}

console.log('🔥 Submitting Drinks to:', endpoint)
console.log('🔥 Editing Drink ID:', editingDrinkId.value)

router.post(endpoint, data, {
onSuccess: () => {
loading.value = false
notify(
editingDrinkId.value
? '✅ Menu Drinks berhasil diperbarui!'
: '✅ Menu Drinks berhasil ditambahkan!',
'success'
)
closeDrinksForm()
router.reload({ only: ['drinksMenus'] })
},
onError: (errors) => {
loading.value = false
console.error('❌ Errors:', errors)

// Tampilkan error detail dari backend jika ada
let errorMsg = editingDrinkId.value
  ? '❌ Gagal memperbarui Drinks!'
  : '❌ Gagal menambahkan Drinks!'

// Cek jika ada validation errors
if (errors && typeof errors === 'object') {
  const firstError = Object.values(errors)[0]
  if (firstError && firstError.length > 0) {
    errorMsg += ' ' + firstError[0]
  }
}

notify(errorMsg, 'error')
},
})
}


function deleteDrink(drinkId) {
  if (confirm('Yakin ingin menghapus menu ini?')) {
    router.delete(`/admin/menu/${drinkId}`, {
      onSuccess: () => {
        notify('✅ Menu Drinks berhasil dihapus!', 'success')
        router.reload({ only: ['drinksMenus'] })
      },
      onError: () => {
        notify('❌ Gagal menghapus Drinks!', 'error')
      }
    })
  }
}

function logout() {
  router.post('/logout')
}
</script>