<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\SalesianSpeak;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class SalesianSpeakPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SalesianSpeak');
    }

    public function view(AuthUser $authUser, SalesianSpeak $salesianSpeak): bool
    {
        return $authUser->can('View:SalesianSpeak');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SalesianSpeak');
    }

    public function update(AuthUser $authUser, SalesianSpeak $salesianSpeak): bool
    {
        return $authUser->can('Update:SalesianSpeak');
    }

    public function delete(AuthUser $authUser, SalesianSpeak $salesianSpeak): bool
    {
        return $authUser->can('Delete:SalesianSpeak');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:SalesianSpeak');
    }

    public function restore(AuthUser $authUser, SalesianSpeak $salesianSpeak): bool
    {
        return $authUser->can('Restore:SalesianSpeak');
    }

    public function forceDelete(AuthUser $authUser, SalesianSpeak $salesianSpeak): bool
    {
        return $authUser->can('ForceDelete:SalesianSpeak');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SalesianSpeak');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SalesianSpeak');
    }

    public function replicate(AuthUser $authUser, SalesianSpeak $salesianSpeak): bool
    {
        return $authUser->can('Replicate:SalesianSpeak');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SalesianSpeak');
    }
}
