<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Costume;
use Filament\Tables\Columns\TextColumn;

class PopularCostumesWidget extends TableWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Costume::query()->withCount('orders')->orderByDesc('orders_count')->take(5))
            ->columns([
                TextColumn::make('name')->label('Nama Pakaian'),
                TextColumn::make('category.name')->label('Kategori'),
                TextColumn::make('orders_count')->label('Disewa (Kali)'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'tersedia' => 'success',
                        'disewa' => 'warning',
                        'perawatan' => 'danger',
                    }),
            ]);
    }
}
