<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SchoolInfo;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolInfoPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SchoolInfo');
    }

    public function view(AuthUser $authUser, SchoolInfo $schoolInfo): bool
    {
        return $authUser->can('View:SchoolInfo');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SchoolInfo');
    }

    public function update(AuthUser $authUser, SchoolInfo $schoolInfo): bool
    {
        return $authUser->can('Update:SchoolInfo');
    }

    public function delete(AuthUser $authUser, SchoolInfo $schoolInfo): bool
    {
        return $authUser->can('Delete:SchoolInfo');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:SchoolInfo');
    }

    public function restore(AuthUser $authUser, SchoolInfo $schoolInfo): bool
    {
        return $authUser->can('Restore:SchoolInfo');
    }

    public function forceDelete(AuthUser $authUser, SchoolInfo $schoolInfo): bool
    {
        return $authUser->can('ForceDelete:SchoolInfo');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SchoolInfo');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SchoolInfo');
    }

    public function replicate(AuthUser $authUser, SchoolInfo $schoolInfo): bool
    {
        return $authUser->can('Replicate:SchoolInfo');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SchoolInfo');
    }

}