<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Blox Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="text-white font-sans min-h-screen flex flex-col items-center justify-center">
    <div class="w-full max-w-md px-4">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-[#4da6ff] drop-shadow-[0_0_15px_rgba(77,166,255,0.4)]">BLOXSHOP</h1>
            <p class="text-gray-400 mt-2">Reset your password</p>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-lg p-8 backdrop-blur-sm">
            @if (session('status'))
                <div class="bg-green-900/50 border border-green-700 text-green-300 px-4 py-3 rounded mb-6">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-900/50 border border-red-700 text-red-300 px-4 py-3 rounded mb-6">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <p class="text-gray-400 text-sm mb-6">
                Enter your email address to reset your password.
            </p>

            <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-400 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2.5 bg-black/40 border border-gray-700 rounded-md text-white focus:border-[#4da6ff] focus:outline-none focus:ring-1 focus:ring-[#4da6ff] transition-colors">
                </div>

                <button type="submit"
                    onclick="this.disabled=true; this.textContent='Processing...'; this.classList.add('opacity-60','cursor-not-allowed'); this.form.submit()"
                    class="w-full py-2.5 bg-gradient-to-r from-[#4da6ff] to-blue-500 text-black font-semibold rounded-md hover:scale-[1.02] transition-transform shadow-[0_0_15px_rgba(77,166,255,0.3)]">
                    Verify Email
                </button>
            </form>

            <p class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-sm text-[#4da6ff] hover:text-[#3399ff] transition-colors">Back to login</a>
            </p>
        </div>
    </div>
</body>
</html>
