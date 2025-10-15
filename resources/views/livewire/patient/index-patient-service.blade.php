<div class="pt-2">
    @if ($successMessage != '')
        <x-success-message>{{ $successMessage }}</x-success-message>
    @endif
    @cannot('viewAny', \App\Models\PatientService::class)
        <x-cannot-permission/>
    @else
        @if ($patient_services)
            <table class="table-custom table-auto w-full border-collapse border">
                <tr>
                    <th class="whitespace-nowrap w-0">Lần</th>
                    <th class="whitespace-nowrap w-0">Giờ</th>
                    <th class="whitespace-nowrap text-left">Triệu chứng/Chẩn đoán</th>
                    <th class="whitespace-nowrap text-left">Thủ thuật điều trị</th>
                    <th class="whitespace-nowrap w-0">Thẻ bảo hành</th>
                    <th class="whitespace-nowrap">Bác sỹ</th>
                    <th class="whitespace-nowrap">Trợ thủ</th>
                    <th class="whitespace-nowrap w-0">Đơn giá</th>
                    <th class="whitespace-nowrap w-0">SL</th>
                    <th class="whitespace-nowrap w-0">Khuyến mại</th>
                    <th class="whitespace-nowrap w-0">Thành tiền</th>
                    <th class="whitespace-nowrap text-left">Ghi chú</th>
                    <th class="whitespace-nowrap w-0">Cập nhật</th>
                    <th class="whitespace-nowrap w-0">Chức năng</th>
                </tr>
                @foreach ($patient_services as $visit_count => $patient_service_sort)
                    @foreach ($patient_service_sort as $patient_service)
                        <tr>
                            @if ($loop->iteration == 1)
                                <td class="whitespace-nowrap text-center bg-yellow-100"
                                    rowspan="{{ count($patient_service_sort) }}">
                                    <div class="flex flex-col">
                                        <b>{{ $visit_count }}</b>
                                        {{ $patient_service->date->format('d-m-Y') }}
                                    </div>
                                </td>
                            @endif
                            <td class="text-center">{{ $patient_service->date->format('H:i:s') }}</td>
                            <td class=" text-left">
                                <p>{{ $patient_service->symptom }}</p>
                                @if ($patient_service->diagnosis)
                                    <div class="flex">
                                        <p class="text-red-600">Chẩn đoán: </p>
                                        <p>{{ $patient_service->diagnosis }}</p>
                                    </div>
                                @endif
                            </td>
                            <td class="">{{ $patient_service->service_name }}</td>
                            <td class="text-center">
                                @if ($patient_service->warrantyCard)
                                    @if ($patient_service->warrantyCard->warranty_status != 'Không phát hành')
                                        <a href="/patients/{{ $patient_service->patient_id . '/' . $patient_service->id }}/warranty-card"
                                           @can('viewAny', \App\Models\WarrantyCard::class)
                                               class="button-a"
                                           @else
                                               class="cannot-button-a"
                                            @endcan>
                                            {{ $patient_service->warrantyCard->warranty_status }}
                                        </a>
                                    @else
                                        <a href="/patients/{{ $patient_service->patient_id . '/' . $patient_service->id }}/warranty-card"
                                           @can('create', \App\Models\WarrantyCard::class)
                                               class="button-a"
                                           @else
                                               class="cannot-button-a"
                                            @endcan>
                                            -
                                        </a>
                                    @endif
                                @else
                                    <a href="/patients/{{ $patient_service->patient_id . '/' . $patient_service->id }}/warranty-card"
                                       @can('create', \App\Models\WarrantyCard::class)
                                           class="button-a"
                                       @else
                                           class="cannot-button-a"
                                        @endcan>
                                        -
                                    </a>
                                @endif
                            </td>
                            <td class="text-center">{{ $patient_service->employee_name }}</td>
                            <td class="text-center">{{ $patient_service->supporter_name }}</td>
                            <td class="text-right">{{ number_format($patient_service->price, 0, ',', '.')}}</td>
                            <td class="text-center">{{ $patient_service->quantity }}</td>
                            <td class="text-right">
                                <p class="">{{ number_format($patient_service->discount2 , 0, ',', '.') }}</p>
                                @if($patient_service->discount2 != 0)
                                    <p class="">{{ $patient_service->discount1 }}%</p>
                                @endif
                            </td>
                            <td class="text-right">{{ number_format($patient_service->total_price , 0, ',', '.')  }}</td>
                            <td class="">{{ $patient_service->note }}</td>
                            <td class=" text-center">{{ $patient_service->last_update_name }}</td>

                            <td class=" text-center">
                                <a href="/patients/{{ $patient_id }}/{{ $patient_service->id }}"
                                   @can('update', \App\Models\PatientService::class)
                                       class="button-a"
                                   @else
                                       class="cannot-button-a"
                                    @endcan
                                >sửa</a> |
                                <button wire:click.prevent="deletePatientService({{ $patient_service->id }})"
                                        wire:confirm="Bạn có chắc chắn muốn xóa không?"
                                        @can('delete', \App\Models\PatientService::class)
                                            class="button-a"
                                        @else
                                            class="cannot-button-a"
                                    @endcan

                                >xóa
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        @endif
    @endcannot
</div>

