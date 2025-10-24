<div>
    @if($service_group)
        <x-all-heading head_title="Dữ liệu" title_1="Nhóm dịch vụ/thủ thuật" url_1="/service-groups"
                       create_url="/service-groups/create"
                       exit_url="/service-groups" :action_model="\App\Models\ServiceGroup::class"
                       url_2="/service-groups/{{$service_group->id}}" title_2="{{$service_group->name}}"/>
    @else
        <x-all-heading head_title="Dữ liệu" title_1="Nhóm dịch vụ/thủ thuật" url_1="/service-groups"
                       create_url="/service-groups/create"
                       :action_model="\App\Models\ServiceGroup::class"/>
    @endif
    <form wire:submit='actionServiceGroup'>
        <div class="action-display">
            <x-all-text-input title="Tên nhóm:" model="form.name" is_required/>
            <x-all-select-input model="form.clinic_id" title="Phòng khám:" :values="$clinics"/>
            <x-all-textarea title="Ghi chú:" model="form.note"/>
            <x-status-input model="form.active"/>
            @if ($service_group)
                <x-all-last-update-name :name="$service_group->last_update_name"
                                        :updated_at="$service_group->updated_at"/>
            @endif

            @if ($successMessage != '')
                <x-success-message class="pl-35">{{ $successMessage }}</x-success-message>
            @endif
            @if ($errorMessage != '')
                <x-error-message class="pl-35">{{ $errorMessage }}</x-error-message>
            @endif

            <x-action-button :action_model="\App\Models\ServiceGroup::class" exit_url="/service-groups" :is_create="$is_create"/>
        </div>
    </form>
</div>
