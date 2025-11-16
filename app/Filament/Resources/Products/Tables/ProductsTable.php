<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kodebarang')
                    ->label('Kode Barang')
                    ->searchable(),
                TextColumn::make('namabarang')
                    ->label('Nama Barang')
                    ->searchable(),
                TextColumn::make('harga')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('category.namakategori')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id') // 1. Filter berdasarkan foreign key
                    ->label('Kategori')
                    ->relationship('category', 'namakategori') // 2. Tentukan relasi & kolom nama
                    ->multiple() // 3. Izinkan user memilih lebih dari satu
                    ->preload()  // 4. (Opsional) Langsung load daftar kategori
                    ->searchable() // 5. (Opsional) Izinkan search di dropdown
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
