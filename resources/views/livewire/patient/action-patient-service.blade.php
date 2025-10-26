<div>
{{--    <x-all-heading head_title="Dữ liệu" title_1="Hồ sơ bệnh nhân" url_1="/patients"--}}
{{--                   create_url="/patients/{{ $patient->id }}/create"--}}
{{--                   url_2="/patients/{{ $patient->id }}" title_2="{{ $patient->clinic_id }}.{{ $patient->id }}"--}}
{{--                   title_3="Thủ thuật điều trị" exit_url="/patients"--}}
{{--                   :action_model="\App\Models\Patient::class"/>--}}

    <form wire:submit='save'>
        <div class="flex">
            <div class="action-display">
                <x-all-show-text w_title="w-40" title="Tên bệnh nhân:" text="{{ $patient->name }}"/>
                <x-all-text-input w_title="w-40" title="Thời gian thực hiện:" model="form.date" type="datetime-local"/>
                <x-all-text-input w_title="w-40" title="Triệu chứng:" model="form.symptom"/>
                <x-all-text-input w_title="w-40" title="Chẩn đoán:" model="form.diagnosis"/>
                <x-all-modal-input w_title="w-40" title="Thủ thuật điều trị:" model="form.service_name" modal_show_id="service-modal" is_required="true"/>

                <x-all-text-input w_title="w-40" title="Vị trí răng:" model="form.teeth"/>
                <x-all-text-input w_title="w-40" title="Đơn giá:" model="form.price" disabled/>


                <div class="flex space-x-4 w-full ml-40">
                    <div class="">
                        <p>Số lượng:</p>
                        <input type="number" class="border-gray-500 border-[0.5px] rounded px-1 w-30"
                               wire:model.live.debounce.500='form.quantity'>
                    </div>
                    <div class="">
                        <p>Khuyến mại (%):</p>
                        <input type="text" class="border-gray-500 border-[0.5px] rounded px-1"
                               wire:model.live.debounce.500='form.discount1'>
                    </div>
                    <div class="">
                        <p>Khuyến mại (đ):</p>
                        <input type="text" class="border-gray-500 border-[0.5px] rounded number-input px-1"
                               wire:model.live.debounce.500='form.discount2'>
                    </div>
                    <div class="flex-1">
                        <p>Thành tiền</p>
                        <input type="text" class="border-gray-500 border-[0.5px] rounded px-1 w-full"
                               wire:model='form.total_price' disabled>
                    </div>
                </div>
                <x-all-select-input w_title="w-40" model="form.employee_id" title="Bác sỹ thực hiện:" :values="$employees"/>
                <x-all-select-input w_title="w-40" model="form.supporter_id" title="Trợ thủ:" :values="$employees" val_empty="true"/>

                <x-all-textarea w_title="w-40" title="Ghi chú:" model="form.note"/>
                @if ($patient_service)
                    <x-all-last-update-name w_title="w-40" :name="$patient_service->last_update_name"
                                            :updated_at="$patient_service->updated_at"/>
                @endif
                @if ($successMessage != '')
                    <x-success-message class="pl-40">{{ $successMessage }}</x-success-message>
                @endif

                @if ($errorMessage != '')
                    <x-error-message class="pl-40">{{ $errorMessage }}</x-error-message>
                @endif
                {{--                <div class="w-full flex">--}}
                {{--                    <p class="w-40"></p>--}}
                {{--                    <label for="warranty_card" class="flex items-center">--}}
                {{--                        <input type="checkbox" id="warranty_card" wire:model='form.warranty_card'>--}}
                {{--                        Dịch vụ/thủ thuật có thẻ bảo hành--}}
                {{--                    </label>--}}
                {{--                </div>--}}
                <x-action-button w_title="w-40" :action_model="\App\Models\PatientService::class" exit_url="/patients/{{ $patient->id }}"
                                 :is_create="$is_create"/>
            </div>
        </div>

    </form>
    <livewire:patient.index-patient-service :patient_id="$patient->id"/>

    <div id="service-modal" class="modal-parent-div">
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
                        <th class="whitespace-nowrap w-0">Mã số</th>
                        <th class="whitespace-nowrap w-3/5 text-left">Tên thủ thuật/dịch vụ</th>
                        <th class="whitespace-nowrap w-0">ĐVT</th>
                        <th class="whitespace-nowrap w-0">Đơn giá</th>
                        <th class="whitespace-nowrap w-0">Chức năng</th>
                    </tr>
                    @foreach ($services as $service)
                        <tr>
                            <td class=" text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $service->id }}</td>
                            <td class="">{{ $service->name }}</td>
                            <td class="text-center whitespace-nowrap">{{ $service->caculation_unit }}</td>
                            <td class="text-right">{{number_format((int) $service->price, 0, ',', '.')}}</td>
                            <td class="text-center">
                                <button class="modal-select"
                                        wire:click.prevent="selectService(({{ $service->id }}))">Chọn
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div id="diagnosis-modal" class="modal-parent-div">
        <div class="modal-div">
            <div class="modal-header">
                <p class="text-lg font-semibold">Chọn mẫu chẩn đoán</p>
                <button class="modal-close">&times;
                </button>
            </div>
            <div class="modal-body">
                <table class="table-custom table-auto w-full border-collapse border">
                    <tr>
                        <th class="whitespace-nowrap w-0">TT</th>
                        <th class="whitespace-nowrap w-0">Mã số</th>
                        <th class="whitespace-nowrap w-3/5 text-left">Tên mẫu chẩn đoán</th>
                        <th class="whitespace-nowrap w-0">Chức năng</th>
                    </tr>
                    @foreach ($diagnoses as $diagnosis)
                        <tr>
                            <td class=" text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $diagnosis->id }}</td>
                            <td class="">{{ $diagnosis->name }}</td>
                            <td class="text-center">
                                <button class="modal-select"
                                        wire:click.prevent="selectDiagnosis(({{ $diagnosis->id }}))">Chọn
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>

<script>

    document.querySelectorAll('[modal-show-id]').forEach(btn => {
        btn.addEventListener('click', () => {
            const modalId = btn.getAttribute('modal-show-id');
            const modal = document.getElementById(modalId);
            if (modal) modal.style.display = 'flex';
        });
    });

    // Đóng modal
    document.querySelectorAll('.modal-close').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.modal-parent-div').forEach(modal => {
                modal.style.display = 'none';
            })
        });
    });

    window.addEventListener('click', e => {
        if (e.target.classList.contains('modal-parent-div')) {
            e.target.style.display = 'none';
        }
    });
</script>
