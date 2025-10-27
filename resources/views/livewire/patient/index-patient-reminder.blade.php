<div class="pt-2 w-full">

    @if ($successMessage == true)
        <x-success-message>{{ $successMessage }}</x-success-message>
    @endif
    <table class="table-custom table-auto w-full border-collapse border">
        <tr>
            <th class="whitespace-nowrap w-0">TT</th>
            <th class="whitespace-nowrap w-0">Ngày</th>
            <th class="whitespace-nowrap w-0">Giờ</th>
            <th class="whitespace-nowrap w-1/5">Tên lời dặn</th>
            <th class="whitespace-nowrap ">Ghi chú</th>
            <th class="whitespace-nowrap w-0">Cập nhật</th>
            <th class="whitespace-nowrap w-0">Chức năng</th>
        </tr>
        @cannot('viewAny', \App\Models\PatientReminder::class)
            <x-cannot-permission/>
        @else
            @if ($patient_reminders)
                @foreach ($patient_reminders as $patient_reminder)
                    <tr>
                        <td class=" text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($patient_reminder->created_at)->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y')   }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($patient_reminder->created_at)->timezone('Asia/Ho_Chi_Minh')->format('H:i')   }}</td>
                        <td class="">Lời dặn cho lần khám thứ {{ $patient_reminder->visit_count }}</td>
                        <td class="">{{ $patient_reminder->note }}</td>
                        <td class=" text-center">{{ $patient_reminder->last_update_name }}</td>
                        <td class=" text-center">
                            <a href="/patients/{{ $patient_reminder->patient_id }}/reminders/{{ $patient_reminder->id }}"
                               @can('update', \App\Models\PatientReminder::class)
                                   class="button-a"
                               @else
                                   class="cannot-button-a"
                                @endcan
                            >sửa</a> |
                            <button wire:confirm="Bạn có thực sự muốn xóa không?"
                                    wire:click='deletePatientReminder({{ $patient_reminder->id }})'
                                    @can('delete', \App\Models\PatientReminder::class)
                                        class="button-a"
                                    @else
                                        class="cannot-button-a"
                                @endcan
                            >xóa
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif

    </table>
    @endcannot
</div>
