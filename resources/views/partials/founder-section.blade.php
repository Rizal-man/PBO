<div id="founderSection" class="hidden w-full max-w-5xl mx-auto px-4 mt-32 mb-20">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($founders as $f)
            <div class="group bg-white/5 border border-white/10 rounded-xl p-8 text-center backdrop-blur-sm hover:border-[#4da6ff]/50 hover:shadow-[0_0_25px_rgba(77,166,255,0.15)] transition-all duration-300">
                <img src="{{ $f['photo'] }}" alt="{{ $f['name'] }}"
                    class="w-28 h-28 object-cover rounded-full mx-auto mb-5 border-2 border-[#4da6ff]/30 group-hover:border-[#4da6ff]/60 group-hover:scale-105 transition-all duration-300">
                <h3 class="text-xl font-bold text-white mb-3">{{ $f['name'] }}</h3>
                <p class="text-sm text-gray-400 italic leading-relaxed">"{{ $f['quote'] }}"</p>
            </div>
        @endforeach
    </div>
</div>
