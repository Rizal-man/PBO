@extends('layouts.app')

@section('title', 'Shopping Cart - Blox Shop')

@section('content')
    <nav class="w-full flex justify-between items-center px-8 py-5 bg-black/40 backdrop-blur-sm border-b border-white/5">
        <div class="flex items-center gap-2">
            <svg class="w-6 h-6 text-cyan-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4.5l6.5 13h-13L12 6.5z"/></svg>
            <span class="text-xl font-bold tracking-wide">BLOXSHOP</span>
        </div>
        <a href="/" class="text-sm text-gray-400 hover:text-white transition-colors">Back to Shop</a>
    </nav>

    <main class="flex-1 w-full max-w-4xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-8">Shopping Cart</h1>

        @if(count($cart) > 0)
            <div class="space-y-4">
                @foreach($cart as $id => $item)
                    <div class="bg-white/5 border border-white/10 rounded-lg p-4 flex items-center gap-4">
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg">{{ $item['nama_item'] }}</h3>
                            <p class="text-gray-400 text-sm">Qty: {{ $item['quantity'] }}</p>
                            <p class="text-[#4da6ff] font-bold">Rp {{ number_format($item['harga_item'] * $item['quantity'], 0, ',', '.') }}</p>
                        </div>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-2 bg-red-600/20 border border-red-700 text-red-400 rounded hover:bg-red-600/40 transition-colors text-sm">
                                Remove
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 text-right">
                @php
                    $total = array_sum(array_map(fn($item) => $item['harga_item'] * $item['quantity'], $cart));
                @endphp
                <p class="text-xl font-bold mb-4">Total: <span class="text-cyan-400">Rp {{ number_format($total, 0, ',', '.') }}</span></p>
                <div class="flex gap-3 justify-end">
                    <a href="/" class="inline-block px-6 py-3 bg-gray-700 text-white font-semibold rounded-md hover:bg-gray-600 transition-colors">
                        Continue Shopping
                    </a>
                    <a href="{{ route('checkout.cart') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-400 text-black font-semibold rounded-md hover:scale-105 transition-transform">
                        Checkout
                    </a>
                </div>
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-gray-400 text-lg mb-4">Your cart is empty</p>
                <a href="/" class="inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-400 text-black font-semibold rounded-md hover:scale-105 transition-transform">
                    Start Shopping
                </a>
            </div>
        @endif
    </main>
@endsection

@push('scripts')
    @if(session('success'))
        window.App.flash = { type: 'success', message: @json(session('success')) };
    @endif
    @if(session('error'))
        window.App.flash = { type: 'error', message: @json(session('error')) };
    @endif
@endpush
