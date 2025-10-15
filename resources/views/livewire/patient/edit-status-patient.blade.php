<div class="px-4">
    <livewire:patient.menu-patient :patient="$patient" exit_url="/patients"/>

    <div class="flex">
        <p class="w-40">ID</p>
        <p class="font-bold">{{ $patient->id }}</p>
    </div>
    <div class="flex">
        <p class="w-40">Tên khách hàng</p>
        <p class="font-bold">{{ $patient->name }}</p>
    </div>
    <div class="flex">
        <p class="w-40">Năm sinh</p>
        <p class="">{{ $patient->birth }}</p>
    </div>
    <div class="flex">
        <p class="w-40">Điện thoại</p>
        <p class="">{{ $patient->phone }}</p>
    </div>
    <div class="flex">
        <p class="w-40">Địa chỉ</p>
        <p class="">{{ $patient->address }}</p>
    </div>
    <div class="flex">
        <p class="w-40">Người cập nhật</p>
        <x-last-update-name :name="$patient->last_update_name">{{ $patient->created_at }}</x-last-update-name>
    </div>
    <div class="">
        <p class="pt-5"><strong>Trạng thái</strong></p>
        <label for="option-1" class="flex items-center">
            <input type="radio" id="option-1" value="Đang hẹn" wire:model='patient_status'>
            Đang hẹn
        </label>
        <label for="option-2" class="flex items-center">
            <input type="radio" id="option-2" value="Đang chờ" wire:model='patient_status'>
            Đang chờ
        </label>
        <label for="option-3" class="flex items-center">
            <input type="radio" id="option-3" value="Đang làm" wire:model='patient_status'>
            Đang làm
        </label>
        <label for="option-4" class="flex items-center">
            <input type="radio" id="option-4" value="Chưa thanh toán hết" wire:model='patient_status'>
            Chưa thanh toán hết
        </label>
        <label for="option-5" class="flex items-center">
            <input type="radio" id="option-5" value="Đã TT hết" wire:model='patient_status'>
            Đã thanh toán hết
        </label>
        <label for="option-6" class="flex items-center">
            <input type="radio" id="option-6" value="Đã về" wire:model='patient_status'>
            Đã về
        </label>
        <label for="option-7" class="flex items-center">
            <input type="radio" id="option-7" value="Hoàn thành" wire:model='patient_status'>
            Hoàn thành
        </label>
        <label for="option-8" class="flex items-center">
            <input type="radio" id="option-8" value="Hủy" wire:model='patient_status'>
            Hủy
        </label>
        <div class="flex mt-4 space-x-1">
            <button class="main-button" wire:click='save' wire:dirty.remove.attr='disabled' disabled>Lưu</button>
            <a href="/patients" class="a-button">Thoát</a>       
        </div>


        @if ($successMessage != '')
            <x-success-message>{{ $successMessage }}</x-success-message>
        @endif
    </div>

</div>
