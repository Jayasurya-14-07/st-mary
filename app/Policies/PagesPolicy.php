<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Pages;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagesPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Pages');
    }

    public function view(AuthUser $authUser, Pages $pages): bool
    {
        return $authUser->can('View:Pages');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Pages');
    }

    public function update(AuthUser $authUser, Pages $pages): bool
    {
        return $authUser->can('Update:Pages');
    }

    public function delete(AuthUser $authUser, Pages $pages): bool
    {
        return $authUser->can('Delete:Pages');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Pages');
    }

    public function restore(AuthUser $authUser, Pages $pages): bool
    {
        return $authUser->can('Restore:Pages');
    }

    public function forceDelete(AuthUser $authUser, Pages $pages): bool
    {
        return $authUser->can('ForceDelete:Pages');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Pages');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Pages');
    }

    public function replicate(AuthUser $authUser, Pages $pages): bool
    {
        return $authUser->can('Replicate:Pages');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Pages');
    }

}