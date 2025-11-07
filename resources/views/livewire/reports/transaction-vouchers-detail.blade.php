<div class="report">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300 mb-2">
        <div>
            <span>Báo cáo >> <a href="#">Báo cáo chi tiết thu/chi</a></span>
        </div>
        <form wire:submit.prevent="searchSubmit">
            <div class="flex space-x-1">
                <label for="">Từ ngày:</label>
                <x-text-input type="date" class="w-40" model="from_date"/>
                <label for="">Đến ngày:</label>
                <x-text-input type="date" class="w-40" model="to_date"/>
                <div class="flex flex-grow flex-col">
                    {{-- <select class='pl-1 border-gray-400 border-[0.5px] rounded outline-none'
                            wire:model='service_group_id'>
                        <option value="">-</option>
                        @foreach ($service_groups as $service_group)
                            <option value="{{ $service_group->id }}">{{ $service_group->name }}</option>
                        @endforeach
                    </select> --}}
                </div>
                <button type="submit" class="main-button">Tìm</button>
            </div>
        </form>

    </div>


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
