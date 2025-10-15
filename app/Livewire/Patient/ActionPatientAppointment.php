<?php

namespace App\Livewire\Patient;

use App\Livewire\Forms\PatientAppointmentForm;
use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Patient;
use App\Models\PatientService;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Hồ sơ bệnh nhân')]
class ActionPatientAppointment extends Component
{
    public Patient $patient;
    public Appointment $appointment;
    public PatientAppointmentForm $form;
    public  $employees = [];
    public $visit_counts = [];
    public $successMessage = '';
    public $errorMessage = '';
    public $is_create = '';
    public function mount(Patient $patient, $value)
    {
        $this->patient = $patient;
        $this->visit_counts = PatientService::where('patient_id', $this->patient->id)
            ->groupBy('visit_count')
            ->orderBy('visit_count', 'desc')
            ->pluck('visit_count');

        $this->employees = Employee::where('active', 1)->get();

        if ($value == 'create') {
            $this->is_create = 'create';

            $this->form->date = Carbon::now('Asia/Ho_Chi_Minh')->addDays(3)->setTime(8, 0, 0)->format('Y-m-d H:i');
            $this->form->patient_id = $this->patient->id;
            $this->form->clinic_id = $this->patient->clinic_id;
            $this->form->visit_count = $this->visit_counts[0];
            $this->form->employee_name = $this->employees[0]->name;
        } else {
            $appointment = Appointment::find($value);

            $this->patient = $patient;
            $this->appointment = $appointment;
            $this->form->setAttributes($appointment);
        }
    }

    public function actionAppointment()
    {
        $this->reset(['successMessage', 'errorMessage']);
         try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = "Thêm lịch hẹn thành công!";
            } else {
                $this->form->update();
                $this->successMessage = "Sửa thông tin lịch hẹn thành công!";
            }
            $this->dispatch('refreshIndexPatientAppointment');
         } catch (QueryException $e) {
             $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
         }
    }
    public function render()
    {

        return view('livewire.patient.action-patient-appointment');
    }
}
