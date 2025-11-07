<?php

namespace App\Livewire\Reports;

use App\Models\Employee;
use App\Models\ServiceGroup;
use Carbon\Carbon;
use Livewire\Component;

class EmployeeServiceGroup extends Component
{
    public $data_list;
    public $service_group_id = '1';
    public $service_groups;
    public $employee_list;
    public $employee_id = '';
    public $from_date = '';
    public $to_date = '';

    public function mount()
    {
        $this->from_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $this->to_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $this->service_groups = ServiceGroup::all();
        $this->employee_list = Employee::all();

        $this->searchSubmit();
    }

    public function searchSubmit()
    {
        $from_date = Carbon::parse($this->from_date)->startOfDay();
        $to_date = Carbon::parse($this->to_date)->endOfDay();

        $employee_list_data = Employee::whereHas('patientServices', function ($q) use ($from_date, $to_date) {
            $q->whereBetween('date', [$from_date, $to_date]);
        })->when($this->employee_id, function ($q) {
            $q->where('id', $this->employee_id);
        })->when($this->service_group_id, function ($q) {
            $q->whereHas('patientServices.service.serviceGroup', function ($q) {
                $q->where('id', $this->service_group_id);
            });
        })->get();

        foreach ($employee_list_data as $employee) {
            $service_groups = ServiceGroup::whereHas('services.patientServices', function ($q) use ($from_date, $to_date, $employee) {
                $q->whereBetween('date', [$from_date, $to_date])
                    ->where('employee_id', $employee->id);
            })->when($this->service_group_id, function ($q) {
                $q->where('id', $this->service_group_id);
            })->with([
                'services' => function ($q) use ($from_date, $to_date, $employee) {
                    $q->whereHas('patientServices', function ($query) use ($from_date, $to_date, $employee) {
                        $query->whereBetween('date', [$from_date, $to_date])
                            ->where('employee_id', $employee->id);
                    })->with(['patientServices' => function ($query) use ($from_date, $to_date, $employee) {
                        $query->whereBetween('date', [$from_date, $to_date])
                            ->where('employee_id', $employee->id);
                    }]);
                }])->get();

            foreach ($service_groups as $group) {
                foreach ($group->services as $service) {
                    $service->service_count = $service->patientServices->count();
                    $service->patient_count = $service->patientServices->groupBy('patient_id')->count();
                    $service->total_price = $service->patientServices->sum('total_price');
                }
                $group->sum_service_count = $group->services->sum('service_count');
                $group->sum_patient_count = $group->services->sum('patient_count');
                $group->sum_total_price = $group->services->sum('total_price');
            }
            $employee->sum_service_count = $service_groups->sum('sum_service_count');
            $employee->sum_patient_count = $service_groups->sum('sum_patient_count');
            $employee->sum_total_price = $service_groups->sum('sum_total_price');
            $employee->service_groups = $service_groups;
        }

        $this->data_list = $employee_list_data;
    }

    public function render()
    {
        return view('livewire.reports.employee-service-group');
    }
}
