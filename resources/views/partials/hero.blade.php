<main class="flex flex-col items-center justify-center flex-1 w-full max-w-5xl px-4 mt-20">

    <h1 class="text-6xl md:text-8xl font-bold text-[#4da6ff] mb-4 drop-shadow-[0_0_25px_rgba(77,166,255,0.6)]">
        BLOX SHOP
    </h1>

    <p class="text-lg md:text-xl text-gray-400 mb-10">
        Enjoy <span class="text-[#4da6ff] font-medium">Shopping</span> digital products from BLOX SHOP.
    </p>

    <div class="flex gap-4 mb-20">
        <button id="viewProductsBtn" class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-400 text-black font-semibold rounded-md shadow-[0_0_20px_rgba(59,130,246,0.6)] hover:scale-105 transition-transform">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"/></svg>
            VIEW PRODUCTS
        </button>
        <button class="flex items-center gap-2 px-6 py-3 border border-gray-700 bg-black/30 rounded-md hover:bg-gray-800 transition-colors">
            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <a href="https://wa.me">Support</a>
        </button>
    </div>

    <div id="statsSection" class="grid grid-cols-1 md:grid-cols-3 gap-1 w-full max-w-4xl bg-white/5 border border-white/10 rounded-lg overflow-hidden p-1">
        <div class="flex flex-col items-center justify-center p-8 bg-[#0a0f18] rounded-md border border-transparent hover:border-white/10 transition-colors">
            <div class="w-10 h-10 rounded-full bg-blue-900/30 flex items-center justify-center mb-3 text-blue-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h2 class="text-3xl font-bold text-white mb-1">{{ number_format($customersCount) }}+</h2>
            <p class="text-xs text-gray-500 uppercase tracking-widest">Customers</p>
        </div>
        <div class="flex flex-col items-center justify-center p-8 bg-[#0a0f18] rounded-md border border-transparent hover:border-white/10 transition-colors">
            <div class="w-10 h-10 rounded-full bg-blue-900/30 flex items-center justify-center mb-3 text-blue-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <h2 class="text-3xl font-bold text-white mb-1">{{ number_format($ordersCount) }}+</h2>
            <p class="text-xs text-gray-500 uppercase tracking-widest">Orders</p>
        </div>
        <div class="flex flex-col items-center justify-center p-8 bg-[#0a0f18] rounded-md border border-transparent hover:border-white/10 transition-colors">
            <div class="w-10 h-10 rounded-full bg-blue-900/30 flex items-center justify-center mb-3 text-blue-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <h2 class="text-3xl font-bold text-white mb-1">{{ number_format($itemsCount) }}+</h2>
            <p class="text-xs text-gray-500 uppercase tracking-widest">Items</p>
        </div>
    </div>

    <div id="filterTags" class="flex flex-wrap justify-center gap-3 mt-20 mb-5">
        <button data-filter="all" class="filter-btn px-5 py-2 text-sm text-[#4da6ff] border border-[#4da6ff] rounded shadow-[0_0_10px_rgba(77,166,255,0.2)] bg-transparent">Any</button>
        @foreach ($categories as $category)
            <button data-filter="{{ $category->slug }}"
                class="filter-btn px-5 py-2 text-sm text-gray-400 border border-gray-800 rounded hover:border-gray-600 transition-colors">
                {{ $category->name }}
            </button>
        @endforeach
    </div>

</main>
