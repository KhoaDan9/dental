<div>
    <livewire:patient.menu-patient :patient="$patient" :exit_url="'/patients/' . $patient->id" is_patient_warranty="1"/>

    @cannot('viewAny', \App\Models\WarrantyCard::class)
        <x-cannot-permission/>
    @else

        <form wire:submit='updateWarrantyCard'>
            <div class="flex flex-wrap space-y-2 px-2 max-w-250">
                <div class="flex w-full">
                    <p class="w-40">Tên khách hàng:</p>
                    <p class="font-bold">{{ $patient_service->patient->name }}</p>
                </div>
                <div class="flex w-full">
                    <p class="w-40">Tên dịch vụ/thủ thuật:</p>
                    <p class="">{{ $patient_service->service_name }}</p>
                </div>
                <div class="flex w-full">
                    <p class="w-40">Mã thẻ:</p>
                    <div class="flex flex-grow flex-col">
                        <input type="text" class="px-1 border-gray-500 border-1 w-80" wire:model='form.card_id'>
                        @error('form.card_id')
                        <x-error-message>{{ $message }}</x-error-message>
                        @enderror
                    </div>

                </div>
                <div class="flex w-full">
                    <p class="w-40">Ngày hết hạn:</p>
                    <div class="flex flex-grow flex-col">
                        <input type="date" class="border-gray-500 border-1 w-80" wire:model='form.expiration_date'>
                        @error('form.expiration_date')
                        <x-error-message>{{ $message }}</x-error-message>
                        @enderror
                    </div>

                </div>
                <div class="flex w-full">
                    <p class="w-40">Trạng thái:</p>
                    <div class="">
                        <label for="option-1" class="flex items-center">
                            <input type="radio" id="option-1" value="Không phát hành" wire:model='form.warranty_status'>
                            Không phát hành
                        </label>
                        <label for="option-2" class="flex items-center">
                            <input type="radio" id="option-2" value="Chưa có thẻ" wire:model='form.warranty_status'>
                            Chưa có thẻ
                        </label>
                        <label for="option-3" class="flex items-center">
                            <input type="radio" id="option-3" value="Đã có thẻ" wire:model='form.warranty_status'>
                            Đã có thẻ
                        </label>
                        <label for="option-4" class="flex items-center">
                            <input type="radio" id="option-4" value="Đã trả thẻ" wire:model='form.warranty_status'>
                            Đã trả thẻ
                        </label>
                        <label for="option-5" class="flex items-center">
                            <input type="radio" id="option-5" value="Hủy thẻ" wire:model='form.warranty_status'>
                            Hủy thẻ
                        </label>
                    </div>
                </div>
                <div class="flex w-full">
                    <p class="w-40">Ghi chú:</p>
                    <input type="text" class="px-1 border-gray-500 border-1 w-80" wire:model='form.note'>
                </div>
                @if ($patient_service->warrantyCard != null)
                    <div class="flex w-full">
                        <p class="w-40">Người cập nhật:</p>
                        <x-last-update-name
                            :name="$patient_service->warrantyCard->last_update_name">{{ $patient_service->warrantyCard->updated_at }}</x-last-update-name>
                    </div>
                @endif
                <div class="flex w-full">
                    <p class="w-40"></p>
                    <button type="submit" wire:dirty.remove.attr='disabled' disabled
                            @if($this->form->warranty_card == null)
                                @can('create', \App\Models\WarrantyCard::class)
                                    class="main-button"
                                @else
                                    class="cannot-main-button"
                                @endcan
                            @else
                                @can('update', \App\Models\WarrantyCard::class)
                                    class="main-button"
                            @else
                                class="cannot-main-button"
                        @endcan
                        @endif
                    >Lưu
                    </button>
                   
                    <a href="/patients/{{ $patient->id }}" class="a-button ml-2">Thoát</a>
                </div>
                @if ($successMessage != '')
                    <div class="flex w-full">
                        <p class="w-40">:</p>
                        <x-success-message>{{ $successMessage }}</x-success-message>
                    </div>
                @endif

            </div>
        </form>
    @endcannot
</div>
