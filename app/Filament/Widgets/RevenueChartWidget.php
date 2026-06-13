<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class RevenueChartWidget extends ChartWidget
{
    protected ?string $heading = 'Grafik Pendapatan (Bulan Ini)';

    protected function getData(): array
    {
        // Dummy data for now. In real app, group by date
        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan Harian',
                    'data' => [1000000, 2500000, 1500000, 4000000, 3000000, 5000000, 4500000],
                    'backgroundColor' => '#D97706',
                    'borderColor' => '#D97706',
                ],
            ],
            'labels' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
