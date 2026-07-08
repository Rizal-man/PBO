<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Items;
use App\Models\Transaction;
use App\Models\User;

class ItemController extends Controller
{
    public function index()
    {
        $all_items = Items::with('category')->get();
        $categories = Category::all();
        $cart = session()->get('cart', []);

        $transactions = collect();
        if (auth()->check()) {
            $transactions = Transaction::with('items')
                ->where('customer_email', auth()->user()->email)
                ->latest()
                ->get();
        }

        $customersCount = User::count();
        $ordersCount = Transaction::count();
        $itemsCount = Items::count();

        $founders = [
            [
                'name' => 'Muhammad Rizal Mahdi',
                'quote' => 'Kode adalah puisi yang ditulis untuk mesin, dibaca oleh manusia.',
                'photo' => 'https://ui-avatars.com/api/?name=Muhammad+Rizal+Mahdi&background=4da6ff&color=fff&size=128',
            ],
            [
                'name' => 'Sabian Al Ghazali',
                'quote' => 'Setiap bug adalah pelajaran berharga dalam perjalanan menjadi developer.',
                'photo' => 'https://ui-avatars.com/api/?name=Sabian+Al+Ghazali&background=7c3aed&color=fff&size=128',
            ],
            [
                'name' => 'Miko Kahlaa Maulana',
                'quote' => 'Teknologi terbaik adalah yang membawa manfaat bagi sesama.',
                'photo' => 'https://ui-avatars.com/api/?name=Miko+Kahlaa+Maulana&background=059669&color=fff&size=128',
            ],
            [
                'name' => 'Ridho Rabani Adi Musya',
                'quote' => 'Bekerja keras dalam diam, biarkan kesuksesan yang berbicara.',
                'photo' => 'https://ui-avatars.com/api/?name=Dewi+Lestari&background=dc2626&color=fff&size=128',
            ],
            [
                'name' => 'Benhil',
                'quote' => 'Dari ide kecil lahir inovasi besar yang mengubah dunia.',
                'photo' => 'https://ui-avatars.com/api/?name=Rizky+Pratama&background=f59e0b&color=fff&size=128',
            ],
        ];

        return view('welcome', [
            'items' => $all_items,
            'categories' => $categories,
            'cart' => $cart,
            'transactions' => $transactions,
            'customersCount' => $customersCount,
            'ordersCount' => $ordersCount,
            'itemsCount' => $itemsCount,
            'founders' => $founders,
        ]);
    }
}
