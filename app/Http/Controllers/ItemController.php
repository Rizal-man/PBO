<?php

namespace App\Http\Controllers;

use App\Models\items;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        // 2. Ambil semua data dari tabel items
        $all_items = Items::all(); 

        // Jika ingin membatasi atau mengurutkan data terbaru, bisa pakai:
        // $all_items = Item::latest()->get();

        // 3. Kirim data ke file blade bernama 'welcome.blade.php' dengan nama variabel 'items'
        return view('welcome', ['items' => $all_items]);
    }
}
