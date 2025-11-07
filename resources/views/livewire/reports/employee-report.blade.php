<div class="report">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300 mb-2">
        <div>
            <span>Báo cáo >> <a href="#">Chi tiết thủ thuật theo nhân viên</a></span>
        </div>
        <form wire:submit.prevent="searchSubmit">
            <div class="flex space-x-1">
                <label for="">Từ ngày:</label>
                <x-text-input type="date" class="w-40" model="from_date"/>
                <label for="">Đến ngày:</label>
                <x-text-input type="date" class="w-40" model="to_date"/>
                <div class="flex flex-grow flex-col">
                    <select class='pl-1 border-gray-400 border-[0.5px] rounded outline-none'
                            wire:model='employee_id'>
                        <option value="">-</option>
                        @foreach ($employee_list as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="main-button">Tìm</button>
            </div>
        </form>

    </div>
    <div class="">
        <div class="flex justify-center pb-3">
            <strong class="text-2xl!">Chi tiết thủ thuật theo nhân viên</strong>
        </div>
        @cannot('view-report-employee-report')
            <x-cannot-permission/>
        @else
            <table class="report-table-custom table-auto mb-5 w-full border-collapse border">
                <tr>
                    <th class="whitespace-nowrap w-0">TT</th>
                    <th class="whitespace-nowrap w-0">Mã KH</th>
                    <th class="whitespace-nowrap w-0">Họ và tên</th>
                    <th class="whitespace-nowrap w-0">NS</th>
                    <th class="whitespace-nowrap w-0">GT</th>
                    <th class="whitespace-nowrap w-0">Di động</th>
                    <th class="whitespace-nowrap w-0">Ngày</th>
                    <th class="whitespace-nowrap w-0">Giờ</th>
                    <th class="whitespace-nowrap w-0">Thủ thuật</th>
                    <th class="whitespace-nowrap w-0">SL</th>
                    <th class="whitespace-nowrap w-0">Đơn giá</th>
                    <th class="whitespace-nowrap w-0">Thành tiền</th>
                    <th class="whitespace-nowrap w-0">Tổng tiền</th>
                    <th class="whitespace-nowrap w-0">Đã thu</th>
                    <th class="whitespace-nowrap w-0">Còn nợ</th>
                </tr>
                @foreach($data_list as $employee)
                    <tr class="heading-tr">
                        <td colspan="12" class="pl-1"><a href="/patients/{{ $employee->id }}"
                                                         class="text-black!">{{ $employee->name }}</a>
                        </td>
                        <td class="text-right">{{ number_format($employee->sum_total_price , 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($employee->sum_paid , 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($employee->sum_debt , 0, ',', '.') }}</td>
                    </tr>
                    @foreach($employee->data as $detail)
                        @php $row_span = count($detail['services']); @endphp
                        @foreach($detail['services'] as $index => $patient_service)
                            <tr>
                                @if($index == 0)
                                    <td rowspan="{{$row_span}}" class="text-center">{{ $loop->parent->iteration }}</td>
                                    <td rowspan="{{$row_span}}" class="text-center"><a
                                            href="/patients/{{ $detail['patient']->id }}">{{ $detail['patient']->clinic_id . '.' . $detail['patient']->id }}</a>
                                    </td>
                                    <td rowspan="{{$row_span}}" class="whitespace-nowrap">{{ $detail['patient']->name }}</td>
                                    <td rowspan="{{$row_span}}"
                                        class="text-center">{{ \Carbon\Carbon::parse($detail['patient']->birth)->format('Y') }}</td>
                                    <td rowspan="{{$row_span}}"
                                        class="text-center">{{ $detail['patient']->gender }}</td>
                                    <td rowspan="{{$row_span}}" class="text-center whitespace-nowrap">{{ $detail['patient']->phone }}</td>
                                @endif

                                <td class="text-center">{{ \Carbon\Carbon::parse($patient_service->date)->format('d/m/Y') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($patient_service->date)->format('H:i:s') }}</td>
                                <td class="whitespace-nowrap">{{ $patient_service->service->name }}</td>
                                <td class="text-center">{{ $patient_service->quantity }}</td>
                                <td class="text-right">{{ number_format($patient_service->price, 0, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($patient_service->total_price, 0, ',', '.') }}</td>
                                @if($index == 0)
                                    <td rowspan="{{$row_span}}"
                                        class="text-right">{{ number_format($detail['total_price'], 0, ',', '.') }}</td>
                                    <td rowspan="{{$row_span}}"
                                        class="text-right">{{ number_format($detail['paid'], 0, ',', '.') }}</td>
                                    <td rowspan="{{$row_span}}"
                                        class="text-right">{{ number_format($detail['debt'], 0, ',', '.') }}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endforeach

                @endforeach
            </table>

        @endcannot
    </div>

</div>
