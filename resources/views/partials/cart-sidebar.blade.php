<div id="cartSidebar" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" id="cartBackdrop"></div>
    <div class="absolute right-0 top-0 h-full w-full max-w-md bg-[#0a0f18] border-l border-white/10 shadow-2xl flex flex-col">
        <div class="flex items-center justify-between px-6 py-4 border-b border-white/10">
            <h2 class="text-lg font-bold text-white">Shopping Cart</h2>
            <button id="cartClose" class="p-1 text-gray-500 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div id="cartItems" class="flex-1 overflow-y-auto px-6 py-4 space-y-4">
            @auth
                @forelse ($cart as $id => $item)
                    <div class="cart-item flex gap-3 bg-white/5 rounded-lg p-3 border border-white/5" data-id="{{ $id }}">
                        <img src="{{ Storage::url($item['images']) }}" alt="{{ $item['nama_item'] }}"
                            class="w-16 h-16 object-cover rounded-md flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-semibold text-white truncate">{{ $item['nama_item'] }}</h4>
                            <div class="flex items-center gap-2 mt-2">
                                <button class="qty-btn dec w-7 h-7 flex items-center justify-center rounded border border-white/10 text-gray-400 hover:text-white hover:border-gray-500 transition-colors text-sm disabled:cursor-not-allowed">-</button>
                                <span class="qty-text text-sm text-white font-medium w-6 text-center">{{ $item['quantity'] }}</span>
                                <button class="qty-btn inc w-7 h-7 flex items-center justify-center rounded border border-white/10 text-gray-400 hover:text-white hover:border-gray-500 transition-colors text-sm disabled:cursor-not-allowed">+</button>
                            </div>
                            <p class="item-subtotal text-sm text-[#4da6ff] font-bold mt-2">Rp {{ number_format($item['harga_item'] * $item['quantity'], 0, ',', '.') }}</p>
                        </div>
                        <button class="remove-btn flex-shrink-0 self-start p-1 text-gray-500 hover:text-red-400 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                @empty
                    <div id="cartEmpty" class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        <p class="text-gray-500 text-sm">Your cart is empty</p>
                    </div>
                @endforelse
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m0 0v2m0-2h2m-2 0H10m9.364-7.364A9 9 0 1112 3a9 9 0 017.364 4.636z"/>
                    </svg>
                    <p class="text-gray-500 text-sm">Login to view your cart</p>
                    <a href="{{ route('login') }}" class="mt-4 inline-block px-5 py-2 bg-gradient-to-r from-[#4da6ff] to-blue-500 text-black font-semibold rounded-lg text-sm hover:scale-[1.02] transition-transform shadow-[0_0_12px_rgba(77,166,255,0.25)]">
                        Login Now
                    </a>
                </div>
            @endauth
        </div>

        @auth
            @if (count($cart) > 0)
                @php
                    $cartTotal = array_sum(array_map(fn($cartItem) => $cartItem['harga_item'] * $cartItem['quantity'], $cart));
                @endphp
                <div id="cartFooter" class="px-6 py-4 border-t border-white/10">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-gray-400 text-sm">Total</span>
                        <span id="cartTotal" class="text-white font-bold text-lg">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('checkout.cart') }}"
                        class="block w-full text-center py-2.5 bg-gradient-to-r from-[#4da6ff] to-blue-500 text-black font-semibold rounded-lg text-sm hover:scale-[1.02] transition-transform shadow-[0_0_12px_rgba(77,166,255,0.25)]">
                        Checkout
                    </a>
                </div>
            @endif
        @endauth
    </div>
</div>
