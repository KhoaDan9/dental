<?php

namespace App\Livewire\System;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Validate;

class UpdatePassword extends Component
{
    #[Validate('required', message: 'Vui lòng nhập mật khẩu cũ.')]
    public $old_password = '';

    #[Validate('required', message: 'Vui lòng nhập mật khẩu mới')]
    #[Validate('min:6', message: 'Mật khẩu phải có ít nhất 6 kí tự.')]

    public $new_password = '';

    #[Validate('required', message: 'Vui lòng nhập lại mật khẩu mới.')]
    #[Validate('same:new_password', message: 'Không trùng khớp với mật khẩu mới.')]
    public $new_password_confirm = '';

    public $successMessage = '';
    public $errorMessage = '';

    public function updatePassword()
    {
        $this->validate();
        $this->errorMessage = '';

        if (!Hash::check($this->old_password, Auth::user()->password)) {
            return $this->errorMessage = 'Mật khẩu cũ không chính xác!';
        }

        Auth::user()->update([
            'password' => Hash::make($this->new_password),
        ]);
        $this->successMessage = "Thay đổi mật khẩu thành công!";
    }
    public function render()
    {
        return view('livewire.system.update-password');
    }
}
