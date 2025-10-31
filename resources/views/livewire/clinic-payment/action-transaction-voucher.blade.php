<div>
    @if($transaction_voucher)
    <x-all-heading head_title="Dữ liệu" title_1="Quản lý thu/chi" url_1="/transaction-vouchers"
                    create_url="/transaction-vouchers/create"
                    :action_model="\App\Models\TransactionVoucher::class"
                    exit_url="/transaction-vouchers" :action_model="\App\Models\TransactionVoucher::class"
                    url_2="/transaction-vouchers/{{$transaction_voucher->id}}"
                     title_2="{{$transaction_voucher->clinic_id.'.'.$transaction_voucher->id}}"/>
    @else
    <x-all-heading head_title="Dữ liệu" title_1="Danh sách dịch vụ/thủ thuật" url_1="/transaction-vouchers"
                    create_url="/transaction-vouchers/create" exit_url="/transaction-vouchers"
                    :action_model="\App\Models\TransactionVoucher::class"/>
    @endif

    <form wire:submit='save'>
        <div class="action-display">
            <x-all-text-input w_title="w-40" title="Ngày thu chi:" model="form.date" type="datetime-local"/>

            <div class="flex w-full">
                <p for="" class="w-40">Loại phiếu:</p>
                <div class="flex space-x-2 flex-1">
                    <label for="status1" class="flex items-center">
                        <input type="radio" id="status1" value=1 wire:model.live.debounce='form.is_receipt'>
                        Phiếu thu
                    </label>
                    <label for="status2" class="flex items-center">
                        <input type="radio" id="status2" value=0 wire:model.live.debounce='form.is_receipt'>
                        Phiếu chi
                    </label>
                </div>
            </div>
            <x-all-text-input w_title="w-40" title="Người nhận tiền:" model="form.recipient"/>
            <x-all-text-input w_title="w-40" title="Điện thoại:" model="form.phone"/>

            <x-all-text-input w_title="w-40" title="Địa chỉ:" model="form.address"/>
            <x-all-select-input w_title="w-40" model="form.finance_id" title="Chi từ quỹ:" :values="$finances"/>
            <div class="flex w-full">
                <p for="" class="w-40">Số tiền:<span class="text-red-600">*</span></p>
                <input type="text" class="p-1 mr-1 border-gray-400 border-[0.5px] rounded outline-none number-input"
                    wire:model='form.money' />đ
                @error('form.money')
                    <x-error-message div-class="pl-1">{{ $message }}</x-error-message>
                @enderror
            </div>
            <x-all-select-input w_title="w-40" model="form.funding_source_id" title="Nhóm thu/chi:" :values="$funding_sources"/>

            <div class="w-full flex">
                <p class="w-40">Hình thức giao dịch:</p>
                <div class="">
                    <label for="radio1" class="flex items-center">
                        <input type="radio" id='radio1' value="Tiền mặt" wire:model='form.type_of_transaction'>
                        Tiền mặt
                    </label>
                    <label for="radio3" class="flex items-center">
                        <input type="radio" id='radio3' value="Chuyển khoản" wire:model='form.type_of_transaction'>
                        Chuyển khoản
                    </label>
                    <label for="radio2" class="flex items-center">
                        <input type="radio" id='radio2' value="Quét thẻ" wire:model='form.type_of_transaction'>
                        Quét thẻ
                    </label>
                </div>
            </div>

            <x-all-text-input w_title="w-40" title="Nội dung:" model="form.detail" is_required="true"/>
            <x-all-textarea w_title="w-40" title="Ghi chú:" model="form.note"/>

            @if ($transaction_voucher)
                <x-all-last-update-name w_title="w-40" :name="$transaction_voucher->last_update_name"
                                        :updated_at="$transaction_voucher->updated_at"/>
            @endif
            @if ($successMessage != '')
                <x-success-message class="pl-40">{{ $successMessage }}</x-success-message>
            @endif

            @if ($errorMessage != '')
                <x-error-message class="pl-40">{{ $errorMessage }}</x-error-message>
            @endif
           <x-action-button w_title="w-40" :action_model="\App\Models\TransactionVoucher::class" 
                exit_url="/transaction-vouchers" :is_create="$is_create"/>
            
        </div>
    </form>
</div>
