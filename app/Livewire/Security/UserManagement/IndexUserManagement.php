<?php

namespace App\Livewire\Security\UserManagement;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IndexUserManagement extends Component
{
    public $errorMessage = '';
    public $successMessage = '';

    public function deleteUser(User $user)
    {
        try {
            $user->delete();
            $this->successMessage = "Xóa tên đăng nhập thành công!";
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi. Vui lòng thử lại sau!';
        }
    }

    public function render()
    {
        $auth = Auth::user();
        if($auth->admin == 1)
            $users = User::all();
        else
            $users = User::where('clinic_id', $auth->clinic_id)->get();
        return view('livewire.security.user-management.index-user-management', [
            'users' => $users
        ]);
    }
}
