<div>
    <x-all-heading head_title="Dữ liệu" title_1="Hồ sơ bệnh nhân" url_1="/patients"
                   create_url="/patients/{{$patient->id}}/payments/create"
                   url_2="/patients/{{ $patient->id }}" title_2="{{ $patient->clinic_id }}.{{ $patient->id }}"
                   title_3="Thanh toán" exit_url="/patients/{{$patient->id}}"
                   :action_model="\App\Models\PatientPayment::class"/>
    @if($error2Message)
        <x-error-message>{{ $error2Message }}</x-error-message>
    @else
        <form wire:submit='actionPayment'>
            <div class="flex">
                <div class="action-display">
                    <x-all-show-text w_title="w-40" title="Tên bệnh nhân:" text="{{ $patient->name }}"/>
                    <x-all-show-text w_title="w-40" title="Lần khám:" text="{{ $visit_count }}" disabled/>
                    <x-all-text-input w_title="w-40" title="Thời gian thanh toán:" model="form.date" type="datetime-local" disabled/>
                    <x-all-select-input w_title="w-40" model="form.employee_id" title="Thu cho bác sỹ:" :values="$employees"/>

                    <div class="w-full flex">
                        <p class="w-40">Số tiền thực thu:<span class="text-red-600">*</span></p>
                        <div class="flex flex-grow flex-col">
                            <div class="flex flex-grow">
                                <input type="text" class="px-1  border-gray-500 border-1 flex-grow number-input"
                                       wire:model.live.debounce.500='form.paid'>
                                <button wire:click.prevent="getDebit" class="main-button ml-2">Nợ</button>
                            </div>
                            @error('form.paid')
                            <x-error-message>{{ $message }}</x-error-message>
                            @enderror
                        </div>
                    </div>

                    <div class="w-full flex">
                        <p class="w-40">Giao dịch:</p>
                        <select class="border-gray-500 border-1 flex-grow"
                                wire:model.live.debounce='form.type_of_transaction'>
                            <option value="Tiền mặt">Tiền mặt</option>
                            <option value="Chuyển khoản">Chuyển khoản</option>
                            <option value="Quét thẻ">Quét thẻ</option>
                        </select>
                    </div>

                    <x-all-select-input w_title="w-40" model="form.funding_source_id" title="Nguồn quỹ:" :values="$funding_sources"/>
                    @if ($transactionVoucherErrorMessage)
                        <x-error-message class="pl-40">{{ $transactionVoucherErrorMessage }}</x-error-message>
                    @endif

                    <x-all-text-input w_title="w-40" title="Nội dung:" model="form.detail" />
                    <x-all-textarea w_title="w-40" title="Ghi chú:" model="form.note"/>
                    @if ($patient_payment)
                        <x-all-last-update-name w_title="w-40" :name="$patient_payment->last_update_name"
                                                :updated_at="$patient_payment->updated_at"/>
                    @endif

                    <x-action-button w_title="w-40" :action_model="\App\Models\PatientPayment::class"
                                     exit_url="/patients/{{ $patient->id }}"
                                     :is_create="$is_create"/>

                    <div class="w-full flex">
                        <p class="w-40"></p>
                        <span>Tổng phải trả: <strong>{{ $total }}</strong>đ - Đã thu:
                        <strong>{{ $pay }}</strong>đ - Còn nợ: <strong>{{ $debt }}</strong>đ</span>
                    </div>

                    @if ($successMessage != '')
                        <x-success-message class="pl-40">{{ $successMessage }}</x-success-message>
                    @endif
                    @if ($errorMessage != '')
                        <x-error-message class="pl-40">{{ $errorMessage }}</x-error-message>
                    @endif
                </div>
            </div>

        </form>
        <livewire:patient.index-patient-payment :patient_id="$patient->id"/>
    @endif
    </div>
