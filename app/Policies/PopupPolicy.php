<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Popup;
use Illuminate\Auth\Access\HandlesAuthorization;

class PopupPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Popup');
    }

    public function view(AuthUser $authUser, Popup $popup): bool
    {
        return $authUser->can('View:Popup');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Popup');
    }

    public function update(AuthUser $authUser, Popup $popup): bool
    {
        return $authUser->can('Update:Popup');
    }

    public function delete(AuthUser $authUser, Popup $popup): bool
    {
        return $authUser->can('Delete:Popup');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Popup');
    }

    public function restore(AuthUser $authUser, Popup $popup): bool
    {
        return $authUser->can('Restore:Popup');
    }

    public function forceDelete(AuthUser $authUser, Popup $popup): bool
    {
        return $authUser->can('ForceDelete:Popup');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Popup');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Popup');
    }

    public function replicate(AuthUser $authUser, Popup $popup): bool
    {
        return $authUser->can('Replicate:Popup');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Popup');
    }

}