<div>
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Dữ liệu >> <a href="/transaction-vouchers">Quản lý thu/chi</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/transaction-vouchers/create" class="a-button">Thêm</a>
            <a href="/transaction-vouchers" class="a-button">Thoát</a>
        </div>
    </div>

    <form wire:submit='actionTransactionVoucher'>
        <div class="flex flex-wrap pt-2 space-y-2 px-2 max-w-250">
            <div class="w-full flex">
                <p class="w-40">Ngày thu chi:</p>
                <input type="datetime-local" class="border-gray-500 border-1 flex-grow " wire:model='form.date'>
            </div>
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
            <div class="flex w-full">
                <p for="" class="w-40">Người nhận tiền:</p>
                <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.recipient' />
            </div>
            <div class="flex w-full">
                <p for="" class="w-40">Điện thoại:</p>
                <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.phone' />
            </div>
            <div class="flex w-full">
                <p for="" class="w-40">Địa chỉ:</p>
                <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.address' />
            </div>

            <div class="w-full flex">
                <p class="w-40">Nhóm thu/chi:</p>
                <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                    wire:model='form.finance_id'>
                    @foreach ($finances as $finance)
                        <option value="{{ $finance->id }}">{{ $finance->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex w-full">
                <p for="" class="w-40">Số tiền:<span class="text-red-600">*</span></p>
                <input type="text" class="px-1 mr-1 text-right border-gray-500 border-1 w-40 number-input"
                    wire:model='form.money' />đ
                @error('form.money')
                    <x-error-message div-class="pl-1">{{ $message }}</x-error-message>
                @enderror
            </div>
            <div class="w-full flex">
                <p class="w-40">{{ $title }}</p>
                <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                    wire:model='form.funding_source_id'>
                    @foreach ($funding_sources as $funding_source)
                        <option value="{{ $funding_source->id }}">{{ $funding_source->name }}</option>
                    @endforeach
                </select>
            </div>
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
            <div class="flex w-full">
                <p for="" class="w-40">Nội dung:<span class="text-red-600">*</span></p>
                <div class="flex flex-grow flex-col">
                    <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.detail' />
                    @error('form.detail')
                        <x-error-message>{{ $message }}</x-error-message>
                    @enderror
                </div>
            </div>
            <div class="flex w-full">
                <p for="" class="w-40">Ghi chú:</p>
                <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow h-20" wire:model='form.note'></textarea>
            </div>

            @if ($transaction_voucher)
                <div class="flex w-full">
                    <p for="" class="w-40">Người cập nhật:</p>
                    <x-last-update-name :name="$transaction_voucher->last_update_name">{{ $transaction_voucher->updated_at }}</x-last-update-name>
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
                    <button type="submit" class="main-button mr-2">Thêm</button>
                @else
                    <button type="submit" class="main-button mr-2" wire:dirty.remove.attr="disabled"
                        disabled>Sửa</button>
                @endif
                <a href="/transaction-vouchers" class="a-button">Thoát</a>
            </div>
        </div>
    </form>
</div>
