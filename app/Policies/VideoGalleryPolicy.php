<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\VideoGallery;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoGalleryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:VideoGallery');
    }

    public function view(AuthUser $authUser, VideoGallery $videoGallery): bool
    {
        return $authUser->can('View:VideoGallery');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:VideoGallery');
    }

    public function update(AuthUser $authUser, VideoGallery $videoGallery): bool
    {
        return $authUser->can('Update:VideoGallery');
    }

    public function delete(AuthUser $authUser, VideoGallery $videoGallery): bool
    {
        return $authUser->can('Delete:VideoGallery');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:VideoGallery');
    }

    public function restore(AuthUser $authUser, VideoGallery $videoGallery): bool
    {
        return $authUser->can('Restore:VideoGallery');
    }

    public function forceDelete(AuthUser $authUser, VideoGallery $videoGallery): bool
    {
        return $authUser->can('ForceDelete:VideoGallery');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:VideoGallery');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:VideoGallery');
    }

    public function replicate(AuthUser $authUser, VideoGallery $videoGallery): bool
    {
        return $authUser->can('Replicate:VideoGallery');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:VideoGallery');
    }

}