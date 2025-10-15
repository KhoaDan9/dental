<?php

namespace App\Livewire\Category\Diagnosis;

use App\Models\DiagnosisGroup;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Nhóm chẩn đoán')]
class IndexDiagnosisGroup extends Component
{
    public $successMessage = '';
    public $errorMessage = '';

    public function deleteDiagnosisGroup(DiagnosisGroup $diagnosis_group)
    {
        $this->reset(['successMessage', 'errorMessage']);

        try {
            $diagnosis_group->delete();
            $this->successMessage = 'Xóa nhóm chẩn đoán thành công!';
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                $this->errorMessage = 'Không thể xóa nhóm chẩn đoán "' . $diagnosis_group->name . '" vì vẫn còn chẩn đoán liên quan!';
            } else
                $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }

    public function render()
    {
        $diagnois_groups = DiagnosisGroup::all();

        return view('livewire.category.diagnosis.index-diagnosis-group', [
            'diagnois_groups' => $diagnois_groups
        ]);
    }
}
