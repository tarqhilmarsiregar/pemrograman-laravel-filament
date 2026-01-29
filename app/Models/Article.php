<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- 1. IMPORT DI SINI
use App\Models\CategoryBlog;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use SoftDeletes; // <-- 2. GUNAKAN TRAIT DI SINI
    
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content',
        'status', 'published_at', 'featured_image',
        'user_id', 'meta_description', 'meta_keywords',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'meta_keywords' => 'array',
    ];

    public function categoryBlog() // Nama relasi: categoryBlog
    {
        // Article belongs to a CategoryBlog
        return $this->belongsTo(CategoryBlog::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
