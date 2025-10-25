<div>
    <x-all-heading head_title="Danh mục" title_1="Mẫu lời dặn" url_1="/reminders"
                   create_url="/reminders/create" :action_model="\App\Models\Reminder::class"/>

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
                        <x-p-active :is_active="$reminder->active"/>
                    </td>
                    <td class=" text-center">{{ $reminder->last_update_name }}</td>
                    <x-action-a-button :action_model="\App\Models\Reminder::class"
                                       edit_url="/reminders/{{ $reminder->id }}"
                                       delete_event="deleteReminder({{ $reminder->id }})"/>

                </tr>
            @endforeach
        </table>
    @endcannot

</div>
