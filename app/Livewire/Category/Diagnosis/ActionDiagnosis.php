<?php

namespace App\Livewire\Category\Diagnosis;

use App\Livewire\Forms\DiagnosisForm;
use App\Models\Clinic;
use App\Models\Diagnosis;
use App\Models\DiagnosisGroup;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Mẫu chẩn đoán')]
class ActionDiagnosis extends Component
{
    public DiagnosisForm $form;
    public Diagnosis $diagnosis;
    public $successMessage = '';
    public $errorMessage = '';
    public $is_create = '';
    public $clinics = [];
    public $diagnosis_groups = [];

    public function mount($value)
    {
        $user = Auth::user();
        $this->clinics = Clinic::all();

        $this->diagnosis_groups = DiagnosisGroup::all();

        if (count($this->diagnosis_groups) == 0)
            return $this->errorMessage = 'Không thể thêm mẫu chẩn đoán do chưa có nhóm chẩn đoán. Xin vui lòng tạo nhóm chẩn đoán mới.';

        if ($value == 'create') {
            $this->is_create = 'create';
            $this->form->clinic_id = $this->clinics[0]->id;
            $this->form->diagnosis_group_id = $this->diagnosis_groups[0]->id;
        } else {
            $this->diagnosis = Diagnosis::where('id', $value)->get()[0];
            $this->form->setAttributes($this->diagnosis);
        }
    }

    public function actionDiagnosis()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->form->validate();

        $diagnosis_id = $this->is_create == 'create' ? 0 : $this->diagnosis->id;

        if (Diagnosis::where('name', $this->form->name)->whereNot('id', $diagnosis_id)->exists())
            return $this->errorMessage = 'Mẫu chẩn đoán đã tồn tại. Xin vui lòng kiểm tra lại.';

        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = 'Thêm mẫu chẩn đoán thành công';
            } else {
                $this->form->update();
                $this->diagnosis = $this->form->diagnosis;
                $this->successMessage = 'Sửa thông tin chẩn đoán thành công!';
            }
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }

    public function render()
    {
        return view(
            'livewire.category.diagnosis.action-diagnosis'
        );
    }
}
