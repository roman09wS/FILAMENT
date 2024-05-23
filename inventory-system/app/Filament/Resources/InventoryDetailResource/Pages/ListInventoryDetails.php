<?php

namespace App\Filament\Resources\InventoryDetailResource\Pages;

use App\Filament\Resources\InventoryDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventoryDetails extends ListRecords
{
    protected static string $resource = InventoryDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
