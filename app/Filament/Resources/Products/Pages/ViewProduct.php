<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;
    // public function mount(string|int $record): void
    // {
    //     parent::mount($record);

    //     // Добавь эту строку
    //     dump($this->record->gallery);
    // }
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
