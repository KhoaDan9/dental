<div class="flex-col">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Dữ liệu >> <a href="/employees">Danh sách nhân viên</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/employees/create"
               @can('create', \App\Models\Employee::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
               @endcan
               >Thêm</a>
        </div>
    </div>
    @cannot('viewAny', \App\Models\Employee::class)
        <x-cannot-permission/>
    @else
        <table class="table-custom table-auto w-full border-collapse border">
            <tr>
                <th class="whitespace-nowrap w-0">TT</th>
                <th class="whitespace-nowrap w-0">ID</th>
                <th class="whitespace-nowrap w-3/12 text-left">Họ và tên</th>
                <th class="whitespace-nowrap w-0">PK</th>
                <th class="whitespace-nowrap w-0">Ngày sinh</th>
                <th class="whitespace-nowrap w-0">Số điện thoại</th>
                <th class="whitespace-nowrap w-0">Trạng thái</th>
                <th class="whitespace-nowrap w-0">Cập nhật</th>
                <th class="whitespace-nowrap w-0">Chức năng</th>
            </tr>
            @foreach ($employees as $employee)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class=" text-center"><a href="/employees/{{ $employee->id }}">{{ $employee->id }}</a></td>
                    <td class="">{{ $employee->name }}</td>
                    <td class=" text-center">{{ $employee->clinic_id }}</td>
                    <td class=" text-center">{{ \Carbon\Carbon::parse($employee->birth)->format('d/m/Y') }}</td>
                    <td class=" text-center">{{ $employee->phone }}</td>
                    <td class=" text-center">
                        @if ($employee->active == 1)
                            Đang làm
                        @else
                            Nghỉ việc
                        @endif
                    </td>
                    <td class=" text-center">{{ $employee->last_update_name }}</td>
                    <td class=" text-center"><a href="/employees/{{ $employee->id }}"
                        @cannot('update', \App\Models\Employee::class)
                            class="cannot-a"
                        @endcannot
                        >sửa</a> |
                        <button wire:click.prevent="deleteEmployee({{ $employee->id }})"
                                @can('delete', \App\Models\Employee::class)
                                    class="button-a"
                                @else
                                    class="cannot-button-a"
                                @endcan
                                wire:confirm="Bạn có thực sự muốn xóa không?">xóa
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endcannot
</div>
