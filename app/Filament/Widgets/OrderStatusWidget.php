<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class OrderStatusWidget extends ChartWidget
{
    protected ?string $heading = 'Status Pesanan';

    protected function getData(): array
    {
        $menunggu = \App\Models\Order::where('status', 'menunggu')->count();
        $dibayar = \App\Models\Order::where('status', 'dibayar')->count();
        $aktif = \App\Models\Order::where('status', 'aktif')->count();
        $selesai = \App\Models\Order::where('status', 'selesai')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Pesanan',
                    'data' => [$menunggu, $dibayar, $aktif, $selesai],
                    'backgroundColor' => ['#f59e0b', '#3b82f6', '#10b981', '#6b7280'],
                ],
            ],
            'labels' => ['Menunggu', 'Dibayar', 'Aktif', 'Selesai'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
