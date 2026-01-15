<script setup>
defineProps({
  foodCategory: Object,
  drinkCategory: Object,
  selectedFoodSubcategory: [Number, String],
  selectedDrinkSubcategory: [Number, String],
  foodMenus: Array,
  drinkMenus: Array,
  selectedFoodMenu: Object,
  selectedDrinkMenu: Object,
  selectedFoodImage: String,
  selectedDrinkImage: String,
  formatPrice: Function
})

defineEmits(['selectFoodSubcategory', 'selectDrinkSubcategory', 'selectFoodMenu', 'selectDrinkMenu'])
</script>

<template>
  <section id="menu" class="w-full bg-black border-b-[8px] border-black">
    <!-- MOBILE ONLY: SUBCATEGORY TABS -->
    <div class="md:hidden bg-[#5ac8fa] px-4 py-4 overflow-x-auto no-scrollbar">
      <div class="flex gap-4 min-w-max">
        <button 
          v-for="cat in foodCategory.subcategories"
          :key="cat.id"
          @click="$emit('selectFoodSubcategory', cat.id)"
          :class="[
            'px-4 py-2 font-black text-sm uppercase border-2 border-black transition-all',
            selectedFoodSubcategory === cat.id 
              ? 'bg-[#99f6c4] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]' 
              : 'bg-transparent text-gray-800'
          ]"
        >
          {{ cat.name }}
        </button>
      </div>
    </div>

    <!-- MAIN GRID: QUADRANTS ON DESKTOP, SIDE-BY-SIDE ON MOBILE -->
    <div class="grid grid-cols-2 md:grid-cols-2 w-full overflow-hidden">
      
      <!-- [QUAD 1] FOOD IMAGE (MOB: Left Col / DSK: Top-Left) -->
      <div class="relative w-full h-[260px] md:aspect-auto md:h-[540px] bg-[#78ccf9] overflow-hidden border-black">
        <img 
          :src="selectedFoodImage" 
          class="w-full h-full object-cover" 
          :style="{ 
            objectPosition: selectedFoodMenu?.image_position || 'center',
            transform: `scale(${selectedFoodMenu?.image_zoom || 1})`
          }"
          alt="Food"
        >
        
        <!-- DESKTOP PRICE OVERLAY -->
        <div class="hidden md:flex absolute bottom-6 left-6 right-6 items-stretch shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] border-2 border-black overflow-hidden">
          <div class="bg-[#0e3d2e] px-4 py-3 flex items-center justify-center border-r-2 border-black">
            <span class="text-xl md:text-2xl font-black text-white">
              {{ selectedFoodMenu ? formatPrice(selectedFoodMenu.price) : '24K' }}
            </span>
          </div>
          <div class="flex-1 bg-white px-4 py-3 flex items-center">
            <span class="text-sm md:text-base font-medium text-gray-800 leading-tight">
              {{ selectedFoodMenu?.description || 'Crispy fish fillet with sauce and fresh veggies on a soft bun.' }}
            </span>
          </div>
        </div>

        <!-- MOBILE PRICE & DESC (Reference Image style) -->
        <div class="md:hidden flex items-stretch border-t-2 border-black absolute bottom-0 w-full bg-white h-16">
          <div class="flex-1 p-2 flex items-center overflow-hidden text-left">
            <p class="text-[8px] font-bold text-gray-800 line-clamp-3 leading-tight uppercase">
              {{ selectedFoodMenu?.description || 'Crispy fish fillet with sauce and fresh veggies on a soft bun.' }}
            </p>
          </div>
          <div class="bg-[#0e3d2e] w-[45px] flex items-center justify-center border-l-2 border-black">
            <span class="text-xs font-black text-white">
              {{ selectedFoodMenu ? formatPrice(selectedFoodMenu.price) : '24K' }}
            </span>
          </div>
        </div>
      </div>

      <!-- [QUAD 2] FOOD LIST (MOB: Right Col / DSK: Top-Right) -->
      <div class="bg-white md:bg-[#78ccf9] p-4 md:p-12 flex flex-col h-[260px] md:h-[540px] border-black">
        <!-- DESKTOP ONLY: SUBCATEGORY TABS -->
        <div class="hidden md:flex flex-wrap gap-4 mb-8">
          <button 
            v-for="cat in foodCategory.subcategories"
            :key="cat.id"
            @click="$emit('selectFoodSubcategory', cat.id)"
            :class="[
              'px-6 py-2 font-black text-sm uppercase border-2 border-black',
              selectedFoodSubcategory === cat.id 
                ? 'bg-[#99f6c4] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] -translate-x-1 -translate-y-1' 
                : 'bg-transparent hover:bg-[#99f6c4]/50'
            ]"
          >
            {{ cat.name }}
          </button>
        </div>
        
        <div class="flex-1 overflow-y-auto pr-2 h-full overscroll-y-contain">
          <div class="flex flex-col md:grid md:grid-cols-2 md:gap-x-10">
            <div 
              v-for="menu in foodMenus"
              :key="menu.id"
              @click="$emit('selectFoodMenu', menu)"
              :class="[
                'group py-3 md:py-4 border-b border-dashed border-black/10 md:border-black/30 cursor-pointer flex flex-col',
                selectedFoodMenu?.id === menu.id ? 'opacity-100' : 'opacity-60 md:opacity-80 hover:opacity-100'
              ]"
            >
              <span 
                :class="[
                  'text-[10px] md:text-base uppercase tracking-tight',
                  selectedFoodMenu?.id === menu.id ? 'font-black md:font-semibold text-[#014133] md:text-black' : 'font-bold md:font-normal text-gray-400 md:text-gray-900'
                ]"
              >
                {{ menu.name }}
              </span>
              <div v-if="selectedFoodMenu?.id === menu.id" class="hidden md:block w-full h-0.5 bg-black mt-1"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- MOBILE ONLY: DRINK SUBCATEGORIES -->
      <div class="md:hidden col-span-2 bg-[#99f6c4] px-4 py-4 overflow-x-auto no-scrollbar">
        <div class="flex gap-4 min-w-max">
          <button
            v-for="sub in drinkCategory.subcategories"
            :key="sub.id"
            @click="$emit('selectDrinkSubcategory', sub.id)"
            :class="[
              'px-4 py-2 font-black text-sm uppercase border-2 border-black transition-all',
              selectedDrinkSubcategory === sub.id 
                ? 'bg-[#5ac8fa] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]' 
                : 'bg-transparent text-gray-800'
            ]"
          >
            {{ sub.name }}
          </button>
        </div>
      </div>

      <!-- [QUAD 3] DRINK LIST (MOB: Left Col / DSK: Bottom-Left) -->
      <div class="bg-white md:bg-[#99f6c4] p-4 md:p-12 flex flex-col h-[260px] md:h-[540px] order-last md:order-none">
        <!-- DESKTOP ONLY: SUBCATEGORY TABS -->
        <div class="hidden md:flex flex-wrap gap-4 mb-8">
          <button
            v-for="sub in drinkCategory.subcategories"
            :key="sub.id"
            @click="$emit('selectDrinkSubcategory', sub.id)"
            :class="[
              'px-6 py-2 font-black text-sm uppercase border-2 border-black',
              selectedDrinkSubcategory === sub.id 
                ? 'bg-[#78ccf9] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] -translate-x-1 -translate-y-1' 
                : 'bg-transparent hover:bg-[#78ccf9]/50'
            ]"
          >
            {{ sub.name }}
          </button>
        </div>

        <div class="flex-1 overflow-y-auto pr-2 h-full overscroll-y-contain">
          <div class="flex flex-col md:grid md:grid-cols-2 md:gap-x-10">
            <div 
              v-for="menu in drinkMenus"
              :key="menu.id"
              @click="$emit('selectDrinkMenu', menu)"
              :class="[
                'group py-3 md:py-4 border-b border-dashed border-black/10 md:border-black/30 cursor-pointer flex flex-col',
                selectedDrinkMenu?.id === menu.id ? 'opacity-100' : 'opacity-60 md:opacity-80 hover:opacity-100'
              ]"
            >
              <span 
                :class="[
                  'text-[10px] md:text-base uppercase tracking-tight',
                  selectedDrinkMenu?.id === menu.id ? 'font-black md:font-semibold text-[#014133] md:text-black' : 'font-bold md:font-normal text-gray-400 md:text-gray-900'
                ]"
              >
                {{ menu.name }}
              </span>
              <div v-if="selectedDrinkMenu?.id === menu.id" class="hidden md:block w-full h-0.5 bg-black mt-1"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- [QUAD 4] DRINK IMAGE (MOB: Right Col / DSK: Bottom-Right) -->
      <div class="relative w-full h-[260px] md:aspect-auto md:h-[540px] bg-[#99f6c4] overflow-hidden">
        <img 
          :src="selectedDrinkImage" 
          class="w-full h-full object-cover" 
          :style="{ 
            objectPosition: selectedDrinkMenu?.image_position || 'center',
            transform: `scale(${selectedDrinkMenu?.image_zoom || 1})`
          }"
          alt="Drink"
        >
        


        <!-- DESKTOP PRICE OVERLAY -->
        <div class="hidden md:flex absolute bottom-6 left-6 right-6 items-stretch shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] border-2 border-black overflow-hidden">
          <div class="bg-[#0e3d2e] px-4 py-3 flex items-center justify-center border-r-2 border-black">
            <span class="text-xl md:text-2xl font-black text-white">
              {{ selectedDrinkMenu ? formatPrice(selectedDrinkMenu.price) : '24K' }}
            </span>
          </div>
          <div class="flex-1 bg-white px-4 py-3 flex items-center">
            <span class="text-sm md:text-base font-medium text-gray-800 leading-tight">
              {{ selectedDrinkMenu?.description || 'Refreshing signature northern series.' }}
            </span>
          </div>
        </div>

        <!-- MOBILE PRICE & DESC -->
        <div class="md:hidden flex items-stretch border-t-2 border-black absolute bottom-0 w-full bg-white h-16">
          <div class="flex-1 p-2 flex items-center overflow-hidden text-left">
            <p class="text-[8px] font-bold text-gray-800 line-clamp-3 leading-tight uppercase">
              {{ selectedDrinkMenu?.description || 'Refreshing signature northern series.' }}
            </p>
          </div>
          <div class="bg-[#0e3d2e] w-[45px] flex items-center justify-center border-l-2 border-black">
            <span class="text-xs font-black text-white">
              {{ selectedDrinkMenu ? formatPrice(selectedDrinkMenu.price) : '24K' }}
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- DELIVERY CALL TO ACTION -->
    <div class="bg-black py-12 px-6 text-center">
        <h3 class="text-white text-lg md:text-xl font-medium mb-8">
            Ngopi atau makan, bisa dari rumah. Yuk pesan sekarang!
        </h3>
        <div class="flex flex-wrap justify-center gap-6">
            <a href="#" class="bg-white p-1 shadow-[4px_4px_0px_0px_rgba(255,0,0,1)] border-2 border-black transition-transform hover:-translate-y-1">
                <img :src="`${$page.props.asset_url}gofood-logo.png`" alt="GoFood" class="h-10 md:h-12 px-4 py-2 object-contain">
            </a>
            <a href="#" class="bg-white p-1 shadow-[4px_4px_0px_0px_rgba(0,200,0,1)] border-2 border-black transition-transform hover:-translate-y-1">
                <img :src="`${$page.props.asset_url}grabfood-logo.png`" alt="GrabFood" class="h-10 md:h-12 px-4 py-2 object-contain">
            </a>
            <a href="#" class="bg-white p-1 shadow-[4px_4px_0px_0px_rgba(255,100,0,1)] border-2 border-black transition-transform hover:-translate-y-1">
                <img :src="`${$page.props.asset_url}shopeefood-logo.png`" alt="ShopeeFood" class="h-10 md:h-12 px-4 py-2 object-contain">
            </a>
        </div>
    </div>
  </section>
</template>

<style scoped>
/* Custom scrollbar for menu list if needed */
.overflow-y-auto {
  scrollbar-width: thin;
  scrollbar-color: rgba(0, 0, 0, 0.5) transparent;
}
.overflow-y-auto::-webkit-scrollbar {
  width: 6px;
}
.overflow-y-auto::-webkit-scrollbar-track {
  background: transparent;
}
.overflow-y-auto::-webkit-scrollbar-thumb {
  background: black;
  border-radius: 3px;
}
/* Hide scrollbar for Chrome, Safari and Opera */
.no-scrollbar::-webkit-scrollbar {
  display: none;
}
/* Hide scrollbar for IE, Edge and Firefox */
.no-scrollbar {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
</style>
