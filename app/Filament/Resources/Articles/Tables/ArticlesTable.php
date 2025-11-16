<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;


use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => $state === 'published' ? 'success' : 'warning'),
                TextColumn::make('published_at')
                    ->label('Terbit')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->since(), // "x minutes ago"
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(['draft' => 'Draft', 'published' => 'Published']),
                TrashedFilter::make(),
            ])
            ->headerActions([ CreateAction::make() ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ]);
    }
}
