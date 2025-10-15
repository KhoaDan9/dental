<div class="flex-col">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Danh mục >> <a href="/diagnoses">Mẫu chẩn đoán</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/diagnoses/create"
               @can('create', \App\Models\Diagnosis::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
        </div>
    </div>

    @cannot('viewAny', \App\Models\Diagnosis::class)
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
                <th class="whitespace-nowrap w-1/5 text-left">Tên mẫu chẩn đoán</th>
                <th class="whitespace-nowrap w-1/7">Ghi chú</th>
                <th class="whitespace-nowrap w-0">PK</th>
                <th class="whitespace-nowrap w-0">Tên nhóm</th>
                <th class="whitespace-nowrap w-0">Trạng thái</th>
                <th class="whitespace-nowrap w-0">Cập nhật</th>
                <th class="whitespace-nowrap w-0">Chức năng</th>
            </tr>
            @foreach ($diagnoses as $diagnosis)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $diagnosis->id }}</td>
                    <td class="">{{ $diagnosis->name }}</td>
                    <td class="">{{ $diagnosis->note }}</td>
                    <td class=" text-center">{{ $diagnosis->clinic_id }}</td>
                    <td class=" text-center">{{ $diagnosis->diagnosisGroup->name }}</td>
                    <td class="text-center">
                        @if ($diagnosis->active)
                            Bật
                        @else
                            Tắt
                        @endif
                    </td>
                    <td class=" text-center">{{ $diagnosis->last_update_name }}</td>
                    <td class=" text-center">
                        <a href="/diagnoses/{{ $diagnosis->id }}"
                           @can('update', \App\Models\Diagnosis::class)
                               class="button-a"
                           @else
                               class="cannot-button-a"
                            @endcan>sửa</a> |
                        <button wire:confirm="Bạn có thực sự muốn xóa không?"
                                wire:click='deleteDiagnosis({{ $diagnosis->id }})'
                                @can('delete', \App\Models\Diagnosis::class)
                                    class="button-a"
                                @else
                                    class="cannot-button-a"
                            @endcan>xóa
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endcannot

</div>
