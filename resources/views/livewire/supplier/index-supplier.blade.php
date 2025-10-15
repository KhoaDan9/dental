<div class="flex-col">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Dữ liệu >> <a href="/suppliers">Nhà cung cấp/xưởng</a></span>
        </div>
        <div class="flex space-x-1">
            <a href="/suppliers/create"
               @can('create', \App\Models\Supplier::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
        </div>
    </div>

    @if ($successMessage != '')
        <x-success-message>{{ $successMessage }}</x-success-message>
    @endif

    @if ($errorMessage !== '')
        <x-error-message>{{ $errorMessage }}</x-error-message>
    @endif
    @cannot('viewAny', \App\Models\Supplier::class)
        <x-cannot-permission/>
    @else
        <table class="table-custom table-auto w-full border-collapse border">
            <tr>
                <th class="whitespace-nowrap w-0">TT</th>
                <th class="whitespace-nowrap w-0">Mã số</th>
                <th class="whitespace-nowrap w-1/5 text-left">Tên nhà cung cấp</th>
                <th class="whitespace-nowrap w-0">PK</th>
                <th class="whitespace-nowrap w-0">Địa chỉ</th>
                <th class="whitespace-nowrap w-0">Điện thoại</th>
                <th class="whitespace-nowrap w-0">Email</th>
                <th class="whitespace-nowrap w-0">Ghi chú</th>
                <th class="whitespace-nowrap w-0">Trạng thái</th>
                <th class="whitespace-nowrap w-0">Cập nhật</th>
                <th class="whitespace-nowrap w-0">Chức năng</th>
            </tr>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $supplier->id }}</td>
                    <td class="">{{ $supplier->name }}</td>
                    <td class="text-center">{{ $supplier->clinic_id }}</td>
                    <td class="text-right">{{ $supplier->address }}</td>
                    <td class="text-center">{{ $supplier->phone }}</td>
                    <td class="">{{ $supplier->email }}</td>
                    <td class="">{{ $supplier->note }}</td>
                    <td class="text-center">
                        @if ($supplier->active)
                            Bật
                        @else
                            Tắt
                        @endif
                    </td>
                    <td class=" text-center">{{ $supplier->last_update_name }}</td>
                    <td class=" text-center">
                        <a href="/suppliers/{{ $supplier->id }}"
                           @can('update', \App\Models\Supplier::class)
                               class="button-a"
                           @else
                               class="cannot-button-a"
                            @endcan

                        >sửa</a> |
                        <button wire:confirm="Bạn có thực sự muốn xóa không?"
                                wire:click='deleteSupplier({{ $supplier->id }})'
                                @can('delete', \App\Models\Supplier::class)
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
