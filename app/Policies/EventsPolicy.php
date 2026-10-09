<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Events;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Events');
    }

    public function view(AuthUser $authUser, Events $events): bool
    {
        return $authUser->can('View:Events');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Events');
    }

    public function update(AuthUser $authUser, Events $events): bool
    {
        return $authUser->can('Update:Events');
    }

    public function delete(AuthUser $authUser, Events $events): bool
    {
        return $authUser->can('Delete:Events');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Events');
    }

    public function restore(AuthUser $authUser, Events $events): bool
    {
        return $authUser->can('Restore:Events');
    }

    public function forceDelete(AuthUser $authUser, Events $events): bool
    {
        return $authUser->can('ForceDelete:Events');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Events');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Events');
    }

    public function replicate(AuthUser $authUser, Events $events): bool
    {
        return $authUser->can('Replicate:Events');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Events');
    }

}