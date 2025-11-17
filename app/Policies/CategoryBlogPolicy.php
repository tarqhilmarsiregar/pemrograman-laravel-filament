<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CategoryBlog;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryBlogPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CategoryBlog');
    }

    public function view(AuthUser $authUser, CategoryBlog $categoryBlog): bool
    {
        return $authUser->can('View:CategoryBlog');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CategoryBlog');
    }

    public function update(AuthUser $authUser, CategoryBlog $categoryBlog): bool
    {
        return $authUser->can('Update:CategoryBlog');
    }

    public function delete(AuthUser $authUser, CategoryBlog $categoryBlog): bool
    {
        return $authUser->can('Delete:CategoryBlog');
    }

    public function restore(AuthUser $authUser, CategoryBlog $categoryBlog): bool
    {
        return $authUser->can('Restore:CategoryBlog');
    }

    public function forceDelete(AuthUser $authUser, CategoryBlog $categoryBlog): bool
    {
        return $authUser->can('ForceDelete:CategoryBlog');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CategoryBlog');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CategoryBlog');
    }

    public function replicate(AuthUser $authUser, CategoryBlog $categoryBlog): bool
    {
        return $authUser->can('Replicate:CategoryBlog');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CategoryBlog');
    }

}