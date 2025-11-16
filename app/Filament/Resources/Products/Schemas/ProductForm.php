<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kodebarang')
                    ->label('Kode Barang')
                    ->required()
                    ->maxLength(255),

                TextInput::make('namabarang')
                    ->label('Nama Barang')
                    ->required()
                    ->maxLength(255),

                TextInput::make('harga')
                    ->label('Harga')
                    ->numeric()
                    ->required()
                    ->default(0),

                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'namakategori')
                    ->searchable()
                    ->preload()
                    ->required(),                
            ]);
    }
}
