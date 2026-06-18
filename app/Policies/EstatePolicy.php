<?php

namespace App\Policies;

use App\Models\Estate;
use App\Models\User;

class EstatePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->organization || $user->can('View Estate');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->is_organization_admin || $user->can('Create Estate');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Estate $estate): bool
    {
        if ($user->is_organization_admin && $estate->agent) {
            $agentUser = $estate->agent->user;

            if ($agentUser && $agentUser->organization_id === $user->organization_id) {
                return true;
            }
        }

        return $user->can('Edit Estate');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Estate $estate): bool
    {
        if ($user->is_organization_admin && $estate->agent) {
            $agentUser = $estate->agent->user;

            if ($agentUser && $agentUser->organization_id === $user->organization_id) {
                return true;
            }
        }

        return $user->can('Delete Estate');
    }
}
