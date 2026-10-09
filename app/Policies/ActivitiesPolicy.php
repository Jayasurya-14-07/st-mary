<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Activities;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivitiesPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Activities');
    }

    public function view(AuthUser $authUser, Activities $activities): bool
    {
        return $authUser->can('View:Activities');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Activities');
    }

    public function update(AuthUser $authUser, Activities $activities): bool
    {
        return $authUser->can('Update:Activities');
    }

    public function delete(AuthUser $authUser, Activities $activities): bool
    {
        return $authUser->can('Delete:Activities');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Activities');
    }

    public function restore(AuthUser $authUser, Activities $activities): bool
    {
        return $authUser->can('Restore:Activities');
    }

    public function forceDelete(AuthUser $authUser, Activities $activities): bool
    {
        return $authUser->can('ForceDelete:Activities');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Activities');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Activities');
    }

    public function replicate(AuthUser $authUser, Activities $activities): bool
    {
        return $authUser->can('Replicate:Activities');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Activities');
    }

}