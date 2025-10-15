<?php

namespace App\Livewire\Forms;

use App\Models\TransactionVoucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TransactionVoucherForm extends Form
{
    public TransactionVoucher $transaction_voucher;

    public $clinic_id = '';
    public $finance_id = '';
    public $funding_source_id = '';
    public $date = '';
    public $type_of_transaction = 'Tiền mặt';
    public $recipient = '';
    public $phone = '';
    public $address = '';


    #[Validate('required', message: 'Vui lòng nhập số tiền.')]
    public $money = '';

    #[Validate('required', message: 'Vui lòng nhập nội dung thu/chi.')]
    public $detail = '';
    public $note = '';
    public $is_receipt = false;
    public $last_update_name = '';

    public function setAttributes(TransactionVoucher $transaction_voucher)
    {
        $this->transaction_voucher = $transaction_voucher;

        $this->clinic_id = $transaction_voucher->clinic_id;
        $this->finance_id = $transaction_voucher->finance_id;
        $this->funding_source_id = $transaction_voucher->funding_source_id;
        $this->date = Carbon::parse($transaction_voucher->date)->format('Y-m-d H:i');
        $this->recipient = $transaction_voucher->recipient;
        $this->phone = $transaction_voucher->phone;
        $this->address = $transaction_voucher->address;
        $this->type_of_transaction = $transaction_voucher->type_of_transaction;
        $this->money = number_format($transaction_voucher->money, 0, ',', '.');;
        $this->detail = $transaction_voucher->detail;
        $this->note = $transaction_voucher->note;
        $this->is_receipt = $transaction_voucher->is_receipt;
        $this->last_update_name = $transaction_voucher->last_update_name;
    }

    public function store()
    {

        TransactionVoucher::create([
            'clinic_id' => $this->clinic_id,
            'finance_id' => $this->finance_id,
            'funding_source_id' => $this->funding_source_id,
            'date' => $this->date,
            'recipient' => $this->recipient,
            'phone' => $this->phone,
            'address' => $this->address,
            'type_of_transaction' => $this->type_of_transaction,
            'money' => (int) str_replace('.', '', $this->money),
            'detail' => $this->detail,
            'note' => $this->note,
            'is_receipt' => $this->is_receipt,
            'last_update_name' => Auth::user()->username
        ]);
        $this->reset(['detail', 'note', 'recipient', 'type_of_transaction', 'phone', 'address', 'money']);
    }

    public function update()
    {
        $this->last_update_name = Auth::user()->username;
        $this->transaction_voucher->update([
            'finance_id' => $this->finance_id,
            'funding_source_id' => $this->funding_source_id,
            'date' => $this->date,
            'recipient' => $this->recipient,
            'phone' => $this->phone,
            'address' => $this->address,
            'type_of_transaction' => $this->type_of_transaction,
            'money' => (int) str_replace('.', '', $this->money),
            'detail' => $this->detail,
            'note' => $this->note,
            'is_receipt' => $this->is_receipt,
            'last_update_name' => Auth::user()->username
        ]);
    }
}
