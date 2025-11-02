<?php

namespace App\Livewire\Patient;

use App\Livewire\Forms\PatientServiceForm;
use App\Models\Diagnosis;
use App\Models\Employee;
use App\Models\Patient;
use App\Models\PatientService;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Hồ sơ bệnh nhân')]
class ActionPatientService extends Component
{
    public Patient $patient;
    public PatientServiceForm $form;
    public $patient_service = '';
    public $employees = [];
    public $services = [];
    public $diagnoses = [];
    public $is_create = '';
    public $successMessage = '';
    public $errorMessage = '';

    public function mount(Patient $patient, $value)
    {
        $this->patient = $patient;

        $this->form->patient_id = $patient->id;
        $this->employees = Employee::where('active', true)->get();
        $this->services = Service::where('active', true)->get();
        $this->diagnoses = Diagnosis::where('active', true)->get();
        if ($value == 'create') {
            $this->is_create = $value;

            $visit_counts = PatientService::where('patient_id', $this->patient->id)
                ->select('visit_count', 'date')
                ->orderBy('visit_count', 'desc')
                ->get();

            if ($visit_counts->isEmpty()) {
                $this->form->visit_count = 1;
            } elseif ($visit_counts[0]->date->format('Y-m-d') == Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'))
                $this->form->visit_count = $visit_counts[0]->visit_count;
            else
                $this->form->visit_count = $visit_counts[0]->visit_count + 1;

            $this->form->date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i');
            $this->form->employee_id = $this->employees[0]->id;
        } else {
            $patient_services = PatientService::where('id', $value)->get();
            $this->patient_service = $patient_services[0];

            $this->form->setAttributes($patient_services[0]);
        }

        $this->form->employee_id = $this->employees[0]->id;
    }

    public function save()
    {
        $this->form->validate();
        $this->reset(['successMessage', 'errorMessage']);

        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = 'Thêm thủ thuật thành công!';
                $this->dispatch('refreshIndexPatientService');
            } else {
                $this->form->update();

                $this->dispatch('refreshIndexPatientService');
                $this->successMessage = 'Sửa thông tin thủ thuật thành công!';
            }
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }

    public function saveAndExit()
    {
        $this->save();
        if (!$this->errorMessage) {
            $this->redirect('/patients/' . $this->patient->id);
        }
    }

    public function selectService(Service $service)
    {
        $this->form->service_id = $service->id;
        $this->form->service_name = $service->name;

        $this->form->price = $service->price;

        $this->form->total_price = $this->form->quantity * ($this->form->price - $this->form->price * $this->convertToInt($this->form->discount1) / 100);

        $this->form->total_price = $this->convertToString($this->form->total_price);
        $this->form->price = $this->convertToString($this->form->price);

        $this->updatedFormDiscount1();
    }

    public function convertToInt($value)
    {
        return $value = (int) str_replace('.', '', $value);
    }

    public function convertToString($value)
    {
        return number_format($value, 0, ',', '.');
    }

    public function selectDiagnosis(Diagnosis $diagnosis)
    {
        $this->form->diagnosis = $diagnosis->name;
    }

    public function updateTotalPrice()
    {
        if ($this->form->total_price != '') {
            $price = $this->convertToInt($this->form->price);

            $this->form->total_price = $this->convertToString(($price - $price * $this->convertToInt($this->form->discount1) / 100) * $this->form->quantity);
            $this->form->discount2 = $this->convertToString($price * $this->form->quantity - $this->convertToInt($this->form->total_price));
        }
    }
    public function updatedFormDiscount1()
    {
        if (is_numeric($this->form->discount1))
            if ($this->form->discount1 > 100) {
                $this->form->discount2 = $this->form->quantity * $this->convertToInt($this->form->price);
                $this->form->total_price = 0;
            } else $this->updateTotalPrice();
        else {
            $this->updatedFormDiscount2();
        };
    }

    public function updatedFormDiscount2()
    {
        $discount2 = $this->convertToInt($this->form->discount2);
        if (is_numeric($discount2) && $this->form->total_price != '') {
            $default_price = $this->convertToInt($this->form->price) * $this->form->quantity;
            if ($discount2 > $default_price) {
                $this->form->discount1 = 100;
                $this->form->total_price = 0;
            } else {
                $this->form->total_price = $this->convertToString($default_price  - $discount2);

                $discount = (1 - ($default_price - $discount2) / $default_price) * 100;
                $this->form->discount1 = round($discount);
            }
        } else {
            $this->updatedFormDiscount1();
        }
    }

    public function updatedFormQuantity()
    {
        if ($this->form->price)
            $this->updateTotalPrice();
    }

    public function render()
    {

        return view('livewire.patient.action-patient-service');
    }
}
