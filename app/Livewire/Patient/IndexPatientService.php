<?php

namespace App\Livewire\Patient;

use App\Models\PatientService;
use Livewire\Component;

class IndexPatientService extends Component
{
    public $patient_id = '';
    public $successMessage = '';

    protected $listeners = [
        'refreshIndexPatientService' => '$refresh',
    ];

    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;
    }

    public function deletePatientService(PatientService $patient_service)
    {
        $patient_service->delete();
        $this->successMessage = "Xóa thông tin thủ thuật thành công!";
    }

    public function render()
    {

        // $patient_services = PatientService::where('patient_id', $this->patient_id)
        //     ->orderBy('date')
        //     ->get()
        //     ->groupBy(function ($patient_service) {
        //         return $patient_service->date->format('d-m-Y');
        //     })
        //     ->map(function ($group) {
        //         return $group->sortByDesc('date')->map(function ($service) {
        //             return $service;
        //         });
        //     });

        $patient_services = PatientService::where('patient_id', $this->patient_id)
        ->orderBy('visit_count','desc')    
        ->get()
        ->groupBy('visit_count');

        return view(
            'livewire.patient.index-patient-service',
            ['patient_services' => $patient_services]
        );
    }
}
