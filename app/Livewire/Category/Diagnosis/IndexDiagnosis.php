<?php

namespace App\Livewire\Category\Diagnosis;

use App\Models\Diagnosis;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Mẫu chẩn đoán')]
class IndexDiagnosis extends Component
{
    public $successMessage = '';
    public $errorMessage = '';

    public function deleteDiagnosis(Diagnosis $diagnosis)
    {
        $this->reset(['successMessage', 'errorMessage']);

        try {
            $diagnosis->delete();
            $this->successMessage = 'Xóa chẩn đoán thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }
    public function render()
    {
        $diagnoses = Diagnosis::all();
        return view('livewire.category.diagnosis.index-diagnosis', [
            'diagnoses' => $diagnoses
        ]);
    }
}
