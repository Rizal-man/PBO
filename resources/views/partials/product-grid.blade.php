<div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-5xl px-4 mt-5">
    @forelse ($items as $item)
        <div class="group relative bg-white/5 border border-white/10 rounded-xl overflow-hidden backdrop-blur-sm transition-all duration-300 hover:scale-[1.03] hover:border-[#4da6ff]/50 hover:shadow-[0_0_25px_rgba(77,166,255,0.15)]" data-category="{{ $item->category?->slug ?? '' }}">
            <div class="relative overflow-hidden">
                <img src="{{ Storage::url($item->images) }}" alt="{{ $item->nama_item }}"
                    onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22200%22><rect fill=%22%231a1a2e%22 width=%22400%22 height=%22200%22/><text fill=%22%234da6ff%22 font-size=%2216%22 x=%2250%%22 y=%2250%%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22>No Image</text></svg>'"
                    class="w-full h-44 object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all duration-300"></div>
                @if ($item->category)
                    <span class="absolute top-2 left-2 px-2.5 py-1 text-xs font-semibold bg-black/60 backdrop-blur-sm text-[#4da6ff] border border-[#4da6ff]/30 rounded-md">
                        {{ $item->category->name }}
                    </span>
                @endif
            </div>

            <div class="p-4">
                <h3 class="text-lg font-bold text-white mb-2 truncate">{{ $item->nama_item }}</h3>

                <div class="flex items-center justify-between text-sm mb-3">
                    <span class="text-gray-500">Stock: <span class="text-gray-300 font-medium">{{ $item->jumlah_item }}</span></span>
                    <span class="text-[#4da6ff] font-bold text-base">Rp {{ number_format($item->harga_item, 0, ',', '.') }}</span>
                </div>

                <div class="flex items-center gap-2">
                    @if ($item->jumlah_item > 0)
                        <button type="button" data-id="{{ $item->id }}"
                            class="add-cart-btn login-required flex items-center justify-center w-10 h-10 rounded-lg border border-white/10 bg-white/5 text-gray-300 hover:bg-[#4da6ff] hover:text-black hover:border-[#4da6ff] transition-all duration-200 group/cart">
                            <svg class="w-5 h-5 cart-icon transition-transform duration-200 group-hover/cart:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"/>
                            </svg>
                        </button>
                        <a href="{{ route('checkout.show', $item->id) }}"
                            class="login-required flex-1 text-center px-4 py-2 bg-gradient-to-r from-[#4da6ff] to-blue-500 text-black font-semibold rounded-lg text-sm hover:scale-[1.02] transition-transform shadow-[0_0_12px_rgba(77,166,255,0.25)]">
                            Buy Now
                        </a>
                    @else
                        <span class="flex items-center justify-center w-10 h-10 rounded-lg border border-red-900/30 bg-red-950/30 text-red-500 cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"/>
                            </svg>
                        </span>
                        <span class="flex-1 text-center px-4 py-2 bg-red-900/40 border border-red-700/40 text-red-400 font-semibold rounded-lg text-sm cursor-not-allowed">
                            SOLD OUT
                        </span>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-20 text-gray-500">
            <p class="text-lg">No products available</p>
        </div>
    @endforelse
</div>
<div id="emptyFilterState" class="hidden text-center py-20 text-gray-500 w-full max-w-5xl px-4 mt-5">
    <p class="text-lg">No items match this category</p>
</div>
