<?php

namespace App\Livewire\Category\Prescription;

use App\Models\Prescription;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Mẫu đơn thuốc')]
class IndexPrescription extends Component
{
    public $successMessage = '';
    public $errorMessage = '';

    public function deletePrescription(Prescription $prescription)
    {
        $this->reset(['successMessage', 'errorMessage']);

        try {
            $prescription->delete();
            $this->successMessage = 'Xóa mẫu đơn thuốc thành công!';
        } catch (QueryException $e) {
            return $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }
    public function render()
    {
        $prescriptions = Prescription::all();

        return view('livewire.category.prescription.index-prescription', [
            'prescriptions' => $prescriptions
        ]);
    }
}
