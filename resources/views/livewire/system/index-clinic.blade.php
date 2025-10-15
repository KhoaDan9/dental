<div>
    <div>
        <span>Hệ thống >> <a href="/clinics">Danh sách phòng khám</a>
        </span>
    </div>
    <div>
        @cannot('viewAny', \App\Models\Clinic::class)
            <x-cannot-permission/>
        @else
            <table class="table-custom table-auto w-full border-collapse border">
                <tr>
                    <th class="whitespace-nowrap w-0">TT</th>
                    <th class="whitespace-nowrap w-0">Mã số</th>
                    <th class="whitespace-nowrap text-left">Tên phòng khám</th>
                    <th class="whitespace-nowrap text-left">Địa chỉ</th>
                    <th class="whitespace-nowrap text-left">Điện thoại</th>
                    <th class="whitespace-nowrap text-left">Email</th>
                    <th class="whitespace-nowrap text-left">Ghi chú</th>
                    <th class="whitespace-nowrap w-0 mx-4">Trạng thái</th>
                    <th class="whitespace-nowrap w-0">Cập nhật</th>
                    <th class="whitespace-nowrap w-0 mx-4">Chức năng</th>
                </tr>
                @foreach ($clinics as $clinic)
                    <tr>
                        <td class=" text-center">{{ $loop->iteration }}</td>
                        <td class=" text-center"><a href="">{{ $clinic->id }}</a></td>
                        <td class="">{{ $clinic->name }}</td>
                        <td class="">{{ $clinic->address }}</td>
                        <td class=" ">{{ $clinic->phone }}</td>
                        <td class="">{{ $clinic->email }}</td>
                        <td class=" text-center">{{ $clinic->note }}</td>
                        <td class=" text-center">
                            @if ($clinic->active == 0)
                                Bật
                            @else
                                Tắt
                            @endif
                        </td>
                        <td class=" text-center">{{ $clinic->last_update_name }}</td>
                        <td class=" text-center"><a href="/clinics/{{ $clinic->id }}">sửa</a> |
                            <button class="disabled:text-gray-500" disabled>xóa</button>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endcannot
    </div>
</div>
