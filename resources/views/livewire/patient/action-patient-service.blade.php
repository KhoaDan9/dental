<div>
    <div class="pb-2 flex justify-between border-b-1 border-gray-300 mb-2">
        <div>
        <span>Dữ liệu >> <a href="/patients">Hồ sơ bệnh nhân</a> >>
                <a href="/patients/{{ $patient->id }}">{{ $patient->clinic_id }}.{{ $patient->id }}</a> >>
                <a href="#">Thủ thuật điều trị</a>
        </span>
        </div>
        <div class="flex space-x-1">
            <a href="/patients/"
               @can('create', \App\Models\PatientService::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
            <a href="/patients/{{ $patient->id }}" class="a-button">Thoát</a>
        </div>
    </div>

    <form wire:submit='actionPatientService'>
        <div class="flex">
            <div class="flex flex-wrap px-2 space-y-2 max-w-250">
                <div class="w-full flex">
                    <p for="" class="w-40">Tên bệnh nhân:</p>
                    <input type="text" class="px-1 border-gray-500 border-1 flex-grow" value="{{ $patient->name }}">
                </div>
                <div class="w-full flex">
                    <p class="w-40">Thời gian thực hiện:</p>
                    <input type="datetime-local" class="px-1 border-gray-500 border-1 flex-grow "
                           wire:model='form.date'>
                </div>
                <div class="w-full flex">
                    <p class="w-40">Triệu chứng:</p>
                    <input type="text" class="px-1  border-gray-500 border-1 flex-grow" wire:model='form.symptom'>
                </div>
                <div class="w-full flex">
                    <p class="w-40">Chẩn đoán:</p>
                    <input type="text" class="px-1  border-gray-500 border-1 flex-grow" wire:model='form.diagnosis'>
                    <button class="main-button mx-1" type="button" modal-show-id="diagnosis-modal">Chọn</button>
                </div>
                <div class="w-full flex">
                    <p class="w-40">Thủ thuật điều trị:<span class="text-red-600">*</span></p>
                    <div class="flex flex-grow flex-col">
                        <div class="flex flex-grow">
                            <input type="text" class="px-1  border-gray-500 border-1 flex-grow"
                                   wire:model='form.service_name' readonly>
                            <button class="main-button mx-1" type="button" modal-show-id="service-modal">Chọn</button>
                        </div>
                        @error('form.service_name')
                        <x-error-message>{{ $message }}</x-error-message>
                        @enderror
                    </div>

                </div>
                <div class="w-full flex">
                    <p class="w-40">Vị trí răng:</p>
                    <input type="text" class="px-1  border-gray-500 border-1 flex-grow" wire:model='form.teeth'>
                </div>
                <div class="w-full flex">
                    <p class="w-40">Đơn giá:</p>
                    <input type="text" class="px-1  border-gray-500 border-1 flex-grow" wire:model='form.price'
                           disabled>
                </div>
                    <div class="flex space-x-4 w-full ml-40">
                        <div class="">
                            <p>Số lượng:</p>
                            <input type="number" class="border-gray-500 border-1 px-1 w-30"
                                   wire:model.live.debounce.500='form.quantity'>
                        </div>
                        <div class="">
                            <p>Khuyến mại (%):</p>
                            <input type="text" class="border-gray-500 border-1 px-1"
                                   wire:model.live.debounce.500='form.discount1'>
                        </div>
                        <div class="">
                            <p>Khuyến mại (đ):</p>
                            <input type="text" class="border-gray-500 border-1 number-input px-1"
                                   wire:model.live.debounce.500='form.discount2'>
                        </div>
                        <div class="flex-1">
                            <p>Thành tiền</p>
                            <input type="text" class="border-gray-500 border-1 px-1 w-full"
                                   wire:model='form.total_price' disabled>
                        </div>
                    </div>
                <div class="w-full flex">
                    <p class="w-40">Bác sỹ thực hiện:</p>
                    <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                            wire:model='form.employee_name'>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->name }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full flex">
                    <p class="w-40">Trợ thủ</p>
                    <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                            wire:model='form.supporter_name'>
                        <option value="">-</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->name }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full flex">
                    <p class="w-40">Ghi chú</p>
                    <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow h-20"
                              wire:model='form.note'></textarea>
                </div>
{{--                <div class="w-full flex">--}}
{{--                    <p class="w-40"></p>--}}
{{--                    <label for="warranty_card" class="flex items-center">--}}
{{--                        <input type="checkbox" id="warranty_card" wire:model='form.warranty_card'>--}}
{{--                        Dịch vụ/thủ thuật có thẻ bảo hành--}}
{{--                    </label>--}}
{{--                </div>--}}
            </div>
        </div>
        <div class="w-full flex pt-4 space-x-1">
            <p class="w-40"></p>
            @if ($is_create == 'create')
                <button type="submit"
                        @can('create', \App\Models\PatientService::class)
                            class="main-button"
                        @else
                            class="cannot-main-button"
                    @endcan
                >Thêm
                </button>
            @else
                <button type="submit"
                        @can('update', \App\Models\PatientService::class)
                            class="main-button"
                        @else
                            class="cannot-main-button"
                    @endcan
                >Sửa
                </button>
            @endif
            <a href="/patients/{{ $patient->id }}" class="a-button">Thoát</a>
        </div>
        <div class="w-full flex pt-4 space-x-1">
            <p class="w-40"></p>
            @if ($successMessage != '')
                <x-success-message>{{ $successMessage }}</x-success-message>
            @endif
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
