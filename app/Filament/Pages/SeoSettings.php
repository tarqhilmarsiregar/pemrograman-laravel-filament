<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use App\Models\SettingSeo;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use BackedEnum;
use UnitEnum;
use Filament\Support\Icons\Heroicon;

class SeoSettings extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected string $view = 'filament.pages.seo-settings';

    // protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMagnifyingGlass;
    protected static ?string $navigationLabel = 'SEO';
    protected static string|UnitEnum|null $navigationGroup = 'Settings';
    protected static ?string $title = 'Pengaturan SEO Global';

    public function mount(): void
    {
        $settings = SettingSeo::find(1);

        if ($settings) {
            $this->form->fill($settings->toArray());
        }
    }

    // ✅ Sesuai Filament v2 — tidak pakai Section atau Schema
    protected function form($form)
    {
        return $form
            ->schema([
                TextInput::make('meta_title')
                    ->label('Meta Title')
                    ->maxLength(150)
                    ->required(),

                Textarea::make('meta_description')
                    ->label('Meta Description')
                    ->rows(3)
                    ->maxLength(255)
                    ->required(),

                TagsInput::make('meta_keywords')
                    ->label('Meta Keywords')
                    ->placeholder('Tambah keyword lalu tekan enter'),

                Textarea::make('robots')
                    ->label('Robots')
                    ->placeholder('Contoh: index, follow, nonindex'),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Perubahan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            $settings = SettingSeo::find(1);
            if ($settings) {
                $settings->update($data);
            }

            Notification::make()
                ->title('Saved')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Failed to saved')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}
