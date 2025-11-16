<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            
            $table->string('title', 150);
            $table->string('slug', 150)->unique(); // Slug harus unik
            $table->longText('content')->nullable(); // Isi halaman bisa panjang
            $table->string('featured_image', 255)->nullable();
            
            // SEO Fields
            $table->string('meta_title', 150)->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->string('meta_keywords', 255)->nullable();
            
            // Status
            $table->boolean('is_published')->default(false);
            $table->dateTime('published_at')->nullable();
            
            // Foreign Keys (Relasi ke Users)
            // nullable() agar jika user dihapus, halaman tidak error
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};