<div class="report">
    <x-all-report-heading title_1="Chi tiết khách hàng" url_1="#"
                          search_from_date="from_date" search_to_date="to_date"
                          employee_id="employee_id" service_group_id="service_group_id"
                          service_id="service_id" patient_from="patien_from"
                          :service_groups="$service_groups" :services="$services"
                          :employees="$employees"
    />
    @cannot('view-report-patient-details')
        <x-cannot-permission/>
    @else
        <table class="table-custom table-auto w-full border-collapse border">
            <tr>
                <th class="whitespace-nowrap w-0">TT</th>
                <th class="whitespace-nowrap w-0">Mã KH</th>
                <th class="whitespace-nowrap w-0 text-left">Họ và tên</th>
                <th class="whitespace-nowrap w-0">NS</th>
                <th class="whitespace-nowrap w-0">GT</th>
                <th class="whitespace-nowrap w-0 text-left">Điện thoại</th>
                <th class="whitespace-nowrap w-0 text-left">Địa chỉ</th>
                <th class="whitespace-nowrap w-0 text-left">Nguồn</th>
                <th class="whitespace-nowrap w-0">Ngày</th>
                <th class="whitespace-nowrap w-0">Giờ</th>
                <th class="whitespace-nowrap w-0">Thủ thuật</th>
                <th class="whitespace-nowrap w-0">Bác sỹ</th>
                <th class="whitespace-nowrap w-0">Trợ thủ</th>
                <th class="whitespace-nowrap w-0">SL</th>
                <th class="whitespace-nowrap w-0">Đơn giá</th>
                <th class="whitespace-nowrap w-0">Thành tiền</th>
                <th class="whitespace-nowrap w-0">Phải trả</th>

                <th class="whitespace-nowrap w-0">Đã thu</th>
                <th class="whitespace-nowrap w-0">Còn nợ</th>
            </tr>
            @foreach ($data_list as $data)
                @php
                    $patient_services = $data['patient-services'];
                @endphp

                @foreach ($patient_services as $index => $patient_service)
                    <tr>
                        @if ($index == 0)
                            <td rowspan="{{ $data->length }}" class="text-center">{{ $loop->iteration }}</td>
                            <td rowspan="{{ $data->length }}" class="text-center">
                                <a href="/patients/{{ $data->id }}">{{ $data->clinic_id . '.' . $data->id }}</a>
                            </td>
                            <td rowspan="{{ $data->length }}"><a href="/patients/{{ $data->id }}" class="whitespace-nowrap">{{ $data->name }}</a></td>
                            <td rowspan="{{ $data->length }}" class="text-center whitespace-nowrap">{{ \Carbon\Carbon::parse($data->birth)->year }}</td>
                            <td rowspan="{{ $data->length }}" class="text-center whitespace-nowrap">{{ $data->gender }}</td>
                            <td rowspan="{{ $data->length }}">{{ $data->phone }}</td>
                            <td rowspan="{{ $data->length }}">{{ $data->address }}</td>
                            <td rowspan="{{ $data->length }}">
                                {{ $data->from }}
                                @if ($data->from_note)
                                    | {{ $data->from_note }}
                                @endif
                            </td>
                        @endif

                        <td class="text-center whitespace-nowrap">{{ \Carbon\Carbon::parse($patient_service->date)->format('Y-m-d') }}</td>
                        <td class="text-center whitespace-nowrap">{{ \Carbon\Carbon::parse($patient_service->date)->format('H:i:s') }}</td>
                        <td class="whitespace-nowrap">{{ $patient_service->service->name }}</td>
                        <td class="text-center whitespace-nowrap">{{ $patient_service->employee->name }}</td>
                        <td class="text-center whitespace-nowrap">
                            @if($patient_service->supporter)
                                {{ $patient_service->supporter->name }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">{{ $patient_service->quantity }}</td>
                        <td class="text-right">{{ number_format($patient_service->price , 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($patient_service->total_price , 0, ',', '.') }}</td>
                        @if ($index == 0)
                            <td rowspan="{{ $data->length }}" class="text-right">{{ number_format($data->sum , 0, ',', '.') }}</td>
                            <td rowspan="{{ $data->length }}" class="text-right">{{ number_format($data->paid , 0, ',', '.') }}</td>
                            <td rowspan="{{ $data->length }}" class="text-right">{{ number_format($data->debt , 0, ',', '.') }}</td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </table>
    @endcannot

</div>
