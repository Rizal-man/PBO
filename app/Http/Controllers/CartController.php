<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($id)
    {
        $item = Items::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $newQty = $cart[$id]['quantity'] + 1;
            if ($newQty > $item->jumlah_item) {
                if (request()->expectsJson()) {
                    return response()->json(['error' => 'Insufficient stock! Available: '.$item->jumlah_item], 422);
                }

                return redirect()->back()->with('error', 'Insufficient stock! Available: '.$item->jumlah_item);
            }
            $cart[$id]['quantity'] = $newQty;
        } else {
            if ($item->jumlah_item < 1) {
                if (request()->expectsJson()) {
                    return response()->json(['error' => 'Insufficient stock!'], 422);
                }

                return redirect()->back()->with('error', 'Insufficient stock!');
            }
            $cart[$id] = [
                'nama_item' => $item->nama_item,
                'harga_item' => $item->harga_item,
                'images' => $item->images,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        if (request()->expectsJson()) {
            $count = array_sum(array_column(session()->get('cart', []), 'quantity'));

            return response()->json([
                'message' => 'Item added to cart!',
                'count' => $count,
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function index()
    {
        $cart = session()->get('cart', []);

        return view('cart', compact('cart'));
    }

    public function updateQuantity(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (! isset($cart[$id])) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        $action = $request->input('action');

        if ($action === 'increase') {
            $item = Items::find($id);
            $newQty = $cart[$id]['quantity'] + 1;
            if (! $item || $newQty > $item->jumlah_item) {
                return response()->json([
                    'error' => 'Insufficient stock! Available: '.($item->jumlah_item ?? 0),
                    'cart' => $cart,
                ], 422);
            }
            $cart[$id]['quantity'] = $newQty;
        } elseif ($action === 'decrease') {
            $cart[$id]['quantity']--;
            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
                session()->put('cart', $cart);

                $total = array_sum(array_map(fn ($item) => $item['harga_item'] * $item['quantity'], $cart));

                return response()->json([
                    'removed' => true,
                    'cart' => $cart,
                    'total' => $total,
                    'count' => array_sum(array_column($cart, 'quantity')),
                ]);
            }
        }

        session()->put('cart', $cart);

        $total = array_sum(array_map(fn ($item) => $item['harga_item'] * $item['quantity'], $cart));

        return response()->json([
            'removed' => false,
            'cart' => $cart,
            'total' => $total,
            'subtotal' => $cart[$id]['harga_item'] * $cart[$id]['quantity'],
            'quantity' => $cart[$id]['quantity'],
            'count' => array_sum(array_column($cart, 'quantity')),
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        if (request()->expectsJson()) {
            $total = array_sum(array_map(fn ($item) => $item['harga_item'] * $item['quantity'], $cart));

            return response()->json([
                'cart' => $cart,
                'total' => $total,
                'count' => array_sum(array_column($cart, 'quantity')),
            ]);
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }
}
