<?php

namespace App\Livewire\Forms;

use App\Models\PatientPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PatientPaymentForm extends Form
{
    public PatientPayment $patient_payment;
    public $clinic_id = '';
    public $patient_id = '';
    public $funding_source_id = '';
    public $type_of_transaction = 'Tiền mặt';
    public $detail = 'Thanh toán tiền làm dịch vụ, thủ thuật';

    #[Validate('required', message: 'Vui lòng nhập số tiền.')]
    public $paid = '';
    public $employee_name = '';
    public $last_update_name = '';
    public $date = '';
    public $visit_count = '';
    public $note = '';


    public function store()
    {
        PatientPayment::create([
            'clinic_id' => $this->clinic_id,
            'patient_id' => $this->patient_id,
            'detail' => $this->detail,
            'paid' => (int) str_replace('.', '', $this->paid),
            'employee_name' => $this->employee_name,
            'funding_source_id' => $this->funding_source_id,
            'type_of_transaction' => $this->type_of_transaction,
            'note' => $this->note,
            'date' => $this->date,
            'visit_count' => $this->visit_count,
            'last_update_name' => Auth::user()->username
        ]);
        $this->reset([ 'note', 'paid']);
    }

    public function setAttributes(PatientPayment $patient_payment)
    {
        $this->patient_payment = $patient_payment;

        $this->clinic_id = $patient_payment->clinic_id;
        $this->patient_id = $patient_payment->patient_id;
        $this->detail = $patient_payment->detail;
        $this->paid = number_format($patient_payment->paid, 0, ',', '.');
        $this->date = Carbon::parse($patient_payment->date)->format('Y-m-d H:i');
        $this->employee_name = $patient_payment->employee_name;
        $this->type_of_transaction = $patient_payment->type_of_transaction;
        $this->funding_source_id = $patient_payment->funding_source_id;
        $this->visit_count = $patient_payment->visit_count;
        $this->note = $patient_payment->note;
        $this->last_update_name = $patient_payment->last_update_name;
    }

    public function update()
    {
        $this->patient_payment->update(
            [
                'detail' => $this->detail,
                'paid' => (int) str_replace('.', '', $this->paid),
                'employee_name' => $this->employee_name,
                'type_of_transaction' => $this->type_of_transaction,
                'funding_source_id' => $this->funding_source_id,
                'note' => $this->note,
                'date' => $this->date,
                'visit_count' => $this->visit_count,
                'last_update_name' => Auth::user()->username
            ]
        );
    }
}
