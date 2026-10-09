<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\NoticesCirculars;
use Illuminate\Auth\Access\HandlesAuthorization;

class NoticesCircularsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:NoticesCirculars');
    }

    public function view(AuthUser $authUser, NoticesCirculars $noticesCirculars): bool
    {
        return $authUser->can('View:NoticesCirculars');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:NoticesCirculars');
    }

    public function update(AuthUser $authUser, NoticesCirculars $noticesCirculars): bool
    {
        return $authUser->can('Update:NoticesCirculars');
    }

    public function delete(AuthUser $authUser, NoticesCirculars $noticesCirculars): bool
    {
        return $authUser->can('Delete:NoticesCirculars');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:NoticesCirculars');
    }

    public function restore(AuthUser $authUser, NoticesCirculars $noticesCirculars): bool
    {
        return $authUser->can('Restore:NoticesCirculars');
    }

    public function forceDelete(AuthUser $authUser, NoticesCirculars $noticesCirculars): bool
    {
        return $authUser->can('ForceDelete:NoticesCirculars');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:NoticesCirculars');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:NoticesCirculars');
    }

    public function replicate(AuthUser $authUser, NoticesCirculars $noticesCirculars): bool
    {
        return $authUser->can('Replicate:NoticesCirculars');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:NoticesCirculars');
    }

}