<div class="flex-col">
    @if($employee)
        <x-all-heading head_title="Dữ liệu" title_1="Danh sách nhân viên" url_1="/employees" create_url="/employees/create"
                       exit_url="/employees" :action_model="\App\Models\Employee::class" url_2="/employees/{{$employee->id}}" title_2="{{$employee->name}}"/>
    @else
        <x-all-heading head_title="Dữ liệu" title_1="Danh sách nhân viên" url_1="/employees" create_url="/employees/create"
                       exit_url="/employees" :action_model="\App\Models\Employee::class" />
    @endif

    <form wire:submit.prevent='save'>
        <div class="action-display">
            <x-all-text-input model="form.full_name" title="Họ và tên" w_title="w-50"/>

            <div class="flex w-full">
                <p for="" class="w-50">Tên thường gọi:<span class="text-red-600">*</span></p>
                <div class="flex flex-grow flex-col">
                    <x-text-input-grow model="form.name"/>
                    @error('form.name')
                    <x-error-message>{{ $message }}</x-error-message>
                    @enderror
                </div>
                <p for="" class="pl-5 pr-1 text-right ">Ngày sinh:</p>
                <x-text-input type="date" class="w-60" model="form.birth"/>
            </div>

            <x-all-select-input model="form.clinic_id" title="Phòng khám:" w_title="w-50" :values="$clinics"/>
            <x-all-text-input model="form.citizen_id" title="Căn cước công dân:" w_title="w-50"/>
            <x-all-text-input model="form.phone" title="Số điện thoại:" w_title="w-50"/>
            <x-all-text-input model="form.email" title="Email:" w_title="w-50"/>
            <x-all-text-input model="form.address" title="Địa chỉ:" w_title="w-50"/>
            <x-all-textarea title="Ghi chú:" model="form.note" w_title="w-50"/>
            <x-status-input model="form.doctor" w_title="w-50" title="Bác sĩ thực hiện thủ thuật:" title_1="Có"
                            title_2="Không"/>
            <x-status-input model="form.active" w_title="w-50" title_1="Đang làm" title_2="Nghỉ việc"/>
            @if ($employee)
                <x-all-last-update-name :name="$employee->last_update_name" :updated_at="$employee->updated_at"
                                        w_title="w-50"/>
            @endif
            @if ($successMessage != '')
                <x-success-message class="pl-50">{{ $successMessage }}</x-success-message>
            @endif

            <x-action-button :action_model="\App\Models\Employee::class" exit_url="/employees" :is_create="$is_create"
                             w_title="w-50"/>

        </div>

    </form>

</div>
