<?php

namespace App\Livewire\Patient;

use App\Models\PatientPayment;
use Illuminate\Database\QueryException;
use Livewire\Component;

class IndexPatientPayment extends Component
{
    public $patient_id = '';
    public $successMessage = '';
    public $errorMessage = '';

    protected $listeners = [
        'refreshIndexPatientPayment' => '$refresh',
    ];
    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;
    }

    public function deletePatientPayment(PatientPayment $payment)
    {
        try {
            $payment->delete();
            $this->successMessage = 'Xóa thông tin thanh toán thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi xóa thông tin thanh toán. Vui lòng thử lại sau!';
        }
    }
    public function render()
    {
        $patient_payments = PatientPayment::where('patient_id', $this->patient_id)->orderBy('date', 'desc')->get();

        return view(
            'livewire.patient.index-patient-payment',
            ['patient_payments' => $patient_payments]
        );
    }
}
