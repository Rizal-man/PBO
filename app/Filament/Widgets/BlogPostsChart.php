<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class BlogPostsChart extends ChartWidget
{
    protected ?string $heading = 'Monthly Revenue';

    protected function getData(): array
    {
        $data = Transaction::selectRaw('
                MONTH(created_at) as month,
                YEAR(created_at) as year,
                SUM(total_amount) as total
            ')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $months = [];
        $revenues = [];

        foreach ($data as $row) {
            $months[] = Carbon::create($row->year, $row->month, 1)->format('M Y');
            $revenues[] = $row->total;
        }

        if (empty($months)) {
            $months = ['No Data'];
            $revenues = [0];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $revenues,
                    'borderColor' => '#4da6ff',
                    'backgroundColor' => 'rgba(77, 166, 255, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
