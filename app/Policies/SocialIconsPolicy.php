<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SocialIcons;
use Illuminate\Auth\Access\HandlesAuthorization;

class SocialIconsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SocialIcons');
    }

    public function view(AuthUser $authUser, SocialIcons $socialIcons): bool
    {
        return $authUser->can('View:SocialIcons');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SocialIcons');
    }

    public function update(AuthUser $authUser, SocialIcons $socialIcons): bool
    {
        return $authUser->can('Update:SocialIcons');
    }

    public function delete(AuthUser $authUser, SocialIcons $socialIcons): bool
    {
        return $authUser->can('Delete:SocialIcons');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:SocialIcons');
    }

    public function restore(AuthUser $authUser, SocialIcons $socialIcons): bool
    {
        return $authUser->can('Restore:SocialIcons');
    }

    public function forceDelete(AuthUser $authUser, SocialIcons $socialIcons): bool
    {
        return $authUser->can('ForceDelete:SocialIcons');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SocialIcons');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SocialIcons');
    }

    public function replicate(AuthUser $authUser, SocialIcons $socialIcons): bool
    {
        return $authUser->can('Replicate:SocialIcons');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SocialIcons');
    }

}