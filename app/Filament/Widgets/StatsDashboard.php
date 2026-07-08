<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Items;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalItems = Items::count();
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::sum('total_amount');
        $lowStockItems = Items::where('jumlah_item', '<', 5)->count();
        $categoriesCount = Category::count();

        return [
            Stat::make('Total Items', $totalItems)
                ->description('All products in stock')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),
            Stat::make('Transactions', $totalTransactions)
                ->description('Total orders placed')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('success'),
            Stat::make('Revenue', 'Rp '.number_format($totalRevenue, 0, ',', '.'))
                ->description('Total sales revenue')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),
            Stat::make('Low Stock', $lowStockItems)
                ->description('Items with stock < 5')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
            Stat::make('Categories', $categoriesCount)
                ->description('Product categories')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),
        ];
    }
}
