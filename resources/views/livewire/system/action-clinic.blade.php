<div>
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <span>Hệ thống >> <a href="/clinics">Danh sách phòng khám</a>
            >>
            <a href="/clinics/{{ $clinic_id }}">{{ $clinic_id }}.{{ $name }}</a>
        </span>
    </div>
    <div>
        @cannot('viewAny', \App\Models\Clinic::class)
            <x-cannot-permission/>
        @else
            <form wire:submit='updateClinic'>
                <div class="flex flex-wrap pt-2 space-y-2 px-2">
                    <div class="flex w-full">
                        <p for="" class="w-35">Mã phòng khám:<span class="text-red-600">*</span></p>
                        <div class="flex flex-grow flex-col">
                            <input type="text" class="px-1 border-gray-500 border-1 w-20 text-center"
                                   wire:model='clinic_id'>
                            @error('clinic_id')
                            <x-error-message>{{ $message }}</x-error-message>
                            @enderror
                        </div>

                    </div>

                    <div class="flex w-full">
                        <p for="" class="w-35">Tên phòng khám:<span class="text-red-600">*</span></p>
                        <div class="flex flex-grow flex-col">
                            <input type="text" class="px-1 border-gray-500 border-1  w-70" wire:model='name'>
                            @error('name')
                            <x-error-message>{{ $message }}</x-error-message>
                            @enderror
                        </div>
                    </div>

                    <div class="flex w-full">
                        <p for="" class="w-35">Địa chỉ:</p>
                        <div class=" flex flex-col">
                            <input type="text" class="px-1 border-gray-500 border-1 w-70" wire:model='address'>
                        </div>
                    </div>
                    <div class="flex w-full">
                        <p for="" class="w-35">Xã/Phường:</p>
                        <div class=" flex flex-col">
                            <input type="text" class="px-1 border-gray-500 border-1 w-70" wire:model='commune'>
                        </div>
                    </div>
                    <div class="flex w-full">
                        <p for="" class="w-35">Thành phố:</p>
                        <div class=" flex flex-col">
                            <input type="text" class="px-1 border-gray-500 border-1 w-70" wire:model='city'>
                        </div>
                    </div>

                    <div class="flex w-full">
                        <p for="" class="w-35">Điện thoại:</p>
                        <div class=" flex flex-col">
                            <input type="text" class="px-1 border-gray-500 border-1 w-70" wire:model='phone'>
                        </div>
                    </div>

                    <div class="flex w-full">
                        <p for="" class="w-35">Email:</p>
                        <div class=" flex flex-col">
                            <input type="text" class="px-1 border-gray-500 border-1 w-70" wire:model='email'>
                        </div>
                    </div>

                    <div class="flex w-full">
                        <p for="" class="w-35">Website:</p>
                        <div class=" flex flex-col">
                            <input type="text" class="px-1 border-gray-500 border-1 w-70" wire:model='website'>
                        </div>
                    </div>

                    <div class="flex w-full">
                        <p for="" class="w-35">Tài khoản ngân hàng:</p>
                        <div class=" flex flex-col">
                            <input type="text" class="px-1 border-gray-500 border-1 w-150"
                                   wire:model='bank_account_number'>
                        </div>
                    </div>

                    <div class="flex w-full">
                        <p for="" class="w-35">Giấy phép:</p>
                        <div class=" flex flex-col">
                            <input type="text" class="px-1 border-gray-500 border-1 w-150" wire:model='license'>
                        </div>
                    </div>

                    <div class="flex w-full">
                        <p for="" class="w-35">Ghi chú:</p>
                        <textarea type="text" class="px-1 border-gray-500 border-1 h-20 w-150"
                                  wire:model='note'></textarea>

                    </div>
                    <div class="flex w-full">
                        <p for="" class="w-35">Trạng thái:</p>
                        <div class="flex space-x-2 flex-1">
                            <label for="status1" class="flex items-center">
                                <input type="radio" id="status1" value=1 wire:model='active'>
                                Bật
                            </label>
                            <label for="status2" class="flex items-center">
                                <input type="radio" id="status2" value=0 wire:model='active'>
                                Tắt
                            </label>
                        </div>
                    </div>
                    <div class="flex w-full">
                        <p for="" class="w-35">Logo:</p>
                        <div class="flex items-start">
                            @if ($photo)
                                <img class="w-[120px]" src="{{ $photo->temporaryUrl() }}">
                            @elseif($logo_path)
                                <img class="w-[120px]" src="{{ Storage::url($logo_path) }}">
                            @endif
                            <input type="file" class=" w-auto" wire:model="photo"
                                   accept="image/png, image/gif, image/jpeg, image/jpg">
                        </div>
                    </div>

                    <div class="flex w-full">
                        <p for="" class="w-35">Người cập nhật:</p>
                        <x-last-update-name :name="$last_update_name">{{ $updated_at }}</x-last-update-name>
                    </div>
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

                    <div class="flex w-full space-x-1">
                        <p for="" class="w-35"></p>
                        <button type="submit"
                                @can('update', \App\Models\Clinic::class)
                                    class="main-button"
                                @else
                                    class="cannot-main-button"
                            @endcan
                        >Sửa
                        </button>
                        <a href="/clinics" class="a-button">Thoát</a>
                    </div>
                </div>
            </form>
        @endcannot
    </div>
</div>
