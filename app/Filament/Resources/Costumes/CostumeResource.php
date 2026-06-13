<?php

namespace App\Filament\Resources\Costumes;

use App\Filament\Resources\Costumes\Pages\CreateCostume;
use App\Filament\Resources\Costumes\Pages\EditCostume;
use App\Filament\Resources\Costumes\Pages\ListCostumes;
use App\Filament\Resources\Costumes\Schemas\CostumeForm;
use App\Filament\Resources\Costumes\Tables\CostumesTable;
use App\Models\Costume;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CostumeResource extends Resource
{
    protected static ?string $model = Costume::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CostumeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CostumesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCostumes::route('/'),
            'create' => CreateCostume::route('/create'),
            'edit' => EditCostume::route('/{record}/edit'),
        ];
    }
}
