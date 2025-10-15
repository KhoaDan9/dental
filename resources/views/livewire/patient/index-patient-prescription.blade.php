<div class="pt-2 w-full">
    @if ($successMessage == true)
        <x-success-message>{{ $successMessage }}</x-success-message>
    @endif

    <table class="table-custom table-auto w-full border-collapse border">
        <tr>
            <th class="whitespace-nowrap w-0">TT</th>
            <th class="whitespace-nowrap w-0">Ngày</th>
            <th class="whitespace-nowrap w-0">Giờ</th>
            <th class="whitespace-nowrap ">Tên đơn thuốc</th>
            <th class="whitespace-nowrap ">Ghi chú</th>
            <th class="whitespace-nowrap w-0">Cập nhật</th>
            <th class="whitespace-nowrap w-0">Chức năng</th>
        </tr>
        @cannot('viewAny', \App\Models\PatientPrescription::class)
            <x-cannot-permission/>
        @else
            @if ($patient_prescriptions)
                @foreach ($patient_prescriptions as $patient_prescription)
                    <tr>
                        <td class=" text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($patient_prescription->created_at)->format('d/m/Y')   }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($patient_prescription->created_at)->format('H:i')   }}</td>
                        <td class="">Đơn thuốc cho lần khám thứ {{ $patient_prescription->visit_count }}</td>
                        <td class="">{{ $patient_prescription->note }}</td>
                        <td class=" text-center">{{ $patient_prescription->last_update_name }}</td>
                        <td class=" text-center">
                            <a href="/patients/{{ $patient_prescription->patient_id }}/prescriptions/{{ $patient_prescription->id }}"
                               @can('update', \App\Models\PatientPrescription::class)
                                   class="button-a"
                               @else
                                   class="cannot-button-a"
                                @endcan
                            >sửa</a> |
                            <button wire:confirm="Bạn có thực sự muốn xóa không?"
                                    wire:click='deletePatientPrescription({{ $patient_prescription->id }})'
                                    @can('delete', \App\Models\PatientPrescription::class)
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
        @endcannot
    </table>
</div>
