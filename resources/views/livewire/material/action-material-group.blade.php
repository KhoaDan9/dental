<div>
    @if($material_group)
        <x-all-heading head_title="Danh mục" title_1="Nhóm vật tư" url_1="/material-groups"
                       create_url="/material-groups/create"
                       exit_url="/material-groups" :action_model="\App\Models\MaterialGroup::class"
                       url_2="/material-groups/{{$material_group->id}}" title_2="{{$material_group->name}}"/>
    @else
        <x-all-heading head_title="Danh mục" title_1="Nhóm vật tư" url_1="/material-groups"
                       create_url="/material-groups/create" :action_model="\App\Models\MaterialGroup::class"/>
    @endif

    <form wire:submit.prevent='save'>
        <div class="action-display">
            <x-all-text-input title="Tên nhóm vật tư:" model="form.name" is_required/>
            <x-all-select-input model="form.clinic_id" title="Phòng khám:" :values="$clinics"/>
            <x-all-textarea title="Ghi chú:" model="form.note"/>
            <x-status-input model="form.active"/>

            @if ($material_group)
                <x-all-last-update-name :name="$material_group->last_update_name"
                                        :updated_at="$material_group->updated_at"/>
            @endif
            @if ($successMessage != '')
                <x-success-message class="pl-35">{{ $successMessage }}</x-success-message>
            @endif
            @if ($errorMessage != '')
                <x-error-message class="pl-35">{{ $errorMessage }}</x-error-message>
            @endif
            <x-action-button w_title="w-35" :action_model="\App\Models\MaterialGroup::class" exit_url="/material-groups"
                             :is_create="$is_create"/>
        </div>
    </form>

</div>
