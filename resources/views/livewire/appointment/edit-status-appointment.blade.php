<div>
    <x-all-heading head_title="Dữ liệu" title_1="Lịch hẹn" url_1="/appointments"
                   exit_url="/appointments" title_2="{{ $patient->clinic_id }}.{{ $patient->id }}"
                   url_2="/patients/{{ $patient->id }}"
    />

    <div class="flex">
        <p class="w-40">Tên khách hàng</p>
        <p class="font-bold">{{ $patient->name }}</p>
    </div>
    <div class="flex">
        <p class="w-40">Nội dung cuộc hẹn</p>
        <p class="">{{ $appointment->detail }}</p>
    </div>
    <x-all-last-update-name w_title="w-40" :name="$appointment->last_update_name"
                            :updated_at="$appointment->updated_at"/>
    <form class="" wire:submit="updateStatusAppointment">
        <p class="pt-5"><strong>Trạng thái</strong></p>
        <label for="option-1" class="flex items-center">
            <input type="radio" id="option-1" value="Đang hẹn" wire:model='appointment_status'>
            Đang hẹn
        </label>
        <label for="option-2" class="flex items-center">
            <input type="radio" id="option-2" value="Đã xác nhận" wire:model='appointment_status'>
            Đã xác nhận
        </label>
        <label for="option-3" class="flex items-center">
            <input type="radio" id="option-3" value="Đã chuyển hẹn" wire:model='appointment_status'>
            Đã chuyển hẹn
        </label>
        <label for="option-4" class="flex items-center">
            <input type="radio" id="option-4" value="Đến trước hẹn" wire:model='appointment_status'>
            Đến trước hẹn
        </label>
        <label for="option-5" class="flex items-center">
            <input type="radio" id="option-5" value="Đã đến" wire:model='appointment_status'>
            Đã đến
        </label>
        <label for="option-6" class="flex items-center">
            <input type="radio" id="option-6" value="Đến sau hẹn" wire:model='appointment_status'>
            Đến sau hẹn
        </label>
        <label for="option-7" class="flex items-center">
            <input type="radio" id="option-7" value="Không đến" wire:model='appointment_status'>
            Không đến
        </label>
        <label for="option-8" class="flex items-center">
            <input type="radio" id="option-8" value="Hủy" wire:model='appointment_status'>
            Hủy
        </label>
        <div class="flex mt-4 space-x-1">
            <button class="main-button" type="submit" wire:dirty.remove.attr='disabled' disabled>Lưu</button>
            <a href="/appointments" class="a-button">Thoát</a>
        </div>

        @if ($successMessage)
            <x-success-message>{{ $successMessage }}</x-success-message>
        @endif
    </form>

</div>
