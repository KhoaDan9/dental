<?php

namespace App\Livewire\Patient;

use App\Models\Employee;
use App\Models\Patient;
use Carbon\Carbon;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;

class MenuPatient extends Component
{
    public ?Patient $patient;
    public $employees = [];

    public $show_search = '';
    public $create_url = '';
    public $exit_url = '';
    public $is_patient_service = '';
    public $is_patient_prescription = '';
    public $is_patient_appointment = '';
    public $is_patient_payment = '';
    public $is_patient_reminder = '';
    public $is_patient_warranty = '';
    public $last_query = '';

    public function searchSubmit()
    {
        if ($this->search_string != '') {
            return $this->dispatch('searchPatient', search_string: $this->search_string);
        } else {
            return $this->dispatch('changeDate', date: $this->search_date);
        }
    }

    public function mount(?Patient $patient)
    {
        $this->search_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

        $this->patient = $patient;
    }

    public function render()
    {
        return view('livewire.patient.menu-patient');
    }
}
