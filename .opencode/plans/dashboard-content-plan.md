# Dashboard Content Implementation Plan

## Files to Modify

### 1. `app/Filament/Pages/Dashboard.php`

Add `Transaction` import and `getRecentTransactions()` method:

```php
<?php

namespace App\Filament\Pages;

use App\Models\Transaction;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected string $view = 'filament.pages.dashboard';

    public function getRecentTransactions()
    {
        return Transaction::latest()->take(5)->get();
    }
}
```

### 2. `resources/views/filament/pages/dashboard.blade.php`

Replace empty content with greeting, quick actions, and recent transactions table:

```blade
<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Greeting --}}
        <div class="bg-gray-900 rounded-xl p-6 border border-gray-700">
            <h2 class="text-2xl font-bold text-white">Welcome back, {{ auth()->user()->name }}!</h2>
            <p class="text-gray-400 mt-1">{{ now()->format('l, d F Y') }}</p>
        </div>

        {{-- Quick Actions --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('filament.admin.resources.items.create') }}"
               class="flex items-center gap-3 bg-gray-900 rounded-xl p-4 border border-gray-700 hover:border-primary-500 transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-primary-500/10 flex items-center justify-center">
                    <span class="text-primary-500 text-xl font-bold group-hover:scale-110 transition-transform">+</span>
                </div>
                <div>
                    <div class="text-sm font-medium text-white">Add Item</div>
                    <div class="text-xs text-gray-400">Create new product</div>
                </div>
            </a>
            <a href="{{ route('filament.admin.resources.items.index') }}"
               class="flex items-center gap-3 bg-gray-900 rounded-xl p-4 border border-gray-700 hover:border-success-500 transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-success-500/10 flex items-center justify-center">
                    <span class="text-success-500 text-xl font-bold group-hover:scale-110 transition-transform">&#9783;</span>
                </div>
                <div>
                    <div class="text-sm font-medium text-white">View Items</div>
                    <div class="text-xs text-gray-400">Manage products</div>
                </div>
            </a>
            <a href="{{ route('filament.admin.resources.transactions.index') }}"
               class="flex items-center gap-3 bg-gray-900 rounded-xl p-4 border border-gray-700 hover:border-warning-500 transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-warning-500/10 flex items-center justify-center">
                    <span class="text-warning-500 text-xl font-bold group-hover:scale-110 transition-transform">&#36;</span>
                </div>
                <div>
                    <div class="text-sm font-medium text-white">Transactions</div>
                    <div class="text-xs text-gray-400">View all orders</div>
                </div>
            </a>
            <a href="{{ route('filament.admin.resources.categories.index') }}"
               class="flex items-center gap-3 bg-gray-900 rounded-xl p-4 border border-gray-700 hover:border-info-500 transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-info-500/10 flex items-center justify-center">
                    <span class="text-info-500 text-xl font-bold group-hover:scale-110 transition-transform">&#35;</span>
                </div>
                <div>
                    <div class="text-sm font-medium text-white">Categories</div>
                    <div class="text-xs text-gray-400">Manage categories</div>
                </div>
            </a>
        </div>

        {{-- Recent Transactions --}}
        <div class="bg-gray-900 rounded-xl border border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-700 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white">Recent Transactions</h3>
                <a href="{{ route('filament.admin.resources.transactions.index') }}"
                   class="text-xs text-primary-500 hover:text-primary-400 transition-colors">
                    View all &rarr;
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left px-6 py-3 text-gray-400 font-medium">ID</th>
                            <th class="text-left px-6 py-3 text-gray-400 font-medium">Customer</th>
                            <th class="text-left px-6 py-3 text-gray-400 font-medium">Amount</th>
                            <th class="text-left px-6 py-3 text-gray-400 font-medium">Status</th>
                            <th class="text-left px-6 py-3 text-gray-400 font-medium">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->getRecentTransactions() as $transaction)
                            <tr class="border-b border-gray-700/50 hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-3 text-white font-mono">#{{ $transaction->id }}</td>
                                <td class="px-6 py-3 text-gray-300">{{ $transaction->customer_name }}</td>
                                <td class="px-6 py-3 text-gray-300">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                        @if($transaction->status === 'completed') bg-success-500/10 text-success-500
                                        @elseif($transaction->status === 'pending') bg-warning-500/10 text-warning-500
                                        @else bg-danger-500/10 text-danger-500
                                        @endif">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-gray-400">{{ $transaction->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">No transactions yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-filament-panels::page>
```
