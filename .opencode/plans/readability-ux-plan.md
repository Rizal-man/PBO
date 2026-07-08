# Readability & UX Improvement Plan

## Prioritas 1 — Fix Checkout Pages (pakai layout)

### Files:
- `resources/views/checkout.blade.php`
- `resources/views/checkout-cart.blade.php`

### Changes:
```blade
{{-- SEBELUM: standalone HTML dengan inline style --}}
<!DOCTYPE html>
<html>
<head>
    <style>body {...}</style>
</head>
<body>
    <nav>...</nav>
    <main>...</main>
    <script>showToast()...</script>
</body>
</html>

{{-- SESUDAH: extend layouts.app --}}
@extends('layouts.app')
@section('title', 'Checkout - Blox Shop')
@section('content')
    @include('partials.navbar')
    <main>...</main>
@endsection
@push('scripts')
    @if(session('error'))
        window.App.flash = { type: 'error', message: @json(session('error')) };
    @endif
@endpush
```

### Detail:
- Hapus `<!DOCTYPE html>` sampai `</html>` — ganti dengan `@extends('layouts.app')`
- Pindahkan konten ke `@section('content')`
- Pindahkan inline JS flash handler ke `@push('scripts')`
- Hapus inline `<style>` (body background sudah di `app.css`)
- Navbar bisa panggil `@include('partials.navbar')` atau tetap sederhana
- Hapus duplicate `showToast()` function — sudah di `toast.js`
- Tambah loading state di submit button (Prioritas 3 menyatu)

---

## Prioritas 2 — Fix Flash Message (XSS safe)

### Files:
- `resources/views/welcome.blade.php` (lines 22, 25)
- `resources/views/cart.blade.php` (lines 64, 67)

### Changes:
```blade
{{-- SEBELUM: --}}
window.App.flash = { type: 'error', message: '{{ session('error') }}' };

{{-- SESUDAH: --}}
window.App.flash = { type: 'error', message: @json(session('error')) };
```

---

## Prioritas 3 — Loading States

### Files:
- `resources/views/checkout.blade.php` — submit button
- `resources/views/checkout-cart.blade.php` — submit button
- `resources/views/auth/login.blade.php` — Sign In button
- `resources/views/auth/register.blade.php` — Register button
- `resources/views/auth/forgot-password.blade.php` — Verify Email button
- `resources/views/auth/reset-password.blade.php` — Reset Password button

### Changes:
Tambahkan di setiap tombol submit:
```blade
<button type="submit"
    onclick="this.disabled=true; this.innerHTML='Processing...'; this.form.submit()"
    ...>
```

Atau via CSS class untuk spinner:
```blade
<button type="submit"
    onclick="this.disabled=true; this.classList.add('opacity-60', 'cursor-not-allowed'); this.querySelector('.btn-text').textContent='Processing...'"
    ...>
    <span class="btn-text">Sign In</span>
</button>
```

---

## Prioritas 4 — Mobile Navbar (Hamburger Menu)

### File:
- `resources/views/partials/navbar.blade.php`
- `public/js/ui.js` (tambah event handler)

### Changes:
Tambahkan hamburger button untuk mobile:
```blade
{{-- Setelah logo --}}
<button id="navToggle" class="md:hidden p-2 text-gray-400 hover:text-white">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
</button>
```

Ubah class nav links:
```blade
{{-- SEBELUM: --}}
<div class="hidden md:flex gap-6 text-sm text-gray-400">

{{-- SESUDAH: --}}
<div id="navLinks" class="hidden md:flex gap-6 text-sm text-gray-400
    max-md:absolute max-md:top-full max-md:left-0 max-md:right-0
    max-md:flex-col max-md:bg-black/95 max-md:backdrop-blur-sm
    max-md:border-b max-md:border-white/5 max-md:p-6 max-md:gap-4">
```

Tambah di `ui.js`:
```js
const navToggle = document.getElementById('navToggle');
const navLinks = document.getElementById('navLinks');
if (navToggle && navLinks) {
    navToggle.addEventListener('click', () => {
        navLinks.classList.toggle('hidden');
        navLinks.classList.toggle('flex');
    });
}
```

---

## Prioritas 5 — Konsistensi & Readability

### 5a — Seragamkan warna harga
**Files:** `cart.blade.php:24`, `checkout.blade.php:39`
**Change:** `text-red-400` → `text-[#4da6ff]`

### 5b — Label stats lebih besar
**File:** `hero.blade.php:28,35,42`
**Change:** `text-xs text-gray-500` → `text-sm text-gray-400`

### 5c — Empty state product grid
**File:** `product-grid.blade.php`
**Change:** Tambah `@forelse ... @empty` dengan pesan "No products available"

### 5d — Fallback image
**File:** `product-grid.blade.php:5`
**Change:** Tambah `onerror="this.src='{{ asset('img/placeholder.png') }}'"` atau style fallback
**Alternatif:** Gunakan CSS `background-color` fallback jika image tidak ada

### 5e — Hapus dead file
**File:** `public/js/app.js` — hapus (351 baris, tidak dipakai)

---

## Order Eksekusi

1. Prioritas 2 (Flash message — 2 file, edit kecil, berdampak besar)
2. Prioritas 1 (Checkout layout — 2 file refactor besar)
3. Prioritas 3 (Loading states — 6 file, edit kecil seragam)
4. Prioritas 5e (Hapus app.js — 1 file)
5. Prioritas 4 (Mobile navbar — 2 file)
6. Prioritas 5a-5d (Konsistensi — 3 file)
7. Run `./vendor/bin/pint`
8. Test halaman
