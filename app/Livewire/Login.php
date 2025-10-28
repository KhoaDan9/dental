<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Đăng nhập')]
class Login extends Component
{
    #[Validate('required', message: 'Vui lòng nhập tài khoản.')]
    public $username = '';

    #[Validate('required', message: 'Vui lòng nhập mật khẩu.')]
    public $password = '';

    public $errorMessage = '';

    public function login(){
        $this->validate();
        $credentials = ['username' => $this->username, 'password' => $this->password];
        if(Auth::attempt($credentials)){
            if(Auth::user()->active == 0)
            {
                Auth::logout();
                return $this->errorMessage = 'Tài khoản hiện đang bị khóa, xin liên hệ với admin.';
            }

            return redirect()->intended('/patients');
        }
        else
            $this->errorMessage = 'Tài khoản hoặc mật khẩu không chính xác! Xin vui lòng thử lại.';
    }
    public function render()
    {
        return view('livewire.login')
            ->layout('components.layouts.admin');
    }
}
