<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;
use Filament\Tables\Columns\TextColumn;

class LatestOrdersWidget extends TableWidget
{
    protected int | string | array $columnSpan = 'full';
    
    public function table(Table $table): Table
    {
        return $table
            ->query(Order::query()->latest()->take(5))
            ->columns([
                TextColumn::make('order_code')->label('Kode'),
                TextColumn::make('user.name')->label('Pelanggan'),
                TextColumn::make('costume.name')->label('Baju Adat'),
                TextColumn::make('total_payment')->money('IDR')->label('Total'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'menunggu' => 'warning',
                        'dibayar' => 'info',
                        'aktif' => 'success',
                        'selesai' => 'gray',
                        'dibatalkan' => 'danger',
                    }),
            ]);
    }
}
