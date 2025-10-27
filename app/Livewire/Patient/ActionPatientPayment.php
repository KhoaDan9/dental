<?php

namespace App\Livewire\Patient;

use App\Livewire\Forms\PatientPaymentForm;
use App\Models\Employee;
use App\Models\FundingSource;
use App\Models\Patient;
use App\Models\PatientPayment;
use App\Models\PatientService;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Hồ sơ bệnh nhân')]
class ActionPatientPayment extends Component
{
    public Patient $patient;
    public PatientPaymentForm $form;
    public $employees = [];
    public $visit_counts = [];
    public $funding_sources = [];
    public $successMessage = '';
    public $errorMessage = '';
    public $error2Message = '';
    public $transactionVoucerErrorMessage = '';
    public $is_create = '';
    public $debt = '';
    public $total = '';
    public $pay = '';

    public function mount(Patient $patient, $value)
    {
        $this->patient = $patient;

        $this->visit_counts = PatientService::where('patient_id', $this->patient->id)
            ->groupBy('visit_count')
            ->orderBy('visit_count', 'desc')
            ->pluck('visit_count');

        if(count($this->visit_counts) == 0)
            return $this->error2Message = 'Vui lòng thêm thủ thuật điều trị để có thể thêm thanh toán!';

        $pay_employee_name = PatientService::where('patient_id', $this->patient->id)->groupBy('employee_name')->get('employee_name');
        $this->employees = Employee::where('active', 1)->whereIn('name', $pay_employee_name->toArray())->get();
        $this->form->clinic_id = $this->patient->clinic_id;
        $this->form->patient_id = $this->patient->id;


        $this->getAllPayment();

        if ($value == 'create') {
            $this->is_create = 'create';
            $this->form->date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i');
            $this->form->employee_name = $this->employees[0]->name;
            $this->form->visit_count = $this->visit_counts[0];
        } else {
            $patient_payment = PatientPayment::find($value);
            $this->form->setAttributes($patient_payment);
        }
        $this->updatedFormTypeOfTransaction();
    }

    public function updatedFormTypeOfTransaction()
    {
        $this->funding_sources = FundingSource::whereJsonContains('type_of_transaction', $this->form->type_of_transaction)->where('active', 1)->get();
        if (count($this->funding_sources) > 0)
            $this->form->funding_source_id = $this->funding_sources[0]->id;
        else
            $this->transactionVoucerErrorMessage = 'Hiện đang không có nguồn quỹ liên quan!';
    }

    public function convertToString($value)
    {
        return number_format($value, 0, ',', '.');
    }

    public function getAllPayment()
    {
        $total_price = PatientService::where('patient_id', $this->patient->id)->sum('total_price');
        $payments = PatientPayment::where('patient_id', $this->patient->id)->sum('paid');

        $this->debt = $this->convertToString($total_price - $payments);
        $this->total = $this->convertToString($total_price);
        $this->pay = $this->convertToString($payments);

        $this->form->paid = $this->debt;
    }

    public function actionPayment()
    {
        $this->reset(['successMessage', 'errorMessage', 'transactionVoucerErrorMessage']);
        $this->form->validate();

        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = "Thêm thông tin thanh toán thành công!";
            } else {
                $this->form->update();
                $this->successMessage = "Sửa thông tin thanh toán thành công!";
            }
            $this->getAllPayment();
            $this->dispatch('refreshIndexPatientPayment');
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }
    public function render()
    {
        return view(
            'livewire.patient.action-patient-payment'
        );
    }
}
