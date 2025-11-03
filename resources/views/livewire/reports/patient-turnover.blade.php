<div class="report">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300 mb-2">
        <div>
            <span>Báo cáo >> <a href="#">Doanh thu khách hàng</a></span>
        </div>

        <div>
            <form wire:submit.prevent="searchSubmit">
                <div class="flex space-x-1">
                    <div class="flex flex-col">
                        <label for="">Từ (VNĐ):</label>
                        <x-text-input type="text" class="number-input" model="total_from"/>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Đến (VNĐ):</label>
                        <x-text-input type="text" class="number-input" model="total_to"/>
                    </div>
                    <button type="submit" class="main-button">Tìm</button>

                </div>

            </form>
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
                <th class="whitespace-nowrap w-0">NS</th>
                <th class="whitespace-nowrap w-0">GT</th>
                <th class="whitespace-nowrap w-0 text-left">Địa chỉ</th>
                <th class="whitespace-nowrap w-0 text-left">Điện thoại</th>
                <th class="whitespace-nowrap w-0 text-left">Nhóm thủ thuật sử dụng</th>
                <th class="whitespace-nowrap w-0 text-left">Thực hiện</th>
                <th class="whitespace-nowrap w-0">Phải trả</th>
                <th class="whitespace-nowrap w-0">Đã thu</th>
                <th class="whitespace-nowrap w-0">Còn nợ</th>
                <th class="whitespace-nowrap w-0">Lần cuối</th>
            </tr>
            @foreach ($data_list as $data)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center"><a href="/patients/{{ $data->id }}">{{ $data->clinic_id . '.' . $data->id }}</a></td>
                    <td><a href="/patients/{{ $data->id }}" class="whitespace-nowrap">{{ $data->name }}</a></td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($data->birth)->year }}</td>
                    <td class="text-center">{{ $data->gender }}</td>
                    <td>{{ $data->address }}</td>
                    <td class="whitespace-nowrap">{{ $data->phone }}</td>
                    <td class="w-60">{{ $data->service_groups }}</td>
                    <td class="w-45">{{ $data->employees }}</td>
                    <td class="text-right">{{ number_format($data->total_price , 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($data->paid , 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($data->debt , 0, ',', '.') }}</td>
                    <td class="text-center whitespace-nowrap">{{ \Carbon\Carbon::parse($data->updated_at)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </table>
    @endcannot

</div>
