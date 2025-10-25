<div>
    @if($material)
        <x-all-heading head_title="Danh mục" title_1="Danh mục vật tư" url_1="/materials"
                       create_url="/materials/create"
                       exit_url="/materials" :action_model="\App\Models\Material::class"
                       url_2="/materials/{{$material->id}}" title_2="{{$material->name}}"/>
    @else
        <x-all-heading head_title="Danh mục" title_1="Danh mục vật tư" url_1="/materials"
                       create_url="/materials/create" :action_model="\App\Models\Material::class"/>
    @endif

    @if (count($material_groups) != 0)
        <form wire:submit='save'>
            <div class="action-display">

                <x-all-text-input title="Tên vật tư:" model="form.name" is_required/>
                <x-all-text-input title="Đơn vị tính:" model="form.caculation_unit" />
                <x-all-select-input model="form.clinic_id" title="Phòng khám:" :values="$clinics"/>
                <x-all-select-input model="form.material_group_id" title="Nhóm vật tư:" :values="$material_groups"/>
                <div class="flex w-full">
                    <p for="" class="w-35">Đơn giá:</p>
                    <input type="text" class="px-1 border-gray-500 border-[0.5px] rounded w-30 number-input"
                           wire:model='form.price'>
                    <p class="pl-1">VNĐ</p>
                </div>
                <x-all-text-input title="Mô tả:" model="form.describe" />
                <x-all-textarea title="Ghi chú:" model="form.note"/>
                <x-status-input model="form.active"/>
                @if ($material)
                    <x-all-last-update-name :name="$material->last_update_name"
                                            :updated_at="$material->updated_at"/>
                @endif

                @if ($successMessage != '')
                    <x-success-message class="pl-35">{{ $successMessage }}</x-success-message>
                @endif
                @if ($errorMessage != '')
                    <x-error-message class="pl-35">{{ $errorMessage }}</x-error-message>
                @endif

                <x-action-button w_title="w-35" :action_model="\App\Models\Material::class" exit_url="/materials"
                                 :is_create="$is_create"/>
            </div>
        </form>
    @else
        <x-error-message>{{ $errorMessage }}</x-error-message>
    @endif
</div>
