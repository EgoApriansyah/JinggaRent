<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('order_id')
                    ->relationship('order', 'id')
                    ->required(),
                TextInput::make('midtrans_transaction_id'),
                TextInput::make('midtrans_order_id')
                    ->required(),
                TextInput::make('payment_type'),
                TextInput::make('gross_amount')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options([
            'pending' => 'Pending',
            'sukses' => 'Sukses',
            'gagal' => 'Gagal',
            'expired' => 'Expired',
            'refunded' => 'Refunded',
        ])
                    ->default('pending')
                    ->required(),
                TextInput::make('snap_url')
                    ->url(),
                TextInput::make('midtrans_response'),
                DateTimePicker::make('paid_at'),
                DateTimePicker::make('expired_at'),
            ]);
    }
}
