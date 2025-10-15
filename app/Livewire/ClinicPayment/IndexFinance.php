<?php

namespace App\Livewire\ClinicPayment;

use App\Models\Finance;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Nhóm thu/chi')]
class IndexFinance extends Component
{
    public $successMessage = '';
    public $errorMessage = '';

    public function deleteFinance(Finance $finance)
    {
        $this->reset(['successMessage', 'errorMessage']);

        try {
            $finance->delete();
            $this->successMessage = 'Xóa nguồn quỹ thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi xóa thông tin nguồn quỹ. Vui lòng thử lại sau!';
        }
    }
    public function render()
    {
        $finances = Finance::all();

        return view('livewire.clinic-payment.index-finance', [
            'finances' => $finances
        ]);
    }
}
