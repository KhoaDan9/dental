<?php

namespace App\Livewire\Forms;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PatientAppointmentForm extends Form
{
    public Appointment $appointment;
    public $patient_id = '';
    public $detail = '';
    public $employee_id = '';
    public $clinic_id = '';
    public $last_update_name = 1;
    public $date = '';
    public $visit_count = '';
    public $note = '';


    public function store()
    {
        Appointment::create([
            'patient_id' => $this->patient_id,
            'detail' => $this->detail,
            'clinic_id' => $this->clinic_id,
            'employee_id' => $this->employee_id,
            'note' => $this->note,
            'date' => $this->date,
            'visit_count' => $this->visit_count,
            'last_update_name' => Auth::user()->username
        ]);
        $this->reset(['detail', 'note']);
    }

    public function setAttributes(Appointment $appointment)
    {
        $this->appointment = $appointment;

        $this->detail = $appointment->detail;
        $this->date = Carbon::parse($appointment->date)->format('Y-m-d H:i');
        $this->clinic_id = $appointment->clinic_id;
        $this->last_update_name = $appointment->last_update_name;
        $this->employee_id = $appointment->employee_id;
        $this->note = $appointment->note;
        $this->visit_count = $appointment->visit_count;
    }

    public function update()
    {
        $this->last_update_name = Auth::user()->username;
        $this->appointment->update(
            $this->only(['detail', 'employee_id', 'date', 'visit_count', 'last_update_name', 'note'])
        );
    }
}
