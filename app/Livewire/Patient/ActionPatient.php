<?php

namespace App\Livewire\Patient;

use App\Livewire\Forms\PatientForm;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\PatientPayment;
use App\Models\PatientService;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Hồ sơ bệnh nhân')]
class ActionPatient extends Component
{
    public PatientForm $form;
    public Patient $patient;
    public $clinics = [];
    public $successMessage = '';
    public $errorMessage = '';

    public $is_create = '';
    public $debt = '';
    public $total = '';
    public $pay = '';

    public function mount($value)
    {
        $this->clinics = Clinic::all();

        if ($value == 'create') {
            $this->is_create = $value;
            $this->form->birth =  Carbon::parse('2000-01-31')->format('Y-m-d');
        } else {
            $patients = Patient::where('id', $value)->get();
            $this->patient = $patients[0];
            $this->form->setAttributes($patients[0]);

            $total_price = PatientService::where('patient_id', $this->patient->id)->sum('total_price');
            $payments = PatientPayment::where('patient_id', $this->patient->id)->sum('paid');

            $this->debt = $this->convertToString($total_price - $payments);

            $this->total = $this->convertToString($total_price);
            $this->pay = $this->convertToString($payments);
        }
    }

    public function convertToString($value)
    {
        return number_format($value, 0, ',', '.');
    }

    public function save()
    {
        $this->form->validate();

        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = "Thêm thông tin bệnh nhân thành công";
            } else {
                $this->form->update();
                $this->successMessage = 'Chỉnh sửa thông tin bệnh nhân thành công!';
            }
        } catch (QueryException $e) {
            return $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }

    public function saveAndExit()
    {
        $this->save();
        if (!$this->errorMessage) {
            $this->redirect('/patients');
        }
    }

    public function render()
    {

        return view(
            'livewire.patient.action-patient'
        );
    }
}
