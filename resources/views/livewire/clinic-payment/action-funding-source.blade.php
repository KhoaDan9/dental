<div>
    @if($funding_source)
        <x-all-heading head_title="Dữ liệu" title_1="Danh sách nguồn quỹ" url_1="/funding-sources"
                       create_url="/funding-sources/create"
                       exit_url="/funding-sources" :action_model="\App\Models\FundingSource::class"
                       url_2="/funding-sources/{{$funding_source->id}}" title_2="{{$funding_source->name}}"/>
    @else
        <x-all-heading head_title="Dữ liệu" title_1="Danh sách nguồn quỹ" url_1="/funding-sources"
                       create_url="/funding-sources/create"
                       exit_url="/funding-sources" :action_model="\App\Models\FundingSource::class"/>
    @endif

    <form wire:submit.prevent='save'>
        <div class="action-display">
            <x-all-text-input model="form.name" title="Tên nguồn quỹ:" is_required/>
            <x-all-select-input model="form.clinic_id" title="Phòng khám:" :values="$clinics"/>
            <x-all-textarea title="Ghi chú:" model="form.note"/>

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
            <x-status-input model="form.active"/>
            @if ($funding_source)
                <x-all-last-update-name :name="$funding_source->last_update_name"
                                        :updated_at="$funding_source->updated_at"/>
            @endif
            @if ($successMessage != '')
                <x-success-message class="pl-35">{{ $successMessage }}</x-success-message>
            @endif
            @if ($errorMessage != '')
                <x-error-message class="pl-35">{{ $errorMessage }}</x-error-message>
            @endif
            <x-action-button :action_model="\App\Models\FundingSource::class" exit_url="/funding-sources"
                             :is_create="$is_create"/>
        </div>
    </form>
</div>
