<div class="report">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300 mb-2">
        <div>
            <span>Báo cáo >> <a href="#">Tổng hợp thủ thuật theo nhân viên</a></span>
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
                <div class="flex flex-grow flex-col">
                    <select class='pl-1 border-gray-400 border-[0.5px] rounded outline-none'
                            wire:model='service_group_id'>
                        <option value="">-</option>
                        @foreach ($service_groups as $service_group)
                            <option value="{{ $service_group->id }}">{{ $service_group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="main-button">Tìm</button>
            </div>
        </form>

    </div>
    <div class="print-invoice w-4xl">
        <div class="flex justify-center pb-3">
            <strong class="text-2xl!">Tổng hợp thủ thuật thực hiện</strong>
        </div>
        @cannot('view-report-patient-details')
            <x-cannot-permission/>
        @else
            <table class="report-table-custom table-auto w-full border-collapse border">
                <tr>
                    <th class="whitespace-nowrap w-0">TT</th>
                    <th class="whitespace-nowrap w-0">Tên thủ thuật</th>
                    <th class="whitespace-nowrap w-0">Số lượng khách hàng</th>
                    <th class="whitespace-nowrap w-0">Số lượng thủ thuật</th>
                    <th class="whitespace-nowrap w-0">Thành tiền</th>
                </tr>
                @foreach($data_list as $employee)
                    <tr class="heading-tr">
                        <td colspan="2" class="pl-1"><a href="/employees/{{ $employee->id }}"
                                                        class="text-black!">{{ $employee->name }}</a>
                        </td>
                        <td class="text-center">{{ $employee->sum_patient_count }}</td>
                        <td class="text-center">{{ $employee->sum_service_count }}</td>
                        <td class="text-right">{{ number_format($employee->sum_total_price , 0, ',', '.') }}</td>
                    </tr>
                    @foreach($employee->service_groups as $service_group)
                        <tr class="heading-tr">
                            <td colspan="2" class="pl-1"><a href="/service-groups/{{ $service_group->id }}"
                                                            class="text-black!">{{ $service_group->name }}</a>
                            </td>
                            <td class="text-center">{{ $service_group->sum_patient_count }}</td>
                            <td class="text-center">{{ $service_group->sum_service_count }}</td>
                            <td class="text-right">{{ number_format($service_group->sum_total_price , 0, ',', '.') }}</td>
                        </tr>
                        @foreach($service_group->services as $service)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><a href="/services/{{ $service->id }}"
                                   class="whitespace-nowrap">{{ $service->name }}</a></td>
                            <td class="text-center">{{ $service->patient_count }}</td>
                            <td class="text-center">{{ $service->service_count }}</td>
                            <td class="text-right">{{ number_format($service->total_price , 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    @endforeach

                @endforeach
            </table>

        @endcannot
    </div>

</div>
