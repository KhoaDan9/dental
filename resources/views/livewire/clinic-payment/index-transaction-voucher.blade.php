<div>
    <div class="page-header">
        <div>
            <span>Dữ liệu >> <a href="/transaction-vouchers">Quản lý thu chi</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <div class="flex items-center space-x-1">
                <span>Từ</span>
                <input type="date" class="pl-1 border-gray-500 border-1" wire:model="from_date">
                <span>Đến</span>
                <input type="date" class="pl-1 border-gray-500 border-1" wire:model="to_date">
            </div>
            <button wire:click='searchTransactionVoucher' class="main-button">Tìm</button>
            <a href="/transaction-vouchers/create" class="a-button">Thêm</a>
        </div>
    </div>

    @if ($successMessage != '')
        <x-success-message>{{ $successMessage }}</x-success-message>
    @endif

    @if ($errorMessage !== '')
        <x-error-message>{{ $errorMessage }}</x-error-message>
    @endif


    <table class="table-custom table-auto w-full border-collapse border">
        <tr>
            <th rowspan="2" class="whitespace-nowrap w-0">TT</th>
            <th rowspan="2" class="whitespace-nowrap w-0">Ngày</th>
            <th rowspan="2" class="whitespace-nowrap w-0">Giờ</th>
            <th rowspan="2" class="whitespace-nowrap  text-left">Tên nguồn quỹ</th>
            <th class="whitespace-nowrap px-5! sm:px-10! w-0">Thu</th>
            <th class="whitespace-nowrap px-5! sm:px-10! w-0">Chi</th>
            <th class="whitespace-nowrap px-5! sm:px-10! w-0">Tổng kết</th>
            <th rowspan="2" class="whitespace-nowrap w-0">Giao dịch</th>
            <th rowspan="2" class="whitespace-nowrap ">Mô tả</th>
            <th rowspan="2" class="whitespace-nowrap ">Nhóm</th>
            <th rowspan="2" class="whitespace-nowrap w-0">P.K</th>
            <th rowspan="2" class="whitespace-nowrap w-0">Cập nhật</th>
            <th rowspan="2" class="whitespace-nowrap w-0">Chức năng</th>
        </tr>
        <tr>
            <td class="text-right transaction-th">{{ number_format($receipt_sum, 0, ',', '.') }}</td>
            <td class="text-right transaction-th">{{ number_format($payment_sum, 0, ',', '.') }}</td>
            <td class="text-right transaction-th">{{ number_format($total, 0, ',', '.') }}</td>
        </tr>
        @foreach ($transaction_vouchers as $transaction_voucher)
            <tr>
                <td class=" text-center">{{ $loop->iteration }}</td>
                <td class=" text-center">{{ \Carbon\Carbon::parse($transaction_voucher->date)->format('d/m/Y') }}</td>
                <td class=" text-center">{{ \Carbon\Carbon::parse($transaction_voucher->date)->format('H:i') }}</td>
                <td class="">{{ $transaction_voucher->fundingSource->name }}</td>
                @if ($transaction_voucher->is_receipt)
                    <td class="text-right">{{ number_format($transaction_voucher->money, 0, ',', '.') }}</td>
                    <td class="text-right">0</td>
                @else
                    <td class="text-right">0</td>
                    <td class="text-right">{{ number_format($transaction_voucher->money, 0, ',', '.') }}</td>
                @endif
                <td class="text-right">0</td>
                <td class="whitespace-nowrap sm:px-10! text-center">{{ $transaction_voucher->type_of_transaction }}</td>
                <td class="">{{ $transaction_voucher->detail }}</td>
                <td class="">{{ $transaction_voucher->finance->name }}</td>
                <td class=" text-center">{{ $transaction_voucher->clinic_id }}</td>
                <td class=" text-center">{{ $transaction_voucher->last_update_name }}</td>
                <td class=" text-center">
                    <a
                        @if($transaction_voucher->patient_payment_id != '')
                            href="/patients/{{ $transaction_voucher->patient_id }}/payments/{{ $transaction_voucher->patient_payment_id }}"
                        @elseif($transaction_voucher->transaction_voucher_id != '')
                            href="/transaction-vouchers/{{ $transaction_voucher->transaction_voucher_id  }}"
                        @endif
                        wire:navigate >sửa</a> |
                    <button class="button-a" wire:confirm="Bạn có thực sự muốn xóa không?"
                            wire:click='deleteFundingSource({{ $transaction_voucher->id }})'>xóa
                    </button>
                </td>
            </tr>
        @endforeach
    </table>
</div>
