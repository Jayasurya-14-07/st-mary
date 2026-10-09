<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\PhotoAlbums;
use App\Models\User;

class PhotoAlbumsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any PhotoAlbums');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PhotoAlbums $photoalbums): bool
    {
        return $user->checkPermissionTo('view PhotoAlbums');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create PhotoAlbums');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PhotoAlbums $photoalbums): bool
    {
        return $user->checkPermissionTo('update PhotoAlbums');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PhotoAlbums $photoalbums): bool
    {
        return $user->checkPermissionTo('delete PhotoAlbums');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PhotoAlbums $photoalbums): bool
    {
        return $user->checkPermissionTo('restore PhotoAlbums');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PhotoAlbums $photoalbums): bool
    {
        return $user->checkPermissionTo('force-delete PhotoAlbums');
    }
}
