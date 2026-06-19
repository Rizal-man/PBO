<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    use HasFactory;

    // Daftarkan kolom database Anda di sini (misal: nama, harga, deskripsi)
    protected $fillable = [
        'nama_item',
        'jumlah_item',
        'harga_item',
        'kode_item',
        'images',
    ];
}
