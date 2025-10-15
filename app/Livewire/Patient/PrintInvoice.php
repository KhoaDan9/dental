<?php

namespace App\Livewire\Patient;

use App\Models\Clinic;
use App\Models\Patient;
use App\Models\PatientPayment;
use App\Models\PatientPrescription;
use App\Models\PatientReminder;
use App\Models\PatientService;
use Livewire\Component;

class PrintInvoice extends Component
{
    public Patient $patient;
    public Clinic $clinic;
    public $visit_counts = [];
    public $patient_services = [];
    public $patient_payments = [];
    public $from_visit_count = 0;
    public $to_visit_count = 0;
    public $total_price = '';
    public $total_current_price = '';
    public $before_paid = '';
    public $current_paid = '';
    public $debt = '';
    public $final_debt = '';
    public $reminder = '';
    public $prescription = '';

    public function mount(Patient $patient)
    {
        $this->visit_counts = PatientService::select('visit_count')->where('patient_id', $patient->id)->groupBy('visit_count')->orderBy('visit_count', 'desc')
            ->pluck('visit_count');

        $this->from_visit_count = $this->to_visit_count = $this->visit_counts[0];

        $this->clinic = Clinic::find($patient->clinic_id);
        $this->seachInvoice();
    }

    public function seachInvoice()
    {
        $this->patient_services = PatientService::where('patient_id', $this->patient->id)->whereBetween('visit_count', [
            $this->from_visit_count,
            $this->to_visit_count
        ])->orderBy('visit_count')->get();

        $this->total_price = PatientService::where('patient_id', $this->patient->id)->sum('total_price');

        $this->total_current_price = PatientService::where('patient_id', $this->patient->id)->whereBetween('visit_count', [
            $this->from_visit_count,
            $this->to_visit_count
        ])->sum('total_price');

        $this->patient_payments = PatientPayment::where('patient_id', $this->patient->id)->whereBetween('visit_count', [
            $this->from_visit_count,
            $this->to_visit_count
        ])
            ->orderBy('date', 'desc')->get();

        $this->before_paid =  PatientPayment::where('patient_id', $this->patient->id)->whereNotBetween('visit_count', [
            $this->from_visit_count,
            $this->to_visit_count
        ])->sum('paid');

        $this->current_paid =  PatientPayment::where('patient_id', $this->patient->id)->whereBetween('visit_count', [
            $this->from_visit_count,
            $this->to_visit_count
        ])->sum('paid');

        $this->debt = $this->total_price - $this->total_current_price - $this->before_paid;

        $this->final_debt = $this->total_price - $this->before_paid - $this->current_paid;

        $reminder = PatientReminder::select('detail')->where('patient_id', $this->patient->id)->whereBetween('visit_count', [
            $this->from_visit_count,
            $this->to_visit_count
        ])->orderBy('visit_count', 'desc')->orderBy('created_at', 'desc')->pluck('detail');


        if (count($reminder) != 0)
            $this->reminder = $reminder[0];
        else
            $this->reminder = '';
            
        $prescription = PatientPrescription::select('detail')->where('patient_id', $this->patient->id)->whereBetween('visit_count', [
            $this->from_visit_count,
            $this->to_visit_count
        ])->orderBy('visit_count', 'desc')->orderBy('created_at', 'desc')->pluck('detail');

        if (count($prescription) != 0)
            $this->prescription = $prescription[0];
        else
            $this->prescription = '';
    }


    public function render()
    {
        return view('livewire.patient.print-invoice');
    }
}
