<?php

namespace App\Livewire\Security\UserManagement;

use App\Models\AccessControl;
use App\Models\Feature;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\QueryException;
use Livewire\Component;

class UserPermission extends Component
{
    public User $user;
    public $successMessage = '';
    public $errorMessage = '';
    public $changedAccessControls = [];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function updateAccess($value)
    {
        if (in_array($value, $this->changedAccessControls)) {
            $this->changedAccessControls = array_diff($this->changedAccessControls, [$value]);
        } else {
            $this->changedAccessControls[] = $value;
        }
    }

    public function updateUserPermissions()
    {
        $this->reset(['successMessage', 'errorMessage']);
        try {
            foreach ($this->changedAccessControls as $access_control_id) {
                $access = AccessControl::find($access_control_id);
                if ($access->user_permission == 1) {
                    $access->user_permission = 0;
                } else
                    $access->user_permission = 1;
                $access->save();
            }
            $this->changedAccessControls = [];

            $this->successMessage = "Chỉnh sửa quyền truy cập của tài khoản thành công!";
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }

    public function render()
    {
        $user_permissions = AccessControl::with(['feature', 'permission'])->where('user_id', $this->user->id)->get()
            ->groupBy(function ($item) {
                return $item->feature->category;
            })->map(function ($item) {
                return $item->groupBy('feature_id');
            });

//        dd($user_permissions);
        return view('livewire.security.user-management.user-permission', [
            'user_permissions' => $user_permissions
        ]);
    }
}
