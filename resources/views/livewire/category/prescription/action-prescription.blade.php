<div>
    @if($prescription)
        <x-all-heading head_title="Danh mục" title_1="Mẫu đơn thuốc" url_1="/prescriptions"
                       create_url="/prescriptions/create"
                       exit_url="/prescriptions" :action_model="\App\Models\Prescription::class"
                       url_2="/prescriptions/{{$prescription->id}}" title_2="{{$prescription->name}}"/>
    @else
        <x-all-heading head_title="Danh mục" title_1="Mẫu đơn thuốc" url_1="/prescriptions"
                       create_url="/prescriptions/create" :action_model="\App\Models\Prescription::class"/>
    @endif

    <form wire:submit.prevent='save'>
        <div class="action-display">
            <x-all-text-input title="Tên lời dặn:" model="form.name" is_required/>
            <x-all-select-input model="form.clinic_id" title="Phòng khám:" :values="$clinics"/>
            <x-all-textarea class="h-50" title="Nội dung mẫu:" model="form.detail"/>
            <x-all-textarea title="Ghi chú:" model="form.note"/>
            <x-status-input model="form.active"/>

            @if ($prescription)
                <x-all-last-update-name :name="$prescription->last_update_name"
                                        :updated_at="$prescription->updated_at"/>
            @endif

            @if ($successMessage != '')
                <x-success-message class="pl-35">{{ $successMessage }}</x-success-message>
            @endif
            @if ($errorMessage != '')
                <x-error-message class="pl-35">{{ $errorMessage }}</x-error-message>
            @endif

            <x-action-button w_title="w-35" :action_model="\App\Models\Prescription::class" exit_url="/prescriptions"
                             :is_create="$is_create"/>
        </div>
    </form>
</div>
