<div>
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Dữ liệu >> <a href="/funding-sources">Danh sách nguồn quỹ</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/funding-sources/create"
               @can('create', \App\Models\FundingSource::class)
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

    @cannot('viewAny', \App\Models\FundingSource::class)
        <x-cannot-permission/>
    @else
    <table class="table-custom table-auto w-full border-collapse border">
        <tr>
            <th class="whitespace-nowrap w-0">TT</th>
            <th class="whitespace-nowrap w-2/5 text-left">Tên nguồn quỹ</th>
            <th class="whitespace-nowrap w-0">Ghi chú</th>
            <th class="whitespace-nowrap w-0">PK</th>
            <th class="whitespace-nowrap w-0">Trạng thái</th>
            <th class="whitespace-nowrap w-0">Cập nhật</th>
            <th class="whitespace-nowrap w-0">Chức năng</th>
        </tr>
        @foreach ($funding_sources as $funding_source)
            <tr>
                <td class=" text-center">{{ $loop->iteration }}</td>
                <td class="">{{ $funding_source->name }}</td>
                <td class="">{{ $funding_source->note }}</td>
                <td class=" text-center">{{ $funding_source->clinic_id }}</td>
                <td class="text-center">
                    @if ($funding_source->active)
                        Bật
                    @else
                        Tắt
                    @endif
                </td>
                <td class=" text-center">{{ $funding_source->last_update_name }}</td>
                <td class=" text-center">
                    <a href="/funding-sources/{{ $funding_source->id }}"
                       @can('update', \App\Models\FundingSource::class)
                           class="button-a"
                       @else
                           class="cannot-button-a"
                        @endcan
                    >sửa</a> |
                    <button wire:confirm="Bạn có thực sự muốn xóa không?"
                        wire:click='deleteFundingSource({{ $funding_source->id }})'
                            @can('delete', \App\Models\FundingSource::class)
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
