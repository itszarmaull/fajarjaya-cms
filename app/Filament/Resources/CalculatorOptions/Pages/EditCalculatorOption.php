<?php

namespace App\Filament\Resources\CalculatorOptions\Pages;

use App\Filament\Resources\CalculatorOptions\CalculatorOptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCalculatorOption extends EditRecord
{
    protected static string $resource = CalculatorOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
