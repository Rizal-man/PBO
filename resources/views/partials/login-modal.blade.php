<div id="loginModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" id="modalBackdrop"></div>
    <div class="relative bg-[#0a0f18] border border-white/10 rounded-xl p-8 max-w-sm w-full mx-4 shadow-2xl">
        <div class="text-center">
            <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-[#4da6ff]/10 flex items-center justify-center">
                <svg class="w-7 h-7 text-[#4da6ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m9.364-7.364A9 9 0 1112 3a9 9 0 017.364 4.636z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">Login Required</h3>
            <p class="text-sm text-gray-400 mb-6">You must login first before making a purchase.</p>
            <a href="{{ route('login') }}"
                class="block w-full py-2.5 bg-gradient-to-r from-[#4da6ff] to-blue-500 text-black font-semibold rounded-lg text-sm hover:scale-[1.02] transition-transform shadow-[0_0_12px_rgba(77,166,255,0.25)]">
                Login Now
            </a>
            <button id="modalCancel"
                class="mt-3 text-sm text-gray-500 hover:text-gray-300 transition-colors">
                Cancel
            </button>
        </div>
    </div>
</div>
