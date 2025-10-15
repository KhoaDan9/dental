<?php

namespace App\Policies;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class PatientPolicy
{
    public function before($user, $ability)
    {

    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',7)->where('permission_id',1)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Patient $patient): bool
    {

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',7)->where('permission_id',2)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',7)->where('permission_id',3)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',7)->where('permission_id',4)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }

    public function printInvoice(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',16)->where('permission_id',6)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Patient $patient): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Patient $patient): bool
    {
        return false;
    }
}
