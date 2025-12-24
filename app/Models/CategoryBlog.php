<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class CategoryBlog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public $incrementing = true;

    public function articles() // Nama relasi: articles (plural)
    {
        // CategoryBlog has many Articles
        return $this->hasMany(Article::class);
    }
}