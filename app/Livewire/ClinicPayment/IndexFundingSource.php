<?php

namespace App\Livewire\ClinicPayment;

use App\Models\FundingSource;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Danh mục nguồn quỹ')]
class IndexFundingSource extends Component
{
    public $successMessage = '';
    public $errorMessage = '';

    public function deleteFundingSource(FundingSource $funding_source)
    {
        $this->reset(['successMessage', 'errorMessage']);

        try {
            $funding_source->delete();
            $this->successMessage = 'Xóa nguồn quỹ thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi xóa thông tin nguồn quỹ. Vui lòng thử lại sau!';
        }
    }
    public function render()
    {
        $funding_sources = FundingSource::all();

        return view('livewire.clinic-payment.index-funding-source',[
            'funding_sources' => $funding_sources
        ]);
    }
}
