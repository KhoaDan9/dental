<div class="flex-col">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Danh mục >> <a href="/diagnosis-groups">Nhóm chẩn đoán</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/diagnosis-groups/create"
               @can('create', \App\Models\DiagnosisGroup::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
        </div>
    </div>

    @cannot('viewAny', \App\Models\DiagnosisGroup::class)
        <x-cannot-permission/>
    @else
    @if ($errorMessage !== '')
        <x-error-message>{{ $errorMessage }}</x-error-message>
    @endif

    @if ($successMessage == true)
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
        @foreach ($diagnois_groups as $diagnois_group)
            <tr>
                <td class=" text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $diagnois_group->id }}</td>
                <td class="">{{ $diagnois_group->name }}</td>
                <td class="">{{ $diagnois_group->note }}</td>
                <td class=" text-center">{{ $diagnois_group->clinic_id }}</td>
                <td class="text-center">
                    @if ($diagnois_group->active)
                        Bật
                    @else
                        Tắt
                    @endif
                </td>
                <td class=" text-center">{{ $diagnois_group->last_update_name }}</td>
                <td class=" text-center">
                    <a href="/diagnosis-groups/{{ $diagnois_group->id }}"
                       @can('update', \App\Models\DiagnosisGroup::class)
                           class="button-a"
                       @else
                           class="cannot-button-a"
                        @endcan
                    >sửa</a> |
                    <button wire:confirm="Bạn có thực sự muốn xóa không?"
                        wire:click='deleteDiagnosisGroup({{ $diagnois_group->id }})'
                            @can('delete', \App\Models\DiagnosisGroup::class)
                                class="button-a"
                            @else
                                class="cannot-button-a"
                        @endcan
                    >xóa</button></td>
            </tr>
        @endforeach
    </table>
    @endcannot
</div>
