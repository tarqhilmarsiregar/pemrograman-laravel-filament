<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser; // Wajib import ini
use BezhanSalleh\FilamentShield\Traits\HasPanelShield; // Wajib import ini

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;
    use HasPanelShield; // Mengaktifkan Shield

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}