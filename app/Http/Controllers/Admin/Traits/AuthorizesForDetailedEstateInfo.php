<?php

namespace App\Http\Controllers\Admin\Traits;

use App\Models\Estate;
use App\Models\User;

trait AuthorizesForDetailedEstateInfo
{
    private function canViewDetailedInfo(User $user, Estate $estate): bool
    {
        if ($user->can('View Estate')) {
            return true;
        }

        if ($estate->agent_id) {
            $agentUser = $estate->agent->user;

            if ($estate->agent_id === $user->realtor_user_id) {
                return true;
            }

            if ($user->is_organization_admin && $agentUser && $agentUser->organization_id === $user->organization_id) {
                return true;
            }
        }

        return false;
    }
}
