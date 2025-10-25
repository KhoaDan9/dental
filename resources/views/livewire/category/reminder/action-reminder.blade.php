<div>

    @if($reminder)
        <x-all-heading head_title="Danh mục" title_1="Mẫu lời dặn" url_1="/reminders"
                       create_url="/reminders/create"
                       exit_url="/reminders" :action_model="\App\Models\Reminder::class"
                       url_2="/reminders/{{$reminder->id}}" title_2="{{$reminder->name}}"/>
    @else
        <x-all-heading head_title="Danh mục" title_1="Mẫu lời dặn" url_1="/reminders"
                       create_url="/reminders/create"
                       exit_url="/reminders" :action_model="\App\Models\Reminder::class"/>
    @endif

    <form wire:submit.prevent='save'>
        <div class="action-display">
            <x-all-text-input title="Tên lời dặn:" model="form.name" is_required/>
            <x-all-select-input model="form.clinic_id" title="Phòng khám:" :values="$clinics"/>
            <x-all-textarea class="h-50" title="Nội dung mẫu:" model="form.detail"/>
            <x-all-textarea title="Ghi chú:" model="form.note"/>
            <x-status-input model="form.active"/>

            @if ($reminder)
                <x-all-last-update-name :name="$reminder->last_update_name"
                                        :updated_at="$reminder->updated_at"/>
            @endif
            @if ($successMessage != '')
                <x-success-message class="pl-35">{{ $successMessage }}</x-success-message>
            @endif
            @if ($errorMessage != '')
                <x-error-message class="pl-35">{{ $errorMessage }}</x-error-message>
            @endif

            <x-action-button w_title="w-35" :action_model="\App\Models\Reminder::class" exit_url="/reminders"
                             :is_create="$is_create"/>
        </div>
    </form>
</div>
