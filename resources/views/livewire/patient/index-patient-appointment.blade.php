<div class="flex-col pt-2">


    @if ($successMessage != '')
        <x-success-message>{{ $successMessage }}</x-success-message>
    @endif
    @if ($errorMessage !== '')
        <x-error-message>{{ $errorMessage }}</x-error-message>
    @endif
    <div class="rounded-lg m-4">
        <table class="table-custom table-auto w-full border-collapse border rounded">
            <tr>
                <th class="whitespace-nowrap w-0">TT</th>
                <th class="whitespace-nowrap w-0">Ngày hẹn</th>
                <th class="whitespace-nowrap w-0">Giờ hẹn</th>
                <th class="whitespace-nowrap w-0">Tên lịch hẹn</th>
                <th class="whitespace-nowrap w-0 ">Nội dung hẹn</th>
                <th class="whitespace-nowrap w-0 ">Bác sỹ</th>
                <th class="whitespace-nowrap w-0">Ghi chú</th>
                <th class="whitespace-nowrap w-0">Cập nhật</th>
                <th class="whitespace-nowrap w-0">Chức năng</th>
            </tr>

            @cannot('viewAny', \App\Models\Appointment::class)
                <x-cannot-permission/>
            @else
                @foreach ($patient_appointments as $patient_appointment)
                    <tr class="mt-5">
                        <td class=" text-center">{{ $loop->iteration }}</td>
                        <td class=" text-center">{{ \Carbon\Carbon::parse($patient_appointment->date)->format('d/m/Y') }}</td>
                        <td class=" text-center">{{ \Carbon\Carbon::parse($patient_appointment->date)->format('H:i') }}</td>
                        <td class="w-40 text-wrap ">Lịch hẹn cho lần khám {{ $patient_appointment->visit_count }}</td>
                        <td class="w-140 break-words ">{{ $patient_appointment->detail }}</td>
                        <td class="w-40 text-wrap ">{{ $patient_appointment->employee_name }}</td>
                        <td class="w-40">{{ $patient_appointment->note }}</td>
                        <td class="w-30 text-center">{{ $patient_appointment->last_update_name }}</td>
                        <td class=" text-center"><a
                                href="/patients/{{ $patient_appointment->patient->id }}/appointments/{{ $patient_appointment->id }}">sửa</a>
                            |
                            <button class="button-a"
                                    wire:click.prevent="deleteAppointment({{ $patient_appointment->id }})">xóa
                            </button>
                        </td>
                    </tr>
                @endforeach
        </table>
    </div>
    @endcannot
</div>

