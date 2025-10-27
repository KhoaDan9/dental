<div>
    <x-all-heading head_title="Dữ liệu" title_1="Hồ sơ bệnh nhân" url_1="/patients"
                   create_url="/patients/{{$patient->id}}/appointments/create"
                   url_2="/patients/{{ $patient->id }}" title_2="{{ $patient->clinic_id }}.{{ $patient->id }}"
                   title_3="Lịch hẹn" exit_url="/patients/{{$patient->id}}"
                   :action_model="\App\Models\Appointment::class"/>
    @if($error2Message)
        <x-error-message>{{ $error2Message }}</x-error-message>
    @else
        <form wire:submit='save'>
            <div class="flex">
                <div class="action-display">
                    <x-all-show-text title="Tên bệnh nhân:" text="{{ $patient->name }}"/>
                    <x-all-show-text title="Lần khám:" text="{{ $visit_count }}" disabled/>
                    <x-all-text-input title="Thời gian hẹn:" model="form.date" type="datetime-local"/>
                    <x-all-select-input model="form.employee_id" title="Bác sỹ:" :values="$employees"/>
                    <x-all-textarea title="Nội dung hẹn:" model="form.detail"/>
                    <x-all-textarea title="Ghi chú:" model="form.note"/>
                    @if ($appointment)
                        <x-all-last-update-name :name="$appointment->last_update_name"
                                                :updated_at="$appointment->updated_at"/>
                    @endif
                    @if ($successMessage != '')
                        <x-success-message class="pl-35">{{ $successMessage }}</x-success-message>
                    @endif

                    @if ($errorMessage != '')
                        <x-error-message class="pl-35">{{ $errorMessage }}</x-error-message>
                    @endif
                    <x-action-button :action_model="\App\Models\Appointment::class"
                                     exit_url="/patients/{{ $patient->id }}"
                                     :is_create="$is_create"/>
                </div>
            </div>
        </form>
        <livewire:patient.index-patient-appointment :patient_id="$patient->id"/>
    @endif

</div>
