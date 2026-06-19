<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\items;

class StatsDashboard extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Items', items::count())
            ->description('Semua items yang ada')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('Item terbanyak pada game', '20%')
            ->description('7% decrease')
            ->descriptionIcon('heroicon-m-arrow-trending-down'),
            Stat::make('Average time on page', '3:12')
            ->description('3% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Penjualan', 'Rp 12.000.000')
            ->description('3% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
