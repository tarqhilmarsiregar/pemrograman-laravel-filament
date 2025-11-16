<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Schemas\Schema;
// use Filament\Forms\Set;
use Filament\Schemas\Components\Utilities\Set; // <-- Pastikan ini benar
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor; // <-- PASTIKAN INI ADA
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('title')
                ->label('Judul')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function (Set $set, ?string $state) {
                    $set('slug', Str::slug((string) $state));
                }),

            TextInput::make('slug')
                ->required()
                ->rules(['alpha_dash'])
                ->unique(ignoreRecord: true), // abaikan current record saat edit

            TextInput::make('excerpt')
                ->label('Ringkasan')
                ->maxLength(255),

            FileUpload::make('featured_image')
                ->label('Gambar Utama')
                ->image()
                ->directory('articles')
                ->visibility('public'), // pastikan storage:link

            RichEditor::make('content')
                ->label('Konten')
                ->columnSpanFull(),

            Select::make('status')
                ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                ])
                ->default('draft'),

            DateTimePicker::make('published_at')
                ->label('Tanggal Terbit')
                ->native(false)
                ->seconds(false),                //
            ]);
    }
}
