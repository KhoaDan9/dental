<?php

namespace App\Livewire\ClinicPayment;

use App\Livewire\Forms\FundingSourceForm;
use App\Models\Clinic;
use App\Models\FundingSource;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Danh mục nguồn quỹ')]
class ActionFundingSource extends Component
{
    public FundingSource $funding_source;
    public FundingSourceForm $form;
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
            $this->funding_source = FundingSource::where('id', $value)->get()[0];
            $this->form->setAttributes($this->funding_source);
        }
    }

    public function actionFundingSource()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->form->validate();

        $funding_source_id = $this->is_create == 'create' ? 0 : $this->funding_source->id;
        if (Fundingsource::where('name', $this->form->name)->whereNot('id', $funding_source_id)->exists())
            return $this->errorMessage = 'Tên nguồn quỹ đã tồn tại. Xin vui lòng kiểm tra lại.';

        try {
            if ($this->is_create == 'create') {

                $this->form->store();
                $this->successMessage = 'Thêm nguồn quỹ thành công!';
            } else {
                $this->form->update();
                $this->successMessage = 'Chỉnh sửa thông tin nguồn quỹ thành công!';
                $this->funding_source = $this->form->funding_source;
            }
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }
    public function render()
    {
        return view('livewire.clinic-payment.action-funding-source');
    }
}
