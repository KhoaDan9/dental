<div class="report">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300 mb-2">
        <div>
            <span>Báo cáo >> <a href="#">Tổng hợp thủ thuật thực hiện</a></span>
        </div>
        <form wire:submit.prevent="searchSubmit">
            <div class="flex space-x-1">
                <label for="">Từ ngày:</label>
                <x-text-input type="date" class="w-40" model="from_date"/>
                <label for="">Đến ngày:</label>
                <x-text-input type="date" class="w-40" model="to_date"/>
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
                    <th class="whitespace-nowrap w-0">Số lượng thực hiện</th>
                    <th class="whitespace-nowrap w-0">Thành tiền</th>
                    <th class="whitespace-nowrap w-0">Số lượng khách hàng</th>
                </tr>
                @foreach($data_list as $service_group)
                    <tr class="heading-tr">
                        <td colspan="2" class="pl-1"><a href="/patients/{{ $service_group->id }}"
                                                                  class="text-black!">{{ $service_group->name }}</a>
                        </td>
                        <td class="text-center">{{ $service_group->sum_service_count }}</td>
                        <td class="text-right">{{ number_format($service_group->sum_total_price , 0, ',', '.') }}</td>
                        <td class="text-center">{{ $service_group->sum_patient_count }}</td>
                    </tr>
                    @foreach($service_group->services as $service)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><a href="/patients/{{ $service->id }}"
                                   class="whitespace-nowrap">{{ $service->name }}</a></td>
                            <td class="text-center">{{ $service->service_count }}</td>
                            <td class="text-right">{{ number_format($service->total_price , 0, ',', '.') }}</td>
                            <td class="text-center">{{ $service->patient_count }}</td>
                        </tr>
                    @endforeach

                @endforeach
            </table>

        @endcannot
    </div>

</div>
