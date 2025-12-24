<?php

namespace App\Filament\Resources\CategoryBlogs\Pages;

use App\Filament\Resources\CategoryBlogs\CategoryBlogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoryBlog extends CreateRecord
{
    protected static string $resource = CategoryBlogResource::class;

    /**
     * Metode ini memaksa Filament untuk redirect ke halaman list (index)
     * setelah record berhasil dibuat.
     */
    protected function getRedirectUrl(): string
    {
        // getUrl('index') merujuk ke route: /admin/category-blogs
        return $this->getResource()::getUrl('index');
    }
}
