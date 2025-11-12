<?php

namespace App\Livewire\Reports;

use App\Models\Finance;
use App\Models\FundingSource;
use App\Models\PatientPayment;
use App\Models\TransactionVoucher;
use Carbon\Carbon;
use Livewire\Component;

class TransactionVouchersDetail extends Component
{
    public $data_list;
    public $sums;
    public $total;

    public $finance_id;
    public $funding_source_id;
    public $finance_list;
    public $funding_source_list;
    public $is_receipt;

    public $from_date = '';
    public $to_date = '';


    public function mount()
    {
        $this->from_date = $this->to_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $this->finance_list = Finance::where('name', '!=', 'Thu tiền từ bệnh nhân')->get();
        $this->funding_source_list = FundingSource::get();

        $this->searchSubmit();
    }

    public function searchSubmit()
    {
        $from_date = Carbon::parse($this->from_date)->subYear()->startOfDay();
        $to_date = Carbon::parse($this->to_date)->endOfDay();

        $transaction_vouchers = collect();
        $patient_payment = collect();


        if ($this->finance_id != 0 || blank($this->finance_id)) {
            $transaction_vouchers = TransactionVoucher::with(['finance', 'fundingSource'])
                ->whereBetween('date', [$from_date, $to_date])
                ->when($this->finance_id, function ($q) {
                    $q->where('finance_id', $this->finance_id);
                })->when($this->funding_source_id, function ($q) {
                    $q->where('funding_source_id', $this->funding_source_id);
                })->when($this->is_receipt, function ($q) {
                    $q->where('is_receipt', $this->is_receipt);
                })->get();
        }
        if(count($transaction_vouchers) == 0)
            $transaction_vouchers = collect();

        if ($this->finance_id == 0 || $this->finance_id == '') {
            if($this->is_receipt == 1 || $this->is_receipt == '')
                $patient_payment = PatientPayment::with('fundingSource', 'patient', 'employee')
                    ->whereBetween('date', [$from_date, $to_date])
                    ->when($this->funding_source_id, function ($q) {
                        $q->where('funding_source_id', $this->funding_source_id);
                    })
                    ->get();
        }


        $convert_patient_payment = $patient_payment->map(function ($item) {
            return [
                'transaction_voucher_id' => '',
                'patient_payment_id' => $item->id,
                'patient_id' => $item->patient->id,
                'patient_name' => $item->patient->name,
                'patient_address' => $item->patient->address,
                'patient_phone' => $item->patient->phone,
                'employee_name' => $item->employee->name,
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

        $convert_transaction_voucher = $transaction_vouchers->map(function ($item) {
            return [
                'transaction_voucher_id' => $item->id,
                'patient_payment_id' => '',
                'patient_id' => '',
                'patient_name' => '',
                'patient_address' => '',
                'patient_phone' => '',
                'employee_name' => '',
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
            ->values()->groupBy('finance');

        $this->sums = $combine->map(function ($items) {
            return [
                'receipt_sum' => $items->where('is_receipt', true)->sum('money'),
                'payment_sum' => $items->where('is_receipt', false)->sum('money'),
            ];
        });

        $this->data_list = $combine;

    }

    public function render()
    {
        return view('livewire.reports.transaction-vouchers-detail');
    }
}
