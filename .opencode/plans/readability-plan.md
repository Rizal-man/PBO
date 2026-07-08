# Readability Improvement Plan — BLOXSHOP

## Step 1: Hapus Kode Mati

### 1A: Hapus model `customers`
- File: `app/Models/customers.php` → **hapus**
- Model class: `customers` (lowercase, $guarded = [])
- Tidak dipakai di controller/resource mana pun

### 1B: Hapus migration `customers` table
- Migration: `create_customers_table.php` → **hapus** (atau biarkan saja karena sudah running, hapus filenya)

### 1C: Uninstall Spatie Permission
```bash
composer remove spatie/laravel-permission
```
- Hapus file: `config/permission.php`
- Migration `create_permission_tables.php` → **hapus** (file saja, sudah running di DB tapi tidak dipakai)
- Model `User.php`: hapus `use Spatie\Permission\Traits\HasRoles;` jika ada

---

## Step 2: Konsistensi Naming

### 2A: Rename model file `items.php` → `Items.php`
- Rename `app/Models/items.php` → `app/Models/Items.php`
- Di dalam file: ubah `class items` → `class Items`
- Update semua `use` statement:
  - `app/Providers/Filament/AdminPanelProvider.php` (mungkin tidak ada)
  - `app/Http/Controllers/ItemController.php`: `use App\Models\items;` → `use App\Models\Items;`
  - `app/Http/Controllers/CartController.php`: sudah `Items` (OK)
  - `app/Http/Controllers/CheckoutController.php`: sudah `Items` (OK)
  - `app/Filament/Widgets/StatsDashboard.php`: sudah `Items` (OK)
  - `app/Filament/Resources/Items/ItemsResource.php`: `use App\Models\Items;` (OK)
  - Cari semua `use App\Models\items;` via grep

### 2B: Seragamkan import Items
Grep semua file untuk `use App\Models\items;` (lowercase), ubah ke `use App\Models\Items;`

---

## Step 3: Eliminasi Duplikasi

### 3A: Toast JS — hapus inline di `cart.blade.php`
- `resources/views/cart.blade.php` lines ~169-208: hapus fungsi `showToast()` inline
- Fungsi `showToast()` sudah ada di `public/js/app.js` dan di-load di `layouts/app.blade.php`
- Pastikan `cart.blade.php` extends `layouts.app` atau minimal load `app.js`

### 3B: Ekstrak style auth views
- Buat `public/css/auth.css`
- Pindahkan style dari `resources/views/auth/login.blade.php` (body bg + radial gradient)
- Update semua 4 auth views untuk load `<link rel="stylesheet" href="{{ asset('css/auth.css') }}">`
- Hapus inline `<style>` dari ke-4 file

### 3C: Ubah `cart.blade.php` pakai layout
- Extend `layouts.app`
- Pindahkan navbar ke partial (reuse `partials/navbar.blade.php`)
- Hapus inline CSS, pindahkan ke `public/css/app.css` jika perlu
- Hapus inline JS `showToast()` (sudah di Step 3A)

---

## Step 4: Pisahkan JS Besar

### 4A: Split `public/js/app.js` menjadi beberapa file
- `public/js/toast.js` — `showToast()` function (baris 1-29)
- `public/js/modal.js` — login modal + history modal (baris 39-72, 110-132)
- `public/js/cart.js` — cart sidebar + AJAX + update badge (baris 74-324)
- `public/js/ui.js` — scroll, shop/founder toggle, admin double-click, filter tags (baris 134-350)

### 4B: Update `layouts/app.blade.php`
```html
<script src="{{ asset('js/toast.js') }}"></script>
<script src="{{ asset('js/modal.js') }}"></script>
<script src="{{ asset('js/cart.js') }}"></script>
<script src="{{ asset('js/ui.js') }}"></script>
```
- Hapus `<script src="{{ asset('js/app.js') }}">`

---

## Order Eksekusi

1. Step 1A + 1B + 1C (hapus kode mati)
2. Step 2A + 2B (rename & konsistensi)
3. Step 3A + 3B + 3C (dedup)
4. Step 4A + 4B (split JS)
5. Run `./vendor/bin/pint`
6. Test halaman public + admin
