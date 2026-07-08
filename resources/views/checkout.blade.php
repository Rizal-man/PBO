@extends('layouts.app')

@section('title', 'Checkout - Blox Shop')

@section('content')
    <nav class="w-full flex justify-between items-center px-8 py-5 bg-black/40 backdrop-blur-sm border-b border-white/5">
        <div class="flex items-center gap-2">
            <svg class="w-6 h-6 text-cyan-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4.5l6.5 13h-13L12 6.5z"/></svg>
            <span class="text-xl font-bold tracking-wide">BLOXSHOP</span>
        </div>
        <a href="/cart" class="text-sm text-gray-400 hover:text-white transition-colors">Back to Cart</a>
    </nav>

    <main class="flex-1 w-full max-w-2xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-8">Checkout</h1>

        @if ($errors->any())
            <div class="bg-red-900/50 border border-red-700 text-red-300 px-4 py-3 rounded mb-6">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-white/5 border border-white/10 rounded-lg p-6 mb-8">
            <h3 class="font-semibold text-lg mb-2">{{ $item->nama_item }}</h3>
            <p class="text-gray-400 text-sm mb-1">Stock: {{ $item->jumlah_item }}</p>
            <p class="text-[#4da6ff] font-bold text-xl">Rp {{ number_format($item->harga_item, 0, ',', '.') }}</p>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">

            <div>
                <label for="customer_name" class="block text-sm font-medium text-gray-400 mb-1">Name</label>
                <input type="text" name="customer_name" id="customer_name" value="{{ auth()->user()->name }}" readonly required
                    class="w-full px-4 py-2 bg-black/40 border border-gray-700 rounded-md text-white opacity-70 cursor-not-allowed">
            </div>

            <div>
                <label for="customer_email" class="block text-sm font-medium text-gray-400 mb-1">Email</label>
                <input type="email" name="customer_email" id="customer_email" value="{{ auth()->user()->email }}" readonly required
                    class="w-full px-4 py-2 bg-black/40 border border-gray-700 rounded-md text-white opacity-70 cursor-not-allowed">
            </div>

            <div>
                <label for="username_roblox" class="block text-sm font-medium text-gray-400 mb-1">Roblox Username</label>
                <input type="text" name="username_roblox" id="username_roblox" required placeholder="Enter your Roblox username"
                    class="w-full px-4 py-2 bg-black/40 border border-gray-700 rounded-md text-white focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-400 mb-1">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $item->jumlah_item }}"
                    class="w-full px-4 py-2 bg-black/40 border border-gray-700 rounded-md text-white focus:border-cyan-400 focus:outline-none">
            </div>

            <button type="submit" id="submitBtn"
                onclick="this.disabled=true; this.textContent='Processing...'; this.classList.add('opacity-60','cursor-not-allowed'); this.form.submit()"
                class="w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-400 text-black font-semibold rounded-md hover:scale-[1.02] transition-transform">
                Place Order
            </button>
        </form>
    </main>
@endsection

@push('scripts')
    @if(session('error'))
        window.App.flash = { type: 'error', message: @json(session('error')) };
    @endif
    @if(session('success'))
        window.App.flash = { type: 'success', message: @json(session('success')) };
    @endif
@endpush
