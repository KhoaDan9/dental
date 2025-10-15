<div class="flex-col">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Danh mục >> <a href="/reminders">Mẫu lời dặn</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/reminders/create"
               @can('create', \App\Models\Reminder::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
        </div>
    </div>
    @cannot('viewAny', \App\Models\Reminder::class)
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

            @foreach ($reminders as $reminder)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $reminder->id }}</td>
                    <td class="">{{ $reminder->name }}</td>
                    <td class="">{{ $reminder->note }}</td>
                    <td class=" text-center">{{ $reminder->clinic_id }}</td>
                    <td class="text-center">
                        @if ($reminder->active)
                            Bật
                        @else
                            Tắt
                        @endif
                    </td>
                    <td class=" text-center">{{ $reminder->last_update_name }}</td>
                    <td class=" text-center">
                        <a href="/reminders/{{ $reminder->id }}"
                           @can('update', \App\Models\Reminder::class)
                               class="button-a"
                           @else
                               class="cannot-button-a"
                            @endcan
                        >sửa</a> |
                        <button wire:confirm="Bạn có thực sự muốn xóa không?"
                                wire:click='deleteReminder({{ $reminder->id }})'
                                @can('delete', \App\Models\Reminder::class)
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
