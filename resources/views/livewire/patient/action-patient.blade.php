<div>
    @if ($is_create == 'create')
        <livewire:patient.menu-patient exit_url="/patients"/>
    @else
        <livewire:patient.menu-patient exit_url="/patients" :patient="$patient"/>
    @endif

    @cannot('viewAny', \App\Models\Patient::class)
        <x-cannot-permission/>
    @else
        <form wire:submit.prevent='save'>
            <div class="action-display">
                <x-all-text-input title="Tên khách hàng:" model="form.name" is_required name="name"/>
                <div class="w-full flex">
                    <p class="w-35">Ngày sinh:</p>
                    <input type="date" class="pl-1 border-gray-400 border-[0.5px] rounded" wire:model='form.birth'>
                    <label for="gender1" class="pl-5 flex items-center">
                        <input type="radio" id="gender1" value="Nam" checked wire:model='form.gender'>
                        Nam
                    </label>
                    <label for="gender2" class="pl-2 flex items-center">
                        <input type="radio" id="gender2" value="Nữ" wire:model='form.gender'>
                        Nữ
                    </label>
                    <div class="flex flex-row">
                        <p class="pl-2">Số điện thoại:</p>
                        <input type="text" class="px-1 border-gray-400 border-[0.5px] rounded ml-1 w-60"
                               wire:model='form.phone'>
                    </div>
                    <div class="flex flex-row flex-grow">
                        <p class="pl-2 pr-1">Nguồn:</p>
                        <select class="border-gray-400 border-[0.5px] rounded" wire:model='form.from'>
                            <option value="Khác">Khác</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Google">Google</option>
                            <option value="Tiktok">Tiktok</option>
                            <option value="Youtube">Youtube</option>
                        </select>
                        <input type="text" class="px-1 border-gray-400 border-[0.5px] rounded flex-grow"
                               placeholder="Ghi chú nguồn"
                               wire:model='form.from_note'>
                    </div>
                </div>

                <div class="w-full flex items-start">
                    <p class="w-35">Địa chỉ:<span class="text-red-600">*</span></p>
                    <div class="flex flex-grow flex-col">
                        <input type="text" class="px-1 border-gray-400 border-[0.5px] rounded flex-grow"
                               name="address" wire:model='form.address'>
                        @error('form.address')
                        <x-error-message>{{ $message }}</x-error-message>
                        @enderror
                    </div>
                    <p class="pl-2">Xã/Huyện:</p>
                    <input type="text" class="px-1 border-gray-400 border-[0.5px] rounded" wire:model='form.commune'>
                    <p class="pl-2">Tỉnh/T.phố:</p>
                    <input type="text" class="px-1 border-gray-400 border-[0.5px] rounded  ml-1" wire:model='form.city'>
                </div>
                <x-all-select-input model="form.clinic_id" title="Phòng khám:" :values="$clinics"/>


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
                <x-all-text-input title="" model="form.medical_history_note" placeholder="Bệnh khác"/>

                <x-all-textarea title="Ghi chú:" model="form.note"/>

                <x-action-button :action_model="\App\Models\Patient::class" exit_url="/patients"
                                 is_create="$is_create"/>

                @if ($successMessage != '')
                    <x-success-message class="pl-35">{{ $successMessage }}</x-success-message>
                @endif
                @if ($errorMessage != '')
                    <x-error-message class="pl-35">{{ $errorMessage }}</x-error-message>
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
