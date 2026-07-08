# Role Separation Plan — Customer vs Admin

## Skenario Akhir

```
Login via /login:
  Admin     → redirect /admin
  Customer  → redirect /

Navbar:
  Guest     → Shop | Login | Register
  Customer  → Shop | My Orders | Cart | Logout
  Admin     → Shop | Admin Panel | Cart | Logout

Checkout: hanya user login (customer) bisa checkout
Customer page: /orders — lihat riwayat transaksi sendiri
Dead route /admin/dashboard: dihapus
```

---

## Step 1: Login Redirect Berdasarkan Role

**File:** `app/Http/Controllers/Auth/LoginController.php` — line 26

```php
// Sebelum:
return redirect()->intended('/');

// Sesudah:
$redirect = auth()->user()->role === 'admin' ? '/admin' : '/';
return redirect()->intended($redirect);
```

---

## Step 2: Navbar — Link Admin Panel untuk Admin

**File:** `resources/views/partials/navbar.blade.php`

Tambahkan setelah link Shop:
```blade
@auth
    @if(auth()->user()->role === 'admin')
        <a href="/admin" class="...">Admin Panel</a>
    @endif
@endauth
```

Tambahkan link "My Orders" untuk customer login:
```blade
@auth
    <a href="/orders" class="...">My Orders</a>
@endauth
```

Sembunyikan tombol Login untuk user yang sudah login, tampilkan Logout + nama.

---

## Step 3: Halaman Orders (Customer)

### 3a. Buat Controller

**File (baru):** `app/Http/Controllers/OrderController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $transactions = Transaction::with('items')
            ->where('customer_email', Auth::user()->email)
            ->latest()
            ->get();

        return view('orders', compact('transactions'));
    }
}
```

### 3b. Buat View

**File (baru):** `resources/views/orders.blade.php`

Extend `layouts.app`, tampilkan tabel transaksi dengan status, items, total.

### 3c. Route

**File:** `routes/web.php`

```php
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth');
```

---

## Step 4: Checkout — Wajib Login

**File:** `routes/web.php`

Ubah route checkout:
```php
Route::middleware('auth')->group(function () {
    Route::get('/checkout/cart', [CheckoutController::class, 'cartCheckout']);
    Route::post('/checkout/cart', [CheckoutController::class, 'processCart']);
    Route::get('/checkout/{id}', [CheckoutController::class, 'show']);
    Route::post('/checkout', [CheckoutController::class, 'process']);
});
```

---

## Step 5: Hapus Dead Route

**File:** `routes/web.php`

Hapus:
```php
Route::get('/admin/dashboard', function () {
    return view('/admin');
});
```

---

## Step 6: Update Navbar

**File:** `resources/views/partials/navbar.blade.php`

Struktur akhir navbar:

| Role | Tampilan |
|---|---|
| Guest | `[Logo] Shop | Login | Register` |
| Customer | `[Logo] Shop | My Orders | [Cart] {Nama} Logout` |
| Admin | `[Logo] Shop | My Orders | Admin Panel | [Cart] {Nama} Logout` |

---

## Testing

1. Login sebagai customer → redirect ke `/`, lihat "My Orders" di navbar
2. Login sebagai admin → redirect ke `/admin`, lihat "Admin Panel" di navbar
3. Guest coba akses `/checkout/{id}` → redirect ke `/login`
4. Guest coba akses `/orders` → redirect ke `/login`
5. Customer akses `/orders` → lihat riwayat transaksi (email = email user)
