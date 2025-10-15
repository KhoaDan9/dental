<?php

namespace App\Livewire\Forms;

use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PatientForm extends Form
{
    public Patient $patient;

    #[Validate('required', message: 'Vui lòng nhập tên khách hàng.')]
    public $name = '';
    public $birth = '';
    public $phone = '';
    public $from = 'Khác';
    public $from_note = '';
    public $medical_history = [];
    public $medical_history_note = '';
    public $medical_examination = '';
    
    #[Validate('required', message: 'Vui lòng nhập địa chỉ.')]
    public $address = '';
    public $commune = '';
    public $city = '';
    public $note = '';
    public $gender = 'Nữ';
    public $last_update_name = '';

    public function store()
    {

        $patient = Patient::create([
            'name' =>  $this->name,
            'clinic_id' => Auth::user()->clinic_id,
            // 'employee_id' => 1,
            'birth' => $this->birth,
            'phone' => $this->phone,
            'from' => $this->from,
            'city' => $this->city,
            'commune' => $this->commune,
            'from_note' => $this->from_note,
            'medical_history' => $this->medical_history,
            'medical_history_note' => $this->medical_history_note,
            'medical_examination' => 'Đăng kí khám lần đầu',
            'address' => $this->address,
            'note' => $this->note,
            'gender' => $this->gender,
            'patient_status' => 'Đang chờ',
            'last_update_name' => Auth::user()->username
        ]);

        return redirect('/patients/'.$patient->id);
    }

    public function update()
    {
        $this->last_update_name = Auth::user()->username;
        $this->patient->update(
            $this->only(['birth', 'phone', 'from_note', 'medical_history', 'commune','city', 'medical_history_note', 'address', 'note', 'name', 'last_update_name'])
        );
    }

    public function setAttributes(Patient $patient)
    {
        $this->patient = $patient;

        $this->name = $patient->name;
        $this->birth = $patient->birth;
        $this->phone = $patient->phone;
        $this->from = $patient->from;
        $this->from_note = $patient->from_note;
        $this->medical_history = $patient->medical_history ?? [];
        $this->medical_history_note = $patient->medical_history_note;
        $this->medical_examination = $patient->medical_examination;
        $this->address = $patient->address;
        $this->commune = $patient->commune;
        $this->city = $patient->city;
        $this->note = $patient->note;
        $this->gender = $patient->gender;
        $this->last_update_name = $patient->last_update_name;

    }
}
