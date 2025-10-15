<div class="flex-col">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Dữ liệu >> <a href="/service-groups">Nhóm dịch vụ/thủ thuật</a></span>
        </div>
        <div class="flex space-x-1">
            <a href="/service-groups/create"
               @can('create', \App\Models\ServiceGroup::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
        </div>
    </div>

    @if ($errorMessage !== '')
        <x-error-message>{{ $errorMessage }}</x-error-message>
    @endif

    @if ($successMessage != '')
        <x-success-message>{{ $successMessage }}</x-success-message>
    @endif

    @cannot('viewAny', \App\Models\ServiceGroup::class)
        <x-cannot-permission/>
    @else
        <table class="table-custom table-auto w-full border-collapse border">
            <tr>
                <th class="whitespace-nowrap w-0">TT</th>
                <th class="whitespace-nowrap w-0">Mã số</th>
                <th class="whitespace-nowrap  text-left">Tên nhóm dịch vụ/thủ thuật</th>
                <th class="whitespace-nowrap ">Ghi chú</th>
                <th class="whitespace-nowrap w-0">PK</th>
                <th class="whitespace-nowrap w-0">Trạng thái</th>
                <th class="whitespace-nowrap w-0">Cập nhật</th>
                <th class="whitespace-nowrap w-0">Chức năng</th>
            </tr>
            @foreach ($service_groups as $service_group)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class="text-center"><a href="/service-groups/{{ $service_group->id }}">{{ $service_group->id }}</a></td>
                    <td class="">{{ $service_group->name }}</td>
                    <td class="">{{ $service_group->note }}</td>
                    <td class=" text-center">{{ $service_group->clinic_id }}</td>
                    <td class="text-center">
                        @if ($service_group->active)
                            Bật
                        @else
                            Tắt
                        @endif
                    </td>
                    <td class=" text-center">{{ $service_group->last_update_name }}</td>
                    <td class=" text-center"><a href="/service-groups/{{ $service_group->id }}"
                            @can('update', \App\Models\ServiceGroup::class)
                                class="button-a"
                            @else
                                class="cannot-button-a"
                            @endcan
                        >sửa</a> |
                        <button
                            wire:confirm="Bạn có thực sự muốn xóa không?"
                            wire:click='deleteServiceGroup({{ $service_group->id }})'
                            @can('delete', \App\Models\ServiceGroup::class)
                                class="button-a"
                            @else
                                class="cannot-button-a"
                            @endcan
                        >xóa
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endcannot
</div>
