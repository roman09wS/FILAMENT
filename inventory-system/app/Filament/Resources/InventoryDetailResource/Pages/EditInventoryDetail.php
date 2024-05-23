<?php

namespace App\Filament\Resources\InventoryDetailResource\Pages;

use App\Filament\Resources\InventoryDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventoryDetail extends EditRecord
{
    protected static string $resource = InventoryDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
