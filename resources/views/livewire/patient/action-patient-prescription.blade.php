<div>
    <div class="page-header">
        <div>
        <span>Dữ liệu >> <a href="/patients">Hồ sơ bệnh nhân</a> >>
                <a href="/patients/{{ $patient->id }}">{{ $patient->clinic_id }}.{{ $patient->id }}</a> >>
                <a href="#">Đơn thuốc</a>
        </span>
        </div>
        <div class="flex space-x-1">
            <a href="/patients/{{$patient->id}}/prescriptions/create"
               @can('create', \App\Models\PatientReminder::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
            <a href="/patients/{{ $patient->id }}" class="a-button">Thoát</a>
        </div>

    </div>

    <form wire:submit='actionPatientPrescription'>
        <div class="flex flex-wrap space-y-2 px-2 max-w-250">
            <div class="flex w-full">
                <p for="" class="w-40">Họ tên bệnh nhân:</p>
                <strong class="flex-grow">{{ $patient->name }}</strong>
            </div>
            <div class="w-full flex">
                <p class="w-40">Lần khám:</p>
                <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                        wire:model='form.visit_count'>
                    @foreach ($visit_counts as $visit_count)
                        <option value="{{ $visit_count }}">{{ $visit_count }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex w-full">
                <p for="" class="w-40">Nội dung điều trị:</p>
                <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.name'/>
            </div>
            <div class="flex w-full">
                <p for="" class="w-40">Nội dung đơn thuốc:<span class="text-red-600">*</span></p>
                <div class="flex flex-grow flex-col">
                    <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow h-50"
                              wire:model='form.detail'></textarea>
                    @error('form.detail')
                    <x-error-message>{{ $message }}</x-error-message>
                    @enderror
                </div>

            </div>
            <div class="flex w-full">
                <p for="" class="w-40"></p>
                <button class="main-button" type="button" modal-show-id="prescription-modal">Chọn mẫu</button>
            </div>

            <div class="flex w-full">
                <p for="" class="w-40">Ghi chú:</p>
                <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.note'></textarea>
            </div>
            @if ($is_create != 'create')
                <div class="flex w-full">
                    <p for="" class="w-40">Người cập nhật:</p>
                    <x-last-update-name
                        :name="$patient_prescription->last_update_name">{{ $patient_prescription->updated_at }}</x-last-update-name>
                </div>
            @endif
            @if ($successMessage != '')
                <div class="flex w-full">
                    <p for="" class="w-40"></p>
                    <x-success-message>{{ $successMessage }}</x-success-message>
                </div>
            @endif
            @if ($errorMessage != '')
                <div class="flex w-full">
                    <p for="" class="w-40"></p>
                    <x-error-message>{{ $errorMessage }}</x-error-message>
                </div>
            @endif
            <div class="flex w-full">
                <p for="" class="w-40"></p>
                @if ($is_create == 'create')
                    <button type="submit"
                            @can('create', \App\Models\PatientPrescription::class)
                                class="main-button"
                            @else
                                class="cannot-main-button"
                        @endcan
                    >Lưu
                    </button>
                @else
                    <button type="submit"
                            @can('update', \App\Models\PatientPrescription::class)
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
    </form>
    <div id="prescription-modal" class="modal-parent-div">
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
                        <th class="whitespace-nowrap w-3/5 text-left">Tên mẫu đơn thuốc</th>
                        <th class="whitespace-nowrap w-0">Chức năng</th>
                    </tr>
                    @foreach ($prescriptions as $prescription)
                        <tr>
                            <td class="text-center">{{ $prescription->id }}</td>
                            <td class="">{{ $prescription->name }}</td>
                            <td class="text-center">
                                <button class="text-blue-400 hover:underline hover:cursor-pointer"
                                        wire:click="selectPrescription(({{ $prescription->id }}))"
                                        wire:click.prevent>Chọn
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <livewire:patient.index-patient-prescription :patient_id="$patient->id"/>

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
