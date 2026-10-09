<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\UpcomingEvents;
use Illuminate\Auth\Access\HandlesAuthorization;

class UpcomingEventsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:UpcomingEvents');
    }

    public function view(AuthUser $authUser, UpcomingEvents $upcomingEvents): bool
    {
        return $authUser->can('View:UpcomingEvents');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:UpcomingEvents');
    }

    public function update(AuthUser $authUser, UpcomingEvents $upcomingEvents): bool
    {
        return $authUser->can('Update:UpcomingEvents');
    }

    public function delete(AuthUser $authUser, UpcomingEvents $upcomingEvents): bool
    {
        return $authUser->can('Delete:UpcomingEvents');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:UpcomingEvents');
    }

    public function restore(AuthUser $authUser, UpcomingEvents $upcomingEvents): bool
    {
        return $authUser->can('Restore:UpcomingEvents');
    }

    public function forceDelete(AuthUser $authUser, UpcomingEvents $upcomingEvents): bool
    {
        return $authUser->can('ForceDelete:UpcomingEvents');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:UpcomingEvents');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:UpcomingEvents');
    }

    public function replicate(AuthUser $authUser, UpcomingEvents $upcomingEvents): bool
    {
        return $authUser->can('Replicate:UpcomingEvents');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:UpcomingEvents');
    }

}