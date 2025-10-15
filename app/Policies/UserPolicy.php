<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',37)->where('permission_id',1)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }


    public function view(User $user, User $model): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',37)->where('permission_id',1)->first()->user_permission == '1') {
            return $model->id == $user->id;
        }
        return false;
    }

    public function create(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',37)->where('permission_id',2)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }

    public function update(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',37)->where('permission_id',3)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }

    public function delete(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',37)->where('permission_id',4)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }

    // cấp quyền đổi mật khẩu
    public function viewAccount(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',2)->where('permission_id',1)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }

    public function viewDataLogs(User $user): bool
    {
        if ($user->admin == 1 || $user->accessControls()->where('feature_id',38)->where('permission_id',1)->first()->user_permission == '1') {
            return true;
        }
        return false;
    }

}
