<?php

namespace App\Livewire\Forms;

use App\Models\PatientReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PatientReminderForm extends Form
{
    public PatientReminder $patient_reminder;
    public $patient_id = '';

    #[Validate('required', message: 'Vui lòng nhập nội dung lời dặn.')]
    public $detail = '';
    public $visit_count = '';
    public $note = '';
    public $last_update_name = '';



    public function store()
    {
        PatientReminder::create([
            'patient_id' => $this->patient_id,
            'detail' => $this->detail,
            'note' => $this->note,
            'visit_count' => $this->visit_count,
            'last_update_name' => Auth::user()->username
        ]);
        $this->reset(['date', 'note', 'payment']);
    }

    public function setAttributes(PatientReminder $patient_reminder)
    {
        $this->patient_reminder = $patient_reminder;

        $this->patient_id = $patient_reminder->patient_id;
        $this->detail = $patient_reminder->detail;
        $this->visit_count = $patient_reminder->visit_count;
        $this->note = $patient_reminder->note;
        $this->last_update_name = $patient_reminder->last_update_name;
    }

    public function update()
    {
        $this->last_update_name = Auth::user()->username;
        $this->patient_reminder->update(
            [
                'detail' => $this->detail,
                'visit_count' => $this->visit_count,
                'note' => $this->note,
                'last_update_name' => Auth::user()->username
            ]
        );
    }
}
