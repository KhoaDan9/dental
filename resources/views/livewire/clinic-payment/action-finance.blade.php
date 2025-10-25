<div>
    @if($finance)
        <x-all-heading head_title="Dữ liệu" title_1="Danh sách nhóm thu/chi" url_1="/finances"
                       create_url="/finances/create"
                       exit_url="/finances" :action_model="\App\Models\Finance::class"
                       url_2="/finances/{{$finance->id}}" title_2="{{$finance->name}}"/>
    @else
        <x-all-heading head_title="Dữ liệu" title_1="Danh sách nhóm thu/chi" url_1="/finances"
                       create_url="/finances/create"
                       exit_url="/finances" :action_model="\App\Models\Finance::class"/>
    @endif

    @cannot('viewAny', \App\Models\Finance::class)
        <x-cannot-permission/>
    @else
        <form wire:submit='actionFinance'>
            <div class="action-display">
                <x-all-text-input model="form.name" title="Tên nhóm thu/chi:" is_required/>
                <x-all-select-input model="form.clinic_id" title="Phòng khám:" :values="$clinics"/>


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
                <x-all-textarea title="Ghi chú:" model="form.note"/>
                <x-status-input model="form.active"/>

                @if ($finance)
                    <x-all-last-update-name :name="$finance->last_update_name"
                                            :updated_at="$finance->updated_at"/>
                @endif

                @if ($successMessage != '')
                    <x-success-message w_title="35">{{ $successMessage }}</x-success-message>
                @endif
                @if ($errorMessage != '')
                    <x-error-message w_title="35">{{ $errorMessage }}</x-error-message>
                @endif

                <x-action-button :action_model="\App\Models\Finance::class" exit_url="/finances"
                                 :is_create="$is_create"/>
            </div>
        </form>
    @endcannot
</div>
