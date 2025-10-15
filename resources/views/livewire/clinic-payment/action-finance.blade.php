<div>
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Dữ liệu >> <a href="/finances">Danh sách nhóm thu/chi</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/finances/create"
               @can('create', \App\Models\Finance::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
            <a href="/finances" class="a-button">Thoát</a>
        </div>
    </div>
    @cannot('viewAny', \App\Models\Finance::class)
        <x-cannot-permission/>
    @else
        <form wire:submit='actionFinance'>
            <div class="flex flex-wrap pt-2 space-y-2 px-2 max-w-250">
                <div class="flex w-full">
                    <p for="" class="w-35">Tên nhóm thu/chi:<span class="text-red-600">*</span></p>
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
                    <p for="" class="w-35">Nhóm:</p>
                    <div>
                        <label for="option-1" class="flex items-center">
                            <input type="radio" id="option-1" value="Nội bộ" wire:model='form.group'>
                            Thu/chi nội bộ
                        </label>
                        <label for="option-2" class="flex items-center">
                            <input type="radio" id="option-2" value="Bệnh nhân" wire:model='form.group'>
                            Thu/chi bệnh nhân
                        </label>
                        <label for="option-3" class="flex items-center">
                            <input type="radio" id="option-3" value="Nhà cung cấp" wire:model='form.group'>
                            Thu/chi nhà cung cấp
                        </label>
                        <label for="option-4" class="flex items-center">
                            <input type="radio" id="option-4" value="Nhân viên" wire:model='form.group'>
                            Thu/chi nhân viên
                        </label>
                        <label for="option-5" class="flex items-center">
                            <input type="radio" id="option-5" value="Khác" wire:model='form.group'>
                            Thu/chi khác
                        </label>
                    </div>
                </div>
                <div class="w-full flex">
                    <p class="w-35">Khoản:</p>
                    <div class="grid grid-cols-3 space-x-2">
                        <label for="checkbox1" class="flex items-center">
                            <input type="checkbox" id='checkbox1' value="receipt" wire:model='form.item'>
                            Khoản thu
                        </label>
                        <label for="checkbox2" class="flex items-center">
                            <input type="checkbox" id='checkbox2' value="payment" wire:model='form.item'>
                            Khoản chi
                        </label>
                    </div>
                </div>
                <div class="flex w-full">
                    <p for="" class="w-35">Ghi chú:</p>
                    <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow h-20"
                              wire:model='form.note'></textarea>
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
                @if ($finance)
                    <div class="flex w-full">
                        <p for="" class="w-35">Người cập nhật:</p>
                        <x-last-update-name
                            :name="$finance->last_update_name">{{ $finance->updated_at }}</x-last-update-name>
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
                                @can('create', \App\Models\Finance::class)
                                    class="main-button"
                                @else
                                    class="cannot-main-button"
                            @endcan
                        >Thêm
                        </button>
                    @else
                        <button type="submit" wire:dirty.remove.attr="disabled" disabled
                                @can('update', \App\Models\Finance::class)
                                    class="main-button"
                                @else
                                    class="cannot-main-button"
                            @endcan
                        >Sửa
                        </button>
                    @endif
                    <a href="/finances" class="a-button">Thoát</a>
                </div>
            </div>
        </form>
    @endcannot
</div>
