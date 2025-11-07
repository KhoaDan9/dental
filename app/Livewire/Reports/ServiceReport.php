<?php

namespace App\Livewire\Reports;

use App\Models\ServiceGroup;
use Carbon\Carbon;
use Livewire\Component;

class ServiceReport extends Component
{
    public $data_list;
    public $service_group_id = '';
    public $service_groups;
    public $from_date = '';
    public $to_date = '';

    public function mount()
    {
        $this->from_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $this->to_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $this->service_groups = ServiceGroup::all();

        $this->searchSubmit();
    }

    public function searchSubmit()
    {
        $from_date = Carbon::parse($this->from_date)->startOfDay();
        $to_date = Carbon::parse($this->to_date)->endOfDay();

        $service_groups = ServiceGroup::whereHas('services.patientServices', function ($q) use ($from_date, $to_date) {
            $q->whereBetween('date', [$from_date, $to_date]);
        })->when($this->service_group_id, function ($q) {
            $q->where('id', $this->service_group_id);
        })->with([
            'services.patientServices' => function ($q) use ($from_date, $to_date) {
                $q->whereBetween('date', [$from_date, $to_date]);
            }
        ])->get();

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

        $this->data_list = $service_groups;
    }

    public function render()
    {
        return view('livewire.reports.service-report');
    }
}
