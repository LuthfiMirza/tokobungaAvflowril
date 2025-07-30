<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Carbon\Carbon;

class SalesChart extends ChartWidget
{
    protected static ?string $heading = 'Penjualan Bulanan';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        try {
            $data = Trend::model(Order::class)
                ->between(
                    start: now()->subMonths(11)->startOfMonth(),
                    end: now()->endOfMonth(),
                )
                ->perMonth()
                ->count();

            return [
                'datasets' => [
                    [
                        'label' => 'Pesanan',
                        'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                        'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                        'borderColor' => 'rgb(59, 130, 246)',
                        'borderWidth' => 2,
                        'fill' => true,
                    ],
                ],
                'labels' => $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('M Y')),
            ];
        } catch (\Exception $e) {
            // Fallback data if there's an error
            return [
                'datasets' => [
                    [
                        'label' => 'Pesanan',
                        'data' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                        'borderColor' => 'rgb(59, 130, 246)',
                        'borderWidth' => 2,
                        'fill' => true,
                    ],
                ],
                'labels' => collect(range(11, 0))->map(fn ($i) => now()->subMonths($i)->format('M Y'))->toArray(),
            ];
        }
    }

    protected function getType(): string
    {
        return 'line';
    }
}