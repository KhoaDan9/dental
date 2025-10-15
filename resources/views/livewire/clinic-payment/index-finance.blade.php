<div>
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Dữ liệu >> <a href="/finances">Nhóm thu/chi</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/finances/create"
               @can('create', \App\Models\Finance::class)
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

    @cannot('viewAny', \App\Models\Finance::class)
        <x-cannot-permission/>
    @else
    <table class="table-custom table-auto w-full border-collapse border">
        <tr>
            <th class="whitespace-nowrap w-0">TT</th>
            <th class="whitespace-nowrap w-0">ID</th>
            <th class="whitespace-nowrap w-2/5 text-left">Tên nhóm thu/chi</th>
            <th class="whitespace-nowrap w-0">Khoản</th>
            <th class="whitespace-nowrap w-0">Nhóm</th>
            <th class="whitespace-nowrap w-0">Ghi chú</th>
            <th class="whitespace-nowrap w-0">PK</th>
            <th class="whitespace-nowrap w-0">Trạng thái</th>
            <th class="whitespace-nowrap w-0">Cập nhật</th>
            <th class="whitespace-nowrap w-0">Chức năng</th>
        </tr>
        @foreach ($finances as $finance)
            <tr>
                <td class=" text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $finance->id }}</td>
                <td class="">{{ $finance->name }}</td>
                <td class="text-center">
                    @if ($finance->receipt && $finance->payment)
                        Thu/Chi
                    @elseif ($finance->receipt)
                        Thu
                    @else
                        Chi
                    @endif
                </td>
                <td class="">{{ $finance->group }}</td>
                <td class="">{{ $finance->note }}</td>
                <td class=" text-center">{{ $finance->clinic_id }}</td>
                <td class="text-center">
                    @if ($finance->active)
                        Bật
                    @else
                        Tắt
                    @endif
                </td>
                <td class=" text-center">{{ $finance->last_update_name }}</td>
                <td class=" text-center">
                    <a href="/finances/{{ $finance->id }}"
                       @can('update', \App\Models\Finance::class)
                           class="button-a"
                       @else
                           class="cannot-button-a"
                        @endcan
                    >sửa</a> |
                    <button wire:confirm="Bạn có thực sự muốn xóa không?"
                        wire:click='deleteFinance({{ $finance->id }})'
                            @can('delete', \App\Models\Finance::class)
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
