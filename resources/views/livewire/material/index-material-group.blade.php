<div>
    <x-all-heading head_title="Danh mục" title_1="Nhóm vật tư" url_1="/material-groups"
                   create_url="/material-groups/create" :action_model="\App\Models\MaterialGroup::class"/>
    @cannot('viewAny', \App\Models\MaterialGroup::class)
        <x-cannot-permission/>
    @else
        @if ($errorMessage !== '')
            <x-error-message>{{ $errorMessage }}</x-error-message>
        @endif

        @if ($successMessage != '')
            <x-success-message>{{ $successMessage }}</x-success-message>
        @endif


        <table class="table-custom table-auto w-full border-collapse border">
            <tr>
                <th class="whitespace-nowrap w-0">TT</th>
                <th class="whitespace-nowrap w-0">Mã số</th>
                <th class="whitespace-nowrap w-1/5 text-left">Tên nhóm</th>
                <th class="whitespace-nowrap w-1/7">Ghi chú</th>
                <th class="whitespace-nowrap w-0">PK</th>
                <th class="whitespace-nowrap w-0">Trạng thái</th>
                <th class="whitespace-nowrap w-0">Cập nhật</th>
                <th class="whitespace-nowrap w-0">Chức năng</th>
            </tr>
            @foreach ($material_groups as $material_group)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $material_group->id }}</td>
                    <td class="">{{ $material_group->name }}</td>
                    <td class="">{{ $material_group->note }}</td>
                    <td class=" text-center">{{ $material_group->clinic_id }}</td>
                    <td class="text-center">
                        <x-p-active :is_active="$material_group->active"/>
                    </td>
                    <td class=" text-center">{{ $material_group->last_update_name }}</td>
                    <x-action-a-button :action_model="\App\Models\MaterialGroup::class"
                                       edit_url="/material-groups/{{ $material_group->id }}"
                                       delete_event="deleteMaterialGroup({{ $material_group->id }})"/>
                </tr>
            @endforeach
        </table>
    @endcannot
</div>
