<div>
    <x-all-heading head_title="Danh mục" title_1="Nhóm vật tư" url_1="/materials"
                   create_url="/materials/create" :action_model="\App\Models\Material::class"/>

    @cannot('viewAny', \App\Models\Material::class)
        <x-cannot-permission/>
    @else
        @if ($successMessage != '')
            <x-success-message>{{ $successMessage }}</x-success-message>
        @endif

        @if ($errorMessage !== '')
            <x-error-message>{{ $errorMessage }}</x-error-message>
        @endif

        <table class="table-custom table-auto w-full border-collapse border">
            <tr>
                <th class="whitespace-nowrap w-0">TT</th>
                <th class="whitespace-nowrap w-0">Mã số</th>
                <th class="whitespace-nowrap w-2/5 text-left">Tên vật tư</th>
                <th class="whitespace-nowrap w-0">Mô tả</th>
                <th class="whitespace-nowrap w-0">ĐVT</th>
                <th class="whitespace-nowrap w-0">Đơn giá</th>
                <th class="whitespace-nowrap w-0">Tiền tệ</th>
                <th class="whitespace-nowrap w-0">Ghi chú</th>
                <th class="whitespace-nowrap w-0">Nhóm vật tư</th>
                <th class="whitespace-nowrap w-0">PK</th>
                <th class="whitespace-nowrap w-0">Trạng thái</th>
                <th class="whitespace-nowrap w-0">Cập nhật</th>
                <th class="whitespace-nowrap w-0">Chức năng</th>
            </tr>
            @foreach ($materials as $material)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $material->id }}</td>
                    <td class="">{{ $material->name }}</td>
                    <td class="whitespace-nowrap w-0">{{ $material->describe }}</td>
                    <td class="text-center">{{ $material->caculation_unit }}</td>
                    <td class="text-right number">{{ number_format($material->price , 0, ',', '.') }}</td>
                    <td class="text-center">{{ $material->monetary_unit }}</td>
                    <td class="">{{ $material->note }}</td>
                    <td class="">{{ $material->materialGroup->name }}</td>
                    <td class=" text-center">{{ $material->clinic_id }}</td>
                    <td class="text-center">
                        <x-p-active :is_active="$material->active"/>
                    </td>
                    <td class=" text-center">{{ $material->last_update_name }}</td>
                    <x-action-a-button :action_model="\App\Models\Material::class"
                                       edit_url="/materials/{{ $material->id }}"
                                       delete_event="deleteMaterial({{ $material->id }})"/>
                </tr>
            @endforeach
        </table>
    @endcannot
</div>
