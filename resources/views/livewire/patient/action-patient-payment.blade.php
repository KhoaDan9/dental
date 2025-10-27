<div>
    <div class="page-header">
        <div>
        <span>Dữ liệu >> <a href="/patients">Hồ sơ bệnh nhân</a> >>
                <a href="/patients/{{ $patient->id }}">{{ $patient->clinic_id }}.{{ $patient->id }}</a> >>
                <a href="#">Thanh toán</a>
        </span>
        </div>
        <div class="flex space-x-1">
            <a href="/patients/{{$patient->id}}/payments/create"
               @can('create', \App\Models\PatientPayment::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
            <a href="/patients/{{ $patient->id }}" class="a-button">Thoát</a>
        </div>

    </div>
    @if($error2Message)
        <x-error-message>{{ $error2Message }}</x-error-message>
    @else
        <form wire:submit='actionPayment'>
            <div class="flex">
                <div class="flex flex-wrap px-2 space-y-2 max-w-250">
                    <div class="w-full flex">
                        <p for="" class="w-40">Tên bệnh nhân:</p>
                        <strong>{{ $patient->name }}</strong>
                    </div>
                    <div class="w-full flex">
                        <p class="w-40">Thời gian thanh toán:</p>
                        <input type="datetime-local" class="border-gray-500 border-1 flex-grow " wire:model='form.date'>
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
                    <div class="w-full flex">
                        <p class="w-40">Thu cho bác sỹ:</p>
                        <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                                wire:model='form.employee_name'>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->name }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full flex">
                        <p class="w-40">Số tiền thực thu:<span class="text-red-600">*</span></p>
                        <div class="flex flex-grow flex-col">
                            <div class="flex flex-grow">
                                <input type="text" class="px-1  border-gray-500 border-1 flex-grow number-input"
                                       wire:model.live.debounce.500='form.paid'>
                                <button wire:click.prevent="getAllPayment" class="main-button ml-2">Nợ</button>
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

                    <div class="w-full flex">
                        <p class="w-40">Nguồn quỹ:</p>
                        <div class="flex flex-grow flex-col">
                            <select class="border-gray-500 border-1 flex-grow">
                                @foreach ($funding_sources as $funding_source)
                                    <option value="{{ $funding_source->id }}">{{ $funding_source->name }}</option>
                                @endforeach
                            </select>
                            @if ($transactionVoucerErrorMessage)
                                <x-error-message>{{ $transactionVoucerErrorMessage }}</x-error-message>
                            @endif
                        </div>
                    </div>

                    <div class="w-full flex">
                        <p class="w-40">Nội dung:</p>
                        <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow"
                                  wire:model='form.detail'></textarea>
                    </div>
                    <div class="w-full flex">
                        <p class="w-40">Ghi chú:</p>
                        <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow"
                                  wire:model='form.note'></textarea>
                    </div>

                    <div class="w-full flex">
                        <p class="w-40"></p>
                        @if ($is_create == 'create')
                            <button type="submit"
                                    @can('create', \App\Models\PatientPayment::class)
                                        class="main-button"
                                    @else
                                        class="cannot-main-button"
                                @endcan
                            >Thêm
                            </button>
                        @else
                            <button type="submit"
                                    @can('update', \App\Models\PatientPayment::class)
                                        class="main-button"
                                    @else
                                        class="cannot-main-button"
                                @endcan
                            >Sửa
                            </button>
                        @endif
                        <a href="/patients/{{ $patient->id }}" class="a-button ml-2">Thoát</a>
                    </div>
                    <div class="w-full flex">
                        <p class="w-40"></p>
                        <span>Tổng phải trả: <strong>{{ $total }}</strong>đ - Đã thu:
                        <strong>{{ $pay }}</strong>đ - Còn nợ: <strong>{{ $debt }}</strong>đ</span>
                    </div>
                    @if ($successMessage)
                        <div class="w-full flex">
                            <p class="w-40"></p>
                            <x-success-message>{{ $successMessage }}</x-success-message>
                        </div>
                    @endif
                    @if ($errorMessage)
                        <div class="w-full flex">
                            <p class="w-40"></p>
                            <x-error-message>{{ $errorMessage }}</x-error-message>
                        </div>
                    @endif
                </div>
            </div>

        </form>
        <livewire:patient.index-patient-payment :patient_id="$patient->id"/>
    @endif

</div>
