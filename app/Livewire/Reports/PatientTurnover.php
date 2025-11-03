<?php

namespace App\Livewire\Reports;

use App\Models\Patient;
use App\Models\PatientPayment;
use App\Models\PatientService;
use Livewire\Component;


class PatientTurnover extends Component
{
    public $data_list;
    public $total_from = '1.000.000';
    public $total_to = '100.000.000';


    public function mount()
    {
        $this->searchSubmit();
    }

    public function searchSubmit()
    {
        $patient_payments = PatientPayment::get()->groupBy('patient_id')->map(fn($g) => $g->sum('paid'));

        $total_from = (int) str_replace('.', '', $this->total_from);
        $total_to = (int) str_replace('.', '', $this->total_to);

        $patients_total_price = PatientService::selectRaw('patient_id, SUM(total_price) as total_paid')
            ->groupBy('patient_id')
            ->havingBetween('total_paid', [$total_from, $total_to])
            ->pluck('total_paid', 'patient_id');

        $patients = Patient::whereIn('id', $patients_total_price->keys())->get();

        $this->data_list = $patients->map(function ($patient) use ($patient_payments, $patients_total_price) {
            $updated_at = PatientService::where('id', $patient->id)->latest('updated_at')->first('updated_at');
            $service_groups = PatientService::where('patient_id', $patient->id)
                ->with('service:id,name')
                ->get()
                ->pluck('service.name')
                ->unique()
                ->implode(', ');

            $employees = PatientService::where('patient_id', $patient->id)
                ->with('employee:id,name')
                ->get()
                ->pluck('employee.name')
                ->unique()
                ->implode(', ');


            $patient['total_price'] = $patients_total_price[$patient->id];
            if ($patient_payments->has($patient->id)) {
                $patient['paid'] = $patient_payments[$patient->id];
                $patient['debt'] = $patients_total_price[$patient->id] - $patient_payments[$patient->id];
            } else {
                $patient['paid'] = 0;
                $patient['debt'] = $patients_total_price[$patient->id];
            }
            $patient['updated_at'] = $updated_at ? $updated_at->updated_at : null;
            $patient['service_groups'] = $service_groups;
            $patient['employees'] = $employees;

            return $patient;
        });
        $this->data_list = $this->data_list->sortBy('updated_at');
    }
    public function render()
    {
        return view('livewire.reports.patient-turnover');
    }
}
