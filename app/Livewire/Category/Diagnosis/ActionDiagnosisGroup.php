<?php

namespace App\Livewire\Category\Diagnosis;

use App\Livewire\Forms\DiagnosisGroupForm;
use App\Models\Clinic;
use App\Models\DiagnosisGroup;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Nhóm chẩn đoán')]
class ActionDiagnosisGroup extends Component
{
    public DiagnosisGroupForm $form;
    public DiagnosisGroup $diagnosis_group;
    public $clinics = [];
    public $is_create = '';
    public $successMessage = '';
    public $errorMessage = '';

    public function mount($value)
    {
        $user = Auth::user();
        $this->clinics = Clinic::all();

        if ($value == 'create') {
            $this->is_create = 'create';
            $this->form->clinic_id = $this->clinics[0]->id;
        } else {
            $this->diagnosis_group = DiagnosisGroup::where('id', $value)->get()[0];
            $this->form->setAttributes($this->diagnosis_group);
        }
    }

    public function actionDiagnosisGroup()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->form->validate();

        $diagnosis_group_id = $this->is_create == 'create' ? 0 : $this->diagnosis_group->id;

        if (DiagnosisGroup::where('name', $this->form->name)->whereNot('id', $diagnosis_group_id)->exists())
            return $this->errorMessage = 'Nhóm chẩn đoán đã tồn tại. Xin vui lòng kiểm tra lại.';

        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = 'Thêm mẫu chẩn đoán thành công';
            } else {
                $this->form->update();
                $this->successMessage = 'Sửa thông tin nhóm chẩn đoán thành công!';
                $this->diagnosis_group = $this->form->diagnosis_group;
            }
        } catch (QueryException $e) {
            return $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }

    public function render()
    {
        return view('livewire.category.diagnosis.action-diagnosis-group');
    }
}
