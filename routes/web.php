<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;


Route::get('/', function () {
    return view('welcome');
});

// Ketika halaman utama diakses, jalankan fungsi index di ItemController
Route::get('/', [ItemController::class, 'index']);