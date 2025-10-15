<div>
    <div class="page-header">
        <div>
        <span>Dữ liệu >> <a href="/patients">Hồ sơ bệnh nhân</a> >>
                <a href="/patients/{{ $patient->id }}">{{ $patient->clinic_id }}.{{ $patient->id }}</a> >>
                <a href="#">Lịch hẹn</a>
        </span>
        </div>
        <div class="flex space-x-1">
            <a href="/patients/{{$patient->id}}/appointments/create"
               @can('create', \App\Models\Appointment::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
            <a href="/patients/{{ $patient->id }}" class="a-button">Thoát</a>
        </div>

    </div>

    <form wire:submit='actionAppointment'>
        <div class="flex">
            <div class="flex flex-wrap px-2 space-y-2 max-w-250">
                <div class="w-full flex">
                    <p for="" class="w-35">Tên bệnh nhân:</p>
                    <strong>{{ $patient->name }}</strong>
                </div>
                <div class="w-full flex">
                    <p class="w-35">Lần khám:</p>
                    <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                            wire:model='form.visit_count'>
                        @foreach ($visit_counts as $visit_count)
                            <option value="{{ $visit_count }}">{{ $visit_count }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full flex">
                    <p class="w-35">Thời gian hẹn:</p>
                    <input type="datetime-local" class="border-gray-500 border-1 flex-grow " wire:model='form.date'>
                </div>
                <div class="w-full flex">
                    <p class="w-35">Bác sỹ:</p>
                    <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                            wire:model='form.employee_name'>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->name }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full flex">
                    <p class="w-35">Nội dung hẹn:</p>
                    <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow h-20"
                              wire:model='form.detail'></textarea>
                </div>
                <div class="w-full flex">
                    <p class="w-35">Ghi chú:</p>
                    <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow"
                              wire:model='form.note'></textarea>
                </div>
                <div class="w-full flex pt-4">
                    <p class="w-35"></p>
                    @if ($is_create == 'create')
                        <button type="submit"
                                @can('create', \App\Models\Appointment::class)
                                    class="main-button"
                                @else
                                    class="cannot-main-button"
                            @endcan
                        >Thêm
                        </button>
                    @else
                        <button type="submit"
                                @can('update', \App\Models\Appointment::class)
                                    class="main-button"
                                @else
                                    class="cannot-main-button"
                            @endcan
                        >Sửa
                        </button>
                    @endif
                    <a href="/patients/{{ $patient->id }}" class="a-button ml-2">Thoát</a>
                </div>
            </div>
        </div>


        @if ($successMessage != '')
            <x-success-message>{{ $successMessage }}</x-success-message>
        @endif
        @if ($errorMessage != '')
            <x-error-message>{{ $errorMessage }}</x-error-message>
        @endif
    </form>
    <livewire:patient.index-patient-appointment :patient_id="$patient->id"/>


</div>
