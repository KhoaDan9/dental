<div>
    @if($service)
        <x-all-heading head_title="Dữ liệu" title_1="Danh sách dịch vụ/thủ thuật" url_1="/services"
                       create_url="/services/create"
                       :action_model="\App\Models\Service::class"
                       exit_url="/services" :action_model="\App\Models\Service::class"
                       url_2="/services/{{$service->id}}" title_2="{{$service->name}}"/>
    @else
        <x-all-heading head_title="Dữ liệu" title_1="Danh sách dịch vụ/thủ thuật" url_1="/services"
                       create_url="/services/create"
                       :action_model="\App\Models\Service::class"/>
    @endif

    @cannot('viewAny', \App\Models\Service::class)
        <x-cannot-permission/>
    @else
        @if(count($this->service_groups) != 0)
            <form wire:submit.prevent='save'>
                <div class="action-display">
                    <x-all-text-input w_title="w-40" title="Tên thủ thuật:" model="form.name" is_required/>
                    <x-all-text-input w_title="w-40" title="Đơn vị tính:" model="form.caculation_unit"/>
                    <x-all-select-input w_title="w-40" model="form.clinic_id" title="Phòng khám:" :values="$clinics"/>
                    <x-all-select-input w_title="w-40" model="form.service_group_id" title="Nhóm thủ thuật:"
                                        :values="$service_groups"/>

                    <div class="flex w-full">
                        <p for="" class="w-40">Đơn giá:</p>
                        <input type="text" class="px-1 border-gray-400 border-[0.5px] rounded w-30 number-input"
                               wire:model='form.price'>
                        <p class="pl-1">VNĐ</p>
                    </div>
                    <x-all-textarea w_title="w-40" title="Ghi chú:" model="form.note"/>

                    <x-status-input w_title="w-40" model="form.active"/>
                    @if ($service)
                        <x-all-last-update-name w_title="w-40" :name="$service->last_update_name"
                                                :updated_at="$service->updated_at"/>
                    @endif
                    @if ($successMessage != '')
                        <x-success-message class="pl-40">{{ $successMessage }}</x-success-message>
                    @endif

                    @if ($errorMessage != '')
                        <x-error-message class="pl-40">{{ $errorMessage }}</x-error-message>
                    @endif

                    <x-action-button w_title="w-40" :action_model="\App\Models\Service::class" exit_url="/services"
                                     :is_create="$is_create"/>
                </div>
            </form>
        @else
            <x-error-message>{{ $errorMessage }}</x-error-message>
        @endif
    @endcannot
</div>
