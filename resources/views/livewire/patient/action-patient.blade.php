<div class="">
    @if ($is_create == 'create')
        <livewire:patient.menu-patient exit_url="/patients"/>
    @else
        <livewire:patient.menu-patient exit_url="/patients" :patient="$patient"/>
    @endif

    @cannot('viewAny', \App\Models\Patient::class)
        <x-cannot-permission/>
    @else
        <form wire:submit='actionPatient' id="patient-form">
            <div class="max-w-250 flex flex-wrap space-y-2 pt-2">
                <div class="w-full flex items-start">
                    <p class="w-35">Tên khách hàng:<span class="text-red-600">*</span></p>
                    <div class="flex flex-grow flex-col">
                        <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.name'>
                        @error('form.name')
                        <x-error-message>{{ $message }}</x-error-message>
                        @enderror
                    </div>
                    <p class="pl-5">Ngày sinh:</p>
                    <input type="date" class="border-gray-500 border-1 ml-1" wire:model='form.birth'>
                    <label for="gender1" class="pl-5 flex items-center">
                        <input type="radio" id="gender1" value="Nam" checked wire:model='form.gender'>
                        Nam
                    </label>
                    <label for="gender2" class="pl-2 flex items-center">
                        <input type="radio" id="gender2" value="Nữ" wire:model='form.gender'>
                        Nữ
                    </label>
                </div>
                <div class="w-full flex">
                    <p class="w-35">Nguồn:</p>
                    <select class="border-gray-500 border-1" wire:model='form.from'>
                        <option value="Khác">Khác</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Google">Google</option>
                        <option value="Tiktok">Tiktok</option>
                        <option value="Youtube">Youtube</option>
                    </select>
                    <input type="text" class="px-1 border-gray-500 border-1 flex-grow" placeholder="Ghi chú nguồn"
                           wire:model='form.from_note'>
                </div>
                <div class="w-full flex items-start">
                    <p class="w-35">Địa chỉ:<span class="text-red-600">*</span></p>
                    <div class="flex flex-grow flex-col">
                        <input type="text" class="px-1 border-gray-500 border-1 flex-grow " wire:model='form.address'>
                        @error('form.address')
                        <x-error-message>{{ $message }}</x-error-message>
                        @enderror

                    </div>
                    <p class="pl-2">Số điện thoại:</p>
                    <input type="text" class="px-1 border-gray-500 border-1 w-80 ml-1" wire:model='form.phone'>
                </div>
                <div class="w-full flex">
                    <p class="w-35">Xã/Huyện:</p>
                    <input type="text" class="px-1 border-gray-500 border-1" wire:model='form.commune'>
                    <p class="pl-2">Tỉnh/T.phố:</p>
                    <input type="text" class="px-1 border-gray-500 border-1 flex-grow ml-1" wire:model='form.city'>
                </div>
                <div class="w-full flex">
                    <p class="w-35">Phòng khám</p>
                    <input type="text" class="text-gray-700 px-1 border-gray-700 border-1 flex-grow"
                           wire:model='clinic_name' disabled>
                </div>
                <div class="w-full flex">
                    <p class="w-35">Tiểu sử bệnh:</p>
                    <div class="grid grid-cols-5 space-x-5">
                        <label for="checkbox1" class="flex items-center">
                            <input type="checkbox" id='checkbox1' value="Chảy máu lâu"
                                   wire:model='form.medical_history'>
                            Chảy máu lâu
                        </label>
                        <label for="checkbox2" class="flex items-center">
                            <input type="checkbox" id='checkbox2' value="Phản ứng thuốc"
                                   wire:model='form.medical_history'>
                            Phản ứng thuốc
                        </label>
                        <label for="checkbox3" class="flex items-center">
                            <input type="checkbox" id='checkbox3' value="Dị ứng, thấp khớp"
                                   wire:model='form.medical_history'>
                            Dị ứng, thấp khớp
                        </label>
                        <label for="checkbox4" class="flex items-center">
                            <input type="checkbox" id='checkbox4' value="Cao huyết áp"
                                   wire:model='form.medical_history'>
                            Cao huyết áp
                        </label>
                        <label for="checkbox5" class="flex items-center">
                            <input type="checkbox" id='checkbox5' value="Tim mạch " wire:model='form.medical_history'>
                            Tim mạch
                        </label>
                        <label for="checkbox6" class="flex items-center">
                            <input type="checkbox" id='checkbox6' value="Tiểu đường" wire:model='form.medical_history'>
                            Tiểu đường
                        </label>
                        <label for="checkbox7" class="flex items-center">
                            <input type="checkbox" id='checkbox7' value="Dạ dày, tiêu hóa"
                                   wire:model='form.medical_history'>
                            Dạ dày, tiêu hóa
                        </label>
                        <label for="checkbox8" class="flex items-center">
                            <input type="checkbox" id='checkbox8' value="Bệnh phổi" wire:model='form.medical_history'>
                            Bệnh phổi
                        </label>
                        <label for="checkbox9" class="flex items-center">
                            <input type="checkbox" id='checkbox9' value="Bệnh truyền nhiễm"
                                   wire:model='form.medical_history'>
                            Bệnh truyền nhiễm
                        </label>
                    </div>
                </div>
                <div class="w-full flex">
                    <p class="w-35"></p>
                    <input type="text" class="border-gray-500 border-1  px-1 flex-grow" placeholder="Bệnh khác"
                           wire:model='form.medical_history_note'>
                </div>
                <div class="w-full flex">
                    <p class="w-35">Ghi chú</p>

                    <textarea type="text" class="border-gray-500 border-1  px-1 flex-grow placeholder-gray-500"
                              placeholder="Nhập nội dung khám tại đây... " wire:model='form.note'></textarea>
                </div>
                <div class="w-full flex">
                    <p class="w-35"></p>

                    @if ($is_create == 'create')
                        <button type="submit" form="patient-form"
                                @can('create', \App\Models\Patient::class)
                                    class="main-button"
                                @else
                                    class="cannot-main-button"
                            @endcan
                        >Thêm
                        </button>
                    @else
                        <button type="submit" form="patient-form"
                                wire:dirty.remove.attr='disabled' disabled
                                @can('update', \App\Models\Patient::class)
                                    class="main-button"
                                @else
                                    class="cannot-main-button"
                            @endcan
                        >Sửa
                        </button>
                    @endif
                </div>

                @if ($successMessage != '')
                    <div class="w-full flex">
                        <p class="w-35"></p>
                        <x-success-message>{{ $successMessage }}</x-success-message>
                    </div>
                @endif

            </div>
        </form>


        @if ($is_create != 'create')
            <div class="flex space-x-1 justify-end">
                <a href="/patients/{{ $patient->id }}/create"
                   @can('create', \App\Models\PatientService::class)
                       class="a-button2"
                   @else
                       class="cannot-a-button2"
                    @endcan
                >Thêm thủ thuật</a>
                <a href="/patients/{{ $patient->id }}/appointments/create"
                   @can('viewAny', \App\Models\Appointment::class)
                       class="a-button"
                   @else
                       class="cannot-a-button"
                    @endcan
                >Lịch hẹn</a>
                <a href="/patients/{{ $patient->id }}/reminders/create"
                   @can('viewAny', \App\Models\PatientReminder::class)
                       class="a-button"
                   @else
                       class="cannot-a-button"
                    @endcan
                >Lời dặn</a>
                <a href="/patients/{{ $patient->id }}/prescriptions/create"
                   @can('viewAny', \App\Models\PatientPrescription::class)
                       class="a-button"
                   @else
                       class="cannot-a-button"
                    @endcan
                >Đơn thuốc</a>
                <a href="/patients/{{ $patient->id }}/payments/create"
                   @can('viewAny', \App\Models\PatientPayment::class)
                       class="a-button2"
                   @else
                       class="cannot-a-button2"
                    @endcan
                >Thanh toán</a>
                <a href="/patients/{{ $patient->id }}/invoice"
                   @can('viewAny', \App\Models\PatientPayment::class)
                       class="a-button2"
                   @else
                       class="cannot-a-button2"
                    @endcan
                >In bệnh án</a>
            </div>
            <div class="flex justify-between">
                <strong>Thủ thuật điều trị</strong>
                <div>
                <span>Tổng phải trả: <strong>{{ $total }}</strong>đ - Đã thu:
                    <strong>{{ $pay }}</strong>đ - Còn nợ: <strong>{{ $debt }}</strong>đ</span>
                </div>
            </div>
            <livewire:patient.index-patient-service :patient_id="$patient->id"/>
        @endif
    @endcannot
</div>
