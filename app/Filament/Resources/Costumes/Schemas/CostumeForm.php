<?php

namespace App\Filament\Resources\Costumes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class CostumeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Select::make('region_id')
                    ->relationship('region', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('size')
                    ->required(),
                TextInput::make('price_per_day')
                    ->required()
                    ->numeric(),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('status')
                    ->options(['tersedia' => 'Tersedia', 'disewa' => 'Disewa', 'perawatan' => 'Perawatan'])
                    ->default('tersedia')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                Repeater::make('images')
                    ->relationship('images')
                    ->schema([
                        FileUpload::make('image_path')
                            ->image()
                            ->disk('public')
                            ->directory('costume-images')
                            ->required(),
                        Toggle::make('is_primary')
                            ->label('Jadikan Gambar Utama'),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->label('Urutan'),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->defaultItems(1),
            ]);
    }
}
