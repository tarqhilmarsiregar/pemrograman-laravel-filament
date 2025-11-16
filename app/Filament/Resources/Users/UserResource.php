<?php

namespace App\Filament\Resources\Users;

use App\Models\User;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;

// Forms
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

use Filament\Schemas\Schema; // ⬅️ v4: form() pakai Schema

// Tables
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    // v4: tipe harus BackedEnum|string|null
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-user-group';

    // v4: tipe harus UnitEnum|string|null
    protected static UnitEnum|string|null $navigationGroup = 'Management';

    // (opsional) title di UI / global search
    protected static ?string $recordTitleAttribute = 'name';

    // v4: Wajib Schema di signature (bukan Forms\Form)
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255),

            TextInput::make('password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                ->required(fn (string $context): bool => $context === 'create')
                ->dehydrated(fn ($state) => filled($state)) // hanya simpan kalau ada isinya
                ->label('Password'),                

            Select::make('roles')
                ->relationship('roles', 'name')
                ->multiple()
                ->preload()
                ->searchable(),


                        // Tambahkan field lain sesuai kebutuhan
                    ]);
                }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime(),
            ])
            // v4: gunakan recordActions(), dan action class dari Filament\Actions\*
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
            // Bulk actions di v4 diletakkan di header/toolbar actions kalau perlu
            // ->headerActions([ ... ]) atau ->toolbarActions([ ... ])
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view'   => Pages\ViewUser::route('/{record}'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
