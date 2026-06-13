<?php

namespace App\Filament\Resources\Costumes\Pages;

use App\Filament\Resources\Costumes\CostumeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCostumes extends ListRecords
{
    protected static string $resource = CostumeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
