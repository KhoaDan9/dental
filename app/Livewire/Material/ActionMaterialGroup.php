<?php

namespace App\Livewire\Material;

use App\Livewire\Forms\MaterialGroupForm;
use App\Models\Clinic;
use App\Models\MaterialGroup;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Nhóm vật tư')]
class ActionMaterialGroup extends Component
{
    public MaterialGroup $material_group;
    public MaterialGroupForm $form;
    public $is_create = '';
    public $clinics = [];
    public $successMessage = '';
    public $errorMessage = '';


    public function mount($value)
    {
        $user = Auth::user();
        $this->clinics = Clinic::all();

        if ($value == 'create') {
            $this->is_create = $value;
            $this->form->clinic_id = $this->clinics[0]->id;
        } else {
            $this->material_group = MaterialGroup::where('id', $value)->get()[0];
            $this->form->setAttributes($this->material_group);
        }
    }

    public function actionMaterialGroup()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->form->validate();

        $material_group_id = $this->is_create == 'create' ? 0 : $this->material_group->id;

        if (MaterialGroup::where('name', $this->form->name)->whereNot('id', $material_group_id)->exists())
            return $this->errorMessage = 'Nhóm vật tư đã tồn tại. Xin vui lòng kiểm tra lại.';

        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = 'Thêm nhóm vật tư thành công!';
            } else {
                $this->form->update();
                $this->successMessage = 'Chỉnh sửa thông tin nhóm vật tư thành công!';
                $this->material_group = $this->form->material_group;
            }
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }
    public function render()
    {
        return view('livewire.material.action-material-group');
    }
}
