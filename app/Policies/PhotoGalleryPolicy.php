<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PhotoGallery;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoGalleryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PhotoGallery');
    }

    public function view(AuthUser $authUser, PhotoGallery $photoGallery): bool
    {
        return $authUser->can('View:PhotoGallery');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PhotoGallery');
    }

    public function update(AuthUser $authUser, PhotoGallery $photoGallery): bool
    {
        return $authUser->can('Update:PhotoGallery');
    }

    public function delete(AuthUser $authUser, PhotoGallery $photoGallery): bool
    {
        return $authUser->can('Delete:PhotoGallery');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:PhotoGallery');
    }

    public function restore(AuthUser $authUser, PhotoGallery $photoGallery): bool
    {
        return $authUser->can('Restore:PhotoGallery');
    }

    public function forceDelete(AuthUser $authUser, PhotoGallery $photoGallery): bool
    {
        return $authUser->can('ForceDelete:PhotoGallery');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PhotoGallery');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PhotoGallery');
    }

    public function replicate(AuthUser $authUser, PhotoGallery $photoGallery): bool
    {
        return $authUser->can('Replicate:PhotoGallery');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PhotoGallery');
    }

}