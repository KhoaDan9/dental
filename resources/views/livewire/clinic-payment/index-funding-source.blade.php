<div>
    <x-all-heading head_title="Dữ liệu" title_1="Danh sách nguồn quỹ" url_1="/funding-sources" create_url="/funding-sources/create"
                   :action_model="\App\Models\FundingSource::class"/>

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

                <x-action-a-button :action_model="\App\Models\FundingSource::class"
                                       edit_url="/funding-sources/{{ $funding_source->id }}"
                                       delete_event="deleteFundingSource({{ $funding_source->id }})"/>
            </tr>
        @endforeach
    </table>
    @endcannot
</div>
