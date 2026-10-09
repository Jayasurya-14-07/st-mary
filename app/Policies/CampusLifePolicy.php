<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CampusLife;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampusLifePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CampusLife');
    }

    public function view(AuthUser $authUser, CampusLife $campusLife): bool
    {
        return $authUser->can('View:CampusLife');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CampusLife');
    }

    public function update(AuthUser $authUser, CampusLife $campusLife): bool
    {
        return $authUser->can('Update:CampusLife');
    }

    public function delete(AuthUser $authUser, CampusLife $campusLife): bool
    {
        return $authUser->can('Delete:CampusLife');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:CampusLife');
    }

    public function restore(AuthUser $authUser, CampusLife $campusLife): bool
    {
        return $authUser->can('Restore:CampusLife');
    }

    public function forceDelete(AuthUser $authUser, CampusLife $campusLife): bool
    {
        return $authUser->can('ForceDelete:CampusLife');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CampusLife');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CampusLife');
    }

    public function replicate(AuthUser $authUser, CampusLife $campusLife): bool
    {
        return $authUser->can('Replicate:CampusLife');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CampusLife');
    }

}