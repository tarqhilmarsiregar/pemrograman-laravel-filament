<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
            'kodebarang',
            'namabarang',
            'harga',
            'category_id',
        ];

    protected $casts = [
            'harga' => 'decimal:2',
        ];

    public function setKodebarangAttribute($value): void
        {
            $this->attributes['kodebarang'] = strtoupper(trim($value));
        }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    }
