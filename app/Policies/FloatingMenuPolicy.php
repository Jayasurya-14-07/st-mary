<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\FloatingMenu;
use Illuminate\Auth\Access\HandlesAuthorization;

class FloatingMenuPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:FloatingMenu');
    }

    public function view(AuthUser $authUser, FloatingMenu $floatingMenu): bool
    {
        return $authUser->can('View:FloatingMenu');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:FloatingMenu');
    }

    public function update(AuthUser $authUser, FloatingMenu $floatingMenu): bool
    {
        return $authUser->can('Update:FloatingMenu');
    }

    public function delete(AuthUser $authUser, FloatingMenu $floatingMenu): bool
    {
        return $authUser->can('Delete:FloatingMenu');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:FloatingMenu');
    }

    public function restore(AuthUser $authUser, FloatingMenu $floatingMenu): bool
    {
        return $authUser->can('Restore:FloatingMenu');
    }

    public function forceDelete(AuthUser $authUser, FloatingMenu $floatingMenu): bool
    {
        return $authUser->can('ForceDelete:FloatingMenu');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:FloatingMenu');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:FloatingMenu');
    }

    public function replicate(AuthUser $authUser, FloatingMenu $floatingMenu): bool
    {
        return $authUser->can('Replicate:FloatingMenu');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:FloatingMenu');
    }

}