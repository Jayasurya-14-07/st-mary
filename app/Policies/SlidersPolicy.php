<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Sliders;
use Illuminate\Auth\Access\HandlesAuthorization;

class SlidersPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Sliders');
    }

    public function view(AuthUser $authUser, Sliders $sliders): bool
    {
        return $authUser->can('View:Sliders');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Sliders');
    }

    public function update(AuthUser $authUser, Sliders $sliders): bool
    {
        return $authUser->can('Update:Sliders');
    }

    public function delete(AuthUser $authUser, Sliders $sliders): bool
    {
        return $authUser->can('Delete:Sliders');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Sliders');
    }

    public function restore(AuthUser $authUser, Sliders $sliders): bool
    {
        return $authUser->can('Restore:Sliders');
    }

    public function forceDelete(AuthUser $authUser, Sliders $sliders): bool
    {
        return $authUser->can('ForceDelete:Sliders');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Sliders');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Sliders');
    }

    public function replicate(AuthUser $authUser, Sliders $sliders): bool
    {
        return $authUser->can('Replicate:Sliders');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Sliders');
    }

}