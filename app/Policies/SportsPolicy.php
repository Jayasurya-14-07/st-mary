<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Sports;
use Illuminate\Auth\Access\HandlesAuthorization;

class SportsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Sports');
    }

    public function view(AuthUser $authUser, Sports $sports): bool
    {
        return $authUser->can('View:Sports');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Sports');
    }

    public function update(AuthUser $authUser, Sports $sports): bool
    {
        return $authUser->can('Update:Sports');
    }

    public function delete(AuthUser $authUser, Sports $sports): bool
    {
        return $authUser->can('Delete:Sports');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Sports');
    }

    public function restore(AuthUser $authUser, Sports $sports): bool
    {
        return $authUser->can('Restore:Sports');
    }

    public function forceDelete(AuthUser $authUser, Sports $sports): bool
    {
        return $authUser->can('ForceDelete:Sports');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Sports');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Sports');
    }

    public function replicate(AuthUser $authUser, Sports $sports): bool
    {
        return $authUser->can('Replicate:Sports');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Sports');
    }

}