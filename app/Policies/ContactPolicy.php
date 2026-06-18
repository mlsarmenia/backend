<?php

namespace App\Policies;

use App\Enum\PublicRole;
use App\Models\Contact;
use App\Models\Role;
use App\Models\User;

class ContactPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->organization || $user->can('View Contact');
    }

    public function viewAll(User $user): bool
    {
        return $user->can('View Contact');
    }

    public function viewFromOrganization(User $user): bool
    {
        return $user->is_organization_admin;
    }

    public function viewOwn(User $user): bool
    {
        return !is_null($user->organization);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->organization || $user->can('Create Contact');
    }

    public function createRenter(User $user): bool
    {
        $roleSlugs = array_column(PublicRole::cases(), 'value');
        $roles = Role::query()->whereIn('slug', $roleSlugs)->get();

        return $user->organization
            || ($user->can('Create Contact') && !$user->hasAnyRole([$roles]));
    }

    public function createRealtor(User $user): bool
    {
        $roleSlugs = array_column(PublicRole::cases(), 'value');
        $roles = Role::query()->whereIn('slug', $roleSlugs)->get();

        return $user->can('Create Contact') && !$user->hasAnyRole([$roles]);
    }

    public function createSeller(User $user): bool
    {
        $roleSlugs = array_column(PublicRole::cases(), 'value');
        $roles = Role::query()->whereIn('slug', $roleSlugs)->get();

        return $user->is_organization_admin
            || ($user->can('Create Contact') && !$user->hasAnyRole([$roles]));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Contact $contact): bool
    {
        if ($user->organization) {
            if ($contact->created_by === $user->id) {
                return true;
            }
        }

        return $user->can('Edit Contact') || $user->is_organization_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->can('Delete Contact') || $user->is_organization_admin;
    }
}
