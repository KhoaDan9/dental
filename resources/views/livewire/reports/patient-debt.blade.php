<div class="report">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300 mb-2">
        <div>
            <span>Báo cáo >> <a href="#">Khách hàng nợ tiền</a></span>
        </div>
    </div>
    @cannot('view-report-patient-details')
        <x-cannot-permission/>
    @else
        <table class="table-custom table-auto w-full border-collapse border">
            <tr>
                <th class="whitespace-nowrap w-0">TT</th>
                <th class="whitespace-nowrap w-0">Mã KH</th>
                <th class="whitespace-nowrap w-0 text-left">Họ và tên</th>
                <th class="whitespace-nowrap w-0 text-left">Địa chỉ</th>
                <th class="whitespace-nowrap w-0 text-left">Điện thoại</th>
                <th class="whitespace-nowrap w-0">Lần cuối</th>
                <th class="whitespace-nowrap w-0">Còn nợ</th>
            </tr>
            @foreach ($data_list as $data)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center"><a href="/patients/{{ $data->id }}">{{ $data->clinic_id . '.' . $data->id }}</a></td>
                    <td><a href="/patients/{{ $data->id }}" class="whitespace-nowrap">{{ $data->name }}</a></td>
                    <td>{{ $data->address }}</td>
                    <td>{{ $data->phone }}</td>
                    <td class="text-center whitespace-nowrap">{{ \Carbon\Carbon::parse($data->updated_at)->format('d/m/Y') }}</td>
                    <td class="text-right">{{ number_format($data->debt , 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>
    @endcannot

</div>
