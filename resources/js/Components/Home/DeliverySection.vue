<template>
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
</template>
