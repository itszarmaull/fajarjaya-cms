<?php

namespace App\Filament\Resources\CalculatorOptions;

use App\Filament\Resources\CalculatorOptions\Pages\CreateCalculatorOption;
use App\Filament\Resources\CalculatorOptions\Pages\EditCalculatorOption;
use App\Filament\Resources\CalculatorOptions\Pages\ListCalculatorOptions;
use App\Filament\Resources\CalculatorOptions\Schemas\CalculatorOptionForm;
use App\Filament\Resources\CalculatorOptions\Tables\CalculatorOptionsTable;
use App\Models\CalculatorOption;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CalculatorOptionResource extends Resource
{
    protected static ?string $model = CalculatorOption::class;

    protected static ?string $modelLabel = 'Pilihan Kalkulator';
    protected static ?string $pluralModelLabel = 'Kalkulator Estimasi';
    protected static \UnitEnum|string|null $navigationGroup = 'Sistem';
    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calculator';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return CalculatorOptionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CalculatorOptionsTable::configure($table);
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
            'index' => ListCalculatorOptions::route('/'),
            'create' => CreateCalculatorOption::route('/create'),
            'edit' => EditCalculatorOption::route('/{record}/edit'),
        ];
    }
}
