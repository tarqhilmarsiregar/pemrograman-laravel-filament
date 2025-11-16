<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_published',
        'published_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relasi ke User (Pembuat)
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Magic Function: Otomatis isi created_by dan updated_by
    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }
}