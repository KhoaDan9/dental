<div class="flex-col">
    <x-all-heading head_title="Dữ liệu" title_1="Nhóm dịch vụ/thủ thuật" url_1="/service-groups" create_url="/service-groups/create"
                   :action_model="\App\Models\ServiceGroup::class"/>

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
                    <x-action-a-button :action_model="\App\Models\ServiceGroup::class"
                                       edit_url="/service-groups/{{ $service_group->id  }}"
                                       delete_event="deleteServiceGroup({{ $service_group->id  }})"/>
                </tr>
            @endforeach
        </table>
    @endcannot
</div>
