<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\FlashNews;
use Illuminate\Auth\Access\HandlesAuthorization;

class FlashNewsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:FlashNews');
    }

    public function view(AuthUser $authUser, FlashNews $flashNews): bool
    {
        return $authUser->can('View:FlashNews');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:FlashNews');
    }

    public function update(AuthUser $authUser, FlashNews $flashNews): bool
    {
        return $authUser->can('Update:FlashNews');
    }

    public function delete(AuthUser $authUser, FlashNews $flashNews): bool
    {
        return $authUser->can('Delete:FlashNews');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:FlashNews');
    }

    public function restore(AuthUser $authUser, FlashNews $flashNews): bool
    {
        return $authUser->can('Restore:FlashNews');
    }

    public function forceDelete(AuthUser $authUser, FlashNews $flashNews): bool
    {
        return $authUser->can('ForceDelete:FlashNews');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:FlashNews');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:FlashNews');
    }

    public function replicate(AuthUser $authUser, FlashNews $flashNews): bool
    {
        return $authUser->can('Replicate:FlashNews');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:FlashNews');
    }

}