<div class="flex-col">
    <div class="page-header">
        <div>
            <span>Dữ liệu >> <a href="/appointments">Lịch hẹn</a></span>
        </div>
        <div class="flex space-x-1">
            <div class="flex items-center space-x-1">
                <span>Từ</span>
                <input type="date" class="pl-1 border-gray-500 border-1" wire:model="from_date">
                <span>Đến</span>
                <input type="date" class="pl-1 border-gray-500 border-1" wire:model="to_date">
            </div>
            <button wire:click='searchAppointment' class="main-button" wire:navigate.hover>Tìm</button>
        </div>
    </div>

    @cannot('viewAny', \App\Models\Appointment::class)
        <x-cannot-permission/>
    @else

        @if ($successMessage != '')
            <x-success-message>{{ $successMessage }}</x-success-message>
        @endif

        @if ($errorMessage !== '')
            <x-error-message>{{ $errorMessage }}</x-error-message>
        @endif
        <div class="rounded">
            @if(count($appointments) == 0)
                <p>Không có lịch hẹn nào.</p>
            @endif
            @foreach ($appointments as $date => $appointments_sort)
                <div class="bg-gray-200 p-2">
                    <strong>
                        {{ $date }}
                    </strong>
                </div>
                <table class="table-custom table-auto w-full border-collapse border">
                    <tr>
                        <th class="whitespace-nowrap w-0">TT</th>
                        <th class="whitespace-nowrap w-0">Giờ hẹn</th>
                        <th class="whitespace-nowrap w-0 ">Khách hàng</th>
                        <th class="whitespace-nowrap w-0 ">Điện thoại</th>
                        <th class="">Nội dung hẹn</th>
                        <th class="whitespace-nowrap w-0">Ghi chú</th>
                        <th class="whitespace-nowrap w-0">Nhân viên</th>
                        <th class="whitespace-nowrap w-0">PK</th>
                        <th class="whitespace-nowrap w-0">Trạng thái</th>
                        <th class="whitespace-nowrap w-0 mx-4">Chức năng</th>
                    </tr>

                    @foreach ($appointments_sort as $appointment)
                        <tr>
                            <td class=" text-center">{{ $loop->iteration }}</td>
                            <td class=" text-center">{{ \Carbon\Carbon::parse($appointment->date)->format('H:i') }}</td>
                            <td class="w-140 ">
                                <div>
                                    {{ $appointment->patient->name }} - ID: <a href="/patients/{{$appointment->patient_id}}">{{$appointment->patient->clinic_id}}.{{$appointment->patient->id}}</a>
                                    <br>
                                    {{$appointment->patient->address}}
                                </div>
                            </td>
                            <td class="w-40 text-center">{{ $appointment->patient->phone }}</td>
                            <td class="w-40 text-wrap break-words ">{{ $appointment->detail }}</td>
                            <td class="w-40">{{ $appointment->note }}</td>
                            <td class="w-30 text-center">{{ $appointment->employee_name }}</td>
                            <td class=" text-center">{{ $appointment->clinic_id }}</td>
                            <td class="w-30 text-center">
                                <a href="/patients/{{ $appointment->patient->id }}/appointment-status/{{ $appointment->id }}"
                                   @can('update', \App\Models\Appointment::class)
                                       class="button-a"
                                   @else
                                       class="cannot-button-a"
                                    @endcan>{{ $appointment->status }}</a>
                            </td>
                            <x-action-a-button :action_model="\App\Models\Appointment::class"
                                    edit_url="/patients/{{ $appointment->patient->id }}/appointments/{{ $appointment->id }}"
                                    delete_event="deleteAppointment({{ $appointment->id }})"/>
                        </tr>
                    @endforeach
                </table>
            @endforeach
        </div>
    @endcannot

</div>
