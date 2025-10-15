<?php

namespace App\Livewire\Material;

use App\Models\Material;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Danh mục vật tư')]
class IndexMaterial extends Component
{
    public $successMessage = '';
    public $errorMessage = '';

    public function deleteMaterial(Material $material)
    {
        $this->reset(['successMessage', 'errorMessage']);

        try {
            $material->delete();
            $this->successMessage = 'Xóa vật tư thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi xóa thông tin vật tư. Vui lòng thử lại sau!';
        }
    }
    public function render()
    {
        $user = Auth::user();
        $materials = Material::all();
        return view(
            'livewire.material.index-material',
            ['materials' => $materials]
        );
    }
}
