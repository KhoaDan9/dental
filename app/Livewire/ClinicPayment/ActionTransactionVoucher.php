<?php

namespace App\Livewire\ClinicPayment;

use App\Livewire\Forms\TransactionVoucherForm;
use App\Models\Clinic;
use App\Models\Finance;
use App\Models\FundingSource;
use App\Models\TransactionVoucher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Quản lý thu/chi')]
class ActionTransactionVoucher extends Component
{
    public TransactionVoucher $transaction_voucher;
    public TransactionVoucherForm $form;
    public $is_create = '';
    public $clinics = [];
    public $finances = [];
    public $funding_sources = [];
    public $successMessage = '';
    public $errorMessage = '';

    public function mount($value)
    {
        $user = Auth::user();
        $this->clinics = Clinic::all();
        $this->updateFinances();
        $this->funding_sources = FundingSource::when($user->admin != 1, function ($query) use ($user) {
            return $query->where('id', $user->clinic_id);
        })->where('active', true)->get();

        if ($value == 'create') {
            $this->is_create = $value;
            $this->form->clinic_id = $this->clinics[0]->id;
            $this->form->finance_id = $this->finances[0]->id;
            $this->form->funding_source_id = $this->funding_sources[0]->id;

            $this->form->date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i');
        } else {
            $this->transaction_voucher = TransactionVoucher::where('id', $value)->get()[0];
            $this->form->setAttributes($this->transaction_voucher);
        }
    }

    public function updatedFormIsReceipt($value)
    {
        if ($value == 0)
            $this->title = 'Chi từ quỹ';
        else
            $this->title = 'Thu vào quỹ';
        $this->updateFinances();
    }

    public function updateFinances()
    {
        $user = Auth::user();

        if ($this->form->is_receipt == true) {
            $this->finances = Finance::when($user->admin != 1, function ($query) use ($user) {
                return $query->where('id', $user->clinic_id);
            })->where('receipt', true)->get();
        } else {
            $this->finances = Finance::when($user->admin != 1, function ($query) use ($user) {
                return $query->where('id', $user->clinic_id);
            })->where('payment', true)->get();
        }
    }

    public function save()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->form->validate();
        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = 'Thêm phiếu thu/chi thành công!';
            } else {
                $this->form->update();
                $this->successMessage = 'Chỉnh sửa thông tin phiếu thu/chi thành công!';
                $this->transaction_voucher = $this->form->transaction_voucher;
            }
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }

    public function saveAndExit()
    {
        $this->save();
        if (!$this->errorMessage) {
            return $this->redirect('/transaction-vouchers');
        }
    }

    public function render()
    {
        return view('livewire.clinic-payment.action-transaction-voucher');
    }
}
