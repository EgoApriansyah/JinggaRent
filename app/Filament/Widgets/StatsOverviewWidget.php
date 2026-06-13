<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pendapatan', 'Rp ' . number_format(\App\Models\Order::where('status', '!=', 'dibatalkan')->sum('total_payment'), 0, ',', '.'))
                ->description('Pendapatan keseluruhan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Pesanan Aktif', \App\Models\Order::where('status', 'aktif')->count())
                ->description('Sedang disewa pelanggan')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning'),
            Stat::make('Baju Tersedia', \App\Models\Costume::where('status', 'tersedia')->count())
                ->description('Siap disewa')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
