<?php

namespace App\Livewire\Patient;

use App\Livewire\Forms\PatientReminderForm;
use App\Models\Patient;
use App\Models\PatientReminder;
use App\Models\PatientService;
use App\Models\Reminder;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Hồ sơ bệnh nhân')]
class ActionPatientReminder extends Component
{
    public Patient $patient;
    public PatientReminder $patient_reminder;
    public PatientReminderForm $form;
    public $visit_count = '';
    public $reminders = [];
    public $successMessage = '';
    public $errorMessage = '';
    public $error2Message = '';
    public $is_create = '';


    public function mount(Patient $patient, $value)
    {

        $this->patient = $patient;
        $this->form->patient_id = $patient->id;
        $this->visit_count = PatientService::where('patient_id', $this->patient->id)
            ->max('visit_count');
        if ($this->visit_count == null)
            return $this->error2Message = 'Vui lòng thêm thủ thuật điều trị để có thể thêm lời nhắc!';

        $this->reminders = Reminder::where('active', 1)->get();

        if ($value == 'create') {
            $this->is_create = 'create';
            $this->form->visit_count = $this->visit_count;
        } else {
            $this->patient_reminder = PatientReminder::find($value);

            $this->form->setAttributes($this->patient_reminder);
        }
    }

    public function selectReminder(Reminder $reminer)
    {
        $this->form->detail = $reminer->detail;
    }

    public function save()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->form->validate();

        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = "Thêm lời dặn thành công!";
            } else {
                $this->form->update();
                $this->successMessage = "Sửa thông tin lời dặn thành công!";
            }
            $this->dispatch('refreshIndexPatientReminder');
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }

    public function saveAndExit()
    {
        $this->save();
        if (!$this->errorMessage)
            $this->redirect('/patients/' . $this->patient->id);
    }
    public function render()
    {
        return view('livewire.patient.action-patient-reminder');
    }
}
