<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blox Shop</title>
    <!-- Mengimpor Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menambahkan background pattern titik-titik (stars) tipis */
        body {
            background-color: #030712;
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
        }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }
        .card { background: black; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .price { color: #e74c3c; font-weight: bold; }
    </style>
</head>
<body class="text-white font-sans min-h-screen flex flex-col items-center">

    <!-- Navbar -->
    <nav class="w-full flex justify-between items-center px-8 py-5 bg-black/40 backdrop-blur-sm border-b border-white/5">
        <!-- Logo -->
        <div class="flex items-center gap-2">
            <svg class="w-6 h-6 text-cyan-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4.5l6.5 13h-13L12 6.5z"/></svg>
            <span class="text-xl font-bold tracking-wide">BLOXSHOP</span>
        </div>
        
        <!-- Links -->
        <div class="hidden md:flex gap-6 text-sm text-gray-400">
            <a href="#" class="hover:text-white transition-colors">Shop</a>
            <a href="#" class="hover:text-white transition-colors">Status</a>
            <a href="#" class="hover:text-white transition-colors">Robux</a>
        </div>

        <!-- Right Menu -->
        <div class="flex items-center gap-4">
            <button class="p-2 border border-gray-700 rounded-md hover:border-gray-500 transition-colors">
                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"/></svg>
            </button>
            <button class="px-5 py-2 text-sm font-medium border border-gray-700 rounded-md hover:bg-white/5 transition-colors">
                <a href="/admin">LOGIN</a>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex flex-col items-center justify-center flex-1 w-full max-w-5xl px-4 mt-20">
        
        <!-- Judul Neon -->
        <h1 class="text-6xl md:text-8xl font-bold text-[#4da6ff] mb-4 drop-shadow-[0_0_25px_rgba(77,166,255,0.6)]">
            BLOX SHOP
        </h1>
        
        <!-- Subtitle -->
        <p class="text-lg md:text-xl text-gray-400 mb-10">
            Enjoy <span class="text-[#4da6ff] font-medium">Shopping</span> digital products from BLOX SHOP.
        </p>

        <!-- Call to Action Buttons -->
        <div class="flex gap-4 mb-20">
            <button class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-400 text-black font-semibold rounded-md shadow-[0_0_20px_rgba(59,130,246,0.6)] hover:scale-105 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"/></svg>
                VIEW PRODUCTS
            </button>
            <button class="flex items-center gap-2 px-6 py-3 border border-gray-700 bg-black/30 rounded-md hover:bg-gray-800 transition-colors">
                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Support
            </button>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-1 w-full max-w-4xl bg-white/5 border border-white/10 rounded-lg overflow-hidden p-1">
            <!-- Stat Card 1 -->
            <div class="flex flex-col items-center justify-center p-8 bg-[#0a0f18] rounded-md border border-transparent hover:border-white/10 transition-colors">
                <div class="w-10 h-10 rounded-full bg-blue-900/30 flex items-center justify-center mb-3 text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h2 class="text-3xl font-bold text-white mb-1">19,492+</h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest">Customers</p>
            </div>
            <!-- Stat Card 2 -->
            <div class="flex flex-col items-center justify-center p-8 bg-[#0a0f18] rounded-md border border-transparent hover:border-white/10 transition-colors">
                <div class="w-10 h-10 rounded-full bg-blue-900/30 flex items-center justify-center mb-3 text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <h2 class="text-3xl font-bold text-white mb-1">39,451+</h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest">Orders</p>
            </div>
            <!-- Stat Card 3 -->
            <div class="flex flex-col items-center justify-center p-8 bg-[#0a0f18] rounded-md border border-transparent hover:border-white/10 transition-colors">
                <div class="w-10 h-10 rounded-full bg-blue-900/30 flex items-center justify-center mb-3 text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                </div>
                <h2 class="text-3xl font-bold text-white mb-1">1,439+</h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest">Vouches</p>
            </div>
        </div>

        <!-- Filter Tags (Bagian Bawah) -->
        <div class="flex flex-wrap justify-center gap-3 mt-20 mb-5">
            <button class="px-5 py-2 text-sm text-[#4da6ff] border border-[#4da6ff] rounded shadow-[0_0_10px_rgba(77,166,255,0.2)] bg-transparent">Any</button>
            <button class="px-5 py-2 text-sm text-gray-400 border border-gray-800 rounded hover:border-gray-600 transition-colors">Fish It</button>
            <button class="px-5 py-2 text-sm text-gray-400 border border-gray-800 rounded hover:border-gray-600 transition-colors">Blox Fruit</button>
            <button class="px-5 py-2 text-sm text-gray-400 border border-gray-800 rounded hover:border-gray-600 transition-colors">Sailor Piece</button>
            <button class="px-5 py-2 text-sm text-gray-400 border border-gray-800 rounded hover:border-gray-600 transition-colors">Grow A Garden</button>
        </div>

    </main>

    <!-- Floating Action Button (Cart) -->
    <div class="fixed bottom-8 right-8">
        <button class="relative bg-[#00ffff] text-black p-4 rounded-full shadow-[0_0_15px_rgba(0,255,255,0.5)] hover:scale-110 transition-transform">
            <!-- Badge -->
            <span class="absolute -top-1 -left-1 bg-red-600 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">1</span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"/></svg>
        </button>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full max-w-5xl px-4 mt-5">
        @foreach ($items as $item)
            <div class="card">
                <img src="{{ Storage::url($item->images) }}" alt="{{ $item->nama_item }}" class="w-full h-40 object-cover rounded-md mb-3">
                <h3 class="text-xl font-bold text-white mb-2 text-center">{{ $item->nama_item }}</h3>
                <p>Stock : {{ $item->jumlah_item }}</p>
                <p class="price"><span class="font-bold text-white">Price :</span> Rp {{ number_format($item->harga_item, 0, ',', '.') }}</p>
                <div class="flex flex-row gap-2 mt-3">
                    <button class="mt-3 w-full px-4 py-2 bg-[#4da6ff] text-black font-semibold rounded-md hover:bg-[#3399ff] transition-colors">
                        <a href="/cart/{{ $item->id }}">Add to Cart</a>
                    </button>
                    <button class="mt-3 w-full px-4 py-2 bg-[#4da6ff] text-black font-semibold rounded-md hover:bg-[#3399ff] transition-colors">
                        <a href="/checkout/{{ $item->id }}">Buy Now</a>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <footer class="w-full text-center py-6 mt-20 border-t border-white/10 text-sm text-white bg-black/40 backdrop-blur-sm">
        &copy; {{ date('Y') }} Blox Shop. Create By Kelompok 5. All rights reserved.
    </footer>

</body>
</html>