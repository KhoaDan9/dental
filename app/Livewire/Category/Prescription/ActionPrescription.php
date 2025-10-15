<?php

namespace App\Livewire\Category\Prescription;

use App\Livewire\Forms\PrescriptionForm;
use App\Models\Clinic;
use App\Models\Prescription;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Mẫu đơn thuốc')]
class ActionPrescription extends Component
{
    public PrescriptionForm $form;
    public Prescription $prescription;
    public $clinics = [];
    public $successMessage = '';
    public $errorMessage = '';
    public $is_create = '';

    public function mount($value)
    {
        $this->clinics = Clinic::all();

        if ($value == 'create') {
            $this->is_create = 'create';
            $this->form->clinic_id = $this->clinics[0]->id;
        } else {
            $this->prescription = Prescription::where('id', $value)->get()[0];
            $this->form->setAttributes($this->prescription);
        }
    }

    public function actionPrescription()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->form->validate();

        $prescription_id = $this->is_create == 'create' ? 0 : $this->prescription->id;

        if (Prescription::where('name', $this->form->name)->whereNot('id', $prescription_id)->exists())
            return $this->errorMessage = 'Tên đơn thuốc đã tồn tại. Xin vui lòng kiểm tra lại.';

        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = 'Thêm mẫu đơn thuốc thành công!';
            } else {
                $this->form->update();
                $this->successMessage = 'Sửa thông tin mẫu đơn thuốc thành công!';
                $this->prescription = $this->form->prescription;
            }
        } catch (QueryException $e) {
            return $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }

    public function render()
    {
        return view('livewire.category.prescription.action-prescription');
    }
}
