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
                    <x-all-text-input title="Mã phòng khám:" model="clinic_id" class="w-20! text-center" is_required/>
                    <x-all-text-input title="Tên phòng khám:" model="name" class="w-70" is_required/>
                    <x-all-text-input title="Địa chỉ:" model="address" class="w-70"/>
                    <x-all-text-input title="Xã/Phường:" model="commune" class="w-70"/>
                    <x-all-text-input title="Thành phố:" model="city" class="w-70"/>
                    <x-all-text-input title="Điện thoại:" model="phone" class="w-70"/>
                    <x-all-text-input title="Email:" model="email" class="w-70"/>
                    <x-all-text-input title="Website:" model="website" class="w-70"/>
                    <x-all-text-input title="Tài khoản ngân hàng:" model="bank_account_number" class="w-150"/>
                    <x-all-text-input title="Giấy phép:" model="license" class="w-150"/>
                    <x-all-textarea title="Ghi chú:" model="note" class="w-150"/>
                    <x-status-input model="active"/>

                    <div class="flex w-full">
                        <p for="" class="w-35">Logo:</p>
                        <div class="flex items-start">
                            @if ($photo)
                                <img class="w-[120px]" src="{{ $photo->temporaryUrl() }}">
                            @elseif($logo_path)
                                <img class="w-[120px]" src="{{ Storage::url($logo_path) }}">
                            @endif
                            <input type="file" class="w-auto" wire:model="photo"
                                   accept="image/png, image/jpeg, image/jpg">
                        </div>
                    </div>

                    <div class="flex w-full">
                        <p for="" class="w-35">Người cập nhật:</p>
                        <x-last-update-name :name="$last_update_name">{{ $updated_at }}</x-last-update-name>
                    </div>
                    @if ($successMessage != '')
                        <x-success-message class="pl-35">{{ $successMessage }}</x-success-message>
                    @endif
                    @if ($errorMessage != '')
                        <x-error-message class="pl-35">{{ $errorMessage }}</x-error-message>
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
