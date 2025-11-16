<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBlog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];
}