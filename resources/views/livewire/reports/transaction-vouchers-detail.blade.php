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
                    <select class='pl-1 border-gray-400 border-[0.5px] rounded outline-none'
                            wire:model='finance_id'>
                        <option value="">-</option>
                        <option value="0">Thu tiền từ bệnh nhân</option>
                        @foreach ($finance_list as $finance)
                            <option value="{{ $finance->id }}">{{ $finance->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-grow flex-col">
                    <select class='pl-1 border-gray-400 border-[0.5px] rounded outline-none'
                            wire:model='funding_source_id'>
                        <option value="">-</option>
                        @foreach ($funding_source_list as $funding_source)
                            <option value="{{ $funding_source->id }}">{{ $funding_source->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-grow flex-col">
                    <select class='pl-1 border-gray-400 border-[0.5px] rounded outline-none'
                            wire:model='is_receipt'>
                        <option value="">-</option>
                        <option value="1">Thu</option>
                        <option value="0">Chi</option>
                    </select>
                </div>
                <button type="submit" class="main-button">Tìm</button>
            </div>
        </form>

    </div>


    <table class="table-custom table-auto w-full border-collapse border">
        @foreach ($data_list as $finance_name => $finace_group)
            <tr>
                <th class="whitespace-nowrap w-0">TT</th>
                <th class="whitespace-nowrap w-0">Ngày</th>
                <th class="whitespace-nowrap text-left">Tên đối tượng</th>
                <th class="whitespace-nowrap text-left">Địa chỉ</th>
                <th class="whitespace-nowrap text-left">Điện thoại</th>
                <th class="whitespace-nowrap px-5! sm:px-10! w-0">Thu</th>
                <th class="whitespace-nowrap px-5! sm:px-10! w-0">Chi</th>
                <th class="whitespace-nowrap">Nguồn quỹ</th>
                <th class="whitespace-nowrap w-0">Nhân viên</th>
                <th class="whitespace-nowrap">Nội dung</th>
                <th class="whitespace-nowrap w-0">PK</th>
            </tr>

            <tr class="heading-tr">
                <td colspan="5">{{ $finance_name }}</td>
                <td class="text-right">{{ number_format($sums[$finance_name]['receipt_sum'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($sums[$finance_name]['payment_sum'], 0, ',', '.') }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            @foreach($finace_group as $data)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class=" text-center">{{ \Carbon\Carbon::parse($data['date'])->format('d/m/Y') }}</td>
                    <td class="">{{ $data['patient_name'] }}</td>
                    <td class="">{{ $data['patient_address'] }}</td>
                    <td class="">{{ $data['patient_phone'] }}</td>
                    @if ($data['is_receipt'])
                        <td class="text-right">{{ number_format($data['money'], 0, ',', '.') }}</td>
                        <td class="text-right">0</td>
                    @else
                        <td class="text-right">0</td>
                        <td class="text-right">{{ number_format($data['money'], 0, ',', '.') }}</td>
                    @endif
                    <td class="whitespace-nowrap">{{ $data['funding_source'] }}</td>
                    <td class="text-center whitespace-nowrap">{{ $data['employee_name'] }}</td>
                    <td class="whitespace-nowrap">{{ $data['detail'] }}</td>
                    <td class="text-center">{{ $data['clinic_id'] }}</td>
                </tr>
            @endforeach
        @endforeach
    </table>
</div>
