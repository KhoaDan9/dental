<?php

namespace App\Livewire\Supplier;

use App\Livewire\Forms\SupplierForm;
use App\Models\Clinic;
use App\Models\Supplier;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActionSupplier extends Component
{
    public SupplierForm $form;
    public $clinics = [];
    public $successMessage = '';
    public $errorMessage = '';
    public $is_create = '';

    public function mount($value)
    {
        $this->clinics = Clinic::all();

        if ($value == 'create') {
            $this->is_create = $value;
            $this->form->clinic_id = $this->clinics[0]->id;
        } else {
            $supplier = Supplier::where('id', $value)->get();
            $this->form->setAttributes($supplier[0]);
        }
    }
    public function actionSupplier()
    {
        $this->form->validate();
        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = 'Thêm nhà cung cấp thành công!';
            } else {
                $this->form->update();
                $this->successMessage = 'Chỉnh sửa thông tin nhà cung cấp thành công!';
            }
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi thay đổi thông tin nhà cung cấp! Vui lòng liên hệ với chúng tôi!';
        }
    }
    public function render()
    {
        return view('livewire.supplier.action-supplier');
    }
}
