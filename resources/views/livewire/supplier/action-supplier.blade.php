<div>
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Dữ liệu >> <a href="/suppliers">Nhà cung cấp/xưởng</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/suppliers/create"
               @can('create', \App\Models\Supplier::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
            <a href="/suppliers" class="a-button">Thoát</a>
        </div>
    </div>
    @cannot('viewAny', \App\Models\Supplier::class)
        <x-cannot-permission/>
    @else
        <form wire:submit='actionSupplier'>
            <div class="flex flex-wrap pt-2 space-y-2 px-2 max-w-250">
                <div class="w-full flex">
                    <p class="w-40">Phòng khám:</p>
                    <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                            wire:model='form.clinic_id'>
                        @foreach ($clinics as $clinic)
                            <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex w-full">
                    <p for="" class="w-40">Tên nhà cung cấp:<span class="text-red-600">*</span></p>
                    <div class="flex flex-grow flex-col">
                        <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.name'
                               autofocus>
                        @error('form.name')
                        <x-error-message>{{ $message }}</x-error-message>
                        @enderror
                    </div>
                </div>

                <div class="flex w-full">
                    <p for="" class="w-40">Điện thoại:</p>
                    <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.phone'
                           autofocus>
                </div>
                <div class="flex w-full">
                    <p for="" class="w-40">Email:</p>
                    <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.email'
                           autofocus>
                </div>
                <div class="flex w-full">
                    <p for="" class="w-40">Địa chỉ:</p>
                    <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.address'
                           autofocus>
                </div>
                <div class="flex w-full">
                    <p for="" class="w-40">Ghi chú:</p>
                    <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow h-30"
                              wire:model='form.note'></textarea>
                </div>
                <div class="flex w-full">
                    <p for="" class="w-40">Trạng thái:</p>
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

                @if ($successMessage != '')
                    <x-success-message>{{ $successMessage }}</x-success-message>
                @endif

                <div class="flex w-full">
                    <p for="" class="w-40"></p>
                    @if ($is_create == 'create')
                        <button type="submit"
                                @can('create', \App\Models\Supplier::class)
                                    class="main-button"
                                @else
                                    class="cannot-main-button"
                            @endcan
                        >Thêm
                        </button>
                    @else
                        <button type="submit" wire:dirty.remove.attr="disabled" disabled
                                @can('update', \App\Models\Supplier::class)
                                    class="main-button"
                                @else
                                    class="cannot-main-button"
                            @endcan
                        >Sửa
                        </button>
                    @endif
                    <a href="/suppliers" class="a-button ml-2">Thoát</a>

                </div>
            </div>
        </form>
    @endcannot
</div>
