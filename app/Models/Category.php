<?php

namespace App\Models; // <--- Pastikan namespace-nya benar

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    // protected $table = 'categories';
    protected $fillable = [
            'kodekategori',
            'namakategori',
            'status',
        ];

    public function setKategoribarangAttribute($value): void
    {
        $this->attributes['kodekategori'] = strtoupper(trim($value));
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}