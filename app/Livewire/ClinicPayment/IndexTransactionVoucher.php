<?php

namespace App\Livewire\ClinicPayment;

use App\Models\Finance;
use App\Models\PatientPayment;
use App\Models\TransactionVoucher;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Quản lý thu/chi')]
class IndexTransactionVoucher extends Component
{
    public $transaction_vouchers;
    public $successMessage = '';
    public $errorMessage = '';
    public $from_date = '';
    public $to_date = '';
    public $receipt_sum = '';
    public $payment_sum = '';
    public $total = '';

    public function mount()
    {
        $this->from_date = $this->to_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

        $this->searchTransactionVoucher();
    }

    public function searchTransactionVoucher()
    {
        $from_date = Carbon::parse($this->from_date)->startOfDay();
        $to_date = Carbon::parse($this->to_date)->endOfDay();

        $this->transaction_vouchers = TransactionVoucher::with(['finance', 'fundingSource'])
            ->whereBetween('date', [
                $from_date,
                $to_date
            ])->get();

        if(count($this->transaction_vouchers) == 0)
            $this->transaction_vouchers = collect();

        $patient_payment = PatientPayment::with('fundingSource','patient')
            ->whereBetween('date', [
                $from_date,
                $to_date
            ])->get();

        $convert_patient_payment = $patient_payment->map(function ($item) {
            return [
                'transaction_voucher_id' => '',
                'patient_payment_id' => $item->id,
                'patient_id' => $item->patient->id,
                'clinic_id' => $item->clinic_id,
                'type_of_transaction' => $item->type_of_transaction,
                'money' => $item->paid,
                'detail' => $item->detail,
                'funding_source' => $item->fundingSource->name,
                'date' => $item->date,
                'finance' => "Thu tiền từ bệnh nhân",
                'is_receipt' => 1,
                'last_update_name' => $item->last_update_name,
            ];
        });

        $convert_transaction_voucher = $this->transaction_vouchers->map(function ($item) {
            return [
                'transaction_voucher_id' => $item->id,
                'patient_payment_id' => '',
                'patient_id' => '',
                'clinic_id' => $item->clinic_id,
                'type_of_transaction' => $item->type_of_transaction,
                'money' => $item->money,
                'detail' => $item->detail,
                'funding_source' => $item->fundingSource->name,
                'date' => $item->date,
                'finance' => $item->finance->name,
                'is_receipt' => $item->is_receipt,
                'last_update_name' => $item->last_update_name,
            ];
        });

        $combine = $convert_transaction_voucher
            ->merge($convert_patient_payment)
            ->sortByDesc(fn($item) => Carbon::parse($item['date']))
            ->values();

        $this->payment_sum = $combine->where('is_receipt', false)->sum('money');
        $this->receipt_sum = $combine->where('is_receipt', true)->sum('money');

        $this->total = $this->receipt_sum - $this->payment_sum;

        $this->transaction_vouchers = $combine;
    }

    public function deleteFundingSource(TransactionVoucher $transaction_voucher)
    {
        $this->reset(['successMessage', 'errorMessage']);

        try {
            $transaction_voucher->delete();
            $this->successMessage = 'Xóa thu/chi thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi xóa thông tin thu/chi. Vui lòng thử lại sau!';
        }
    }

    public function render()
    {
        return view('livewire.clinic-payment.index-transaction-voucher');
    }
}
