<div class="flex-col pt-2">
    @if ($successMessage != '')
        <x-success-message>{{ $successMessage }}</x-success-message>
    @endif
    @if ($errorMessage !== '')
        <x-error-message>{{ $errorMessage }}</x-error-message>
    @endif

    <table class="table-custom table-auto w-full border-collapse border rounded">
        <tr>
            <th class="whitespace-nowrap w-0">TT</th>
            <th class="whitespace-nowrap w-0">Ngày</th>
            <th class="whitespace-nowrap w-0">Giờ</th>
            <th class="whitespace-nowrap w-0 ">Số tiền</th>
            <th class="whitespace-nowrap w-0 ">Bác sỹ</th>
            <th class="whitespace-nowrap w-0">Nội dung</th>
            <th class="whitespace-nowrap w-0">Ghi chú</th>
            <th class="whitespace-nowrap w-0">Cập nhật</th>
            <th class="whitespace-nowrap w-0">Chức năng</th>
        </tr>

        @cannot('viewAny', \App\Models\PatientPayment::class)
            <x-cannot-permission/>
        @else
            @foreach ($patient_payments as $patient_payment)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class=" text-center">{{ \Carbon\Carbon::parse($patient_payment->date)->format('d/m/Y') }}</td>
                    <td class=" text-center">{{ \Carbon\Carbon::parse($patient_payment->date)->format('H:i') }}</td>
                    <td class=" text-right w-30">{{  number_format($patient_payment->paid , 0, ',', '.')}}</td>
                    <td class="whitespace-nowrap text-center ">{{ $patient_payment->employee->name }}</td>
                    <td class="w-50">{{ $patient_payment->detail }}</td>
                    <td class="w-80">{{ $patient_payment->note }}</td>
                    <td class="w-30 text-center">{{ $patient_payment->last_update_name }}</td>
                    <td class=" text-center">
                        <a href="/patients/{{ $patient_payment->patient->id }}/payments/{{ $patient_payment->id }}"
                           @can('update', \App\Models\PatientPayment::class)
                               class="button-a"
                           @else
                               class="cannot-button-a"
                            @endcan
                        >sửa</a>
                        |
                        <button wire:click.prevent="deletePatientPayment({{ $patient_payment->id }})"
                                @can('delete', \App\Models\PatientPayment::class)
                                    class="button-a"
                                @else
                                    class="cannot-button-a"
                            @endcan>xóa
                        </button>
                    </td>
                </tr>
            @endforeach
        @endcannot
    </table>
</div>

