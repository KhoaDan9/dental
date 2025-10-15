<?php

namespace App\Policies;

use App\Models\User;

class PrescriptionPolicy
{
    public function viewAny(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',21)->where('permission_id',1)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }

    public function create(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',21)->where('permission_id',2)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }

    public function update(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',21)->where('permission_id',3)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }

    public function delete(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',21)->where('permission_id',4)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }
}
