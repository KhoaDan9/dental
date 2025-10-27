<div>
    <x-all-heading head_title="Dữ liệu" title_1="Hồ sơ bệnh nhân" url_1="/patients"
                   create_url="/patients/{{$patient->id}}/reminders/create"
                   url_2="/patients/{{ $patient->id }}" title_2="{{ $patient->clinic_id }}.{{ $patient->id }}"
                   title_3="Lời dặn" exit_url="/patients/{{$patient->id}}"
                   :action_model="\App\Models\PatientReminder::class"/>

    @if($error2Message)
        <x-error-message>{{ $error2Message }}</x-error-message>
    @else
        <form wire:submit='save'>
            <div class="action-display">
                <x-all-show-text title="Tên bệnh nhân:" text="{{ $patient->name }}"/>
                <x-all-show-text title="Lần khám:" text="{{ $visit_count }}" disabled/>
                <x-all-textarea class="h-40" title="Nội dung lời dặn:" model="form.detail" is_required="true"/>

                <div class="flex w-full">
                    <p for="" class="w-35"></p>
                    <button class="main-button" type="button" modal-show-id="reminder-modal">Chọn mẫu</button>
                </div>
                <x-all-textarea title="Ghi chú:" model="form.note"/>
                @if ($patient_reminder)
                    <x-all-last-update-name :name="$patient_reminder->last_update_name"
                                            :updated_at="$patient_reminder->updated_at"/>
                @endif

                @if ($successMessage != '')
                    <x-success-message class="pl-35">{{ $successMessage }}</x-success-message>
                @endif

                @if ($errorMessage != '')
                    <x-error-message class="pl-35">{{ $errorMessage }}</x-error-message>
                @endif
                <x-action-button :action_model="\App\Models\PatientReminder::class"
                                 exit_url="/patients/{{ $patient->id }}"
                                 :is_create="$is_create"/>
            </div>
        </form>

        <div id="reminder-modal" class="modal-parent-div">
            <div class="modal-div">
                <div class="modal-header">
                    <p class="text-lg! font-semibold">Chọn thủ thuật/dịch vụ</p>
                    <button class="modal-close">&times;
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table-custom table-auto w-full border-collapse border">
                        <tr>
                            <th class="whitespace-nowrap w-0">TT</th>
                            <th class="whitespace-nowrap w-3/5 text-left">Tên mẫu lời dặn</th>
                            <th class="whitespace-nowrap w-0">Chức năng</th>
                        </tr>
                        @foreach ($reminders as $reminder)
                            <tr>
                                <td class="text-center">{{ $reminder->id }}</td>
                                <td class="">{{ $reminder->name }}</td>
                                <td class="text-center">
                                    <button class="text-blue-400 hover:underline hover:cursor-pointer"
                                            wire:click="selectReminder(({{ $reminder->id }}))"
                                            wire:click.prevent>Chọn
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <livewire:patient.index-patient-reminder :patient_id="$patient->id"/>
    @endif
</div>

<script>
    const btn = document.querySelector('[modal-show-id]');
    btn.addEventListener('click', () => {
        const modalId = btn.getAttribute('modal-show-id');
        const modal = document.getElementById(modalId);
        if (modal) modal.style.display = 'flex';
    });

    document.querySelector('.modal-close').addEventListener('click', () => {
        document.querySelectorAll('.modal-parent-div').forEach(modal => {
            modal.style.display = 'none';
        })
    });

    window.addEventListener('click', e => {
        if (e.target.classList.contains('modal-parent-div')) {
            e.target.style.display = 'none';
        }
    });
</script>
