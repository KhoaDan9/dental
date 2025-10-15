<div class="flex-col">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Danh mục >> <a href="/materials">Danh mục vật tư</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/materials/create"
               @can('create', \App\Models\Material::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan>Thêm</a>
        </div>
    </div>
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
                    <td class="text-right number">{{ $material->price }}</td>
                    <td class="text-center">{{ $material->monetary_unit }}</td>
                    <td class="">{{ $material->note }}</td>
                    <td class="">{{ $material->materialGroup->name }}</td>
                    <td class=" text-center">{{ $material->clinic_id }}</td>
                    <td class="text-center">
                        @if ($material->active)
                            Bật
                        @else
                            Tắt
                        @endif
                    </td>
                    <td class=" text-center">{{ $material->last_update_name }}</td>
                    <td class=" text-center">
                        <a href="/materials/{{ $material->id }}"
                           @can('update', \App\Models\Material::class)
                               class="button-a"
                           @else
                               class="cannot-button-a"
                            @endcan
                        >sửa</a> |
                        <button wire:confirm="Bạn có thực sự muốn xóa không?"
                                wire:click='deleteMaterial({{ $material->id }})'
                                @can('delete', \App\Models\Material::class)
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
