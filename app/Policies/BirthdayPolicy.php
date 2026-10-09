<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Birthday;
use Illuminate\Auth\Access\HandlesAuthorization;

class BirthdayPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Birthday');
    }

    public function view(AuthUser $authUser, Birthday $birthday): bool
    {
        return $authUser->can('View:Birthday');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Birthday');
    }

    public function update(AuthUser $authUser, Birthday $birthday): bool
    {
        return $authUser->can('Update:Birthday');
    }

    public function delete(AuthUser $authUser, Birthday $birthday): bool
    {
        return $authUser->can('Delete:Birthday');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Birthday');
    }

    public function restore(AuthUser $authUser, Birthday $birthday): bool
    {
        return $authUser->can('Restore:Birthday');
    }

    public function forceDelete(AuthUser $authUser, Birthday $birthday): bool
    {
        return $authUser->can('ForceDelete:Birthday');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Birthday');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Birthday');
    }

    public function replicate(AuthUser $authUser, Birthday $birthday): bool
    {
        return $authUser->can('Replicate:Birthday');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Birthday');
    }

}