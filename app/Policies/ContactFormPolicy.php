<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ContactForm;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactFormPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ContactForm');
    }

    public function view(AuthUser $authUser, ContactForm $contactForm): bool
    {
        return $authUser->can('View:ContactForm');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ContactForm');
    }

    public function update(AuthUser $authUser, ContactForm $contactForm): bool
    {
        return $authUser->can('Update:ContactForm');
    }

    public function delete(AuthUser $authUser, ContactForm $contactForm): bool
    {
        return $authUser->can('Delete:ContactForm');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ContactForm');
    }

    public function restore(AuthUser $authUser, ContactForm $contactForm): bool
    {
        return $authUser->can('Restore:ContactForm');
    }

    public function forceDelete(AuthUser $authUser, ContactForm $contactForm): bool
    {
        return $authUser->can('ForceDelete:ContactForm');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ContactForm');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ContactForm');
    }

    public function replicate(AuthUser $authUser, ContactForm $contactForm): bool
    {
        return $authUser->can('Replicate:ContactForm');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ContactForm');
    }

}