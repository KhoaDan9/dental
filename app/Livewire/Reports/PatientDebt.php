<?php

namespace App\Livewire\Reports;

use App\Models\Patient;
use App\Models\PatientPayment;
use App\Models\PatientService;
use Livewire\Component;

class PatientDebt extends Component
{
    public $data_list = [];

    public function mount()
    {
        $patient_payments = PatientPayment::get()->groupBy('patient_id')->map(fn($g) => $g->sum('paid'));
        $patient_services = PatientService::get()->groupBy('patient_id')->map(fn($g) => $g->sum('total_price'));
        $patient_list = $patient_services->map(function ($total_price, $patient_id) use ($patient_payments) {
            $paid = $patient_payments[$patient_id] ?? 0;
            $debt = $total_price - $paid;
            return $debt > 0 ? $debt : null;
        })->filter();

        $patients = Patient::whereIn('id', $patient_list->keys())->get();
        $this->data_list = $patients->map(function ($patient) use ($patient_list) {
            $updated_at = PatientService::where('id', $patient->id)->latest('updated_at')->first('updated_at');
            $patient['debt'] = $patient_list[$patient->id];
            $patient['updated_at'] = $updated_at ? $updated_at->updated_at : null;
            return $patient;
        });
        $this->data_list = $this->data_list->sortBy('updated_at');
    }

    public function render()
    {
        return view('livewire.reports.patient-debt');
    }
}
