<?php

namespace App\Livewire\Reports;

use App\Models\Employee;
use App\Models\Patient;
use App\Models\PatientPayment;
use App\Models\PatientService;
use Carbon\Carbon;
use Livewire\Component;

class EmployeeReport extends Component
{
    public $data_list;

    public $employee_id;
    public $employee_list;
    public $from_date;
    public $to_date;

    public function mount()
    {
        $this->from_date = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->format('Y-m-d');
        $this->to_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $this->employee_list = Employee::all();

        $this->searchSubmit();
    }

    public function searchSubmit()
    {
        $from_date = Carbon::parse($this->from_date)->startOfDay();
        $to_date = Carbon::parse($this->to_date)->endOfDay();

        $employee_list = Employee::whereHas('patientServices', function ($query) use ($from_date, $to_date) {
            $query->whereBetween('date', [$from_date, $to_date]);
        })->when($this->employee_id, function ($q) {
            $q->where('id', $this->employee_id);
        })->get();

        foreach ($employee_list as $employee) {
            $patient_ids = PatientService::whereBetween('date', [$from_date, $to_date])->groupby('patient_id')->pluck('patient_id')->toArray();

            $patient_paids = PatientPayment::whereIn('patient_id', $patient_ids)
                ->get()
                ->groupBy('patient_id')
                ->map(fn($group) => $group->sum('paid'));


            $patient_debts = PatientService::whereIn('patient_id', $patient_ids)
                ->get()
                ->groupBy('patient_id')
                ->map(function($group, $patient_id) use ($patient_paids) {
                    $paid = $patient_paids[$patient_id] ?? 0;
                    $debt = $group->sum('total_price') - $paid;
                    return $debt;
                });

            $patient_services = PatientService::where('employee_id', $employee->id)
                ->whereBetween('date', [$from_date, $to_date])
                ->with('patient', 'service')
                ->orderBy('updated_at', 'desc')
                ->get()
                ->groupBy('patient_id')
                ->map(function ($services, $patient_id) use ($patient_paids, $patient_debts) {
                    $patient = $services->first()->patient;
                    $total_price = $services->sum('total_price');
                    $paid = PatientPayment::where('patient_id', $patient_id)->sum('paid');
                    $debt = $patient_debts[$patient_id];

                    return [
                        'patient' => $patient,
                        'services' => $services,
                        'total_price' => $total_price,
                        'paid' => $paid,
                        'debt' => $debt,
                    ];
                });

            $employee->data = $patient_services;
            $employee->sum_total_price = $employee->data->sum('total_price');
            $employee->sum_paid = $employee->data->sum('paid');
            $employee->sum_debt = $employee->data->sum('debt');

        }

        $this->data_list = $employee_list;

//
//        $employee_services = PatientService::whereBetween('date', [$from_date, $to_date])->orderBy('updated_at', 'desc')->when($this->employee_id, function ($q) {
//            $q->where('employee_id', $this->employee_id);
//        })->get()->groupBy(['employee_id', 'patient_id']);
//        foreach ($employee_services as $employee_id => $employee) {
//            foreach ($employee as $patient_id => $patient_services) {
//                $patient_paid = PatientPayment::where('patient_id', $patient_id)->get()->sum('paid');
//                $patient = Patient::find($patient_id);
//                $patient_services->clinic_id = $patient->clinic_id;
//                $patient_services->id = $patient->id;
//                $patient_services->name = $patient->name;
//                $patient_services->address = $patient->address;
//                $patient_services->phone = $patient->phone;
//                $patient_services->birth = $patient->birth;
//                $patient_services->gender = $patient->gender;
//                $patient_services->sum_total_price = $patient_services->sum('total_price');
//                $patient_services->sum_paid = $patient_paid;
//                $patient_services->sum_debt = $patient_services->sum_total_price - $patient_services->sum_paid;
//            }
//            $employee->id = $employee_id;
//            $employee->name = Employee::find($employee_id)->name;
//            $employee->sum_total_price = $employee->sum('sum_total_price');
//            $employee->sum_paid = $employee->sum('sum_paid');
//            $employee->sum_debt = $employee->sum('sum_debt');
//        }
//        $this->data_list = $employee_services;
//        dd($this->data_list);
    }

    public function render()
    {
        return view('livewire.reports.employee-report');
    }
}
