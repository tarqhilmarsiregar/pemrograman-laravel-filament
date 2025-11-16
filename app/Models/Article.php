<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- 1. IMPORT DI SINI

class Article extends Model
{
    use SoftDeletes; // <-- 2. GUNAKAN TRAIT DI SINI
    
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content',
        'status', 'published_at', 'featured_image',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    
}
