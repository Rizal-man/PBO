<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blox Shop')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script>
        window.App = {
            isAuth: {{ auth()->check() ? 'true' : 'false' }},
            csrf: '{{ csrf_token() }}',
            urls: {
                cart: '{{ url('/cart') }}',
                login: '{{ route('login') }}',
                checkoutCart: '{{ route('checkout.cart') }}',
            },
        };
    </script>
</head>
<body class="text-white font-sans min-h-screen flex flex-col items-center">

    <div id="toastContainer" class="toast-container"></div>

    @yield('content')

    <script src="{{ asset('js/toast.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/ui.js') }}"></script>
    @stack('scripts')
</body>
</html>
