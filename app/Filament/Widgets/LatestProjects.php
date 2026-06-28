<?php

namespace App\Filament\Widgets;

use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Project;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class LatestProjects extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(Project::query()->latest()->limit(5))
            ->heading('Portofolio Proyek Terbaru')
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->square(),
                TextColumn::make('title')
                    ->label('Judul Proyek')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('success'),
                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->paginated(false);
    }
}
