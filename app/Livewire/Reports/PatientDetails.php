<?php

namespace App\Livewire\Reports;

use App\Models\Patient;
use App\Models\PatientPayment;
use App\Models\PatientService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PatientDetails extends Component
{
    public $from_date = '';
    public $to_date = '';
    public $employee_id = '';
    public $service_group_id = '';
    public $service_id = '';
    public $patien_from = '';
    public $data_list = [];
    public $errorMessage = '';


    public function mount()
    {
        $current_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $this->from_date = Carbon::parse($current_date)->startOfDay();
        $this->to_date = Carbon::parse($current_date)->endOfDay();

        $this->searchPatientDetails();
    }

    public function searchPatientDetails()
    {
        try {
            $patient_services = PatientService::whereBetween('date', [$this->from_date, $this->to_date])
                ->orderBy('updated_at', 'desc')
                ->when($this->service_group_id, function ($q) {
                    $q->whereHas('service.serviceGroup', function ($query) {
                        $query->where('id', $this->service_group_id);
                    });
                })
                ->when($this->service_id, function ($q) {
                    $q->where('service_id', $this->service_id);
                })
                ->get()
                ->groupBy('patient_id');

            $patients_id = $patient_services->keys()->toArray();
        } catch (QueryException $e) {
            return $this->errorMessage = 'Không có thủ thuật nào thực hiện trong ngày này!';
        }

        $patients = Patient::whereIn('id', $patients_id)->when($this->patien_from, function ($q) {
            $q->where('from', $this->patien_from);
        })->get();

        $this->data_list = collect($patients)->map(function ($patient) use ($patient_services) {
            $services = $patient_services[$patient->id] ?? collect();
            $patientData = $patient;
            $patientData['patient-services'] = $services;
            $patientData['sum'] = $patient_services[$patient->id]->sum('total_price');
            $patientData['length'] = count($patient_services[$patient->id]);

            $total_price = PatientService::where('patient_id', $patient->id)->sum('total_price');
            $payments = PatientPayment::where('patient_id', $patient->id)->sum('paid');

            $patientData['paid'] = PatientPayment::whereBetween('date', [$this->from_date, $this->to_date])->where('patient_id', $patient->id)->sum('paid');
            $patientData['debt'] = $total_price - $payments;
            return $patientData;
        });

    }

    public function render()
    {
        return view('livewire.reports.patient-details');
    }
}
