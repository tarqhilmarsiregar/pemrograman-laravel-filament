<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            // Pilihan: Gunakan id() untuk bigInt atau uuid() untuk UUID
            $table->id(); 
            // $table->uuid('id')->primary(); // Alternatif jika Anda mau UUID

            $table->string('title', 150);
            $table->string('subtitle', 255)->nullable();
            $table->string('image_url', 255);
            $table->string('link_url', 255)->nullable();

            // Simpan sebagai string, kita akan cast ke Enum di Model
            $table->enum('position', [
                'top',
                'sidebar',
                'footer',
                'popup'
            ]); 

            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            // Ini akan membuat created_at dan updated_at
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};

?>