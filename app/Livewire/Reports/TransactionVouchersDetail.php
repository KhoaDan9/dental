<?php

namespace App\Livewire\Reports;

use App\Models\Finance;
use App\Models\PatientPayment;
use App\Models\TransactionVoucher;
use Carbon\Carbon;
use Livewire\Component;

class TransactionVouchersDetail extends Component
{
    public $data_list;
    public $finance_id;
    public $funding_source_id;
    public $finance_list;
    public $funding_source_list;
    public $type;


    public $from_date = '';
    public $to_date = '';


    public function mount()
    {
        $this->from_date = $this->to_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

        $this->searchTransactionVoucher();
    }

    public function searchTransactionVoucher()
    {
        $from_date = Carbon::parse($this->from_date)->startOfDay();
        $to_date = Carbon::parse($this->to_date)->endOfDay();



        $transaction_vouchers = TransactionVoucher::whereBetween('date', [
            $from_date,
            $to_date
        ])->when($this->finance_id, function ($q) {
            $q->where('finance_id', $this->finance_id);
        })->when($this->funding_source_id, function ($q) {
            $q->where('funding_source_id', $this->funding_source_id);
        })->orderByDesc('date')->get()->groupBy('finance_id');

        if ($this->funding_source_id->name == 'Thu tiền từ bệnh nhân' || $this->funding_source_id == '')
            $patient_payment = PatientPayment::whereBetween('date', [
                $from_date,
                $to_date
            ])->get();

        dd($patient_payment);

        $finance_receipt_id = Finance::where('name', "Thu tiền từ bệnh nhân")->first()->id;

        $convert_patient_payment = $patient_payment->map(function ($item) use ($finance_receipt_id) {
            $new = new TransactionVoucher();
            $new->patient_id = $item->patient_id;
            $new->clinic_id = $item->clinic_id;
            $new->patient_payment_id = $item->id;
            $new->type_of_transaction = $item->type_of_transaction;
            $new->money = $item->paid;
            $new->detail = $item->detail;
            $new->group = $item->clinic_id;
            $new->funding_source_id = $item->funding_source_id;
            $new->date = $item->date;
            $new->last_update_name = $item->last_update_name;
            $new->finance_id = $finance_receipt_id;
            $new->is_receipt = 1;

            $new->transaction_voucher_id = '';
            $new->recipient = "";
            $new->phone = "";
            $new->address = "";
            return $new;
        });

        $convert_transaction_voucher = $transaction_vouchers->map(function ($item) {
            $new = new TransactionVoucher();
            $new->clinic_id = $item->clinic_id;
            $new->transaction_voucher_id = $item->id;
            $new->type_of_transaction = $item->type_of_transaction;
            $new->money = $item->money;
            $new->detail = $item->detail;
            $new->group = $item->clinic_id;
            $new->funding_source_id = $item->funding_source_id;
            $new->date = $item->date;
            $new->last_update_name = $item->last_update_name;
            $new->finance_id = $item->finance_id;
            $new->is_receipt = $item->is_receipt;

            $new->patient_id = '';
            $new->patient_payment_id = '';
            $new->recipient = $item->recipient;
            $new->phone = $item->phone;
            $new->address = $item->address;
            return $new;
        });

        $combine = collect($convert_transaction_voucher)->merge(collect($convert_patient_payment));

        $combine = $combine->sortBy(function ($item) {
            return Carbon::parse($item['date']);
        });

        // $this->payment_sum = $combine->where('is_receipt', false)->sum('money');
        // $this->receipt_sum = $combine->where('is_receipt', true)->sum('money');

        // $this->total = $this->receipt_sum - $this->payment_sum;

        // $this->transaction_vouchers = $combine;
    }

    public function render()
    {
        return view('livewire.reports.transaction-vouchers-detail');
    }
}
