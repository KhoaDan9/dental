<?php

namespace App\Livewire\ClinicPayment;

use App\Livewire\Forms\FinanceForm;
use App\Models\Clinic;
use App\Models\Finance;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Nhóm thu/chi')]
class ActionFinance extends Component
{
    public Finance $finance;
    public FinanceForm $form;
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
            $this->finance = Finance::where('id', $value)->get()[0];
            $this->form->setAttributes($this->finance);
            $item = [];

            if ($this->finance->receipt == 1)
                $item[] = 'receipt';
            if ($this->finance->payment == 1)
                $item[] = 'payment';
            $this->form->item = $item;
        }
    }

    public function actionFinance()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->form->validate();

        $finance_id = $this->is_create == 'create' ? 0 : $this->finance->id;

        if (Finance::where('name', $this->form->name)->whereNot('id', $finance_id)->exists())
            return $this->errorMessage = 'Nhóm thu chi đã tồn tại. Xin vui lòng kiểm tra lại.';

        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = 'Thêm nhóm thu chi thành công!';
            } else {
                $this->form->update();
                $this->successMessage = 'Chỉnh sửa thông tin nhóm thu chi thành công!';
                $this->finance = $this->form->finance;
            }
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }

    public function render()
    {
        return view('livewire.clinic-payment.action-finance');
    }
}
