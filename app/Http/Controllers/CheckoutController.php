<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show($id)
    {
        $item = Items::findOrFail($id);

        return view('checkout', compact('item'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'username_roblox' => 'required|string|max:255',
        ]);

        $item = Items::findOrFail($validated['item_id']);

        if ($item->jumlah_item < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Insufficient stock!']);
        }

        DB::transaction(function () use ($item, $validated) {
            $subtotal = $item->harga_item * $validated['quantity'];

            $transaction = Transaction::create([
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'username_roblox' => $validated['username_roblox'],
                'total_amount' => $subtotal,
                'status' => 'completed',
            ]);

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'item_id' => $item->id,
                'nama_item' => $item->nama_item,
                'harga_item' => $item->harga_item,
                'quantity' => $validated['quantity'],
                'subtotal' => $subtotal,
            ]);

            $item->decrement('jumlah_item', $validated['quantity']);
        });

        return redirect()->route('cart.index')
            ->with('success', 'Order placed successfully!');
    }

    public function cartCheckout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        return view('checkout-cart', compact('cart'));
    }

    public function processCart(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'username_roblox' => 'required|string|max:255',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $errors = [];
        foreach ($cart as $id => $cartItem) {
            $item = Items::find($id);
            if (! $item) {
                $errors[] = "{$cartItem['nama_item']}: item not found.";
            } elseif ($item->jumlah_item < $cartItem['quantity']) {
                $errors[] = "{$cartItem['nama_item']}: stock available {$item->jumlah_item}, requested {$cartItem['quantity']}.";
            }
        }

        if (! empty($errors)) {
            return redirect()->back()
                ->withErrors(['cart' => implode(' ', $errors)])
                ->withInput();
        }

        DB::transaction(function () use ($cart, $validated) {
            $totalAmount = 0;
            $transactionItems = [];

            foreach ($cart as $id => $cartItem) {
                $item = Items::find($id);
                $subtotal = $item->harga_item * $cartItem['quantity'];
                $totalAmount += $subtotal;

                $transactionItems[] = [
                    'item' => $item,
                    'quantity' => $cartItem['quantity'],
                    'subtotal' => $subtotal,
                ];
            }

            $transaction = Transaction::create([
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'username_roblox' => $validated['username_roblox'],
                'total_amount' => $totalAmount,
                'status' => 'completed',
            ]);

            foreach ($transactionItems as $ti) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'item_id' => $ti['item']->id,
                    'nama_item' => $ti['item']->nama_item,
                    'harga_item' => $ti['item']->harga_item,
                    'quantity' => $ti['quantity'],
                    'subtotal' => $ti['subtotal'],
                ]);

                $ti['item']->decrement('jumlah_item', $ti['quantity']);
            }
        });

        session()->forget('cart');

        return redirect()->route('cart.index')
            ->with('success', 'All items ordered successfully!');
    }
}
