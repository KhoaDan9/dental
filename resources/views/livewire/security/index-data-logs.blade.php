<div class="flex-col pt-2">
    {{--        @cannot('viewAny', \App\Models\PatientPayment::class)--}}
    {{--            <x-cannot-permission/>--}}
    {{--        @else--}}
    <table class="table-custom table-auto w-full border-collapse border rounded">
        <tr>
            <th class="whitespace-nowrap w-0">TT</th>
            <th class="whitespace-nowrap w-0">Ngày giờ</th>
            <th class="whitespace-nowrap w-0 ">Người dùng</th>
            <th class="whitespace-nowrap w-0 ">Hành động</th>
            <th class="whitespace-nowrap w-0">Nội dung</th>
            <th class="whitespace-nowrap w-0">ID</th>
            <th class="whitespace-nowrap w-0">Nhóm</th>
            <th class="whitespace-nowrap w-0">Phòng khám</th>
        </tr>


            @foreach ($dataLogs as $dataLog)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class=" text-center">{{ \Carbon\Carbon::parse($dataLog->created_at)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}</td>
                    <td class=" text-center ">{{ $dataLog->user->username }}</td>
                    <td class="w-50">{{ $dataLog->action }}</td>
                    <td class="w-80">{{ $dataLog->detail }}</td>
                    <td class="w-30 text-center">{{ $dataLog->action_id }}</td>
                    <td class="w-30 text-center">{{ $dataLog->group_action }}</td>
                    <td class="w-30 text-center">{{ $dataLog->clinic_id }}</td>
                </tr>
            @endforeach
    </table>
    {{--        @endcannot--}}

</div>

