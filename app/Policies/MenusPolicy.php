<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Menus;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenusPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Menus');
    }

    public function view(AuthUser $authUser, Menus $menus): bool
    {
        return $authUser->can('View:Menus');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Menus');
    }

    public function update(AuthUser $authUser, Menus $menus): bool
    {
        return $authUser->can('Update:Menus');
    }

    public function delete(AuthUser $authUser, Menus $menus): bool
    {
        return $authUser->can('Delete:Menus');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Menus');
    }

    public function restore(AuthUser $authUser, Menus $menus): bool
    {
        return $authUser->can('Restore:Menus');
    }

    public function forceDelete(AuthUser $authUser, Menus $menus): bool
    {
        return $authUser->can('ForceDelete:Menus');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Menus');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Menus');
    }

    public function replicate(AuthUser $authUser, Menus $menus): bool
    {
        return $authUser->can('Replicate:Menus');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Menus');
    }

}