<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingSeo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'robots',
    ];

    protected $casts = [
        'meta_keywords' => 'array', // Ubah otomatis array <-> json
        'robots' => 'array',        // Ubah otomatis array <-> json
    ];
}
