<div class="flex-col">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Danh mục >> <a href="/prescriptions">Mẫu đơn thuốc</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/prescriptions/create"
               @can('create', \App\Models\Prescription::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
        </div>
    </div>

    @cannot('viewAny', \App\Models\Prescription::class)
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
                <th class="whitespace-nowrap w-1/5 text-left">Tên mẫu</th>
                <th class="whitespace-nowrap w-1/7">Ghi chú</th>
                <th class="whitespace-nowrap w-0">PK</th>
                <th class="whitespace-nowrap w-0">Trạng thái</th>
                <th class="whitespace-nowrap w-0">Cập nhật</th>
                <th class="whitespace-nowrap w-0">Chức năng</th>
            </tr>
            @foreach ($prescriptions as $prescription)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $prescription->id }}</td>
                    <td class="">{{ $prescription->name }}</td>
                    <td class="">{{ $prescription->note }}</td>
                    <td class=" text-center">{{ $prescription->clinic_id }}</td>
                    <td class="text-center">
                        @if ($prescription->active)
                            Bật
                        @else
                            Tắt
                        @endif
                    </td>
                    <td class=" text-center">{{ $prescription->last_update_name }}</td>
                    <td class=" text-center">
                        <a href="/prescriptions/{{ $prescription->id }}"
                           @can('update', \App\Models\Prescription::class)
                               class="button-a"
                           @else
                               class="cannot-button-a"
                            @endcan
                        >sửa</a> |
                        <button wire:confirm="Bạn có thực sự muốn xóa không?"
                                wire:click='deletePrescription({{ $prescription->id }})'
                                @can('delete', \App\Models\Prescription::class)
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
