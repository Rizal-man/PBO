<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class Doughnut extends ChartWidget
{
    protected ?string $heading = 'Items Terlaris';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'DATA PENJUALAN 6 BULAN TERAKHIR',
                    'data' => [25, 20, 15, 10, 5],
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)'
                        ],
                        'hoverOffset' => 5
                ],
            ],
            'labels' => ['Outfit', 'Shoes', 'Accessories', 'Bags', 'Jackets'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
