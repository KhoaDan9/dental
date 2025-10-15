<?php

namespace App\Livewire\Material;

use App\Livewire\Forms\MaterialGroupForm;
use App\Models\MaterialGroup;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Nhóm vật tư')]
class IndexMaterialGroup extends Component
{
    public $service_groups = [];
    public MaterialGroupForm $form;

    public $successMessage = '';
    public $errorMessage = '';

    public function deleteMaterialGroup(MaterialGroup $material_group)
    {
        $this->reset(['successMessage', 'errorMessage']);

        try {
            $material_group->delete();
            $this->successMessage = 'Xóa nhóm vật tư thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi xóa nhóm vật tư. Vui lòng thử lại sau!';
        }
    }
    public function render()
    {
        $material_groups = MaterialGroup::all();
        return view(
            'livewire.material.index-material-group',
            [
                'material_groups' => $material_groups
            ]
        );
    }
}
