<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_code')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('costume_id')
                    ->relationship('costume', 'name')
                    ->required(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date')
                    ->required(),
                TextInput::make('rental_days')
                    ->required()
                    ->numeric(),
                TextInput::make('price_per_day')
                    ->required()
                    ->numeric(),
                TextInput::make('subtotal')
                    ->required()
                    ->numeric(),
                TextInput::make('deposit_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('total_payment')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options([
            'menunggu' => 'Menunggu',
            'dikonfirmasi' => 'Dikonfirmasi',
            'ditolak' => 'Ditolak',
            'dibayar' => 'Dibayar',
            'aktif' => 'Aktif',
            'dikembalikan' => 'Dikembalikan',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
        ])
                    ->default('menunggu')
                    ->required(),
                Textarea::make('customer_notes')
                    ->label('Catatan Pelanggan')
                    ->disabled()
                    ->columnSpanFull(),
                Textarea::make('admin_notes')
                    ->columnSpanFull(),
            ]);
    }
}
