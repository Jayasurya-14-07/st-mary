<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Celebration;
use Illuminate\Auth\Access\HandlesAuthorization;

class CelebrationPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Celebration');
    }

    public function view(AuthUser $authUser, Celebration $celebration): bool
    {
        return $authUser->can('View:Celebration');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Celebration');
    }

    public function update(AuthUser $authUser, Celebration $celebration): bool
    {
        return $authUser->can('Update:Celebration');
    }

    public function delete(AuthUser $authUser, Celebration $celebration): bool
    {
        return $authUser->can('Delete:Celebration');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Celebration');
    }

    public function restore(AuthUser $authUser, Celebration $celebration): bool
    {
        return $authUser->can('Restore:Celebration');
    }

    public function forceDelete(AuthUser $authUser, Celebration $celebration): bool
    {
        return $authUser->can('ForceDelete:Celebration');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Celebration');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Celebration');
    }

    public function replicate(AuthUser $authUser, Celebration $celebration): bool
    {
        return $authUser->can('Replicate:Celebration');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Celebration');
    }

}