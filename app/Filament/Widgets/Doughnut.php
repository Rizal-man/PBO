<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class Doughnut extends ChartWidget
{
    protected ?string $heading = 'Items per Category';

    protected function getData(): array
    {
        $categories = Category::withCount('items')->get();

        return [
            'datasets' => [
                [
                    'data' => $categories->pluck('items_count')->toArray(),
                    'backgroundColor' => [
                        'rgba(77, 166, 255, 0.8)',
                        'rgba(0, 255, 255, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(168, 85, 247, 0.8)',
                    ],
                    'borderColor' => [
                        'rgba(77, 166, 255, 1)',
                        'rgba(0, 255, 255, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(168, 85, 247, 1)',
                    ],
                    'hoverOffset' => 8,
                ],
            ],
            'labels' => $categories->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
