<?php

namespace App\Filament\Resources\CalculatorOptions\Pages;

use App\Filament\Resources\CalculatorOptions\CalculatorOptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCalculatorOptions extends ListRecords
{
    protected static string $resource = CalculatorOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
