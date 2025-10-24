<div class="flex-col">
    <x-all-heading head_title="Dữ liệu" title_1="Danh sách nhân viên" url_1="/employees" create_url="/employees/create"
                   :action_model="\App\Models\Employee::class"/>

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

                    <x-action-a-button :action_model="\App\Models\Employee::class"
                                       edit_url="/employees/{{ $employee->id }}"
                                       delete_event="deleteEmployee({{ $employee->id }})"/>

                </tr>
            @endforeach
        </table>
    @endcannot
</div>
