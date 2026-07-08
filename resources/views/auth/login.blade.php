<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blox Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="text-white font-sans min-h-screen flex flex-col items-center justify-center">
    <div class="w-full max-w-md px-4">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-[#4da6ff] drop-shadow-[0_0_15px_rgba(77,166,255,0.4)]">BLOXSHOP</h1>
            <p class="text-gray-400 mt-2">Sign in to your account</p>
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

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-400 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2.5 bg-black/40 border border-gray-700 rounded-md text-white focus:border-[#4da6ff] focus:outline-none focus:ring-1 focus:ring-[#4da6ff] transition-colors">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-400 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2.5 bg-black/40 border border-gray-700 rounded-md text-white focus:border-[#4da6ff] focus:outline-none focus:ring-1 focus:ring-[#4da6ff] transition-colors">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-400">
                        <input type="checkbox" name="remember" class="bg-black/40 border-gray-700 rounded">
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-[#4da6ff] hover:text-[#3399ff] transition-colors">
                        Forgot password?
                    </a>
                </div>

                <button type="submit"
                    onclick="this.disabled=true; this.textContent='Processing...'; this.classList.add('opacity-60','cursor-not-allowed'); this.form.submit()"
                    class="w-full py-2.5 bg-gradient-to-r from-[#4da6ff] to-blue-500 text-black font-semibold rounded-md hover:scale-[1.02] transition-transform shadow-[0_0_15px_rgba(77,166,255,0.3)]">
                    Sign In
                </button>
            </form>

            <p class="text-center text-gray-400 text-sm mt-6">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-[#4da6ff] hover:text-[#3399ff] transition-colors">Register</a>
            </p>
        </div>

        <p class="text-center mt-6">
            <a href="/" class="text-sm text-gray-500 hover:text-gray-300 transition-colors">Back to Shop</a>
        </p>
    </div>
</body>
</html>
