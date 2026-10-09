<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Posts;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Posts');
    }

    public function view(AuthUser $authUser, Posts $posts): bool
    {
        return $authUser->can('View:Posts');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Posts');
    }

    public function update(AuthUser $authUser, Posts $posts): bool
    {
        return $authUser->can('Update:Posts');
    }

    public function delete(AuthUser $authUser, Posts $posts): bool
    {
        return $authUser->can('Delete:Posts');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Posts');
    }

    public function restore(AuthUser $authUser, Posts $posts): bool
    {
        return $authUser->can('Restore:Posts');
    }

    public function forceDelete(AuthUser $authUser, Posts $posts): bool
    {
        return $authUser->can('ForceDelete:Posts');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Posts');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Posts');
    }

    public function replicate(AuthUser $authUser, Posts $posts): bool
    {
        return $authUser->can('Replicate:Posts');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Posts');
    }

}