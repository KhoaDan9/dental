<div>
    <x-all-heading head_title="Dữ liệu" title_1="Nhóm thu/chi" url_1="/finances" create_url="/finances/create"
                   :action_model="\App\Models\Finance::class"/>

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
                <td class="text-center">{{ $finance->clinic_id }}</td>
                <td class="text-center">
                    @if( $finance->name == "Thu tiền từ bệnh nhân" )
                        <p class="text-gray-400">-</p>
                    @endif
                    @if ($finance->active)
                        Bật
                    @else
                        Tắt
                    @endif
                </td>
                <td class=" text-center">{{ $finance->last_update_name }}</td>
                <x-action-a-button :action_model="\App\Models\Finance::class"
                                   edit_url="/finances/{{ $finance->id }}"
                                   delete_event="deleteFinance({{ $finance->id }})"/>
            </tr>
        @endforeach
    </table>
        @endcannot
</div>
