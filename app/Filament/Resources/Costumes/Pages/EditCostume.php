<?php

namespace App\Filament\Resources\Costumes\Pages;

use App\Filament\Resources\Costumes\CostumeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCostume extends EditRecord
{
    protected static string $resource = CostumeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
