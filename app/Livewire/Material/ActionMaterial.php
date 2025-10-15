<?php

namespace App\Livewire\Material;

use App\Livewire\Forms\MaterialForm;
use App\Models\Clinic;
use App\Models\Material;
use App\Models\MaterialGroup;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Danh mục vật tư')]
class ActionMaterial extends Component
{
    public MaterialForm $form;
    public Material $material;
    public $clinics = [];
    public $material_groups = [];
    public $is_create = '';
    public $successMessage = '';
    public $errorMessage = '';
    public function mount($value)
    {
        $user = Auth::user();
        $this->clinics = Clinic::all();

        $this->material_groups = MaterialGroup::all();

        if (count($this->material_groups) == 0)
            return $this->errorMessage = 'Không thể thêm vật tư do chưa có nhóm vật tư. Xin vui lòng tạo nhóm vật tư mới.';

        if ($value == 'create') {
            $this->is_create = $value;
            $this->form->clinic_id = $this->clinics[0]->id;
            $this->material_groups = MaterialGroup::all();
            $this->form->material_group_id = $this->material_groups[0]->id;
        } else {
            $this->material = Material::where('id', $value)->get()[0];
            $this->form->setAttributes($this->material);
        }
    }

    public function actionMaterial()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->form->validate();

        $material_id = $this->is_create == 'create' ? 0 : $this->material->id;

        if (Material::where('name', $this->form->name)->whereNot('id', $material_id)->exists())
            return $this->errorMessage = 'Vật tư đã tồn tại. Xin vui lòng kiểm tra lại.';

        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = 'Thêm vật tư thành công!';
            } else {
                $this->form->update();
                $this->successMessage = 'Chỉnh sửa thông tin vật tư thành công!';
                $this->material = $this->form->material;
            }
        } catch (QueryException $e) {
        }
    }
    public function render()
    {
        return view('livewire.material.action-material');
    }
}
