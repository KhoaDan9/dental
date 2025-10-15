<?php

namespace App\Livewire\System;

use App\Models\Clinic;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class ActionClinic extends Component
{
    use WithFileUploads;
    public $photo;

    public Clinic $clinic;

    #[Validate('required', message: 'Vui lòng nhập ID phòng khám.')]
    public $clinic_id = '';

    #[Validate('required', message: 'Vui lòng nhập tên phòng khám.')]
    public $name = '';

    public $address = '';
    public $phone = '';
    public $email = '';
    public $website = '';
    public $active = '';
    public $bank_account_number = '';
    public $license = '';
    public $city = '';
    public $commune = '';
    public $last_update_name = '';
    public $logo_path = '';
    public $note = '';
    public $updated_at = '';

    public $successMessage = '';
    public $errorMessage = '';

    public function mount(Clinic $clinic)
    {
        $this->clinic = $clinic;

        $this->clinic_id = $clinic->id;
        $this->name = $clinic->name;
        $this->address = $clinic->address;
        $this->phone = $clinic->phone;
        $this->commune = $clinic->commune;
        $this->email = $clinic->email;
        $this->website = $clinic->website;
        $this->active = $clinic->active;
        $this->bank_account_number = $clinic->bank_account_number;
        $this->license = $clinic->license;
        $this->city = $clinic->city;
        $this->note = $clinic->note;
        $this->last_update_name = $clinic->last_update_name;
        $this->logo_path = $clinic->logo_path;
        $this->updated_at = $clinic->updated_at;
    }

    public function updateClinic()
    {
        $this->validate();
        if (Clinic::where('id', $this->clinic->id)->count() != 1)
            return $this->errorMessage = 'ID phòng khám đã tồn tại. Xin vui lòng kiểm tra lại.';


        try {
            if ($this->photo)
                $this->logo_path = $this->photo->storePublicly('photos', ['disk' => 'public']);

            $this->last_update_name = Auth::user()->username;

            $this->clinic->update([
                'id' => $this->clinic_id,
                'name' => $this->name,
                'address' => $this->address,
                'phone' => $this->phone,
                'commune' => $this->commune,
                'email' => $this->email,
                'website' => $this->website,
                'active' => $this->active,
                'bank_account_number' => $this->bank_account_number,
                'license' => $this->license,
                'city' => $this->city,
                'last_update_name' => $this->last_update_name,
                'logo_path' => $this->logo_path,
                'note' => $this->note,
                'updated_at' => $this->updated_at,
            ]);

            $this->successMessage = "Chỉnh sửa thông tin phòng khám thành công!";
//            return redirect('/clinics/'. $this->clinic_id);
        }
        catch (QueryException $exception){
            $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }

    }

    public function render()
    {
        return view('livewire.system.action-clinic');
    }
}
