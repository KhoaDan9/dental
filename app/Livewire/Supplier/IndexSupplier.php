<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Nhà cung cấp/xưởng')]
class IndexSupplier extends Component
{
    public $successMessage = '';
    public $errorMessage = '';

    public function deleteSupplier(Supplier $supplier)
    {
        $this->reset(['successMessage', 'errorMessage']);

        try {
            $supplier->delete();
            $this->successMessage = 'Xóa thẻ nhà cung cấp thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi xóa nhà cung cấp! Vui lòng liên hệ với chúng tôi!';
        }
    }

    public function render()
    {
        $user = Auth::user();
        $suppliers = Supplier::all();

        return view(
            'livewire.supplier.index-supplier',
            ['suppliers' => $suppliers]
        );
    }
}
