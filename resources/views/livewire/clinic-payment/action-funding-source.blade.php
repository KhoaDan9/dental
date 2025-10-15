<div>
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Dữ liệu >> <a href="/funding-sources">Danh sách nguồn quỹ</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/funding-sources/create"
               @can('create', \App\Models\FundingSource::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
            <a href="/funding-sources" class="a-button">Thoát</a>
        </div>
    </div>

    <form wire:submit='actionFundingSource'>
        <div class="flex flex-wrap pt-2 space-y-2 px-2 max-w-250">
            <div class="flex w-full">
                <p for="" class="w-35">Tên nguồn quỹ:<span class="text-red-600">*</span></p>
                <div class="flex flex-grow flex-col">
                    <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.name'
                           autofocus>
                    @error('form.name')
                    <x-error-message>{{ $message }}</x-error-message>
                    @enderror
                </div>
            </div>

            <div class="w-full flex">
                <p class="w-35">Phòng khám:</p>
                <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                        wire:model='form.clinic_id'>
                    @foreach ($clinics as $clinic)
                        <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex w-full">
                <p for="" class="w-35">Ghi chú:</p>
                <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow h-30"
                          wire:model='form.note'></textarea>
            </div>
            <div class="w-full flex">
                <p class="w-35">Hình thức giao dịch:</p>
                <div class="grid grid-cols-3 space-x-2">
                    <label for="checkbox1" class="flex items-center">
                        <input type="checkbox" id='checkbox1' value="Tiền mặt" wire:model='form.type_of_transaction'>
                        Tiền mặt
                    </label>
                    <label for="checkbox2" class="flex items-center">
                        <input type="checkbox" id='checkbox2' value="Quét thẻ" wire:model='form.type_of_transaction'>
                        Quét thẻ
                    </label>
                    <label for="checkbox3" class="flex items-center">
                        <input type="checkbox" id='checkbox3' value="Chuyển khoản"
                               wire:model='form.type_of_transaction'>
                        Chuyển khoản
                    </label>
                </div>
            </div>
            <div class="flex w-full">
                <p for="" class="w-35">Trạng thái:</p>
                <div class="flex space-x-2 flex-1">
                    <label for="status1" class="flex items-center">
                        <input type="radio" id="status1" value=1 wire:model='form.active'>
                        Bật
                    </label>
                    <label for="status2" class="flex items-center">
                        <input type="radio" id="status2" value=0 wire:model='form.active'>
                        Tắt
                    </label>
                </div>
            </div>
            @if ($funding_source)
                <div class="flex w-full">
                    <p for="" class="w-35">Người cập nhật:</p>
                    <x-last-update-name
                        :name="$funding_source->last_update_name">{{ $funding_source->updated_at }}</x-last-update-name>
                </div>
            @endif
            @if ($successMessage != '')
                <div class="flex w-full">
                    <p for="" class="w-35"></p>
                    <x-success-message>{{ $successMessage }}</x-success-message>
                </div>
            @endif
            @if ($errorMessage != '')
                <div class="flex w-full">
                    <p for="" class="w-35"></p>
                    <x-error-message>{{ $errorMessage }}</x-error-message>
                </div>
            @endif

            <div class="flex w-full">
                <p for="" class="w-35"></p>
                @if ($is_create == 'create')
                    <button type="submit"
                            @can('create', \App\Models\FundingSource::class)
                                class="main-button"
                            @else
                                class="cannot-main-button"
                        @endcan
                    >Thêm
                    </button>
                @else
                    <button type="submit" wire:dirty.remove.attr="disabled" disabled
                            @can('update', \App\Models\FundingSource::class)
                                class="main-button"
                            @else
                                class="cannot-main-button"
                        @endcan>Sửa
                    </button>
                @endif
                <a href="/funding-sources" class="a-button ml-2">Thoát</a>
            </div>
        </div>
    </form>
</div>
