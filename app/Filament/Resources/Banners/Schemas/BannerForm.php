<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Group;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
                return $schema
            ->columns(2)
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(150)
                    ->columnSpan(2), // Penuhi 2 kolom

                TextInput::make('subtitle')
                    ->maxLength(255)
                    ->columnSpan(2),
                
                FileUpload::make('image_url')
                    ->label('Image')
                    ->required()
                    ->image()
                    ->directory('banners')
                    ->visibility('public')
                    ->columnSpan('full'),

                TextInput::make('link_url')
                    ->label('Link URL')
                    ->url()
                    ->nullable()
                    ->maxLength(255)
                    ->columnSpan(2),
                Select::make('position')
                    ->required()
                    ->options([
                        'top' => 'Top',
                        'sidebar' => 'Sidebar',
                        'footer' => 'Footer',
                        'popup' => 'Popup'
                    ]),
                TextInput::make('order_index')
                    ->label('Order Index')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
                DateTimePicker::make('start_date')
                    ->label('Start Date'),

                DateTimePicker::make('end_date')
                    ->label('End Date'),        
                ]);
    }
}
