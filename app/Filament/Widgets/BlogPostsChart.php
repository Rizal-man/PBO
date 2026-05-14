<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class BlogPostsChart extends ChartWidget
{
    protected ?string $heading = 'DATA PENJUALAN 6 BULAN TERAKHIR';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Data Penjualan 6 Bulan Terakhir',
                    'data' => [0, 10, 5, 18, 21, 30],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
